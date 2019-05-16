@extends('layouts.app')
@section('content')
    @role('Частный инвестор')
    @include('questions.chin.index')
    @elserole('Администратор')
    @include('questions.admin.index')
    @endrole
@endsection
