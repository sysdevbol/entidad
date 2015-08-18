<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="es" />
    <link rel="shortcut icon" href="<?php echo url::base().'medias/images/paco.ico';?>" />
    
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $meta_keywords;?>" />
    <meta name="description" content="<?php echo $meta_description;?>" />
    <meta name="copyright" content="<?php echo $meta_copywrite;?>" />
    <?php foreach($styles as $file => $type) { 
        echo HTML::style($file, array('media' => $type)), "\n"; 
    }?>
    <?php foreach($scripts as $file) {
        echo HTML::script($file, NULL, TRUE), "\n"; 
    }?>

<script type="text/javascript">
    (function(){
       $("#username").focus();
       $('.alert-error').fadeIn(5000).fadeOut(5000);
       $('#loginform').validate();
    });
</script>
</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="/media/images/logo.png" alt="" /></div>
        <form action="" method="post" accept-charset="UTF-8" id="loginform">
        <?php if(isset($errors['login'])): ?>
            <div class="inputwrapper alert-error">
                <div class="alert"><?php echo $errors['login'];?></div>
            </div>
        <?php endif;?>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="username" id="username" value="<?php echo Arr::get($_POST, 'username','' )?>" placeholder="Ingresar Usuario" class="required" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Ingresar Contraseña" class="required" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Ingresar</button>
            </div>
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2015. AEVivienda SiPAGO. Sistem@s.</p>
</div>

</body>
</html>

</body>
</html>





