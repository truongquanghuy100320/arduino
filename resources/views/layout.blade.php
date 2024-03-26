<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Regal Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('public/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('public/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendors/jquery-bar-rating/fontawesome-stars-o.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendors/jquery-bar-rating/fontawesome-stars.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('public/images/favicon.png ')}}"/>
    <style>
        .card-header {
            background-color: #ff2590; /* Màu nền */
            border-radius: 10px; /* Bo tròn ô */
            padding: 8px 10px; /* Khoảng cách bên trong */
            color: #fff; /* Màu chữ */
            font-weight: bold; /* Đậm chữ */
            cursor: pointer; /* Con trỏ chuột khi di chuột vào */


        }
        .card-header .btn-link {
            display: inline-block; /* Hiển thị nút dưới dạng hộp chữ nhật */
            font-size: 16px; /* Kích thước chữ */
            color: #ffffff; /* Màu chữ */
            background-color: #ff2590; /* Màu nền của hộp chữ nhật */
            padding: 8px 12px; /* Khoảng cách bên trong */
            border-radius: 10px; /* Bo tròn các góc của hộp chữ nhật */
            text-decoration: none; /* Loại bỏ gạch chân mặc định */
        }
        .custom-header {
            background-color: #ff2590; /* Màu nền */
            border-radius: 10px 10px 0 0; /* Bo tròn các góc của phần header */
            padding: 8px 10px; /* Khoảng cách bên trong */
            color: #fff; /* Màu chữ */
            font-weight: bold; /* Đậm chữ */
            cursor: pointer; /* Con trỏ chuột khi di chuột vào */
        }


        .outer-rectangle {
            width: auto; /* Độ rộng mong muốn */
            height: auto; /* Chiều cao mong muốn */
            background-color: #ff2590; /* Màu nền */
            border-radius: 10px; /* Bo tròn các góc */
            padding: 8px 12px; /* Khoảng cách bên trong */
            color: #fff; /* Màu chữ */
            font-weight: bold; /* Đậm chữ */
            cursor: pointer; /* Con trỏ chuột khi di chuột vào */
            display: inline-block; /* Hiển thị inline với kích thước của nội dung */
            margin: 0; /* Loại bỏ margin */
            border: 2px solid #ff2590; /* Viền màu y */
        }



        .card-header:hover {
            background-color: #d60062; /* Màu nền khi hover */
        }

        .card-body {
            padding: 10px; /* Khoảng cách bên trong */
        }

        /* Định dạng danh sách */
        .nav-link {
            color: #3a9014; /* Màu chữ */
            font-weight: bold; /* Đậm chữ */
        }

        /* Định dạng hover trên danh sách */
        .nav-link:hover {
            color: #007bff; /* Màu chữ khi hover */
        }

    </style>

</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('homes.nav')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('homes.sidebar')
        <!-- partial -->
        <div class="main-panel">
            @yield('content')
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('homes.footer')

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- base:js -->
<script src="{{asset('public/vendors/base/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('public/js/off-canvas.js')}}"></script>
<script src="{{asset('public/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('public/js/template.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="{{asset('public/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('public/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="{{asset('public/js/dashboard.js')}}"></script>
<!-- End custom js for this page-->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
        function updateUserType(select) {
        var selectedRoleName = select.options[select.selectedIndex].text.split('--')[1].trim();
        document.getElementById('exampleInputEmail3').value = selectedRoleName;
    }

</script>
<script>
    function updateUserType(select) {
        var selectedOption = select.options[select.selectedIndex];
        var facultyName = selectedOption.getAttribute('data-name'); // Lấy tên khoa từ attribute data-name
        var randomNumber = Math.floor(100000 + Math.random() * 900000);
        var MSV = facultyName.substring(0, 3) + randomNumber;
        document.getElementById("exampleInputName22").value = MSV;
    }
</script>

<script>
    $(document).ready(function() {
        // Bắt sự kiện click trên hình ảnh nhỏ
        $('.student-image').click(function() {
            // Lấy đường dẫn hình ảnh lớn từ thuộc tính src của hình ảnh nhỏ
            var imgSrc = $(this).attr('src');

            // Hiển thị modal hoặc overlay
            $('#largeImageModal').show();

            // Hiển thị hình ảnh lớn trong modal hoặc overlay
            $('#largeImage').attr('src', imgSrc);
        });

        // Bắt sự kiện click để đóng modal hoặc overlay
        $('.close').click(function() {
            $('#largeImageModal').hide();
        });
    });
</script>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>

</html>

