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
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 1px;
            text-align: center;
        }
        h3{
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
            float: right;
            font-weight: bold;

        }

        p {
            margin-left: 10%;
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
<div class='p1'>BE Center-NIDQC</div>
<div class='p2'><i>BẢNG THEO DÕI LẤY MẪU MÁU NTN</i></div>
<h3>BẢNG THEO DÕI LẤY MẪU MÁU NTN</h3>
<p style='margin-bottom:0;'><b>Tên nghiên cứu:</b>
    " . $ten_nc["ten_nc"] . "
</p>
<p style='margin-bottom:0;'><b>Nghiên cứu số:</b>
    " . $ma_nc . "
</p>
<p class='gd'></p>
<table style='width: 100%'>
    <tr>
        <th class='stt' rowspan='2'>STT</th>
        <th class='stt' rowspan='2'>Mã TNV</th>
        <th rowspan='2'>Tên TNV</th>
        <th colspan='2'><div>0h</div></th>
        <th colspan='2' class='thoi_gian thoi_gian".$j."4'><div></div></th>
        <th colspan='2' class='thoi_gian thoi_gian".$j."5'><div></div></th>
        <th colspan='2' class='thoi_gian thoi_gian".$j."6'><div></div></th>
        <th colspan='2' class='thoi_gian thoi_gian".$j."7'><div></div></th>
        <th colspan='2' class='thoi_gian thoi_gian".$j."8'><div></div></th>
        <th colspan='2' class='thoi_gian thoi_gian".$j."9'><div></div></th>
        <th colspan='2' class='thoi_gian thoi_gian".$j."10'><div></div></th>
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
            <tr class='colu'>
                <td>" . $i . "</td>
                <td style='font-weight:bold'>" . $rows["ma_tnv"] . "</td>
                <td style='text-align: left;padding-left: 10px;'>".$rows["ho_ten"]."</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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

<p><i>Đánh dấu √ vào ô Tr (nếu thời gian lấy mẫu đúng theo dự kiến). Ghi thời gian lấy mẫu thực.<b> Các mẫu máu trong khoảng 10 – 70 phút được phép lấy lệch trong vòng 30 giây, điểm 1,5-2 giờ được phép lấy lệch 1 phút, điểm 3 giờ phép lệch 3 phút; điểm 6 giờ được phép lấy lệch 9 phút ; điểm 12 giờ được phép lệch 15 phút ; điểm 24 giờ được phép lấy lệch trong vòng 30 phút và điểm 48 giờ, 72 giờ được phép lấy lệch trong vòng 1 giờ so với thời gian qui định.</b> Ghi chú cụ thể nếu có gì đặc biệt tại từng thời điểm: NTN khó lấy mẫu, NTN lấy mẫu trực tiếp, NTN phải đổi tay người lấy mẫu (ghi người lấy mẫu).</i></p>
<div class='footer'> 
<div><p style='font-weight:normal;margin-left:10px;margin-bottom:0;'><i>BE/FM/CLI.12.01</i></p></div>
<div class='page'><p style='font-size: 10px;font-weight: normal;text-align:center;margin-left: 0;margin-bottom:0;'>".($j+1)."/".$k."</p></div>
<div class='ma_nc'><p style='font-weight:normal;margin-bottom:0;'><i>Nghiên cứu số:".$ma_nc."</i></p></div>
</div>
</div>
";
}?>
<script type="text/javascript">
    function convert(h,m)
    {
        while (m >= 60) {
            h++;
            m = m - 60;
        }
        while (h>=24){
            h-=24;
        }
        return [h,m];
    }

    function timetominute(t) {
        l = t.charAt(t.length-1);
        n = parseFloat(t.substring(0,t.length-1));
        if (l=='h')
            n=n*60;
        return n;
    }
    i=0;
    $('.colu').each(function () {
        $(this).find("td:eq(" + 3 + ")").html("<b>"+7+"<sup>"+(30+i)+"</b>");
        i++;
    });

    $('th.thoi_gian').on('click',function (e) {
        hien_tai = $(e.target);
        index = $(e.target).index();
        hien_tai.children().replaceWith("<input type='text' name='thoi_gian' size=2>");
        $("[name='thoi_gian']").focus();
        $("[name='thoi_gian']").focusout(function (e1) {
            h=7;m=30;i=30;
            minutes = timetominute($("[name='thoi_gian']").val());
            now=$("[name='thoi_gian']").val();
            hien_tai.children().replaceWith("<div style='display: inline-block'>"+now+"</div>");
            $('.thoi_gian1'+index).children().replaceWith("<div style='display: inline-block'>"+now+"</div>");
            $('.colu').each(function () {
                a = convert(h,minutes+i);
                if (a[1]<10){
                    a[1] = "0"+a[1];
                }
                $(this).find("td:eq(" + (2*(index - 3) + 3)+ ")").html("<b>"+a[0]+"<sup>"+a[1]+"</b>");
                i++;
            })
    
        });
    })

</script> 