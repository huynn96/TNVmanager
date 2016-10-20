<?php
    include_once("connect_db.php");
    if (isset($_GET["cmtdel"])){
        $cmt = $_GET["cmtdel"];
        $ma_nc = $_GET["id_nc"];
        $sql = "DELETE FROM tnv_nghien_cuu WHERE id='$ma_nc' AND so_cmt='$cmt'";
        $query = mysql_query($sql);
        header("location: index.php?page=ds_ct&id_nc=$ma_nc");
    }
    else 
    if(isset($_POST["submit"])){
        $ma_nc = $_GET["id_nc"];
        $ho_ten = $_POST["ho_ten"];
        $year = $_POST["year"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $cmt = $_POST["cmt"];
        $date = $_POST["ngay_cap_cmt"];
        $date=date('Y-m-d',strtotime($date));
        $noi_cap_cmt = $_POST["noi_cap_cmt"];

        echo $cmt;
        
        $sql = "INSERT INTO tinh_nguyen_vien(so_cmt, ho_ten, year, address, phone, ngay_cap_cmt, noi_cap_cmt) VALUES ('$cmt', '$ho_ten', '$year', '$address', '$phone', '$date', '$noi_cap_cmt') ";
        $query = mysql_query($sql);
        $sql = "INSERT INTO tnv_nghien_cuu(so_cmt, id) VALUES ('$cmt', '$ma_nc') ";
        $query = mysql_query($sql);
        header("location:index.php?page=ds_ct&id_nc=$ma_nc");
    }
    else{
    $ma_nc = $_GET["id_nc"];

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
        #add{
            float: right;
            margin: 5px 5px 10px 0;
            color:#369;
            text-decoration: none;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px; 
            font-weight: 700;
        }
        #abox{
            position: absolute;
            background: white;
            display: none;
            width: 90%;
            padding: 1px;
            /*height: 100px;*/
            left: 5%;
            top: 35%;
            border: 9px outset #4581e5;
            box-shadow:0 4px 40px rgba(0,0,0,.9);
            -moz-box-shadow:0 4px 40px rgba(0,0,0,.9);
            -webkit-box-shadow:0 4px 40px rgba(0,0,0,.9);
            border-radius: 10px 10px;
            -moz-border-radius: 10px 10px;
            -webkit-border-radius: 10px 10px;
        }
  </style>
    <script>
        $(function() {
           $('#date').datepicker({
                dateFormat: 'd-m-yy'}
            ); 
        });
    </script>
</head>

<table style="width:100%">
    <?php
    $sql2 = "SELECT * FROM nghien_cuu WHERE id='$ma_nc'";
    $query2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($query2);
    echo "<a id='add' href='index.php?page=ds_ct&id_nc=".$ma_nc."&add=1'><i class='glyphicon glyphicon-plus'></i>Thêm mới tình nguyện viên vào danh sách</a>";
    echo "<p style='font-weight: bold'>Mã nghiên cứu: ".$ma_nc."</p><p style='font-weight: bold'>Tên nghiên cứu: ".$row2["ten_nc"]."</p>";
    ?>
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
            <th class="xoa">Xoá</th>
          </tr>
    
<?php
    if (isset($_GET["add"])){
        echo "
            <form method='post'>
            <tr>
                <td></td>
                <td></td>
                <td><input type='text' name='ho_ten' size=15></td>
                <td><input type='text' name='year' size=2></td>
                <td><textarea rows='3' cols='15' name='address'></textarea></td>
                <td><input type='text' name='phone' size=8></td>
                <td><input type='text' name='cmt' size=8></td>
                <td><input type='text' name='ngay_cap_cmt' id='date' size=8></td>
                <td><input type='text' name='noi_cap_cmt' size=8></td>
                <td colspan=2><input type='submit' name='submit' value='Cập nhật' id='submit'></td>
            </tr>
            </form>";
    }
?>
<div id="abox">

</div>

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
                <td><a href='index.php?page=tnv&search=".$rows["so_cmt"]."'>".$rows["ho_ten"]."</a></td>
                <td>".$rows["year"]."</td>
                <td>".$rows["address"]."</td>
                <td>".$rows["phone"]."</td>
                <td>".$rows["so_cmt"]."</td>
                <td>".$rows["ngay_cap_cmt"]."</td>
                <td>".$rows["noi_cap_cmt"]."</td>
                <td><a href='ds_ct.php?cmtdel=".$rows["so_cmt"]."&id_nc=".$ma_nc."' type='button' class='btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a></td>
            </tr>";
            $i++;
        }
    }
?>
    
</table>
<script type="text/javascript">
    $("[name='ho_ten']").click(function () {
        $('body').on("click",nameClick);
    });
    function nameClick(e) {
        if(e.target.name != "ho_ten"){
            var ten = $("[name='ho_ten']").val();
            $('#abox').show();
            ten = ten.replace(/ /g,"+");
            $('#abox').load("ds_search.php?ten="+ten);
            $('body').off("click",nameClick);
        }
    }

</script>