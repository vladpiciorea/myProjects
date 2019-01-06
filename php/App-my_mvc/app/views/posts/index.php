<?php require APPROOT . '/views/inc/header.php';?>
<?= flash('post_message'); ?>
<div class="row">
    <div class="col-md-6 mb-3">
        <h1>Postari</h1>
    </div>
    <div class="col-md-6">
        <a href="<?= URLROOT?>/posts/add" class="btn btn-primary float-right">
            <i class="fa fa-pencil"></i>Adauga Postare
        </a>
    </div>
</div>
<?php foreach($data['posts'] as $post):?>
    <div class="card card-body mb-3">
        <h4 class="cad-title"><?=$post->title;?></h4>
        <div class="bg-light p-2 mb-3">
            Postat de <?= $post->name;?> pe <?= $post->postCeated;?>
        </div>
        <p class="card-text"><?= $post->body;?></p>
        <a href="<?= URLROOT;?>/posts/show/<?= $post->postId;?>" class="btn btn-dark">Citeste mai mult..</a>
    </div>
<?php endforeach;?>
<?php require APPROOT . '/views/inc/footer.php';?>