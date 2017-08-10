<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aula PHP 05/08</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />

</head>
<body>

<div id="templatemo_wrapper_outer">
	<div id="templatemo_wrapper">
    
    	<div id="templatemo_header">
			<div id="site_title">
				<h1><a rel="nofollow" href="http://www.templatemo.com"><strong>AULA</strong> PHP<span>05/08/2014</span></a></h1>
			</div> <!-- end of site_title -->

				<ul id="social_box">
					<li><a rel="nofollow" href="http://www.facebook.com/templatemo"><img src="images/facebook.png" alt="facebook" /></a></li>
					<li><a href="#"><img src="images/twitter.png" alt="twitter" /></a></li>
					<li><a href="#"><img src="images/linkedin.png" alt="linkin" /></a></li>
					<li><a href="#"><img src="images/technorati.png" alt="technorati" /></a></li>
					<li><a href="#"><img src="images/myspace.png" alt="myspace" /></a></li>                
				</ul>
			
			<div class="cleaner"></div>
		</div>
        
        <div id="templatemo_menu">
            <ul>
                <li><a href="?p=home">Home</a></li>
                <li><a href="?p=servicos">Serviços</a></li>
                <li><a href="?p=parceiros">Parceiros</a></li>
                <li><a href="?p=sobre">Sobre</a></li>
                <li><a href="?p=contato">Contato</a></li>
            </ul>    	
        </div> <!-- end of templatemo_menu -->
        
        <div id="templatemo_slider_wrapper">
        
        	<div id="templatemo_slider">
            
				<div id="one" class="contentslider">
                    <div class="cs_wrapper">
                        <div class="cs_slider">
                        
                            <div class="cs_article">
                            	<div class="slider_content_wrapper">
									
									<div class="slider_image">
										<img src="images/slider/templatemo_slide01.jpg" alt="Mauris quis eros arcu" />
									</div>
									
									<div class="slider_content">
                                        <h2>Lorem ipsum dolor sit amet consectetur adipiscing</h2>
                                        <p>Maecenas quis nibh dolor, pharetra tristique tellus. Nunc at posuere ligula. Suspendisse in tempus lectus. Nulla laoreet odio eu ligula rhoncus luctus.</p>
										<div class="btn_more"><a href="#">More...</a></div>
									</div>
                                
								</div>
                            </div><!-- End cs_article -->
                            
                            <div class="cs_article">
                            	<div class="slider_content_wrapper">
									
									<div class="slider_image">
										<img src="images/slider/templatemo_slide02.jpg" alt="Cras porta porta turpis" />
									</div>
                     			
									<div class="slider_content">
                                        <h2>Vestibulum vitae lectus a leo commodo egestas</h2>
                                        <p>Aliquam nec felis tellus. Sed a dolor lectus. Phasellus ac dolor id nunc pharetra interdum. Fusce magna nulla, elementum nec luctus sit amet, lacinia ut lorem.</p>
                                        <div class="btn_more"><a href="#">More...</a></div>
                                    </div>
                                
								</div>
                            </div><!-- End cs_article -->
                            
                            <div class="cs_article">
                            	<div class="slider_content_wrapper">
									
									<div class="slider_image">
										<img src="images/slider/templatemo_slide03.jpg" alt="Nullam ac mi id massa consectetur" />
									</div>
									
									<div class="slider_content">
                                        <h2>Praesent at nunc tellus sed sed auctor odio</h2>
                                        <p>Nullam fermentum risus vitae lectus posuere sagittis. Praesent faucibus, dui vitae condimentum semper, dolor augue ornare elit, quis congue ante lacus id dui.</p>
                                        <div class="btn_more"><a href="#">More...</a></div>
                                    </div>
                                
								</div>
                            </div><!-- End cs_article -->
                            
                            <div class="cs_article">
                            	<div class="slider_content_wrapper">
									
									<div class="slider_image">
										<img src="images/slider/templatemo_slide04.jpg" alt="Maecenas venenatis viverra nisi" />
									</div>
									
									<div class="slider_content">
                                        <h2>Maecenas ut mauris eu ligula placerat tempor vel</h2>
                                        <p>Suspendisse dolor dui, pretium quis sagittis convallis, placerat et diam. Fusce euismod mattis mauris, ac consequat leo pellentesque non. Nullam ut pharetra diam.</p>
                                        <div class="btn_more"><a href="#">More...</a></div>
                                    </div>
                                
								</div>
                            </div><!-- End cs_article -->
                      
                        </div><!-- End cs_slider -->
                    </div><!-- End cs_wrapper -->
                </div><!-- End contentslider -->
                
                <!-- Site JavaScript -->
                <script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
                <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
                <script type="text/javascript" src="js/jquery.ennui.contentslider.js"></script>
                <script type="text/javascript">
                    $(function() {
                    $('#one').ContentSlider({
                    width : '940px',
                    height : '240px',
                    speed : 400,
                    easing : 'easeOutSine'
                    });
                    });
                </script>
                <script src="js/jquery.chili-2.2.js" type="text/javascript"></script>
                <script src="js/chili/recipes.js" type="text/javascript"></script>
                <div class="cleaner"></div>
            	
            </div>
        
        </div>
        
        <div id="templatemo_content_wrapper">
            <div id="content">
            	<?php
                //echo $_GET['p'];
                @$page = $_GET['p'];

                if ($page == "" || $page == "index" ||
                        $page == "index.php") {
                    include_once 'home.php';
                } else {
                    include_once $page . '.php';
                }
                //alt shift f
                ?>
                
                
            </div>
			
            <div class="cleaner"></div>        
        
		</div>
		
		<div id="templatemo_content_wrapper_bottm"></div>
   
		<div id="templatemo_footer">
		
             Copyright © 2048 <a href="#">Your Company Name</a> | Designed by <a rel="nofollow" href="http://www.templatemo.com" target="_parent">Free Website Templates</a>
			 
       </div>
        
	</div> <!-- end of wrapper -->
</div> <!-- end of wrapper_outer -->

</body>
</html>