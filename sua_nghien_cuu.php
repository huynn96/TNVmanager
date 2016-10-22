<head>
    <link rel="stylesheet" type="text/css" href="library/css/bootstrap.css">
    <style type="text/css">
        .form-control {
            display: inline;
            width: 30%;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <?php
  include_once("connect_db.php");
  $ma_nc = $_GET["id_nc"];
?>
        <div id="dsct">
            <?php
    include_once("bangchinhthuc.php");
?>
        </div>
        <select id="select" class="form-control">
            <option value="dsct">Danh sách chính thức</option>
            <option value="mau_mau">Bảng theo dõi mẫu máu</option>
            <option value="uong_thuoc">Bảng theo dõi uống thuốc</option>
        </select>

        <button class="btn btn-default btn-md" onclick="print_table()"><i class="glyphicon glyphicon-print"></i></button>

        <script>
            function print_table() {
                var table = document.getElementById('select').value;

                var printContents = document.getElementById(table).innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                window.location = "index.php";
            }
        </script>
</body>