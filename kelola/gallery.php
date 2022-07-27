<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<div class="p-24 w-full overflow-auto display-block">
  <h1 class="text-4xl text-red-700 mb-10">Gallery</h1>
  <a class="float-right mb-5 px-8 py-4 transition duration-300 ease-in-out hover:bg-red-700 hover:text-white text-red-700 border border-red-700 rounded-full text-base" href="index.php?page=add&type=gallery"><i class="fas fa-plus"></i>&nbsp;Add new image</a>
  <?php
    if(isset($_GET['s'])){
      switch ($_GET['s']) {
        case 'delete':
        ?>
          <p class="text-red-700">Delete successful.</p>
        <?php
          break;

        default:
          // code...
          break;
      }
    }

      // Prepare a select statement
      $sql=$db->prepare("SELECT * FROM gallery ORDER BY id asc");
      $sql->execute();
      if($sql->rowCount()==0){
        echo "No image found.";
      }else{
  ?>
    <table class="table-auto border text-center px-8 py-4 border-red-700 w-full mb-24" id="product-table">
      <thead class="bg-red-700">
        <tr>
          <th class="text-white border text-center px-8 py-4 border-black">No
          </th>
          <th class="text-white border text-center px-8 py-4 border-black">Image
          </th>
          <th colspan="2" class="text-white border text-center px-8 py-4 border-black">Action</th>
        </tr>

      </thead>
      <tbody>
      <?php
          $i = 1; //seed to determine background color
          $no=1;
          while($result=$sql->FETCH(PDO::FETCH_ASSOC)){
            echo "<tr class='";
            if($i==0){echo "bg-red-200";$i=1;}else{$i=0;} //to determine background color
            echo "'>";
              echo "<td class='number-col border text-center px-8 py-4 border-red-700'>".$no."</td>";
              echo "<td class='border text-center px-8 py-4 border-red-700'><img style='margin:0 auto;' src='../gallery_img/".
              $result['filename']."' alt=''></td>";
              echo "<td class='border border-red-700 text-center px-4 py-2'><a class='transition ease-in-out duration-300 hover:text-red-700 text-black underline delete-button' href='index.php?page=delete&type=gallery&id=".$result['id']."'>Delete</a></td>";
            echo "</tr>";
            $no++;
          }
        }
       ?>
       </tbody>
     </table>
     <script type="text/javascript">
        $('.delete-button').click(function () {
          return confirm('Delete image?\nPlease uncheck the checkbox below(if exist) as it may cause the web to malfunction.');
        });
     </script>
</div>
