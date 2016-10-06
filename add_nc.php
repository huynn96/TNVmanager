
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

    <div class="center">
        <input type="submit" id="submitbtn" name="submitbtn" tabindex="5" value="Submit">
    </div>
</form>
<?php
    if (isset($_POST["submitbtn"])){
        $ma_nc = $_POST["ma_nc"];
        $ten_nc = $_POST["message"];
        $date = $_POST["date"];
        $date=date('Y-m-d',strtotime($date));
 
        $connect_db = mysql_connect("localhost", "root", "");
        $select_db = mysql_select_db("tnv_manager", $connect_db);
        $set_lang = mysql_query("SET NAMES 'utf8'"); 

        $sql = "SELECT * FROM nghien_cuu WHERE ID='$ma_nc'";
        $query = mysql_query($sql);

        $num_rows = mysql_num_rows($query);
        if ($num_rows>0){
            echo "<script type='text/javascript'>alert('Nghiên cứu đã tồn tại!');</script>";
        }
        else{
            $sql = "INSERT INTO nghien_cuu(id, ten_nc, date_year) VALUES ('$ma_nc', '$ten_nc', '$date')";
            $query = mysql_query($sql);
            echo "<script type='text/javascript'>alert('Thêm nghiên cứu thành công!');</script>";
            //header("Location: index.php");
        }
    }
     
?>