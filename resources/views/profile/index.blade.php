@extends('layouts.app')
@section('content')
    @role('Частный инвестор')
    @include('profile.chin.index')
    @elserole('Андеррайтер')
    @include('profile.underwriter.index')
    @endrole
@endsection
@section('script')
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
@endsection