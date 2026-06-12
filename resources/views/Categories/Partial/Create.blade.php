@extends('layout.backend')

@section('content')
    <h1>Create category</h1>
    @if(Session::has('category_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> {{ session('category_create') }}
    </div>
    @endif
    @if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>Something is Wrong</strong>
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {!! Html::form('POST', route('categories.store'))->open() !!}
    {!! Html::label('Name: ','name') !!}
    {!! Html::input('text', 'name', old('name'))->class('form-control')  !!}
    <br>
    {!! Html::label('Description: ','description') !!}
    {!! Html::textarea('description', old('description'))->class('form-control') !!}
    <br>
    {!! Html::submit('Create')->class('btn btn-primary') !!}
    <a class="btn btn-secondary" href="{{route('categories.index')}}">Back</a>
    {!! Html::form()->close() !!}
@endsection
