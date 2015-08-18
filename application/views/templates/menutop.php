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

<?php if($id != $m->id):?>
 <?php if(count($menu[$m->id]) > 1){?>
   <li class="sub-menu"> 
       <a href="/<?php echo $m->controlador;?>" title="<?php echo $m->descripcion;?>">
       <i class="<?php echo $m->logo;?>"></i> </span>
       <span><?php  echo $m->menu;?></span>
       </a>        
           <ul class="sub"> 
           <?php
           ksort($menu[$m->id]);
           foreach($menu[$m->id] as $k=>$v): ?>
               <li>
                   <a href="/<?php echo $menu[$m->id][$k]['accion'];?>"> <?php echo $menu[$m->id][$k]['submenu'];?></a>        
               </li>    
           <?php endforeach;?>
           </ul>
    </li>
   <?php }
   else{
    ?>
   <li> 
       <a href="/<?php echo $m->controlador;?>" title="<?php echo $m->descripcion;?>">
       <i class="<?php echo $m->logo;?>"></i>
       <span><?php  echo $m->menu;?></span>
       </a>
   </li> 
   <?php 
   }?>
  <?php $id=$m->id; 
      endif;?>  
<?php endforeach;?>
