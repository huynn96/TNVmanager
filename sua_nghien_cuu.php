<?php
    include_once("connect_db.php");
    if (isset($_GET["del"])){
        $ma_nc = $_GET["del"];
        $sql = "DELETE FROM nghien_cuu WHERE id='$ma_nc'";
        $query = mysql_query($sql);
        $sql = "DELETE FROM tnv_nghien_cuu WHERE id='$ma_nc'";
        $query = mysql_query($sql);

        header("location: index.php");
    }
    else {
?>
<head>
    <link rel='stylesheet' type='text/css' href='css/add_nc.css'/>

    <style type="text/css">
        .form-control {
            display: inline;
            width: 30%;
            margin-right: 10px;
        }
        #sua{
            display: none;
        }
        #uong_thuoc{
            display: none;
        }
        #mau_mau{
            display: none;
        }
    </style>
</head>

<?php
    $ma_nc = $_GET["id_nc"];
    if (isset($_POST['submitbt'])){
        $id = $_POST["ma_nc"];
        $ten_nc = $_POST["message"];
        $date = $_POST["date"];
        $date=date('Y-m-d',strtotime($date));
        $date2 = $_POST["date2"];
        $date2=date('Y-m-d',strtotime($date2));

        $sql = "UPDATE nghien_cuu SET id='$id', ten_nc='$ten_nc', date_year='$date', date_year_end='$date2' WHERE id='$ma_nc'";
        $query = mysql_query($sql);

        if($id != $ma_nc){
            $sql = "UPDATE tnv_nghien_cuu SET id='$id' WHERE id='$ma_nc'";
            $query = mysql_query($sql);
        }

        header("location: index.php");
    }
    else{
        $sql = "SELECT * FROM nghien_cuu WHERE id = '$ma_nc'";
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        $date = $row["date_year"];
        $date=date('d-m-Y',strtotime($date));  
        $date2 = $row["date_year_end"];
        $date2=date('d-m-Y',strtotime($date2));
        function convert($h,$m)
        {
            while ($m >= 60) {
                $h++;
                $m = $m - 60;
            }
            return array($h,$m);
        }
?>
        <div id="dsct">
        <?php
            include_once("bangchinhthuc.php");
        ?>
        </div>
        <div id="uong_thuoc">
        <?php
            include_once("bang_uong_thuoc.php");
        ?>
        </div>
        <div id="mau_mau">
        <?php
            include_once("bang_lay_mau_mau.php");
        ?>
        </div>
        <select id="select" class="form-control" style="margin:20px 0 0 20px">
            <option value="dsct">Danh sách chính thức</option>
            <option value="mau_mau">Bảng theo dõi mẫu máu</option>
            <option value="uong_thuoc">Bảng theo dõi uống thuốc</option>
        </select>

        <button class="btn btn-default btn-md" style="display: inline-block" onclick="print_table()"><i class="glyphicon glyphicon-print"></i></button>

        <button class="btn btn-default btn-md" style="display: inline-block" onclick="word_table()"><i class="glyphicon glyphicon-download-alt"></i></button>

        <div style="display: block"></div>
        <button name="sua" type="button" class="btn btn-primary" style="display: inline;margin:20px 0 0 20px;">Chỉnh sửa thông tin nghiên cứu</button>

        <?php echo "<div class='xoa' style='display: inline;margin:20px 0 0 20px;''>
                    <a href='sua_nghien_cuu.php?del=".$ma_nc."' type='button' class='btn btn-sm btn-danger' data-toggle='tooltip' title='Xoá nghiên cứu'><i class='glyphicon glyphicon-remove'></i></a>
                </div>" ?>

        <div id="sua">
            <form id="contactform" name="contact" method="post" <?php echo "action='sua_nghien_cuu.php?id_nc=".$ma_nc."'"; ?> >

                <div class="row">
                    <label for="ma_nc">Mã nghiên cứu <span class="req">*</span></label>
                    <input type="text" name="ma_nc" id="name" class="txt" value="<?php echo $row["id"]; ?>" tabindex="1" placeholder="Mã nghiên cứu" required>
                </div>

                <div class="row">
                    <label for="message">Tên nghiên cứu <span class="req">*</span></label> 
                    <textarea name="message" id="message" class="txtarea" tabindex="4" required><?php echo $row["ten_nc"]; ?></textarea>
                </div>

                <div class="row">
                    <label for="date">Ngày nghiên cứu <span class="req">*</span></label>
                    <input type="text" name="date" class="txt date" value="<?php echo $date; ?>" tabindex="3" placeholder="" required>
                    <input type="text" name="date2" class="txt date" value="<?php echo $date2; ?>" tabindex="3" placeholder="" required>
                </div>

                <div class="center">
                    <input type="submit" id="submitbtn" name="submitbt" tabindex="5" value="Cập nhật">
                </div>
            </form>
        </div>

<script src="library/word/FileSaver.js"></script>
<script src="library/word/jquery.wordexport.js"></script>

<script type="text/javascript"> 
        function print_table() {
            var table = document.getElementById('select').value;

            var printContents = document.getElementById(table).innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            window.location = "index.php";
        }

        function word_table() {
            table = $('#select').val();
            table = "#" + table;
            $(table).wordExport();
        }

        $("[name='sua']").click(function() {
            $('#sua').toggle();
        });

        $('.xoa a').click(function (e) {
            e.preventDefault();
            var b=e.target.getAttribute("href");
            if (e.target.type != 'button'){
                b=$(e.target).parent();
                    
                b=$(b).attr("href");
            }
            
            if (confirm('Chắc chắn xoá nghiên cứu?')){
                location.href=b;
            }
        });

        $('.date').datepicker({
            dateFormat: 'd-m-yy'
        }); 

</script>
<?php
}
}
?>