<?php
use App\TableMaker;
?>
<div>
    <div class="bd-example">
        <?php
        $table = new TableMaker('table table-striped', $data['header'], $data['content'], $data['rowUrl']);
        $table->run();
        ?>
    </div>
</div>
