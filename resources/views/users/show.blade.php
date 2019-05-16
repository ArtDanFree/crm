@extends('layouts.app')
@section('content')
    @if($user->hasRole('Частный инвестор'))
        @include('users.chin.index')
    @elseif($user->hasRole('Андеррайтер'))
        @include('users.underwriter.index')
    @endif
@endsection
@section('script')
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
@endsection