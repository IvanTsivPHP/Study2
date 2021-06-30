<?php
if (empty($data['post']['pic'])) {
    $hidePic = 'hidden';
} else {
    $hidePic = '';
}
?>
<article class="blog-post">
    <h2 class="blog-post-title"><?=$data['post']['title']?></h2>
    <p class="blog-post-meta"><?=$data['post']['date']?> by <a href="/profile/<?=$data['post']['author']?>"><?=$data['post']['username']?></a></p>
    <img class="bd-placeholder-img" width="250" src="/img/post/<?=$data['post']['pic']?>"
         aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false" <?=$hidePic?>>
    <p><?=$data['post']['subtitle']?></p>
    <p><?=$data['post']['text']?></p>

</article>
</div>
<?php
includeView('comments', $data['comments']);
includeView('newComment', $data['post']['id']);
?>
<div class="alert alert-<?=$data['commentStatus'][0]?> fade show" role="alert" <?=is_null($data['commentStatus'][1])?'hidden':''?>>
    <?=$data['commentStatus'][1]?>
</div>
