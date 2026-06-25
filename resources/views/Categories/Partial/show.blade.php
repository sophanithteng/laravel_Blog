@extends('layout.Backend')

@section('content')
    <h1>Category details</h1>
    <p><strong>Name:</strong> {{ $category->name }}</p>
    <p><strong>Description:</strong> {{ $category->description }}</p>
    <a class="btn btn-secondary" href="{{route('categories.index')}}">Back</a>
@endsection
