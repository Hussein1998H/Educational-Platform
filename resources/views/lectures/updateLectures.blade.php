
@extends('layouts.master')
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


{{--    <link rel="stylesheet" href="{{URL::asset('assets/adminlte/plugins/summernote/summernote-bs4.min.css')}}">--}}


@endsection
@section('content')
    <div class="card-header text-center mt-5">
        <h3 class="card-title">ADD lectures</h3>
    </div>
    <div class="card card-primary ">

        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{route('lectures.update',$lecture->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success text-center " role="alert">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
            @endif
            <div class="row p-2 ">
                <div class="card-body col-lg-9 col-sm-12 col-ms-9">

                    <div class="form-group">
                        <label for="exampleInputE1">{{__('messages.Title')}}</label>
                        <input type="text" class="form-control" id="exampleInputE1" name="title"  value="{{$lecture->title}}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />

                    </div>
                    <div class="form-group">
                        <label for="example1">{{__('messages.content')}}</label>
{{--                        <input type="text" class="form-control" id="exampleInput1" name="content" >--}}
                        <textarea class="form-control" id="exampleInput1" name="content" rows="20">

                            {{$lecture->content}}
                        </textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />

                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-12 mg-t-10 mg-sm-t-0">
                        <input type="file" class="dropify"  data-height="200"  name="video"  id="videofile"/>
{{--                        <input type="file" class="form-control"  name="video"  id="videofile"/>--}}
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-ms-3">
                    <img src="{{URL::asset('assets/img/media/Logo1.png')}}" class="w-100 h-100" alt="logo">

                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{__('messages.Edit')}}</button>
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



{{--    <script src="{{URL::asset('assets/adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>--}}



@endsection
