<head>
    <!-- Arquivo que carrega o head de cada página -->    
    <title>FYCS</title>

    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" href="./pages/css/jquery-ui.css"/> 
    <script src="./pages/js/jquery-1.9.js"></script>
    <script src="./pages/js/jquery-ui.js"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <script>
        function formatar(mascara, documento) {
            var i = documento.value.length;
            var saida = mascara.substring(0, 1);
            var texto = mascara.substring(i)

            if (texto.substring(0, 1) != saida) {
                documento.value += texto.substring(0, 1);
            }

        }

        function mascara(telefone) {
            if (telefone.value.length == 0)
                telefone.value = '(' + telefone.value; //quando começamos a digitar, o script irá inserir um parênteses no começo do campo.
            if (telefone.value.length == 2)
                telefone.value = telefone.value + ') '; //quando o campo já tiver 3 caracteres (um parênteses e 2 números) o script irá inserir mais um parênteses, fechando assim o código de área.

            if (telefone.value.length == 9)
                telefone.value = telefone.value + '-'; //quando o campo já tiver 8 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone.

        }
    </script>

</head>