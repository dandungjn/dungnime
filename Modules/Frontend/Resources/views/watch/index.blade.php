@extends('frontend::layouts.app')

@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('frontend.home')}}"><i class="fa fa-home"></i> Home</a>
                        @foreach($episode as $r_episode)
                        <span>{{$r_episode->title}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <br><br>
            <div class="anime__details__episodes">
                <div class="section-title">
                    @foreach($episode as $r_episode)
                    <h5>Sedang Menonton {{$r_episode->title}}</h5>
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="product__page__filter">
                        <select onChange="window.location.href=this.value">
                             <option value="#">Pilih Episode</option>
                             @foreach($anime as $r_anime)
                             @foreach($r_anime->episode as $slug_episode)
                            <option value="{{$slug_episode->slug}}">{{$slug_episode->title}}</option>
                             @endforeach
                             @endforeach
                        </select>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    
    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__video__player">
                        @foreach($episode as $r_episode)
                        <video id="player" src="{{$r_episode->link_video}}">
                        </video>
                        @endforeach
                    </div>
                    <!--  <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>Pilih Resolusi</h5>
                        </div>
                        <a href="dungnime.test/p?480">480p</a>
                        <a href="#">720p</a>
                        <a href="#">1080p</a>
s
                    </div> -->

                </div>
            </div>
        </div>
    </section>
    
@endsection
