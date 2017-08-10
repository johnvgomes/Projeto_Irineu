<?php

if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    
    echo "<h3>Página Inicial</h3>
    <p>Aqui vc encontra...</p>";

}
?>