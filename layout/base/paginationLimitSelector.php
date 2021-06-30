<?php
$options = ['10', '20', '50', '200', 'all'];
?>
<form>
    <select name="limit" id="limit" onchange="submit();">
        <?php
        foreach ($options as $option) {
            echo '<option ' . isThisLimitSet($option, $data['pagination']['limit']) . ' value="' . $option . '">' . $option . '</option>';
        }
        ?>
    </select>
</form>
