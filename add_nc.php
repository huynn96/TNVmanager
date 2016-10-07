
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel='stylesheet' type='text/css' href='css/add_nc.css'/>
  <script src="library/jquery-1.12.4.js"></script>
  <script src="library/jquery-ui.js"></script>
      <script>
        $(function() {
           $('#date').datepicker({
                dateFormat: 'd-m-yy'}
            ); 
        });
    </script>
</head>

<?php
    if (isset($_POST["submitbtn"])){
        $ma_nc = $_POST["ma_nc"];
        $ten_nc = $_POST["message"];
        $date = $_POST["date"];
        $date=date('Y-m-d',strtotime($date));
        
        for ($i=0;$i<strlen($ma_nc);$i++)
            if ($ma_nc[$i]==' ')
                $bao_loi = "Mã nghiên cứu không được có dấu cách";
        if ($bao_loi){
            echo "<script>alert(\"$bao_loi\")</script>";
            echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?page=add_nc\">";
        }
        else{

        include("connect_db.php");

        $sql = "SELECT * FROM nghien_cuu WHERE ID='$ma_nc'";
        $query = mysql_query($sql);

        $num_rows = mysql_num_rows($query);
        if ($num_rows>0){
            echo "<script type='text/javascript'>alert('Cập nhật danh sách nghiên cứu');</script>";
        }
        else{
            $sql = "INSERT INTO nghien_cuu(id, ten_nc, date_year) VALUES ('$ma_nc', '$ten_nc', '$date')";
            $query = mysql_query($sql);
            echo "<script type='text/javascript'>alert('Thêm nghiên cứu thành công!');</script>";
            //header("Location: index.php");
        }
        require_once 'xlsx/simplexlsx.class.php';   
        $filename = $_FILES["file"]["tmp_name"];

        function DayToSecond($day) //1900
        {
            return ( $day - 25569 ) * 86400 ; // -70year -> 1970
        }

        if($_FILES["file"]["size"] > 0){
            $data = new SimpleXLSX($filename);
            $field = $data->rows()[0];
            for ($i=1; $i < $data->dimension()[1]; $i++){
                $value = $data->rows()[$i];
                $value[5] = DayToSecond($value[5]);

                $date2=date('Y-m-d',$value[5]);

                //echo "<script type='text/javascript'>alert('$date2');</script>";
                $sql = "INSERT INTO tinh_nguyen_vien($field[0],$field[1],$field[2],$field[3],$field[4],$field[5],$field[6]) VALUES ('$value[0]','$value[1]','$value[2]','$value[3]','$value[4]','$date2','$value[6]')";
                $query = mysql_query($sql);
                if ($i<10){
                    $ma_so = "H0".$i;
                }
                else $ma_so = "H".$i;
                $sql = "INSERT INTO tnv_nghien_cuu(id, so_cmt, ma_so) VALUES ('$ma_nc', '$value[0]','$ma_so')";
                $query = mysql_query($sql);
            }   
        }
        }      
    }
     
?>

<h1>THÊM NGHIÊN CỨU MỚI</h1>
<form id="contactform" name="contact" method="post" action="" enctype="multipart/form-data">
    <p class="note"><span class="req">*</span> Bắt buộc phải điền</p>
    <div class="row">
        <label for="ma_nc">Mã nghiên cứu <span class="req">*</span></label>
        <input type="text" name="ma_nc" id="name" class="txt" tabindex="1" placeholder="Mã nghiên cứu" required>
    </div>

    <div class="row">
        <label for="message">Tên nghiên cứu <span class="req">*</span></label>
        <textarea name="message" id="message" class="txtarea" tabindex="4" required></textarea>
    </div>

    <div class="row">
        <label for="date">Ngày nghiên cứu <span class="req">*</span></label>
        <input type="text" name="date" id="date" class="txt" tabindex="3" placeholder="" required>
    </div>

    <label for="ExampleInputFile">Upload ds <span class="req">*</span></label>
    <input type="file" name="file" id="file">    

    <div class="center">
        <input type="submit" id="submitbtn" name="submitbtn" tabindex="5" value="Submit">
    </div>
</form>