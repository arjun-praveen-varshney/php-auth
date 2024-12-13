@extends('layout')

@section('content')
<h1>Edit Student</h1>
<form action="{{ route('students.update', $student) }}" method="POST">
    @csrf
    @method('PUT')
    @include('form')
    <button type="submit">Update</button>
</form>
@endsection