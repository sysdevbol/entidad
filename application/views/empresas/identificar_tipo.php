<style>
.maincontent { float: left; width: 100%; }
.maincontentinner { padding: 20px; }
.subtitle { text-transform: uppercase; font-size: 11px; color: #999; margin-bottom: 5px; }
.subtitle2 { font-size: 13px; text-transform: uppercase; color: #333; margin-bottom: 5px; }

.shortcuts { list-style: none; margin-top: 20px; overflow: hidden; clear: both; }
.shortcuts li { display: inline-block; float: left; margin: 0 5px 5px 0; position: relative; }
.shortcuts li a { display: block; width: 130px; height: 130px; background: #0866c6; color: #fff; font-size: 16px; }
.shortcuts li a:hover { background: #282828; text-decoration: none; }
.shortcuts li .shortcuts-label { display: block; padding: 0 0; text-align: center; font-size: 13px;}
.shortcuts li .shortcuts-icon { display: block; width: 48px; height: 48px; padding: 56px 0 18px 0; margin: 0 auto; }
.shortcuts li .iconsi-event { background: url(/media/images/imagesmen/icons/icon-event.png) no-repeat center center; }
.shortcuts li .iconsi-cart { background: url(/media/images/imagesmen/icons/icon-cart.png) no-repeat center center; }
.shortcuts li .iconsi-archive { background: url(/media/images/imagesmen/icons/icon-archive.png) no-repeat center center; }
.shortcuts li .iconsi-help { background: url(/media/images/imagesmen/icons/icon-help.png) no-repeat center center; }
.shortcuts li .iconsi-images { background: url(/media/images/imagesmen/icons/icon-images.png) no-repeat center center; }


/* login */
.inputwrapper button { background: #255576; border-color: #1a4563; }
.inputwrapper button:hover { background: #1a4563; border-color: #123954; }

/* background */

body.loginpage,
.header,
.leftmenu .nav-tabs.nav-stacked > li.active > a,
.leftmenu .nav-tabs.nav-stacked > li.active > a:hover,
.shortcuts li a,
.widgettitle,
.mediamgr .mediamgr_rightinner h4,
.messagemenu,
.msglist li.selected,
.wizard .hormenu li a.done,
.wizard .hormenu li a.selected,
.actionBar a:hover,
.actionBar a:hover,
.wizard .tabbedmenu,
.nav-tabs > .active > a:focus,
.tabbable > .nav-tabs,
.btn-primary, .btn-primary:link,
.nav-tabs > li > a:hover, .nav-tabs > li > a:focus,
.nav-pills > .active > a,
.nav-pills > .active > a:hover,
.nav-pills > .active > a:focus,
.tabs-right .nav-tabs,
.tabs-right > .nav-tabs > li > a,
.tabs-left .nav-tabs,
.tabs-left > .nav-tabs > li > a,
.progress-primary .bar,
.tab-primary.ui-tabs .ui-tabs-nav,
.ui-datepicker-calendar td.ui-datepicker-today a,
.nav-tabs > .active > a,
.nav-tabs > .active > a:hover,
.nav-tabs > .active > a:focus,
.nav-list > .active > a,
.nav-list > .active > a:hover,
.nav-list > .active > a:focus,
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary.active,
.btn-primary.disabled,
.btn-primary[disabled],
.btn-group.open .btn-primary.dropdown-toggle,
.fc-widget-header,
.fc-widget-header.fc-agenda-gutter.fc-last
{ background-color: #3b6c8e; }



/* color */

a,a:hover,a:link,a:active,a:focus,
.pageicon,
.pagetitle h1,
.userlist li .uinfo h5,
.messagemenu ul li.active a,
.msglist li h4,
.actionBar a,
.actionBar a.buttonDisabled,
.wizard .tabbedmenu li a.selected,
.wizard .tabbedmenu li a.done,
.tabbable > .nav-tabs > li.active > a,
.btn-circle.btn-primary, .btn-circle.btn-primary:hover, .btn-circle.btn-primary:focus,
.btn-circle.btn-primary:active, .btn-circle.btn-primary.active, 
.btn-circle.btn-primary.disabled, .btn-circle.btn-primary[disabled],
.tabs-right > .nav-tabs .active > a,
.tabs-right > .nav-tabs .active > a:hover,
.tabs-right > .nav-tabs .active > a:focus,
.tabs-left > .nav-tabs .active > a,
.tabs-left > .nav-tabs .active > a:hover,
.tabs-left > .nav-tabs .active > a:focus
{ color: #3b6c8e; }


/* border color */

.headmenu .dropdown-menu,
.pageicon,
.widgetcontent,
.messagemenu ul li.active,
.messageleft,
.messageright,
.messagesearch,
.msgreply,
.wizard .hormenu li a,
.wizard .hormenu li:first-child a,
.stepContainer,
.actionBar,
.actionBar a,
.actionBar a.buttonDisabled,
.tabbable > .nav-tabs,
.tabbable > .tab-content,
.nav-tabs.nav-stacked > li > a:focus,
.btn-circle.btn-primary, .btn-circle.btn-primary:hover, .btn-circle.btn-primary:focus,
.btn-circle.btn-primary:active, .btn-circle.btn-primary.active, 
.btn-circle.btn-primary.disabled, .btn-circle.btn-primary[disabled],
.nav-tabs,
.nav-tabs > li > a:hover, .nav-tabs > li > a:focus,
.tabs-below .tab-content,
.tabs-below > .nav-tabs > li.active > a,
.tabs-right,
.tabs-left,
.tab-primary.ui-tabs,
.btn-primary, .btn-primary:link,
.nav-tabs.nav-stacked > li > a,
.nav-tabs.nav-stacked > li > a:hover,
.nav-tabs.nav-stacked > li > a:hover,
.nav-tabs.nav-stacked > li > a:focus,
.nav-tabs > .active > a,
.nav-tabs > .active > a:hover,
.nav-tabs > .active > a:focus
{ border-color: #3b6c8e; }


/* extras */

.tabs-below > .nav-tabs > li.active > a { border-bottom: 1px solid #3b6c8e !important; }
.nav-list > li > a { color: #666; }
.tabs-left > .nav-tabs > li,
.tabs-right > .nav-tabs > li { border-color: rgba(255,255,255,0.2); }
.leftmenu .nav-tabs.nav-stacked > li > a { border-color: #232323 !important; }
.leftmenu .nav-tabs.nav-stacked > li.active > a { border-color: rgba(0,0,0,0.1) !important; }

/* ie fix */

.no-rgba .headmenu > li { border-right: 1px solid #688da8; }
.no-rgba .headmenu > li:first-child { border-left: 1px solid #688da8; }


@media screen and (max-width: 480px) {
 
 .userloggedinfo ul li a:hover { background-color: #3b6c8e; }
 
  .userloggedinfo .userinfo,
  .wizard .hormenu li,
  .messageright { border-color: #3b6c8e; }

}





</style>
<div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span8">
                        
                       <article class="jumbotron">
            			<header>
            				<?php echo utf8_encode("<h1>Seleccione el Tipo de Registro.</h1>");?>
            			</header>
                        <ul class="shortcuts">

                             <?php
                             $sw=0;
                            foreach($tipo as $c):
                            ?>
                            <li class="events">
                              <?php
                              if($c['id'] == 9 or $c['id'] == 19){
                             $sw = 1;
                            }
                              ?>
        					       <a href="<?php echo $c['controlador']."/".$c['id']?>">
                                        <span class="shortcuts-icon iconsi-help"></span>
                                        
                                        <span class="shortcuts-label"><?php echo $c['tipo']?></span>
        							</a>
                                    
        					</li>
                            <?php
                            
                            endforeach;
                            ?>
                        </ul>
                        <?php
                        if($sw == 1){
                          echo '<span style="font-size:12px">Nota: La clasificacion <strong>"Materiales de construccion"</strong> tiene estricta relacion con proyectos de construccion de viviendas y la clasificacion <strong>"Insumos y Servicios"</strong> esta referido a gastos de funcionamiento.</span>';
                        }
                        ?>
                      </article>
                      <a href="javascript:history.back(1)" style="float: right;">Volver Atr&aacute;s</a>  
                        
                    </div><!--span8-->
                    
                    
                </div><!--row-fluid-->
                
              
                
            </div><!--maincontentinner-->
        </div>				
                   
						
					