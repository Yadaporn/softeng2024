<!DOCTYPE html>
<html lang="en">
<title>ลงทะเบียนการขอใช้ห้องในการสอน</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/choose.css') }}"> <!-- Link to CSS file in the public directory -->
    <link rel="stylesheet" href="css/croom.css"> <!-- Link to your CSS file -->


    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    
</head><link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
    
  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-black " style="display:none" id="mySidebar">
    <header>
        <div class="image-text">
            <span class="image">
                {{-- <img src="{{ asset('images/logo1.png') }}" > --}}
            </span>
    
            <div class="text header-text">
              <span class="profession">อาจารย์ภาควิชาวิศวกรรมคอมพิวเตอร์</span>
            </div>
    
        </div>
        {{-- <i class='bx bx-chevron-right toggle'></i> --}}
    </header>

    <button class="w3-bar-item w3-button w3-large w3-padding-large w3-hover-red" 
    onclick="w3_close()">ปิดแถบเมนู </button>
    <a href="registerclass" class="w3-bar-item w3-button w3-padding-large w3-hover-green">ลงทะเบียนรายวิชาที่จะเปิดสอน</a>
    <a href="choosebuild" class="w3-bar-item w3-button w3-padding-large w3-hover-green">ลงทะเบียนการขอใช้ห้องในการสอน</a>
    <a href="result" class="w3-bar-item w3-button w3-padding-large w3-hover-green">ผลการลงทะเบียนรายวิชาที่จะสอน | ห้องในการสอน</a>
    <a href="tablelast" class="w3-bar-item w3-button w3-padding-large w3-hover-green">ตารางสอน</a>
    
    <a href="/" class="w3-bar-item w3-button w3-padding-large w3-hover-red">ออกจากระบบ</a>
</div>

<div id="main">
    <div class="w3-color">
        <button id="openNav" class="w3-button w3-color w3-large" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1 class="w3-font">ระบบจัดตารางสอน</h1>
        </div>
    </div> <div style="padding: 3%">@yield('content')</div>
    <script>
        function w3_open() {
            document.getElementById("main").style.marginLeft = "25%";
            document.getElementById("mySidebar").style.width = "25%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openNav").style.display = 'none';
        }
        
        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";
        }
    </script>  