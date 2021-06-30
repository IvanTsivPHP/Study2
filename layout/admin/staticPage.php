<div class="article">
    <form id="profile" action="" method="post" enctype="multipart/form-data">

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Title</span>
            <input name="title" type="text" class="form-control"
                   value="<?= isset($data['post']['title']) ? $data['post']['title'] : '' ?>"
                   aria-describedby="basic-addon1">
        </div>
        <div class="input-group">
            <span class="input-group-text">Page link</span>
            <input class="form-control" name="href"
                   value="<?= isset($data['post']['href']) ? $data['post']['href'] : '' ?>"
                   aria-describedby="basic-addon1">
        </div>

        <div class="input-group">
            <span class="input-group-text">Page text</span>
            <textarea class="form-control" name="text"
                      aria-label="With textarea"><?= isset($data['post']['text']) ? $data['post']['text'] : '' ?></textarea>
        </div>

        <div>
            <button class="btn btn-primary" type="submit"><?= $data['button'] ?></button>
        </div>
        <div>
            <?=isset($data['error'])?$data['error']:''?>
        </div>

    </form>
</div>
