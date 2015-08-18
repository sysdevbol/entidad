<style type="text/css">
    p.azul {
  background: #0E8ABF;
   border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em;
}
p.rojo {
  //background: #5EA226;
  background: red;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em;
}
</style>

<div class="clearfix" id="bos-main-blocks">
  <ul>
  <?php foreach($estados as $k=>$v):?>      
  <li class="block">
      <div class="content">
          <h2>
              <a href="<?php echo $v['accion'];?>"><?php echo $v['titulo'];?></a></h2><p><?php echo $v['descripcion'];?></p><p class="rojo" style="color: #fff;"><?php echo $v['cantidad']; ?> <br></p>
      </div>
      <a href="<?php echo $v['accion'];?>">
          <img title="" alt="" src="/media/images/<?php echo $v['imagen'];?>" typeof="foaf:Image" style="width: 90px; height: 90px;"></a>
  </li>
  <?php endforeach;?>
  <li class="block">
      <div class="content">
          <h2>
              <a href="/document">Documentos</a></h2><p>Documentos generados por su usuario: </p><p class="azul" style="color: #fff;"><?php echo $documentos; ?> <br></p>
      </div>
      <a href="/document">
          <img  title="" alt="" src="/media/images/detalle.png" typeof="foaf:Image" style="width: 90px; height: 90px;"></a>
  </li>
  <li class="block">
      <div class="content">
          <h2>
              <a href="/reports">Reportes</a></h2><p>Generar Reportes: <br></p>
      </div>
      <a href="/reports">
          <img title="" alt="" src="/media/images/reportes.png" typeof="foaf:Image" style="width: 90px; height: 90px;"></a>
  </li>
  <li class="block">
      <div class="content">
          <h2>
              <a href="/user">Usuario</a></h2><p>Configuracion de la cuenta de usuario. <br></p>
      </div>
      <a href="/user">
          <img title="" alt="" src="/media/images/user_config.png" typeof="foaf:Image" style="width: 90px; height: 90px;"></a>
  </li>
  
  </ul>
    <hr/>
</div>
