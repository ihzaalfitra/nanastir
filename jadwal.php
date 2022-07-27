<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>

<link href="custom.css" rel="stylesheet" type="text/css">
<div class="px-6 py-6 w-full overflow-auto display-block">
	<?php if(isset($_GET['filter'])){
		echo "
			<a href='index.php?page=daftar_siswa' class='transition duration-300 ease-in-out hover:bg-gray-200 hover:text-blue-700'>
			  <i class='transition duration-300 ease-in-out hover:bg-blue-700 hover:text-gray-200 text-blue-700 border border-blue-700 p-5 rounded-full text-2xl fas fa-arrow-left'></i>
			</a>";
		$student_id=$_GET['filter'];
		$sql_filter=$db->prepare("SELECT package_name, student_name, student_address, student_phone, student_born_place, student_born_date, student_registered_date, student_meeting_remaining FROM student, package WHERE student.package_id=package.package_id AND student_id=$student_id");
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
			if($student_meeting_remaining==999999999){
				$student_meeting_remaining="Sampai mahir";
			}
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
	?>
  <?php
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
	?>
	<div class="calendar" id="calendar">
    <div class="calendar-btn month-btn bg-blue-700 text-yellow-500 hover:text-blue-700 hover:bg-yellow-500" onclick="$('#months').toggle('fast')">
        <span id="curMonth"></span>
        <div id="months" class="months dropdown"></div>
    </div>

    <div class="calendar-btn year-btn bg-blue-700 text-yellow-500 hover:text-blue-700 hover:bg-yellow-500" onclick="$('#years').toggle('fast')">
        <span id="curYear"></span>
        <div id="years" class="years dropdown"></div>
    </div>

    <div class="clear"></div>

    <div class="calendar-dates">
        <div class="days">
            <div class="day label text-red-500">MINGGU</div>
            <div class="day label">SENIN</div>
            <div class="day label">SELASA</div>
            <div class="day label">RABU</div>
            <div class="day label">KAMIS</div>
            <div class="day label">JUM'AT</div>
            <div class="day label">SABTU</div>

            <div class="clear"></div>
        </div>

        <div id="calendarDays" class="days">
        </div>
    </div>
</div>

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
          // Make a loop that will continue until no switching has been done:
          while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            // Loop through all table rows (except the first, which contains table headers):
            for (i = 1; i < (rows.length - 1); i++) {
              // Start by saying there should be no switching:
              shouldSwitch = false;
              // Get the two elements you want to compare, one from current row and one from the next:
              x = rows[i].getElementsByTagName("TD")[n];
              y = rows[i + 1].getElementsByTagName("TD")[n];
              // Check if the two rows should switch place, based on the direction, asc or desc:
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
              // If a switch has been marked, make the switch and mark that a switch has been done:
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
              // Each time a switch is done, increase this count by 1:
              switchcount ++;
            } else {
              // If no switching has been done AND the direction is "asc", set the direction to "desc" and run the while loop again.
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

		var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var startYear = 2020;
		var endYear = 2050;
		var month = 0;
		var year = 0;

		function loadCalendarMonths() {
		    for (var i = 0; i < months.length; i++) {
		        var doc = document.createElement("div");
		        doc.innerHTML = months[i];
		        doc.classList.add("dropdown-item");

		        doc.onclick = (function () {
		            var selectedMonth = i;
		            return function () {
		                month = selectedMonth;
		                document.getElementById("curMonth").innerHTML = months[month];
		                loadCalendarDays();
		                return month;
		            }
		        })();

		        document.getElementById("months").appendChild(doc);
		    }
		}

		function loadCalendarYears() {
		    document.getElementById("years").innerHTML = "";

		    for (var i = startYear; i <= endYear; i++) {
		        var doc = document.createElement("div");
		        doc.innerHTML = i;
		        doc.classList.add("dropdown-item");

		        doc.onclick = (function () {
		            var selectedYear = i;
		            return function () {
		                year = selectedYear;
		                document.getElementById("curYear").innerHTML = year;
		                loadCalendarDays();
		                return year;
		            }
		        })();

		        document.getElementById("years").appendChild(doc);
		    }
		}

		function loadCalendarDays() {
		    document.getElementById("calendarDays").innerHTML = "";

		    var tmpDate = new Date(year, month, 0);
		    var num = daysInMonth(month, year);
		    var dayofweek = tmpDate.getDay();       // find where to start calendar day of week

		    for (var i = 0; i <= dayofweek; i++) {
		        var d = document.createElement("div");
		        d.classList.add("day");
		        d.classList.add("blank");
		        document.getElementById("calendarDays").appendChild(d);
		    }
			let constant_sunday = 6 - dayofweek;
			let j = 0;
		    for (var i = 1; i <= num; i++) {
				if(i==1){
					var first_sunday = i + constant_sunday;
				}
		        var tmp = i;
				var a = document.createElement("a");
		        var d = document.createElement("div");
		        d.id = "calendarday_" + i;
				var today = new Date();
				var dd = today.getDate();
		        d.className = "day hover:bg-blue-700 hover:text-yellow-500";
		        d.innerHTML = tmp;
				if(i==first_sunday+(j*7)){
					j++;
					d.className += " text-red-600 border-red-600";
				}else{
					d.className += " border-gray-500";
				}
				if (tmp==dd && month==today.getMonth()){
					if(i==first_sunday+((j-1)*7)){
						d.setAttribute("style","box-shadow:inset 0px 0px 0px 4px #f00;");
					}else{
						d.setAttribute("style","box-shadow:inset 0px 0px 0px 4px rgba(160, 174, 192, 0.5);");
					}
				}else{
					d.classList.add("border");
				}
				if((month+1)<10){
					var month_href="0"+(month+1);
				}else{
					var month_href=(month+1);
				}
				if(i<10){
					var day_href="0"+i;
				}else{
					var day_href=i;
				}
				a.href="index.php?page=add&type=booking&year="+year+"&month="+(month_href)+"&day="+day_href <?php echo (isset($_GET['id']))?"+\"&id=".$_GET['id']."\"":""; ?>;
				a.appendChild(d);
		        document.getElementById("calendarDays").appendChild(a);
		    }

		    var clear = document.createElement("div");
		    clear.className = "clear";
		    document.getElementById("calendarDays").appendChild(clear);
		}

		function daysInMonth(month, year)
		{
		    var d = new Date(year, month+1, 0);
		    return d.getDate();
		}

		window.addEventListener('load', function () {
		    var date = new Date();
		    month = date.getMonth();
		    year = date.getFullYear();
		    document.getElementById("curMonth").innerHTML = months[month];
		    document.getElementById("curYear").innerHTML = year;
		    loadCalendarMonths();
		    loadCalendarYears();
		    loadCalendarDays();
		});

     </script>
</div>
