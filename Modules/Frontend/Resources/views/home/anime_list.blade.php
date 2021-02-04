@extends('frontend::layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('frontend.home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Search</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <strong class="label text-white">Notes : Do <strong class="text-danger">Ctrl + F</strong> to find your anime</strong>
            <div class="row py-lg-5">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>List On Going Anime</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($on_going->count() > 0)
                            <div class="row">
                                @foreach($on_going as $r_on_going)
                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <a href="{{ route('frontend.detail',$r_on_going->slug) }}">
                                                <li class="list-group-item bg-dark title-anime ">
                                                    <span class="text-white">{{$r_on_going->title}}</span>
                                                </li>
                                            </a>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h5 class="text-white text-center py-4 mb-5">No Result Data Found</h5>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row py-lg-5">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>List All Anime</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($data->count() > 0)
                            <div class="row">
                                @foreach($data as $r_data)
                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <a href="{{ route('frontend.detail',$r_data->slug) }}">
                                                <li class="list-group-item bg-dark title-anime ">
                                                    <span class="text-white">{{$r_data->title}}</span>
                                                </li>
                                            </a>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h5 class="text-white text-center py-4 mb-5">No Result Data Found</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection
