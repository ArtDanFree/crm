@extends('auth.app')

@section('content')
    <div class="login_wrapper">
        <section class="login_content">
            <form id="login" action="{{ Route('login') }}" method="POST">
                @csrf
                <h1>Войти</h1>
                @include('components.validation')
                <div>
                    <input name="email" type="text" class="form-control" placeholder="Почта"/>
                </div>
                <div>
                    <input name="password" type="password" class="form-control" placeholder="Пароль"/>
                </div>
                <div>
                    <a onclick="$('#login').submit()" class="btn btn-default submit">Войти</a>
                    <a class="reset_pass" href="{{ Route('password.request') }}">Забыли пароль?</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <a href="{{ Route('register') }}" class="to_register">Регистрация</a>
                </div>
            </form>
        </section>
    </div>
@endsection
