@extends('layouts.master2')
@section('css')
    @toastr_css
@section('title')
    {{trans('Questions.Edit Question')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('Questions.Edit Question')}} :<span class="text-danger">{{$question->title}}</span>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('ques.update','test') }}" method="post" autocomplete="off">
                                @method('PUT')
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{trans('Questions.Question Name')}}</label>
                                        <input type="text" name="title" id="input-name"
                                               class="form-control form-control-alternative" value="{{$question->title}}">
                                        <input type="hidden" name="id" value="{{$question->id}}">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Questions.Answer')}}</label>
                                        <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4">{{$question->answers}}</textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Questions.Right Answer')}}</label>
                                        <input type="text" name="right_answer" id="input-name" class="form-control form-control-alternative" value="{{$question->right_answer}}">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                   
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Questions.Score')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option selected disabled> {{trans('Questions.Score')}} ...</option>
                                                <option value="5" {{$question->score == 5 ? 'selected':''}}>5</option>
                                                <option value="10" {{$question->score == 10 ? 'selected':''}}>10</option>
                                                <option value="15" {{$question->score == 15 ? 'selected':''}}>15</option>
                                                <option value="20" {{$question->score == 20 ? 'selected':''}}>20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Questions.Save')}}</button>
                            </form>
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