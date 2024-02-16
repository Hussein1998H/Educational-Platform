
@extends('layouts.student-master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
    @foreach($courses as $course)

<div class="col-lg-6 col-md-6 col-sm-12 mt-4 ">
    <div class="card bg-secondary tx-white bd-0 p-3" >
        <div class="card-body row">

            <div class="col-9 ">
                <h5 class="card-title tx-white tx-medium mg-b-10">{{$course->title}}</h5>
                <p class="card-subtitle mg-b-15 tx-white-8">{{$course->category->title}}</p>
                <p class="card-text text-center">{{$course->description}}</p>

                <a href="{{route('lectures.alllectures',$course->id)}}" class=" btn btn-outline-info tx-white-7 hover-white text-center"> {{__('messages.AllLecture')}}</a>
                {{--            <a class="card-link tx-white-7 hover-whitetext-center" href="#">Another link</a>--}}

            </div>
            <div class="col-3 p-0">
                <img src="{{URL::asset('assets/img/media/cover.jpg')}}" class="w-100 h-100" alt="logo">
            </div>
             </div>
    </div>
</div>
    @endforeach
</div>

    <!-- Container closed -->
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
@endsection



