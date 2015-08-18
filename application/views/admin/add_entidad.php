<script>
$(function(){
    $('input:first').focus();
    $('#formulario').validate();
});
</script>
<i>Llene correctamente los datos en el formulario</i><hr/>
<?php if($mensaje!='') echo "Se creo corectamente la entidad '$mensaje'"; ?>
<?php if(sizeof($errors)>0): ?>
<ul>
    <?php foreach($errors as $e):?>
    <li><?php echo $e?></li>
    <?php endforeach;?>
</ul>
<?php endif;?>
<form method="post" id="formulario">
    <table>
        <tr>
            <td><?php echo Form::label('Nombre de la Entidad','Nombre de la Entidad');?></td>
            <td><?php echo Form::input('entidad',Arr::get($_POST, 'entidad',''),array('size'=>60,'class'=>'required'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Sigla Completa');?></td>
            <td><?php echo Form::input('sigla',Arr::get($_POST, 'sigla',''),array('class'=>'required'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('sigla 2','Sigla Abreviada (Max. 3 caracteres - para la hora de ruta)');?></td>
            <td><?php echo Form::input('sigla2',Arr::get($_POST, 'sigla2',''),array('size'=>3,'maxlength'=>3,'class'=>'required'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('direccion','Dirección:');?></td>
            <td><?php echo Form::input('direccion',Arr::get($_POST, 'direccion',''),array('size'=>50));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Telefono','Teléfonos');?></td>
            <td><?php echo Form::input('telefono',Arr::get($_POST, 'telefono',''),array('size'=>50));?></td>
        </tr>
    </table>
<hr/>
<br/>
<input type="submit" value="Crear entidad" class="button2" />
</form>