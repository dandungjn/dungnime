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
                    <h5>Pilih Episode</h5>
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
                        <video id="player" src="https://r5---sn-25ge7nsk.googlevideo.com/videoplayback?expire=1612374550&ei=lnEaYJ6rPIKKiwSfy5KgAg&ip=2a04:3543:1000:2310:30da:13ff:fead:6be6&id=4f3be88909df4774&itag=18&source=blogger&mh=xG&mm=31&mn=sn-25ge7nsk&ms=au&mv=m&mvi=5&pl=50&susc=bl&mime=video/mp4&vprv=1&dur=1440.264&lmt=1610489177301219&mt=1612345725&txp=1310224&sparams=expire,ei,ip,id,itag,source,susc,mime,vprv,dur,lmt&sig=AOq0QJ8wRAIgQEyNPjJjILeuaA-Ma6ioCJqcn1dCxYYtihonaORrYuICIDKYWd9oj3Pqv_e6wt_q7rGOuqSKoPUdPwxYmHuU1V1I&lsparams=mh,mm,mn,ms,mv,mvi,pl&lsig=AG3C_xAwRQIhAPIHcnvEtChpVGdMBfVrv3-8Entfd-n9tz9Q6V7qo0aSAiAtc9nIGy_RlwT5eH-o4kWtYZC3kkNMAWvNLvoJXu7-lg%3D%3D">
                        </video>
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
