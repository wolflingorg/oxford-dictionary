@extends('layouts.main')

@section('title', 'Search')
@section('description', 'Description')
@section('page_name', 'search')

@section('content')
    <main>
        @include('partials.search.results')
    </main>
@stop

