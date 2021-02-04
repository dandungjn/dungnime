@extends('frontend::layouts.app')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                @if(!empty($banner))
                    @foreach($banner as $r_banner)
                    <div class="hero__items set-bg" data-setbg="{{$r_banner->url_banner}}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero__text">
                                    <!-- <div class="label">Adventure</div> -->
                                    <h2>{{$r_banner->title}}</h2>
                                    <p>{{Str::limit($r_banner->description, 150)}}</p>
                                    <a href="{{route('frontend.detail',$r_banner->slug)}}"><span>Selengkapnya ...</span> <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>On Going Anime</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{route('frontend.ongoing')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($ongoing))
                                @foreach($ongoing as $r_ongoing)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{ route('frontend.detail',$r_ongoing->slug) }}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_ongoing->url_thumbnail}}">
                                                    <div class="ep">{{$r_ongoing->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_ongoing->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_ongoing->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_ongoing->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_ongoing->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_ongoing->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="popular__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Popular Shows</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{route('frontend.popular')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($popular))
                                @foreach($popular as $r_popular)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{ route('frontend.detail',$r_popular->slug) }}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_popular->url_thumbnail}}">
                                                    <div class="ep">{{$r_popular->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_popular->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_popular->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_popular->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_popular->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_popular->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="recent__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Recently Added Shows</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{route('frontend.recent')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($recent))
                                @foreach($recent as $r_recent)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ route('frontend.watch',[$r_recent->anime->slug,$r_recent->slug]) }}" class="text-decoration-none">
                                            <div class="product__item__pic set-bg" data-setbg="{{$r_recent->anime->url_thumbnail}}">
                                                <div class="ep">{{$r_recent->anime->rating}}</div>
                                                <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                <div class="view"></i>{{$r_recent->anime->status}}</div>
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @if(!empty($r_recent->genre))
                                                    @foreach($genre as $data_genre)
                                                        @if(in_array($data_genre->name, $r_recent->genre))
                                                            <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <a href="{{ route('frontend.detail',$r_recent->slug) }}" class="text-decoration-none">
                                                <span class="title-anime text-white">{{$r_recent->anime->title}} {{$r_recent->title}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
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
                                    <a href="{{route('frontend.detail',$r_recommended->slug)}}" class="text-decoration-none">
                                        <div class="product__sidebar__view__item set-bg mix day years"
                                            data-setbg="{{$r_recommended->url_thumbnail}}">
                                            <div class="ep">{{$r_recommended->rating}}</div>
                                            <!-- <div class="view"><i class="fa fa-eye"></i> 9141</div> -->
                                            <h5 class="text-white">{{ $r_recommended->title }}</h5>
                                        </div>
                                    </a>
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

