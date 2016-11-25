<?php
$sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct='1' ORDER BY tinh_nguyen_vien.ho_ten DESC";
$query = mysql_query($sql);
$sql2 = "SELECT ten_nc FROM nghien_cuu WHERE id='$ma_nc'";
$query2 = mysql_query($sql2);
$ten_nc = mysql_fetch_array($query2);
?>

<head>
    <style>
        table {
            font-size: 13px;
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

        #so_tiep_nhan {
            display: none;
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
<p id="p1">BE Center-NIDQC</p>
<h3>SỔ TIẾP NHẬN NGƯỜI TÌNH NGUYỆN</h3>
<p>Tên nghiên cứu:
    <?php echo $ten_nc["ten_nc"]; ?>
</p>
<p>Nghiên cứu số:
    <?php echo $ma_nc; ?>
</p>
<p class="gd" style="font-weight: normal;"></p>
<table style="width:100%">
    <tr>
        <th class="stt" rowspan="2">STT</th>
        <th class="ma_tnv" rowspan="2">Mã TNV</th>
        <th class="ho_ten" rowspan="2">Họ và tên</th>
        <th class="noi_o" rowspan="2">Địa chỉ</th>
        <th class="phone" rowspan="2">Điện thoại</th>
        <th colspan="2">Giai đoạn 1<br>Cán bộ trực:<br>Thời gian:</th>
        <th colspan="2">Giai đoạn 2<br>Cán bộ trực:<br>Thời gian:</th>
        <th rowspan="2">Ghi chú</th>
    </tr>
    <tr>
        <td>Giờ đến</td>
        <td>Chữ ký NTN</td>
        <td>Giờ đến</td>
        <td>Chữ ký NTN</td>
    </tr>
    <?php

    $i=1;
    while ( $rows = mysql_fetch_array($query)){
        echo "
            <tr>
                <td>".$i."</td>
                <td>".$rows["ma_tnv"]."</td>
                <td>".$rows["ho_ten"]."</a></td>
                
                <td>".$rows["address"]."</td>
                <td>".$rows["phone"]."</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>";
        $i++;
    }

    ?>

</table>
<p style="text-align:right;margin-right: 14%;font-weight: normal;margin-top: 5%">Ngày&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tháng &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;năm&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
<p id="p1">Phụ trách lâm sàng
    <br><span>(Ký, ghi rõ họ tên)</span></p>
<p id="p2" style="font-style: normal;margin-right:19%">Người lập bảng
    <br><span>(Ký, ghi rõ họ tên)</span></p>