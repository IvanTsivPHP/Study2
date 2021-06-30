<?php
if ($_SERVER['REQUEST_URI'] == '/my-profile') {
    includeView('base\subsBar');
}
?>
<div class="row g-0">
    <div class="col-md-4">
        <img id='img-upload' class="profile bd-placeholder-img" width="250" src="<?='/img/user/' . $data['profile']['userpic']?>"
             aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false">

        <div class="form-group">
            <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                   <input <?=$data['hidden']?> name="img" type="file" id="imgInp" form="profile">
                </span>
            </span>
                <input hidden type="text" class="form-control" readonly>
            </div>
        </div>
                </div>
    <div class="col-md-8">
        <div class="card-body">
            <form id="profile" action="<?=$_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
                <h5 class="card-title"><?=$data['profile']['username']?></h5>
                <p class="card-text">Email: <?=$data['profile']['email']?></p>
                <p class="card-text">Group: <?=$data['profile']['name']?></p>
                <div class="input-group">
                <span class="input-group-text">About me</span>
                <textarea <?=$data['disabled']?> class="form-control" name="about" aria-label="With textarea"><?=$data['profile']['about']?></textarea>
                </div>
                <div>
                    <button <?=$data['hidden']?> class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
            <div class="alert alert-success fade show" role="alert" <?=!empty($data['status'])?'':'hidden'?>>
                <?=$data['status']?>
            </div>
        </div>
    </div>
</div>