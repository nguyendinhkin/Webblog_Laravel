@extends('fontend.master_page')
@section('main')
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb__wrap">
            <div class="container custom-container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8 col-md-10">
                        <div class="breadcrumb__wrap__content">
                            <h2 class="title">{{ $category->blog_category }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="breadcrumb__wrap__icon">
                <ul>
                    <li><img src="{{ asset('fontend/assets/img/icons/breadcrumb_icon01.png') }}" alt=""></li>
                    <li><img src="{{ asset('fontend/assets/img/icons/breadcrumb_icon02.png') }}" alt=""></li>
                    <li><img src="{{ asset('fontend/assets/img/icons/breadcrumb_icon03.png') }}" alt=""></li>
                    <li><img src="{{ asset('fontend/assets/img/icons/breadcrumb_icon04.png') }}" alt=""></li>
                    <li><img src="{{ asset('fontend/assets/img/icons/breadcrumb_icon05.png') }}" alt=""></li>
                    <li><img src="{{ asset('fontend/assets/img/icons/breadcrumb_icon06.png') }}" alt=""></li>
                </ul>
            </div>
        </section>
        <!-- breadcrumb-area-end -->


        <!-- blog-area -->
        <section class="standard__blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        @foreach($blog as $item)
                            <div class="standard__blog__post">
                                <div class="standard__blog__thumb">
                                    <a href="{{ route('blog.details', $item->id) }}"><img src="{{ asset('upload/blog/'.$item->blog_image) }}" alt=""></a>
                                    <a href="{{ route('blog.details', $item->id) }}" class="blog__link"><i class="far fa-long-arrow-right"></i></a>
                                </div>
                                <div class="standard__blog__content">
                                    <div class="blog__post__avatar">
                                        <div class="thumb"><img src="{{ asset('upload/blog/'.$item->blog_image) }}" alt=""></div>
                                        <span class="post__by">By : <a href="#">Halina Spond</a></span>
                                    </div>
                                    <h2 class="title"><a href="{{ route('blog.details', $item->id) }}">{{ $item->blog_title }}</a></h2>
                                    {!! Str::limit($item->blog_description, 250) !!}
                                    <ul class="blog__post__meta">
                                        <li><i class="fal fa-calendar-alt"></i> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <div class="pagination-wrap">
                            {{ $blog->links('vendor/pagination/custom') }}
                        </div>
                    </div>
                    @include('fontend.blog_all.blog_sidebar')
                </div>
            </div>
        </section>
        <!-- blog-area-end -->


        <!-- contact-area -->
        <section class="homeContact homeContact__style__two">
            <div class="container">
                <div class="homeContact__wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="section__title">
                                <span class="sub-title">07 - Say hello</span>
                                <h2 class="title">Any questions? Feel free <br> to contact</h2>
                            </div>
                            <div class="homeContact__content">
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                <h2 class="mail"><a href="mailto:Info@webmail.com">Info@webmail.com</a></h2>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="homeContact__form">
                                <form action="#">
                                    <input type="text" placeholder="Enter name*">
                                    <input type="email" placeholder="Enter mail*">
                                    <input type="number" placeholder="Enter number*">
                                    <textarea name="message" placeholder="Enter Massage*"></textarea>
                                    <button type="submit">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
@endsection
