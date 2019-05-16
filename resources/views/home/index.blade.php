@extends('layouts.app')

@section('content')
    @role('Частный инвестор')
        @include('home.chin')
    @elserole('Администратор')
        @include('home.admin')
    @elserole('Андеррайтер')
        @include('home.underwriter')
    @endrole
@endsection
