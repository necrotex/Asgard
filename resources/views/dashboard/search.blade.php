@extends('layouts.dashboard')

@section('PAGE_TITLE', 'SEARCH')
@section('CONTENT_TITLE', 'Search - ' . $term)

@section('content')
    {{dd($results)}}
@endsection
