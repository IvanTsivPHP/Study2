<?php
$result = '<div><ul class="list-group">';
foreach ($data as $comment) {
    if ($comment['moderated']) {
        $moderatedFlag = '';
    } else $moderatedFlag = 'Waiting for moderation';
    $result .= '<li class="list-group-item">
                <img class="bd-placeholder-img" width="50" height="50" src="/img/user/' . $comment['userpic'] . '"
                aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false"
                </img>
                <p><a href="/profile/' . $comment['author_id'] . '"><strong>' . $comment['username'] . '</strong></a>
                <small>  ' . $moderatedFlag . '</small></p>
                <p><small>' . $comment['date'] . '</small></p>
                <p>' . $comment['text'] . '</p>
                <form action="/admin/posts/' . $comment['article_id'] . '" method="post">
               <button type="submit"  name="delete" value="' . $comment['id'] . '" class="btn btn-danger btn-sm">
               Delete
               </button>
               </form>
                </li>';
}
$result .= '</ul></div>';

echo $result;
