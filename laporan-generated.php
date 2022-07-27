<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<script type="text/javascript">
    function fnExcelReport()
	{
	    var tab_text="<table class='table-fixed border text-center border-blue-700 w-full mb-24' id='student-table'>";
	    var textRange; var j=0;
	    tab = document.getElementById('student-table'); // id of table

	    for(j = 0 ; j < tab.rows.length ; j++)
	    {
	        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
	        //tab_text=tab_text+"</tr>";
	    }

	    tab_text=tab_text+"</table>";
	    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
	    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
	    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

	    var ua = window.navigator.userAgent;
	    var msie = ua.indexOf("MSIE ");

	    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
	    {
	        txtArea1.document.open("txt/html","replace");
	        txtArea1.document.write(tab_text);
	        txtArea1.document.close();
	        txtArea1.focus();
	        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
	    }
	    else                 //other browser not tested on IE 11
	        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

	    return (sa);
	}
    </script>
<div class="px-6 w-full overflow-auto display-block">
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
        if (isset($_GET['type'])) {
			switch($_GET['type']){
				case "a":
					$type="Mingguan";
			    	$date=date('Y-m-d');
					$start_day=5;
					$end_day=11;
				  	$dayofweek = date('w', strtotime($date));
					if($dayofweek>=5){
						$constant=5;
					}else{
						$constant=-2;
					}
					$start = date('Y-m-d 00:00:00', strtotime(($start_day - ($dayofweek-$constant)-5).' day', strtotime($date)));
					$end = date('Y-m-d 23:59:59', strtotime((6).' day', strtotime($start)));
				break;
				case "b":
					$type="Bulanan";
					$start = date('Y-m-1 00:00:00');
					$end = date('Y-m-t 23:59:59');
				break;
			}
			$sql=$db->prepare("SELECT student_id, student_name, package_name, student_address, student_phone, student_born_place, student_born_date, student_registered_date, student_meeting_remaining FROM student,package where student.package_id=package.package_id AND student_registered_date>='$start' AND student_registered_date<='$end' ORDER BY student_registered_date DESC");
			$sql->execute();
			if($sql->rowCount()==0){
				echo "Siswa tidak ditemukan.";
        }else{?>
		<h1 class="text-4xl text-blue-700 pt-12">Laporan Daftar Siswa Baru</h1>
		<h1 class="text-sm text-blue-700 mb-10"><?php echo "(".$start." - ".$end.")" ?></h1>
		<!-- <a href="#" onclick="tableToExcel('student-table', 'W3C Example Table')">Download</a> -->
		<button id="btnExport" onclick="fnExcelReport();"> EXPORT </button>
        <table class='table-fixed border text-center border-blue-700 w-full mb-24' id='student-table'>

			<caption>Laporan <?php echo $type ?> <?php echo $start ?> - <?php echo $end ?></caption>
            <thead class="bg-blue-700">
              <tr>
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
				<!-- <th class="text-white border text-center border-black">Sisa pertemuan
                  <button type="button" name="button" onClick="sortTable(5)">
                    <i class="fas fa-sort"></i>
                  </button></nobr>
                </th> -->
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
            echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['student_name']."</td>";
            echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['package_name']."</td>";
            // echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['student_address']."</td>";
            echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['student_phone']."</td>";
            // echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['student_born_place'].", ".$result['student_born_date']."</td>";
			echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['student_registered_date']."</td>";
			// if($result['student_meeting_remaining']==999999999){
			// 	echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>Sampai mahir</td>";
			// }else{
			// 	echo "<td class='border text-center px-1 py-4 break-words border-blue-700'>".$result['student_meeting_remaining']."</td>";
			// }
          echo "</tr>";
          $no++;
          }
          echo "
          </tbody>
        </table>
          ";
        }
	}else{
		header("location:index.php");
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
<iframe id="txtArea1" style="display:none"></iframe>
