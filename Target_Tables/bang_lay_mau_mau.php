<?php
$sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.so_cmt, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct=1 ORDER BY tnv_nghien_cuu.ma_tnv";
$query = mysql_query($sql);
$sql2 = "SELECT ten_nc FROM nghien_cuu WHERE id='$ma_nc'";
$query2 = mysql_query($sql2);
$ten_nc = mysql_fetch_array($query2);
?>
<head>
    <style>
        #mau_mau{
            display: none;
        }
        #mau_mau table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        #mau_mau th, td {
            padding: 1px;
            text-align: center;
        }
        #mau_mau h3{
            text-align: center;
            font-weight: bold;
        }
        .p1 {
            display: inline-block;
            margin-left: 10px;
            font-weight: bold;
        }

        .p2 {
            display: inline;
            font-weight: bold;
            float: right;
        }

        #mau_mau p {
            margin-bottom: 0;
            margin-left: 12%;
        }

        .stt{
            width: 5%;
        }
        .bang{
            position: relative;
            height: 185mm;
        }
        .page{
            position: absolute;
            bottom: 0;
            left: 50%;
        }
        
        .footer{
            position: absolute;
            width: 100%;
            bottom: 0;
        }
        .ma_nc{
            position: absolute;
            bottom: 0;
            right: 0;
            width: 250px;
        }
    </style>
</head>

<?php
$num = mysql_num_rows($query);
$k=2;$i=1;$k=round($num/12);

if (($num %12 < 6) && ($num %12 >0))
    $k++;

for ($j=0; $j < $k; $j++) {
    echo "
<div class='bang'>
<p class='p1'>BE Center-NIDQC</p>
<p class='p2'>BẢNG THEO DÕI LẤY MẪU MÁU NTN</p>
<h3>BẢNG THEO DÕI LẤY MẪU MÁU NTN</h3>
<p><b>Tên nghiên cứu:</b>
    " . $ten_nc["ten_nc"] . "
</p>
<p><b>Nghiên cứu số:</b>
    " . $ma_nc . "
</p>
<p class='gd'></p>
<table style='width: 100%'>
    <tr>
        <th class='stt' rowspan='2'>STT</th>
        <th class='stt' rowspan='2'>Mã TNV</th>
        <th rowspan='2'>Tên TNV</th>
        <th colspan='2'>0h</th>
        <th colspan='2'>10 phút</th>
        <th colspan='2'>20 phút</th>
        <th colspan='2'>30 phút</th>
        <th colspan='2'>40 phút</th>
        <th colspan='2'>50 phút</th>
        <th colspan='2'>60 phút</th>
        <th colspan='2'>70 phút</th>
    </tr>
    <tr>
        <th>Ts</th>
        <th>Tr</th>
        <th>Ts</th>
        <th>Tr</th>
        <th>Ts</th>
        <th>Tr</th>
        <th>Ts</th>
        <th>Tr</th>
        <th>Ts</th>
        <th>Tr</th>
        <th>Ts</th>
        <th>Tr</th>
        <th>Ts</th>
        <th>Tr</th>
        <th>Ts</th>
        <th>Tr</th>
    </tr>";

    while (($i <= 12 * ($j + 1)) && ($rows = mysql_fetch_array($query))) {
        echo "
            <tr>
                <td>" . $i . "</td>
                <td style='font-weight:bold'>" . $rows["ma_tnv"] . "</td>
                <td>" . $rows["ho_ten"] . "</td>";
        list($h, $m) = convert(7, $i + 29);
        if ($m < 10)
            $m = "0" . $m;
        echo "
                <td style='font-weight:bold'>" . $h . "<sup>" . $m . "</sup></td>
                <td></td>";

        list($h, $m) = convert(7, $i + 39);
        if ($m < 10)
            $m = "0" . $m;
        echo "
                <td style='font-weight:bold'>" . $h . "<sup>" . $m . "</sup></td>
                <td></td>";
        list($h, $m) = convert(7, $i + 49);
        if ($m < 10)
            $m = "0" . $m;
        echo "
                <td style='font-weight:bold'>" . $h . "<sup>" . $m . "</sup></td>
                <td></td>";
        list($h, $m) = convert(7, $i + 59);
        if ($m < 10)
            $m = "0" . $m;
        echo "
                <td style='font-weight:bold'>" . $h . "<sup>" . $m . "</sup></td>
                <td></td>";
        list($h, $m) = convert(7, $i + 69);
        if ($m < 10)
            $m = "0" . $m;
        echo "
                <td style='font-weight:bold'>" . $h . "<sup>" . $m . "</sup></td>
                <td></td>";
        list($h, $m) = convert(7, $i + 79);
        if ($m < 10)
            $m = "0" . $m;
        echo "
                <td style='font-weight:bold'>" . $h . "<sup>" . $m . "</sup></td>
                <td></td>";
        list($h, $m) = convert(7, $i + 89);
        if ($m < 10)
            $m = "0" . $m;
        echo "
                <td style='font-weight:bold'>" . $h . "<sup>" . $m . "</sup></td>
                <td></td>";
        list($h, $m) = convert(7, $i + 99);
        if ($m < 10)
            $m = "0" . $m;
        echo "
                <td style='font-weight:bold'>" . $h . "<sup>" . $m . "</sup></td>
                <td></td>
            </tr>";
        $i++;
    }
    echo"
    <tr>
        <td style='font-weight:bold' colspan='3'>Người lấy mẫu</td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
    </tr>
    <tr>
        <td style='font-weight:bold' colspan='3'>Người giám sát</td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
    </tr>
    <tr>
        <td style='font-weight:bold' colspan='3'>Ghi chú</td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
        <td colspan='2'></td>
    </tr>

</table>
<br>
<p><i>Đánh dấu √ vào ô Tr (nếu thời gian lấy mẫu đúng theo dự kiến). Ghi thời gian lấy mẫu thực.<b> Các mẫu máu trong khoảng 10 – 70 phút được phép lấy lệch trong vòng 30 giây, điểm 1,5-2 giờ được phép lấy lệch 1 phút, điểm 3 giờ phép lệch 3 phút; điểm 6 giờ được phép lấy lệch 9 phút ; điểm 12 giờ được phép lệch 15 phút ; điểm 24 giờ được phép lấy lệch trong vòng 30 phút và điểm 48 giờ, 72 giờ được phép lấy lệch trong vòng 1 giờ so với thời gian qui định.</b> Ghi chú cụ thể nếu có gì đặc biệt tại từng thời điểm: NTN khó lấy mẫu, NTN lấy mẫu trực tiếp, NTN phải đổi tay người lấy mẫu (ghi người lấy mẫu).</i></p>
<div class='footer'> 
<div><p style='font-weight:normal;margin-left:10px;'><i>BE/FM/CLI.12.01</i></p></div>
<div class='page'><p style='font-size: 10px;font-weight: normal;text-align:center;margin-left: 0; '>".($j+1)."/".$k."</p></div>
<div class='ma_nc'><p style='font-weight:normal;'><i>Nghiên cứu số:".$ma_nc."</i></p></div>
</div>
</div>
";
}