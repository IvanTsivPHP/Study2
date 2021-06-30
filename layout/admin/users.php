<div class="col-md-8">
<?php
includeView('base\table', ['content' => $data['tableContent'], 'header' => $data['tableHeader'], 'rowUrl' => 'id']);
includeView('base\pagination', $data);
includeView('base\paginationLimitSelector', $data);
?>
</div>
