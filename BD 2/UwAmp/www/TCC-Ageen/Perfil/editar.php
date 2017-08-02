<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
    session_destroy();
    //Limpa
    unset($_SESSION['sessao']);
    //Redireciona para a página de autenticação
    echo "<script language='javaScript'>window.location.href='../login.php'</script>";
   
    
}

    
?>
        
<?php

include_once '../class/Conectar.php';
        //instancia Conectar
        $con = new Conectar();
        $email_user= $_SESSION["usuario"];
        $pegaUser = $con->prepare(" SELECT * from usuario WHERE email = '$email_user'");
        $pegaUser->execute(array($_SESSION['usuario']));
	$dadosUser = $pegaUser->fetch();
        
        
include_once '../class/Url.php';
$url = new Url(); 
       
?>
       






<html>
    <head>
        <?php include_once 'head_1.php'; ?>
    </head>
    
	<link href="../css/editar_perfil.css" type="text/css" rel="stylesheet">
    <link href="../css/paginainicial.css" type="text/css" rel="stylesheet">

<body>

 <div id="div1" onClick="fecha();"></div>
 
 <?php
if($dadosUser['acesso']==1)
            {
   
  echo  "<div id=boasvindas>"
  . '<h2 class="bemvindo_text"> BEM VINDO, '
  . $dadosUser['nome']
  . ' ' 
  . $dadosUser['sobrenome']      
  . '</h2>'
 . '<h2 class="bemvindo_subtext">Este é seu primeiro acesso. Que tal começar fazendo alterações no seu perfil?!</h2>'
 . '<div id="fechar_boasvindas">'
  . '<a href="#" onClick="fecha();" ><img class="imgfechar_boas_vindas" src="../imagem/errado.png"> '		
      . "  </a>"
       . " </div>"
        . '<div id="btn_ehpraja">'
       . ' <a href="#" onClick="fecha();" ><h2 class="ehpraja_text"> É pra já</h2> '
					
     . "</a>"
       . " </div>"
. " </div>";
        }
	
?>

<div id="cabecalho" >
 	<img class="imgcheckit_e" src="../imagem/ICON CHECKIT/Logo/Logo_branco_P.png">
  
  		 <div class="configurations">
 
   <a href="#" onClick="abreconfig();" id="bot"><img class="imgconfig" src="../imagem/fullconfiguration_settings_4501.png"> 
					
        </a>

</div>


  		 <div class="menuns">
 
   <a href="#" onClick="abremenu();" id="bot"><img class="imgconfig" src="../imagem/VisualEditor_-_Icon_-_Menu.png"> 
					
        </a>

</div>
            
            <a href="../PaginaInicial/paginainicial.php" ><h1 class="cabecalho_um">Check It</h1></a>
                <img class="imgcheckit_d" src="../imagem/ICON CHECKIT/Logo/Logo_branco_P.png"> </div>
                
   

<div id="config">

      <div class="chanfre">
      <div class="triangleparacima_ladoesq">
      </div>
      <div class="corpomenuchanfre">
      
      <div class="content">
                
                <ul class="ca-menu">
                    <li>
                        <a href="#">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">
<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 512.000000 512.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M2195 4594 c-216 -25 -287 -38 -437 -81 -497 -140 -909 -462 -1111
-868 -229 -458 -181 -1000 126 -1418 l50 -68 -7 -77 c-19 -217 -123 -538 -267
-824 -30 -59 -36 -78 -24 -78 34 0 312 63 480 110 215 59 400 121 550 185 149
64 198 93 189 114 -4 9 -9 92 -12 184 -2 92 -7 167 -11 165 -4 -2 -60 -31
-126 -65 -176 -90 -487 -214 -501 -200 -3 3 8 47 24 99 37 116 76 275 97 396
l16 93 -71 76 c-128 137 -221 297 -262 452 -31 117 -35 320 -10 441 104 502
587 897 1202 985 137 19 406 19 535 0 625 -94 1093 -480 1204 -993 l16 -73 90
-30 c50 -17 132 -50 183 -74 l92 -44 0 72 c0 227 -87 504 -222 714 -283 437
-830 744 -1432 802 -102 10 -292 12 -361 5z"/>
<path d="M3215 2864 c-544 -59 -987 -385 -1105 -814 -94 -344 5 -687 276 -955
167 -165 385 -278 652 -337 145 -32 460 -32 619 0 l113 23 57 -29 c75 -38 218
-91 368 -137 117 -36 416 -108 422 -101 2 1 -19 50 -46 107 -88 187 -161 429
-161 535 0 24 15 55 53 111 124 182 182 413 158 625 -53 467 -440 839 -987
948 -97 20 -334 33 -419 24z m-264 -939 c40 -26 79 -94 79 -138 0 -33 -24 -94
-48 -120 -27 -30 -88 -57 -127 -57 -39 0 -100 27 -127 57 -24 26 -48 87 -48
120 0 14 9 46 21 70 47 96 158 127 250 68z m509 10 c50 -25 90 -92 90 -150 0
-51 -21 -95 -63 -132 -108 -95 -278 -18 -280 125 -2 131 135 216 253 157z
m518 -3 c108 -49 116 -220 13 -289 -74 -50 -155 -42 -217 21 -62 61 -70 138
-24 213 46 75 136 97 228 55z"/>
</g>
</svg>
</div>
 <!--IMAGEM IDIOMA FIM-->
</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Idioma</h2>
                                <h3 class="ca-sub">Português-BR</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">

<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 626.000000 626.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,626.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M2797 6249 c-49 -4 -110 -12 -135 -18 -26 -5 -80 -15 -121 -22 -67
-10 -238 -59 -371 -107 -156 -55 -404 -196 -581 -329 -112 -84 -379 -344 -379
-368 0 -4 -24 -38 -53 -74 -29 -36 -65 -86 -81 -111 -16 -25 -41 -63 -55 -85
-35 -54 -161 -309 -161 -327 0 -8 -4 -18 -9 -23 -31 -35 -120 -377 -142 -545
-16 -126 -16 -469 0 -600 20 -170 103 -475 155 -575 9 -16 16 -33 16 -37 0 -4
18 -45 41 -90 74 -150 64 -133 158 -278 154 -236 439 -518 654 -648 l27 -17
170 170 c94 93 170 175 170 181 0 11 -73 63 -169 121 -47 28 -199 168 -281
259 -122 133 -197 244 -276 405 -70 143 -84 174 -106 249 -42 140 -49 170 -69
310 -45 309 -4 640 114 935 13 33 34 78 45 100 12 22 22 43 22 47 0 20 121
204 216 329 46 60 238 248 281 276 15 9 46 32 68 49 139 111 419 238 645 293
151 36 221 44 425 43 208 0 302 -12 480 -62 228 -63 452 -177 635 -321 145
-115 324 -312 415 -458 6 -9 18 -28 28 -44 33 -49 117 -225 148 -310 58 -156
109 -410 109 -543 l0 -84 120 0 119 0 6 38 c3 20 10 53 15 72 5 19 16 94 25
165 23 192 47 277 96 337 l22 27 -37 108 c-20 59 -48 133 -62 163 -47 103
-147 295 -163 315 -16 19 -84 119 -140 204 -37 57 -369 382 -436 426 -33 22
-84 57 -112 78 -84 60 -354 200 -438 227 -22 7 -45 16 -50 21 -6 4 -44 17 -85
29 -41 11 -91 26 -110 31 -65 19 -234 49 -360 64 -132 16 -297 17 -443 4z"/>
<path d="M2912 5380 c-44 -18 -104 -75 -125 -120 -22 -45 -22 -48 -22 -715 0
-668 0 -670 22 -710 28 -53 78 -98 131 -119 38 -14 119 -16 786 -16 714 0 745
1 787 19 221 99 182 419 -57 460 -38 7 -271 11 -622 11 l-562 0 0 498 c0 330
-4 510 -11 537 -15 53 -75 124 -124 146 -43 20 -162 25 -203 9z"/>
<path d="M5363 4405 c-27 -21 -33 -35 -41 -93 -62 -408 -82 -501 -157 -727
-37 -113 -123 -321 -144 -350 -4 -5 -14 -26 -21 -45 -8 -19 -21 -46 -30 -60
-9 -14 -34 -54 -55 -90 -56 -97 -102 -165 -119 -179 -9 -8 -16 -18 -16 -23 0
-12 -16 -32 -144 -184 -265 -313 -560 -543 -926 -722 -110 -54 -370 -154 -430
-166 -19 -4 -64 -16 -100 -27 -87 -25 -450 -77 -562 -79 -15 0 -17 27 -20 308
-3 274 -5 311 -21 335 -25 39 -72 60 -120 54 -38 -5 -77 -42 -584 -549 -300
-299 -551 -555 -559 -570 -18 -34 -18 -81 0 -116 8 -15 261 -273 563 -574
l549 -548 45 0 c59 0 106 38 119 95 5 22 10 171 10 331 l0 291 43 11 c56 14
131 30 187 38 56 8 257 60 324 84 28 9 83 28 121 40 39 12 74 26 79 31 6 5 16
9 24 9 7 0 37 11 65 24 29 14 95 43 147 66 52 23 124 58 160 78 116 64 144 79
196 108 223 125 646 494 838 729 125 153 216 278 216 295 0 4 7 13 16 21 8 7
24 29 35 48 10 20 36 63 57 97 21 33 56 96 77 140 22 43 45 86 52 94 12 15 60
125 89 205 8 22 23 58 33 80 16 35 50 145 111 355 73 256 114 696 92 1008 -7
90 -8 95 -40 123 -43 39 -112 41 -159 4z"/>
</g>
</svg>

</div>
 <!--IMAGEM IDIOMA FIM-->
                            </span>
                            <div class="ca-content">
                                <h2 class="ca-main">Historico de</h2>
                                <h3 class="ca-sub">Atividades</h3>
                            </div>
                        </a>
                    </li>
                     <li>
                        <a href="#">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">

<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 225.000000 226.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,226.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M1097 2196 c-7 -8 -49 -122 -91 -253 -43 -131 -98 -302 -124 -380
l-46 -143 -399 0 c-255 0 -405 -4 -418 -10 -12 -7 -19 -21 -18 -38 0 -23 21
-42 152 -136 313 -223 502 -367 501 -379 -1 -6 -54 -174 -119 -372 -65 -198
-120 -369 -122 -380 -7 -31 31 -61 60 -48 12 6 162 112 332 237 171 124 315
226 320 225 6 0 150 -101 320 -225 171 -125 320 -231 333 -237 19 -9 27 -7 44
11 l22 22 -123 377 c-68 208 -124 384 -125 390 -1 12 190 157 501 379 130 94
152 113 152 136 1 17 -6 31 -18 38 -13 6 -163 10 -419 10 l-398 0 -63 194
c-142 443 -189 579 -202 587 -20 13 -36 11 -52 -5z"/>
</g>
</svg>

</div>
 <!--IMAGEM IDIOMA FIM-->
                            </span>
                            <div class="ca-content">
                                <h2 class="ca-main">Meus</h2>
                                <h3 class="ca-sub">Favoritos</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">

<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 626.000000 626.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,626.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M3101 6081 c-6 -11 -40 -111 -77 -223 -36 -111 -87 -268 -113 -348
-27 -80 -77 -233 -111 -340 -35 -107 -99 -303 -142 -435 -83 -253 -99 -328
-78 -389 6 -20 41 -80 76 -133 71 -105 93 -164 101 -265 29 -351 -311 -615
-647 -503 -119 40 -225 134 -285 253 -32 64 -77 117 -119 140 -28 16 -99 17
-858 17 -871 0 -868 0 -842 -43 11 -17 79 -70 275 -212 57 -41 125 -91 151
-110 244 -179 614 -447 657 -477 25 -17 111 -80 191 -138 80 -59 161 -114 180
-122 50 -22 158 -12 238 21 75 32 181 42 271 27 195 -32 366 -208 394 -406 35
-243 -102 -465 -335 -544 -46 -16 -87 -21 -160 -21 -116 0 -138 -10 -172 -79
-13 -25 -67 -181 -121 -346 -162 -500 -210 -649 -296 -910 -45 -137 -84 -269
-87 -292 -4 -42 -4 -43 25 -43 20 0 54 18 109 59 68 50 190 139 273 199 38 28
782 568 826 600 181 131 198 147 217 190 15 34 18 57 14 105 -23 255 -20 289
42 412 30 61 130 162 196 198 139 77 334 76 474 -1 64 -35 164 -137 194 -197
62 -123 65 -157 42 -412 -10 -112 8 -135 231 -295 22 -16 75 -54 117 -86 43
-31 92 -67 110 -80 66 -47 525 -379 826 -599 89 -65 136 -92 156 -93 28 0 28
1 24 43 -3 23 -41 153 -86 287 -88 269 -186 570 -312 960 -45 140 -93 276
-106 302 -34 67 -54 78 -145 78 -222 0 -409 145 -469 363 -25 90 -25 154 -1
248 24 94 58 154 125 222 139 140 331 180 540 111 62 -21 91 -25 137 -21 74 6
84 13 369 223 25 18 151 110 280 203 129 93 255 185 279 203 24 18 63 47 87
63 146 102 423 306 457 336 50 44 45 65 -15 74 -24 3 -412 5 -864 3 l-821 -3
-37 -29 c-42 -32 -68 -69 -93 -136 -74 -195 -255 -321 -463 -321 -133 0 -244
45 -342 139 -102 97 -148 210 -148 358 0 139 44 238 159 359 75 80 94 116 94
180 0 44 -126 455 -258 840 -13 39 -63 192 -111 340 -145 449 -154 476 -164
496 -14 24 -46 25 -59 0z m142 -2726 c123 -37 225 -126 281 -245 28 -59 31
-74 31 -165 0 -116 -20 -179 -83 -261 -48 -63 -64 -77 -138 -119 -119 -68
-276 -70 -403 -5 -90 46 -147 107 -195 209 -28 61 -31 74 -31 171 0 97 3 110
32 173 18 37 39 75 48 85 88 96 142 132 235 158 62 17 165 17 223 -1z"/>
<path d="M2770 3130 c0 -19 7 -20 95 -20 l95 0 0 -205 0 -205 40 0 40 0 0 205
0 205 95 0 c88 0 95 1 95 20 0 19 -7 20 -230 20 -223 0 -230 -1 -230 -20z"/>
<path d="M3330 2925 l0 -225 40 0 40 0 0 225 0 225 -40 0 -40 0 0 -225z"/>
</g>
</svg>


</div>
 <!--IMAGEM IDIOMA FIM-->
                            </span>
                            <div class="ca-content">
                                <h2 class="ca-main">Sobre a</h2>
                                <h3 class="ca-sub">StarTI</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="../logout.php">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">
<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 587.000000 640.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,640.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M2909 6377 c-52 -28 -105 -92 -118 -145 -5 -21 -14 -564 -20 -1252
-19 -2013 -19 -1785 7 -1862 57 -164 142 -223 225 -158 38 30 96 155 108 231
13 88 40 3048 28 3092 -11 40 -51 81 -101 101 -51 22 -77 20 -129 -7z"/>
<path d="M1140 5270 c-50 -26 -126 -93 -268 -233 -713 -703 -1015 -1719 -806
-2708 110 -523 379 -1030 754 -1422 551 -576 1322 -907 2115 -907 1356 0 2539
939 2855 2265 189 791 36 1644 -416 2320 -132 198 -269 357 -464 538 -153 142
-169 152 -250 152 -58 0 -72 -4 -103 -28 -69 -52 -95 -144 -63 -220 8 -20 62
-77 136 -142 562 -499 870 -1181 871 -1930 1 -420 -85 -790 -267 -1155 -358
-714 -1000 -1213 -1775 -1379 -321 -68 -727 -68 -1048 0 -923 197 -1664 880
-1935 1782 -72 242 -97 399 -103 675 -8 309 19 530 98 799 138 477 428 922
809 1243 103 86 122 118 118 196 -3 49 -10 69 -31 98 -55 71 -153 96 -227 56z"/>
</g>
</svg>

</div>
 <!--IMAGEM IDIOMA FIM-->
                            </span>
                            <div class="ca-content">
                                <h2 class="ca-main">Sair</h2>
                                <h3 class="ca-sub">Logout</h3>
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </div><!-- content -->
            </div>
        </div>
        </div>
  
  <div id="menu">

      <div class="chanfre">
      <div class="triangleparacima_ladodir">
      </div>
      <div class="corpomenuchanfre">
      
      <div class="content">
                
                <ul class="ca-menu">
                    <li>
                        <a href="#">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">
<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 626.000000 626.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,626.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M5264 5710 c-18 -4 -45 -16 -61 -28 -16 -11 -734 -728 -1597 -1594
l-1568 -1573 -497 501 c-445 450 -501 503 -540 514 -84 22 -86 21 -553 -447
-365 -367 -428 -434 -439 -470 -25 -87 -63 -44 968 -1075 522 -521 959 -956
973 -966 32 -25 96 -35 138 -23 26 8 528 505 2092 2068 2256 2257 2099 2091
2070 2186 -10 36 -71 101 -424 453 -226 226 -424 420 -441 431 -36 24 -79 33
-121 23z"/>
</g>
</svg>

</div>
 <!--IMAGEM IDIOMA FIM-->
</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Termos de </h2>
                                <h3 class="ca-sub">Uso</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">

<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 626.000000 626.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,626.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M2948 6250 c-449 -57 -808 -228 -1109 -529 -88 -89 -249 -285 -249
-304 0 -4 -12 -23 -26 -44 -73 -108 -166 -332 -208 -504 -47 -192 -48 -217
-55 -874 l-6 -630 -45 -22 c-25 -12 -76 -31 -115 -43 -143 -45 -221 -103 -251
-189 -17 -46 -20 -2494 -4 -2552 13 -45 60 -106 103 -133 96 -59 559 -209 857
-278 1031 -237 2096 -186 3095 147 194 65 299 105 342 131 43 27 90 88 103
133 16 58 13 2506 -4 2552 -32 89 -90 132 -266 194 -58 20 -115 43 -127 51
l-21 13 -5 633 c-5 656 -7 679 -52 866 -42 169 -136 397 -209 505 -14 21 -26
40 -26 44 0 19 -161 215 -249 304 -282 281 -606 446 -1011 515 -103 18 -370
26 -462 14z m390 -640 c114 -21 223 -56 327 -107 293 -143 538 -439 622 -753
40 -150 43 -201 43 -717 0 -423 -2 -503 -14 -503 -8 0 -57 9 -109 20 -142 29
-424 69 -587 83 -187 16 -793 16 -980 0 -153 -13 -497 -62 -615 -88 -38 -8
-76 -15 -82 -15 -21 0 -18 975 2 1093 32 179 111 369 213 509 68 92 112 138
219 227 261 219 620 312 961 251z m-123 -2820 c91 -15 200 -73 269 -143 209
-213 183 -563 -54 -733 l-49 -35 -3 -447 c-3 -437 -3 -448 -25 -488 -12 -22
-39 -56 -61 -76 -119 -108 -307 -71 -385 76 -22 40 -22 51 -25 488 l-3 447
-49 35 c-97 69 -173 193 -191 309 -33 211 79 426 272 521 105 52 190 65 304
46z"/>
</g>
</svg>

</div>
 <!--IMAGEM IDIOMA FIM-->
                            </span>
                            <div class="ca-content">
                                <h2 class="ca-main">Segurança</h2>
                                <h3 class="ca-sub">da conta</h3>
                            </div>
                        </a>
                    </li>
                     <li>
                        <a href="#">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">
<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 128.000000 128.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M240 640 l0 -80 80 0 80 0 0 80 0 80 -80 0 -80 0 0 -80z"/>
<path d="M560 640 l0 -80 80 0 80 0 0 80 0 80 -80 0 -80 0 0 -80z"/>
<path d="M880 640 l0 -80 80 0 80 0 0 80 0 80 -80 0 -80 0 0 -80z"/>
</g>
</svg>

</div>
 <!--IMAGEM IDIOMA FIM-->
                            </span>
                            <div class="ca-content">
                                <h2 class="ca-main">Sobre</h2>
                                <h3 class="ca-sub">a conta</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">

<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 256.000000 256.000000"
 preserveAspectRatio="xMidYMid meet">
<metadata>
Created by potrace 1.13, written by Peter Selinger 2001-2015
</metadata>
<g transform="translate(0.000000,256.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M218 2530 c-61 -48 -58 24 -58 -1253 0 -802 3 -1174 11 -1194 20 -54
47 -73 106 -73 65 0 94 14 398 190 121 70 530 306 910 525 379 218 708 410
731 426 61 42 84 75 84 121 0 53 -22 92 -73 126 -23 16 -305 182 -627 369
-322 187 -737 429 -924 537 -186 108 -360 208 -387 221 -61 32 -135 34 -171 5z"/>
</g>
</svg>

</div>
 <!--IMAGEM IDIOMA FIM-->
                            </span>
                            <div class="ca-content">
                                <h2 class="ca-main">Tutorial</h2>
                                <h3 class="ca-sub">CheckIT</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="../admin/logout.php">
                            <span class="ca-icon">
                            <!--IMAGEM IDIOMA INICIO-->
                            <div class="imagesvg">

<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="35pt" height="35pt" viewBox="0 0 601.000000 640.000000"
 preserveAspectRatio="xMidYMid meet">
<metadata>
Created by potrace 1.13, written by Peter Selinger 2001-2015
</metadata>
<g transform="translate(0.000000,640.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M2812 6389 c-705 -68 -1381 -525 -1826 -1233 l-56 -89 0 -417 0 -417
-92 -17 c-414 -76 -730 -389 -819 -811 -18 -81 -17 -294 0 -380 78 -391 363
-694 748 -796 52 -14 126 -23 223 -28 l145 -6 2 -474 2 -473 37 -67 c307 -554
832 -941 1438 -1061 48 -10 65 -19 100 -55 25 -27 56 -47 81 -54 23 -6 130
-11 256 -11 l217 0 53 28 c43 22 59 38 82 82 25 47 28 63 23 109 -6 70 -45
128 -106 159 -44 22 -52 23 -291 20 l-246 -3 -42 -29 c-41 -29 -42 -29 -99
-16 -234 52 -527 201 -750 382 -156 127 -344 332 -460 505 l-42 62 0 1818 0
1819 73 101 c345 482 809 788 1327 875 114 19 385 15 500 -6 201 -39 424 -127
605 -241 268 -168 454 -349 669 -649 l56 -78 0 -1369 0 -1369 213 0 c358 0
518 39 723 175 209 139 355 345 421 594 23 84 26 116 26 251 0 134 -4 168 -26
250 -105 394 -426 690 -816 752 l-81 12 0 430 0 430 -84 125 c-225 339 -507
623 -816 823 -418 272 -896 393 -1368 347z"/>
</g>
</svg>

</div>
 <!--IMAGEM IDIOMA FIM-->
                            </span>
                            <div class="ca-content">
                                <h2 class="ca-main">Fale</h2>
                                <h3 class="ca-sub">Conosco</h3>
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </div><!-- content -->
            </div>
        </div>
        </div>
    
					
        
        
	
<div id="tudo">


  <div id="conteudo">
  
    <div id="lado_e"><!-- INICIO LADO ESQUERDO MENU-->
    
      <div id="caixa_pesquisa">
        
        <form>
            <img  class="searchbtn" src="../imagem/search.png" >
          <input type="text" id="pesquisar" class="pesquisa" placeholder="O que você procura?">
        </form>
        
      </div>
      <div id="caixa_eventos"><!-- INICIO CAIXA Eventos-->
      <div id="eventos">
      <div id="caixa_icons">
      <div id="texto_evento">
      <h2 class="eventos_text"> Eventos <h2>
      </div>
     <div id="alimento">
      
         <a href="../Alimentos/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_40.png" ></a>
         <a href="../Alimentos/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_comida.png"></div></a>
		</div>
        <div id="texto_alimento">
      <h2 class="descricao_icon_text"> Alimentos <h2>
      </div>
        
        <div id="local">
      
            <a href="../Locais/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_58.png" ></a>
      <a href="../Locais/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_localização_2.png"></div></a>
		</div>
        <div id="texto_local">
      <h2 class="descricao_icon_text"> Locais <h2>
      </div>
        
          <div id="musica">
      
              <a href="../Musica/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_66.png" ></a>
      <a href="../Musica/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_musica.png"></div></a>
		</div>
         <div id="texto_musica">
      <h2 class="descricao_icon_text"> Musica <h2>
      </div>
      <div id="comunidade">
      
          <a href="../Comunidade/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_83.png" ></a>
  		<a href="../Comunidade/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_grupo.png"></div></a>
		</div>
        <div id="texto_comunidade">
      <h2 class="descricao_icon_text"> Comunidade <h2>
      </div>
      <div id="lista_convidados">
      
          <a href="../Lista_de_convidados/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_50.png" ></a>
  		<a href="../Lista_de_convidados/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_certo_2.png"></div></a>
		</div>
        <div id="texto_lista_convidados">
      <h2 class="descricao_icon_text"> Lista de<br>Convidados <h2>
      </div>
     
      <div id="entretenimento">
      
          <a href="../Entretenimento/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_16.png" ></a>
  		<a href="../Entretenimento/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_loja.png"></div></a>
		</div>
        <div id="texto_entretenimento">
      <h2 class="descricao_icon_text"> Entretenimento <h2>
      </div>
      
     <div id="novos_eventos">
      
         <a href="../Novos_eventos/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_33.png" ></a>
  		<a href="../Novos_eventos/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_add.png"></div></a>
		</div>
        <div id="texto_novos_eventos">
      <h2 class="descricao_icon_text"> Novos<br>Eventos <h2>
      </div>
      
      <div id="meus_eventos">
      
          <a href="../Meus_eventos/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_14.png" ></a>
  		<a href="../Meus_eventos/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_home.png"></div></a>
		</div>
        <div id="texto_meus_eventos">
      <h2 class="descricao_icon_text"> Meus<br>Eventos <h2>
      </div>
      
       </div> 
      </div>
      
      
      </div><!-- FIM CAIXA Eventos-->
      
    </div><!-- FIM LADO ESQUERDO MENU-->
    <a name="topo"><div id="centro_conteudo"></a>
     <div id="titulo_centro_conteudo">
     <h2 class="titulo_conteudo_text">Editar Perfil</h2>
     </div>
     <div class="perfil_main">
     
    
<div class="geral">
    <div id="site">
        <div class="contenido">
            <div id="conteudo_form_perfil">
                <form name="formnovaconta" enctype="multipart/form-data" method="post" action="">
 					
                       <?php
                       $imagem_user =$dadosUser['imagem_user'];
                       ?>
                    <div id="imagem_perfil_usuario"><img class="img_perfil_user" src="<?php if ($dadosUser['imagem_user']==""){ echo "../foto_usuario/usuario.png";}  else{ echo "../foto_usuario/$imagem_user";}?>" alt="foto de perfil"></div>    
                    <input class="btn_imagem" type="file" name="arquivo" />
   		 <br>		

                    <input placeholder="Nome" name="nome" type="text" title="Insira seu Nome aqui" 
                           value="<?php echo $dadosUser['nome'];?>" size="40" maxlength="50">

                    <input placeholder="Sobrenome" name="sobrenome" type="text"  title="Insira seu Sobrenome aqui" 
                           value="<?php echo $dadosUser['sobrenome'];?>" size="40" maxlength="50">
                           
                           
                    <input placeholder="N&uacute;mero do celular" name="num_celular" type="text" title="Insira seu celular com DDD e digito 9" 
                    		value="<?php echo $dadosUser['num_celular'];?>" size="40" maxlength="15">
                        
                        <select name="uf" >
                        <option  <?php if ($dadosUser['uf'] == "UF") echo 'selected' ; ?> value="UF">UF</option>
                        <option  <?php if ($dadosUser['uf'] == "AC") echo 'selected' ; ?> value="AC">AC</option>
                        <option  <?php if ($dadosUser['uf'] == "AL") echo 'selected' ; ?> value="AL">AL</option>
                        <option  <?php if ($dadosUser['uf'] == "AP") echo 'selected' ; ?> value="AP">AP</option>
                        <option  <?php if ($dadosUser['uf'] == "AM") echo 'selected' ; ?> value="AM">AM</option>
                        <option  <?php if ($dadosUser['uf'] == "BA") echo 'selected' ; ?> value="BA">BA</option>
                        <option  <?php if ($dadosUser['uf'] == "CE") echo 'selected' ; ?> value="CE">CE</option>
                        <option  <?php if ($dadosUser['uf'] == "DF") echo 'selected' ; ?> value="DF">DF</option>
                        <option  <?php if ($dadosUser['uf'] == "ES") echo 'selected' ; ?> value="ES">ES</option>
                        <option  <?php if ($dadosUser['uf'] == "GO") echo 'selected' ; ?> value="GO">GO</option>
                        <option  <?php if ($dadosUser['uf'] == "MA") echo 'selected' ; ?> value="MA">MA</option>
                        <option  <?php if ($dadosUser['uf'] == "MT") echo 'selected' ; ?> value="MT">MT</option>
                        <option  <?php if ($dadosUser['uf'] == "MS") echo 'selected' ; ?> value="MS">MS</option>
                        <option  <?php if ($dadosUser['uf'] == "MG") echo 'selected' ; ?> value="MG">MG</option>
                        <option  <?php if ($dadosUser['uf'] == "PR") echo 'selected' ; ?> value="PR">PR</option>
                        <option  <?php if ($dadosUser['uf'] == "PB") echo 'selected' ; ?> value="PB">PB</option>
                        <option  <?php if ($dadosUser['uf'] == "PA") echo 'selected' ; ?> value="PA">PA</option>
                        <option  <?php if ($dadosUser['uf'] == "PE") echo 'selected' ; ?> value="PE">PE</option>
                        <option  <?php if ($dadosUser['uf'] == "PI") echo 'selected' ; ?> value="PI">PI</option>
                        <option  <?php if ($dadosUser['uf'] == "RJ") echo 'selected' ; ?> value="RJ">RJ</option>
                        <option  <?php if ($dadosUser['uf'] == "RN") echo 'selected' ; ?> value="RN">RN</option>
                        <option  <?php if ($dadosUser['uf'] == "RS") echo 'selected' ; ?> value="RS">RS</option>
                        <option  <?php if ($dadosUser['uf'] == "RO") echo 'selected' ; ?> value="RO">RO</option>
                        <option  <?php if ($dadosUser['uf'] == "RR") echo 'selected' ; ?> value="RR">RR</option>
                        <option  <?php if ($dadosUser['uf'] == "SC") echo 'selected' ; ?> value="SC">SC</option>
                        <option  <?php if ($dadosUser['uf'] == "SE") echo 'selected' ; ?> value="SE">SE</option>
                        <option  <?php if ($dadosUser['uf'] == "SP") echo 'selected' ; ?> value="SP">SP</option>
                        <option  <?php if ($dadosUser['uf'] == "TO") echo 'selected' ; ?> value="TO">TO</option>
                       
                    </select>

                           
                    <input placeholder="cidade" name="cidade" type="text" title="Insira seu celular com DDD e digito 9" 
                           value="<?php echo $dadosUser['cidade'];?>" size="40" maxlength="15">

                    <input placeholder="E-mail" name="email" disabled type="email" title="Insira seu E-mail aqui" 
                           value="<?php echo $dadosUser['email'];?>" size="40" maxlength="100">
                    <!--
                                        <input placeholder="Repita seu E-mail" name="txtemail_conferencia" type="email" id="search-text" title="Insira seu E-mail aqui" 
                                               value="" size="40" maxlength="100">
                    -->
                    
                     <select name="dia_nasc">
                        <option  <?php if ($dadosUser['dia_nasc'] == "Dia" ) echo 'selected' ; ?> value="Dia">Dia</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 1) echo 'selected' ; ?> value="1">01</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 2) echo 'selected' ; ?> value="2">02</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 3) echo 'selected' ; ?> value="3">03</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 4) echo 'selected' ; ?> value="4">04</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 5) echo 'selected' ; ?> value="5">05</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 6) echo 'selected' ; ?> value="6">06</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 7 ) echo 'selected' ; ?> value="7">07</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 8 ) echo 'selected' ; ?> value="8">08</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 9 ) echo 'selected' ; ?> value="9">09</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 10 ) echo 'selected' ; ?> value="10">10</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 11 ) echo 'selected' ; ?> value="11">11</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 12 ) echo 'selected' ; ?> value="12">12</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 13 ) echo 'selected' ; ?> value="13">13</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 14) echo 'selected' ; ?> value="14">14</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 15 ) echo 'selected' ; ?> value="15">15</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 16 ) echo 'selected' ; ?> value="16">16</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 17 ) echo 'selected' ; ?> value="17">17</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 18 ) echo 'selected' ; ?> value="18">18</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 19 ) echo 'selected' ; ?> value="19">19</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 20 ) echo 'selected' ; ?> value="20">20</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 21 ) echo 'selected' ; ?> value="21">21</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 22 ) echo 'selected' ; ?> value="22">22</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 23 ) echo 'selected' ; ?> value="23">23</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 24 ) echo 'selected' ; ?> value="24">24</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 25 ) echo 'selected' ; ?> value="25">25</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 26 ) echo 'selected' ; ?> value="26">26</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 27 ) echo 'selected' ; ?> value="27">27</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 28 ) echo 'selected' ; ?> value="28">28</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 29 ) echo 'selected' ; ?> value="29">29</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 30 ) echo 'selected' ; ?> value="30">30</option>
                        <option  <?php if ($dadosUser['dia_nasc'] == 31 ) echo 'selected' ; ?> value="31">31</option>
                   </select>


                    <select name="mes_nasc"  >
                        <option  <?php if ($dadosUser['mes_nasc'] == "Mes") echo 'selected' ; ?> value="Mes">M&ecirc;s</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 1) echo 'selected' ; ?> value="1">01</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 2) echo 'selected' ; ?> value="2">02</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 3) echo 'selected' ; ?> value="3">03</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 4) echo 'selected' ; ?> value="4">04</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 5) echo 'selected' ; ?> value="5">05</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 6) echo 'selected' ; ?> value="6">06</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 7) echo 'selected' ; ?> value="7">07</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 8) echo 'selected' ; ?> value="8">08</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 9) echo 'selected' ; ?> value="9">09</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 10) echo 'selected' ; ?> value="10">10</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 11) echo 'selected' ; ?> value="11">11</option>
                        <option  <?php if ($dadosUser['mes_nasc'] == 12) echo 'selected' ; ?> value="12">12</option>

                    </select>


                    <select name="ano_nasc" id="cboanonasc"  >
                        <option  <?php if ($dadosUser['ano_nasc'] == "Ano") echo 'selected' ; ?> value="Ano">Ano</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1895) echo 'selected' ; ?> value="1895">1895</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1896) echo 'selected' ; ?>  value="1896">1896</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1897) echo 'selected' ; ?>  value="1897">1897</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1898) echo 'selected' ; ?>  value="1898">1898</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1899) echo 'selected' ; ?>  value="1899">1899</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1900) echo 'selected' ; ?>  value="1900">1900</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1901) echo 'selected' ; ?>  value="1901">1901</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1902) echo 'selected' ; ?>  value="1902">1902</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1903) echo 'selected' ; ?>  value="1903">1903</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1904) echo 'selected' ; ?>  value="1904">1904</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1905) echo 'selected' ; ?>  value="1905">1905</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1906) echo 'selected' ; ?>  value="1906">1906</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1907) echo 'selected' ; ?>  value="1907">1907</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1908) echo 'selected' ; ?>  value="1908">1908</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1909) echo 'selected' ; ?>  value="1909">1909</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1910) echo 'selected' ; ?>  value="1910">1910</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1911) echo 'selected' ; ?>  value="1911">1911</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1912) echo 'selected' ; ?>  value="1912">1912</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1913) echo 'selected' ; ?>  value="1913">1913</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1914) echo 'selected' ; ?>  value="1914">1914</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1915) echo 'selected' ; ?>  value="1915">1915</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1916) echo 'selected' ; ?>  value="1916">1916</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1917) echo 'selected' ; ?>  value="1917">1917</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1918) echo 'selected' ; ?>  value="1918">1918</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1919) echo 'selected' ; ?>  value="1919">1919</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1920) echo 'selected' ; ?>  value="1920">1920</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1921) echo 'selected' ; ?>  value="1921">1921</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1922) echo 'selected' ; ?>  value="1922">1922</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1923) echo 'selected' ; ?>  value="1923">1923</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1924) echo 'selected' ; ?>  value="1924">1924</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1925) echo 'selected' ; ?>  value="1925">1925</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1926) echo 'selected' ; ?>  value="1926">1926</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1927) echo 'selected' ; ?>  value="1927">1927</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1928) echo 'selected' ; ?>  value="1928">1928</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1929) echo 'selected' ; ?>  value="1929">1929</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1930) echo 'selected' ; ?>  value="1930">1930</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1931) echo 'selected' ; ?>  value="1931">1931</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1932) echo 'selected' ; ?>  value="1932">1932</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1933) echo 'selected' ; ?>  value="1933">1933</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1934) echo 'selected' ; ?>  value="1934">1934</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1935) echo 'selected' ; ?>  value="1935">1935</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1936) echo 'selected' ; ?>  value="1936">1936</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1937) echo 'selected' ; ?>  value="1937">1937</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1938) echo 'selected' ; ?>  value="1938">1938</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1939) echo 'selected' ; ?>  value="1939">1939</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1940) echo 'selected' ; ?>  value="1940">1940</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1941) echo 'selected' ; ?>  value="1941">1941</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1942) echo 'selected' ; ?>  value="1942">1942</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1943) echo 'selected' ; ?>  value="1943">1943</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1944) echo 'selected' ; ?>  value="1944">1944</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1945) echo 'selected' ; ?>  value="1945">1945</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1946) echo 'selected' ; ?>  value="1946">1946</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1947) echo 'selected' ; ?>  value="1947">1947</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1948) echo 'selected' ; ?>  value="1948">1948</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1949) echo 'selected' ; ?>  value="1949">1949</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1950) echo 'selected' ; ?>  value="1950">1950</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1951) echo 'selected' ; ?>  value="1951">1951</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1952) echo 'selected' ; ?>  value="1952">1952</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1953) echo 'selected' ; ?>  value="1943">1953</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1954) echo 'selected' ; ?>  value="1954">1954</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1955) echo 'selected' ; ?>  value="1955">1955</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1956) echo 'selected' ; ?>  value="1956">1956</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1957) echo 'selected' ; ?>  value="1957">1957</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1958) echo 'selected' ; ?>  value="1958">1958</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1959) echo 'selected' ; ?>  value="1959">1959</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1960) echo 'selected' ; ?>  value="1960">1960</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1961) echo 'selected' ; ?>  value="1961">1961</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1962) echo 'selected' ; ?>  value="1962">1962</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1963) echo 'selected' ; ?>  value="1963">1963</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1964) echo 'selected' ; ?>  value="1964">1964</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1965) echo 'selected' ; ?>  value="1965">1965</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1966) echo 'selected' ; ?>  value="1966">1966</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1967) echo 'selected' ; ?>  value="1967">1967</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1968) echo 'selected' ; ?>  value="1968">1968</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1969) echo 'selected' ; ?>  value="1969">1969</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1970) echo 'selected' ; ?>  value="1970">1970</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1971) echo 'selected' ; ?>  value="1971">1971</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1972) echo 'selected' ; ?>  value="1972">1972</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1973) echo 'selected' ; ?>  value="1973">1973</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1974) echo 'selected' ; ?>  value="1974">1974</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1975) echo 'selected' ; ?>  value="1975">1975</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1976) echo 'selected' ; ?>  value="1976">1976</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1977) echo 'selected' ; ?>  value="1977">1977</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1978) echo 'selected' ; ?>  value="1978">1978</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1979) echo 'selected' ; ?>  value="1979">1979</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1980) echo 'selected' ; ?>  value="1980">1980</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1981) echo 'selected' ; ?>  value="1981">1981</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1982) echo 'selected' ; ?>  value="1982">1982</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1983) echo 'selected' ; ?>  value="1983">1983</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1984) echo 'selected' ; ?>  value="1984">1984</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1985) echo 'selected' ; ?>  value="1985">1985</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1986) echo 'selected' ; ?>  value="1986">1986</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1987) echo 'selected' ; ?>  value="1987">1987</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1988) echo 'selected' ; ?>  value="1988">1988</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1989) echo 'selected' ; ?>  value="1989">1989</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1990) echo 'selected' ; ?>  value="1990">1990</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1991) echo 'selected' ; ?>  value="1991">1991</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1992) echo 'selected' ; ?>  value="1992">1992</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1993) echo 'selected' ; ?>  value="1993">1993</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1994) echo 'selected' ; ?>  value="1994">1994</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1995) echo 'selected' ; ?>  value="1995">1995</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1996) echo 'selected' ; ?>  value="1996">1996</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1997) echo 'selected' ; ?>  value="1997">1997</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1998) echo 'selected' ; ?>  value="1998">1998</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 1999) echo 'selected' ; ?>  value="1999">1999</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2000) echo 'selected' ; ?>  value="2000">2000</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2001) echo 'selected' ; ?>  value="2001">2001</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2002) echo 'selected' ; ?>  value="2002">2002</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2003) echo 'selected' ; ?>  value="2003">2003</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2004) echo 'selected' ; ?>  value="2004">2004</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2005) echo 'selected' ; ?>  value="2005">2005</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2006) echo 'selected' ; ?>  value="2006">2006</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2007) echo 'selected' ; ?>  value="2007">2007</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2008) echo 'selected' ; ?>  value="2008">2008</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2009) echo 'selected' ; ?>  value="2009">2009</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2010) echo 'selected' ; ?>  value="2010">2010</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2011) echo 'selected' ; ?>  value="2011">2011</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2012) echo 'selected' ; ?>  value="2012">2012</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2013) echo 'selected' ; ?>  value="2013">2013</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2014) echo 'selected' ; ?>  value="2014">2014</option>
                        <option  <?php if ($dadosUser['ano_nasc'] == 2015) echo 'selected' ; ?>  value="2015">2015</option>



<br>

                    </select>
                    
                    <input name="sexo" <?php if ($dadosUser['sexo'] == "Feminino" ) echo 'checked' ; ?>  value="Feminino"  type="RADIO"> Feminino  &nbsp; &nbsp;
                    <input name="sexo" <?php if ($dadosUser['sexo'] == "Masculino" ) echo 'checked' ; ?>  value="Masculino"   type="RADIO"> Masculino <br>
                    <div id="texto_empresa"><h2 class="empresa_text">Empresa</h2></div>
                    <br>
                    <br>
                    <br>
                    <br>
                    
                    <hr class="cinzahr"></hr>
                   
                   <div id="tipo_pessoa_empresa">
 		<input  name="tipo" <?php if ($dadosUser['empresa'] == "Sim" ) echo 'checked' ; ?>  value="Sim"  type="RADIO" > Sim  &nbsp; &nbsp;
                <input  name="tipo" <?php if ($dadosUser['empresa'] == "Nao" ) echo 'checked' ; ?>  value="Nao"   type="RADIO" > Não <br>
                   </div>
                   
                   
                    
                    <input name="enviar" type="submit" id="Enviar" value="Confirmar Edição">
                    <div id="cancelar_conta">

                        <link href="../index.php"  />
                        <a href="../PaginaInicial/paginainicial.php"> <h2 class="cancelarconta_text">Cancelar Edição</h2></a>


                    </div>
                </form>
            </div>

        </div>

    </div>


</div>
       </div> 
       
     
       </div>
    <div id="lado_d"><!--INICIO LADO DIREITO MENU-->
    
         <div id="caixa_informacoes_user">
       <div id="img_user">
           
           <?php
           $imagem_user =$dadosUser['imagem_user'];
           ?>
           
       <img class="img_usuario" src="<?php if ($dadosUser['imagem_user']==""){ echo "../foto_usuario/usuario.png";}  else{ echo "../foto_usuario/$imagem_user";}?>" alt="foto de perfil" />
       </div>
           
           
        
        <div id="texto_nome_user">
        <h2 class="nome_user_text"> <?php echo $dadosUser['nome'];?></h2>
     
        </div>
         <div id="texto_sobrenome_um_user">
        <h2 class="sobrenome_um_user_text"> <?php echo $dadosUser['sobrenome'];?> </h2>
        </div>
        
        
           
         <div id="texto_cidade">
        <h2 class="cidade_text"><?php echo $dadosUser['cidade'];?> </h2>
        </div>
        <?php
        if($dadosUser['empresa']=="Sim")
            {
            $tipodeusuario="Empresa";
        }
        else{
            
            $tipodeusuario="Pessoa";
        }
        
        ?>
         <div id="texto_pessoa_ou_empresa">
        <h2 class="pessoa_empresa_text"> <?php echo $tipodeusuario;?>  <h2>
        </div>
                
      </div>
     
      <div id="caixa_eventos"><!-- INICIO CAIXA Eventos-->
      <div id="eventos">
      <div id="caixa_icons">
      
      <div id="lista_amigos">
      
		<a href="../Lista_amigos/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_76.png" ></a>
  		<a href="../Lista_amigos/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_escrevendo.png"></div></a>
		</div>
        <div id="texto_lista_amigos">
      <h2 class="descricao_icon_text"> Lista<br>Amigos <h2>
      </div>
      <div id="adicionar_amigo">
      
          <a href="../Adicionar_amigo/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_82.png" ></a>
  		<a href="../Adicionar_amigo/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_foto_3.png"></div></a>
		</div>
        <div id="texto_adicionar_amigo">
      <h2 class="descricao_icon_text"> Adicionar<br>Amigo <h2>
      </div>
     
      <div id="meus_grupos">
      
          <a href="../Meus_grupos/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_85.png" ></a>
  		<a href="../Meus_grupos/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_grupo_3.png"></div></a>
		</div>
        <div id="texto_meus_grupos">
      <h2 class="descricao_icon_text"> Meus<br>Grupos <h2>
      </div>
      
      <div id="criar_grupo">
    
          <a href="../Criar_grupo/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_84.png" ></a>
  		<a href="../Criar_grupo/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_grupo_2.png"></div></a>
		</div>
        <div id="texto_criar_grupo">
      <h2 class="descricao_icon_text"> Criar<br>Grupo <h2>
      </div>
     <div id="perfil">
      
		<a href="../Perfil/visualizar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_91.png" ></a>
  		<a href="../Perfil/visualizar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_homem.png"></div></a>
		</div>
        <div id="texto_perfil">
      <h2 class="descricao_icon_text"> Perfil <h2>
      </div>
      
      <div id="editar_perfil">
      
		<a href="../Perfil/editar.php"><img class="icon_inicial" src="../imagem/ICON CHECKIT/icones_simples/freeiconmaker_9.png" ></a>
  		<a href="../Perfil/editar.php"><div id="modelo2"><img class="icon_mod2" src="../imagem/ICON CHECKIT/icones/mod. 2/Mod_2_escrever_2.png"></div></a>
		</div>
        <div id="texto_editar_perfil">
      <h2 class="descricao_icon_text"> Editar<br>Perfil <h2>
      </div>
      
       </div> 
      </div>
      
      
      </div><!-- FIM CAIXA Eventos-->
  
      
      </div><!-- FIM CAIXA Eventos-->
    
     </div><!--FIM LADO DIREITO MENU-->
  </div>
  <div id="rodape">
    <p> Todos os Direitos Reservados &copy; StarTi</p>
  </div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="../js/custom.js"></script>

<?php

if (isset($_POST['enviar']) && !empty($_POST['nome'])) {


    $arquivo = $_FILES['file'];
    $tmp_name = $_FILES['file']['tmp_name'];
    
    $arquivo = $_FILES['arquivo']['name'];
    $temp = $_FILES['arquivo']['tmp_name'];
    
    extract($_POST, EXTR_OVERWRITE);
    //extensões permitidas
    $extensoes = array(".jpg", ".png", ".jpeg");
    //extração da extensão do arquivo escolhido
    $ext = strtolower(substr($arquivo, -4));
    if ($ext == "jpeg") {
        $ext = ".jpeg";
    }
    
    if (in_array($ext, $extensoes)) {
    include_once '../class/Usuario.php';
   
    $u = new Usuario(); 
    
    $u->setTemp_imguser($temp);
    $u->setImagem_user($arquivo);
    $u->editarperfil();
    $u->setNome(strtr(strtoupper($nome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $u->setSobrenome(strtr(strtoupper($sobrenome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $u->setNum_celular($num_celular);
    $u->setUf($uf);
    $u->setCidade(strtr(strtoupper($cidade), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $u->setDia_nasc((int) $dia_nasc);
    $u->setMes_nasc((int) $mes_nasc);
    $u->setAno_nasc((int) $ano_nasc);
    $u->setSexo($sexo);
    $u->setEmpresa($tipo);
    $u->editarperfilcomimagem();
    }
    else{
        
        include_once '../class/Usuario.php';
   
    $u = new Usuario(); 
    $u->setNome(strtr(strtoupper($nome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $u->setSobrenome(strtr(strtoupper($sobrenome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $u->setNum_celular($num_celular);
    $u->setUf($uf);
    $u->setCidade(strtr(strtoupper($cidade), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $u->setDia_nasc((int) $dia_nasc);
    $u->setMes_nasc((int) $mes_nasc);
    $u->setAno_nasc((int) $ano_nasc);
    $u->setSexo($sexo);
    $u->setEmpresa($tipo);
    $u->editarperfil();
    }
   
    
    
    

  echo "<script language='javaScript'>window.location.href='../Perfil/editar.php'</script>";
}
    

?>

    </body>
</html>