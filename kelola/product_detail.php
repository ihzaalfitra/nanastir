<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<div class="p-10 w-full overflow-auto">
  <?php
    if(!isset($_GET['id'])){
      header("location: index.php?page=home");
    }else{
      // Prepare a select statement
      $sql=$db->prepare("SELECT * FROM product, category WHERE product.id='$_GET[id]' AND category_id = category.id");
      $sql->execute();
      $i = 0; //seed to determine background color
      if($result=$sql->FETCH(PDO::FETCH_ASSOC)){
    ?>
      <!-- product description -->
      <div class="text-red-700">
        <a href="index.php?page=product" class="transition duration-300 ease-in-out hover:bg-gray-200 hover:text-red-700">
          <i class="transition duration-300 ease-in-out hover:bg-red-700 hover:text-gray-200 text-red-700 border border-red-700 p-5 rounded-full text-2xl fas fa-arrow-left"></i>
        </a>
        <h1 class="text-center text-4xl text-red-700"><?php echo $result['name']; ?><br>
        <h1 class="font-thin text-center text-xl text-red-700 mb-4"><?php echo $result['category_name']; ?><br><br>
        <a class="transition duration-300 ease-in-out mt-4 text-xl px-6 py-3 text-red-700 rounded-md hover:bg-red-700 hover:text-gray-200 border border-red-700" href="index.php?page=edit&type=product&id=<?php echo $_GET['id']?>">Edit <i class="fas fa-pencil-alt"></i></a></h1>

          <!-- product image -->
            <img class="mx-auto relative max-w-xs" src="../img/<?php echo $result['filename']; ?>" alt="">
          <!-- <span class="text-red-700 block opacity-75 -mb-1">Adhesive</span> -->
          <table class="border border-red-700 table-auto w-full mb-10">
            <tr>
              <th class='max-w-xs text-white border text-center px-2 py-1 break-words border-black bg-red-700'>Testing Items</th><td class='border text-black text-center px-2 py-1 break-all border-red-700'><?php echo $result['testing_items']; ?></td>
              <th class='text-white border text-center px-2 py-1 break-words border-black bg-red-700'>Backing</th><td class='border text-black text-center px-2 py-1 break-all border-red-700'><?php echo $result['backing']; ?></td>
              <th class='text-white border text-center px-2 py-1 break-words border-black bg-red-700'>Adhesive</th><td class='border text-black text-center px-2 py-1 break-all border-red-700'><?php echo $result['adhesive']; ?></td>
              <th class='text-white border text-center px-2 py-1 break-words border-black bg-red-700'>Tape Thickness</th><td class='border text-black text-center px-2 py-1 break-all border-red-700'><?php echo $result['tape_thickness']; ?></td></tr><tr>
              <th class='text-white border text-center px-2 py-1 break-words border-black bg-red-700'>Adhesion to Steel</th><td class='border text-black text-center px-2 py-1 break-all border-red-700'><?php echo $result['adhesion_to_steel']; ?></td>
              <th class='text-white border text-center px-2 py-1 break-words border-black bg-red-700'>Tensile Strength</th><td class='border text-black text-center px-2 py-1 break-all border-red-700'><?php echo $result['tensile_strength']; ?></td>
              <th class='text-white border text-center px-2 py-1 break-words border-black bg-red-700'>Temperature</th><td class='border text-black text-center px-2 py-1 break-all border-red-700'><?php echo $result['temperature']; ?></td>
              <th class='text-white border text-center px-2 py-1 break-words border-black bg-red-700'>Lab Test Method</th><td class='border text-black text-center px-2 py-1 break-all border-red-700'><?php echo $result['lab_test_method']; ?></td></tr><tr>
              <th class='text-white border text-center px-2 py-6 break-words border-black bg-red-700'>Items</th><td colspan="7" class='border text-center px-2 py-1 break-all border-red-700'><?php echo $result['items']; ?></td></tr><tr>
              <th class='text-white border text-center px-2 py-6 break-words border-black bg-red-700'>Remarks</th><td colspan="7" class='border text-center px-2 py-1 break-all border-red-700'><?php echo $result['remarks']; ?></td></tr><tr>
              <th class='text-white border text-center px-2 py-6 break-words border-black bg-red-700'>Specification</th><td colspan="7" class='border text-center px-2 py-1 break-all border-red-700'><?php echo $result['specification']; ?></td>
            </tr>
          </table>
        </div>
    </div>
    <?php
       }else{
         echo "
           <h1 class='text-4xl text-red-700'>Product not found.</h1>
         ";
       }
     }
    ?>
</div>
