
@extends('layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('content')


    <div class="card-header text-center mt-5">
        <h3 class="card-title">Update Category</h3>
    </div>
    <div class="card card-primary ">

        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{route('Categories.update',$category)}}">
            @csrf
            @method('PUT')
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success text-center " role="alert">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
            @endif
            <div class="row p-2 ">
                <div class="card-body col-lg-9 col-sm-12 col-ms-9">

                    <div class="form-group ">
                        <label for="formUN" class="form-label">{{__('messages.Category')}}</label>
                        <input type="text" class="form-control" id="formUN" name="title"  value="{{$category->title}}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="formUN" class="form-label">{{__('messages.description')}}</label>
                        {{--                <textarea name="description	" id="description" class="col-12" cols="50" rows="10"></textarea>--}}
                        <input type="text" name="description" id="" class="form-control" value="{{$category->description}}">
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
@endsection
