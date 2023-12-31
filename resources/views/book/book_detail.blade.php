@extends('layout.master')
@section('page-title')
    {{ $book->title }}
@endsection
@section('main-content')
<main class="main-content">
<!-- Book Detail -->
<div class="book-detail">
    <div class="container">
        <!-- Alert -->
        <div class="add-cart-alert">
            <p><i class="fa fa-check-circle"></i>{{ $book->title }}</p>
            <a class="btn-1 sm pull-right shadow-0" href="#">view cart</a>
        </div>
        <!-- Alert -->

        <!-- Single Book Detail -->
        <div class="single-boook-detail">
            <div class="row">
                
                <!-- Book Thumnbnail -->
                <div class="col-lg-4 col-md-5">
                    <div class="product-thumnbnail">
                        <ul class="product-slider">
                            <li>
                                <img src="/assets/images/product-thumbnail/img-01.jpg" alt="">
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Book Thumnbnail -->

                <!-- book Detail -->
                <div class="col-lg-8 col-md-7">
                    <div class="single-product-detail">
                        <span class="availability">Availability :<strong>{{ $book->availability }}<i class="fa fa-check-circle"></i></strong></span>
                        <h3>{{ $book->title }}</h3>
                        <ul class="rating-stars">
                            <li><i>{{ $book->rating }}</i></li>
                        </ul>
                        <h4>Overview</h4>
                        <p>{{ $book->description }}</p>
                        <div class="quantity-box">
                            <label>Qty :</label>
                            <form id='myform' method='POST' action='http://techlinqs.com/html/bookstore-0.2/bookstore-ltr/123'>
                                <input type='button' value='-' class='qtyminus'/>
                                <input type='text' name='quantity' value='0' class='qty' />
                                <input type='button' value='+' class='qtyplus'/>
                            </form>
                        </div>
                        <ul class="btn-list">
                            <li><a class="btn-1 sm shadow-0 " href="#">add to cart</a></li>
                            <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-repeat"></i></a></li>
                            <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-share-alt"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- book Detail -->

            </div>
        </div>
        <!-- Single Book Detail -->

        <!-- Disc Nd Description -->
        <div class="disc-nd-Description tc-padding-bottom">
            <div class="row">
                <div id="disc-reviews-tabs" class="disc-reviews-tabs">

                    <!-- Tabs Nav -->
                    <div class="col-sm-3">
                        <div class="tabs-nav">
                            <ul>
                                <li><a href="#tab-1">Reviews</a></li>
                                <li><a href="#tab-2">Description</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Tabs Nav -->

                    <!-- Tabs Content -->
                    <div class="col-sm-9">
                        <div class="tabs-content">
                            <!-- Book Info List -->
                            <div id="tab-2">
                                <div class="book-info-list">
                                    <ul>
                                        <li><span>ISBN: </span>{{ $book->isbn }}</li>
                                        <li><span>ISBN-10: </span>{{ $book->isbn-10 }}</li>
                                        <li><span>Audience: </span>{{ $book->audience }}</li>
                                        <li><span>Format: </span>{{ $book->format }}</li>
                                        <li><span>Language: </span>{{ $book->language }}</li>
                                        <li><span>Number Of Pages: </span>{{ $book->total_pages }}</li>
                                        <li><span>Published: </span>{{ $book->publisher }}</li>
                                        <li><span>Country of Publication: </span>{{ $book->country_of_publisher }}</li>
                                        <li><span>Edition Number: </span>{{ $book->edition_number }}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Book Info List -->
                                
                            <!-- Description & Products -->
                            <div id="tab-1">    

                                <!-- Description -->
                                <div class="description"></div>
                                <!-- Description -->

                                <!-- Related Products -->
                                <div class="related-products">
                                    <h5>You May <span>also like this</span></h5>
                                    <div class="related-produst-slider">
                                        <div class="item">
                                            <div class="product-box">
                                                <div class="product-img">
                                                    <img src="/assets/images/best-seller/img-01.jpg" alt="">
                                                    <ul class="product-cart-option position-center-x">
                                                        <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-cart-arrow-down"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-share-alt"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-detail">
                                                    <span>Novel</span>
                                                    <h5>Jewels of Nizam</h5>
                                                    <p>How to Write a Book Review...</p>
                                                    <div class="rating-nd-price">
                                                        <strong>$280.99</strong>
                                                        <ul class="rating-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="product-box">
                                                <div class="product-img">
                                                    <img src="/assets/images/best-seller/img-02.jpg" alt="">
                                                    <ul class="product-cart-option position-center-x">
                                                        <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-cart-arrow-down"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-share-alt"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-detail">
                                                    <span>Novel</span>
                                                    <h5>Jewels of Nizam</h5>
                                                    <p>How to Write a Book Review...</p>
                                                    <div class="rating-nd-price">
                                                        <strong>$280.99</strong>
                                                        <ul class="rating-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="product-box">
                                                <div class="product-img">
                                                    <img src="/assets/images/best-seller/img-03.jpg" alt="">
                                                    <ul class="product-cart-option position-center-x">
                                                        <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-cart-arrow-down"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-share-alt"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-detail">
                                                    <span>Novel</span>
                                                    <h5>Jewels of Nizam</h5>
                                                    <p>How to Write a Book Review...</p>
                                                    <div class="rating-nd-price">
                                                        <strong>$280.99</strong>
                                                        <ul class="rating-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Related Products -->

                            </div>
                            <!-- Description & Products -->

                        </div>
                    </div>
                    <!-- Tabs Content -->

                </div>
            </div>
        </div>
        <!-- Disc Nd Description -->

    </div>
</div>
<!-- Book Detail -->

</main>
@endsection