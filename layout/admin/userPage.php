<div class="col-md-4">
     <img  width="250" height="250" src="<?='/img/user/' . $data['userData']['userpic']?>">
</div>

<div class="col-md-4">
    <div class="card-body">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
            <h5 class="card-title"><?=$data['userData']['username']?></h5>
            <input hidden="true" name="id" value="<?=$data['userData']['id']?>">
            <p class="card-text">Email: <?=$data['userData']['email']?></p>

            <label for="validationServer04" class="form-label">Group: </label>
            <select class="form-select is-invalid" name="access_level" id="validationServer04" required="">
                <?php
                foreach ($data['group'] as $option) {
                    if ($data['userData']['access_level'] == $option['id']) {
                        $selected = 'selected="true"';
                    } else {
                        $selected = '';
                    }
                    echo '<option '. $selected . ' value="'. $option['id'] . '">' . $option['name'] . '</option>';
                }
                ?>
            </select>
            <div>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
        <p <?=$data['uploadMessage']?>>Saved</p>
    </div>
</div>
