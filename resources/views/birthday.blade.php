@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Ближайшие дни рождения </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ФИО</th>
                                    <th>Когда</th>
                                    <th>Возраст</th>
                                    <th>Родился</th>
                                </tr>
                                </thead>
                                <tbody id="leads_table">
                                @foreach($birthdays as $user)
                                    <tr>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->when }}</td>
                                        <td>{{ $user->age }}</td>
                                        <td>{{ $user->date }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection