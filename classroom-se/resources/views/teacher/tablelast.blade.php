@extends('teacher.layout')
@section('title', 'ผลการลงทะเบียนรายวิชาที่เปิดสอน')
@section('content') 
<?php

// กำหนดวันในสัปดาห์
$daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

// กำหนดช่วงเวลา
$timeSlots = [
    "07:00-07:30", "07:30-08:00", "08:00-08:30", "08:30-09:00", "09:00-09:30", "09:30-10:00",
    "10:00-10:30", "10:30-11:00", "11:00-11:30", "11:30-12:00", "12:00-12:30", "12:30-13:00",
    "13:00-13:30", "13:30-14:00", "14:00-14:30", "14:30-15:00", "15:00-15:30", "15:30-16:00",
    "16:00-16:30", "16:30-17:00", "17:00-17:30", "17:30-18:00", "18:00-18:30", "18:30-19:00",
    "19:00-19:30", "19:30-20:00"
];

// เรียกใช้งาน API หรือดึงข้อมูลจากฐานข้อมูล
// สมมติว่าข้อมูลอาจารย์เป็น $schedule

?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th></th> <!-- คอลัมน์ว่างสำหรับการเว้นระยะ -->
                <?php foreach ($timeSlots as $timeSlot): ?>
                    <th><?php echo $timeSlot; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daysOfWeek as $day): ?>
                <tr>
                    <td><?php echo $day; ?></td>
                    <?php foreach ($timeSlots as $timeSlot): ?>
                        <?php
                            $courseFound = false;
                            foreach ($sbjs as $course) {
                                // ตรวจสอบว่ามีวิชาสอนในวันและเวลานี้หรือไม่
                                if ($course->sbj_day === $day && $course->sbj_start === explode('-', $timeSlot)[0]) {
                                    $courseFound = true;
                                    break;
                                }
                            }
                        ?>
                        <td colspan="1">
                            <?php if ($courseFound): ?>
                                <!-- แสดงข้อมูลวิชา -->
                                <?php echo $course->sbj_id . " - " . $course->sbj_name; ?>
                                <p>ชื่ออาจารย์: {{ $courseData->sbj_teacher_name }}</p>
                                <p>ชื่อวิชา: {{ $courseData->sbj_name }}</p>
                                <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
@endsection