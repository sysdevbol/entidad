<!-- Codrops top bar -->
<style>
.descmenu{
    font-size: 20px;
    font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;
    line-height:25px; 
}
input,button{
    font-size: 12px;
    font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;
}
</style>
<script type="text/javascript">
    (function(){
       $("#username").focus();
       $('.alert-error').fadeIn(5000).fadeOut(5000);
       $('#loginform').validate();
    });
</script>	
<article class="jumbotron">
			<header>
				<?php echo utf8_encode("<h3>Registrese en una Categoria o Ingrese con su usuario asignado.</h3>");?>
			</header>
			<div class="main clearfix">
				<nav id="menu" class="navtipo">					
					<ul>
                    <?php
                    foreach($clasificaciones as $c):
                    ?>
                    <li>
					       <a href="<?php echo $c['controlador']."/".$c['id']?>">
								<span class="icon">
									<i aria-hidden="true" class="icon-home" style="padding: 5px;"></i>
								</span>
								<span class="descmenu"><?php echo $c['descripcion']?></span>
                                <br />
     		               </a>
                            
					</li>
                    <?php
                    endforeach;
                    ?>
                    <li>
					         <a>
								<span class="icon"> 
									<i aria-hidden="true" class="icon-team" style="padding: 5px;"></i>
								</span>
								<span style="margin-top: 0px;line-height:25px; ">
                                <form action="/registroempresas/login" method="post" accept-charset="UTF-8" id="loginform">
                                    <label style="font-size: 12px;">Usuario:</label><br />
                                    <input type="text" name="username" id="username" value="<?php echo Arr::get($_POST, 'username','' )?>" placeholder="Ingresar Usuario" style="height: 24px; width: 90%;"/><br />
                                    <label style="font-size: 12px;">Contrase&ntilde;a:</label>
                                    <input type="password" name="password" id="password" placeholder="Ingresar Contrase&ntilde;a" style="height: 24px; width: 90%;"/>
                                    <button name="submit" class="btn btn-success">Ingresar</button>
                                </form>
                                </span>
							</a>
					</li>

					</ul>
				</nav>
			</div>
            
   </article>
   <div class="row-fluid">    
    <div class="span12">
    <BR><BR>    
    <a href="/GUIA_RAPIDA_REGISTRO_ENTIDADES_EJECUTORAS.pdf"><strong>Descargar manual para llenado de formularios, registro de Entidades</strong></a>
    </div>
	</div>
	<div class="row-fluid">    
    <div class="span12">
    <BR><BR>    
    <a href="/GUIA_RAPIDA_REGISTRO_PROVEEDORES.pdf"><strong>Descargar manual para llenado de formularios, registro de Proveedores</strong></a>
    </div>
	</div>
	<div class="row-fluid">    
    <div class="span12">
    <BR><BR>    
    <a href="/GUIA_RAPIDA_REGISTRO_CONSULTORES.pdf"><strong>Descargar manual para llenado de formularios, registro de Consultores</strong></a>
    </div>
	</div>
   <a href="javascript:history.back(1)" style="float: right;">Volver Atr&aacute;s</a>
   <?php if(isset($errors['login'])): ?>
            <div class="inputwrapper alert-error">
                <div class="alert"><?php echo $errors['login'];?></div>
            </div>
        <?php endif;?>
    <script>
			//  The function to change the class
			var changeClass = function (r,className1,className2) {
				var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
				if( regex.test(r.className) ) {
					r.className = r.className.replace(regex,' '+className2+' ');
			    }
			    else{
					r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"),' '+className1+' ');
			    }
			    return r.className;
			};	

			//  Creating our button in JS for smaller screens
			var menuElements = document.getElementById('menu');
			menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle active" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> Menu</button>');

			//  Toggle the class on click to show / hide the menu
			document.getElementById('menutoggle').onclick = function() {
				changeClass(this, 'navtoogle active', 'navtoogle');
			}

			// http://tympanus.net/codrops/2013/05/08/responsive-retina-ready-menu/comment-page-2/#comment-438918
			/*document.onclick = function(e) {
				var mobileButton = document.getElementById('menutoggle'),
					buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

				if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
					changeClass(mobileButton, 'navtoogle active', 'navtoogle');
				}
			}*/
		</script>