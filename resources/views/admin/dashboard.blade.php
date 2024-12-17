<h1>Admin Dashboard</h1>
<form method="POST" action="{{ route('attendances.store') }}">
    @csrf
    <select name="student_id">
        @foreach($students as $student)
        <option value="{{ $student->id }}">{{ $student->username }}</option>
        @endforeach
    </select>
    <input type="date" name="date" required>
    <select name="status">
        <option value="present">Present</option>
        <option value="absent">Absent</option>
        <option value="late">Late</option>
    </select>
    <button type="submit">Add Attendance</button>
</form>

<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $attendance)
        <tr>
            <td>{{ $attendance->student->username }}</td>
            <td>{{ $attendance->date }}</td>
            <td>{{ $attendance->status }}</td>
            <td>
                <form method="POST" action="{{ route('attendances.destroy', $attendance) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
