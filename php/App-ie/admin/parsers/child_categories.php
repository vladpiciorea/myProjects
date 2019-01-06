<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ie/core/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/ie/helpers/helpers.php';
$seleted = "";
$parentID = (int)$_POST['parentID'];
$seleted = sanitize($_POST['selected']);
$childQuery = $db->query("SELECT * FROM categories WHERE parent= '$parentID' ORDER BY category");
ob_start();
?>
    <option value=""></option>
    <?php while($child = mysqli_fetch_assoc($childQuery)): ?>
    <option value="<?=$child['id']; ?>" <?= (($seleted == $child['id'])? ' selected' : '');?>><?=$child['category']; ?></option>

    <?php endwhile; ?>
<?php echo ob_get_clean(); ?>