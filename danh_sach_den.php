<?php
include_once ("connect_db.php");
$sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.year, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tinh_nguyen_vien.so_cmt, tinh_nguyen_vien.ngay_cap_cmt, tinh_nguyen_vien.noi_cap_cmt FROM tinh_nguyen_vien WHERE tinh_nguyen_vien.ds_den='1' ORDER BY tinh_nguyen_vien.ho_ten DESC";
$query = mysql_query($sql);
?>

<head>
    <style>
        table {
            font-size: 13px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            line-height: 20px;
            border: 1px solid black;
        }

        .noi_o {
            width: 20%;
        }

        .phone,
        .so_cmt,
        .date,
        .noi_cap {
            width: 10%;
        }

        .ma_tnv,
        .stt {
            width: 3px;
        }

        .year {
            width: 4px;
        }

        td,
        th {
            border: 1px solid black;
            text-align: center;
            padding: 3px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        #p1 {
            display: inline-block;
            margin-left: 14%;
            font-weight: bold;
        }

        #p2 {
            display: inline;
            float: right;
            margin-right: 14%;
            font-weight: bold;
            font-style: italic;
        }

        h3 {
            text-align: center;
        }

        p {
            margin-left: 14%;
            font-weight: bold;
        }

        span {
            font-weight: normal;
        }
    </style>
</head>

<h3>DANH SÁCH ĐEN</h3>

<table style="width:100%">
    <tr>

        <th class="stt">STT</th>
        <th class="ho_ten">Họ và tên</th>
        <th class="year">Năm sinh</th>
        <th class="noi_o">Nơi ở hiện tại</th>
        <th class="phone">Điện thoại</th>
        <th class="cmt">Số CMT</th>
        <th class="date">Ngày cấp CMT</th>
        <th class="noi_cap">Nơi cấp CMT</th>
    </tr>

    <?php

    $i=1;
    while ( $rows = mysql_fetch_array($query)){
        echo "
            <tr>
                <td>".$i."</td>
                <td>".$rows["ho_ten"]."</a></td>
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
