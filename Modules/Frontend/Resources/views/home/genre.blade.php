@extends('frontend::layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('frontend.home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Genre</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Genre List</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!empty($genre))
                            @foreach($genre as $data)
                                <a href="{{route('frontend.genre-detail',$data->slug)}}" class="btn btn-sm btn-secondary text-white mx-2 my-2" style="border-radius: 40px !important;">
                                    {{ $data->name }}
                                </a>
                            @endforeach
                            <span class="py-5 mb-5"><br><br><br><br><br><br><br><br><br></span>
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
