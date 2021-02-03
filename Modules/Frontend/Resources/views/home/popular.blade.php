@extends('frontend::layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('frontend.home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Popular Anime</a>
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
                                        <h4>Popular Anime</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($popular))
                                @foreach($popular as $r_popular)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <a href="{{route('frontend.detail',$r_popular->slug)}}" class="text-decoration-none">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_popular->url_thumbnail}}">
                                                    <div class="ep">{{$r_popular->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_popular->status}}</div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                         @if(!empty($r_popular->genre))
                                                            @foreach($r_popular->genre as $genre)
                                                                <li>{{$genre}}</li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                    <h5 class="text-white">{{ $r_popular->title }}</h5>
                                                    <!-- <p class="text-secondary">{{ $r_popular->description }}</p> -->
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="product__pagination">
                      <!--   <a href="#" class="current-page">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>

                         @for($i=1;$i<=$popular->lastPage();$i++)
                        a Tag for another page
                       
                        <a href="{{$popular->url($i)}}" class="{{ $popular->currentPage() ? 'current-page' : '' }}">{{$i}}</a>
                        @endfor -->
                        <a href="{{$popular->previousPageUrl()}}"><i class="fa fa-angle-double-left"></i></a>

                        <a href="{{$popular->nextPageUrl()}}"><i class="fa fa-angle-double-right"></i></a>
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
