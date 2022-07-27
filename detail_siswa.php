<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<div class="px-6 py-6 w-full overflow-auto display-block">
	<?php if(isset($_GET['filter'])){
		echo "
			<a href='index.php?page=daftar_siswa' class='transition duration-300 ease-in-out hover:bg-gray-200 hover:text-blue-700'>
			  <i class='transition duration-300 ease-in-out hover:bg-blue-700 hover:text-gray-200 text-blue-700 border border-blue-700 p-5 rounded-full text-2xl fas fa-arrow-left'></i>
			</a>";
		$student_id=$_GET['filter'];
		$sql_filter=$db->prepare("SELECT package_name, student_name, student_address, student_phone, student_born_place, student_born_date, student_registered_date, student_meeting_remaining FROM student, package WHERE student.package_id=package.package_id AND student.student_id=$student_id");
        $sql_filter->execute();
		if($result_filter=$sql_filter->FETCH(PDO::FETCH_ASSOC)){
			$student_name=$result_filter['student_name'];
			$package_name=$result_filter['package_name'];
			$student_address=$result_filter['student_address'];
			$student_phone=$result_filter['student_phone'];
			$student_born_place=$result_filter['student_born_place'];
			$student_born_date=$result_filter['student_born_date'];
			$student_registered_date=$result_filter['student_registered_date'];
			$student_meeting_remaining=$result_filter['student_meeting_remaining'];
			$package_name=$result_filter['package_name'];

		}
	} ?>
  <h1 class="text-4xl text-blue-700 mb-10 pt-12">Daftar Pertemuan<?php echo (isset($student_name))?" ".$student_name:""; ?></h1>
  <?php  if(isset($student_name)){
	  ?>
  <table>
  	<tr>
  		<td>Nama siswa</td>
  		<td>:&nbsp;</td>
  		<td><?php echo $student_name; ?></td>
  	</tr>
  	<tr>
  		<td>Paket</td>
  		<td>:&nbsp;</td>
  		<td><?php echo $package_name; ?></td>
  	</tr>
  	<tr>
  		<td>Alamat</td>
  		<td>: </td>
  		<td><?php echo $student_address; ?></td>
  	</tr>
  	<tr>
  		<td>No. Telp</td>
  		<td>: </td>
  		<td><?php echo $student_phone; ?></td>
  	</tr>
  	<tr>
  		<td>Tempat & Tanggal Lahir&nbsp;</td>
  		<td>: </td>
  		<td><?php echo $student_born_place.", ".$student_born_date; ?></td>
  	</tr>
  	<tr>
  		<td>Tanggal Terdaftar</td>
  		<td>: </td>
  		<td><?php echo $student_registered_date; ?></td>
  	</tr>
  	<tr>
  		<td>Sisa Pertemuan</td>
  		<td>: </td>
  		<td><?php echo $student_meeting_remaining; ?></td>
  	</tr>
  </table>
  <?php
		}
    if(isset($_GET['s'])){
      switch ($_GET['s']) {
        case 'delete':
        ?>
		<br>
          <p class="text-blue-700">Berhasil dihapus.</p>
        <?php
          break;

        default:
          // code...
          break;
      }
    }
        // Prepare a select statement
        $sql=$db->prepare("SELECT * FROM attendance WHERE student_id=$student_id ORDER BY attendance_date,attendance_time_slot ASC");
        $sql->execute();
        if($sql->rowCount()==0){
          echo "<br />
		  <p>
		  			Daftar pertemuan tidak ditemukan.
		  		</p>";
        }else{?>
          <table class="table-fixed border text-center border-blue-700 w-full mb-24" id="product-table">
            <thead class="bg-blue-700">
              <tr>
                <th class="text-white border text-center border-black">No</th>
				<th class="text-white border text-center border-black">Tanggal</th>
				<th class="text-white border text-center border-black">Jam</th>
				<th class="text-white border text-center border-black">Mobil</th>
                <th class="text-white border text-center border-black">Action</th>
              </tr>
            </thead>
            <tbody>
        <?php
        $i = 1; //seed to determine background color
        $no=1;
        while($result=$sql->FETCH(PDO::FETCH_ASSOC)){
          echo "<tr class='";
          if($i==0){echo "bg-blue-200";$i=1;}else{$i=0;} //to determine background color
          echo "'>";
            echo "<td class='number-col border text-center px-8 py-4 border-blue-700'>".$no."</td>";
            echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['attendance_date']."</td>";
            echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".toTimeName($result['attendance_time_slot'])."</td>";
			echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".toCarName($result['attendance_car'])."</td>";
            echo "<td class='border border-blue-700 text-center px-4 py-2'><a class='transition ease-in-out duration-300 hover:text-blue-700 text-black underline delete-button' href='index.php?page=delete&type=attendance&student_id=$student_id&id=".$result['attendance_id']."'>Hapus</a></td>";
          echo "</tr>";
          $no++;
          }
          echo "
          </tbody>
        </table>
          ";
        }
       ?>
     <script type="text/javascript">
        $('.delete-button').click(function () {
          return confirm('Hapus data pertemuan?\nDimohon untuk tidak mencentang kotak dibawah (apabila ada) karena dapat menimbulkan error.');
        });
        function sortTable(n) {
          var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
          table = document.getElementById("product-table");
          switching = true;
          // Set the sorting direction to ascending:
          dir = "asc";
          /* Make a loop that will continue until
          no switching has been done: */
          while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
              // Start by saying there should be no switching:
              shouldSwitch = false;
              /* Get the two elements you want to compare,
              one from current row and one from the next: */
              x = rows[i].getElementsByTagName("TD")[n];
              y = rows[i + 1].getElementsByTagName("TD")[n];
              /* Check if the two rows should switch place,
              based on the direction, asc or desc: */
              if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                  // If so, mark as a switch and break the loop:
                  shouldSwitch = true;
                  break;
                }
              } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                  // If so, mark as a switch and break the loop:
                  shouldSwitch = true;
                  break;
                }
              }
            }
            if (shouldSwitch) {
              /* If a switch has been marked, make the switch
              and mark that a switch has been done: */
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
              // Each time a switch is done, increase this count by 1:
              switchcount ++;
            } else {
              /* If no switching has been done AND the direction is "asc",
              set the direction to "desc" and run the while loop again. */
              if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
              }
            }
          }
          sortNumber();
          sortColor();
        }

        function sortColor() {
          var table, rows, switching, i, x, y, shouldSwitch;
          table = document.getElementById("product-table");
          rows = table.rows;
          for (i = 1; i < (rows.length); i++) {
            rows[i].classList.remove("bg-blue-200");
            if(i%2){
              continue;
            }else{
              rows[i].classList.add('bg-blue-200');
            }
          }
        }

        function sortNumber(){
          var number=1;
          var number_index=0;
          $('.number-col').each(function(i, obj) {
            $('.number-col').eq(number_index).html(number);
            number_index++;
            number++;
          });
        }
     </script>
</div>
