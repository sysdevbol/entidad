<!DOCTYPE html>
<html lang="es-ES"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">      
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $meta_keywords;?>" />
    <meta name="description" content="<?php echo $meta_description;?>" />
    <meta name="copyright" content="<?php echo $meta_copywrite;?>" />
    
    <?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>
    <?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>
		
	
  </head>
  <body>
  	<div id="wrap">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="pull-full">
					<div id="logos" class="pull-left">
						<div id="logo-justicia" class="visible-lg pull-left">
				  			<img src="/media/img/aevivienda.jpg" class="stretch" alt="">
				  		</div>
				  		<div id="logo-justicia-med" class="visible-md pull-left allign_bottom">
				  			<img src="/media/img/aeviviendamin.png" class="stretch" alt="">
				  		</div>
				  		<div id="logo-justicia-min" class="visible-xs visible-sm pull-left allign_bottom">
				  			<img src="/media/img/aeviviendamin.png" class="stretch" alt="">
				  		</div>
				  		<div id="logo-cabecera" class="visible-md visible-lg pull-left"></div>
				  		<div id="logo-cabecera-min" class="visible-xxs visible-xs visible-sm pull-left allign_bottom"></div>
					</div>
					<div class="navbar-header">
						<span id="titleaux" class="navbar-brand nonvisible-handheld visible-xs">
							<a href="http://www.aevivienda.gob.bo">Agencia Estatal de Vivienda</a>
						</span>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span> 
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span>					
						</button>
					</div>
                    
					<div id="headmenus" class="collapse navbar-collapse navbar-right">
						<span class="navbar-brand nonvisible-handheld visible-lg visible-md visible-sm"><a href="http://www.aevivienda.gob.bo">Agencia Estatal de Vivienda</a></span>
						<ul class="nav navbar-nav">
							<li class="active">
										<a href="#">
											<!-- <span>MENU 1</span> -->
											<span></span>
											<span class="iconfa-hand-up"></span>											
										</a>
							</li>
							<li>
										<a href="#">
											<!-- <span>MENU 2</span> -->
											<span></span>
											<span class="iconfa-hand-up"></span>
										</a>
							</li>
							<li class="visible-handheld"><a href="#">Politica de privacidad</a></li>
							<li class="visible-handheld"><a href="#">Noticias de Interes</a></li>
							<li class="visible-handheld"><a href="#">Contacto</a></li>
							<li class="visible-handheld"><a href="#" target="_blank">Ayuda</a></li>
						</ul>
					</div>
				</div>
			</div>		
		</nav>	
		
		<section class="container">
			 <?php echo $content;?>

		</section>
  	</div>	
	
	<footer id="footer" class="nonvisible-handheld">
		<div class="container">
			<div class="pull-right navbar_footer">
				<div class="navbar-right">
					<ul class="nav navbar-nav">
						<!-- use class="active" for current selection -->
						<li><a href="#">Politica de privacidad</a></li>
							<li><a href="#">Aviso legal</a></li>
							<li><a href="#">Contacto</a></li>
							<li><a href="#">Navegadores soportados</a></li>
							<li><a href="#" target="_blank">Ayuda</a></li>
					</ul>
				</div>
			</div>
			<img alt="Registro de Empresas" src="/media/img/aeviviendafooter.png">
			<address class="visible-lg visible-md">
  				<span><strong>Registro de Empresas</strong></span><br>
  				<span>Calle Fernando Guachalla No 411 Esq. 20 de Octubre</span><br>
  				<span><abbr title="Teléfonos">Telf.:</abbr>(591) 2 2147767 | (591) 2 2148747 | 0-800-102373</span>
			</address>
		</div>
	</footer>  
</body></html>