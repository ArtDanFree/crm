@extends('layouts.app')
@section('content')
    @role('Частный инвестор')
    @include('profile.chin.edit')
    @elserole('Андеррайтер')
    @include('profile.underwriter.edit')
    @endrole
@endsection
