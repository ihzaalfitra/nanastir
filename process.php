<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  switch ($_POST['operation']) {
    case 'add':
      switch ($_POST['type']) {
        case 'student':
          $package_id=mysqli_reaL_escape_string($conn,$_POST["package_id"]);
          $student_name_default=mysqli_reaL_escape_string($conn,$_POST["student_name"]);
		  $student_name=$student_name_default;
		  	$duplicates=1;
			while(true){
				$sql=$db->prepare("SELECT * FROM student WHERE student_name='".$student_name."'");
				$sql->execute();
				if($result=$sql->FETCH(PDO::FETCH_ASSOC)){
					$duplicates=$duplicates+1;
					$student_name=$student_name_default.$duplicates;
				}else{
					break;
				}
			}
          $student_address=mysqli_reaL_escape_string($conn,$_POST["student_address"]);
          $student_phone=mysqli_reaL_escape_string($conn,$_POST["student_phone"]);
          $student_born_place=mysqli_reaL_escape_string($conn,$_POST["student_born_place"]);
          $student_born_date=mysqli_reaL_escape_string($conn,$_POST["student_born_date"]);
          $student_registered_date=date("Y-m-d h:i:s");
		  switch($package_id){
			  	case 1:
			  		$student_meeting_remaining=5;
					break;
				case 2:
					$student_meeting_remaining=8;
					break;
				default:
					$student_meeting_remaining=10;
					break;
		  }

          $sql=$db->prepare("INSERT INTO student(student_id,package_id,student_name,student_address,student_phone,student_born_place,student_born_date,student_registered_date,student_meeting_remaining) VALUES ('',:package_id,:student_name,:student_address,:student_phone,:student_born_place,:student_born_date,:student_registered_date,:student_meeting_remaining)");
          //binding parameter
		  $sql->bindParam(':package_id', $package_id);
          $sql->bindParam(':student_name', $student_name);
          $sql->bindParam(':student_address', $student_address);
          $sql->bindParam(':student_phone', $student_phone);
          $sql->bindParam(':student_born_place', $student_born_place);
          $sql->bindParam(':student_born_date', $student_born_date);
          $sql->bindParam(':student_registered_date', $student_registered_date);
          $sql->bindParam(':student_meeting_remaining', $student_meeting_remaining);

          if($sql->execute()){
            // header("location: index.php");
            header("location: index.php?page=daftar_siswa");
          }else{
            ?>
            <script type="text/javascript">
              alert("ERR_SQL execution");
            </script>
            <?php
            header("location:index.php");
          }
        break;

        case 'option':
          	$student_id=mysqli_reaL_escape_string($conn,$_POST["student_id"]);

			$sql=$db->prepare("UPDATE student SET student_meeting_remaining = student_meeting_remaining + :add_meeting_input WHERE student_id = :student_id");
			$add_meeting_input=mysqli_reaL_escape_string($conn,$_POST["add_meeting_input"]);
			//binding parameter
			$sql->bindParam(':add_meeting_input', $add_meeting_input);
	        $sql->bindParam(':student_id', $student_id);
	        if($sql->execute()){
	          // header("location: index.php");
	          header("location: index.php?page=daftar_siswa");
	        }else{
	          ?>
	          <script type="text/javascript">
	            alert("ERR_SQL execution");
	          </script>
	          <?php
	          header("location:index.php");
	        }
        break;

		case 'booking':
			$student_id=mysqli_reaL_escape_string($conn,$_POST["student_id"]);
			$attendance_date_year=mysqli_reaL_escape_string($conn,$_POST["attendance_date_year"]);
			$attendance_date_month=mysqli_reaL_escape_string($conn,$_POST["attendance_date_month"]);
			$attendance_date_day=mysqli_reaL_escape_string($conn,$_POST["attendance_date_day"]);
			$attendance_date = $attendance_date_year."-".$attendance_date_month."-".$attendance_date_day;
			$attendance_time_slot=mysqli_reaL_escape_string($conn,$_POST["attendance_time_slot"]);
			$attendance_car=mysqli_reaL_escape_string($conn,$_POST["attendance_car"]);

			$dayofweek = date('w', strtotime($attendance_date));
			$sql_week=$db->prepare("SELECT package_id FROM student WHERE student_id=:student_id AND package_id=4");
			$sql_week->bindParam(':student_id', $student_id);
			$sql_week->execute();
			$row_week_count=$sql_week->rowCount();
			if($row_week_count>0 && $dayofweek != 0 && $dayofweek != 6){
				header("location: index.php?page=add&type=booking&year=$attendance_date_year&month=$attendance_date_month&day=$attendance_date_day&id=".(int)$_POST["student_id"]."&err=cannotweekend");
			}else{
				$sql_check=$db->prepare("SELECT * FROM attendance WHERE student_id=:student_id AND attendance_date=:attendance_date AND attendance_time_slot=:attendance_time_slot");
				$sql_check->bindParam(':student_id', $student_id);
				$sql_check->bindParam(':attendance_date', $attendance_date);
				$sql_check->bindParam(':attendance_time_slot', $attendance_time_slot);
				$sql_check->execute();
				$row_count=$sql_check->rowCount();
				if($row_count>0){
					header("location: index.php?page=add&type=booking&year=$attendance_date_year&month=$attendance_date_month&day=$attendance_date_day&id=$student_id&err=exist_similar");
				}else{
					$sql_update=$db->prepare("UPDATE student SET student_meeting_remaining = student_meeting_remaining - 1 WHERE student_id = :student_id");
					$sql_update->bindParam(':student_id', $student_id);
					$sql_update->execute();

					$sql=$db->prepare("INSERT INTO attendance(student_id,attendance_date,attendance_time_slot, attendance_car) VALUES (:student_id,:attendance_date,:attendance_time_slot,:attendance_car)");
					//binding parameter
					$sql->bindParam(':attendance_date', $attendance_date);
					$sql->bindParam(':attendance_time_slot', $attendance_time_slot);
					$sql->bindParam(':attendance_car', $attendance_car);
					$sql->bindParam(':student_id', $student_id);

			        if($sql->execute()){
			          // header("location: index.php");
			          header("location: index.php?page=add&type=booking&year=$attendance_date_year&month=$attendance_date_month&day=$attendance_date_day");
			        }else{
			          ?>
			          <script type="text/javascript">
			            alert("ERR_SQL execution");
			          </script>
			          <?php
			          header("location:index.php");
			        }
				}
			}
		break;
        default:
            header("location:index.php");
        break;
      }
    break;
    default:
      header("location:index.php");
    break;
  }
}else{
  header("location:index.php");
}
?>
