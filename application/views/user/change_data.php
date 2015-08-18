
<?php if(sizeof($info)>0){?>
<div class="info">
    <ul>
    <?php foreach($info as $k=>$e):?>
        <li><?php echo $e;?></li>
    <?php endforeach;?>
    </ul>    
</div>
<a href="/index">Ir al Inicio</a>
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
<form method="post" action="">
<table>
        <tr>
        <td>
            <label>Nombre Completo: </label>
        </td>        
        <td>
            <span class="field">
            <?php echo Form::input('nombre',$user->nombre,array('size'=>40,'class'=>'input-xxlarge')); ?>
            </span> 
        </td>
        </tr>
        <tr>
        <td>
            <label>Cargo: </label>
        </td>
        <td>
            <?php echo Form::input('cargo',$user->cargo,array('size'=>40,'class'=>'input-xxlarge')); ?>
        </td>
        </tr>
        <tr>
        <td>
            <label>Mosca: </label>
        </td>
        <td>
            <?php echo Form::input('mosca',$user->mosca,array('size'=>40,'class'=>'input-xxlarge')); ?>
        </td>
        </tr>
        <tr>
        <td>
            <label>E-mail: </label>
        </td>
        <td>
            <?php echo Form::input('email',$user->email,array('size'=>40,'class'=>'input-xxlarge','readonly'=>'')); ?>
        </td>
        </tr>
        <tr>
        <td>
            <label>Genero: </label>
        </td>
        <td>
            <?php echo Form::select('genero',array('hombre'=>'Hombre','mujer'=>'Mujer'),$user->genero ); ?>
        </td>
        </tr>
        <tr>
            <td></td>
        <td>
            <br/>
            <?php echo Form::submit('submit','Modificar datos',array('class'=>'button2 btn btn-primary','type'=>'submit')); ?>
        </td>
        </tr>
</table>
</form>


<?php }?>