@extends('layout')

@section('title', 'Students')

@section('content')
<h1>Students</h1>

<!-- Add Student Button -->
<div style="text-align: center;">
    <a href="{{ route('students.create') }}" class="add-student-btn">Add Student</a>
</div>

<h1>All Students</h1>

@if ($students->isEmpty())
    <p class="no-students">No students found.</p>
@else
    <!-- Students Table -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Roll No</th>
                <th>Branch</th>
                <th>Year of Study</th>
                <th>Title of Course</th>
                <th>Organizing Body</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->Name_Of_The_Student }}</td>
                    <td>{{ $student->Roll_no }}</td>
                    <td>{{ $student->Branch }}</td>
                    <td>{{ $student->Year_Of_Study }}</td>
                    <td>{{ $student->Title_Of_Course }}</td>
                    <td>{{ $student->Organizing_Body }}</td>
                    <td>{{ $student->Duration }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('students.edit', $student) }}" class="edit-btn">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
