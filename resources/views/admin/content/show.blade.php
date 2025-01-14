@extends('admin.partials.master')
@section('title')
    Show Content Page
@endsection
@section('main-content')
    <div class="container">
        <h1>{{ $content->title }}</h1>
        <p>{{ $content->content }}</p>
        <a href="{{ route('admin.content.index') }}" class="btn btn-primary">Back to Pages</a>
    </div>
@endsection
