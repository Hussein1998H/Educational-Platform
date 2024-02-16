@extends('layouts.master')
@section('css')
@endsection

@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                <img alt="" src="{{URL::asset('images/'.$user->avatar)}}">
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{$user->firstName}}  {{$user->lastName}}</h5>
                                    <p class="main-profile-name-text">{{$user->username}}</p>
                                </div>
                            </div>
                            <h6>{{__('messages.email')}}</h6>
                            <div class="main-profile-bio">
                                {{$user->email}}
                            </div><!-- main-profile-bio -->
                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-md-4 col mb20">--}}
                            {{--                                    <h5>947</h5>--}}
                            {{--                                    <h6 class="text-small text-muted mb-0">Followers</h6>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-md-4 col mb20">--}}
                            {{--                                    <h5>583</h5>--}}
                            {{--                                    <h6 class="text-small text-muted mb-0">Tweets</h6>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-md-4 col mb20">--}}
                            {{--                                    <h5>48</h5>--}}
                            {{--                                    <h6 class="text-small text-muted mb-0">Posts</h6>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <hr class="mg-y-30">
                            <label class="main-content-label tx-13 mg-b-20">Social</label>
                            <div class="main-profile-social-list">
                                <div class="media">
                                    <div class="media-icon bg-danger-transparent text-danger">
                                        <i class="icon ion-md-link"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>{{__('messages.address')}}</span> <span>{{$user->address}}</span>
                                    </div>
                                </div>

                                <div class="media">
                                    <div class="media-icon bg-danger-transparent text-danger">
                                        <i class="icon ion-md-link"></i>
                                    </div>
                                    <div class="media-body">
                                        @foreach($user->socials as $phone)
                                            <span>{{__('messages.phone')}}</span> <span>{{$phone->phone}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-primary-transparent text-primary">
                                        {{--                                        <i class="icon ion-logo-github"></i>--}}
                                        <i class="icon ion-logo-whatsapp"></i>

                                    </div>
                                    <div class="media-body">
                                        @foreach($user->socials as $phone)
                                            <span>{{__('messages.phone')}}</span> <span>{{$phone->Whatsapp}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-primary-transparent text-primary">
                                        <i class="icon ion-logo-github"></i>

                                    </div>
                                    <div class="media-body">
                                        @foreach($user->socials as $phone)
                                            <span>{{__('messages.gitHub')}}</span> <span>{{$phone->gitHub}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-success-transparent text-success">
                                        <i class="icon ion-logo-twitter"></i>
                                    </div>
                                    <div class="media-body">
                                        @foreach($user->socials as $phone)
                                            <span>{{__('messages.facebook')}}</span> <span>{{$phone->facebook}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-info-transparent text-info">
                                        <i class="icon ion-logo-linkedin"></i>
                                    </div>
                                    <div class="media-body">
                                        @foreach($user->socials as $phone)
                                            <span>{{__('messages.linkein')}}</span> <span>{{$phone->linkein}}</span>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-3">

            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">ABOUT ME</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="home">
                            <h4 class="tx-15 text-uppercase mb-3">BIOdata</h4>
                            <p class="m-b-5">{{$user->about}}</p>
                            <hr>
                            <div class="m-t-30">
                                <div class="d-flex justify-content-between border-bottom border-primary py-2 mb-3">
                                    <h4 class="tx-15 text-uppercase mt-3">Education</h4>
                                    <div>
                                        <a class="btn btn-primary" href="{{route('eductions.create')}}">+</a>
                                    </div>
                                </div>
                                @foreach($user->eductions as $educ)
                                    <div class="d-flex justify-content-between">
                                        <div class=" p-t-10">
                                            <h5 class="text-primary m-b-5 tx-14">{{$educ->university}}</h5>
                                            <p class="">{{$educ->description}}</p>
                                            <p><b>{{$educ->start_date}} ---- {{$educ->end_date}}</b></p>
                                            <p class="text-muted tx-13 m-b-0">{{$educ->description}}</p>
                                        </div>
                                        <form method="post" action="{{route('eductions.destroy',$educ->id)}}" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">-</button>
                                        </form>
                                    </div>
                                    <hr>
                                @endforeach
                                <div class="d-flex justify-content-between border-bottom border-primary py-2 mb-3">
                                    <h4 class="tx-15 text-uppercase mt-3">Skills</h4>

                                    <div>
                                        <a class="btn btn-primary" href="{{route('skills.create')}}">+</a>
                                    </div>
                                </div>
                                @foreach($user->skills as $skill)
                                    <div class="d-flex justify-content-between">
                                        <div class=" p-t-10">
                                            <h5 class="text-primary m-b-5 tx-14" id="skillTitle">{{$skill->title}}</h5>
                                            <p class="text-muted tx-13 m-b-0" id="skillDes">{{$skill->description}}</p>
                                        </div>
                                        <form method="post" action="{{route('skills.destroy',$skill->id)}}" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">-</button>
                                        </form>

                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->


@endsection
@section('js')
    {{--    <script>--}}

    {{--        function  HandlingSkill(e){--}}
    {{--           // e.preventDefault();--}}
    {{--            let sktitle=document.getElementById('skillTitle');--}}
    {{--            // let skdes=document.getElementById('skillDes');--}}
    {{--            let title=document.getElementById('title');--}}
    {{--            // let des=document.getElementById('desc');--}}
    {{--            console.log(title.value);--}}
    {{--            sktitle.innerHTML=title.value;--}}
    {{--            // skdes.innerHTML=des.value();--}}
    {{--        }--}}


    {{--    </script>--}}
@endsection
