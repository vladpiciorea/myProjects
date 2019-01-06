<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ie/core/init.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ie/helpers/helpers.php';
    if(!is_logged_in()) {
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/navigation.php';

// Delete Product
 if(isset($_GET['delete'])) {
     $id = (int)$_GET['delete'];
     $db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
     header('Location: products.php');
 }

// Edit and ADD Product
if(isset($_GET['add']) || isset($_GET['edit'])) {

    $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
    $colorQuery = $db->query("SELECT * FROM color ORDER BY id_color");
    
    $title = ((isset($_POST['title']) && $_POST['title'] != '')? sanitize($_POST['title']) : '');
    $brand = ((isset($_POST['brand']) && $_POST['brand'] != '')? sanitize($_POST['brand']) : '');
    $parent = ((isset($_POST['parent']) && $_POST['parent'] != '')? sanitize($_POST['parent']) : '');
    $price = ((isset($_POST['price']) && $_POST['price'] != '')? sanitize($_POST['price']) : '');
    $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')? sanitize($_POST['list_price']) : '');
    $description = ((isset($_POST['description']) && $_POST['description'] != '')? sanitize($_POST['description']) : '');
    $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')? sanitize($_POST['sizes']) : '');
  
// Doar Edit
        if(isset($_GET['edit'])) {   
            $edit_id = (int)$_GET['edit'];
            $productResult = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
            $product = mysqli_fetch_assoc($productResult);
            
// DELETE image si redirectionare
            if(isset($_GET['delete_imagec'])) {

                $imgi = (int)$_GET['imgi'] -1;
                $images = $product['cover_img'];
                $image_url = $_SERVER['DOCUMENT_ROOT'] .'/ie/'. $images;
                unlink($image_url);
                unset($images);
                $image_delete = '';
                $db->query("UPDATE products SET cover_img = '$image_delete' WHERE id= '$edit_id'");
                header('Location: products.php?edit='.$edit_id);
            }

            if(isset($_GET['delete_imagem'])) {

                $imgi = (int)$_GET['imgi'] -1;
                $images = json_decode($product['img_detail']);
                foreach($images as $image_small => $image_big) {

                    $image_url_s = $_SERVER['DOCUMENT_ROOT'] . $image_small;
                    unlink($image_url_s);
                    $image_url_b = $_SERVER['DOCUMENT_ROOT'] . $image_big;
                    unlink($image_url_b);
                    
                }
                unset($images);
                $image_delete = '';
                $db->query("UPDATE products SET img_detail = '$image_delete' WHERE id= '$edit_id'");
                header('Location: products.php?edit='.$edit_id);

            }



            if(isset($_GET['delete_image'])) {
                $imgi = (int)$_GET['imgi'] -1;
                $images = explode(',',$product['image']);
                $image_url = $_SERVER['DOCUMENT_ROOT'] . $images[$imgi];
                unlink($image_url);
                unset($images[$imgi]);
                $imageString = implode(',',$images);
                $db->query("UPDATE products SET image = '$imageString' WHERE id= '$edit_id'");
                header('Location: products.php?edit='.$edit_id);
            }


// Populare cu date din DB

            $title = sanitize($product['title']);
            $categories = sanitize($product['categories']);

            $childQuery = $db->query("SELECT * FROM categories WHERE id = '$categories'");
            $childResult = mysqli_fetch_assoc($childQuery);
            $child_id = $childResult['id'];
            $childp = $childResult['parent'];
            $colordp = $product['color'];
            
            $parentQuery2 = $db->query("SELECT * FROM categories WHERE id = ' $childp'");
            $parentResult = mysqli_fetch_assoc($parentQuery2);
            $parent_id =  $parentResult['id'];
            
            $color_sql = $db->query("SELECT * FROM color WHERE id_color = '$colordp'");
            $colorResult = mysqli_fetch_assoc($color_sql);
            $colorid = $colorResult['id_color'];

           
            $price = sanitize($product['price']);
            $list_price = sanitize($product['list_price']);
            $description = sanitize($product['description']);
            $sizes = json_decode($product['sizes']);
            $sArray = array();
            $qArray = array();
            foreach($sizes as $ss => $sq) {

                $sArray[] = $ss;
                $qArray[] = $sq;
                
            }
            $saved_photo_m = (($product['img_detail'] != '')? $product['img_detail'] : '' );    
            $dbPath_m = $saved_photo_m;
            $saved_photo_c = (($product['cover_img'] != '')? $product['cover_img'] : '' );
            $dbPath_c = $saved_photo_c;
            // var_dump($saved_photo);die();
            $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')? sanitize($_POST['sizes']) : sanitize($product['sizes']));
        }

        
        // if(!empty($sizes)) {
        //     $sizesArray = json_decode($sizes);
        //     var_dump($sizesArray);
        //     $sArray = array();
        //     $qArray = array();
        //     foreach($sizesArray as $ss => $sq) {

        //         $sArray[] .= $ss;
        //         $qArray[] .= $sq;
                
        //     }
        // }else {
        //      $sizesArray = array();
        // }

    $errors = array();

    if($_POST) {
        $title = ((isset($_POST['title']) && $_POST['title'] != '')? sanitize($_POST['title']) : '');
        $parent = ((isset($_POST['parent']) && $_POST['parent'] != '')? sanitize($_POST['parent']) : '');
        $color = ((isset($_POST['color']) && $_POST['color'] != '')? sanitize($_POST['color']) : '');
        $price = ((isset($_POST['price']) && $_POST['price'] != '')? sanitize($_POST['price']) : '');
        $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')? sanitize($_POST['list_price']) : '');
        $description = ((isset($_POST['description']) && $_POST['description'] != '')? sanitize($_POST['description']) : '');
        $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')? sanitize($_POST['sizes']) : '');
        $categories = (isset($_POST['child']) && $_POST['child'] != '') ? sanitize($_POST['child']) : $parent;

        
        
    // Campuri necesare pentru post
        $required = array('title', 'price', 'list_price', 'parent','sizes');
        $tmpLoc = array();
        $uploadPath = array();
        foreach($required as $field) {
            if(empty($_POST[$field])) {
                $errors[] = 'Toate campurile cu * sunt necesare';
                break;
            }
        }
        // Procesare sizes
        // Sterege ultima virgula
        $sizes_p = explode(',', rtrim($sizes, ','));
        $retunArray = array();
        
        if($sizes_p[0] != '') {
            foreach($sizes_p as $size) {
                $s = explode(':', $size);
                $retunArray[$s[0]] = $s[1];
                
            }

            $sizes = json_encode($retunArray);
        }

 // Procesare imagine cover
    $photoCount_c = $_FILES['photo_cover']['name'];

      if( $photoCount_c != '' ) {

          $name_cover = $_FILES['photo_cover']['name'];
          $nameArray_cover = explode('.', $name_cover);
          $fileExt_cover = isset($nameArray_cover[1]) ? $nameArray_cover[1] : '';
          $fileName_cover = $nameArray_cover[0];
          $mime_cover = explode('/', $_FILES['photo_cover']['type']);
          $mimeType_cover = $mime_cover[0];
          $tmpLoc_cover = $_FILES['photo_cover']['tmp_name'];
          $fileSize_cover = $_FILES['photo_cover']['size'];
          $uploadName_cover = $fileName_cover. '_cover_' . rand() .'.' . $fileExt_cover;
          $uploadPath_cover = BASEURL . 'images/products/' . $uploadName_cover;
          $dbPath2 = $uploadName_cover;

        $size_pixel = getimagesize($_FILES['photo_cover']['tmp_name']);
          if($size_pixel[0] != 720 && $size_pixel[1] != 960) {
            $errors[] = 'Imaginea cover trebuie sa aiba o rezolutie 720 X 960';
          } 
          if($mimeType_cover !== 'image' ) {
              $errors[] = 'Imaginea cover trebuie sa fie o imagine';
          }
          if($fileSize_cover > 1500000 ) {
              $errors[] = 'Imaginea cover trebuie sa fie sub 25 de mb';
          }
      }
        
        // Procesare imagini pentru produs detaliu big si small
        
        $photoCount_small = count($_FILES['photo_small']['name']);
        $photoCount_big = count($_FILES['photo_big']['name']);
        $photoCount = (($photoCount_small == $photoCount_big )? $photoCount_small : 0); 
        $dbPath_m = array();
        // var_dump($_FILES['photo_small']['name']);
        // die();
        if($photoCount > 0 ) { 
            for($i = 0; $i < $photoCount;$i++) { 
            //     // var_dump($photo);
                $name_small = $_FILES['photo_small']['name'][$i];
                $name_big = $_FILES['photo_big']['name'][$i];

                $nameArray_small = explode('.', $name_small);
                $nameArray_big = explode('.', $name_big);
        
                $fileName_small = $nameArray_small[0];
                $fileName_big = $nameArray_big[0];

                $fileExt_small = isset($nameArray_small[1]) ? $nameArray_small[1] : '';
                $fileExt_big = isset($nameArray_big[1]) ? $nameArray_big[1] : '';

                $mime_small = explode('/', $_FILES['photo_small']['type'][$i]);
                $mimeType_small = $mime_small[0];

                $mime_big = explode('/', $_FILES['photo_big']['type'][$i]);
                $mimeType_big = $mime_big[0];


                $tmpLoc_small[] = $_FILES['photo_small']['tmp_name'][$i];
                $tmpLoc_big[] = $_FILES['photo_big']['tmp_name'][$i];

                $fileSize_small = $_FILES['photo_small']['size'][$i];
                $fileSize_big = $_FILES['photo_big']['size'][$i];

                $uploadName_small = $fileName_small. '_small_' . rand() .'.' . $fileExt_small;
                $uploadName_big = $fileName_big. '_big_' . rand(). '.' . $fileExt_big;

                
                $uploadPath_small[] = BASEURL . 'images/products/' . $uploadName_small;
                $uploadPath_big[] = BASEURL . 'images/products/' . $uploadName_big;

                
                $dbPath_small = $uploadName_small;
                $dbPath_big = $uploadName_big;
                $dbPath1 [$dbPath_small] = $dbPath_big;

                if($mimeType_small !== 'image' && $mimeType_big !== 'image') {
                    $errors[] = 'Fisierul trebuie sa fie o imagine';
                }
                if($fileSize_small > 1500000 && $fileSize_big > 1500000) {
                    $errors[] = 'Fotografia trebuie sa fie sub 25 de mb';
                }
           
            }


        } 
        
        if(!empty($errors)) {

            echo dysplay_errors($errors);

        }else {
            $dbPath_mj = json_encode($dbPath1);
            $dbPath_m = ((isset($saved_photo_m) != '' && $saved_photo_m != '' ) ? $saved_photo_m : $dbPath_mj );
            var_dump($dbPath_m);
            $dbPath_c = ((isset($saved_photo_c) != '' && $saved_photo_c != '' ) ? $saved_photo_c : $dbPath2 );

//Upload imaginea in fisierul images/products
            if($photoCount > 0) {

                for($i=0;$i<$photoCount;$i++) {

                    move_uploaded_file($tmpLoc_small[$i], $uploadPath_small[$i]);
                    move_uploaded_file($tmpLoc_big[$i], $uploadPath_big[$i]);
                }
            }
            if($photoCount_c != '') {
    
                    move_uploaded_file($tmpLoc_cover, $uploadPath_cover);
                
            }

        
            $inserSql = "INSERT INTO products (`title`, `price`, `list_price`, `categories`,`img_detail`,`cover_img`,`description`,`sizes`,`color`) 
                                        VALUES('$title','$price','$list_price','$categories','$dbPath_m','$dbPath_c','$description','$sizes','$color')";
            if(isset($_GET['edit'])) {
                
                $inserSql = "UPDATE products SET title ='$title', price ='$price', list_price = '$list_price', categories = '$categories', img_detail = '$dbPath_m', cover_img = '$dbPath_c', description = '$description', sizes = '$sizes', color = '$color'
                WHERE id= '$edit_id'";
             
            }
            $db->query($inserSql);
            header('Location: products.php');
        }
    }
    ?>
        <!-- Verifica titlul  -->
        <h2 class="text-center"><?= ((isset($_GET['add']))?' Adaug un produs nou' : 'Editeaza produsul' ) ;?></h2>
        <form action="products.php?<?=((isset($_GET['edit']))? 'edit=' . $edit_id : 'add=1' );?>" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-3">
                <label for="title">Titlu* :</label>
                <input type="text" class="form-control" name="title" id="title" value="<?=$title;?>">
            </div>

        <!-- Categorie Parinte  -->
        <div class="form-group col-md-3">
            <label for="parent">Categorie Parinte* :</label>
            <select name="parent" class="form-control" id="parent">
            <option value=""></option>
                <?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
                    <option value="<?= $p['id']; ?>" <?=(( isset($parent_id) && $parent_id== $p['id'])? ' selected="selected"' : '') ;?>><?= $p['category']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Categorie Copil ajax call  -->
        <div class="form-group col-md-3">
            <label for="child">Categorie Copil* :</label>
                <select name="child" class="form-control" id="child">
                </select>
        </div>

        <!-- Pret -->
        <div class="form-group col-md-3">
            <label for="price">Pret *:</label>
            <input type="text" name="price" id="price" class="form-control" value="<?=$price; ?>">
        </div>

        <!-- Pret intreg  -->
        <div class="form-group col-md-3">
            <label for="list_price">Pret de lista:</label>
            <input type="text" name="list_price" id="list_price" class="form-control" value="<?=$list_price; ?>">
        </div>

        <!-- Cantitate si Marime de adaugat  -->
        <div class="form-group col-md-3">
            <label >Cantitate & Marime</label>
            <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle'); return false;">Cantitate si marime</button>
        </div>

        <!-- Cantitate si Marime de vizualizat  -->
        <div class="form-group col-md-3">
            <label for="sizes">Marime & Cantitate preview</label>
            <input type="text" class="form_control" name="sizes" id="sizes" value="<?= $sizes;?>" readonly>
        </div>

        <!-- Culoare -->
        <div class="form-group col-md-3">
            <label for="parent">Culoare* :</label>
            <select name="color" class="form-control" id="color">
            <option value=""></option>
                <?php while($c = mysqli_fetch_assoc($colorQuery)): ?>
                    <option value="<?= $c['id_color']; ?>" <?=(( isset($colorid) && $colorid== $c['id_color'])? ' selected="selected"' : '') ;?>><?= $c['color']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Imagine cover  -->
        <div class="form-group col-md-6">
            <?php if(isset($saved_photo_c) != '' && $saved_photo_c != '') : ?>
                    <?php  $image = $product['cover_img'];   ?>
                        <div class="saved_image col-md-4">
                            <img src="../images/products/<?=$image;?>" alt="saved_img"><br>
                            <a href="products.php?delete_imagec=1&edit=<?=$edit_id;?>&imgi=1" class="text-danger">Sterge imaginea</a>
                        </div>
                <?php else: ?>
                <label for="photo_cover">Imagine podus detaliu cover*</label>
                <input type="file" name="photo_cover" id="photo_cover" class="form-control">
                <?php endif; ?>
            </div>


        <!-- Imagine small  -->
            <div class="form-group col-md-3">
            <?php if(isset($saved_photo_m) != '' && $saved_photo_m != '') : ?>
                    <?php $imgi = 1;
                        $images_small = json_decode($product['img_detail'])  ?>
                    <?php foreach ($images_small as $image_s => $image_b):?>
                    <div class="saved_image col-md-4">
                        <img src="../images/products/<?=$image_s;?>" alt="saved_img"><br>
                        <a href="products.php?delete_imagem=2&edit=<?=$edit_id;?>&imgi=<?=$imgi;?>" class="text-danger">Sterge imaginea</a>
                    </div>
                        <?php 
                        $imgi++;
                        endforeach;?>
            <?php else: ?>
                <label for="photo_small">Imagine podus detaliu mica*</label>
                <input type="file" name="photo_small[]" id="photo_small" class="form-control" multiple>
            <?php endif; ?>
            </div>


            <!-- Imagine big  -->
            <div class="form-group col-md-3">
                        <?php if(isset($saved_photo_m) != '' && $saved_photo_m != '') : ?>
                                <?php $imgi = 1;
                                    $images_big = json_decode($product['img_detail']);
                                   ?>
                                <?php foreach ($images_big as $image_s => $image_b):?>
                                <div class="saved_image col-md-4">
                                    <img src="../images/products/<?=$image_b;?>" alt="saved_img"><br>
                                    <a href="products.php?delete_imagem=3&edit=<?=$edit_id;?>&imgi=<?=$imgi;?>" class="text-danger">Sterge imaginea</a>
                                </div>
                                    <?php 
                                    $imgi++;
                                    endforeach;?>
                        <?php else: ?>
                            <label for="photo_big">Imagine podus detaliu mare*</label>
                            <input type="file" name="photo_big[]" id="photo_big" class="form-control" multiple>
                        <?php endif; ?>
                        </div>


            <!-- Descriere Produs -->
            <div class="form-group col-md-6">
                <label for="description">Descriere podus</label>
                <textarea name="description" id="description" class="form-control" rows="6"><?= $description;?></textarea>
            </div>
            <div class="clearfix"></div>
            <div class=" coll-md-12">
                <input type="submit" value="<?= ((isset($_GET['add']))?' Adaug produsul' : 'Editeaza produsul' ); ?>" class=" btn btn-success ">
                <a href="products.php" class="btn btn-default">Cancel</a>
            </div>
            
        </form>

        <!-- Modal -->
        <div class="modal fade " id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="sizesModal">Marime & Cantitate</h4>
            </div>
            <div class="modal-body">
            <div class="container-fluid">
                <?php for($i=1; $i <= 12; $i++): ?>
                    <div class="form-group col-md-4">
                        <label for="size<?=$i;?>">Size</label>
                        <input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))? $sArray[$i-1] : '' );?>" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="qty<?=$i;?>">Cantitate</label>
                        <input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))? $qArray[$i-1] : '' );?>" min="0" class="form-control">
                    </div>
                <?php endfor; ?>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick ="upadateSizes();jQuery('#sizesModal').modal('toggle');return false;">Salveaza </button>
            </div>
            </div>
        </div>
        </div>

<?php } else {
    
    // Poduse Pagina principala 
        $sql = "SELECT * FROM products WHERE deleted = 0";
        $presults = $db->query($sql);
        if(isset($_GET['featured']) ) {
            $id = (int) $_GET['id'];
            $featured = (int) $_GET['featured'];
            $featuredsql = "UPDATE products SET featured = '$featured' WHERE id='$id'";
            $db->query($featuredsql);
            header('Location: products.php');
        }
    
?>


    <!-- 
    
    
    Poduse Pagina principala 

    -->
        <h2 class="text-center">Produse</h2>
        <a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Adauga PRODUS</a>
        <div class="clearfix"></div>
        <hr>
        <table class="table table-bordered table-condensed table-striped">
            <thead>
                <th></th>
                <th>Produs</th>
                <th>Pret</th>
                <th>Categorii</th>
                <th>Pagina principala</th>
                <th>Sold</th>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($presults)): 
                    $childId = $product['categories'];
                    $catsql = "SELECT * FROM categories WHERE id='$childId'";
                    $result = $db->query($catsql);
                    $child = mysqli_fetch_assoc($result);
                    $parentId = $child['parent'];
                    $psql = "SELECT * FROM categories WHERE id='$parentId'";
                    $presult = $db->query($psql);
                    $parent = mysqli_fetch_assoc($presult);
                    $category = $parent['category'] . ' ~ ' . $child['category']
                ?>
                    <tr>
                        <td>
                        <a href="products.php?edit=<?= $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="products.php?delete=<?= $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                        <td><?= $product['title']; ?></td>
                        <td><?= money($product['price']); ?></td>
                        <td><?= $category; ?></td>
                        <td><a href="products.php?featured=<?=(($product['featured'] == 0)? '1': '0'); ?>&id=<?= $product['id']; ?>" class="btn btn-xs btn-default">
                        <span class="glyphicon glyphicon-<?= (($product['featured'] == 1 )? 'minus' : 'plus'); ?>"></span></a>
                        &nbsp <?=(($product['featured'] == 1)? 'Pe pagina principala': '') ;?>
                        </td>
                        <td>0</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php } include 'includes/footer.php'; ?>
        <script>
            jQuery('document').ready(function() {
                get_child_options('<?=((isset($child_id))? $child_id : ''); ?>');
                upadateSizes()
            });
        </script>