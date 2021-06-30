<?php
$email = null;
$button = 'Subscribe';
$hiddenEmail = null;
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $hiddenEmail = 'hidden';
    if ($_SESSION['sub'] === true) {
        $button = 'Unsubscribe';
    }
}
?>
<div class="subs-div">
    <form action="/subscribe" method="post">
    <input name="email" class="subs" <?=$hiddenEmail?> value="<?=$email?>" placeholder="email" aria-label="Search">
    <input name="action" hidden value="<?=$button?>">
    <button <?=isset($data['disableUnsub'])?'hidden':''?> type="submit" class="btn btn-primary"><?=$button?></button>
    </form>
</div>
