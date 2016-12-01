<head>
	<style type="text/css">
		#huyet_tuong{
            display: none;
        }

		table {
            font-size: 13px;
            border-collapse: collapse;
            font-family: "Times New Roman";
            width: 100%;
            line-height: 20px;
            border: 1px dotted black;
        }
        td, tr {
            border: 1px dotted black;
            text-align: center;
            padding: 3px;
        }
        .giai_doan{
        	display: inline-block;
        	float: left;
        	margin-left: 20px;
        	font-weight: normal;
        }
        .gio{
        	display: inline-block;
        }
	</style>
</head>
<?php
	$sql = "SELECT tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct='1' ORDER BY tnv_nghien_cuu.ma_tnv";
	$query = mysql_query($sql);
	$sql2 = "SELECT * FROM nghien_cuu WHERE id = '$ma_nc'";
    $query2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($query2);
    $thoi_gian = $row2["thoi_gian"];
 	$thoi_gian_number = strtok($thoi_gian, ", ");
    $thoi_diem_bat_dau = strtok(", ");
    $khoang_cach = strtok(", ");
    $thoi_diem = array();
    for ($i=0; $i < $thoi_gian_number; $i++) { 
        $thoi_diem[$i] = strtok(" ,");
    }
	$ma_tnv = "nothing";$j=10;
	echo "<table>";
	while ($row = mysql_fetch_array($query)){
		$i=0;
		while ($i< $thoi_gian_number) {
			if ($j == 10){
				$j=0;
				echo "<tr>";
			}else{
				echo "<td><b>".$row["ma_tnv"]."</b> &nbsp &nbsp;".$ma_nc."<br><div class=giai_doan></div><div class='gio'><b>".$thoi_diem[$i]."</b></div></td>";
				$j++;
				if ($j == 10)
					echo "</tr>";
				$i++;
			}
		}
	}
	while ($j < 10){
		echo "<td></td>";
		$j++;
	}
	echo "</tr><tr style='height:50px'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	for ($k=0; $k < 2 ; $k++) {
		$i=0;
		while ($i< $thoi_gian_number) {
			if ($j == 10){
				$j=0;
				echo "<tr>";
			}else{
				echo "<td><b>".$ma_nc."</b><br><div class='gio'><b>".$thoi_diem[$i]."<b></div></td>";
				$j++;
				if ($j == 10)
					echo "</tr>";
				$i++;
			}
		}
		while ($j < 10){
			echo "<td></td>";
			$j++;
		}
	}
	echo "</table>";
?>