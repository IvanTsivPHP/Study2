<div class="col-md-8">
<?php
$table = null;
foreach ($data['table'] as $row) {
    $table .= '<tr><th scope="row"><a href="/admin/pages/' . $row['id'] . '">' . $row['id'] . '</a></th>
               <th><a href="/admin/pages/' . $row['id'] . '">' . $row['title'] . '</a></th>
               <th><a href="/admin/pages/' . $row['id'] . '">' . $row['href'] . '</a></th>
               <th><input name="' . $row['id'] . '" type="checkbox"></th></tr>';
}
?>
    <div>
        <form id="list" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Href</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?= $table ?>
                </tbody>
            </table>

        </form>
    </div>
<a href="/admin/new-page" class="btn btn-primary">New page</a>
    <button form="list" type="submit" class="btn btn-primary">Delete</button>
</div>
