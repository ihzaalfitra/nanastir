<?php
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
?>
<div class="p-10 w-full overflow-auto">
      <!-- product description -->
      <div class="text-red-700 mb-16">
        <?php
        if(!isset($_GET['id'])){
          header("location:index.php");
        }else{
          $id=$_GET['id'];
          switch ($_GET['type']) {
            case 'product':
              $sql=$db->prepare("SELECT * FROM product,category where category_id=category.id AND product.id=$id");
              $sql->execute();
              $i = 1; //seed to determine background color
              $no=1;
              if($result=$sql->FETCH(PDO::FETCH_ASSOC)){
        ?>
        <a href="index.php?page=product" class="transition duration-300 ease-in-out hover:bg-gray-200 hover:text-red-700">
          <i class="transition duration-300 ease-in-out hover:bg-red-700 hover:text-gray-200 text-red-700 border border-red-700 p-5 rounded-full text-2xl fas fa-arrow-left"></i>
        </a>
          <table class="table-auto w-full">
            <form class="" action="index.php?page=process" method="post" class="" enctype="multipart/form-data">
            <tr>
              <th class='w-48 text-black text-right font-normal px-2 py-3 break-words border-black'>Name</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="name" onfocus="showText(this)" type="text" name="name" value="<?php echo $result['name']; ?>" required>
                <label for="name" class="hidden text-gray-500"><sub>Maximum character is 255</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Category</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <select class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" name="category_id">
                  <?php
                    $sql_category=$db->prepare("SELECT * FROM category");
                    $sql_category->execute();
                    $i = 1; //seed to determine background color
                    while($result_category=$sql_category->FETCH(PDO::FETCH_ASSOC)){
                  ?>
                    <option value="<?php echo $result_category['id'];?>"<?php echo ($result_category['id'] == $result['id'] ? " selected" : ""); ?>><?php echo $result_category['category_name']; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Testing Items</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="testing_items" onfocus="showText(this)" type="text" name="testing_items" value="<?php echo $result['testing_items']; ?>">
                <label for="testing_items" class="hidden text-gray-500"><sub>Maximum character is 80</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Backing</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="backing" onfocus="showText(this)" type="text" name="backing" value="<?php echo $result['backing']; ?>">
                <label for="backing" class="hidden text-gray-500"><sub>Maximum character is 80</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Adhesive</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="adhesive" onfocus="showText(this)" type="text" name="adhesive" value="<?php echo $result['adhesive']; ?>">
                <label for="adhesive" class="hidden text-gray-500"><sub>Maximum character is 80</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Tape Thickness</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="tape_thickness" onfocus="showText(this)" type="text" name="tape_thickness" value="<?php echo $result['tape_thickness']; ?>">
                <label for="tape_thickness" class="hidden text-gray-500"><sub>Maximum character is 80</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Adhesion to Steel</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="adhesion_to_steel" onfocus="showText(this)" type="text" name="adhesion_to_steel" value="<?php echo $result['adhesion_to_steel']; ?>">
                <label for="adhesion_to_steel" class="hidden text-gray-500"><sub>Maximum character is 80</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Tensile Strength</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="tensile_strength" onfocus="showText(this)" type="text" name="tensile_strength" value="<?php echo $result['tensile_strength']; ?>">
                <label for="tensile_strength" class="hidden text-gray-500"><sub>Maximum character is 80</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Temperature</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="temperature" onfocus="showText(this)" type="text" name="temperature" value="<?php echo $result['temperature']; ?>">
                <label for="temperature" class="hidden text-gray-500"><sub>Maximum character is 80</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Lab Test Method</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="lab_test_method" onfocus="showText(this)" type="text" name="lab_test_method" value="<?php echo $result['lab_test_method']; ?>">
                <label for="lab_test_method" class="hidden text-gray-500"><sub>Maximum character is 80</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Items</th><td colspan="7" class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="items" onfocus="showText(this)" type="text" name="items" value="<?php echo $result['items']; ?>">
                <label for="items" class="hidden text-gray-500"><sub>Maximum character is 255</sub></label>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Remarks</th><td colspan="7" class='text-left px-2 py-1 break-all border-red-700'>
                <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="remarks" onfocus="showText(this)" type="text" name="remarks" value="<?php echo $result['remarks']; ?>">
                <label for="remarks" class="hidden text-gray-500"><sub>Maximum character is 255</sub></label>
              </td></tr><tr>
              <th class='align-top text-black text-right font-normal px-2 py-3 break-words border-black'>Specification</th><td colspan="7" class='text-left px-2 py-1 break-all border-red-700'>
                <textarea class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="specification" name="specification" rows="8" cols="80"><?php echo $result['specification']; ?></textarea>
              </td></tr><tr>
              <th class='text-black text-right font-normal px-2 py-3 break-words border-black'>Image</th><td class='text-left px-2 py-1 break-all border-red-700'>
                <input class="my-5" type="radio" name="img_option" value="new_image" id="new_image"><label for="new_image">Use new image</label><input id="select_img" class="ml-10" type="file" name="filename" value="" disabled="true">
                <br>
                <input class="my-5" type="radio" name="img_option" value="old_image" id="old_image"><label for="old_image">Don't change image</label>
                <br>
                <input class="my-5" type="radio" name="img_option" value="blank_image" id="blank_image"><label for="blank_image">Delete image</label>

              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <input type="hidden" name="type" value="product">
                <input type="hidden" name="operation" value="edit">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Submit" class="px-6 py-3 bg-red-700 text-white mt-4 rounded-md cursor-pointer">
              </td>
            </tr>
            </form>

            <script type="text/javascript">
              function showText(x) {
                var label = $("label[for='" + $(x).attr('id') + "']");
                label.removeClass("hidden");
              }
              $("input[type=radio][name=img_option]").change(function(){
                if(this.value=="new_image"){
                  $("#select_img").removeAttr("disabled");
                  $("#select_img").attr("required","true");
                }else{
                  $("#select_img").attr("disabled","true");
                  $("#select_img").removeAttr("required");
                }
              })
            </script>
            <?php
          }
              break;
              case 'category':
                $sql=$db->prepare("SELECT * FROM category where id=$id");
                $sql->execute();
                $i = 1; //seed to determine background color
                $no=1;
                if($result=$sql->FETCH(PDO::FETCH_ASSOC)){
              ?>
              <a href="index.php?page=category" class="transition duration-300 ease-in-out hover:bg-gray-200 hover:text-red-700">
                <i class="transition duration-300 ease-in-out hover:bg-red-700 hover:text-gray-200 text-red-700 border border-red-700 p-5 rounded-full text-2xl fas fa-arrow-left"></i>
              </a>
                <table class="table-auto w-full">
                  <form class="" action="index.php?page=process" method="post" class="" enctype="multipart/form-data">
                    <tr>
                      <th class='w-48 text-black text-right font-normal px-2 py-3 break-words border-black'>Category Name</th><td class='text-left px-2 py-1 break-all border-red-700'>
                        <input class="text-black px-2 py-1 border border-gray-500 rounded-md w-1/2" id="category_name" onfocus="showText(this)" type="text" name="category_name" value="<?php echo $result['category_name']; ?>" required maxlength="50">
                        <label for="category_name" class="hidden text-gray-500"><sub>Maximum character is 50</sub></label>
                      </td></tr>
                  <tr>
                    <td></td>
                    <td>
                      <input type="hidden" name="type" value="category">
                      <input type="hidden" name="operation" value="edit">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <input type="submit" name="submit" value="Submit" class="px-6 py-3 bg-red-700 text-white mt-4 rounded-md cursor-pointer">
                    </td>
                  </tr>
                  </form>
              <?php
            }
              break;
            default:
              // code...
              break;
           ?>
          </table>
        </div>
    </div>
</div>
<?php
  }
}
?>
