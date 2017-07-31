<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<title><?php echo date("d/m/Y"); ?> :: Aula PHP</title>
<meta charset="UTF-8">

<link href="../css/menu.css" type="text/css" rel="stylesheet">
<link href="../css/admin.css" type="text/css" rel="stylesheet">
<script language="JavaScript" 
        type="text/javascript" 
        src="../js/MascaraValidacao.js">
</script>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.maskMoney.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        /* Padrão */
        $('.classe_dos_campos').maskMoney({
            symbol: 'US$', /* Símbolo da moeda */
            decimal: '.', /* Separador de decimais */
            thousands: ', ', /* Separador de milhares */
            precision: 2, /* Precisão dos decimais */
            allowZero: false, /* Libera o 0 à esquerda */
            showSymbol: false /* Mostrar símbolo da moeda */
        });
        /* Configuração para Real */
        $('.real').maskMoney({
            symbol: 'R$', /* Símbolo da moeda */
            decimal: ', ', /* Separador de decimais */
            thousands: '.', /* Separador de milhares */
        });
    });
</script>