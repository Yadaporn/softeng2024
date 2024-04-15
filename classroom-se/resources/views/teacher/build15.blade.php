@extends('teacher.layout')
@section('title', 'ลงทะเบียนการขอใช้ห้องในการสอน')
@section('content') 
<body>
    <div class="top">
        <div class="head">
            ลงทะเบียนการขอใช้ห้องในการสอน
        </div>
        <?php
        // Database configuration
        define('DB_SERVER', 'localhost:3306');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_DATABASE', 'project_se');
        $errorMessage = '';
        
        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $sbj_name = $_POST['sbj_name'];
            $crs_room = $_POST['crs_room'];
            $sbj_day = $_POST['sbj_day'];
            $sbj_start = $_POST['sbj_start'];
            $sbj_end = $_POST['sbj_end'];
        
            // Check for duplicates in the database
            $sql = 'SELECT COUNT(*) FROM status_build15 WHERE st_room = ? AND st_day = ? AND ((st_start < ? AND st_end > ?) OR (st_start < ? AND st_end > ?))';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$crs_room, $sbj_day, $sbj_end, $sbj_start, $sbj_start, $sbj_end]);
            $count = $stmt->fetchColumn();
        
            if ($count > 0) {
                // Duplicate found
                $errorMessage = 'ไม่สามารถใช้ห้องซ้ำในช่วงเวลานี้ได้เนื่องจากมีการลงทะเบียนแล้ว';
            } else {
                // No duplicates, proceed with the database insert
                // Insert logic goes here
            }
        }
        
        // Connect to the database
        try {
            $pdo = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Query to retrieve data from the 'subjects' table
            $stmt = $pdo->query('SELECT * FROM subjects LIMIT 1');
            $subject = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Query for the second dropdown
            $stmt1 = $pdo->query('SELECT sbj_name, sbj_day, sbj_teacher_name,sbj_end,sbj_start FROM subjects');
            $dropdown1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        
            $stmt2 = $pdo->query("SELECT crs_room, crs_Number_of_students FROM tb_build WHERE crs_build = '15'");
            $dropdown2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        
            $stmt3 = $pdo->query('SELECT crs_Number_of_students FROM tb_build WHERE crs_Number_of_students = crs_Number_of_students');
            $classroom = $stmt3->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
        ?>
        <!-- Display the data -->
        <form action="{{ route('classroom.addd') }}" method="post">
            @csrf
            <label for="dropdown1">รายวิชาที่ลงทะเบียนสำเร็จ:</label>
            <select name="sbj_name" id="dropdown1">
                <option value=""></option>
                <?php foreach ($dropdown1 as $option): ?>
                <option value="<?= $option['sbj_name'] ?>" data-teacher="<?= $option['sbj_teacher_name'] ?>"
                    data-day="<?= $option['sbj_day'] ?>" data-start="<?= $option['sbj_start'] ?>"
                    data-end="<?= $option['sbj_end'] ?>">
                    <?= $option['sbj_name'] ?>
                </option>
                <?php endforeach; ?>
            </select>

            <label for="sbj_teacher_name">อาจารย์:</label>
            <input type="text1" id="sbj_teacher_name" name="sbj_teacher_name"
                value="<?= isset($subjects->sbj_teacher_name) ? $subjects->sbj_teacher_name : '' ?>" readonly>

            <label for="dropdown2">ห้องปฏิบัติการ:</label>
            <select name="crs_room" id="dropdown2">
                <option value=""></option>
                <?php foreach ($dropdown2 as $option): ?>
                <option value="<?= $option['crs_room'] ?>" data-students="<?= $option['crs_Number_of_students'] ?>">
                    <?= $option['crs_room'] ?>
                </option>
                <?php endforeach; ?>
            </select>

            <label for="numberInput">จำนวนนักศึกษา:</label>
            <input type="number" id="numberInput" name="crs_Number_of_students"
                value="<?= isset($classroom->Number_of_students) ? $classroom->Number_of_students : '' ?>" readonly>

            <label for="sbj_day">วัน:</label>
            <input type="text" id="sbj_day" name="sbj_day"
                value="<?= isset($subjects->sbj_day) ? $subjects->sbj_day : '' ?>" readonly>

            <label for="sbj_start">เวลาเริ่ม:</label>
            <input type="text" id="sbj_start" name="sbj_start"
                value="<?= isset($subjects->sbj_start) ? $subjects->sbj_start : '' ?>" readonly>

            <label for="sbj_end">เวลาสิ้นสุด:</label>
            <input type="text" id="sbj_end" name="sbj_end"
                value="<?= isset($subjects->sbj_end) ? $subjects->sbj_end : '' ?>" readonly>
            <input type="submit" value="ยืนยัน">

            <!-- Pop-up Modal HTML -->
            @if ($errors->any())
                <div id="errorModal" class="modal" style="display: block;">
                    <div class="modal-content">
                        <div class="image-container">
                            <img src="{{ asset('asset/cross.png') }}" style="width: 80px; height: 80px;">
                        </div>
                        
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                        <!-- OK Button to close the modal -->
                        <div class="button-container">
                            <button type="button" class="ok-btn" onclick="closeModal()">ตกลง</button>

                                <!-- Status Button to redirect to the status page -->
                            <button type="button"onclick="window.location.href='statusbuild15';" class="status-btn">สถานะ</button>
                        </div>
                    </div>
                </div>
            @endif

        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var dropdown = document.getElementById('dropdown2');
                var inputNumber = document.getElementById('numberInput');

                dropdown.addEventListener('change', function() {
                    var selectedOption = dropdown.options[dropdown.selectedIndex];
                    var numberOfStudents = selectedOption.getAttribute('data-students');
                    inputNumber.value = numberOfStudents;
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                var dropdown = document.getElementById('dropdown1');
                var inputText = document.getElementById('sbj_teacher_name');

                dropdown.addEventListener('change', function() {
                    var selectedOption = dropdown.options[dropdown.selectedIndex];
                    var NameTeacher = selectedOption.getAttribute('data-teacher');
                    inputText.value = NameTeacher;
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                var dropdown = document.getElementById('dropdown1');
                var inputText = document.getElementById('sbj_day');

                dropdown.addEventListener('change', function() {
                    var selectedOption = dropdown.options[dropdown.selectedIndex];
                    var day = selectedOption.getAttribute('data-day');
                    inputText.value = day;
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                var dropdown = document.getElementById('dropdown1');
                var inputText = document.getElementById('sbj_start');

                dropdown.addEventListener('change', function() {
                    var selectedOption = dropdown.options[dropdown.selectedIndex];
                    var start = selectedOption.getAttribute('data-start');
                    inputText.value = start;
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                var dropdown = document.getElementById('dropdown1');
                var inputText = document.getElementById('sbj_end');

                dropdown.addEventListener('change', function() {
                    var selectedOption = dropdown.options[dropdown.selectedIndex];
                    var end = selectedOption.getAttribute('data-end');
                    inputText.value = end;
                });
            });

            
            // Get the modal
            var modal = document.getElementById('errorModal');

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            function closeModal() {
                var modal = document.getElementById('errorModal');
                modal.style.display = "none";
            }
        </script>

    </div>
</body>

</html>
@endsection