<?php
$table = null;
foreach ($data['tableContent'] as $row) {
    $table .= '<tr><th scope="row"><a href="/admin/posts/' . $row['id'] . '" ><img width = 50 src = /img/post/' . $row['pic'] . '></a></th>
               <th><a href="/admin/posts/' . $row['id'] . '" >' . $row['id'] . '</a></th>
               <th><a href="/admin/posts/' . $row['id'] . '" >' . $row['title'] . '</a></th>
               <th><a href="/admin/posts/' . $row['id'] . '" >' . $row['username'] . '</a></th>
               <th><a href="/admin/posts/' . $row['id'] . '" >' . $row['date'] . '</a></th>
               <th><form action="/admin/posts" method="post">
               <button type="submit"  name="delete" value="' . $row['id'] . '" class="btn btn-danger btn-sm">
               Delete
               </button>
               </form></th></tr>';
}
?>
    <div>
        <a href="/admin/new-post" class="btn btn-primary">New post</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Article</th>
                <th scope="col">Author</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <?=$table?>
            </tbody>
        </table>
        <?php
        includeView('base\pagination', $data);
        includeView('base\paginationLimitSelector', $data);
        ?>
    </div>

