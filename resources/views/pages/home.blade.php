@extends('layouts.main')

@section('title', 'Main')
@section('description', 'Description')
@section('page_name', 'home')

@section('content')
    <main>
        @include('partials.home.searchbox')
    </main>
@stop

