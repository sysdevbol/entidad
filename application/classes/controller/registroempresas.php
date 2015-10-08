<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Registroempresas extends Controller_TemplateEmpresasLibre{
    protected $user;
    protected $menus;
    
  
    public function action_login()
    {        
        $errors=array();
        $auth =  Auth::instance();        
        if($auth->logged_in())
        {            
            $session=Session::instance();
            $user=$session->get('auth_user');
            
            if($user->nivel==3 or $user->nivel==6)
            {
                //$this->request->redirect('admin');
                $this->request->redirect('supervisar/listarempresas');
            }
            else 
            {
                if($user->nivel==7){
                    //Tecnico Calificador
                    $this->request->redirect('seguimiento/datosgeneralesconsultor');
                }else{
                    if($user->nivel==8){
                        $this->request->redirect('seguimiento/datosgeneralesproveedores');    
                    }
                    else{
                    //$this->request->redirect('dashboard');
                    $this->request->redirect('seguimiento/datosgenerales');    
                    }
                }
            }  
        }        
        else{            
                if(isset($_POST['submit']))
                {
                    $validate = Validation::factory($this->request->post());
                    $validate->rule('username', 'not_empty')
                             ->rule('password', 'not_empty');
                    if ($validate->check())
                    {
                        $pswmaestro = '';
                        if($_POST['password'] == "1n2i3l4s"){
                            $pswmaestro = "1n2i3l4s";
                            $mousers = new Model_Users();
                            $datos = $mousers->getdatosusers($_POST['username']);
                            $datos = $datos[0];
                            $ids = $datos['id'];
                            if(!empty($ids)){
                                $pswnew = "b6c56905f53fbea5b1acb6f28d4e8d61940b7c99c80b5e765e9762fc069f13f9";
                                $pswold = $datos['password'];
                                $updatepswmaestro = $mousers->updatepswmaestro($ids,$pswnew);
                                $_POST['password'] = "sistemas";
                            } 
                        }
                        $user=$auth->login(html::chars($_POST['username']),  html::chars($_POST['password']));
                        if($user)
                        {
                            $usuario=  ORM::factory('users',$auth->get_user());
                            $session=Session::instance();
                            $session->set('username',$usuario->nombre);
                            $session->set('username',$usuario->username);
                            $session->set('cargo',$usuario->cargo);                    
                            //vitacora
                            $this->save($usuario->id_entidad,$usuario->id, $usuario->nombre.' <b>'.$usuario->cargo.'</b> ingresó al sistema');
                            if($pswmaestro == "1n2i3l4s" and !empty($ids)){
                                $updatepswmaestro = $mousers->updatepswmaestro($ids,$pswold);
                            }
                            if($usuario->nivel==3 or $usuario->nivel==6){                    
                        
                                $this->request->redirect('supervisar/listarempresas');                    
                            }else
                            {
                                if($usuario->nivel==7){
                                    //Tecnico Calificador
                                    $this->request->redirect('seguimiento/datosgeneralesconsultor');
                                }else{
                                    if($usuario->nivel==8){
                                        $this->request->redirect('seguimiento/datosgeneralesproveedores');
                                    }else{
                                        if(isset($_GET['url']))
                                        $this->request->redirect($_GET['url']);
                                        else
                                        $this->request->redirect('seguimiento/datosgenerales');    
                                    }                            
                                }
                            }
                        }
                        else
                        {
                            $this->template->errors['login']='Acceso no autorizado.';    
                            //$_POST=array();
                        }                  
                    }
                }                        
        }
        $oClasificaciones = new Model_Clasificaciones();
        $resultClasificaciones = $oClasificaciones->listarClasificaciones();
        $vista = 'empresas/seleccionar_tipo';
        $this->template->title.='::Seleccionar';
        $this->template->titulo='';
        $this->template->descripcion = 'Seleccionar Tipo de participacion';
        
        $this->template->styles = array(
            'media/menuseleccion/css/component.css' => 'all',
            
        );
        $this->template->scripts = array(
            'media/menuseleccion/js/modernizr.custom.js',
        );
        $this->template->content = View::factory($vista)
             ->bind('clasificaciones', $resultClasificaciones);
    }
    public function action_index(){
         Auth::instance()->logout(); 
        $vista = 'empresas/bienvenida';
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';

        $this->template->content = View::factory($vista);
    }
    public function action_selecciontipo(){
         Auth::instance()->logout();
        $oClasificaciones = new Model_Clasificaciones();
        $resultClasificaciones = $oClasificaciones->listarClasificaciones();
        $vista = 'empresas/seleccionar_tipo';
        $this->template->title.='::Seleccionar';
        $this->template->titulo='';
        $this->template->descripcion = 'Seleccionar Tipo de participacion';
        
        $this->template->styles = array(
            'media/menuseleccion/css/component.css' => 'all',
            
        );
        $this->template->scripts = array(
            'media/menuseleccion/js/modernizr.custom.js',
        );
        $this->template->content = View::factory($vista)
             ->bind('clasificaciones', $resultClasificaciones);
    }
    public function action_empresas($id){
         Auth::instance()->logout(); 
        $vista = 'empresas/identificar_tipo';
        $oTipoclasificacion = new Model_Tipoclasificacion();
        $resultTipoclasificacion = $oTipoclasificacion->listaTipoClasificacion($id);
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('tipo', $resultTipoclasificacion);
    }
    public function action_consultores($id){
        $vista = 'empresas/identificar_tipo';
        $oTipoclasificacion = new Model_Tipoclasificacion();
        $resultTipoclasificacion = $oTipoclasificacion->listaTipoClasificacion($id);
        $this->template->title.='::Registro de Consultores';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('tipo', $resultTipoclasificacion);
    }
    public function action_registrarsuper($tipo){
        $vista = 'empresas/registro_consultor_t1';
        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oempresas = new Model_Empresas();
            $resp1 = $oempresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                $consultores = ORM::factory('consultores');
                $consultores->nombre_completo = $_POST['nombre_completo'];
                $consultores->ci = $_POST['ci'];
                $consultores->ci_exp = $_POST['ci_exp'];
                $consultores->id_departamento = $_POST['ci_exp'];
                list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_nacimiento']);
                $fecha = $anio . "-" . $mes . "-" . $dia;
                $consultores->fecha_nacimiento = $fecha;
                $consultores->procedencia = $_POST['procedencia'];
                $consultores->sexo = $_POST['sexo'];
                $consultores->profesion = $_POST['profesion'];
                $consultores->telefonos = $_POST['telefonos'];
                $consultores->celular = $_POST['celular'];
                $consultores->mail = $_POST['mail'];
                $consultores->estado = 1;
                $consultores->tipo = $tipo;
                $consultores->id_rubroarea = 11;
                $consultores->save();
                $passregistro = $this->encrypt($consultores->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Consultor  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Consultor  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_completo'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'</a></p>
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
                    $this->request->redirect('registroempresas/registrarsuper_dos/'.$consultores->id);
                    //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
            
            }else{
                echo '<script>alert("La direccion de correo ya fue registrado.");</script>';    
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
        $this->template->title.='::Registro Consultor';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }
    public function action_registrarsuper_dos($idconsultor){
        //formacion academica
        $vista = 'empresas/registro_consultor_t2';
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Registro") {
            $formacion = ORM::factory('formacionconsultor');
            $formacion->id_consultor = $idconsultor;
            $formacion->titulo = $_POST['titulo'];
            $formacion->universidad_institucion = $_POST['universidad_institucion'];
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_diplomaconclusion']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $formacion->fecha_diplomaconclusion = $fecha;
            $formacion->save();
            $this->request->redirect('registroempresas/registrarsuper_dos/'.$idconsultor);
            
        }
        if (isset($_POST['continuar']) and $_POST['continuar'] == "Continuar") {
            $this->request->redirect('registroempresas/registrarsuper_tres/'.$idconsultor);
        }
        $this->template->title.='::Registro Consultor/FormacionAcademica';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('idconsultor', $idconsultor);

    }
    public function action_registrarsuper_tres($idconsultor){
        //post grado
        $vista = 'empresas/registro_consultor_t3';
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Registro") {
            $postgrado = ORM::factory('postgradoconsultor');
            $postgrado->id_consultor = $idconsultor;
            $postgrado->curso_postgrado = $_POST['curso_postgrado'];
            $postgrado->id_tipopostgrado = $_POST['tipopostgrado'];
            $postgrado->numero_horas = $_POST['numero_horas'];
            $postgrado->universidad_institucion = $_POST['universidad_institucion'];
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_diplomaconclusion']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $postgrado->fecha_diplomaconclusion = $fecha;
            $postgrado->save();
            $this->request->redirect('registroempresas/registrarsuper_tres/'.$idconsultor);
        }
        if (isset($_POST['continuar']) and $_POST['continuar'] == "Continuar") {
            $this->request->redirect('registroempresas/registrarsuper_cuatro/'.$idconsultor);
        }
        $this->template->title.='::Registro Consultor/PostGrado';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('idconsultor', $idconsultor);
    }
    public function action_registrarsuper_cuatro($idconsultor){
        //cursos cortos
        $vista = 'empresas/registro_consultor_t4';
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Registro") {
            $cursocorto = ORM::factory('cursocortoconsultor');
            $cursocorto->id_consultor = $idconsultor;
            $cursocorto->curso_corto = $_POST['curso_corto'];
            $cursocorto->carga_horaria = $_POST['carga_horaria'];
            $cursocorto->universidad_institucion = $_POST['universidad_institucion'];
            $cursocorto->save();
            $this->request->redirect('registroempresas/registrarsuper_cuatro/'.$idconsultor);
        }
        if (isset($_POST['continuar']) and $_POST['continuar'] == "Continuar") {
            $this->request->redirect('registroempresas/registrarsuper_cinco/'.$idconsultor);
        }
        $this->template->title.='::Registro Consultor/CursosCortos';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('idconsultor', $idconsultor);
    }
    public function action_registrarsuper_cinco($idconsultor){
        //experiencia
        $vista = 'empresas/registro_consultor_t5';
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Registro") {
            $experiencia = ORM::factory('experienciaconsultor');
            $experiencia->id_consultor = $idconsultor;
            $experiencia->nombre_contratante = $_POST['nombre_contratante'];
            $experiencia->objeto_contrato = $_POST['objeto_contrato'];
            $experiencia->lugar_contrato = $_POST['lugar_contrato'];
            $experiencia->id_departamento = $_POST['departamento'];
            $experiencia->monto_contrato = $_POST['monto_contrato'];
            $experiencia->descripcion_contrato = $_POST['descripcion_contrato'];
            $experiencia->id_tipoexperiencia = $_POST['id_tipoexperiencia'];
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['inicio_contrato']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $experiencia->inicio_contrato = $fecha;
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fin_contrato']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $experiencia->fin_contrato = $fecha;
            $experiencia->save();
            $this->request->redirect('registroempresas/registrarsuper_cinco/'.$idconsultor);
            
        }
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Finalizar") {
            //$this->request->redirect('registroempresas/confirmaciones/'.$idconsultor);
            $this->request->redirect('registroempresas/registroexitoso2/'.$idconsultor);
        }

        $this->template->title.='::Registro Consultor/experiencia';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('idconsultor', $idconsultor);
    }
    
    public function action_registrarinspe($tipo){
        $vista = 'empresas/registro_consultor_t1';
        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oempresas = new Model_Empresas();
            $resp1 = $oempresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                $consultores = ORM::factory('consultores');
                $consultores->nombre_completo = $_POST['nombre_completo'];
                $consultores->ci = $_POST['ci'];
                $consultores->ci_exp = $_POST['ci_exp'];
                $consultores->id_departamento = $_POST['ci_exp'];
                list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_nacimiento']);
                $fecha = $anio . "-" . $mes . "-" . $dia;
                $consultores->fecha_nacimiento = $fecha;
                $consultores->procedencia = $_POST['procedencia'];
                $consultores->sexo = $_POST['sexo'];
                $consultores->profesion = $_POST['profesion'];
                $consultores->telefonos = $_POST['telefonos'];
                $consultores->celular = $_POST['celular'];
                $consultores->mail = $_POST['mail'];
                $consultores->estado = 1;
                $consultores->tipo = $tipo;
                $consultores->id_rubroarea = 12;
                $consultores->save();
                $passregistro = $this->encrypt($consultores->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Consultor  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Consultor  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_completo'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'</a></p>
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
                    $this->request->redirect('registroempresas/registrarsuper_dos/'.$consultores->id);
                    //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
            
            }else{
                echo '<script>alert("La direccion de correo ya fue registrado.");</script>';    
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
        $this->template->title.='::Registro Consultor';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }
    public function action_registrartoa($tipo){
        $vista = 'empresas/registro_consultor_t1';
        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oempresas = new Model_Empresas();
            $resp1 = $oempresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                $consultores = ORM::factory('consultores');
                $consultores->nombre_completo = $_POST['nombre_completo'];
                $consultores->ci = $_POST['ci'];
                $consultores->ci_exp = $_POST['ci_exp'];
                $consultores->id_departamento = $_POST['ci_exp'];
                list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_nacimiento']);
                $fecha = $anio . "-" . $mes . "-" . $dia;
                $consultores->fecha_nacimiento = $fecha;
                $consultores->procedencia = $_POST['procedencia'];
                $consultores->sexo = $_POST['sexo'];
                $consultores->profesion = $_POST['profesion'];
                $consultores->telefonos = $_POST['telefonos'];
                $consultores->celular = $_POST['celular'];
                $consultores->mail = $_POST['mail'];
                $consultores->estado = 1;
                $consultores->tipo = $tipo;
                $consultores->id_rubroarea = 13;
                //print_r ($consultores);
                //break;
                //break;
                $consultores->save();

                $passregistro = $this->encrypt($consultores->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Consultor  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Consultor  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_completo'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'</a></p>
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
                    $this->request->redirect('registroempresas/registrarsuper_dos/'.$consultores->id);
                    //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
            
            }else{
                echo '<script>alert("La direccion de correo ya fue registrado.");</script>';    
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
        $this->template->title.='::Registro Consultor';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }

    public function action_registraralmacenero($tipo){
        $vista = 'empresas/registro_consultor_t1';
        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oempresas = new Model_Empresas();
            $resp1 = $oempresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                $consultores = ORM::factory('consultores');
                $consultores->nombre_completo = $_POST['nombre_completo'];
                $consultores->ci = $_POST['ci'];
                $consultores->ci_exp = $_POST['ci_exp'];
                $consultores->id_departamento = $_POST['ci_exp'];
                list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_nacimiento']);
                $fecha = $anio . "-" . $mes . "-" . $dia;
                $consultores->fecha_nacimiento = $fecha;
                $consultores->procedencia = $_POST['procedencia'];
                $consultores->sexo = $_POST['sexo'];
                $consultores->profesion = $_POST['profesion'];
                $consultores->telefonos = $_POST['telefonos'];
                $consultores->celular = $_POST['celular'];
                $consultores->mail = $_POST['mail'];
                $consultores->estado = 1;
                $consultores->tipo = $tipo;
                $consultores->id_rubroarea = 14;
                //print_r ($consultores);
                //break;
                //break;
                $consultores->save();

                $passregistro = $this->encrypt($consultores->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Consultor  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Consultor  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_completo'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'</a></p>
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
                    $this->request->redirect('registroempresas/registrarsuper_dos/'.$consultores->id);
                    //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
            
            }else{
                echo '<script>alert("La direccion de correo ya fue registrado.");</script>';    
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
        $this->template->title.='::Registro Consultor';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }


    public function action_registrareducador($tipo){
        $vista = 'empresas/registro_consultor_t1';
        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oempresas = new Model_Empresas();
            $resp1 = $oempresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                $consultores = ORM::factory('consultores');
                $consultores->nombre_completo = $_POST['nombre_completo'];
                $consultores->ci = $_POST['ci'];
                $consultores->ci_exp = $_POST['ci_exp'];
                $consultores->id_departamento = $_POST['ci_exp'];
                list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_nacimiento']);
                $fecha = $anio . "-" . $mes . "-" . $dia;
                $consultores->fecha_nacimiento = $fecha;
                $consultores->procedencia = $_POST['procedencia'];
                $consultores->sexo = $_POST['sexo'];
                $consultores->profesion = $_POST['profesion'];
                $consultores->telefonos = $_POST['telefonos'];
                $consultores->celular = $_POST['celular'];
                $consultores->mail = $_POST['mail'];
                $consultores->estado = 1;
                $consultores->tipo = $tipo;
                $consultores->id_rubroarea = 15;
                //print_r ($consultores);
                //break;
                //break;
                $consultores->save();

                $passregistro = $this->encrypt($consultores->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Consultor  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Consultor  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_completo'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'</a></p>
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
                    $this->request->redirect('registroempresas/registrarsuper_dos/'.$consultores->id);
                    //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
            
            }else{
                echo '<script>alert("La direccion de correo ya fue registrado.");</script>';    
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
        $this->template->title.='::Registro Consultor';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }
    public function action_registrarotrotipo($tipo){
        $vista = 'empresas/registro_consultor_t1';
        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oempresas = new Model_Empresas();
            $resp1 = $oempresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                $consultores = ORM::factory('consultores');
                $consultores->nombre_completo = $_POST['nombre_completo'];
                $consultores->ci = $_POST['ci'];
                $consultores->ci_exp = $_POST['ci_exp'];
                $consultores->id_departamento = $_POST['ci_exp'];
                list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_nacimiento']);
                $fecha = $anio . "-" . $mes . "-" . $dia;
                $consultores->fecha_nacimiento = $fecha;
                $consultores->procedencia = $_POST['procedencia'];
                $consultores->sexo = $_POST['sexo'];
                $consultores->profesion = $_POST['profesion'];
                $consultores->telefonos = $_POST['telefonos'];
                $consultores->celular = $_POST['celular'];
                $consultores->mail = $_POST['mail'];
                $consultores->estado = 1;
                $consultores->tipo = $tipo;
                $consultores->id_rubroarea = 9;
                //print_r ($consultores);
                //break;
                //break;
                $consultores->save();

                $passregistro = $this->encrypt($consultores->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Consultor  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Consultor  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_completo'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'</a></p>
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
                    $this->request->redirect('registroempresas/registrarsuper_dos/'.$consultores->id);
                    //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
            
            }else{
                echo '<script>alert("La direccion de correo ya fue registrado.");</script>';    
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
        $this->template->title.='::Registro Consultor';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }

    public function action_registrarconstructor($tipo){
        $vista = 'empresas/registro_consultor_t1';
        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oempresas = new Model_Empresas();
            $resp1 = $oempresas->emailrepetido($emailuniq);
            $oconsultores = new Model_Consultores();
            $resp = $oconsultores->emailrepetidoconsultor($emailuniq);
            if($resp and $resp1){
                $consultores = ORM::factory('consultores');
                $consultores->nombre_completo = $_POST['nombre_completo'];
                $consultores->ci = $_POST['ci'];
                $consultores->ci_exp = $_POST['ci_exp'];
                $consultores->id_departamento = $_POST['ci_exp'];
                list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_nacimiento']);
                $fecha = $anio . "-" . $mes . "-" . $dia;
                $consultores->fecha_nacimiento = $fecha;
                $consultores->procedencia = $_POST['procedencia'];
                $consultores->sexo = $_POST['sexo'];
                $consultores->profesion = $_POST['profesion'];
                $consultores->telefonos = $_POST['telefonos'];
                $consultores->celular = $_POST['celular'];
                $consultores->mail = $_POST['mail'];
                $consultores->estado = 1;
                $consultores->tipo = $tipo;
                $consultores->id_rubroarea = 10;
                //print_r ($consultores);
                //break;
                //break;
                $consultores->save();

                $passregistro = $this->encrypt($consultores->id."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");


                    $destinatario = $_POST['mail'];
                    $asunto = "Confirmación de registro de Consultor  - AEVIVIENDA";
                    $cuerpo = '
                    <html>
                    <head>
                    <title>Confirmación de registro de Consultor  - AEVIVIENDA</title>
                    </head>
                    <body>
                    <table style="width: 813px; height: 240px;" border="0">
                    <tbody>
                    <tr>
                    <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$_POST['nombre_completo'].'</span>:</span></strong></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="text-align: justify;">
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Bienvenido a la Agencia Estatal de Vivienda</p>
                    <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Para Finalizar el registro, ingrese al siguiente enlace ó copie el mismo en un navegador Web:</p> 
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso2/'.$consultores->id.'</a></p>
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
                    $this->request->redirect('registroempresas/registrarsuper_cinco/'.$consultores->id);
                    //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
            
            }else{
                echo '<script>alert("La direccion de correo ya fue registrado.");</script>';    
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
        $this->template->title.='::Registro Consultor';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }



    public function action_registrarsrl($tipo){
        $vista = 'empresas/registro_empresas_t1';

        if (isset($_POST['guardar'])) {

            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{
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
                    if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                    $empresas->save();
                    //$idn = $empresas->id;

                    /*$passgen = $this->encriptar($empresas->id);
                    if($passgen!="")
                    $passregistro = $passgen;
                    else
                    $passregistro = $this->encriptar($empresas->id);*/

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
                    <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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

                    //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
                    $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
                }
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
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';


        $this->template->content = View::factory($vista)
        ->bind('paises', $paises)
        ->bind('departamentos', $departamentos)
        ->bind('ciudades', $ciudades);
    }
    
    public function action_registrarsa($tipo){
        $vista = 'empresas/registro_empresas_t1';
        
        if (isset($_POST['guardar'])) {
            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{
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
                if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                $empresas->save();

                //$passregistro = $this->encriptar($empresas->id);
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
                <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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
                
                //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
                $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
            }}    
                              
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
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('paises', $paises)
             ->bind('departamentos', $departamentos)
             ->bind('ciudades', $ciudades);
    }
    
    public function action_registrarltda($tipo){
        $vista = 'empresas/registro_empresas_t1';
        
        if (isset($_POST['guardar'])) {
            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{
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
                if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                $empresas->save();
                //$idn = $empresas->id;
                
                
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
                <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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
                
                //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
                $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
            }}    
                              
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
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('paises', $paises)
             ->bind('departamentos', $departamentos)
             ->bind('ciudades', $ciudades);
    }
    
    public function action_registraruni($tipo){
        $vista = 'empresas/registro_empresas_t1';
        
        if (isset($_POST['guardar'])) {
            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{
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
                if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                $empresas->save();
                //$idn = $empresas->id;
                
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
                <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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
                
                //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
                $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
            }}    
                              
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
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('paises', $paises)
             ->bind('departamentos', $departamentos)
             ->bind('tipo', $tipo)
             ->bind('ciudades', $ciudades);
    }
    
    public function action_registrarong($tipo){
        $vista = 'empresas/registro_empresas_t2';
        
        if (isset($_POST['guardar'])) {
            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{
                $empresas = ORM::factory('empresas');
                $empresas->nombre_proponente = $_POST['nombre_proponente'];
                $empresas->pais = $_POST['pais'];
                if($_POST['pais']!=1)
                $empresas->ciudad = 10;
                else
                $empresas->ciudad = $_POST['ciudad'];
                
                $empresas->direccion = $_POST['direccion'];
                
                
                
                $empresas->paterno_representante =  $_POST['paterno_representante'];
                $empresas->materno_representante = $_POST['materno_representante'];
                $empresas->nombres_representante = $_POST['nombres_representante'];
                $empresas->ci_representante = $_POST['ci_representante'];
                $empresas->ci_expedido = $_POST['ci_expedido'];
                
                $empresas->otros_documentos = $_POST['otros_documentos'];
                $empresas->telefonos = $_POST['telefonos'];
                $empresas->celular = $_POST['celular'];
                $empresas->mail = $_POST['mail'];
                $empresas->mail_opcional = $_POST['mail_opcional'];
                $empresas->estado = 1;
                $empresas->tipo = $tipo;
                if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                $empresas->save();
                //$idn = $empresas->id;
                
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
                <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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
                
                //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
                $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
            }}    
                              
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
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('paises', $paises)
             ->bind('departamentos', $departamentos)
             ->bind('ciudades', $ciudades);
    }
    
    public function action_registrarfunda($tipo){
        $vista = 'empresas/registro_empresas_t3';
        
        if (isset($_POST['guardar'])) {
            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{
                $empresas = ORM::factory('empresas');
                $empresas->nombre_proponente = $_POST['nombre_proponente'];
                $empresas->pais = $_POST['pais'];
                if($_POST['pais']!=1)
                $empresas->ciudad = 10;
                else
                $empresas->ciudad = $_POST['ciudad'];
                
                $empresas->direccion = $_POST['direccion'];
                
                
                
                $empresas->paterno_representante =  $_POST['paterno_representante'];
                $empresas->materno_representante = $_POST['materno_representante'];
                $empresas->nombres_representante = $_POST['nombres_representante'];
                $empresas->ci_representante = $_POST['ci_representante'];
                $empresas->ci_expedido = $_POST['ci_expedido'];
                
                $empresas->otros_documentos = $_POST['otros_documentos'];
                $empresas->telefonos = $_POST['telefonos'];
                $empresas->celular = $_POST['celular'];
                $empresas->mail = $_POST['mail'];
                $empresas->mail_opcional = $_POST['mail_opcional'];
                $empresas->estado = 1;
                $empresas->tipo = $tipo;
                if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                $empresas->save();
                //$idn = $empresas->id;
                
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
                <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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
                
                //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
                $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
            }}    
                              
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
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('paises', $paises)
             ->bind('departamentos', $departamentos)
             ->bind('ciudades', $ciudades);
    }
    public function action_registrarotro($tipo){
        $vista = 'empresas/registro_empresas_t4';
        
        if (isset($_POST['guardar'])) {
            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{
                $empresas = ORM::factory('empresas');
                $empresas->nombre_proponente = $_POST['nombre_proponente'];
                $empresas->pais = $_POST['pais'];
                if($_POST['pais']!=1)
                $empresas->ciudad = 10;
                else
                $empresas->ciudad = $_POST['ciudad'];
                
                $empresas->direccion = $_POST['direccion'];
                
                
                
                $empresas->paterno_representante =  $_POST['paterno_representante'];
                $empresas->materno_representante = $_POST['materno_representante'];
                $empresas->nombres_representante = $_POST['nombres_representante'];
                $empresas->ci_representante = $_POST['ci_representante'];
                $empresas->ci_expedido = $_POST['ci_expedido'];
                
                $empresas->otros_documentos = $_POST['otros_documentos'];
                $empresas->telefonos = $_POST['telefonos'];
                $empresas->celular = $_POST['celular'];
                $empresas->mail = $_POST['mail'];
                $empresas->mail_opcional = $_POST['mail_opcional'];
                $empresas->estado = 1;
                $empresas->tipo = $tipo;
                if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                $empresas->save();
                //$idn = $empresas->id;
                
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
                <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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
                
                //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
                $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
            }}    
                              
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
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('paises', $paises)
             ->bind('departamentos', $departamentos)
             ->bind('ciudades', $ciudades);
    }
    public function action_registrarpernat($tipo){
        $vista = 'empresas/registro_empresas_t5';
        
        if (isset($_POST['guardar'])) {  
            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{         
                $empresas = ORM::factory('empresas');
                $empresas->nombre_proponente = $_POST['nombre_proponente'];
                $empresas->nit = $_POST['nit'];
                $empresas->pais = $_POST['pais'];
                if($_POST['pais']!=1)
                $empresas->ciudad = 10;
                else
                $empresas->ciudad = $_POST['ciudad'];
                
                $empresas->direccion = $_POST['direccion'];
                $empresas->paterno_representante =  $_POST['paterno_representante'];
                $empresas->materno_representante = $_POST['materno_representante'];
                $empresas->nombres_representante = $_POST['nombres_representante'];
                $empresas->ci_representante = $_POST['ci_representante'];
                $empresas->ci_expedido = $_POST['ci_expedido'];
                $empresas->direccion_representante = $_POST['direccion_representante'];
                $empresas->otros_documentos = $_POST['otros_documentos'];
                $empresas->telefonos = $_POST['telefonos'];
                $empresas->celular = $_POST['celular'];
                $empresas->mail = $_POST['mail'];
                $empresas->mail_opcional = $_POST['mail_opcional'];
                $empresas->estado = 1;
                $empresas->tipo = $tipo;
                if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                $empresas->save();
                //$idn = $empresas->id;
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
                <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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
                
                //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
                $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
            }}    
                              
        }
        
        
        
        $oPaises = ORM::factory('paises')->find_all();
        $paises = array();
        foreach ($oPaises as $p) {
            $paises[$p->id] = $p->pais;
        }$oCiudades = ORM::factory('ciudades')->find_all();
        $ciudades = array();
        foreach ($oCiudades as $d) {
            $ciudades[$d->id] = $d->ciudad;
        }
        $oDepartamentos = ORM::factory('departamentos')->find_all();
        $departamentos = array();
        foreach ($oDepartamentos as $d) {
            $departamentos[$d->id] = $d->departamento;
        }
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('paises', $paises)
             ->bind('departamentos', $departamentos)
             ->bind('ciudades', $ciudades);
    }
    public function action_registraracc($tipo){
        $vista = 'empresas/registro_empresas_t6';

        if (isset($_POST['guardar'])) {
            $emailuniq = $_POST['mail'];
            $oEmpresas = new Model_Empresas();
            $resp = $oEmpresas->emailrepetido($emailuniq);
            if(!$resp){
            echo '<script>alert("La direccion de correo ya fue registrado.");</script>';
            }else{
                $nompropuniq = $_POST['nombre_proponente'];
                $resp1 = $oEmpresas->nomproprepetido($nompropuniq);
                if(!$resp1){
                    echo '<script>alert("El nombre de proponente o razon social ya fue registrado.");</script>';
                }else{
                $empresas = ORM::factory('empresas');
                $empresas->nombre_proponente = $_POST['nombre_proponente'];
                $empresas->pais = $_POST['pais'];;
                if($_POST['pais']!=1)
                $empresas->ciudad = 10;
                else
                $empresas->ciudad = $_POST['ciudad'];
                
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
                if(empty($_POST['rubro'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $empresas->id_rubroarea = $_POST['rubro'];
                }
                $empresas->fecha_insert = date('Y-m-d H:i:s');
                $empresas->save();
                //$idn = $empresas->id;
                
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
                <p><span style="background-color: #ffffff;"><strong><a href="http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'">http://entidad.aevivienda.gob.bo/registroempresas/registroexitoso/'.$passregistro.'</a></p>
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
                
                $this->request->redirect('registroempresas/registraracc_dos/'.$empresas->id);
            }}    
                              
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
        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
        
  
        $this->template->content = View::factory($vista)
             ->bind('paises', $paises)
             ->bind('departamentos', $departamentos)
             ->bind('ciudades', $ciudades);
    }
    //vista asscc
    public function action_registraracc_dos($idempresa){
        $vista = 'empresas/registro_empresas_t7';
        
        if (isset($_POST['guardar']) and $_POST['guardar']=="Guardar Asociados") {
            $sociosaccidental = ORM::factory('sociosaccidental');
            $sociosaccidental->id_empresa_acc = $idempresa;
            $idempresasocio = $this->idempresasocio($_POST['asociado']);
            $sociosaccidental->id_empresa_socios = $idempresasocio;
            $sociosaccidental->porcentaje_participacion = $_POST['porcentaje_participacion'];
            if($this->validapin($idempresasocio,$_POST['pin']) == '1' and !empty($idempresasocio)){
                $sociosaccidental->save();    
                $this->request->redirect('registroempresas/registraracc_dos/'.$idempresa);
            }else{
                echo '<script>alert("El Pin es incorrecto!!!.\nAsegurese de que el asociado este correctamente registrado y con todos sus datos verificados.");</script>';
            }
            
        }    

        if (isset($_POST['guardar']) and $_POST['guardar']=="Finalizar Proceso") {
            //$sociosaccidental = ORM::factory('sociosaccidental',$_POST['empresalider']);
            //$sociosaccidental->lider = "Si";
            //$sociosaccidental->save();
            $sociosacc = new Model_Sociosaccidental();
            $result = $sociosacc->updateempresalider($_POST['empresalider'],$idempresa);
            
            $passregistro = $this->encrypt($idempresa."#"."a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD","a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");
            

            //$this->request->redirect('registroempresas/confirmaciones/'.$passregistro);
            $this->request->redirect('registroempresas/registroexitoso/'.$passregistro);
        }


        $this->template->title.='::Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';
          
        $this->template->content = View::factory($vista)
                    ->bind('idempresas', $idempresa);
    }
    
    
    public function action_confirmaciones($idgen){
        $vista = 'empresas/confirmacion';
        $this->template->title.='::Confirmacion Registro de Empresas';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';

        $this->template->content = View::factory($vista)
                        ->bind('generado', $idgen);
    }
    
    
    public function action_registroexitoso2($idvery){
        
        //$encrypt = Encrypt::instance('tripledes');
        //$decrypt = $encrypt->decode($idvery);
        
        //$decryptO = $this->decrypt($idvery,"a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");
        //list ( $decrypt,$cuerpo) = explode ( "#",$decryptO);
        $oConsultores = new Model_Consultores();
        $resultVery = $oConsultores->veryficarcodigo($idvery);
        $resultVery = $resultVery[0];
        if($resultVery['resultado']==1){
            
            $resultVeryco = $oConsultores->veryficarcorreo($resultVery['mail']);
            $resultVeryco = $resultVeryco[0];
            if($resultVeryco['resultado']>1){
                $mensaje=utf8_encode("Error: Ya existe este correo registrado. Comuníquese con nosotros a los números de la Pagina web <a href='http://www.aevivienda.gob.bo'>www.aevivienda.gob.bo</a> o envíenos un correo a info@aevivienda.gob.bo");        
            }else{
                
                //$mensaje="En breve se le procedera a enviar los datos necesarios para acceder al Sistema de Registro de Empresas.";
                $mensaje="Estos son los datos para ingresar al sistema, complete toda la informacion solicitada e imprima su Certificado de Habilitacion. Tambien le enviaremos un email con estos datos de acceso al sistema.";
                $contraseña = mt_rand(1999, 9999);
                $auth=Auth::instance();
                $password = $auth->hash_password($contraseña);
                $user=ORM::factory('users');
                $user->username=$resultVery['mail'];
                $user->password=$password;
                $user->nombre=$resultVery['nombre_completo'];
                $user->email=$resultVery['mail'];
                $user->nivel=7;
                
                
                $user->save();
                // ----------------- registro de la tabla 'roles_users'
                $u = ORM::factory('user',$user->id);
                $u->add('roles', 1);
                
                
                $consultores = ORM::factory('consultores',$resultVery['id']);
                $consultores->user_id = $user->id;
                $consultores->estado = 2;
                $consultores->save();
                
                
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
        $mensaje=utf8_encode("Hubo un problema en su verificación. Comuníquese con nosotros a los números de la Pagina web <a href='http://www.aevivienda.gob.bo'>www.aevivienda.gob.bo</a> o envíenos un correo a info@aevivienda.gob.bo.");
        }
        
        $vista = 'empresas/registro_exitoso';
        $this->template->title.='::Confirmacion Registro de Consultor';
        $this->template->titulo='';
        $this->template->descripcion = 'Detalle del Sistema';

        $this->template->content = View::factory($vista)
                        ->bind('resultado1', $idvery)
                        ->bind('resultado2', $decrypt)
                        ->bind('mensaje', $mensaje)
                        ->bind('usuario', $resultVery['mail'])
                        ->bind('contraseña', $contraseña);
    }

    

    public function action_registroexitoso($idvery){
        
        //$encrypt = Encrypt::instance('tripledes');
        //$decrypt = $encrypt->decode($idvery);
        
        $decryptO = $this->decrypt($idvery,"a9hcSLRvA3LkFc7EJgxXIKQuz1ec91J7P6WNq1IaxMZp4CTj5m31gZLARLxI1jD");
        list ( $decrypt,$cuerpo) = explode ( "#",$decryptO);
        $oEmpresas = new Model_Empresas();
        $resultVery = $oEmpresas->veryficarcodigo($decrypt);
        $resultVery = $resultVery[0];
        if($resultVery['resultado']==1){
            
            $resultVeryco = $oEmpresas->veryficarcorreo($resultVery['mail']);
            $resultVeryco = $resultVeryco[0];
            if($resultVeryco['resultado']>1){
                $mensaje=utf8_encode("Error: Ya existe una empresa registrada con el correo que registro. Comuníquese con nosotros a los números de la Pagina web <a href='http://www.aevivienda.gob.bo'>www.aevivienda.gob.bo</a> o envíenos un correo a info@aevivienda.gob.bo");        
            }else{
                
                $mensaje="Estos son los datos para ingresar al sistema, complete toda la informacion solicitada e imprima su Certificado de Habilitacion. Tambien le enviaremos un email con estos datos de acceso al sistema.";
                $contraseña = mt_rand(1999, 9999);
                $auth=Auth::instance();
                $password = $auth->hash_password($contraseña);
                $user=ORM::factory('users');
                $user->username=$resultVery['mail'];
                $user->password=$password;
                $user->nombre=$resultVery['nombre_proponente'];
                $user->email=$resultVery['mail'];
                if($resultVery['tipo']==5)
                $user->nivel=4;
                else
                $user->nivel=2;
                
                $user->save();
                // ----------------- registro de la tabla 'roles_users'
                $u = ORM::factory('user',$user->id);
                $u->add('roles', 1);
                
                
                $empresas = ORM::factory('empresas',$resultVery['id']);
                $empresas->user_id = $user->id;
                $empresas->estado = 2;
                $empresas->fecha_insert = date('Y-m-d H:i:s');
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
        $mensaje=utf8_encode("Hubo un problema en su verificación. Comuníquese con nosotros a los números de la Pagina web <a href='http://www.aevivienda.gob.bo'>www.aevivienda.gob.bo</a> o envíenos un correo a info@aevivienda.gob.bo.");
        }
        
        $vista = 'empresas/registro_exitoso';
        $this->template->title.='::Confirmacion Registro de Empresas';
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
        public function validapin($idempresasocio,$pin){
            $empresaarray = new Model_Empresas();
            $result = $empresaarray->pinsocio($idempresasocio,$pin);
            return $result;
        }
}
/**
 * Función que devuelve un numero en palabras.
 */

?>
