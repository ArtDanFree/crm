@extends('layouts.app')
@section('content')
 @role('Частный инвестор')
 @include('leads.chin.index')
 @elserole('Андеррайтер')
 @include('leads.underwriter.index')
    @endrole
@endsection