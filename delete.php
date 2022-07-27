<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<?php
  if(isset($_GET["id"])){
      $id=mysqli_reaL_escape_string($conn,$_GET["id"]);
      $student_id=mysqli_reaL_escape_string($conn,$_GET["student_id"]);
      switch ($_GET['type']) {
        case 'student':
          $sql=$db->prepare("DELETE FROM student WHERE student_id=:id");
          //binding parameter
          $sql->bindParam(':id', $id);
		  $sql->execute();

		  $sql=$db->prepare("DELETE FROM attendance WHERE student_id=:id");
          //binding parameter
          $sql->bindParam(':id', $id);

          if($sql->execute()){
            // header("location: index.php");
            header("location: index.php?page=daftar_siswa&s=delete");
          }else{
            ?>
            <script type="text/javascript">
              alert("ERR_SQL execution");
            </script>
            <?php
            header("location:index.php");
          }
          break;

          case 'attendance':
			$sql=$db->prepare("DELETE FROM attendance WHERE attendance_id=:id");
			//binding parameter
			$sql->bindParam(':id', $id);

			if($sql->execute()){
				$sql_update=$db->prepare("UPDATE student SET student_meeting_remaining = student_meeting_remaining + 1 WHERE student_id = :student_id");
	  			//binding parameter
	  	        $sql_update->bindParam(':student_id', $student_id);
	  	        if($sql_update->execute()){
					header("location: index.php?page=detail_siswa&s=delete&filter=$student_id");
				}
			}else{
			  ?>
			  <script type="text/javascript">
				alert("ERR_SQL execution");
			  </script>
			  <?php
			  header("location:index.php");
			}
          break;
          default:
            header("location:index.php");
          break;
      }
  }
?>
