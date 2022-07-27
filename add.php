<div class="p-10 w-full overflow-auto">
      <!-- student description -->
      <div class="text-blue-700 mb-16">
        <a href="index.php?page=<?php
			if(isset($_GET['type'])){
				if($_GET['type']=="booking"){
					if(isset($_GET['id'])){
						echo "jadwal&id=".$_GET['id'];
					}else{
						echo "jadwal";
					}
				}elseif($_GET['type']=="detail_booking"){
					if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])){
						if(isset($_GET['id'])){
							echo "add&type=booking&year=".$_GET['year']."&month=".$_GET['month']."&day=".$_GET['day']."&id=".$_GET['id'];
						}else{
							echo "add&type=booking&year=".$_GET['year']."&month=".$_GET['month']."&day=".$_GET['day'];
						}
					}else{
						echo "daftar_siswa";
					}
				}else{
					echo "daftar_siswa";
				}
			}
		?>" class="transition duration-300 ease-in-out hover:bg-gray-200 hover:text-blue-700">
          <i class="transition duration-300 ease-in-out hover:bg-blue-700 hover:text-gray-200 text-blue-700 border border-blue-700 p-5 rounded-full text-2xl fas fa-arrow-left"></i>
        </a>
          <table class="table-auto w-full">
            <form class="" action="index.php?page=process" method="post" class="" enctype="multipart/form-data">
              <?php
                  if(isset($_GET['type'])){
                    switch ($_GET['type']) {
                      case 'student':
              ?>
			  <h1 class="text-4xl text-blue-700 mb-10 ml-24">Tambah siswa baru</h1>
            <tr>
              <th class='w-48 text-black text-right font-normal px-2 py-3 break-words border-black'>Nama</th><td class='text-left px-2 py-1 break-all border-blue-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="student_name" onfocus="showText(this)" type="text" name="student_name" value="" required maxlength="100">
                <label for="student_name" class="hidden text-gray-700"><sub>Maksimal karakter 100</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Alamat</th><td class='text-left px-2 py-1 break-all border-blue-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="student_address" onfocus="showText(this)" type="text" name="student_address" value="" maxlength="255">
                <label for="student_address" class="hidden text-gray-700"><sub>Maksimal karakter 255</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>No. Telp</th><td class='text-left px-2 py-1 break-all border-blue-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="student_phone" onfocus="showText(this)" type="text" name="student_phone" value="" maxlength="20">
                <label for="student_phone" class="hidden text-gray-700"><sub>Maksimal karakter 20</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Tempat lahir</th><td class='text-left px-2 py-1 break-all border-blue-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="student_born_place" onfocus="showText(this)" type="text" name="student_born_place" value="" maxlength="255">
                <label for="student_born_place" class="hidden text-gray-700"><sub>Maksimal karakter 255</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Tanggal lahir</th><td class='text-left px-2 py-1 break-all border-blue-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="student_born_date" onfocus="showText(this)" type="date" name="student_born_date" value="">
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Paket</th><td class='text-left px-2 py-1 break-all border-blue-700'>
                <select class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" name="package_id" required>
                  <option value="none" selected disabled hidden>
                    Pilih paket
                  </option>
                  <?php
                    $sql=$db->prepare("SELECT * FROM package");
                    $sql->execute();
                    $i = 1; //seed to determine background color
                    while($result=$sql->FETCH(PDO::FETCH_ASSOC)){
                  ?>
                    <option value="<?php echo $result['package_id']; ?>"><?php echo $result['package_name']; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td></tr>
            <tr>
              <td></td>
              <td>
                <input type="hidden" name="type" value="student">
                <input type="hidden" name="operation" value="add">
                <input type="submit" name="submit" value="Submit" class="px-6 py-3 bg-blue-700 text-white mt-4 rounded-md cursor-pointer">
              </td>
            </tr>


            <!-- Absen -->


                    <?php
                      break;
                      case 'pilihan':
                    ?>
	  			  <h1 class="text-4xl text-blue-700 mb-10 ml-24">Pilihan</h1>
				  <tr>
				  <th class='text-black text-left font-normal px-2 py-3 break-words border-black'>Nama siswa :
					  <?php if(isset($_GET['id'])){
						  $student_id=$_GET['id'];
							$sql=$db->prepare("SELECT * FROM student WHERE student_id=:student_id");
							$sql->bindParam(':student_id', $_GET['id']);
							$sql->execute();
							$i = 1; //seed to determine background color
							if($result=$sql->FETCH(PDO::FETCH_ASSOC)){
									echo $result['student_name'];
							}
						}
					  ?>
					</select>
				</th></tr><tr>
	              <th class='text-black text-left font-normal px-2 py-3 break-words border-black'>Tambah atau kurangi <br> jumlah pertemuan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="" type="number" name="add_meeting_input" value="" required placeholder="Contoh : -1 atau 1">
				  </th>
	            </tr>
	              <tr>
	                <td>
	                  <input type="hidden" name="type" value="option">
	                  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
	                  <input type="hidden" name="operation" value="add">
	                  <input type="submit" name="submit" value="Submit" class="px-6 py-3 bg-blue-700 text-white mt-4 rounded-md cursor-pointer">
	                </td>
	              </tr>
            <?php
                    break;

					case 'booking':
					?>

	  			  <h1 class="text-4xl text-blue-700 ml-24">Booking tanggal <?php echo (isset($_GET['day']))?$_GET['day']." ":"";echo (isset($_GET['month']))?toMonthName($_GET['month'])." ":"";echo (isset($_GET['year']))?$_GET['year']:""; ?>
				  </h1>
				  <h2 class="text-2xl text-blue-700 mb-10 ml-24">
				  <?php
						if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])){
							$sql=$db->prepare("SELECT * FROM student WHERE student_id=:student_id");
							$sql->bindParam(':student_id', $_GET['id']);
							$sql->execute();
							if($result=$sql->FETCH(PDO::FETCH_ASSOC)){
									echo "Nama siswa : ".$result['student_name'];
							}
						}
				  ?></h2>
				  <h2 class="text-red-500">
					  <?php if(isset($_GET['err'])){
						  		if($_GET['err']=="cannotweekend"){
									echo "Error : Siswa dengan paket SM (Sabtu Minggu) hanya bisa booking hari Sabtu dan Minggu.";
								}else{
									echo "Error : Siswa yang dipilih sudah ada di jadwal yang sama dengan mobil yang berbeda.";
								}
					  } ?>
			  	  </h2>
				  <tr>
				  	<th class='text-white bg-blue-700 text-center font-normal px-2 py-3 break-words border border-blue-700'>Jam</th>
				  	<th class='text-white bg-blue-700 text-center font-normal px-2 py-3 break-words border border-blue-700'>Ertiga<br>1 2 3 4</th>
				  	<th class='text-white bg-blue-700 text-center font-normal px-2 py-3 break-words border border-black'>Agya<br>5 6 7</th>
				  	<th class='text-white bg-blue-700 text-center font-normal px-2 py-3 break-words border border-blue-700'>Avanza<br>8 9 10
					</th>
	              </tr>
				  <?php
				  if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])){
					  $sql=$db->prepare("SELECT attendance_date, attendance_time_slot, attendance_car, attendance.student_id, student_name FROM attendance,student WHERE attendance.student_id=student.student_id AND attendance_date=:attendance_date ORDER BY attendance_time_slot, attendance_car ASC");
					  // $sql=$db->prepare("SELECT*FROM attendance");
					  $attendance_date = $_GET['year']."-".$_GET['month']."-".$_GET['day'];
					  $sql->bindParam(':attendance_date', $attendance_date);
					  $sql->execute();
					  $result=$sql->fetchAll();
					  $result_index=0;
					  $row_count=$sql->rowCount();
				  }
				  if($row_count==0){
					  for($i=1;$i<=10;$i++){
						  echo "<tr>
		  				  		<td class='text-center font-normal px-2 py-3 break-words border border-blue-700'>".toTimeName($i)."</td>";
							for($j=1;$j<=3;$j++){
								echo "
								<td class='text-center font-normal px-2 py-3 break-words border border-blue-700'>";
									echo "<a class='transition ease-in-out duration-300 hover:bg-blue-700 hover:text-white border-blue-700 border rounded-full px-4 py-2 text-blue-700' href='index.php?page=add&type=detail_booking&car=$j&year=".$_GET['year']."&month=".$_GET['month']."&day=".$_GET['day']."&time_slot=$i";
									echo (isset($_GET['id']))?"&id=".$_GET['id']:"";
									echo"'>Kosong</a>";
								echo "</td>";
							}

		  				  	echo "</tr>";

					  }
				  }else{
					  for($i=1;$i<=10;$i++){
						  if(($i+6)<10){
							  	$time="0".($i+6);
						  }else {
						  		$time=$i+6;
						  }
						  echo "<tr>
		  				  		<td class='text-center font-normal px-2 py-3 break-words border border-blue-700'>".toTimeName($i)."</td>";
							for($j=1;$j<=3;$j++){
								echo "
								<td class='text-center font-normal px-2 py-3 break-words border border-blue-700'>";
								if($result[$result_index]['attendance_time_slot']==$i && $result[$result_index]['attendance_car']==$j){

									echo "<a class='transition ease-in-out duration-150 hover:underline hover:text-yellow-500 px-4 py-2 text-blue-700' href='index.php?page=detail_siswa&filter=".$result[$result_index]['student_id']."'>".$result[$result_index]['student_name']."</a>";
									(($result_index+1)!=$row_count)?$result_index++:null;
								}else{
									echo "<a class='transition ease-in-out duration-300 hover:bg-blue-700 hover:text-white border-blue-700 border rounded-full px-4 py-2 text-blue-700' href='index.php?page=add&type=detail_booking&car=$j&year=".$_GET['year']."&month=".$_GET['month']."&day=".$_GET['day']."&time_slot=$i";
									echo (isset($_GET['id']))?"&id=".$_GET['id']:"";
									echo"'>Kosong</a>";
								}
								echo "</td>";
							}

		  				  	echo "</tr>";

					  }
					}

				  ?>

					<?php
					break;
					case 'detail_booking':
					?>
						<h1 class="text-4xl text-blue-700 mb-10 ml-24">Konfirmasi booking</h1>
	  				  <h2>
	  				  <?php

	  				  ?></h2>
					  <table>

					  <tr>
					  	<td class="text-blue-700">Nama</td>
					  	<td class="text-blue-700">:</td>
					  	<td class="text-blue-700"><?php
						if(isset($_GET['id'])){
							$sql=$db->prepare("SELECT * FROM student WHERE student_id=:student_id");
							$sql->bindParam(':student_id', $_GET['id']);
							$sql->execute();
							$i = 1; //seed to determine background color
							if($result=$sql->FETCH(PDO::FETCH_ASSOC)){
								echo $result['student_name'];
							}
						}else{
							?>
							<select class="text-black px-2 py-1 border border-gray-500 rounded-md w-full" name="student_id" required>
			                  <option value="none" selected disabled hidden>
			                    Pilih siswa
			                  </option>
			                  <?php
			                    $sql=$db->prepare("SELECT * FROM student ORDER BY student_name ASC");
			                    $sql->execute();
			                    $i = 1; //seed to determine background color
			                    while($result=$sql->FETCH(PDO::FETCH_ASSOC)){
			                  ?>
			                    <option value="<?php echo $result['student_id']; ?>"><?php echo $result['student_name']; ?></option>
			                  <?php
			                    }
			                  ?>
			                </select>
							<?php
						}
					?>
					</td>
					  </tr>
					  <tr>
					  	<td class="text-blue-700">Tanggal&nbsp;</td>
					  	<td class="text-blue-700">:&nbsp;</td>
					  	<td class="text-blue-700"><?php if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])){echo $_GET['day']." ".toMonthName($_GET['month'])." ".$_GET['year'];} ?></td>
					  </tr>
					  <tr>
					  	<td class="text-blue-700">Jam</td>
					  	<td class="text-blue-700">:</td>
					  	<td class="text-blue-700"><?php echo (isset($_GET['time_slot']))?toTimeName($_GET['time_slot']):""; ?>
						</td>
					  </tr>
					  <tr>
					  	<td class="text-blue-700">Mobil</td>
					  	<td class="text-blue-700">:</td>
					  	<td class="text-blue-700"><?php echo (isset($_GET['car']))?toCarName($_GET['car']):""; ?></td>
					  </tr>
					  <tr>
					  	<td colspan="3">
							<input type="hidden" name="type" value="booking">
	  	                  	<input type="hidden" name="operation" value="add">

							<input type="hidden" name="attendance_date_year" value="<?php if(isset($_GET['year'])){echo $_GET['year'];} ?>">
							<input type="hidden" name="attendance_date_month" value="<?php if(isset($_GET['month'])){echo $_GET['month'];} ?>">
							<input type="hidden" name="attendance_date_day" value="<?php if(isset($_GET['day'])){echo $_GET['day'];} ?>">

							<input type="hidden" name="attendance_time_slot" value="<?php echo (isset($_GET['time_slot']))?$_GET['time_slot']:""; ?>">
							<input type="hidden" name="attendance_car" value="<?php echo (isset($_GET['car']))?$_GET['car']:""; ?>">
							<?php
								if(isset($_GET['id'])){
									echo "<input type='hidden' name='student_id' value=".$_GET['id']."\">";
								}
							?>
	  	                  	<input type="submit" name="submit" value="Submit" class="px-6 py-3 bg-blue-700 text-white mt-4 rounded-md cursor-pointer">
					  	</td>
					  </tr>
				  </table>
	  				  <?php
					break;

                    default:
                      header("location:index.php");
                    break;
                  }
                }else{
                  header("location:index.php");
                }
             ?>
            </form>
          </table>
        </div>
    </div>
</div>
<script type="text/javascript">

	// Restricts input for the given textbox to the given inputFilter function.
	function setInputFilter(textbox, inputFilter) {
	  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
	    textbox.addEventListener(event, function() {
	      if (inputFilter(this.value)) {
	        this.oldValue = this.value;
	        this.oldSelectionStart = this.selectionStart;
	        this.oldSelectionEnd = this.selectionEnd;
	      } else if (this.hasOwnProperty("oldValue")) {
	        this.value = this.oldValue;
	        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
	      } else {
	        this.value = "";
	      }
	    });
	  });
	}
    if(document.getElementById("student_phone")){
		setInputFilter(document.getElementById("student_phone"), function(value) {
			return /^\d*\+?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
		});
    }
  function showText(x) {
    var label = $("label[for='" + $(x).attr('id') + "']");
    label.removeClass("hidden");
  }
  $("input[type=radio][name=attendance_option]").change(function(){
	if(this.value=="select_date"){
	  	$("#select_date_input").removeAttr("disabled");
	  	$("#select_date_input").attr("required","true");

		$("#add_meeting_input").attr("disabled","true");
		$("#add_meeting_input").removeAttr("required");

		$("#remove_meeting_input").attr("disabled","true");
		$("#remove_meeting_input").removeAttr("required");
  	}else if(this.value=="add_meeting"){
		$("#select_date_input").attr("disabled","true");
		$("#select_date_input").removeAttr("required");

		$("#add_meeting_input").attr("required","true");
		$("#add_meeting_input").removeAttr("disabled");

		$("#remove_meeting_input").attr("disabled","true");
		$("#remove_meeting_input").removeAttr("required");

  	}else if(this.value=="remove_meeting"){
		$("#select_date_input").attr("disabled","true");
		$("#select_date_input").removeAttr("required");

		$("#add_meeting_input").attr("disabled","true");
		$("#add_meeting_input").removeAttr("required");

		$("#remove_meeting_input").attr("required","true");
		$("#remove_meeting_input").removeAttr("disabled");
	}else{
	  	$("#select_date_input").attr("disabled","true");
	  	$("#select_date_input").removeAttr("required");
	  	$("#add_meeting_input").attr("disabled","true");
	  	$("#add_meeting_input").removeAttr("required");
	  	$("#remove_meeting_input").attr("disabled","true");
	  	$("#remove_meeting_input").removeAttr("required");
	}
  })
</script>
<?php // TODO:
// finalizing form of konfirmasi Booking
// process of Booking
// search daftar siswa
 ?>
