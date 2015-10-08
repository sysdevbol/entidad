<article class="jumbotron">
			<header>
				<?php echo utf8_encode("<h1>EL REGISTRO HA FINALIZADO DE FORMA EXITOSA.</h1>");?>
			</header>
			<small class="text-justified">
				<p><?php echo $mensaje;?></p>
				<p></p><?php //echo $resultado1;?>
                <?php //echo $resultado2;?>
                <p><h3><strong>Usuario:<?php echo $usuario;?></strong></h3></p>
                <p><h3><strong>Contrase&ntilde;a:<?php echo $contraseña;?></strong></h3></p>				
			</small>

            <div class="row">
				<div class="col-sm ">
					<p id="button-historic" style="float: right;">
					  <a class="btn btn-link btn-md pull-left" href="/registroempresas"><?php echo utf8_encode("Ir al Inicio »");?></a>
					</p>
				</div>
				
								
															
			</div>				
			<div class="visible-handheld">
				<br/>
			</div>
</article>