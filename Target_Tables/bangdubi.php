<?php
$sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.year, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tinh_nguyen_vien.so_cmt, tinh_nguyen_vien.ngay_cap_cmt, tinh_nguyen_vien.noi_cap_cmt, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct='0' ORDER BY tinh_nguyen_vien.ho_ten DESC";
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
            width: 25%;
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

        #dsdb {
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
   .page{
            position: absolute;
            bottom: 0;
            margin: 0 50% 0 50%;
        }
        .bang{
            position: relative;
            height: 185mm;
        }
    </style>
</head>
<?php
$num = mysql_num_rows($query);
$k=2;$i=1;$k=round($num/12);
if ($num %12 < 6)
    $k++;

for ($j=0; $j < $k; $j++) { 
echo"
<div class='bang'>
<p id='p1'>BE Center-NIDQC</p>
<h3>DANH SÁCH NGƯỜI TÌNH NGUYỆN DỰ BỊ</h3>
<p>Tên nghiên cứu:
    ".$ten_nc["ten_nc"]."
</p>
<p>Nghiên cứu số:
     ".$ma_nc."
</p>
<p class='gd' style='font-weight: normal;''></p>
<table style='width:100%'>
    <tr>

        <th class='stt'>STT</th>
        <th class='ma_tnv'>Mã TNV</th>

        <th class='ho_ten'>Họ và tên</th>

        <th class='year'>Năm sinh</th>
        <th class='noi_o'>Nơi ở hiện tại</th>
        <th class='phone'>Điện thoại</th>
        <th class='cmt'>Số CMT</th>
        <th class='date'>Ngày cấp CMT</th>
        <th class='noi_cap'>Nơi cấp CMT</th>
    </tr>";

    while ( ($i<=12*($j+1)) && ($rows = mysql_fetch_array($query))){
        echo "
            <tr>
                <td>".$i."</td>
                <td>".$rows["ma_tnv"]."</td>
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

echo"
</table>
<p style='text-align:right;margin-right: 14%;font-weight: normal;margin-top: 5%'>Ngày&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tháng &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;năm&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
<p id='p1'>Phụ trách lâm sàng
    <br><span>(Ký, ghi rõ họ tên)</span></p>
<p id='p2' style='font-style: normal;margin-right:19%'>Người lập bảng
    <br><span>(Ký, ghi rõ họ tên)</span></p>
    <br>
    <div class='page'><p style='font-size: 10px;font-weight: normal;text-align:center;margin-left: 0; '>".($j+1)."/".$k."</p></div></div>
    ";
}