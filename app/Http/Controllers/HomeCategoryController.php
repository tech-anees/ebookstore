<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class HomeCategoryController extends Controller
{
    public function show($slug)
    {
    	$category = Category::where('slug', $slug)->first();
    	$books = Book::where('category_id', $category->id)->get();
    	$categories = Category::get();
    	return view('category.category_detail',compact('category', 'books', 'categories'));
    }
}
