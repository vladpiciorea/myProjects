<?php require APPROOT . '/views/inc/header.php';?>
<a href="<?= URLROOT?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Inapoi</a>
        <div class="card card-body bg-light mt-5">   
        
            <h2>Adauga postare</h2>
        
            <form action="<?= URLROOT?>/posts/add" method="post">
    
                <div class="form-group">
                    <label for="title">Titlu: <sup>*</sup></label>
                    <input type="text" name="title" class="form-control form-control-lg <?=((!empty($data['title_err']))? 'is-invalid' : '') ;?>" value="<?= $data['title'];?>">
                    <span class="invalid-feedback"><?= $data['title_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="body">Text: <sup>*</sup></label>
                    <textarea name="body" class="form-control form-control-lg <?=((!empty($data['body_err']))? 'is-invalid' : '') ;?>"><?= $data['body'];?></textarea>
                    <span class="invalid-feedback"><?= $data['body_err'];?></span>
                </div>
                <input type="submit" class="btn btn-success" value="Posteaza">
            </form>
        </div>
<?php require APPROOT . '/views/inc/footer.php';?>