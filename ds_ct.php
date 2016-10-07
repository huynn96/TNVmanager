<?php
    $ma_nc = $_GET["id_nc"];
    include_once("connect_db.php");

    $sql = "SELECT tnv_nghien_cuu.ma_so, tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.year, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tinh_nguyen_vien.so_cmt, 
            tinh_nguyen_vien.ngay_cap_cmt, tinh_nguyen_vien.noi_cap_cmt FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' ORDER BY tnv_nghien_cuu.ma_so";
    $query = mysql_query($sql);
?>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<table style="width:100%">
    <tr>
            <th>STT</th>
            <th>Mã TNV</th>
            <th>Họ và tên</th>
            <th>Năm sinh</th>
            <th>Nơi ở hiện tại</th>
            <th>Điện thoại</th>
            <th>Số CMT</th>
            <th>Ngày cấp CMT</th>
            <th>Nơi cấp CMT</th>
          </tr>
    
        <?php
        $i=1;
        while ( $rows = mysql_fetch_array($query)){

            echo"<tr>
                <td>".$i."</td>
                <td>".$rows["ma_so"]."</td>
                <td>".$rows["ho_ten"]."</td>
                <td>".$rows["year"]."</td>
                <td>".$rows["address"]."</td>
                <td>".$rows["phone"]."</td>
                <td>".$rows["so_cmt"]."</td>
                <td>".$rows["ngay_cap_cmt"]."</td>
                <td>".$rows["noi_cap_cmt"]."</td>
            </tr>";
            $i++;
        }
        ?>
    
</table>
