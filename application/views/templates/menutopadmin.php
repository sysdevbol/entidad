<?php
$menu=array();
$id=0;
foreach($menus as $m):        
    $menu[$m->id][$m->id_submenu]['id']=$m->id_submenu;
    $menu[$m->id][$m->id_submenu]['submenu']=$m->submenu;
    $menu[$m->id][$m->id_submenu]['accion']=$m->accion;
    $menu[$m->id][$m->id_submenu]['descripcion']=$m->descripcion;    
endforeach;
$sm=0; ?>
<?php foreach($menus as $m):?>    

<?php if($id!=$m->id):?>
   <li>   
       <a href="/<?php echo $m->controlador;?>" title="<?php echo $m->descripcion;?>"><span style="display: block;"><?php  echo $m->menu;?></span></a>        
       <?php if(count($menu[$m->id])>1):?>
       <ul class="modx-subnav"> 
       <?php
       ksort($menu[$m->id]);
       foreach($menu[$m->id] as $k=>$v): ?>
           <li>
               <a href="/<?php echo $m->controlador;?>/<?php echo $menu[$m->id][$k]['accion'];?>"><?php echo $menu[$m->id][$k]['submenu'];?><span class="descripcion"><?php echo $menu[$m->id][$k]['descripcion'];?></span></a>        
           </li>    
       <?php endforeach;?>
       </ul>
       <?php endif;?>
    </li>
  <?php $id=$m->id; endif;?>  
<?php endforeach;?>
