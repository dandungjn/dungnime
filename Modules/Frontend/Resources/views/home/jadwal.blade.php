@extends('frontend::layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('frontend.home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Jadwal Anime</a>
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
                                        <h4>Senin</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($jadwal_senin))
                                @foreach($jadwal_senin as $r_jadwal_senin)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{route('frontend.detail',$r_jadwal_senin->slug)}}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_jadwal_senin->url_thumbnail}}">
                                                    <div class="ep">{{$r_jadwal_senin->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_jadwal_senin->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_jadwal_senin->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_jadwal_senin->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_jadwal_senin->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_jadwal_senin->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Selasa</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($jadwal_selasa))
                                @foreach($jadwal_selasa as $r_jadwal_selasa)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{route('frontend.detail',$r_jadwal_selasa->slug)}}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_jadwal_selasa->url_thumbnail}}">
                                                    <div class="ep">{{$r_jadwal_selasa->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_jadwal_selasa->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_jadwal_selasa->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_jadwal_selasa->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_jadwal_selasa->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_jadwal_selasa->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Rabu</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($jadwal_rabu))
                                @foreach($jadwal_rabu as $r_jadwal_rabu)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{route('frontend.detail',$r_jadwal_rabu->slug)}}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_jadwal_rabu->url_thumbnail}}">
                                                    <div class="ep">{{$r_jadwal_rabu->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_jadwal_rabu->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_jadwal_rabu->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_jadwal_rabu->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_jadwal_rabu->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_jadwal_rabu->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Kamis</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($jadwal_kamis))
                                @foreach($jadwal_kamis as $r_jadwal_kamis)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{route('frontend.detail',$r_jadwal_kamis->slug)}}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_jadwal_kamis->url_thumbnail}}">
                                                    <div class="ep">{{$r_jadwal_kamis->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_jadwal_kamis->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_jadwal_kamis->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_jadwal_kamis->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_jadwal_kamis->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_jadwal_kamis->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Jumat</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($jadwal_jumat))
                                @foreach($jadwal_jumat as $r_jadwal_jumat)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{route('frontend.detail',$r_jadwal_jumat->slug)}}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_jadwal_jumat->url_thumbnail}}">
                                                    <div class="ep">{{$r_jadwal_jumat->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_jadwal_jumat->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_jadwal_jumat->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_jadwal_jumat->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_jadwal_jumat->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_jadwal_jumat->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Sabtu</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($jadwal_sabtu))
                                @foreach($jadwal_sabtu as $r_jadwal_sabtu)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{route('frontend.detail',$r_jadwal_sabtu->slug)}}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_jadwal_sabtu->url_thumbnail}}">
                                                    <div class="ep">{{$r_jadwal_sabtu->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_jadwal_sabtu->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_jadwal_sabtu->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_jadwal_sabtu->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_jadwal_sabtu->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_jadwal_sabtu->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                    </div>
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Minggu</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($jadwal_minggu))
                                @foreach($jadwal_minggu as $r_jadwal_minggu)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{route('frontend.detail',$r_jadwal_minggu->slug)}}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_jadwal_minggu->url_thumbnail}}">
                                                    <div class="ep">{{$r_jadwal_minggu->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_jadwal_minggu->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    @if(!empty($r_jadwal_minggu->genre))
                                                        @foreach($genre as $data_genre)
                                                            @if(in_array($data_genre->name, $r_jadwal_minggu->genre))
                                                                <li><a href="{{ route('frontend.genre-detail', $data_genre->slug) }}" class="text-white">{{ $data_genre->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <a href="{{ route('frontend.detail',$r_jadwal_minggu->slug) }}" class="">
                                                    <span class="title-anime text-white">{{$r_jadwal_minggu->title}}</span>
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
