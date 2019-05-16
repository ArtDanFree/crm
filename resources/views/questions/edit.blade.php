@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Задать вопрос</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <form id="update_profile_form" method="POST" action="{{  Route('questions.update', $question->id)  }}" class="form-horizontal form-label-left">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Вопрос:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" rows="3" disabled>{{ $question->question }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="answer">Ответ:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="{{ $errors->has('answer') ? 'parsley-error' : '' }} form-control" rows="3" name="answer">{{ old('answer', $question->answer) }}</textarea>
                                    @if($errors->has('answer'))
                                        <div class="red">{{ $errors->first('answer') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">What IS</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="">
                                        <label>
                                            <input type="checkbox" class="js-switch" name="what_is" value="1" {{ $question->what_is ? 'checked' : '' }}/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="col-12 text-center">
                                <button id="update-data-profile" class="btn btn-success">Ответить</button>
                                <a href="{{ Route('questions.index') }}" class="btn btn-primary">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <!-- Switchery -->
    <link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
@endsection
@section('script')
    <script src="{{ asset('vendors/switchery/dist/switchery.min.js') }}"></script>
@endsection