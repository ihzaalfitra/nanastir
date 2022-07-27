<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
  	$date=date('Y-m-d');
	$start_day=5;
	$end_day=11;
  	$dayofweek = date('w', strtotime($date));
	if($dayofweek>=5){
		$constant=5;
	}else{
		$constant=-2;
	}
	$start_week    = date('Y-m-d 00:00:00', strtotime(($start_day - ($dayofweek-$constant)-5).' day', strtotime($date)));
	$end_week    = date('Y-m-d 23:59:59', strtotime((6).' day', strtotime($start_week)));
	$start_month    = date('Y-m-1 00:00:00');
	$end_month    = date('Y-m-t 23:59:59');
	function getDay($day){
		switch($day){
			case 0:
				return "Minggu";
			break;
			case 7:
				return "Minggu";
			break;
			case 1:
				return "Senin";
			break;
			case 2:
				return "Selasa";
			break;
			case 3:
				return "Rabu";
			break;
			case 4:
				return "Kamis";
			break;
			case 5:
				return "Jum'at";
			break;
			case 6:
				return "Sabtu";
			break;
			default:
				return "error";
			break;
		}
	}
?>
<div class="p-24 w-full overflow-auto display-block">
	<h1 class="text-4xl text-blue-700 mb-10">Home</h1>
  <h1 class="text-xl text-blue-700 mb-10"><?php echo getDay($dayofweek).", ".$date; ?></h1>
  <!-- <h1 class="text-xl text-blue-700 mb-10">Hari : <?php echo $result; ?></h1> -->
  <?php
   	$sql=$db->prepare("SELECT count(student_name) FROM student WHERE student_registered_date>='$start_week' AND 	student_registered_date<='$end_week'");
 	$sql->execute();
	$new_student=null;
	if($result=$sql->FETCH(PDO::FETCH_ASSOC)){
		$new_student=$result['count(student_name)'];
	}
	?>
  <h1 class="text-xl text-blue-700">Siswa baru minggu ini : <?php echo $new_student; ?></h1>
  <h1 class="text-sm text-blue-700 mb-10"><?php echo "(".$start_week." - ".$end_week.")" ?></h1>
  <?php
   	$sql_month=$db->prepare("SELECT count(student_name) FROM student WHERE student_registered_date>='$start_week' AND 	student_registered_date<='$end_week'");
 	$sql_month->execute();
	$new_student_month=null;
	if($result_month=$sql_month->FETCH(PDO::FETCH_ASSOC)){
		$new_student_month=$result_month['count(student_name)'];
	}
	?>
  <h1 class="text-xl text-blue-700">Siswa baru bulan ini : <?php echo $new_student_month; ?></h1>
  <h1 class="text-sm text-blue-700 mb-10"><?php echo "(".$start_month." - ".$end_month.")" ?></h1>
  <!-- <h1 class="text-2xl text-red-700 mb-10"></h1> -->
  <table>

  </table>
</div>
