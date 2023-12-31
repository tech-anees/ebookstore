<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        $searchTerm = request()->get('s');
        $categories = Category::Latest()->where('title', 'LIKE', "%$searchTerm%")->paginate(15);
    	return view('admin.category.index')
        ->with(compact('categories'));
    }
    public function create()
    {
    	return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);
        Category::create([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
            'status' => 'DEACTIVE',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
        return redirect()->to('/admin/category');
    }
    public function edit($id)
    {
        $category = Category::findOrfail($id);
    	return view('admin.category.edit')
            ->with(compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrfail($id);
        $category->update([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
            'status' => 'DEACTIVE',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
        return redirect()->to('/admin/category');
    }
     public function delete(Request $request, $id)
    {
        if ($request->ajax()) 
        {
        $category = Category::findOrfail($id);
        $category->delete();

        return 'true';
        }
    }
    public function status(Request $request, $id)
    {
        sleep(0.5);
        if($request->ajax())
        $category = Category::findOrfail($id);
        $newStatus = ($category->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $category->update([
                'status' => $newStatus
        ]);
        echo $newStatus;
    }
    public function status_active(Request $request)
    {
        $checkAll = $request->get('checkAll');
        foreach ($checkAll as $id) {
            echo Category::where('id', $id)->update([
                'status' => 'ACTIVE'
            ]);
        }
    }

    public function status_deactive(Request $request)
    {
        $checkAll = $request->get('checkAll');
        foreach ($checkAll as $id) {
            echo Category::where('id', $id)->update([
                'status' => 'DEACTIVE'
            ]);
        }
    }

    public function delete_all(Request $request)
    {
        $checkAll = $request->get('checkAll');
        foreach ($checkAll as $id) {
            echo Category::where('id', $id)->delete();
        }
    }
}

