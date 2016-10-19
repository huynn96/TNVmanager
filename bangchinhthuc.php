<?php
    $sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.year, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tinh_nguyen_vien.so_cmt, 
            tinh_nguyen_vien.ngay_cap_cmt, tinh_nguyen_vien.noi_cap_cmt FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' ORDER BY tinh_nguyen_vien.so_cmt";
    $query = mysql_query($sql);
?>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="library/jquery-1.12.4.js"></script>
  <script src="library/jquery-ui.js"></script>
  <style>
        table {
            font-size: 13px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            line-height: 20px;
            border: 1px solid black;
        }

        .noi_o{
            width: 20%;
        }
        .phone, .so_cmt, .date, .noi_cap{
            width: 10%;
        }
        .ma_tnv,.stt{
            width: 3px;
        }
        .year{
            width: 4px;
        }
        
        td, th {
            border: 1px solid black;
            text-align: center;
            padding: 3px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        #dsct{
            /*display: none;*/
        }
    </style>
</head>

    <table style="width:100%">
    <tr>
            <th class="stt">STT</th>
            <th class="ma_tnv">Mã TNV</th>
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
            if ($i<10)
                $ma = "H0".$i;
            else $ma = "H".$i;
  
            echo "
            <tr>
                <td>".$i."</td>
                <td>".$ma."</td>
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