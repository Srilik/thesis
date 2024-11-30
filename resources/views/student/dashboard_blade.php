<h1>Student Dashboard</h1>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendanceRecords as $record)
        <tr>
            <td>{{ $record->date }}</td>
            <td>{{ $record->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
