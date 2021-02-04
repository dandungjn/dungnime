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
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Result For : {{ $search }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($data->count() > 0)
                            <div class="row">
                                @foreach($data as $r_data)
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <a href="{{route('frontend.detail',$r_data->slug)}}" class="text-decoration-none">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_data->url_thumbnail}}">
                                                    <div class="ep">{{$r_data->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_data->status}}</div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                         @if(!empty($r_data->genre))
                                                            @foreach($r_data->genre as $genre)
                                                                <li>{{$genre}}</li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                    <h5 class="text-white">{{ $r_data->title }}</h5>
                                                    <p class="text-secondary">{{ substr($r_data->description, 0, 50) }}...</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h5 class="text-white text-center py-4 mb-5">No Result Data Found</h5>
                        @endif
                    </div>
                    <div class="product__pagination">
                      <!--   <a href="#" class="current-page">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>

                         @for($i=1;$i<=$data->lastPage();$i++)
                        a Tag for another page
                       
                        <a href="{{$data->url($i)}}" class="{{ $data->currentPage() ? 'current-page' : '' }}">{{$i}}</a>
                        @endfor -->
                        <a href="" class="text-left" style="width: 100px !important;">Page {{ $data->currentPage() }} of {{ $data->lastPage() }}</a>
                        <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a>
                        <a href="{{ $data->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection
