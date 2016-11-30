<head>
	<link rel='stylesheet' type='text/css' href='css/sua_profile.css'/>
	<style type="text/css">
		#add{
			display: none;
		}	
	</style>
</head>

<?php
	if(isset($_POST["submit"])){
		include_once("connect_db.php");
		$so_cmt = $_POST["so_cmt"];
		$ho_ten = $_POST["ho_ten"];
		$year = $_POST["year"];
		$address = $_POST["address"];
		$phone = $_POST["phone"];
    	$date = $_POST["ngay_cap_cmt"];
        $note = $_POST["note"];
        if ($date != null)
    	   $date=date('Y-m-d',strtotime($date));
    	$noi_cap_cmt = $_POST["noi_cap_cmt"];

        if ($so_cmt==null && $phone!=null){
            $so_cmt = $phone;
            $so_cmt = str_replace(' ','',$so_cmt);
            $so_cmt .= "(DT)";
        }

        if ($so_cmt!=null && $phone!=null){
        	$sql = "INSERT INTO tinh_nguyen_vien(so_cmt, ho_ten, year, address, phone, ngay_cap_cmt, noi_cap_cmt, ghi_chu) VALUES ('$so_cmt', '$ho_ten', '$year', '$address', '$phone', '$date', '$noi_cap_cmt', '$note')";
        	$query = mysql_query($sql);
        }
        if ($date==null){
            $sql = "UPDATE tinh_nguyen_vien SET ngay_cap_cmt=NULL WHERE so_cmt='$so_cmt'";
            $query = mysql_query($sql);
        }
    	header("location: index.php?page=tnv&tnv=$so_cmt");
	}
?>
<div class='clearfix' style='position:relative;float:right;top:15px;'>
<?php
    include_once('tnv_search.php');
?>
</div>
<div class="alert alert-danger" role="alert">Không tìm thấy tình nguyện viên!</div>
<button id="button" name="add" type="button" class="btn btn-primary" style="display: block;margin-bottom: 10px;">Thêm tình nguyện viên mới</button>
<div id="add">
    <div class='container'>
        <div class='row'>
            <div>

                <div class='panel panel-info'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Thông tin cá nhân của tình nguyện viên</h3>
                    </div>
                    <div class='panel-body'>
                        <div class='row'>
                            <div class='' col-md-9 col-lg-9 ''>
                                <form method='post' action="add_tnv.php">
                                    <table class='table table-user-information'>
                                        <tbody>

                                            <tr>
                                                <td>Họ tên:</td>
                                                <td>
                                                    <input type='text' name='ho_ten' class='txt' required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Năm sinh:</td>
                                                <td>
                                                    <input type='text' name='year' class='txt'>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Nơi ở hiện tại:</td>
                                                <td>
                                                    <input type='text' name='address' class='txt'>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Điện thoại:</td>
                                                <td>
                                                    <input type='text' name='phone' class='txt' required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Số CMT:</td>
                                                <td>
                                                    <input type='text' name='so_cmt' class='txt'>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Ngày cấp CMT:</td>
                                                <td>
                                                    <input type='text' name='ngay_cap_cmt' class='txt' id='date'>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nơi cấp CMT:</td>
                                                <td>
                                                    <input type='text' name='noi_cap_cmt' class='txt'>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Ghi chú:</td>
                                                <td>
                                                    <input type='text' name='note' class='txt'>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type='submit' name='submit' value='Cập nhật' id='submition'>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </form>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$('#button').click(function () {
		$('#add').toggle();
	})
	$(function() {
           $('#date').datepicker({
                dateFormat: 'd-m-yy'
            }); 
        });
 

</script>