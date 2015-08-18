
<?php if(sizeof($info)>0){?>
<div class="info">
    <ul>
    <?php foreach($info as $k=>$e):?>
        <li><?php echo $e;?></li>
    <?php endforeach;?>
    </ul>    
</div>
<a href="/dashboard">Ir al Inicio</a>
<?php } else {?>
<?php if(sizeof($errors)>0):?>
<div class="error">
    <ul>
    <?php foreach($errors as $k=>$e):?>
        <li><?php echo $e;?></li>
    <?php endforeach;?>
    </ul>
</div>
<?php endif;?>
<form method="post">
<table>
        <tr>
        <td>
            <b> Ingrese su contraseña actual:</b>
        </td>        
        <td>
            <?php echo Form::password('pass_old','',array('size'=>40)); ?>
        </td>
        </tr>
        <tr>
        <td>
            Ingrese su contraseña nueva:
        </td>
        <td>
            <?php echo Form::password('pass_new','',array('size'=>40)); ?>
        </td>
        </tr>
        <tr>
        <td>
            Repita su contraseña:
        </td>
        <td>
            <?php echo Form::password('pass_new2','',array('size'=>40)); ?>
        </td>
        </tr>
        <tr>
            <td></td>
        <td>
            <br/>
            <?php echo Form::submit('submit','Cambiar Contraseña',array('class'=>'button2 btn btn-primary','type'=>'submit')); ?>
        </td>
        </tr>
</table>
</form>


<?php }?>
