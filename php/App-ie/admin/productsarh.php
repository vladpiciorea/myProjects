<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ie/core/init.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ie/helpers/helpers.php';

    if(!is_logged_in()) {
        login_error_redirect();
    }

    include 'includes/head.php';
    include 'includes/navigation.php';
    $sql = "SELECT * FROM products WHERE deleted = 1";
    $presults = $db->query($sql);
    if(isset($_GET['delete'])) {
        $id = (int)$_GET['delete'];
        // echo $id, die();
        $db->query("UPDATE products SET deleted = 0 WHERE id = '$id'");
        header('Location: productsarh.php');
    }
    // var_dump($presult);die();
?>
<h2 class="text-center">Produse</h2>

<hr>
<table class="table table-bordered table-condensed table-striped">
    <thead>
        <th></th>
        <th>Produs</th>
        <th>Pret</th>
        <th>Categorii</th>
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
                <a href="productsarh.php?delete=<?=$product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
                </td>
                <td><?= $product['title']; ?></td>
                <td><?= money($product['price']); ?></td>
                <td><?= $category; ?></td>
                <td>0</td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php include 'includes/footer.php'; ?>