@extends('layout.dashboard')

{{-- Esconde somente nesta página o cabeçalho "Dashboard / Menu / Dashboard" do layout. --}}
@section('show-page-header', 'false')

@section('content')
    
    @include('admin.banner.listaBanner')

@endsection
