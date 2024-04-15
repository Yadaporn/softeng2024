@extends('accounter.import_layout')
@section('title')
@section('content')

<head>
    <div class="head">
        ห้องปฏิบัติการ
    </div>
    <meta charset="UTF-8">
    <title>Classroom Management</title>
</head>

<body>
    
    <form action="{{ route('update', ['crs_id' => $classroom->crs_id]) }}" method="post">
        @csrf <!-- Include CSRF token for Laravel form submission -->
        อาคาร:
        <input type="text" name="crs_build" value="{{ $classroom->crs_build }}">
    
        ห้อง:
        <input type="text" name="crs_room" value="{{ $classroom->crs_room }}">
    
        จำนวนนิสิต:
        <input type="number" name="crs_Number_of_students" value="{{ $classroom->crs_Number_of_students }}">
    
        <input type="submit" value="อัพเดต" class="btn btn-primary">
    </form>
    <script>
        // JavaScript function for room suggestion (AJAX)
    </script>
</body>

@endsection
