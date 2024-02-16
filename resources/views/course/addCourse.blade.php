
@extends('layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">


    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <!--Internal  Datetimepicker-slider css -->
    <link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
@endsection
@section('content')
            <div class="card-header text-center mt-5">
                <h3 class="card-title">{{__('messages.ADD Course')}}</h3>
            </div>
    <div class="card card-primary ">

        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{route('courses.store')}}">
            @csrf
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success text-center " role="alert">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
            @endif
           <div class="row p-2 ">
               <div class="card-body col-lg-9 col-sm-12 col-ms-9">

                   <div class="form-group">
                       <label for="exampleInputE1">{{__('messages.Title')}}</label>
                       <input type="text" class="form-control" id="exampleInputE1" name="title" >
                       <x-input-error :messages="$errors->get('title')" class="mt-2" />

                   </div>
                   <div class="form-group">
                       <label for="example1">{{__('messages.description')}}</label>
                       <input type="text" class="form-control" id="exampleInput1" name="description">
                       <x-input-error :messages="$errors->get('description')" class="mt-2" />

                   </div>
                   <div class="form-group">
                       <label for="exampleInput4">{{__('messages.Category')}}</label>
                       <select class="form-control select2" name="Category">
                           <option label="Choose one">
                           </option>
                           @foreach($categorys as $cat)
                               <option value="{{$cat->title}}">
                                   {{$cat->title}}
                               </option>
                           @endforeach

                       </select>
                   </div>

                   <div class="form-group">
                       <label>{{__('messages.start_date')}}</label>
                       <div class="row row-sm">
                           <div class="input-group col-md-4">
                               <div class="input-group-prepend">
                                   <div class="input-group-text">
                                       <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                   </div>
                               </div><input class="form-control" id="datetimepicker2" type="text" value="2023-09-01 21:05" name="start_date">
                               <x-input-error :messages="$errors->get('start_date')" class="mt-2" />

                           </div>
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="exampleInput3">{{__('messages.end_date')}}</label>
                       <div class="row row-sm">
                           <div class="input-group col-md-4">
                               <div class="input-group-prepend">
                                   <div class="input-group-text">
                                       <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                   </div>
                               </div><input class="form-control" id="datetimepicker2" type="text" value="2023-09-01 21:05" name="end_date">
                               <x-input-error :messages="$errors->get('end_date')" class="mt-2" />

                           </div>
                       </div>
                   </div>




               </div>
               <div class="col-lg-3 col-sm-12 col-ms-3">
                   <img src="{{URL::asset('assets/img/media/cover.jpg')}}" class="w-100 h-100" alt="logo">

               </div>
           </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{__('messages.add')}}</button>
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
    <script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
@endsection
