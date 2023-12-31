<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use File;

class MediaController extends Controller
{
    public function index()
    {
       $searchTerm = request()->get('s');
        $medias = Media::Latest()->where('title', 'LIKE', "%$searchTerm%")->paginate(15);
        return view('admin.media.index')
            ->with(compact('medias'));
    }
    public function create()
    {
    	return view('admin.media.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'media_type' => 'required|not_in:none'
        ]);

        $fileName = null;
        if (request()->hasfile('media_img'))
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        Media::create([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'media_type' => $request->get('media_type'),
            'media_img' => $fileName,
            'description' => $request->get('description'),
            'status' => 'DEACTIVE',
        ]);
        return redirect()->to('/admin/media');
    }
    public function edit($id)
    {
        $media = Media::findOrfail($id);
    	return view('admin.media.edit')
            ->with(compact('media'));
    }
    public function update(Request $request, $id)
    {
        $media = Media::findOrfail($id);
        $currentImage = $media->media_img;

        $fileName = null;
        if (request()->hasfile('media_img'))
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $media->update([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'media_type' => $request->get('media_type'),
            'media_img' => ($fileName) ? $fileName : $currentImage,
            'description' => $request->get('description'),
            'status' => 'DEACTIVE',
        ]);
        if ($fileName)
            File::delete('./uploads/' . $currentImage);

        return redirect()->to('/admin/media');
    }
     public function delete(Request $request, $id)
    {
        if ($request->ajax()) 
        {
        $media = Media::findOrfail($id);
        $currentImage = $media->media_img;
        $media->delete();
        File::delete('./uploads/' . $currentImage);
        return 'true';
        }
    }
    public function status(Request $request, $id)
    {
        if ($request->ajax())
        $media = Media::findOrfail($id);
        $newStatus = ($media->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $media->update([
                'status' => $newStatus
        ]);
        echo $newStatus;
    }
}
