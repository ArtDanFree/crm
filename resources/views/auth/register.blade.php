@extends('auth.app')

@section('content')
    <div class="login_wrapper">
        <section class="login_content">
            <form id="reg" action="{{ Route('register') }}" method="POST">
                @csrf
                <h1>Регистрация</h1>
                @include('components.validation')
                <div>
                    <input name="first_name" type="text" class="form-control" placeholder="Имя" />
                </div>
                <div>
                    <input name="email" type="email" class="form-control" placeholder="Почта"/>
                </div>
                <div>
                    <input name="password" type="password" class="form-control" placeholder="Пароль"/>
                </div>
                <div>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Подтвердите пароль"/>
                </div>
                <div>
                    <a onclick="$('#reg').submit()" class="btn btn-default submit">Зарегистрироваться</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <a href="{{ Route('login') }}" class="to_register">Войти</a>
                </div>
            </form>
        </section>
    </div>
@endsection


