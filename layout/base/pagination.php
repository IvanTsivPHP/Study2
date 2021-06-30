<?php
$link = parse_url($_SERVER['REQUEST_URI'])['path'];
?>
<div class="bd-example">
    <nav aria-label="Pagination example">
        <ul class="pagination pagination-sm">
            <?php
            if ($data['pagination']['pages'] > 1) {
                $i = 1;
                while ($i <= $data['pagination']['pages']) {

                    if (($i == 1 && !isset($_GET['page'])) || (isset($_GET['page']) && $i == $_GET['page'])) {
                        $active = ' active" aria-current="page"';
                    } else {
                        $active = '"';
                    }
                    echo '<li class="page-item' . $active . '><a class="page-link" href="' . $link . '?'
                        . getRequestReassemble('page', $i) . '">' . $i++ . '</a></li>';
                }
            }
            ?>
        </ul>
    </nav>
</div>
