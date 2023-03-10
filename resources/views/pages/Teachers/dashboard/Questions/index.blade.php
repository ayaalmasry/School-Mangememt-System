@extends('layouts.master2')
@section('css')
    @toastr_css
@section('title')
   {{trans('main.ListQuessitions')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main.ListQuessitions')}}:{{$quizz->name}}@stop
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
                                <a href="{{route('ques.show',$quizz->id)}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('Questions.Add New Question')}}</a>
                                <br><br>

                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('Questions.Question')}}</th>
                                            <th scope="col">{{trans('Questions.Answer')}}</th>
                                            <th scope="col">{{trans('Questions.Right Answer')}}</th>
                                            <th scope="col">{{trans('Questions.Score')}}</th>
                                            <th scope="col">{{trans('Questions.Quizz Name')}}</th>
                                            <th scope="col">{{trans('Questions.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{$question->answers}}</td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>{{$question->quizze->name}}</td>
                                                <td>
                                                    <a href="{{route('ques.edit',$question->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $question->id }}" title="??????"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('pages.Questions.destroy')
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