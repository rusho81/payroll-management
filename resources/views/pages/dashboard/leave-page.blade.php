@extends('layout.sidenav-layout')
@section('content')
    @include('components.leave.leave-list')
    @include('components.leave.update-leave')
    @include('components.leave.reject-leave')
@endsection