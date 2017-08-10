<?php
include_once '../class/Marca.php';
$m = new Marca();
?>

<form>
    <select>
        <option>Escolha uma marca</option>
        <?php
        $m->carregarCombo();
        ?>
    </select>
</form>
