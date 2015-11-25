<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Seguimiento extends Controller_IndexTemplate{
    protected $user;
    protected $menus;
    public function before() 
    {
        $auth =  Auth::instance();     
        if($auth->logged_in())
        {        
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);
        parent::before();
        $this->template->titulo='<v>Supervisar / </v>';
        $this->template->username=$this->user->nombre;
        if($this->user->theme!=null)
            {$this->template->theme=$this->user->theme; }
        }
        else
        {
            $url= substr($_SERVER['REQUEST_URI'],1);
            $this->request->redirect('/registroempresas/selecciontipo?url='.$url);
        }        
    }
    public function after() 
    {        
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'correspondence');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('correspondence');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Correspondencia');        
        parent::after();
    }      
    
    public function action_datosgeneralesconsultor1(){
        
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Registro") {
            $idconsultor = $_POST['idconsultor'];
            $formacion = ORM::factory('formacionconsultor');
            $formacion->id_consultor = $idconsultor;
            $formacion->titulo = $_POST['titulo'];
            $formacion->tipo = $_POST['tipotitulo'];
            $formacion->universidad_institucion = $_POST['universidad_institucion'];
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_diplomaconclusion']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $formacion->fecha_diplomaconclusion = $fecha;
            $formacion->save();
            
        }
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Actualizar") {
            $formacion = ORM::factory('formacionconsultor',$_POST['idformacion']);
            $formacion->titulo = $_POST['titulo1'];
            $formacion->universidad_institucion = $_POST['universidad_institucion1'];
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_diplomaconclusion1']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $formacion->fecha_diplomaconclusion = $fecha;
            $formacion->tipo = $_POST['tipotitulo1'];
            $formacion->save();
            $this->request->redirect('seguimiento/datosgeneralesconsultor1');
        }
        if (isset($_POST['eliminar']) and $_POST['eliminar'] == "Eliminar") {
            $oformacion = new Model_Formacionconsultor();
            $result = $oformacion->eliminaformacion($_POST['ideliminaformacion']);
            $this->request->redirect('seguimiento/datosgeneralesconsultor1');
        }

        $user = $this->user;
            $idu = $this->user->id;
            $oconsultores = new Model_Consultores();
            $resultDatos = $oconsultores->datosconsultor($idu);
            $resultDatos = $resultDatos[0];
            $vista = 'empresas/datos_generalesconsultor1';
            
            
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('paises', $paises)
                                       ->bind('departamentos', $departamentos)
                                       ->bind('ciudades', $ciudades)
                                       ->bind('datosC', $resultDatos);


    }
    public function action_datosgeneralesconsultor2(){
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Registro") {
            $idconsultor = $_POST['idconsultor'];
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
            
        }
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Actualizar") {
            $postgrado = ORM::factory('postgradoconsultor',$_POST['idpostgrado']);
            $postgrado->curso_postgrado = $_POST['curso_postgrado1'];
            $postgrado->id_tipopostgrado = $_POST['tipopostgrado1'];
            $postgrado->numero_horas = $_POST['numero_horas1'];
            $postgrado->universidad_institucion = $_POST['universidad_institucion1'];
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_diplomaconclusion1']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $postgrado->fecha_diplomaconclusion = $fecha;
            $postgrado->save();
            $this->request->redirect('seguimiento/datosgeneralesconsultor2');
        }
        if (isset($_POST['eliminar']) and $_POST['eliminar'] == "Eliminar") {
            $opostgrado = new Model_Postgradoconsultor();
            $result = $opostgrado->eliminapostgrado($_POST['ideliminapostgrado']);
            $this->request->redirect('seguimiento/datosgeneralesconsultor2');
        }

        $user = $this->user;
            $idu = $this->user->id;
            $oconsultores = new Model_Consultores();
            $resultDatos = $oconsultores->datosconsultor($idu);
            $resultDatos = $resultDatos[0];
            $vista = 'empresas/datos_generalesconsultor2';
            
            
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('paises', $paises)
                                       ->bind('departamentos', $departamentos)
                                       ->bind('ciudades', $ciudades)
                                       ->bind('datosC', $resultDatos);

        
    }
    public function action_datosgeneralesconsultor3(){
        
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Registro") {
            $idconsultor = $_POST['idconsultor'];
            $curso = ORM::factory('cursocortoconsultor');
            $curso->id_consultor = $idconsultor;
            $curso->curso_corto = $_POST['curso_corto'];
            $curso->carga_horaria = $_POST['carga_horaria'];
            $curso->universidad_institucion = $_POST['universidad_institucion'];
            
            $curso->save();
            
        }
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Actualizar") {
            $curso = ORM::factory('cursocortoconsultor',$_POST['idcurso']);
            $curso->curso_corto = $_POST['curso_corto1'];
            $curso->carga_horaria = $_POST['carga_horaria1'];
            $curso->universidad_institucion = $_POST['universidad_institucion1'];
            $curso->save();
            $this->request->redirect('seguimiento/datosgeneralesconsultor3');
        }
        if (isset($_POST['eliminar']) and $_POST['eliminar'] == "Eliminar") {
            $ocurso = new Model_Cursocortoconsultor();
            $result = $ocurso->eliminacursocorto($_POST['ideliminacurso']);
            $this->request->redirect('seguimiento/datosgeneralesconsultor3');
        }

        $user = $this->user;
            $idu = $this->user->id;
            $oconsultores = new Model_Consultores();
            $resultDatos = $oconsultores->datosconsultor($idu);
            $resultDatos = $resultDatos[0];
            $vista = 'empresas/datos_generalesconsultor3';
            
            
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('paises', $paises)
                                       ->bind('departamentos', $departamentos)
                                       ->bind('ciudades', $ciudades)
                                       ->bind('datosC', $resultDatos);
        
    }
    public function action_datosgeneralesconsultor4(){
        
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Registro") {
            $idconsultor = $_POST['idconsultor'];

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
            $experiencia->id_rubro = $_POST['rubro'];
            $experiencia->save();

            
        }
        if (isset($_POST['guardar']) and $_POST['guardar'] == "Actualizar") {
            $experiencia = ORM::factory('experienciaconsultor',$_POST['idexp']);
            
            $experiencia->nombre_contratante = $_POST['nombre_contratante1'];
            $experiencia->objeto_contrato = $_POST['objeto_contrato1'];
            $experiencia->lugar_contrato = $_POST['lugar_contrato1'];
            $experiencia->id_departamento = $_POST['departamento1'];
            $experiencia->monto_contrato = $_POST['monto_contrato1'];
            $experiencia->descripcion_contrato = $_POST['descripcion_contrato1'];
            $experiencia->id_tipoexperiencia = $_POST['tipo1'];
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['inicio_contrato1']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $experiencia->inicio_contrato = $fecha;
            list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fin_contrato1']);
            $fecha = $anio . "-" . $mes . "-" . $dia;
            $experiencia->fin_contrato = $fecha;
            $experiencia->id_rubro = $_POST['rubro1'];
            $experiencia->save();
            $this->request->redirect('seguimiento/datosgeneralesconsultor4');
        }
        if (isset($_POST['eliminar']) and $_POST['eliminar'] == "Eliminar") {
            
            $oexp = new Model_Experienciaconsultor();
            $result = $oexp->eliminaexp($_POST['ideliminaexp']);
            $this->request->redirect('seguimiento/datosgeneralesconsultor4');
        }

        $user = $this->user;
            $idu = $this->user->id;
            $oconsultores = new Model_Consultores();
            $resultDatos = $oconsultores->datosconsultor($idu);
            $resultDatos = $resultDatos[0];
            $vista = 'empresas/datos_generalesconsultor4';
            
            
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('paises', $paises)
                                       ->bind('departamentos', $departamentos)
                                       ->bind('ciudades', $ciudades)
                                       ->bind('datosC', $resultDatos);
        
    }

    public function action_datosgeneralesconsultor(){
            
            if (isset($_POST['guardar'])) {
                $consultores = ORM::factory('consultores',$_POST['id']);
                $consultores->nombre_completo = $_POST['nombre_completo'];
                $consultores->ci = $_POST['ci'];
                $consultores->ci_exp = $_POST['ci_exp'];
                list ( $dia, $mes, $anio ) = explode ( "/",$_POST['fecha_nacimiento']);
                $fecha = $anio . "-" . $mes . "-" . $dia;
                $consultores->fecha_nacimiento = $fecha;
                $consultores->procedencia = $_POST['procedencia'];
                $consultores->sexo = $_POST['sexo'];
                $consultores->profesion = $_POST['profesion'];
                $consultores->telefonos = $_POST['telefonos'];
                $consultores->celular = $_POST['celular'];
                $consultores->save();                
            }
            $this->template->title.='Datos generales Consultor';
            $this->template->titulo='Datos generales Consultor';
            $this->template->descripcion = '';
            
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

            $user = $this->user;
            $idu = $this->user->id;
            $oconsultores = new Model_Consultores();
            $resultDatos = $oconsultores->datosconsultor($idu);
            $resultDatos = $resultDatos[0];
            $vista = 'empresas/datos_generalesconsultor';
            
            
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('paises', $paises)
                                       ->bind('departamentos', $departamentos)
                                       ->bind('ciudades', $ciudades)
                                       ->bind('datosC', $resultDatos);
        }
    public function action_genregistroconsultor(){
            $vista = 'empresas/generar_registroconsultor';
            if(isset($_POST['submit']) and $_POST['submit'] == "Generar e Imprimir Registro"){
                $estadoconsultor = $_POST['estado'];
                $idcons = $_POST['idcons'];
                if($estadoconsultor == 4){
                  //echo '<script>alert("Usted esta generando el certificado nuevamente, necesita dirigirse a la departamental para ser Habilitado.")</script>';  
                }
                $consul = ORM::factory('consultores',$idcons);
                $consul->estado = "3";
                $consul->save();
                //$oEmpresas1 = new Model_Empresas();
                //$re=$oEmpresas1->generapin($idempresa);
                //echo '<script>alert("GENERA!!!!!")</script>';    
                //echo '<script>location.href = "/reporte2.php/?ide="+'.$idempresa.';</script>';
                $this-> guardarconfirmacionconsultorextra($idcons);   
                $this->request->redirect('reporte_consultor.php?ide='.$idcons); 

            }
            $this->template->title.='Generar e imprimir Registro';
            $this->template->descripcion = '';
            $this->template->styles = array(
                'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
                'media/jqwidgets/styles/jqx.office.css' => 'all',
                'media/jqwidgets/styles/jqx.base.css' => 'all',
            );
            $user = $this->user;
            $idu = $this->user->id;
            $oconsultores = new Model_Consultores();
            $resultDatos = $oconsultores->datosconsultor($idu);
            $resultDatos = $resultDatos[0];
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('datosC', $resultDatos);
        }

    public function action_rubrosareas(){
            $vista = 'empresas/rubroarea';
            if(isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Seleccionados"){
                //print_r($_POST);
                if(!empty($_POST['reg'])){
                    $registros = array_keys($_POST['reg']);
                    $registros = implode(",", $registros);
                    //$registros = explode(",", $registros);
                    //print_r($registros);
                    //print_r($_POST['idprop']);
                    //print_r($_POST['idcla']);
                    if($_POST['idcla'] == 3){
                        $modelcons = new Model_Consultores();
                        $modelcons->guardaarearubro($_POST['idprop'],$registros);
                    }elseif ($_POST['idcla'] == 1 OR $_POST['idcla'] == 2) {
                        //$modeldeptosinteres = new Model_Departamentosinteres();
                        //$modeldeptosinteres->guardardeptosinteres($registros,$_POST['idprop']);
                    }
                    echo '<script>alert("Su seleccion fue guardada correctamente!!!");</script>';
                }else{
                    echo '<script>alert("Eliga al menos un Area o Rubro.");</script>';
                }
            }
            $this->template->title.='Seleccione las areas o rubros de su interes';
            $this->template->descripcion = 'Seleccione las areas';
            $this->template->styles = array(
                'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
                'media/jqwidgets/styles/jqx.office.css' => 'all',
                'media/jqwidgets/styles/jqx.base.css' => 'all',
            );
            $user = $this->user;
            $idu = $this->user->id;
            $oconsultores = new Model_Consultores();
            $resultDatos = $oconsultores->datosconsultor($idu);
            $resultDatos = $resultDatos[0];
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('datosC', $resultDatos);
        }        


    public function action_datosgenerales(){
            
            if (isset($_POST['guardar'])) {
                $empresas = ORM::factory('empresas',$_POST['ide']);
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
                $empresas->mail_opcional = $_POST['mail_opcional'];
                $empresas->otros_documentos = $_POST['otros_documentos'];
                $empresas->direccion_representante = $_POST['direccion_representante'];
                if(empty($_POST['reg'])){
                    $empresas->id_rubroarea = 17;
                }else{
                    $registros = array_keys($_POST['reg']);
                    $registros = implode(",", $registros);
                    $empresas->id_rubroarea = $registros;
                }
                $empresas->save();    
                
            }
            
            
            $this->template->title.='Datos generales de tu Empresa';
            $this->template->titulo='Datos generales de tu Empresa';
            $this->template->descripcion = '';
            
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
            $user = $this->user;
            $idu = $this->user->id;
            $oEmpresas = new Model_Empresas();
            $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
            $resultDatos = $resultDatos[0];
            switch($resultDatos['tipo']){
            //cochabamba
            case 1:
            $vista = 'empresas/datos_generales1';
            break;
            case 2:
            $vista = 'empresas/datos_generales1';
            break;
            case 3:
            $vista = 'empresas/datos_generales1';
            break;
            case 4:
            $vista = 'empresas/datos_generales1';
            break;
            case 5:
            $vista = 'empresas/datos_generales6';
            break;
            case 6:
            $vista = 'empresas/datos_generales2';
            break;
            case 7:
            $vista = 'empresas/datos_generales3';
            break;
            case 8:
            $vista = 'empresas/datos_generales5';
            break;
            case 13:
            $vista = 'empresas/datos_generales4';
            break;
       
            }
            
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('paises', $paises)
                                       ->bind('departamentos', $departamentos)
                                       ->bind('ciudades', $ciudades)
                                       ->bind('datosE', $resultDatos);
        }
        

        public function action_genregistro(){
            $vista = 'empresas/generar_registro';
            if(isset($_POST['submit']) and $_POST['submit'] == "Generar e Imprimir Registro"){
                $idempresa = $_POST['ide'];
                $estadoempresa = $_POST['estado'];
                //verificadatos
                $oEmpresas = new Model_Empresas();
                $res = $oEmpresas->verificadatos($idempresa);
                if($res != 'ok'){
                    echo '<script>alert("Verifique sus Datos Generales.")</script>';
                }else{
                    //verificaexp
                    $oexperiencia = new Model_Experienciaentidad();
                    $res1 = $oexperiencia->verificaexp($idempresa);
                    if($res1 != 'ok'){
                        echo '<script>alert("Deberia tener al menos un registro de Experiencia Laboral registrado.")</script>';
                    }else{
                        //verificadepinteres
                        $odeptosinteres = new Model_Departamentosinteres();
                        $res2 = $odeptosinteres->verificadint($idempresa);
                        if($res2 != 'ok'){
                            echo '<script>alert("Deberia tener al menos un Departamento de interes seleccionado.")</script>';    
                        }else{
                            if($estadoempresa == 4){
                              //echo '<script>alert("Usted esta generando el certificado nuevamente, necesita dirigirse a la departamental para ser Habilitado.")</script>';  
                            }
                            //genera registro
                            $pin = 100000+$idempresa;
                            $empresapin = ORM::factory('empresas',$idempresa);
                            $empresapin->pin_empresa = $pin;
                            $empresapin->estado = "3";
                            $empresapin->save();
                            //$oEmpresas1 = new Model_Empresas();
                            //$re=$oEmpresas1->generapin($idempresa);
                            //echo '<script>alert("GENERA!!!!!")</script>';    
                            $this->guardarconfirmacionextra($idempresa);
                            echo '<script>location.href = "/reporte_entidad.php/?ide="+'.$idempresa.';</script>';    
                        }
                    }
                }
                
                
            }
            $this->template->title.='Generar e imprimir Registro';
            $this->template->descripcion = '';
            $this->template->styles = array(
                'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
                'media/jqwidgets/styles/jqx.office.css' => 'all',
                'media/jqwidgets/styles/jqx.base.css' => 'all',
            );
            $user = $this->user;
            $idu = $this->user->id;
            $oEmpresas = new Model_Empresas();
            $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
            $resultDatos=$resultDatos[0];
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('ide',$resultDatos['id'])
                                       ->bind('estado',$resultDatos['estado'])
                                       ->bind('idu', $idu);
        }

        public function action_genregistroacc(){
            $vista = 'empresas/generar_registro';
            if(isset($_POST['submit']) and $_POST['submit'] == "Generar e Imprimir Registro"){
                $idempresa = $_POST['ide'];
                $estadoempresa = $_POST['estado'];
                //verificadatos
                $oEmpresas = new Model_Empresas();
                $res = $oEmpresas->verificadatos($idempresa);
                if($res != 'ok'){
                    echo '<script>alert("Verifique sus Datos Generales.")</script>';
                }else{
                    //verifica socios
                    $oexperiencia = new Model_Sociosaccidental();
                    $res1 = $oexperiencia->verificasociosacc($idempresa);
                    if($res1 != 'ok'){
                        echo '<script>alert("Deberia tener al menos un socio registrado.")</script>';
                    }else{
                        if($estadoempresa == 4){
                          //echo '<script>alert("Usted esta generando el certificado nuevamente, necesita dirigirse a la departamental para ser Habilitado.")</script>';  
                        }
                        //genera registro
                        $pin = 100000+$idempresa;
                        $empresapin = ORM::factory('empresas',$idempresa);
                        $empresapin->pin_empresa = $pin;
                        $empresapin->estado = "3";
                        $empresapin->save();
                        //$oEmpresas1 = new Model_Empresas();
                        //$re=$oEmpresas1->generapin($idempresa);
                        //echo '<script>alert("GENERA!!!!!")</script>';
                        $this->guardarconfirmacionextra($idempresa);    
                        echo '<script>location.href = "/reporte_entidad.php/?ide="+'.$idempresa.';</script>';
                    }
                }
                
                
            }
            $this->template->title.='Generar e imprimir Registro';
            $this->template->descripcion = '';
            $this->template->styles = array(
                'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
                'media/jqwidgets/styles/jqx.office.css' => 'all',
                'media/jqwidgets/styles/jqx.base.css' => 'all',
            );
            $user = $this->user;
            $idu = $this->user->id;
            $oEmpresas = new Model_Empresas();
            $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
            $resultDatos=$resultDatos[0];
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('ide',$resultDatos['id'])
                                       ->bind('estado',$resultDatos['estado'])
                                       ->bind('idu', $idu);
        }

        public function action_deptosinteres(){
            $vista = 'empresas/departamentos_interes';
            if(isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Seleccionados"){
                //print_r($_POST);
                if(!empty($_POST['reg'])){
                    $registros = array_keys($_POST['reg']);
                    $registros = implode(",", $registros);
                    $registros = explode(",", $registros);
                    //print_r($registros);
                    //print_r($_POST['ide']);
                    $modeldeptosinteres = new Model_Departamentosinteres();
                    $modeldeptosinteres->guardardeptosinteres($registros,$_POST['ide']);
                }else{
                    echo '<script>alert("Eliga al menos un departamento.");</script>';
                }
            }
            $this->template->title.='Departamentos de Interes para la Empresa';
            $this->template->descripcion = '';
            $this->template->styles = array(
                'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
                'media/jqwidgets/styles/jqx.office.css' => 'all',
                'media/jqwidgets/styles/jqx.base.css' => 'all',
            );
            $user = $this->user;
            $idu = $this->user->id;
            $oEmpresas = new Model_Empresas();
            $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
            $resultDatos=$resultDatos[0];
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('ide',$resultDatos['id'])
                                       ->bind('idu', $idu);
        }
        public function action_deptosinteres2(){
            $vista = 'empresas/departamentos_interes';
            if(isset($_POST['guardar']) and $_POST['guardar'] == "Guardar Seleccionados"){
                //print_r($_POST);
                if(!empty($_POST['reg'])){
                    $registros = array_keys($_POST['reg']);
                    $registros = implode(",", $registros);
                    $registros = explode(",", $registros);
                    //print_r($registros);
                    //print_r($_POST['ide']);
                    $modeldeptosinteres = new Model_Departamentosinteres();
                    $modeldeptosinteres->guardardeptosinteres2($registros,$_POST['ide']);
                }else{
                    echo '<script>alert("Eliga al menos un departamento.");</script>';
                }
            }
            $this->template->title.='Departamentos de Interes para la Empresa';
            $this->template->descripcion = '';
            $this->template->styles = array(
                'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
                'media/jqwidgets/styles/jqx.office.css' => 'all',
                'media/jqwidgets/styles/jqx.base.css' => 'all',
            );
            $tiposi = 'si';
            $user = $this->user;
            $idu = $this->user->id;
            $oEmpresas = new Model_Consultores();
            $resultDatos = $oEmpresas->datosconsultor2($this->user->username);
            $resultDatos=$resultDatos[0];
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('ide',$resultDatos['id'])
                                       ->bind('consultor',$tiposi)
                                       ->bind('idu', $idu);
        }


        public function action_experiencia(){
            
        if (isset($_POST['ide'])) {
            if ($_POST['idex']!='')
            $experienciaentidad = ORM::factory('experienciaentidad',$_POST['idex']);
            else
            $experienciaentidad = ORM::factory('experienciaentidad');
            $experienciaentidad->id_entidad = $_POST['ide'];
            $experienciaentidad->contratante = $_POST['contratante'];
            $experienciaentidad->objeto_contrato = $_POST['objeto_contrato'];
            $experienciaentidad->ubicacion = $_POST['ubicacion'];
            $experienciaentidad->monto_contrato = $this->parse_number($_POST['monto_contrato'], '.');
            $experienciaentidad->fecha_ini_contrato = date::dateformat($_POST['fecha_ini_contrato']);
            $experienciaentidad->fecha_fin_contrato = date::dateformat($_POST['fecha_fin_contrato']);
            $experienciaentidad->porcentaje_asociacion =$_POST['porcentaje_asociacion'];
            $experienciaentidad->nombre_socios = $_POST['nombre_socios'];
            $experienciaentidad->fecha_registro = date('Y-m-d H:m:i');    
            if(isset($_POST['tipo']))
            $experienciaentidad->tipo = $_POST['tipo'];
            else
            $experienciaentidad->tipo = 2;

            $experienciaentidad->relacion_estado = $_POST['estado'];
            $experienciaentidad->id_area = $_POST['area'];
            $experienciaentidad->id_departamento = $_POST['departamento'];
            $experienciaentidad->id_rubro = $_POST['rubro'];
            $experienciaentidad->save();
        }            
        
            
            
            
        $vista = 'empresas/datos_experiencia';
        $this->template->title.='::Experiencia';
        $this->template->titulo='Listado de la Experiencia';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        $this->template->scripts = array(
            'media/jqwidgets/globalization/globalize.js',
            'media/jqwidgets/jqxcalendar.js',
            'media/jqwidgets/jqxdatetimeinput.js',
            'media/jqwidgets/jqxwindow.js',
            'media/jqwidgets/scripts/gettheme.js',
            'media/jqwidgets/jqxnumberinput.js',
            'media/jqwidgets/jqxgrid.aggregates.js',
            'media/jqwidgets/jqxgrid.columnsresize.js',
            'media/jqwidgets/jqxgrid.columnsreorder.js',
            'media/jqwidgets/jqxdata.export.js',
            'media/jqwidgets/jqxgrid.export.js',
            'media/jqwidgets/jqxgrid.edit.js',
            'media/jqwidgets/jqxgrid.grouping.js',
            'media/jqwidgets/jqxgrid.selection.js',
            'media/jqwidgets/jqxgrid.filter.js',
            'media/jqwidgets/jqxgrid.pager.js',
            'media/jqwidgets/jqxgrid.sort.js',
            'media/jqwidgets/jqxdata.js',
            'media/jqwidgets/jqxgrid.js',
            'media/jqwidgets/jqxdropdownlist.js',
            'media/jqwidgets/jqxlistbox.js',
            'media/jqwidgets/jqxcheckbox.js',
            'media/jqwidgets/jqxmenu.js',
            'media/jqwidgets/jqxscrollbar.js',
            'media/jqwidgets/jqxbuttons.js',
            'media/jqwidgets/jqxcore.js',
            'media/js/jquery.number.min.js',
            

        );
        $user = $this->user;
        $idu = $this->user->id;
        
        $oEmpresas = new Model_Empresas();
        $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
        $resultDatos=$resultDatos[0];
        
        $oTipoexperiencia = ORM::factory('tipoexperiencia')->find_all();
        $texperiencia['0'] = "Selecione tipo de Experiencia";
        foreach ($oTipoexperiencia as $d) {
            $texperiencia[$d->id] = $d->tipo;
        }
        
        $this->template->content = View::factory($vista)
                                   ->bind('user', $user)
                                   ->bind('idu', $idu)
                                   ->bind('ide',$resultDatos['id'])
                                   ->bind('texperiencia',$texperiencia);
    }
/*ptoveeeedoressss*/
    public function action_datosgeneralesproveedores(){
            
            if (isset($_POST['guardar'])) {
                $empresas = ORM::factory('empresas',$_POST['ide']);
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
                $empresas->mail_opcional = $_POST['mail_opcional'];
                $empresas->otros_documentos = $_POST['otros_documentos'];
                $empresas->direccion_representante = $_POST['direccion_representante'];
                $empresas->save();    
                
            }
            
            
            $this->template->title.='Datos generales de tu Empresa';
            $this->template->titulo='Datos generales de tu Empresa';
            $this->template->descripcion = '';
            
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
            $user = $this->user;
            $idu = $this->user->id;
            $oEmpresas = new Model_Empresas();
            $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
            $resultDatos = $resultDatos[0];
            
            $vista = 'proveedores/datos_generales';
           
            
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('idu', $idu)
                                       ->bind('paises', $paises)
                                       ->bind('departamentos', $departamentos)
                                       ->bind('ciudades', $ciudades)
                                       ->bind('datosE', $resultDatos);
        }
        public function action_materiales(){
            $vista = 'proveedores/lista_materiales';
            $oEmpresas = new Model_Empresas();
            $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
            $resultDatos=$resultDatos[0];
            if(isset($_POST['guardar'])){
                $_obj=New Model_Proveedormateriales();
				$_obj->deleteByMateriales($_POST['ide']);
                
                foreach($_POST['seleccion'] as $s=>$v){
                    //echo "<script>alert('$v');</script>";
                    $valorDep='';
                    $valorMun='';
                    foreach($_POST['departamento'][$v] as $d=>$dv){
                        $valorDep .= $dv.","; 
                    }
                    foreach($_POST['municipio'][$v] as $d=>$dv){
                        $valorMun .= $dv.","; 
                    }
                    $materiales = ORM::factory('proveedormateriales');
                    $materiales->empresa_id = $_POST['ide'];
                    $materiales->material_id = $v;
                    $materiales->departamentos = $valorDep;
                    $materiales->municipios = $valorMun;
                    if($resultDatos['tipo'] == '9'){
                        $materiales->tipo = 1;
                    }elseif ($resultDatos['tipo'] == '19') {
                        $materiales->tipo = 2;
                    }
                    
                    $materiales->save();    
                        
                }
                if($resultDatos['tipo'] == '19'){
                    $moempresas = new Model_Empresas();
                    $moempresas->guardarubroinsumos($_POST['ide']);
                }
                
                
            }
            $this->template->title.='Materiales Requeridos';
            $this->template->descripcion = '';
            $user = $this->user;
            $idu = $this->user->id;
            
            /*$oMateriales = ORM::factory('materialesrequeridos')
                           ->order_by('orden', 'ASC') 
                           ->find_all();*/
            $oDepartamentos = ORM::factory('departamentos')
                           ->find_all();
            $departamentos = array();
            foreach ($oDepartamentos as $d) {
            $departamentos[$d->id] = $d->departamento;
            }
            
            $oMunicipios = ORM::factory('municipios')
                           ->order_by('municipio', 'asc')
                           ->find_all();
            $municipios = array();
            foreach ($oMunicipios as $d) {
            $municipios[$d->id] = $d->municipio;
            }
            
            
            
            $oProvMateriales = new Model_Proveedormateriales();
            if($resultDatos['tipo'] == '9'){
                $oMateriales = $oProvMateriales->listarmaterialesproveedor($resultDatos['id']);
            }elseif ($resultDatos['tipo'] == '19') {
                $oMateriales = $oProvMateriales->listarinsumosproveedor($resultDatos['id']);
            }
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('ide',$resultDatos['id'])
                                       ->bind('materiales',$oMateriales)
                                       ->bind('departamentos',$departamentos)
                                       ->bind('municipios',$municipios)
                                       ->bind('idu', $idu);
        }
        
        
        public function action_genregistroproveedor(){
            $vista = 'proveedores/generar_registro';
            if(isset($_POST['submit']) and $_POST['submit'] == "Generar e Imprimir Registro"){
                $idempresa = $_POST['ide'];
                $estadoempresa = $_POST['estado'];
                //verificadatos
                $oEmpresas = new Model_Empresas();
                $res = $oEmpresas->verificadatos($idempresa);
                if($res != 'ok'){
                    echo '<script>alert("Verifique sus Datos Generales.")</script>';
                }else{
                    //verificaexp
                    $oexperiencia = new Model_Proveedormateriales();
                    $res1 = $oexperiencia->verificamat($idempresa);
                    if($res1 != 'ok'){
                        echo '<script>alert("Deberia tener al menos un registro de Materiales a Proveer.")</script>';
                    }else{
                        //verificadepinteres
                        $odeptosinteres = new Model_Departamentosinteres();
                        $res2 = $odeptosinteres->verificadint($idempresa);
                        if($res2 != 'ok'){
                            echo '<script>alert("Deberia tener al menos un Departamento de interes seleccionado.")</script>';    
                        }else{
                            if($estadoempresa == 4){
                              //echo '<script>alert("Usted esta generando el certificado nuevamente, necesita dirigirse a la departamental para ser Habilitado.")</script>';  
                            }
                            //genera registro
                            $pin = 100000+$idempresa;
                            $empresapin = ORM::factory('empresas',$idempresa);
                            $empresapin->pin_empresa = $pin;
                            $empresapin->estado = "3";
                            $empresapin->save();
                            //$oEmpresas1 = new Model_Empresas();
                            //$re=$oEmpresas1->generapin($idempresa);
                            //echo '<script>alert("GENERA!!!!!")</script>';    
                            //echo '<script>location.href = "/reporte2.php/?ide="+'.$idempresa.';</script>';
                            $this->guardarconfirmacionproveedorextra($idempresa);    
                            $this->request->redirect('reporte_prov.php?ide='.$idempresa); 
                        }
                    }
                }
                
                
            }
            $this->template->title.='Generar e imprimir Registro';
            $this->template->descripcion = '';
            $this->template->styles = array(
                'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
                'media/jqwidgets/styles/jqx.office.css' => 'all',
                'media/jqwidgets/styles/jqx.base.css' => 'all',
            );
            $user = $this->user;
            $idu = $this->user->id;
            $oEmpresas = new Model_Empresas();
            $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
            $resultDatos=$resultDatos[0];
            $this->template->content = View::factory($vista)
                                       ->bind('user', $user)
                                       ->bind('ide',$resultDatos['id'])
                                       ->bind('estado',$resultDatos['estado'])
                                       ->bind('idu', $idu);
        }
        /*fin proveeedores*/
    public function action_eliexperiencia($id){
        
            $experienciaentidad=ORM::factory('experienciaentidad',$id);
            $experienciaentidad->delete();
            $this->request->redirect('/seguimiento/experiencia');
        
    }
    
    public function action_socios(){
        
        
        if (isset($_POST['ide'])) {
            $socios= ORM::factory('sociosaccidental');
            $socios->id_empresa_acc = $_POST['ide'];
            $socios->id_empresa_socios = $_POST['ides'];
             if (isset($_POST['lider'])) {
             $sociosacc = new Model_Sociosaccidental();
             $sociosacc->resetlider($_POST['ide']);
             $socios->lider = $_POST['lider'];
             }else{
             $socios->lider = 'No';
             }
            //
            
            $socios->porcentaje_participacion = $_POST['porcentaje_participacion'];
            $socios->save();
        } 

        $vista = 'empresas/lista_socios';
        $this->template->title.='Socios';
        $this->template->titulo='Lista de Socios';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        $this->template->scripts = array(
            'media/jqwidgets/globalization/globalize.js',
            'media/jqwidgets/jqxcalendar.js',
            'media/jqwidgets/jqxdatetimeinput.js',
            'media/jqwidgets/jqxwindow.js',
            'media/jqwidgets/scripts/gettheme.js',
            'media/jqwidgets/jqxnumberinput.js',
            'media/jqwidgets/jqxgrid.aggregates.js',
            'media/jqwidgets/jqxgrid.columnsresize.js',
            'media/jqwidgets/jqxgrid.columnsreorder.js',
            'media/jqwidgets/jqxdata.export.js',
            'media/jqwidgets/jqxgrid.export.js',
            'media/jqwidgets/jqxgrid.edit.js',
            'media/jqwidgets/jqxgrid.grouping.js',
            'media/jqwidgets/jqxgrid.selection.js',
            'media/jqwidgets/jqxgrid.filter.js',
            'media/jqwidgets/jqxgrid.pager.js',
            'media/jqwidgets/jqxgrid.sort.js',
            'media/jqwidgets/jqxdata.js',
            'media/jqwidgets/jqxgrid.js',
            'media/jqwidgets/jqxdropdownlist.js',
            'media/jqwidgets/jqxlistbox.js',
            'media/jqwidgets/jqxcheckbox.js',
            'media/jqwidgets/jqxmenu.js',
            'media/jqwidgets/jqxscrollbar.js',
            'media/jqwidgets/jqxbuttons.js',
            'media/jqwidgets/jqxcore.js',
            'media/js/jquery.number.min.js',
            

        );
        $user = $this->user;
        $idu = $this->user->id;
        $oEmpresas = new Model_Empresas();
        $resultDatos = $oEmpresas->datosempresacuenta($this->user->username);
        $resultDatos=$resultDatos[0];
        $this->template->content = View::factory($vista)
                                   ->bind('user', $user)
                                   ->bind('idu', $idu)
                                   ->bind('ide',$resultDatos['id']);
    }
    
    public function action_elisocios($id){
        
            $sociosaccidental=ORM::factory('sociosaccidental',$id);
            $sociosaccidental->delete();
            $this->request->redirect('/seguimiento/socios');
        
    }
    protected function parse_number($number, $dec_point = null) {
        if (empty($dec_point)) {
            $locale = localeconv();
            $dec_point = $locale['decimal_point'];
        }
        return floatval(str_replace($dec_point, '.', preg_replace('/[^\d' . preg_quote($dec_point) . ']/', '', $number)));
    }
    public function guardarconfirmacionextra($id) {
        $ide = $id;
        //$session = Session::instance();
        //$user = $session->get('auth_user');
        $user = 564;
        $empresas = ORM::factory('empresas',$ide);
        //$empresas->estado = $_POST['estado'];
        $empresas->estado = 4;
        $empresas->save();
        $verifica = ORM::factory('verificaobservaciones',$ide);
        $verifica->id_empresa = $ide;
        $verifica->id_user = $user;
        //$verifica->observacion = $_POST['obs'];
        $verifica->observacion = "Automatica al generar certificado";
        $verifica->fecha_registro = date('Y-m-d H:m:i');
        $verifica->id_clasificacion = 1;
        $verifica->save();
        $ranking = new Controller_Rankingempresas();
        $ranking->calificacionautomatica($ide,$user,"4");
        
 }
 public function guardarconfirmacionproveedorextra($id) {
        $ide = $id;
        //$session = Session::instance();
        //$user = $session->get('auth_user');
        $user = 564;
        $empresas = ORM::factory('empresas',$ide);
        //$empresas->estado = $_POST['estado'];
        $empresas->estado = 4;
        $empresas->save();
        $verifica = ORM::factory('verificaobservaciones',$ide);
        $verifica->id_empresa = $ide;
        $verifica->id_user = $user;
        //$verifica->observacion = $_POST['obs'];
        $verifica->observacion = "Automatica al generar certificado";
        $verifica->fecha_registro = date('Y-m-d H:m:i');
        $verifica->id_clasificacion = 2;
        $verifica->save();
        
 }
  
  public function guardarconfirmacionconsultorextra($id) {
        $ide = $id;
        $session = Session::instance();
        //$user = $session->get('auth_user');
        $user = 564;
        $empresas = ORM::factory('consultores',$ide);
        //$empresas->estado = $_POST['estado'];
        $empresas->estado = 4;
        //$desembolsos->fecha_registro = date('Y-m-d H:m:i');
        $empresas->save();
        
        $verifica = ORM::factory('verificaobservaciones',$ide);
        $verifica->id_empresa = $ide;
        $verifica->id_user = $user;
        //$verifica->observacion = $_POST['obs'];
        $verifica->observacion = "Automatica al generar certificado";
        $verifica->fecha_registro = date('Y-m-d H:m:i');
        $verifica->id_clasificacion = 3;
        $verifica->save();
        $ranking = new Controller_Rankingconsultor();
        $ranking->calificacionautomatica1($ide,$user,"4");
    
 }
  
}
/**
 * Función que devuelve un numero en palabras.
 */

?>
