@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ $user->roles->first()->name }}: {{ fullName($user) }}</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <form id="update_profile_form" method="POST" action="{{  Route('user.update', $user)  }}" class="form-horizontal form-label-left">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Рабочие
                                    время</label>
                                <div class="col-sm-2 col-xs-12 form-group has-feedback">
                                    <input required name="from" type="time" value="{{ old('from', $user->workingTime ? $user->workingTime->from : '') }}" class="form-control has-feedback-left">
                                    <span class="form-control-feedback left" aria-hidden="true">C</span>
                                </div>
                                <div class="col-sm-2 col-xs-12 form-group has-feedback">
                                    <input required name="to" type="time" value="{{ old('from', $user->workingTime ? $user->workingTime->to : '') }}" class="form-control has-feedback-left">
                                    <span class="form-control-feedback left" aria-hidden="true">По</span>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button id="update-data-profile" class="btn btn-success">Сохранить</button>
                                <a href="{{ Route('user.show', $user) }}" class="btn btn-primary">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection