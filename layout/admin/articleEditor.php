<div class="article">
    <form id="profile" action="" method="post" enctype="multipart/form-data">

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Title</span>
            <input name="title" type="text" class="form-control"  aria-label="Username"
                   value="<?=isset($data['post']['title'])?$data['post']['title']:''?>"
                   aria-describedby="basic-addon1">
        </div>

        <img  id='img-upload' class="bd-placeholder-img" width="250"
             src="<?=isset($data['post']['pic'])?'/img/post/' . $data['post']['pic']:''?>"
             aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false">

        <div class="form-group">
            <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                   <input name="img" type="file" id="imgInp" form="profile">
                </span>
            </span>
                <input hidden type="text" class="form-control" readonly>
            </div>
        </div>

        <div class="input-group">
            <span class="input-group-text">Subtitle</span>
            <textarea  class="form-control" name="subtitle"
                       aria-label="With textarea"><?=isset($data['post']['subtitle'])?$data['post']['subtitle']:''?></textarea>
        </div>

        <div class="input-group">
            <span class="input-group-text">Article text</span>
            <textarea  class="form-control" name="text"
                       aria-label="With textarea"><?=isset($data['post']['text'])?$data['post']['text']:''?></textarea>
        </div>

        <div>
            <button  class="btn btn-primary" type="submit"><?=$data['button']?></button>
        </div>

        <input hidden name="author" value="<?=isset($data['post']['author'])?$data['post']['author']:$_SESSION['id']?>">
        <div class="alert alert-success fade show" role="alert" <?=!empty($data['status'])?'':'hidden'?>>
            <?=$data['status']?>
        </div>

    </form>
    <?php
    includeView('admin/listComments', $data['comments']);
    ?>
</div>

