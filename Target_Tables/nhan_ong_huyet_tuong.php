<head>
	<style type="text/css">
		 table {
            font-size: 13px;
            border-collapse: collapse;
            font-family: "Times New Roman";
            width: 100%;
            line-height: 20px;
            border: 1px dotted black;
        }
         td,
        tr {
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
	$sql = "SELECT * FROM tnv_nghien_cuu WHERE id='$ma_nc' AND ct=1 ORDER BY ma_tnv";
	$query = mysql_query($sql);
	$hour = array("0h","1h","2h","2.5h","3h","3.5h","4h","4.5h","5h","5.5h","6h","7h","8h","10h","12h","24h");
	$ma_tnv = "nothing";$j=10;
	echo "<table>";
	while ($row = mysql_fetch_array($query)){
		$i=0;
		while ($i<16) {
			if ($j == 10){
				$j=0;
				echo "<tr>";
			}else{
				echo "<td><b>".$row["ma_tnv"]."</b> ".$ma_nc."<br><div class=giai_doan></div><div class='gio'><b>".$hour[$i]."</b></div></td>";
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
		while ($i<16) {
			if ($j == 10){
				$j=0;
				echo "<tr>";
			}else{
				echo "<td><b>".$ma_nc."</b><br><div class='gio'><b>".$hour[$i]."</b></div></td>";
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