@extends('layout')

@section('content')
<h1>Add Student</h1>
<form action="{{ route('students.store') }}" method="POST">
    @csrf
    @include('form')
    <button type="submit">Submit</button>
</form>
@endsection
