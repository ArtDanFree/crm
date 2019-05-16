@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Пользователи</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                </div>

                                <div class="clearfix"></div>
                                @foreach($users as $user)
                                <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                        <div class="col-sm-12">
                                            <h4 class="brief"><i>{{ $user->roles->first()->name }}</i></h4>
                                            <div class="left col-xs-7">
                                                <h2>{{ fullName($user) }}</h2>
                                                <ul class="list-unstyled">
                                                    @if($user->phone)
                                                    <li><i class="fa fa-phone"></i> {{ $user->phone }}</li>
                                                        @endif
                                                </ul>
                                            </div>
                                            <div class="right col-xs-5 text-center">
                                                <img src="{{ srcAvatar($user) }}" alt="" class="img-circle img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 bottom text-right">
                                            <a href="{{ Route('user.show', $user) }}" class="btn btn-default"><i class="fa fa-user"> </i> Смотреть профиль</a>

                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection