@extends('frontend::layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('frontend.home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Recently Added Shows</a>
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
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Recently Added Shows</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($recent))
                                @foreach($recent as $r_recent)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <a href="{{route('frontend.watch',[$r_recent->anime->slug,$r_recent->slug])}}" class="text-decoration-none">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_recent->anime->url_thumbnail}}">
                                                    <div class="ep">{{$r_recent->anime->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_recent->anime->status}}</div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                         @if(!empty($r_recent->anime->genre))
                                                            @foreach($r_recent->anime->genre as $genre)
                                                                <li>{{$genre}}</li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                    <h5 class="text-white">{{$r_recent->anime->title}} {{$r_recent->title}}</h5>
                                                    <!-- <p class="text-secondary">{{ $r_recent->anime->description }}</p> -->
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="product__pagination">
                        <a href="{{$recent->previousPageUrl()}}"><i class="fa fa-angle-double-left"></i></a>

                        <a href="{{$recent->nextPageUrl()}}"><i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Recommended Anime</h5>
                            </div>
                            <div class="filter__gallery">
                                @if(!empty($recommended))
                                    @foreach($recommended as $r_recommended)
                                    <div class="product__sidebar__view__item set-bg mix day years"
                                        data-setbg="{{$r_recommended->url_thumbnail}}">
                                            <div class="ep">{{$r_recommended->rating}}</div>
                                            <!-- <div class="view"><i class="fa fa-eye"></i> 9141</div> -->
                                            <h5><a href="{{route('frontend.detail',$r_recommended->slug)}}">{{$r_recommended->title}}</a></h5>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection
