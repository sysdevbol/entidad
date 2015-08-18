<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_ajax extends Controller {        
    public function action_addUser()
    {
        $id_user=$_POST['id'];        
        $destinos=explode(';',$_POST['destinos']);
        foreach($destinos as $k=>$v)
        {
            if($v!='')
            {
                $destino=ORM::factory('destinatarios');
                $destino->id_usuario=$id_user;
                $destino->id_destino=$v;
                $destino->save();
            }
        }
    }
    public function action_addDoc()
    {
        $id_user=$_POST['id'];        
        $documentos=explode(';',$_POST['documentos']);
        foreach($documentos as $k=>$v)
        {
            if($v!='')
            {
                $user=ORM::factory('users',$id_user);
                $user->add('tipo',$v);                
                $user->save();  
            }
        }
    }
    public function action_listareplicas() {
        $proyectos = new Model_Replicas();
        $result = $proyectos->listareplicas();
        echo json_encode($result);
    
    }
    public function action_datoscontrato() {
        $Ames= array('JAN'=>01,
                    'FEB'=>02,
                    'MAR'=>03,
                    'APR'=>04,
                    'MAY'=>05,
                    'JUN'=>06,
                    'JUL'=>07,
                    'AUG'=>08,
                    'SEP'=>09,
                    'OCT'=>10,
                    'NOV'=>11,
                    'DEC'=>12);
        $oDatossap = New Model_Replicas();
        $fechahora = $oDatossap->fechahora();
        $fechahora = $fechahora[0];
        $stid = $oDatossap->replicadatoscontrato();
        oci_execute($stid, OCI_DEFAULT);
        if ($stid) {
        $Tstid = $oDatossap->truncartabladatoscontrato();
        if($Tstid==0){
            $i=0;
            while ($row = oci_fetch_array($stid,  OCI_ASSOC)) {
                    $proyect = ORM::factory('datoscontrato');
                    $proyect->proy_cod = $row['PROY_COD'];      
                    $proyect->plie_cod = $row['PLIE_COD'];
                    $proyect->cont_cod = $row['CONT_COD'];
                    $proyect->depa_des = $row['DEPA_DES'];
                    $proyect->cont_montobs = utf8_decode($row['CONT_MONTOBS']);
                    $proyect->montocontrato = $row['MONTOCONTRATO'];
                    $proyect->cont_des = $row['CONT_DES'];
                    $proyect->inst_cod = $row['INST_COD'];
                    $proyect->inst_des = $row['INST_DES'];
                    switch($row['PROY_COD']){
                        //cochabamba
                        case "AEV-11-00000058":
                        $uhm = 48;
                        break;
                        case "AEV-11-00000096":
                        $uhm = 80;
                        break;
                        case "AEV-11-00000130":
                        $uhm = 80;
                        break;
                        case "AEV-11-00000132":
                        $uhm = 48;
                        break;
                        //la paz
                        case "AEV-11-00000051":
                        $uhm = 48;
                        break;
                        case "AEV-11-00000052":
                        $uhm = 48;
                        break;
                        case "AEV-11-00000053":
                        $uhm = 48;
                        break;
                        case "AEV-11-00000054":
                        $uhm = 48;
                        break;
                        case "AEV-11-00000055":
                        $uhm = 48;
                        break;
                        case "AEV-11-00000056":
                        $uhm = 48;
                        break;
                        case "AEV-11-00000057":
                        $uhm = 48;
                        break;
                        case "AEV-11-00000065":
                        $uhm = 103;
                        break;
                        case "AEV-11-00000069":
                        $uhm = 60;
                        break;
                        case "AEV-11-00000111":
                        $uhm = 48;
                        break;
                        //otro
                        default:
                        $uhm = $row['PRMO_CANT'];
                    }
                    
                    //$proyect->prmo_cant = $row['PRMO_CANT'];
                    $proyect->prmo_cant = $uhm;
                    $proyect->comp_cod = $row['COMP_COD'];
                    $proyect->inst_contac = $row['INST_CONTAC'];
                    list ( $dia, $mes, $anio ) = explode ( "-",$row['BOLE_FECHAV'] );
                    $fechaBOL = $anio . "-" . $Ames[$mes] . "-" . $dia; 
                    $proyect->bole_fechav = $fechaBOL; 
                    $proyect->dias = $row['DIAS'];
                    $proyect->save();
                    $i++;
                    //echo $fechaBOL."-".$row['BOLE_FECHAV']."\n";
            }
                $replica = ORM::factory('replicas');
                $replica->fecha_replica = $fechahora['fechaactu'];
                $replica->tabla = 'DATOSCONTRATO';
                $replica->cant_reg = $i;
                $replica->mensaje = 'La Replica se realizo con Exito';
                $replica->save();
                echo 1;
                
        }else{
            $replica = ORM::factory('replicas');
            $replica->fecha_replica = $fechahora['fechaactu'];
            $replica->tabla = 'DATOSCONTRATO';
            $replica->cant_reg = 0;
            $replica->mensaje = 'No se Trunco la tabla';
            $replica->save();
            echo 2;
        }        
                
        }else{
          $replica = ORM::factory('replicas');
          $replica->fecha_replica = $fechahora['fechaactu'];
          $replica->tabla = 'DATOSCONTRATO';
          $replica->cant_reg = 0;
          $replica->mensaje = 'ERROR en la Replica';
          $replica->save();
          echo 0; 
           
        }
    }
    public function action_planillasporcontrato() {
        $oDatossap = New Model_Replicas();
        $fechahora = $oDatossap->fechahora();
        $fechahora = $fechahora[0];
        $stid = $oDatossap->replicaplanillasporcontrato();
        oci_execute($stid, OCI_DEFAULT);
        if ($stid) {
        $Tstid = $oDatossap->truncartablaplanillasporcontrato();
        if($Tstid==0){
            $i=0;
            while ($row = oci_fetch_array($stid,  OCI_ASSOC)) {
                    
                    $proyect = ORM::factory('planillasporcontrato');
                    $proyect->id_sap = $row['ID']; 
                    $proyect->proy_cod = $row['PROY_COD']; 
                    $proyect->proy_des = $row['PROY_DES']; 
                    $proyect->cont = $row['CONT']; 
                    $proyect->comp_cod = $row['COMP_COD']; 
                    $proyect->ploc_des = $row['PLOC_DES']; 
                    $proyect->retencion_anticipo = $row['RETENCION_ANTICIPO']; 
                    $proyect->desembolso = $row['DESEMBOLSO']; 
                    $proyect->modificatorio = $row['MODIFICATORIO']; 
                    $proyect->multas = $row['MULTAS']; 
                    $proyect->planillado = $row['PLANILLADO']; 
                    $proyect->titr_cod = $row['TITR_COD']; 
                    $proyect->ploc_cod = $row['PLOC_COD']; 
                    $proyect->orden = $row['ORDEN'];
                    $proyect->save();
                    $i++;
            }
                $replica = ORM::factory('replicas');
                $replica->fecha_replica = $fechahora['fechaactu'];
                $replica->tabla = 'PLANILLASPORCONTRATO';
                $replica->cant_reg = $i;
                $replica->mensaje = 'La Replica se realizo con Exito';
                $replica->save();
                echo 1;
        }else{
            $replica = ORM::factory('replicas');
            $replica->fecha_replica = $fechahora['fechaactu'];
            $replica->tabla = 'PLANILLASPORCONTRATO';
            $replica->cant_reg = 0;
            $replica->mensaje = 'No se Trunco la tabla';
            $replica->save();
            echo 2;
        }        
                
        }else{
          $replica = ORM::factory('replicas');
          $replica->fecha_replica = $fechahora['fechaactu'];
          $replica->tabla = 'PLANILLASPORCONTRATO';
          $replica->cant_reg = 0;
          $replica->mensaje = 'ERROR en la Replica';
          $replica->save();
          echo 0; 
           
        }
    }
    
    public function action_proyectosexcel() {
        $oDatossap = New Model_Replicas();
        $fechahora = $oDatossap->fechahora();
        $fechahora = $fechahora[0];
        $stid = $oDatossap->replicaproyectosexcel();
        if ($stid) {
        $Tstid = $oDatossap->truncartablaproyectosexcel();
        if($Tstid==0){
            $i=0;
            while ($row = $stid->fetch(PDO::FETCH_ASSOC)) { 
                    $proyect = ORM::factory('proyectosexcel');
                    $proyect->id= $row['id']; 
                    $proyect->num= $row['num']; 
                    $proyect->departamento= $row['departamento']; 
                    $proyect->provincia= $row['provincia']; 
                    $proyect->seccion= $row['seccion']; 
                    $proyect->codigo_mun= $row['codigo_mun']; 
                    $proyect->codigo_sap= $row['codigo_sap']; 
                    $proyect->proyecto_nombre= $row['proyecto_nombre']; 
                    $proyect->municipio= $row['municipio']; 
                    $proyect->comunidades= $row['comunidades']; 
                    
                    
                    $proyect->latitud= $row['latitud']; 
                    $proyect->longitud= $row['longitud']; 
                    $proyect->idTipo= $row['idTipo']; 
                    $proyect->proyecto_tipo_H= $row['proyecto_tipo_H']; 
                    $proyect->modalidad= $row['modalidad']; 
                    $proyect->gestion_licitacion= $row['gestion_licitacion']; 
                    $proyect->gestion_licitacion2= $row['gestion_licitacion2']; 
                    $proyect->plan_plurianual= $row['plan_plurianual']; 
                    $proyect->uh_programado= $row['uh_programado']; 
                    $proyect->uh_techo= $row['uh_techo']; 
                    $proyect->uh_proy= $row['uh_proy']; 
                    $proyect->uh_ejecucion= $row['uh_ejecucion']; 
                    $proyect->grupo= $row['grupo']; 
                    $proyect->estado= $row['estado']; 
                    $proyect->actividad= $row['actividad']; 
                    $proyect->gestion= $row['gestion']; 
                    $proyect->estado_act= $row['estado_act']; 
                    $proyect->prioridad_tipo= $row['prioridad_tipo']; 
                    $proyect->uh_subsidio= $row['uh_subsidio']; 
                    $proyect->uh_credito= $row['uh_credito']; 
                    $proyect->monto_subsidio= $row['monto_subsidio']; 
                    $proyect->monto_credito= $row['monto_credito']; 
                    $proyect->monto_cont_modificatorio= $row['monto_cont_modificatorio']; 
                    $proyect->costo_proyecto= $row['costo_proyecto']; 
                    $proyect->monto_con_aev= $row['monto_con_aev']; 
                    $proyect->por_con_benef= $row['por_con_benef']; 
                    $proyect->monto_con_benef= $row['monto_con_benef']; 
                    $proyect->por_con_mun_prop= $row['por_con_mun_prop']; 
                    $proyect->estado_concurrencia= $row['estado_concurrencia']; 
                    $proyect->por_con_mun_ejectivo= $row['por_con_mun_ejectivo']; 
                    $proyect->monto_con_muni= $row['monto_con_muni']; 
                    $proyect->por_con_sectorial= $row['por_con_sectorial']; 
                    $proyect->monto_con_sectorial= $row['monto_con_sectorial']; 
                    $proyect->por_con_dep= $row['por_con_dep']; 
                    $proyect->monto_con_dep= $row['monto_con_dep']; 
                    $proyect->monto_total_concurrencia= $row['monto_total_concurrencia']; 
                    $proyect->monto_sup_aev= $row['monto_sup_aev']; 
                    $proyect->monto_fin_aev= $row['monto_fin_aev']; 
                    $proyect->monto_total_proyecto= $row['monto_total_proyecto']; 
                    $proyect->fecha_contacto= $row['fecha_contacto']; 
                    $proyect->fecha_entrega_form= $row['fecha_entrega_form']; 
                    $proyect->fecha_dev_lista_form= $row['fecha_dev_lista_form']; 
                    $proyect->fecha_informe_social= $row['fecha_informe_social']; 
                    $proyect->responsable_social= $row['responsable_social']; 
                    $proyect->fecha_socializacion= $row['fecha_socializacion']; 
                    $proyect->fecha_anteproyecto= $row['fecha_anteproyecto']; 
                    $proyect->fecha_recepcion_lista= $row['fecha_recepcion_lista']; 
                    $proyect->fecha_entrega_proyecto= $row['fecha_entrega_proyecto']; 
                    $proyect->fecha_entrega_tdr= $row['fecha_entrega_tdr']; 
                    $proyect->responsable_proyectos= $row['responsable_proyectos']; 
                    $proyect->nro_acta_comite= $row['nro_acta_comite']; 
                    $proyect->fecha_acta_comite= $row['fecha_acta_comite']; 
                    $proyect->comite_planificacion= $row['comite_planificacion']; 
                    $proyect->comite_fiscalizacion= $row['comite_fiscalizacion']; 
                    $proyect->comite_administrativo= $row['comite_administrativo']; 
                    $proyect->certificacion_poa= $row['certificacion_poa']; 
                    $proyect->certificacion_presupuestaria= $row['certificacion_presupuestaria']; 
                    $proyect->cuce_proyecto= $row['cuce_proyecto']; 
                    $proyect->inicio_lic1= $row['inicio_lic1']; 
                    $proyect->fin_lic1= $row['fin_lic1']; 
                    $proyect->inicio_lic2= $row['inicio_lic2']; 
                    $proyect->fin_lic2= $row['fin_lic2']; 
                    $proyect->inicio_lic3= $row['inicio_lic3']; 
                    $proyect->fin_lic3= $row['fin_lic3']; 
                    $proyect->fecha_inv_excepcion= $row['fecha_inv_excepcion']; 
                    $proyect->fecha_pres_propuesta= $row['fecha_pres_propuesta']; 
                    $proyect->fecha_adj_empresa= $row['fecha_adj_empresa']; 
                    $proyect->fecha_pres_documentos= $row['fecha_pres_documentos']; 
                    $proyect->fecha_ext_plazo1= $row['fecha_ext_plazo1']; 
                    $proyect->fecha_ext_plazo2= $row['fecha_ext_plazo2']; 
                    $proyect->fecha_ext_plazo3= $row['fecha_ext_plazo3']; 
                    $proyect->fecha_ext_plazo4= $row['fecha_ext_plazo4']; 
                    $proyect->fecha_ext_plazo5= $row['fecha_ext_plazo5']; 
                    $proyect->fecha_ext_plazo6= $row['fecha_ext_plazo6']; 
                    $proyect->fecha_ext_plazo7= $row['fecha_ext_plazo7']; 
                    $proyect->fecha_ext_plazo8= $row['fecha_ext_plazo8']; 
                    $proyect->firma_contrato_sicoes= $row['firma_contrato_sicoes']; 
                    $proyect->nro_res_adjudicaicon= $row['nro_res_adjudicaicon']; 
                    $proyect->fecha_res_adjudicacion= $row['fecha_res_adjudicacion']; 
                    $proyect->nro_contrato= $row['nro_contrato']; 
                    $proyect->fecha_contrato= $row['fecha_contrato']; 
                    $proyect->empresa_adjudicada= $row['empresa_adjudicada']; 
                    $proyect->fecha_sol_con_sup= $row['fecha_sol_con_sup']; 
                    $proyect->cuce_sup= $row['cuce_sup']; 
                    $proyect->inicio_sup_lic1= $row['inicio_sup_lic1']; 
                    $proyect->fin_sup_lic1= $row['fin_sup_lic1']; 
                    $proyect->inicio_sup_lic2= $row['inicio_sup_lic2']; 
                    $proyect->fin_sup_lic2= $row['fin_sup_lic2']; 
                    $proyect->fecha_inv_con_sup= $row['fecha_inv_con_sup']; 
                    $proyect->fecha_con_prop_sup= $row['fecha_con_prop_sup']; 
                    $proyect->fecha_adjudicacion_sup= $row['fecha_adjudicacion_sup']; 
                    $proyect->fecha_firma_contrato_sup= $row['fecha_firma_contrato_sup']; 
                    $proyect->nro_res1_des_sup= $row['nro_res1_des_sup']; 
                    $proyect->nro_res_adj_sup= $row['nro_res_adj_sup']; 
                    $proyect->fecha_res_adj_sup= $row['fecha_res_adj_sup']; 
                    $proyect->nro_contrato_sup= $row['nro_contrato_sup']; 
                    $proyect->fecha_contrato_sup= $row['fecha_contrato_sup']; 
                    $proyect->monto_contrato_sup= $row['monto_contrato_sup']; 
                    $proyect->ejecutado_planilla1_sup= $row['ejecutado_planilla1_sup']; 
                    $proyect->fecha_eje1_sup= $row['fecha_eje1_sup']; 
                    $proyect->informe_eje1_sup= $row['informe_eje1_sup']; 
                    $proyect->fecha_informe_eje1_sup= $row['fecha_informe_eje1_sup']; 
                    $proyect->ejecutado_planilla2_sup= $row['ejecutado_planilla2_sup']; 
                    $proyect->fecha_eje2_sup= $row['fecha_eje2_sup']; 
                    $proyect->informe_eje2_sup= $row['informe_eje2_sup']; 
                    $proyect->fecha_informe_eje2_sup= $row['fecha_informe_eje2_sup']; 
                    $proyect->ejecutado_planilla3_sup= $row['ejecutado_planilla3_sup']; 
                    $proyect->fecha_eje3_sup= $row['fecha_eje3_sup']; 
                    $proyect->informe_eje3_sup= $row['informe_eje3_sup']; 
                    $proyect->fecha_informe_eje3_sup= $row['fecha_informe_eje3_sup']; 
                    $proyect->ejecutado_planilla4_sup= $row['ejecutado_planilla4_sup']; 
                    $proyect->fecha_eje4_sup= $row['fecha_eje4_sup']; 
                    $proyect->informe_eje4_sup= $row['informe_eje4_sup']; 
                    $proyect->fecha_informe_eje4_sup= $row['fecha_informe_eje4_sup']; 
                    $proyect->ejecutado_planilla5_sup= $row['ejecutado_planilla5_sup']; 
                    $proyect->fecha_eje5_sup= $row['fecha_eje5_sup']; 
                    $proyect->informe_eje5_sup= $row['informe_eje5_sup']; 
                    $proyect->fecha_informe_eje5_sup= $row['fecha_informe_eje5_sup']; 
                    $proyect->ejecutado_planilla6_sup= $row['ejecutado_planilla6_sup']; 
                    $proyect->fecha_eje6_sup= $row['fecha_eje6_sup']; 
                    $proyect->informe_eje6_sup= $row['informe_eje6_sup']; 
                    $proyect->fecha_informe_eje6_sup= $row['fecha_informe_eje6_sup']; 
                    $proyect->avance_financiero= $row['avance_financiero']; 
                    $proyect->empresa_sup= $row['empresa_sup']; 
                    $proyect->nombre_sup= $row['nombre_sup']; 
                    $proyect->telefono_sup= $row['telefono_sup']; 
                    $proyect->direccion_sup= $row['direccion_sup']; 
                    $proyect->correo_sup= $row['correo_sup']; 
                    $proyect->fecha_orden_proceder= $row['fecha_orden_proceder']; 
                    $proyect->plazo_ejecucion= $row['plazo_ejecucion']; 
                    $proyect->retraso_dias= $row['retraso_dias']; 
                    $proyect->fecha_entrega_provisional= $row['fecha_entrega_provisional']; 
                    $proyect->fecha_ent_prov= $row['fecha_ent_prov']; 
                    $proyect->avance_fisico_obra= $row['avance_fisico_obra']; 
                    $proyect->avance_financiero_obra= $row['avance_financiero_obra']; 
                    $proyect->monto_planilla_anticipo= $row['monto_planilla_anticipo']; 
                    $proyect->fecha_anticipo= $row['fecha_anticipo']; 
                    $proyect->informe_anticipo= $row['informe_anticipo']; 
                    $proyect->fecha_informe_anticipo= $row['fecha_informe_anticipo']; 
                    $proyect->monto_planilla1= $row['monto_planilla1']; 
                    $proyect->fecha_planilla1= $row['fecha_planilla1']; 
                    $proyect->informe_planilla1= $row['informe_planilla1']; 
                    $proyect->fecha_informe_planilla1= $row['fecha_informe_planilla1']; 
                    $proyect->monto_planilla2= $row['monto_planilla2']; 
                    $proyect->fecha_planilla2= $row['fecha_planilla2']; 
                    $proyect->informe_planilla2= $row['informe_planilla2']; 
                    $proyect->fecha_informe_planilla2= $row['fecha_informe_planilla2']; 
                    $proyect->monto_planilla3= $row['monto_planilla3']; 
                    $proyect->fecha_planilla3= $row['fecha_planilla3']; 
                    $proyect->informe_planilla3= $row['informe_planilla3']; 
                    $proyect->fecha_informe_planilla3= $row['fecha_informe_planilla3']; 
                    $proyect->monto_planilla4= $row['monto_planilla4']; 
                    $proyect->fecha_planilla4= $row['fecha_planilla4']; 
                    $proyect->informe_planilla4= $row['informe_planilla4']; 
                    $proyect->fecha_informe_planilla4= $row['fecha_informe_planilla4']; 
                    $proyect->monto_planilla5= $row['monto_planilla5']; 
                    $proyect->fecha_planilla5= $row['fecha_planilla5']; 
                    $proyect->informe_planilla5= $row['informe_planilla5']; 
                    $proyect->fecha_informe_planilla5= $row['fecha_informe_planilla5']; 
                    $proyect->monto_planilla6= $row['monto_planilla6']; 
                    $proyect->fecha_planilla6= $row['fecha_planilla6']; 
                    $proyect->informe_planilla6= $row['informe_planilla6']; 
                    $proyect->fecha_informe_planilla6= $row['fecha_informe_planilla6']; 
                    $proyect->pueblo_indigena= $row['pueblo_indigena']; 
                    $proyect->prog_mopsv= $row['prog_mopsv']; 
                    $proyect->linea_fisica2013= $row['linea_fisica2013']; 
                    $proyect->linea_financiera2013= $row['linea_financiera2013']; 
                    /*$proyect->programado_mes1= $row['programado_mes1']; 
                    $proyect->ejecutado_mes1= $row['ejecutado_mes1']; 
                    $proyect->avance_fisico_mes1= $row['avance_fisico_mes1']; 
                    $proyect->avance_financiero_mes1= $row['avance_financiero_mes1']; 
                    $proyect->programado_mes2= $row['programado_mes2']; 
                    $proyect->ejecutado_mes2= $row['ejecutado_mes2']; 
                    $proyect->avance_fisico_mes2= $row['avance_fisico_mes2']; 
                    $proyect->avance_financiero_mes2= $row['avance_financiero_mes2']; 
                    $proyect->programado_mes3= $row['programado_mes3']; 
                    $proyect->ejecutado_mes3= $row['ejecutado_mes3']; 
                    $proyect->avance_fisico_mes3= $row['avance_fisico_mes3']; 
                    $proyect->avance_financiero_mes3= $row['avance_financiero_mes3']; 
                    $proyect->programado_mes4= $row['programado_mes4']; 
                    $proyect->ejecutado_mes4= $row['ejecutado_mes4']; 
                    $proyect->avance_fisico_mes4= $row['avance_fisico_mes4']; 
                    $proyect->avance_financiero_mes4= $row['avance_financiero_mes4']; 
                    //$proyect->programado_mes5= $row['programado_mes5']; 
                    //$proyect->ejecutado_mes5= $row['ejecutado_mes5']; 
                    //$proyect->avance_fisico_mes5= $row['avance_fisico_mes5']; 
                    //$proyect->avance_financiero_mes5= $row['avance_financiero_mes5']; 
                    $proyect->programado_mes6= $row['programado_mes6']; 
                    $proyect->ejecutado_mes6= $row['ejecutado_mes6']; 
                    $proyect->avance_fisico_mes6= $row['avance_fisico_mes6']; 
                    $proyect->avance_financiero_mes6= $row['avance_financiero_mes6']; 
                    $proyect->programado_mes7= $row['programado_mes7']; 
                    $proyect->ejecutado_mes7= $row['ejecutado_mes7']; 
                    $proyect->avance_fisico_mes7= $row['avance_fisico_mes7']; 
                    $proyect->avance_financiero_mes7= $row['avance_financiero_mes7']; 
                    $proyect->programado_mes8= $row['programado_mes8']; 
                    $proyect->ejecutado_mes8= $row['ejecutado_mes8']; 
                    $proyect->avance_fisico_mes8= $row['avance_fisico_mes8']; 
                    $proyect->avance_financiero_mes8= $row['avance_financiero_mes8']; 
                    $proyect->programado_mes9= $row['programado_mes9']; 
                    $proyect->ejecutado_mes9= $row['ejecutado_mes9']; 
                    $proyect->avance_fisico_mes9= $row['avance_fisico_mes9']; 
                    $proyect->avance_financiero_mes9= $row['avance_financiero_mes9']; 
                    $proyect->programado_mes10= $row['programado_mes10']; 
                    $proyect->ejecutado_mes10= $row['ejecutado_mes10']; 
                    $proyect->avance_fisico_mes10= $row['avance_fisico_mes10']; 
                    $proyect->avance_financiero_mes10= $row['avance_financiero_mes10']; 
                    $proyect->programado_mes11= $row['programado_mes11']; 
                    $proyect->ejecutado_mes11= $row['ejecutado_mes11']; 
                    $proyect->avance_fisico_mes11= $row['avance_fisico_mes11']; 
                    $proyect->avance_financiero_mes11= $row['avance_financiero_mes11']; 
                    $proyect->programado_mes12= $row['programado_mes12']; 
                    $proyect->ejecutado_mes12= $row['ejecutado_mes12']; 
                    $proyect->avance_fisico_mes12= $row['avance_fisico_mes12']; 
                    $proyect->avance_financiero_mes12= $row['avance_financiero_mes12']; */
                    //$proyect->prog_eval_beneficiario= $row['prog_eval_beneficiario']; 
                    //$proyect->reprog_eval_beneficiarios= $row['reprog_eval_beneficiarios']; 
                    //$proyect->reprog_eval_beneficiarios= $row['reprog_eval_beneficiarios']; 
                    //$proyect->prog_comite_aprobacion= $row['prog_comite_aprobacion']; 
                    //$proyect->prog_licitacion= $row['prog_licitacion']; 
                    //$proyect->prog_firma_contrato= $row['prog_firma_contrato']; 
                    //$proyect->prog_orden_proceder= $row['prog_orden_proceder']; 
                    //$proyect->prog_plazo_ejecucion= $row['prog_plazo_ejecucion']; 
                    //$proyect->prog_entrega_provisional= $row['prog_entrega_provisional']; 
                    //$proyect->tiempo_prev_entrega= $row['tiempo_prev_entrega']; 
                    //$proyect->reprog_entrega_provisional= $row['reprog_entrega_provisional']; 
                    //$proyect->alerta= $row['alerta']; 
                    //$proyect->prog_entrega_mes3= $row['prog_entrega_mes3']; 
                    //$proyect->prog_entrega_mes4= $row['prog_entrega_mes4']; 
                    //$proyect->prog_entrega_mes5= $row['prog_entrega_mes5']; 
                    //$proyect->prog_entrega_mes6= $row['prog_entrega_mes6']; 
                    //$proyect->prog_entrega_mes7= $row['prog_entrega_mes7']; 
                    //$proyect->prog_entrega_mes8= $row['prog_entrega_mes8']; 
                    //$proyect->prog_entrega_mes9= $row['prog_entrega_mes9']; 
                    //$proyect->prog_entrega_mes10= $row['prog_entrega_mes10']; 
                    //$proyect->prog_entrega_mes11= $row['prog_entrega_mes11']; 
                    //$proyect->prog_entrega_mes12= $row['prog_entrega_mes12']; 
                    //$proyect->total_entrega= $row['total_entrega']; 
                    //$proyect->prog_entrega_mes2= $row['prog_entrega_mes2']; 
                    //$proyect->prog_entrega_mes1= $row['prog_entrega_mes1']; 
                    //$proyect->reprog_entrega_viviendas= $row['reprog_entrega_viviendas']; 
                    //$proyect->desembolso_sup_mes1= $row['desembolso_sup_mes1']; 
                    //$proyect->desembolso_sup_mes2= $row['desembolso_sup_mes2']; 
                    //$proyect->desembolso_sup_mes3= $row['desembolso_sup_mes3']; 
                    //$proyect->desembolso_sup_mes4= $row['desembolso_sup_mes4']; 
                    //$proyect->desembolso_sup_mes5= $row['desembolso_sup_mes5']; 
                    //$proyect->desembolso_sup_mes6= $row['desembolso_sup_mes6']; 
                    //$proyect->desembolso_sup_mes7= $row['desembolso_sup_mes7']; 
                    //$proyect->desembolso_sup_mes8= $row['desembolso_sup_mes8']; 
                    //$proyect->desembolso_sup_mes9= $row['desembolso_sup_mes9']; 
                    //$proyect->desembolso_sup_mes10= $row['desembolso_sup_mes10']; 
                    //$proyect->desembolso_sup_mes11= $row['desembolso_sup_mes11']; 
                    //$proyect->desembolso_sup_mes12= $row['desembolso_sup_mes12']; 
                    //$proyect->reprogramacion_mes1= $row['reprogramacion_mes1']; 
                    //$proyect->reprogramacion_mes2= $row['reprogramacion_mes2']; 
                    //$proyect->reprogramacion_mes3= $row['reprogramacion_mes3']; 
                    //$proyect->reprogramacion_mes4= $row['reprogramacion_mes4']; 
                    //$proyect->reprogramacion_mes5= $row['reprogramacion_mes5']; 
                    //$proyect->reprogramacion_mes6= $row['reprogramacion_mes6']; 
                    //$proyect->reprogramacion_mes7= $row['reprogramacion_mes7']; 
                    //$proyect->reprogramacion_mes8= $row['reprogramacion_mes8']; 
                    //$proyect->reprogramacion_mes9= $row['reprogramacion_mes9']; 
                    //$proyect->reprogramacion_mes10= $row['reprogramacion_mes10']; 
                    //$proyect->reprogramacion_mes11= $row['reprogramacion_mes11']; 
                    //$proyect->reprogramacion_mes12= $row['reprogramacion_mes12']; 
                    //$proyect->estado2= $row['estado2']; 
                    //$proyect->monto_planilla7= $row['monto_planilla7']; 
                    //$proyect->fecha_planilla7= $row['fecha_planilla7']; 
                    //$proyect->informe_planilla7= $row['informe_planilla7']; 
                    //$proyect->fecha_planilla_informe7= $row['fecha_planilla_informe7']; 
                    //$proyect->ejecutado_planilla7_sup= $row['ejecutado_planilla7_sup']; 
                    //$proyect->fecha_eje7_sup= $row['fecha_eje7_sup']; 
                    //$proyect->informe_eje7_sup= $row['informe_eje7_sup']; 
                    //$proyect->fecha_informe_eje7_sup= $row['fecha_informe_eje7_sup']; 
                    //$proyect->monto_planilla8= $row['monto_planilla8']; 
                    //$proyect->fecha_planilla8= $row['fecha_planilla8']; 
                    //$proyect->informe_planilla8= $row['informe_planilla8']; 
                    //$proyect->fecha_planilla_informe8= $row['fecha_planilla_informe8']; 
                    $proyect->fecha_entrega_definitiva= $row['fecha_entrega_definitiva']; 
                    //$proyect->fecha_ex_inicio1= $row['fecha_ex_inicio1']; 
                    //$proyect->fecha_ex_fin1= $row['fecha_ex_fin1']; 
                    //$proyect->fecha_ex_inicio2= $row['fecha_ex_inicio2']; 
                    //$proyect->fecha_ex_fin2= $row['fecha_ex_fin2']; 
                    //$proyect->fecha_ex_inicio3= $row['fecha_ex_inicio3']; 
                    //$proyect->fecha_ex_fin3= $row['fecha_ex_fin3']; 
                    //$proyect->uh_entregado= $row['uh_entregado']; 
                    //$proyect->uh_enejecucion= $row['uh_enejecucion']; 
                    //$proyect->estado_entrega= $row['estado_entrega']; 
                    $proyect->fiscal= $row['fiscal']; 
                    $proyect->ampliacion_plazo= $row['ampliacion_plazo']; 
                    //$proyect->descripcion_obra= $row['descripcion_obra']; 
                    //$proyect->observaciones= $row['observaciones']; 
                    //$proyect->mapa= $row['mapa']; 
                    //$proyect->aniversario_municipal= $row['aniversario_municipal']; 
                    //$proyect->fecha_modificacion= $row['fecha_modificacion']; 
                    $proyect->monto_contrato_obra= $row['monto_contrato_obra']; 
                    //$proyect->concurrencia= $row['concurrencia']; 
                    //$proyect->fecha_ini_social= $row['fecha_ini_social']; 
                    //$proyect->fecha_fin_social= $row['fecha_fin_social']; 
                    //$proyect->fecha_ini_proyectos= $row['fecha_ini_proyectos']; 
                    //$proyect->fecha_fin_proyectos= $row['fecha_fin_proyectos']; 
                    //$proyect->fecha_ini_comite= $row['fecha_ini_comite']; 
                    //$proyect->fecha_fin_comite= $row['fecha_fin_comite']; 
                    //$proyect->fecha_ini_contratacion= $row['fecha_ini_contratacion']; 
                    //$proyect->fecha_fin_contratacion= $row['fecha_fin_contratacion']; 
                    //$proyect->fecha_update= $row['fecha_update'];
                    //$proyect->revisado= $row['revisado']; 
                    $proyect->activo= $row['activo']; 
                    $proyect->etapa= $row['etapa']; 
                    $proyect->etapa_fin= $row['etapa_fin']; 
                    //$proyect->fecha_insert= $row['fecha_insert'];
                    $proyect->save();
                    $i++;
            }
                $replica = ORM::factory('replicas');
                $replica->fecha_replica = $fechahora['fechaactu'];
                $replica->tabla = 'PROYECTOSEXCEL';
                $replica->cant_reg = $i;
                $replica->mensaje = 'La Replica se realizo con Exito';
                $replica->save();
                echo 1;
        }else{
            $replica = ORM::factory('replicas');
            $replica->fecha_replica = $fechahora['fechaactu'];
            $replica->tabla = 'PROYECTOSEXCEL';
            $replica->cant_reg = 0;
            $replica->mensaje = 'No se Trunco la tabla';
            $replica->save();
            echo 2;
        }        
                
        }else{
          $replica = ORM::factory('replicas');
          $replica->fecha_replica = $fechahora['fechaactu'];
          $replica->tabla = 'PROYECTOSEXCEL';
          $replica->cant_reg = 0;
          $replica->mensaje = 'ERROR en la Replica';
          $replica->save();
          echo 0; 
           
        }
    }
    
    
}

