@extends('layout.master')
@section('page-title')
    Home Page
@endsection
@section('main-content')
<main class="main-content">

        <!-- Book List -->
        <div class="tc-padding">
            <div class="container">
                <div class="row">
                    
                    <!-- Content -->
                    <div class="col-lg-9 col-md-8 col-xs-12 pull-right pull-none">

                        <!-- Book List Header -->
                        <div class="book-list-header">
                            
                            <!-- Heading -->
                            <h4>Popular Books</h4>
                            <!-- Heading -->
                        </div>
                        <!-- Book List Header -->

                        <!-- Book List Widgets -->
                        <div id="filter-masonry" class="gallery-masonry">   
                            @forelse($books as $book)
                            <div class="book-list-widget masonry-grid business">
                                <span class="heart-batch"><i class="fa fa-heart"></i></span>
                                <div class="book-list-detail">
                                    @if($book->book_img == 'No image found')
                                        <img src="/uploads/no-img.jpg" width="109" height="164" alt="No image found">
                                    @else
                                        <img src="/uploads/{{ $book->book_img }}" width="109" height="164" alt="{{ $book->title }}">
                                    @endif
                                    <div class="detail">
                                        <span>by {{ $book->author->title }}</span>
                                        <div class="book-name">
                                            <h5>{{ $book->title }} <span>{{ $book->category->title }}</span></h5><strong>Rs/ {{ number_format($book->price) }}</strong>
                                        </div>
                                        <p>{{ Str::limit($book->description, 120) }}</p>
                                    </div>
                                </div>
                                <div class="book-list-btm">
                                    <div class="like-nd-share">
                                        <ul>
                                            <li><a href="{{ route('book.show', $book->slug) }}"><i class="fa fa-eye"></i>View</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="alert alert-danger">No record found!</div>
                            @endforelse
                        </div>
                        <!-- Book List Widgets -->

                        
                    </div>
                    <!-- Content -->

                    <!-- Aside -->
                    <aside class="col-lg-3 col-md-4 col-xs-12 pull-left pull-none">
                        <!-- Aside Widget -->
                        <div class="aside-widget">
                            <div class="sidebar top-books-category">
                                <h4>Top Books Catagories</h4>
                                <ul>
                                    @forelse($categories as $category)
                                        <li><a href="{{ route('category.show', $category->slug) }}">{{ $category->title }}</a></li>
                                    @empty
                                        <div class="alert alert-danger">No record found!</div>
                                    @endforelse                                 
                                </ul>
                            </div>
                        </div>
                        <!-- Aside Widget -->

                    </aside>
                    <!-- Aside -->

                </div>
            </div>
        </div>
        <!-- Blog All Views -->

    </main>
@endsection