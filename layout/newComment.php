<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
    <div class="input-group">
        <input hidden name="author_id" value="<?=isset($_SESSION['id'])?$_SESSION['id']:''?>">
        <input hidden name="article_id" value="<?=$data?>">
        <button class="input-group-text">Add comment</button>
        <textarea class="form-control" name="text" aria-label="With textarea" placeholder="New comment"></textarea>
    </div>
</form>