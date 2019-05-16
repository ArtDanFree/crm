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
                        <form id="update_profile_form" method="POST" action="{{  Route('questions.store')  }}" class="form-horizontal form-label-left">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Вопрос:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="{{ $errors->has('question') ? 'parsley-error' : '' }} form-control" rows="3" name="question">{{ old('question') }}</textarea>
                                    @if($errors->has('question'))
                                        <div class="red">{{ $errors->first('question') }}</div>
                                    @endif
                                </div>
                                <input hidden name="user_id" value="{{ auth()->id() }}">
                            </div>
                            <div class="ln_solid"></div>
                            <div class="col-12 text-center">
                                <button id="update-data-profile" class="btn btn-success">Задать</button>
                                <a href="{{ Route('questions.index') }}" class="btn btn-primary">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
