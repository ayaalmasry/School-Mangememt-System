@extends('layouts.master2')
@section('css')
    @toastr_css
@section('title')
   {{trans('main.ListQuizzes')}}@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('main.ListQuizzes')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('quiz.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('Quizz.add new quizz')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Quizz.Quizz Name')}}</th>
                                            <th>{{trans('Quizz.Teacher Name')}}</th>
                                            <th> {{trans('Quizz.Grade')}}</th>
                                            <th>{{trans('Quizz.classe')}} </th>
                                            <th>{{trans('Quizz.section')}}</th>
                                            <th>{{trans('Quizz.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->name}}</td>
                                                <td>{{$quizze->teacher->Name}}</td>
                                                <td>{{$quizze->grade->Name}}</td>
                                                <td>{{$quizze->classroom->Name_Class}}</td>
                                                <td>{{$quizze->section->Name_Section}}</td>
                                                <td>
                                                    <a href="{{route('quiz.edit',$quizze->id)}}"
                                                       class="btn btn-info btn-sm" title="??????????" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $quizze->id }}" title="??????"><i
                                                            class="fa fa-trash"></i></button>
                                                    <a href="{{route('quiz.show',$quizze->id)}}"
                                                       class="btn btn-warning btn-sm" title="?????? ??????????????"role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a href="{{route('student_quizze',$quizze->id)}}"
                                                       class="btn btn-primary btn-sm" title="?????? ???????????? ??????????????????"role="button" aria-pressed="true"><i
                                                            class="fa solid fa-street-view"></i></a>
                                               
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_exam{{$quizze->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('quiz.destroy','test')}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">{{trans('Quizz.Delete Quizz')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{trans('Quizz.Are You Sure From Delete This Quizz?')}}{{$quizze->name}}</p>
                                                                <input type="hidden" name="id" value="{{$quizze->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection