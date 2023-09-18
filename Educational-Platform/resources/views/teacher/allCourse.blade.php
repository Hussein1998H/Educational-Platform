@extends('layouts.teacher-master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success text-center " role="alert">
                {{\Illuminate\Support\Facades\Session::get('success')}}
            </div>
        @endif
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{__('messages.AllCategory')}}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <td>{{__('messages.info')}}</td>
                                <th class="border-bottom-0">ID</th>
                                <th class="border-bottom-0">{{__('messages.Title')}}</th>
                                <th class="border-bottom-0">{{__('messages.Category')}}</th>
                                <th class="border-bottom-0">{{__('messages.description')}}</th>
                                <th class="border-bottom-0">{{__('messages.start_date')}}</th>
                                <th class="border-bottom-0">{{__('messages.end_date')}}</th>
                                <th class="border-bottom-0"></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $cours)
                                <tr>

                                    <td></td>
                                    <td>{{$cours->id}}</td>
                                    <td>{{$cours->title}}</td>
                                    <td>{{$cours->category->title}}</td>
                                    <td>{{$cours->description}}</td>
                                    <td>{{$cours->start_date}}</td>
                                    <td>{{$cours->end_date}}</td>
                                    <td>

                                        <a href="{{route('lectures.show',$cours->id)}}" class="btn btn-warning pr-4 pl-4"> {{__('messages.AddLecture')}}</a>
                                        <a href="{{route('lectures.alllectures',$cours->id)}}" class="btn btn-warning pr-4 pl-4"> {{__('messages.AllLecture')}}</a>
{{--                                        <a href="{{route('users.showAddToCourse',$cours->id)}}" class="btn btn-success pr-4 pl-4"> {{__('messages.AddStudents')}}</a>--}}

                                    </td>


                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!--/div-->



    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
