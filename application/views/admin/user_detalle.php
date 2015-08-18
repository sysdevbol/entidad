<script type="text/javascript">
 $(function(){
     $('#addDes').click(function(){
        var id_user=$(this).attr('rel');
	var left=screen.availWidth;
	var top=screen.availHeight;
	left=(left-800)/2;
	top=(top-500)/2;
	var res=window.showModalDialog("/admin/content/destinos/"+id_user,"","center:0;dialogWidth:750px;dialogHeight:450px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
        if(res!=null)
            {
                $("#destinatarios").addClass('loading');
                $.ajax({                    
	            type: "POST",
	            data: { destinos : res, id : id_user },
	            url: "/admin/ajax/addUser",
	           // dataType: "html",
	            success: function(data)
	            {                                                    
	             location.reload(true);              
	            }
                });                
            }        
        });
     $('#addDoc').click(function(){
        var id_user=$(this).attr('rel');
	var left=screen.availWidth;
	var top=screen.availHeight;
	left=(left-800)/2;
	top=(top-500)/2;
	var res=window.showModalDialog("/admin/content/documentos/"+id_user,"","center:0;dialogWidth:750px;dialogHeight:450px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
        if(res!=null)
            {
                $("#documentos").addClass('loading');
                $.ajax({                    
	            type: "POST",
	            data: { documentos : res, id : id_user },
	            url: "/admin/ajax/addDoc",
	           // dataType: "html",
	            success: function(data)
	            {                                                    
	             location.reload(true);              
	            }
                });                
            }        
        });
     //quitar doc
     $('a.delDoc').click(function(){
         var tipo=$(this).attr('rel');
         if(confirm('Esta usted seguro de eliminar el tipo : '+tipo))
         {
             return true;
         }
         else{
             return false;
         }
         return false;
     });
     //quitar destinatario
     $('a.delDes').click(function()
     {
         var nombre=$(this).attr('rel');
         if(confirm("Esta usted seguro de quitar de la lista a: \n"+nombre)){
             return true;
         }
         else{             
             return false;
         }
         
     });
 $('#formPass').validate();
 });
</script>
    
<style type="text/css">
    label{color: #666; font-size: 12px; width: 140px;  float: left;   }
    label.error{display: inline; float:right; width: 15px; }
    input.error{border: 1px solid red; }
</style>

<div id="usuario">
    <p >
        <h2 style="text-align:center;"><?php echo $oficina->oficina;?></h2>
    </p>
    <hr/>
    <form action="/admin/user/update" method="post">
    <p>
        <input type="hidden" name="user_id" value="<?php echo $user->id;?>" />
        <?php
        echo form::label('username');
        echo Form::input('username',$user->username,array('size'=>60));
        ?>
    </p>
    <p>
        <?php
        echo form::label('nombre');
        echo Form::input('nombre',$user->nombre,array('size'=>60));
        ?>
    </p>
    <p>
        <?php
        echo Form::label('Cargo');
        echo Form::input('cargo',$user->cargo,array('size'=>60));
        ?>
    </p>    
    <p>
        <?php
        echo Form::label('Email:');
        echo Form::input('email',$user->email,array('size'=>60));
        ?>
    </p>    
    <p>
        <?php
        echo Form::label('prioridad');
        echo Form::select('dependencia',array(0=>'Jefe',1=>'Dependiente'),$user->dependencia);
        ?>
    </p>    
    <hr/>
    <p>
        <?php        
        echo Form::submit('modificar','Modificar datos',array('class'=>'button'));
        ?>
    </p>    
    </form>
</div>
<div id="usuario">
    <p>
        <h2 style="text-align:center;">Cambiar contraseña</h2>
    </p>
    <hr/>
    <form action="/admin/user/resetPass" method="post" id="formPass">
    <p>
        <input type="hidden" name="user_id" value="<?php echo $user->id;?>" />
        <label>Nueva Contraseña:</label>
        <input type="password" name="pass1" id="pass1" class="required"  />
    </p>
    <p>
        <label>Repita Contraseña:</label>
        <input type="password" name="pass2" id="pass2" equalTo="#pass1" class="required"  />        
    </p>
        
    <hr/>
    <p>
        <?php        
        echo Form::submit('reset','Modificar Constraseña',array('class'=>'button'));
        ?>
    </p>    
    </form>
</div>

<?php echo '';?>