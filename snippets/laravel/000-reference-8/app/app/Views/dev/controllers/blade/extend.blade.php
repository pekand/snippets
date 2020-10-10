@extends('dev/layouts/layout')

@section('title', 'Page Title')

@section('header')
    @parent

    <p>Extra header content</p>
@endsection

@section('navigation')
<p>Navigation</p>
@endsection

@section('main')
    <p>Content</p>
@endsection


