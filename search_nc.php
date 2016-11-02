<link rel='stylesheet' type='text/css' href='css/tnv_search.css'/>

<?php
	include_once("connect_db.php");
	if (isset($_POST["search"])){
		$ma = $_POST["search"];
		$sql = "SELECT * FROM nghien_cuu WHERE id='$ma'";
		$query =  mysql_query($sql);
		$num = mysql_num_rows($query);
		if ($num>0)
			header("location: index.php?page=ds_ct&id_nc=$ma");
		else {
			echo "<script type='text/javascript'>
					if (confirm('Không có nghiên cứu trong dữ liệu!')){
                		location.href= 'index.php';
            		}

				</script>";
		}
	}
?>

<form class="searchform cf" method="POST" action="search_nc.php">
  	<input type="text" name="search" placeholder="Nhập mã nghiên cúu">
  	<button type="submit">Tìm kiếm</button>
</form>

<button id="button" name="add" type="button" class="btn btn-primary" style="display: block;margin:130px 0 0 20px;">Thêm nghiên cứu mới</button>

<script type="text/javascript">
	$('#button').click(function () {
		location.href= 'index.php?page=add_nc';
	})

</script>

