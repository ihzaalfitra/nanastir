<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<style media="screen">
	input#search{
		outline:none;
	}
</style>
<div class="px-6 w-full overflow-auto display-block">
  <h1 class="text-4xl text-blue-700 mb-10 pt-12">Daftar Siswa</h1>
  <a class="float-right mb-5 px-8 py-4 transition duration-300 ease-in-out hover:bg-blue-700 hover:text-white text-blue-700 border border-blue-700 rounded-full text-base" href="index.php?page=add&type=student"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Siswa baru</a>
  <?php
    if(isset($_GET['s'])){
      switch ($_GET['s']) {
        case 'delete':
        ?>
          <p class="text-blue-700">Delete successful.</p>
        <?php
          break;

        default:
          // code...
          break;
      }
    }
        // Prepare a select statement
        $sql=$db->prepare("SELECT student_id, student_name, package_name, student_address, student_phone, student_born_place, student_born_date, student_registered_date, student_meeting_remaining FROM student,package where student.package_id=package.package_id ORDER BY student_registered_date DESC");
        $sql->execute();
        if($sql->rowCount()==0){
          echo "Siswa tidak ditemukan.";
        }else{?>
		<div class="overflow-auto h-full w-full" id="table-wrap">
          <table class="table-fixed border text-center w-full mb-24" id="student-table">
            <thead>
				<tr>
					<th class="bg-white" colspan="8">
						<div class="flex items-center w-full">
							<div style="width:3%;">
								<i class="fas fa-search"></i>
							</div>
							<div style="width:97%;">
								<input type="text" id="search" class="w-full pr-2 py-1" onkeyup="search()" placeholder="Cari nama siswa.." title="Cari nama siswa">
							</div>
						</div>
					</th>
				</tr>
              	<tr class="bg-blue-700">
                	<th class="text-white border text-center border-black">No
                	</th>
	                <th class="text-white border text-center border-black">Nama
	                  <button type="button" name="button" onClick="sortTable(1)">
	                    <i class="fas fa-sort"></i>
	                  </button></nobr>
	                </th>
	                <th class="text-white border text-center border-black">Paket</th>
	                <!-- <th class="text-white border text-center border-black">Alamat</th> -->
	                <th class="text-white border text-center border-black">No. Telp</th>
					<!-- <th class="text-white border text-center border-black">TTL</th> -->
					<th class="text-white border text-center border-black">Tanggal terdaftar
	                  <button type="button" name="button" onClick="sortTable(4)">
	                    <i class="fas fa-sort"></i>
	                  </button></nobr>
	                </th>
					<th class="text-white border text-center border-black">Sisa pertemuan
	                  <button type="button" name="button" onClick="sortTable(5)">
	                    <i class="fas fa-sort"></i>
	                  </button></nobr>
	                </th>
	                <th colspan="2" class="text-white border text-center border-black">Action</th>
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
            echo "<td class='number-col border text-center px-8 py-1 border-blue-700'>".$no."</td>";
            echo "<td class='border text-center px-1 py-1 break-words border-blue-700'>".$result['student_name']."</td>";
            echo "<td class='border text-center px-1 py-1 break-words border-blue-700'>".$result['package_name']."</td>";
            // echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['student_address']."</td>";
            echo "<td class='border text-center px-1 py-1 break-words border-blue-700'>".$result['student_phone']."</td>";
            // echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['student_born_place'].", ".$result['student_born_date']."</td>";
			echo "<td class='border text-center px-1 py-1 break-words border-blue-700'>".$result['student_registered_date']."</td>";
				echo "<td class='border text-center px-1 py-1 break-words border-blue-700'>".$result['student_meeting_remaining']."</td>";

            echo "<td class='border border-blue-700 text-center'>
			<div class=''>
				<div class='w-full float-left border-b border-blue-700'>
					<a class='transition ease-in-out duration-150 hover:underline hover:text-yellow-500 px-4 py-2 text-blue-700' href='index.php?page=jadwal&id=".$result['student_id']."'>Booking</a>
				</div>
				<div class='w-full float-left border-blue-700'>
					<a class='transition ease-in-out duration-150 hover:underline hover:text-yellow-500 px-4 py-2 text-blue-700' href='index.php?page=detail_siswa&filter=".$result['student_id']."'>Detail</a>
				</div>
			</div>
			</td>";
            echo "<td class='border border-blue-700 text-center'>
			<div class=''>
				<div class='w-full float-left border-b border-blue-700'>
					<a class='transition ease-in-out duration-150 hover:underline hover:text-yellow-500 px-4 py-2 text-blue-700' href='index.php?page=add&type=pilihan&id=".$result['student_id']."'>Pilihan</a>
				</div>
				<div class='w-full float-left'>
					<a class='transition ease-in-out duration-150 hover:underline hover:text-red-500 text-black delete-button' href='index.php?page=delete&type=student&id=".$result['student_id']."'><i class='fas fa-trash'></i>&nbsp;Hapus</a>
				</div>
			</div>
			</td>";
          echo "</tr>";
          $no++;
          }
          echo "
          </tbody>
        </table>
		</div>
          ";
        }
       ?>
     <script type="text/javascript">
        $('.delete-button').click(function () {
          return confirm('Hapus data pertemuan?\nDimohon untuk tidak mencentang kotak dibawah (apabila ada) karena dapat menimbulkan error.');
        });
        function sortTable(n) {
          var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
          table = document.getElementById("student-table");
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
          table = document.getElementById("student-table");
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
		function search() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("search");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("student-table");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[1];
		    if (td) {
		      txtValue = td.textContent || td.innerText;
		      if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
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
		document.getElementById("table-wrap").addEventListener("scroll",function(){
		   var translate = "translate(0,"+this.scrollTop+"px)";
		   this.querySelector("thead").style.transform = translate;
		});
     </script>
</div>
