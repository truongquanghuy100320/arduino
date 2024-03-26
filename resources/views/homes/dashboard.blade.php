@extends('layout')
@section('content')
    @php
        $user_id = session('staff_id');
        $staff = App\Models\StaffModel::where('staff_id', $user_id)->first();
    @endphp

    @if($user_id && $staff)
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thông tin nhân viên</h4>
                <p class="card-description">
                    Dựa trên tài khoản đăng nhập
                </p>
                <ul>
                    <li>staff ID: {{ $staff->staff_id }}</li>
                    <li>Email: {{ $staff->email }}</li>
                    <li>Name: {{ $staff->staffname }}</li>
                </ul>
            </div>
        </div>
    @else
        <div class="alert alert-warning">You are not logged in.</div>
    @endif
@endsection
