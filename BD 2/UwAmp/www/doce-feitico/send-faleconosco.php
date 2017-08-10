<?php


    mysql_connect('localhost', 'root', '');
    mysql_select_db('itadakimasu');



    $key = [];
    $value = [];


    foreach ($_POST as $key => $value) {

        $keys[] = $key;
        $values[] = '"'.mysql_real_escape_string($value).'"';

    }

    mysql_query( 'insert into faleconosco( '.implode(',', $keys).' ) values( '.implode(',', $values).' )' );


    print '<script>alert("Enviado com sucesso!"); window.location = "faleconosco.php"</script>';


?>