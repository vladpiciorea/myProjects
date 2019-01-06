<?php require APPROOT . '/views/inc/header.php';?>
<h1><?= $data['title']?></h1>
<p class="lead"><?= $data['description']?></p>
<p class="lead"> Version: <strong> <?= APPVERSION;?> </strong></p>
<?php require APPROOT . '/views/inc/footer.php';?>