<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use File;
class BookController extends Controller
{
    public function index()
    {
        $searchTerm = request()->get('s');
        $books = Book::Latest()->where('title', 'LIKE', "%$searchTerm%")->paginate(15);
        return view('admin.book.index')
            ->with(compact('books'));
    }
    public function create()
    {
        $categories = Category::get();
        $authors = Author::get();
    	return view('admin.book.create')
            ->with(compact('categories','authors'));
    }
 public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'publisher' => 'required',
            'country_of_publisher' => 'required',
            'total_pages' => 'required',
            'edition_number' => 'required',
            'book_img' => 'required|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $fileName = null;
        if (request()->hasFile('book_img')) 
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        } 

        $bookFile = null;
        if (request()->hasFile('book_upload')) 
        {
            $file = request()->file('book_upload');
            $bookFile = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $bookFile);
        } 

        Book::create([
            'title' => $request->get('title'), 
            'category_id' => $request->get('category_id'),
            'author_id' => $request->get('author_id'),
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'availability' => $request->get('availability'),
            'price' => $request->get('price'),
            'rating' => 'rating',
            'publisher' => $request->get('publisher'),
            'country_of_publisher' => $request->get('country_of_publisher'),
            'isbn' => $request->get('isbn'),
            'isbn_10' => $request->get('isbn_10'),
            'audience' => $request->get('audience'),
            'format' => $request->get('format'),
            'language' => $request->get('language'),
            'description' => $request->get('description'),
            'total_pages' => $request->get('total_pages'),
            'downloaded' => '1',
            'edition_number' => $request->get('edition_number'),
            'recommended' => $request->get('recommended'),
            'book_upload' => $bookFile,
            'book_img' => $fileName,
            'status' => 'ACTIVE', 
            'created_by' => '1',
            'updated_by' => '1'
        ]);
        return redirect()->to('admin/book');
    }
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::get();
        $authors = Author::get();
        return view('admin.book.edit')
            ->with(compact('book', 'categories', 'authors')); 
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $currentImage = $book->book_img;

        $fileName = null;
        if (request()->hasFile('book_img')) 
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $currentFile = $book->book_upload;
        $bookFile = null;
        if (request()->hasFile('book_upload')) 
        {
            $file = request()->file('book_upload');
            $bookFile = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $bookFile);
        }

        $book->update([
            'title' => $request->get('title'), 
            'category_id' => $request->get('category_id'),
            'author_id' => $request->get('author_id'),
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'availability' => $request->get('availability'),
            'price' => $request->get('price'),
            'rating' => 'rating',
            'publisher' => $request->get('publisher'),
            'country_of_publisher' => $request->get('country_of_publisher'),
            'isbn' => $request->get('isbn'),
            'isbn_10' => $request->get('isbn_10'),
            'audience' => $request->get('audience'),
            'format' => $request->get('format'),
            'language' => $request->get('language'),
            'description' => $request->get('description'),
            'total_pages' => $request->get('total_pages'),
            'downloaded' => $request->get('downloaded'),
            'edition_number' => $request->get('edition_number'),
            'recommended' => $request->get('recommended'),
            'book_upload' => ($bookFile) ? $bookFile : $currentFile,
            'book_img' => ($fileName) ? $fileName : $currentImage,
            'status' => 'DEACTIVE', 
            'created_by' => '1',
            'updated_by' => '1'
        ]);


      	if ($fileName)
            File::delete('./uploads/' . $currentImage,$currentFile);
        
        return redirect()->to('/admin/book');

    }
    public function delete(Request $request, $id)
    {
        if ($request->ajax())
        {
        $book = Book::findOrfail($id);
        $currentImage = $book->book_img;
        $currentFile = $book->book_upload;
    	$book->delete();
        File::delete('./uploads/' . $currentImage);
        File::delete('./uploads/books/' . $currentFile);
        return 'true';
        }
    }
    public function status(Request $request, $id)
    {
        sleep(0.5);
        if ($request->ajax())
        $book = Book::findOrfail($id);
        $newstatus = ($book->status =='DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $book->update(
        			[
            'status' => $newstatus
        ]);
        echo $newstatus;
    }
    public function status_active(Request $request)
    {
        $checkAll = $request->get('checkAll');
        foreach ($checkAll as $id) {
            echo Book::where('id', $id)->update([
                'status' => 'ACTIVE'
            ]);
        }
    }

    public function status_deactive(Request $request)
    {
        $checkAll = $request->get('checkAll');
        foreach ($checkAll as $id) {
            echo Book::where('id', $id)->update([
                'status' => 'DEACTIVE'
            ]);
        }
    }

    public function delete_all(Request $request)
    {
        $checkAll = $request->get('checkAll');
        foreach ($checkAll as $id) {
            echo Book::where('id', $id)->delete();
        }
    }
}
