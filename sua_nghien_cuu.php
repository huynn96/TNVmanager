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
        <h1>Mã nghiên cứu: <?php echo $ma_nc; ?></h1>
        <select id="select_gd" class="form-control" style="display:inline-block;margin:20px 0 0 20px; width: 150px;">
            <option value="Giai đoạn I">Giai đoạn I</option>
            <option value="Giai đoạn II">Giai đoạn II</option>
            <option value="Giai đoạn III">Giai đoạn III</option>
        </select>
        <input type="text" class="form-control date" name="begin" placeholder="Ngày bắt đầu" style="width: 150px;">
        <input type="text" class="form-control date" name="end" placeholder="Ngày kết thúc" style="width: 150px;">
        <div style="display: block;"></div>
        <select id="select" class="form-control" style="margin:20px 0 0 20px">
            <option value="dsctdb">Danh sách chính thức và dự bị</option>
            <option value="dsct">Danh sách chính thức</option>
            <option value="dsdb">Danh sách dự bị</option>
            <option value="mau_mau">Bảng theo dõi mẫu máu</option>
            <option value="uong_thuoc">Bảng theo dõi uống thuốc</option>
            <option value="uong_thuoc_lay_mau">Bảng thời điểm uống thuốc và lấy mẫu</option>
            <option value="so_tiep_nhan">Sổ tiếp nhận NTN</option>
            <option value="theo_doi_an_sang">Bảng theo dõi NTN ăn sáng</option>
            <option value="theo_doi_an_chinh">Bảng theo dõi NTN dùng bữa ăn chính</option>
        </select>

        <button class="btn btn-default btn-md" style="display: inline-block" onclick="print_table()"><i class="glyphicon glyphicon-print"></i></button>

        <button class="btn btn-default btn-md" style="display: inline-block" onclick="word_table()"><i class="glyphicon glyphicon-download-alt"></i></button>
        <div id="dsctdb">
            <?php
            include_once("Target_Tables/bang_ct_va_db.php");
            ?>
        </div>
        <div id="dsct">
        <?php
            include_once("Target_Tables/bangchinhthuc.php");
        ?>
        </div>
        <div id="dsdb">
            <?php
            include_once("Target_Tables/bangdubi.php");
            ?>
        </div>
        <div id="uong_thuoc">
        <?php
            include_once("Target_Tables/bang_uong_thuoc.php");
        ?>
        </div>
        <div id="mau_mau">
        <?php
            include_once("Target_Tables/bang_lay_mau_mau.php");
        ?>
        </div>
        <div id="uong_thuoc_lay_mau">
            <?php
            include_once("Target_Tables/bang_thoi_diem_uong_thuoc_va_lay_mau.php");
            ?>
        </div>
        <div id="so_tiep_nhan">
            <?php
            include_once("Target_Tables/so_tiep_nhan_NTN.php");
            ?>
        </div>
        <div id="theo_doi_an_sang">
            <?php
            include_once("Target_Tables/bang_theo_doi_NTN_an_sang.php");
            ?>
        </div>
        <div id="theo_doi_an_chinh">
            <?php
            include_once("Target_Tables/bang_theo_doi_NTN_an_chinh.php");
            ?>
        </div>
        

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
            $('.gd').text($('#select_gd').val() + ", " + $("[name='begin']").val() + " - " + $("[name='end']").val());
            var table = document.getElementById('select').value;

            var printContents = document.getElementById(table).innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            window.location = "index.php?id_nc=<?php echo $ma_nc; ?>";
        }

        function word_table() {
            $('.gd').text($('#select_gd').val() + ", " + $("[name='begin']").val() + " - " + $("[name='end']").val());
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
            dateFormat: 'd/m/yy'
        }); 

        $('#select').click(function () {
            if ($('#select').val() == "uong_thuoc_lay_mau"){
                $('#uong_thuoc_lay_mau').toggle();
            }
        })
</script>
<?php
}
}
?>