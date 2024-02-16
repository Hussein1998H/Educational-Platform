

@extends('layouts.teacher-master')

@section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">


    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">

@endsection
@section('content')
    <div class="card-header text-center  mt-2">
        <h3 class="card-title">ADD Users</h3>
    </div>
    <div class=" p-3 card card-primary mb-0">


        <form  class="form" method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
            @csrf
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success text-center " role="alert">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 ">

        <div class="mb-3 form-group">
            <label for="formUN" class="form-label">{{__('messages.username')}}</label>
            <input type="text" class="form-control" id="formUN" name="username" >
            <x-input-error :messages="$errors->get('username')" class="mt-2" />

        </div>
        <div class="mb-3">
            <label for="formFN" class="form-label">{{__('messages.firstName')}}</label>
            <input type="text" class="form-control" id="formFN"  name="firstName">
            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />

        </div>
        <div class="mb-3">
            <label for="formUN" class="form-label">{{__('messages.lastName')}}</label>
            <input type="text" class="form-control" id="formUN" name="lastName">
            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />

        </div>
        <div class="mb-3">
            <label for="formFN" class="form-label">{{__('messages.password')}}</label>
            <input type="password" class="form-control" id="formFN" name="password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>
        <div class="mb-3">
            <label for="formFN" class="form-label">{{__('messages.gender')}}</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male">
                <label class="form-check-label mx-2" for="inlineRadio1">{{__('messages.Male')}}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female">
                <label class="form-check-label mx-2" for="inlineRadio2">{{__('messages.FeMale')}}</label>
            </div>
            <div class=" col">
                <label for="formUN" class="form-label">{{__('messages.Role')}}</label>
                <select class="form-select form-control" name="role">
                    <option value="student" selected>student</option>
                </select>
            </div>
        </div>
    </div>
                <div class="col-lg-4  d-flex justify-content-center  flex-column">
{{--                   <div class="text-center">--}}
{{--                        <img src="{{URL::asset('assets/img/faces/6.jpg')}}" class="rounded" alt="..." id="my-image" style="width: 75%;height: 100%" >--}}
{{--                    </div>--}}
{{--                        <input class="form-control" type="file" id="formFile" name="avatar">--}}
                        <input type="file" class="dropify"  name="avatar"  id="videofile" />
{{--                        <input type="file"  name="avatar"  id="videofile" />--}}

                </div>
                <div class="mb-3 col">
                    <label for="formUN" class="form-label">{{__('messages.email')}}</label>
                    <input type="text" class="form-control" id="formUN" name="email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>
                <div class="mb-3 col">
                    <label for="formFN" class="form-label">{{__('messages.address')}}</label>
                    <input type="text" class="form-control" id="formFN" name="address">
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />

                </div>
                <div class="mb-3 col">
                    <label for="formFN" class="form-label">{{__('messages.phone')}}</label>
                    <input type="text" class="form-control" id="formFN" name="phone">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center ">
                <button type="submit" class="btn btn-primary w-50 mt-3 p-3 " > {{__('messages.Create')}}</button>

            </div>
        </form>
    </div>
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Moment js -->
    <script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
    <!--Internal Apexchart js-->
    <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('assets/js/index.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>



    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>



{{--    <script>--}}
{{--        // استدعاء الدالة عند اختيار الصورة--}}
{{--        $('#formFile').change(function() {--}}
{{--            // الحصول على ملف الصورة--}}
{{--            var file = this.files[0];--}}
{{--            // الحصول على مسار الصورة--}}
{{--            var reader = new FileReader();--}}
{{--            reader.onload = function(event) {--}}
{{--                // تعيين مسار الصورة كقيمة لخاصية src في عنصر الصورة--}}
{{--                $('#my-image').attr('src', event.target.result);--}}
{{--            };--}}
{{--            reader.readAsDataURL(file);--}}
{{--        });--}}
{{--    </script>--}}
@endsection
