<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Media;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;

class MainController extends Controller
{
    public function index()
    {
        $sliders = Media::where(['status' => 'ACTIVE', 'media_type' => 'slider'])->get();
        $upcoming_books = Book::where('status', 'UPCOMING')->limit(5)->get();
        $downloaded_books = Book::with('author', 'category')->orderBy('downloaded', 'DESC')->get();
        $recommended_books = Book::where('recommended', '1')->get();
        $categories = Category::where('status', 'ACTIVE')->get();
        $books = Book::with('author')->where('status', 'ACTIVE')->paginate(10);
        $author_feature = Author::where(['status' => 'ACTIVE', 'author_feature' => 'yes'])->inRandomOrder()->first();
        $galleries = Media::where(['status' => 'ACTIVE', 'media_type' => 'gallery'])->limit(8)->get();      
        return view('index', compact('sliders', 'upcoming_books', 'downloaded_books', 'recommended_books', 'categories', 'books', 'author_feature', 'galleries'));
    }

    public function about()
    {
        $teams = Team::where('status', 'ACTIVE')->get();
        return view('pages.about', compact('teams'));
    }

    public function gallery()
    {
        $galleries = Media::where(['status' => 'ACTIVE', 'media_type' => 'gallery'])->paginate(8);
        return view('pages.gallery', compact('galleries'));
    }

    public function author()
    {
        $searchLetter = request()->get('letter');
        $authors = Author::where('title', 'LIKE', "$searchLetter%")->paginate(10);
        $author_features = Author::where('author_feature', 'yes')->limit(5)->get();
        $downloaded_books = Book::orderby('downloaded', 'DESC')->limit(5)->get();
        return view('pages.author', compact('authors', 'author_features', 'downloaded_books'));
    }

    public function author_detail($slug)
    {
        $author = Author::where('slug', $slug)->first();
        $author_feature = Author::where('author_feature', 'yes')->Latest()->first();
        return view('pages.author_detail', compact('author','author_feature'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
