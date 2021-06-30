<?php
$result = '<div class="article"><ul class="list-group">';
foreach ($data['comments'] as $comment) {
    $result .= '<li class="list-group-item">
                <div class="comment-text"><p><strong>' . $comment['username'] . '</strong></p>
                <p><small>' . $comment['date'] . '</small></p>
                <p>' . $comment['text'] . '</p></div>
                <div class="comment-btn">
                <form action="/admin/comments" method="post">
                <button type="submit"  name="' . $comment['id'] . '" value="1" class="btn comment btn-success ">Approve</button>
                <button type="submit" name="' . $comment['id'] . '" value="0" class="btn comment btn-danger">Reject</button>
                </form></div>
                </li>';
}
$result .= '</ul></div>';

echo $result;
