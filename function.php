<!-- <a href="function.php?generate=y">generate</a> -->
<?php
// if(isset($_GET['generate']) && $_GET['generate']!=""){
//   $uniq = uniqid();
//   echo "your unique image code : ".$uniq.".png";
// }
  function spit($column_name,$column_value){
    echo "
     <th class='text-white border text-center px-2 py-1 break-words border-black bg-indigo-800'>$column_name</th>
     <td class='border text-center px-2 py-1 break-all border-indigo-800'>$column_value</td>
   ";
  }
  function toTimeName($ref){
	  if(($ref+6)<10){
		  return "0".($ref+6).":00";
	  }else{
		  return ($ref+6).":00";
	  }
  }
  function toMonthName($ref){
	  switch($ref){
		  	case '01':
		  		return "Januari";
			break;
		  	case '02':
		  		return "Februari";
			break;
		  	case '03':
		  		return "Maret";
			break;
		  	case '04':
		  		return "April";
			break;
		  	case '05':
		  		return "Mei";
			break;
		  	case '06':
		  		return "Juni";
			break;
		  	case '07':
		  		return "Juli";
			break;
		  	case '08':
		  		return "Agustus";
			break;
		  	case '09':
		  		return "September";
			break;
		  	case '10':
		  		return "Oktober";
			break;
		  	case '11':
		  		return "November";
			break;
		  	case '12':
		  		return "Desember";
			break;
			default:
				return "error $ref is not month number";
			break;
	  }
  }
  function toCarName($ref){
	  switch ($ref) {
	  	case 1:
	  		return "Ertiga";
	  		break;
	  	case 2:
			return "Agya";
			break;
		case 3:
			return "Avanza";
			break;
	  	default:
	  		break;
	  }
  }
  function check_column_count($target,$current_column_count){
    if($target==$current_column_count){
      echo"</tr><tr>";
      $current_column_count=0;
      return TRUE;
    }
  }
?>
