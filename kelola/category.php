<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<div class="p-24 w-full overflow-auto display-block">
  <h1 class="text-4xl text-red-700 mb-10">Category</h1>
  <a class="float-right mb-5 px-8 py-4 transition duration-300 ease-in-out hover:bg-red-700 hover:text-white text-red-700 border border-red-700 rounded-full text-base" href="index.php?page=add&type=category"><i class="fas fa-plus"></i>&nbsp;Add new category</a>
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
      $sql=$db->prepare("SELECT * FROM category ORDER BY category_name asc");
      $sql->execute();
      if($sql->rowCount()==0){
        echo "Category not found.";
      }else{
  ?>
    <table class="table-auto border text-center px-8 py-4 border-red-700 w-full mb-24" id="product-table">
      <thead class="bg-red-700">
        <tr>
          <th class="text-white border text-center px-8 py-4 border-black">No
          </th>
          <th class="text-white border text-center px-8 py-4 border-black"><nobr>Name
            <button type="button" name="button" onClick="sortTable(2)">
              <i class="fas fa-sort"></i>
            </button></nobr>
          </th>
          <th colspan="3" class="text-white border text-center px-8 py-4 border-black">Action</th>
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
              echo "<td class='border text-center px-8 py-4 border-red-700'>".$result['category_name']."</td>";
              echo "<td class='border border-red-700 text-center px-4 py-2'><a class='transition ease-in-out duration-300 hover:bg-red-700 hover:text-white border-red-700 border rounded-full px-4 py-2 text-red-700' href='index.php?page=product&filter=".$result['id']."'>Product List</a></td>";
              echo "<td class='border border-red-700 text-center px-4 py-2'><a class='transition ease-in-out duration-300 hover:bg-red-700 hover:text-white border-red-700 border rounded-full px-4 py-2 text-red-700' href='index.php?page=edit&type=category&id=".$result['id']."'>Edit</a></td>";
              echo "<td class='border border-red-700 text-center px-4 py-2'><a class='transition ease-in-out duration-300 hover:text-red-700 text-black underline delete-button' href='index.php?page=delete&type=category&id=".$result['id']."'>Delete</a></td>";
            echo "</tr>";
            $no++;
          }
        }
       ?>
       </tbody>
     </table>
     <script type="text/javascript">
        $('.delete-button').click(function () {
          return confirm('Delete category?\nTHIS WILL DELETE ALL PRODUCT WITHIN THIS CATEGORY.\nPlease uncheck the checkbox below(if exist) as it may cause the web to malfunction.');
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
            rows[i].classList.remove("bg-red-200");
            if(i%2){
              continue;
            }else{
              rows[i].classList.add('bg-red-200');
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
