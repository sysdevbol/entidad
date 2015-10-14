<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Proveedores extends Controller_TemplateEmpresasLibre{
    protected $user;
    protected $menus;
    
  
    
    public function action_index(){
         Auth::instance()->logout(); 
        $vista = 'empresas/bienvenida';
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';

        $this->template->content = View::factory($vista);
    }
    
    public function action_proveedores($id){
         Auth::instance()->logout(); 
        $vista = 'empresas/identificar_tipo';
        $oTipoclasificacion = new Model_Tipoclasificacion();
        $resultTipoclasificacion = $oTipoclasificacion->listaTipoClasificacion($id);
        $this->template->title.='::Registro de Proveedores';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('tipo', $resultTipoclasificacion);
    }
    

    public function action_registrarproveedor2($tipo){
        
        $vista = 'proveedores/registro_proveedor';

        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp1 = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                    $empresas = ORM::factory('empresas');
                    $empresas->nombre_proponente = $_POST['nombre_proponente'];
                    $empresas->pais = $_POST['pais'];
                    if($_POST['pais']!=1)
                    $empresas->ciudad = 10;
                    else
                    $empresas->ciudad = $_POST['ciudad'];

                    $empresas->direccion = $_POST['direccion'];
                    $empresas->nit = $_POST['nit'];
                    list ( $dia, $mes, $anio ) = explode ( "/",$_POST['nit_fecha_expedicion']);
                    $fecha = $anio . "-" . $mes . "-" . $dia;
                    $empresas->nit_fecha_expedicion = $fecha;
                    $empresas->matricula = $_POST['matricula'];
                    list ( $dia, $mes, $anio ) = explode ( "/",$_POST['matricula_fecha_expedicion']);
                    $fecha = $anio . "-" . $mes . "-" . $dia;
                    $empresas->matricula_fecha_expedicion = $fecha;
                    
                    $empresas->paterno_representante =  $_POST['paterno_representante'];
                    $empresas->materno_representante = $_POST['materno_representante'];
                    $empresas->nombres_representante = $_POST['nombres_representante'];
                    $empresas->ci_representante = $_POST['ci_representante'];
                    $empresas->ci_expedido = $_POST['ci_expedido'];
                    
                    $empresas->testimonio = $_POST['testimonio'];
                    $empresas->testimonio_emision = $_POST['testimonio_emision'];
                    list ( $dia, $mes, $anio ) = explode ( "/",$_POST['testimonio_fecha_expedido']);
                    $fecha = $anio . "-" . $mes . "-" . $dia;
                    $empresas->testimonio_fecha_expedido = $fecha;
                    $empresas->fax =$_POST['fax'];
                    $empresas->telefonos = $_POST['telefonos'];
                    $empresas->celular = $_POST['celular'];
                    $empresas->mail = $_POST['mail'];
                    $empresas->mail_opcional = $_POST['mail_opcional'];
                    $empresas->estado = 1;
                    $empresas->tipo = $tipo;
                    $empresas->id_rubroarea = 48;
                    $empresas->fecha_insert = date('Y-m-d H:m:i');
                    $empresas->save();

                    $passregistro = $this->encrypt($empresas->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Entidad Ejecutora  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Entidad Ejecutora  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_proponente'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/proveedores/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/proveedores/registroexitoso/'.$passregistro.'</a></p>
                    <p><span style="background-color: #ffffff;">Por favor no responda a este mensaje. En caso de que se le presente alguna duda o inquietud, puede contactarnos a traves de la direccion electronica </span></strong></span>info@aevivienda.gob.bo<br /></span></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p><span style="text-decoration: underline;"><em><span style="font-family: arial,helvetica,sans-serif; font-size: small;">Notificaci&oacute;n autom&aacute;tica generada por la Agencia Estatal de Vivienda.</span></em></span></p>
                    </td>
                    <td>&nbsp;</td>
                    </tr>
                    </tbody>
                    </table>
                    </body>
                    </html>
                    ';
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= "From: Unidad de Sistemas <sistemas@aevivienda.gob.bo>\r\n";
                    //$headers .= "Reply-To: mmejia@aevivienda.gob.bo\r\n";
                    //$headers .= "Return-path: obarreta@aevivienda.gob.bo\r\n";
                    $headers .= "Cc: registro.entidad@aevivienda.gob.bo\r\n";             
                    //mail($destinatario,$asunto,$cuerpo,$headers);

                    //$this->request->redirect('proveedores/confirmaciones/'.$passregistro);
                    //$this->request->redirect('proveedores/registroexitoso/'.$passregistro);
                    $this->request->redirect('proveedores/registroexitoso/'.$empresas->id);
            }else{
                echo '<script>alert("La direccion de correo ya fue registrada.");</script>';
            }    
                

        }



        $oPaises = ORM::factory('paises')->find_all();
        $paises = array();
        foreach ($oPaises as $p) {
        $paises[$p->id] = $p->pais;
        }
        $oCiudades = ORM::factory('ciudades')->find_all();
        $ciudades = array();
        foreach ($oCiudades as $d) {
        $ciudades[$d->id] = $d->ciudad;
        }
        $oDepartamentos = ORM::factory('departamentos')->find_all();
        $departamentos = array();
        foreach ($oDepartamentos as $d) {
        $departamentos[$d->id] = $d->departamento;
        }
        $this->template->title.='::Registro de Proveedores';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }


    public function action_registrarproveedor($tipo){
        
        $vista = 'proveedores/registro_proveedor';

        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp1 = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                    $empresas = ORM::factory('empresas');
                    $empresas->nombre_proponente = $_POST['nombre_proponente'];
                    $empresas->pais = $_POST['pais'];
                    if($_POST['pais']!=1)
                    $empresas->ciudad = 10;
                    else
                    $empresas->ciudad = $_POST['ciudad'];

                    $empresas->direccion = $_POST['direccion'];
                    $empresas->nit = $_POST['nit'];
                    list ( $dia, $mes, $anio ) = explode ( "/",$_POST['nit_fecha_expedicion']);
                    $fecha = $anio . "-" . $mes . "-" . $dia;
                    $empresas->nit_fecha_expedicion = $fecha;
                    $empresas->matricula = $_POST['matricula'];
                    list ( $dia, $mes, $anio ) = explode ( "/",$_POST['matricula_fecha_expedicion']);
                    $fecha = $anio . "-" . $mes . "-" . $dia;
                    $empresas->matricula_fecha_expedicion = $fecha;
                    
                    $empresas->paterno_representante =  $_POST['paterno_representante'];
                    $empresas->materno_representante = $_POST['materno_representante'];
                    $empresas->nombres_representante = $_POST['nombres_representante'];
                    $empresas->ci_representante = $_POST['ci_representante'];
                    $empresas->ci_expedido = $_POST['ci_expedido'];
                    
                    $empresas->testimonio = $_POST['testimonio'];
                    $empresas->testimonio_emision = $_POST['testimonio_emision'];
                    list ( $dia, $mes, $anio ) = explode ( "/",$_POST['testimonio_fecha_expedido']);
                    $fecha = $anio . "-" . $mes . "-" . $dia;
                    $empresas->testimonio_fecha_expedido = $fecha;
                    $empresas->fax =$_POST['fax'];
                    $empresas->telefonos = $_POST['telefonos'];
                    $empresas->celular = $_POST['celular'];
                    $empresas->mail = $_POST['mail'];
                    $empresas->mail_opcional = $_POST['mail_opcional'];
                    $empresas->estado = 1;
                    $empresas->tipo = $tipo;
                    $empresas->id_rubroarea = 17;
                    $empresas->fecha_insert = date('Y-m-d H:m:i');
                    $empresas->save();

                    $passregistro = $this->encrypt($empresas->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Entidad Ejecutora  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Entidad Ejecutora  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_proponente'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/proveedores/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/proveedores/registroexitoso/'.$passregistro.'</a></p>
                    <p><span style="background-color: #ffffff;">Por favor no responda a este mensaje. En caso de que se le presente alguna duda o inquietud, puede contactarnos a traves de la direccion electronica </span></strong></span>info@aevivienda.gob.bo<br /></span></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p><span style="text-decoration: underline;"><em><span style="font-family: arial,helvetica,sans-serif; font-size: small;">Notificaci&oacute;n autom&aacute;tica generada por la Agencia Estatal de Vivienda.</span></em></span></p>
                    </td>
                    <td>&nbsp;</td>
                    </tr>
                    </tbody>
                    </table>
                    </body>
                    </html>
                    ';
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= "From: Unidad de Sistemas <sistemas@aevivienda.gob.bo>\r\n";
                    //$headers .= "Reply-To: mmejia@aevivienda.gob.bo\r\n";
                    //$headers .= "Return-path: obarreta@aevivienda.gob.bo\r\n";
                    $headers .= "Cc: registro.entidad@aevivienda.gob.bo\r\n";             
                    //mail($destinatario,$asunto,$cuerpo,$headers);

                    //$this->request->redirect('proveedores/confirmaciones/'.$passregistro);
                    //$this->request->redirect('proveedores/registroexitoso/'.$passregistro);
                    $this->request->redirect('proveedores/registroexitoso/'.$empresas->id);
            }else{
                echo '<script>alert("La direccion de correo ya fue registrada.");</script>';
            }    
                

        }



        $oPaises = ORM::factory('paises')->find_all();
        $paises = array();
        foreach ($oPaises as $p) {
        $paises[$p->id] = $p->pais;
        }
        $oCiudades = ORM::factory('ciudades')->find_all();
        $ciudades = array();
        foreach ($oCiudades as $d) {
        $ciudades[$d->id] = $d->ciudad;
        }
        $oDepartamentos = ORM::factory('departamentos')->find_all();
        $departamentos = array();
        foreach ($oDepartamentos as $d) {
        $departamentos[$d->id] = $d->departamento;
        }
        $this->template->title.='::Registro de Proveedores';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }
   
   
    
    
    
    public function action_confirmaciones($idgen){
        $vista = 'proveedores/confirmacion';
        $this->template->title.='::Confirmacion Registro de Proveedores';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';

        $this->template->content = View::factory($vista)
                        ->bind('generado', $idgen);
    }
    
    
   


    public function action_registroexitoso($idvery){
        
        //$encrypt = Encrypt::instance('tripledes');
        //$decrypt = $encrypt->decode($idvery);
        $vista = 'proveedores/registro_exitoso';
        //$decryptO = $this->decrypt($idvery,"a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");
        //list ( $decrypt,$cuerpo) = explode ( "#",$decryptO);
        $oEmpresas = new Model_Empresas();
        $resultVery = $oEmpresas->veryficarcodigo($idvery);
        $resultVery = $resultVery[0];
        if($resultVery['resultado']==1 and $resultVery['estado']==1){
            
            $resultVeryco = $oEmpresas->veryficarcorreo($resultVery['mail']);
            $resultVeryco = $resultVeryco[0];
            if($resultVeryco['resultado']>1){
                $mensaje=utf8_encode("Error: Ya existe una empresa registrada con el correo que registro. Comuníquese con nosotros a los números de la Pagina web <a href='http://www.aevivienda.gob.bo'>www.aevivienda.gob.bo</a> o envíenos un correo a info@aevivienda.gob.bo");        
            }else{
                
                $mensaje="Se le asigno el siguiente usuario y Contraseña.(Tambien se le envio un respaldo de su usuario y contraseña a su correo)";
                $contraseña = mt_rand(1999, 9999);
                $auth=Auth::instance();
                $password = $auth->hash_password($contraseña);
                $user=ORM::factory('users');
                $user->username=$resultVery['mail'];
                $user->password=$password;
                $user->nombre=$resultVery['nombre_proponente'];
                $user->email=$resultVery['mail'];
                $user->nivel=8;
                
                $user->save();
                // ----------------- registro de la tabla 'roles_users'
                $u = ORM::factory('user',$user->id);
                $u->add('roles', 1);
                
                
                $empresas = ORM::factory('empresas',$resultVery['id']);
                $empresas->user_id = $user->id;
                $empresas->estado = 2;
                $empresas->save();
                
                
                $destinatario = $resultVery['mail'];
                $asunto = "Datos para el ingreso al sistema de la AEVIVIENDA";
                $cuerpo = '
                <p>Datos para el ingreso al sistema de la AEVIVIENDA</p>
                <table style="width: 813px; height: 240px;" border="0">
                <tbody>
                <tr>
                <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td><span style="color: #0000ff;"><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$resultVery['nombre_proponente'].'</span>:</span></strong></span></td>
                <td>&nbsp;</td>
                </tr>
                <tr class="tablerow1">
                <td style="text-align: justify;">
                <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Su verificaci&oacute;n fue exitosa, su usuario y contrase&ntilde;a son los siguientes:</span></p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Usuario</span></strong> : '.$resultVery['mail'].'</span></p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Contrase&ntilde;a</span></strong>: '.$contraseña.'</span></p> 
                <p>&nbsp;</p>
                <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Ingrese al Sistema para complementar sus datos, Direcci&oacute;n:<a href="http://entidad.aevivienda.gob.bo/registroempresas/selecciontipo/">http://entidad.aevivienda.gob.bo/registroempresas/selecciontipo/</a></span></p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p><span style="text-decoration: underline;"><em><span style="font-family: arial,helvetica,sans-serif; font-size: small;">Notificaci&oacute;n autom&aacute;tica generada por la Agencia Estatal de Vivienda.</span></em></span></p>
                </td>
                <td>&nbsp;</td>
                </tr>
                </tbody>
                </table>
                ';
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "From: Unidad de Sistemas <sistemas@aevivienda.gob.bo>\r\n";
                //$headers .= "Reply-To: mmejia@aevivienda.gob.bo\r\n";
                //$headers .= "Return-path: obarreta@aevivienda.gob.bo\r\n";
                $headers .= "Cc: registro.entidad@aevivienda.gob.bo\r\n";             
                mail($destinatario,$asunto,$cuerpo,$headers);        
            }
         
        }else{
            if($resultVery['estado']!=1){
                $mensaje="Su registro ya fue confirmado. Comuníquese con nosotros a los números de la Pagina web <a href='http://www.aevivienda.gob.bo'>www.aevivienda.gob.bo</a> o envíenos un correo a info@aevivienda.gob.bo.";
                $vista = 'proveedores/registro_reconfirmado';    
            }else{
            $mensaje=utf8_encode("Hubo un problema en su verificación. Comuníquese con nosotros a los números de la Pagina web <a href='http://www.aevivienda.gob.bo'>www.aevivienda.gob.bo</a> o envíenos un correo a info@aevivienda.gob.bo.");        
            }
            
        
        }
        
        
        $this->template->title.='::Confirmacion Registro de Proveedores';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';

        $this->template->content = View::factory($vista)
                        ->bind('resultado1', $idvery)
                        ->bind('resultado2', $decrypt)
                        ->bind('mensaje', $mensaje)
                        ->bind('usuario', $resultVery['mail'])
                        ->bind('contraseña', $contraseña);
    }
      public function encriptar($valor){
        $encrypt = Encrypt::instance('tripledes');
        $passregistro = $encrypt->encode($valor);
        $passgen=$passregistro;  
        $generado=strpos($passregistro, "/");
        if($generado === false){
         return $passgen;  
        }else{
         $this->encriptar($valor);
        }
    }
    public function encrypt($string, $key) {
       $result = '';
       for($i=0; $i<(strlen($string)); $i++) {
          $char = substr($string, $i, 1);
          $keychar = substr($key, ($i % strlen($key))-1, 1);
          $char = chr(ord($char)+ord($keychar));
          $result.=$char;
       }
       return base64_encode($result);
   }
      public function decrypt($string, $key) {
       $result = '';
       $string = base64_decode($string);
       for($i=0; $i<strlen($string); $i++) {
          $char = substr($string, $i, 1);
          $keychar = substr($key, ($i % strlen($key))-1, 1);
          $char = chr(ord($char)-ord($keychar));
          $result.=$char;
       }
       return $result;
       }
       
       public function idempresasocio($asociado){
        $osociosarray = new Model_Sociosaccidental();
        $result = $osociosarray->idsocio($asociado);
        return $result;
    }  
}
/**
 * Función que devuelve un numero en palabras.
 */

?>
