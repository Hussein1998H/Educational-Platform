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


        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{__('messages.AllStudents')}}</h4>
                        <a class="btn btn-primary text-white"  href="{{route('users.create')}}"> {{__('messages.AddStudent')}}</a>

                    </div>
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success text-center " role="alert">
                            {{\Illuminate\Support\Facades\Session::get('success')}}
                        </div>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('failed'))
                        <div class="alert alert-danger text-center " role="alert">
                            {{\Illuminate\Support\Facades\Session::get('failed')}}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <td>{{__('messages.info')}}</td>
                                <th class="border-bottom-0">ID</th>
                                <th class="border-bottom-0">{{__('messages.username')}}</th>
                                <th class="border-bottom-0">{{__('messages.firstName')}}</th>
                                <th class="border-bottom-0">{{__('messages.lastName')}}</th>
                                <th class="border-bottom-0">{{__('messages.address')}}</th>
                                <th class="border-bottom-0">{{__('messages.email')}}</th>
                                <th class="border-bottom-0"></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>

                                    <td></td>
                                    <td>{{$student->id}}</td>
                                    <td>{{$student->username}}</td>
                                    <td>{{$student->firstName}}</td>
                                    <td>{{$student->lastName}}</td>
                                    <td>{{$student->address}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>
                                        <a href="{{route('users.edit',$student)}}" class="btn btn-primary pr-4 pl-4"> {{__('messages.Edit')}}</a>

                                        <form method="post" action="{{route('users.destroy',$student->id)}}" class="d-inline-block p-2 ">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{__('messages.Delete')}}</button>
                                        </form>
                                        <a href="{{route('users.addToAllCourse',$student->id)}}" class="btn btn-success pr-4 pl-4"> {{__('messages.AddToAllCourses')}}</a>
                                        <form method="post" action="{{route('users.AddToCourse',$student->id)}}" class="d-inline-block p-2 ">
                                            @csrf

                                          <div class="d-flex justify-content-center align-items-center">
                                              <button type="submit" class="btn btn-success ml-2">{{__('messages.AddToCourse')}}</button>
                                                  <select class="form-control select2" name="course">
                                                      <option label="Choose one">
                                                      </option>
                                                      @foreach($courses as $course)
                                                          <option value="{{$course->title}}">
                                                              {{$course->title}}
                                                          </option>
                                                      @endforeach

                                                  </select>


                                          </div>                                        </form>
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
