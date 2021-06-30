<?php
$table = null;
foreach ($data['table'] as $row) {
    $table .= '<tr><th scope="row">' . $row['id'] . '</th>
               <th>' . $row['email'] . '</th>
               <th><input name="' . $row['id'] . '" type="checkbox"></th></tr>';
}
?>
<div>
    <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?=$table?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
    <div class="blank"></div>
    <?php
    includeView('base\pagination', $data);
    includeView('base\paginationLimitSelector', $data);
    ?>
</div>

