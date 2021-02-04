@extends('frontend::layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <!-- <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <span>Romance</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    @if(!empty($anime_detail))
        @foreach($anime_detail as $r_anime_detail)
        <section class="anime-details spad">
            <div class="container">
                <div class="anime__details__content">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="anime__details__pic set-bg" data-setbg="{{$r_anime_detail->url_thumbnail}}">
                                <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                <!-- <div class="view"><i class="fa fa-eye"></i> 9141</div> -->
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="anime__details__text">
                                <div class="anime__details__title">
                                    <h3>{{$r_anime_detail->title}}</h3>
                                    <!-- <span>フェイト／ステイナイト, Feito／sutei naito</span> -->
                                </div>
                              <!--   <div class="anime__details__rating">
                                    <div class="rating">
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                    </div>
                                    <span>1.029 Votes</span>
                                </div> -->
                                <p>{{$r_anime_detail->description}}</p>
                                <div class="anime__details__widget">
                                    <div class="row">
                                        <div class="col-lg-15">
                                            <ul>
                                                <li><span>Rating</span> {{$r_anime_detail->rating}} <i class="fa fa-star text-warning"></i></li>
                                                <li><span>Status</span> {{$r_anime_detail->status}}</li>
                                                <li><span>Genre</span>
                                                @if(!empty($r_anime_detail->genre))
                                                    @foreach($r_anime_detail->genre as $genre)
                                                        @if($loop->first)
                                                            <a href="#" class="btn btn-sm btn-secondary text-white mr-1" style="border-radius: 40px !important;">{{ $genre }}</a>
                                                        @else
                                                            <a href="#" class="btn btn-sm btn-secondary text-white mx-1" style="border-radius: 40px !important;">{{ $genre }}</a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="anime__details__btn">
                                    @if(!empty($anime_detail[0]->episode[0]))
                                        <a href="{{route('frontend.watch',[$anime_detail[0]->slug,$anime_detail[0]->episode[0]->slug])}}" class="watch-btn"><span>Watch Now <i class="fa fa-angle-right"></i></span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endforeach
    @endif
    <!-- Anime Section End -->
@endsection

