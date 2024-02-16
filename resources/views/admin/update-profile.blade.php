@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <!-- row -->

    <div class="row row-sm">
        <!-- Col -->
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <form class="form" method="post" action="{{route('user.updateProfile',$user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        <div class="main-profile-overview">
                            <div class="mb-4 main-content-label mt-3">Photo</div>

                            <input type="file" class="dropify"  name="avatar"  id="videofile" />
                        </div><!-- main-profile-overview -->

                    </div>
                </div>
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label tx-13 mg-b-25">
                        Conatct
                    </div>
                    <div class="main-profile-contact-list">
                        <div class="mb-4 main-content-label">Contact Info</div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  placeholder="Email" name="email" value="{{$user->email}}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                </div>
                            </div>
                        </div>
{{--                        <div class="form-group ">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <label class="form-label">Website</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-9">--}}
{{--                                    <input type="text" class="form-control"  placeholder="Website" value="@spruko.w">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Phone</label>
                                </div>
                                <div class="col-md-9">
                                    @foreach($user->socials as $socials)
                                    <input type="number" class="form-control"  placeholder="phone number" name="phone" value="{{$socials->phone}}">
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Address</label>
                                </div>
                                <div class="col-md-9">

                                    <input type="text" class="form-control"   name="address" value="{{$user->address}}">
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />


                                </div>
                            </div>
                        </div>
                    </div><!-- main-profile-contact-list -->
                </div>
            </div>
        </div>

        <!-- Col -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 main-content-label">Personal Information</div>

                        <div class="mb-4 main-content-label">Name</div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">User Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="username" value="{{$user->username}}">
                                    <x-input-error :messages="$errors->get('username')" class="mt-2" />

                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">First Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="firstName" value="{{$user->firstName}}">
                                    <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">last Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="lastName" value="{{$user->lastName}}">
                                    <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  name="password" >
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                </div>
                            </div>
                        </div>
                    <div class="mb-4 main-content-label mt-3" id="exampleInput1">About Yourself</div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="form-control" name="about" rows="4" placeholder="">
                                    {{$user->about}}
                                </textarea>
{{--                                <input type="text" class="form-control"  name="about"  value="{{$user->about}}">--}}

                                <x-input-error :messages="$errors->get('about')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                        <div class="mb-4 main-content-label">Social Info</div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Whatsapp</label>
                                </div>
                                <div class="col-md-9">
                                    @foreach($user->socials as $socials)
                                    <input type="number" class="form-control"  name="Whatsapp" value="{{$socials->Whatsapp}}">
                                        <x-input-error :messages="$errors->get('Whatsapp')" class="mt-2" />

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Facebook</label>

                                </div>
                                <div class="col-md-9">
                                    @foreach($user->socials as $socials)

                                    <input type="text" class="form-control"  name="facebook" value="{{$socials->facebook}}">
                                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Linked in</label>
                                </div>
                                <div class="col-md-9">
                                    @foreach($user->socials as $socials)

                                    <input type="text" class="form-control"  name="linkein" value="{{$socials->linkein}}">
                                        <x-input-error :messages="$errors->get('linkein')" class="mt-2" />

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Github</label>
                                </div>
                                <div class="col-md-9">
                                    @foreach($user->socials as $socials)

                                    <input type="text" class="form-control" name="gitHub" value="{{$socials->gitHub}}">
                                        <x-input-error :messages="$errors->get('gitHub')" class="mt-2" />

                                    @endforeach
                                </div>
                            </div>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary ">Update Profile</button>
                </form>

            </div>
        </div>
        <!-- /Col -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
@endsection
