<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $title;?></title>
<meta name="keywords" content="<?php echo $meta_keywords;?>" />
<meta name="description" content="<?php echo $meta_description;?>" />
<meta name="copyright" content="<?php echo $meta_copywrite;?>" />

<?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>
<?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>

</head>

<body>
<div class="mainwrapper">
    
    <div class="header">
        <div class="logo">
            <a href="/dashboard"><img src="/media/images/logosipago.png" style="height: 52px; width: 180px;" alt="" /></a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">

                <!--li>
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                        <span class="count">10</span>
                        <span class="head-icon head-users"></span>
                        <span class="headmenu-label">New Users</span>
                    </a>
                    <ul class="dropdown-menu newusers">
                        <li class="nav-header">New Users</li>
                        <li>
                            <a href="">
                                <img src="images/photos/thumb1.png" alt="" class="userthumb" />
                                <strong>Draniem Daamul</strong>
                                <small>April 20, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/photos/thumb2.png" alt="" class="userthumb" />
                                <strong>Shamcey Sindilmaca</strong>
                                <small>April 19, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/photos/thumb3.png" alt="" class="userthumb" />
                                <strong>Nusja Paul Nawancali</strong>
                                <small>April 19, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/photos/thumb4.png" alt="" class="userthumb" />
                                <strong>Rose Cerona</strong>
                                <small>April 18, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/photos/thumb5.png" alt="" class="userthumb" />
                                <strong>John Doe</strong>
                                <small>April 16, 2013</small>
                            </a>
                        </li>
                    </ul>
                </li-->

                <li class="right">
                    <div class="userloggedinfo">
                        <img src="/media/images/kuser.png" alt="" />
                        <div class="userinfo">
                            <h5><?php echo $username;?> <small> - <?php echo "";?></small></h5>
                            <ul>
                                <li><a href="/user/data">Editar Datos</a></li>
                                <li><a href="/user/password">Cambiar contrase&ntilde;a</a></li>
                                <li><a href="/user/logout">Salir</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>
    
    <div class="leftpanel">
        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            
            	<li class="nav-header">Menu de Navegacion</li>
                <?php echo $menutop; ?>  
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->
    
    <div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="dashboard.html"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li>Sistema de Pagos</li>
            <li class="right">
                    <a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-tint"></i> Color Skins</a>
                    <ul class="dropdown-menu pull-right skin-color">
                        <li><a href="default">Default</a></li>
                        <li><a href="navyblue">Navy Blue</a></li>
                        <li><a href="palegreen">Pale Green</a></li>
                        <li><a href="red">Red</a></li>
                        <li><a href="green">Green</a></li>
                        <li><a href="brown">Brown</a></li>
                    </ul>
            </li>
        </ul>
        
        <div class="pageheader">
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>Detalle</h5>
                <h1><?php echo $titulo;?></h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                    <?php echo $content;?>
                </div><!--row-fluid-->
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2015. Agencia Estatal de Vivienda. All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Info: <a href="http://www.aevivienda.gob.bo/">AEVIVIENDA</a></span>
                    </div>
                </div><!--footer-->       
            </div><!--maincontentinner-->
        </div><!--maincontent-->
    </div><!--rightpanel-->
</div><!--mainwrapper-->
</body>
</html>
