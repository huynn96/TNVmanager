<?php
  $search = $_SESSION["tnv"];
  $cmt = $search;
  if (isset($_POST["submit"])){
    include_once("connect_db.php");
    $so_cmt = $_POST["so_cmt"];
    $ho_ten = $_POST["ho_ten"];
    $year = $_POST["year"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $date = $_POST["ngay_cap_cmt"];
    $noi_cap_cmt = $_POST["noi_cap_cmt"];

    $sql = "UPDATE tinh_nguyen_vien SET so_cmt='$so_cmt', ho_ten='$ho_ten', year='$year', address='$address', phone='$phone', ngay_cap_cmt='$date', noi_cap_cmt='$noi_cap_cmt' WHERE so_cmt = '$cmt'";
    $query = mysql_query($sql);

    if ($so_cmt != $cmt){
      $sql = "UPDATE tnv_nghien_cuu SET so_cmt='$so_cmt' WHERE so_cmt='$cmt'";
      $query = mysql_query($sql);
    }
    header("location: index.php?page=tnv&tnv=$so_cmt");
  }else{

	include_once("connect_db.php");
	

	$sql = "SELECT * FROM tinh_nguyen_vien WHERE tinh_nguyen_vien.so_cmt='$cmt'";
	$query = mysql_query($sql);
	$num_rows = mysql_num_rows($query);
	
	while ($row = mysql_fetch_array($query)) {
		
	echo "
		<div class='container'>
      <div class='row'>
    
        <div  >
   
          <div class='panel panel-info'>
            <div class='panel-heading'>
              <h3 class='panel-title'>Thông tin cá nhân của tình nguyện viên</h3>
            </div>
            <div class='panel-body'>
              <div class='row'>
                <div class='' col-md-9 col-lg-9 ''> 
                <form method='post' >
                  <table class='table table-user-information'>
                    <tbody>
                      <tr>
                        <td>Số CMT:</td>
                        <td><input type='text' name='so_cmt' value='".$row["so_cmt"]."'class='txt'></td>
                      </tr>
                      <tr>
                        <td>Họ tên:</td>
                        <td><input type='text' name='ho_ten' value='".$row["ho_ten"]."'class='txt'></td>
                      </tr>
                      <tr>
                        <td>Năm sinh:</td>
                        <td><input type='text' name='year' value='".$row["year"]."'class='txt'></td>
                      </tr>
                   
                        
                      <tr>
                        <td>Nơi ở hiện tại:</td>
                        <td><input type='text' name='address' value='".$row["address"]."'class='txt'></td>
                      </tr>
                        <tr>
                        <td>Điện thoại:</td>
                        <td><input type='text' name='phone' value='".$row["phone"]."'class='txt'></td>
                      </tr>
                      <tr>
                        <td>Ngày cấp CMT:</td>
                        <td><input type='text' name='ngay_cap_cmt' value='".$row["ngay_cap_cmt"]."'class='txt'></td>
                      </tr>
                        <td>Nơi cấp CMT:</td>
                        <td><input type='text' name='noi_cap_cmt' value='".$row["noi_cap_cmt"]."'class='txt'></td>
                           
                      </tr>
                      <tr> 
                        <td><input type='submit' name='submit' value='Cập nhật' id='submition'></td>

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
    </div>";
        }
            }
?>
                     
                   