@extends('layout.backend')
@section('content')
<h1>Category</h1>
<a class="btn btn-primary" href="{{ route('categories.create') }}">New</a>
<br><br>
@if(Session::has('category_delete'))
<div class="alert alert-primary alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Success!</strong> {!! session('category_delete') !!}
</div>
@endif
@if (count($categories) > 0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>
                {{ $category->id }}
            </td>
            <td>
            <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
            </td>
            <td><a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a></td>
            <td>
                    {!! Html::form('DELETE', route('categories.destroy', $category->id))->open() !!}
                        <button onclick="return confirmAction()" class="btn btn-danger delete">Delete</button>
                    {!! Html::form()->close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    function confirmAction() {
        return confirm("Are you sure to delete?");
    }
</script>
@endif
@endsection
