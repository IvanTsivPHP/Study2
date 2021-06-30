<?php
$result = null;
foreach ($data['posts'] as $post) {
    if (empty($post['pic'])) {
        $hidePic = 'hidden';
    } else {
        $hidePic = '';
    }
    $result .= '<article class="blog-post">
                    <h2 class="blog-post-title"><a href="/post/' . $post['id'] . '">' . $post['title'] . '</a></h2>
                    <p class="blog-post-meta">' . $post['date'] . ' by <a href="/profile/' . $post['author'] . '">' . $post['username'] . '</a></p>
                    <img class="bd-placeholder-img" width="250"  src="/img/post/' . $post['pic'] . '"
                    aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false"
                    ' . $hidePic . '>
                    <p>' . $post['subtitle'] . '</p>';
}
?>
<div class="col-md-8">
    <?=$result?>
<?php
includeView('base\pagination', $data);
?>
</div>
<?php
includeView('base\subsBar', $data);
