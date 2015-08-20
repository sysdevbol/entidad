<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Empresas extends ORM{
    protected $_table_names_plural = false;

    public function veryficarcodigo($id) {
        $sql = "SELECT e.*,COUNT(*) as resultado
                FROM empresas e
                WHERE e.id = $id";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function veryficarcorreo($correo) {
        $sql = "SELECT COUNT(*) as resultado
                FROM empresas
                WHERE mail = '$correo'
                GROUP BY mail";
        return db::query(Database::SELECT, $sql)->execute();
    }
    
    public function listaprempresas(){
          $sql="SELECT e.id,e.nombre_proponente,tp.tipo,p.pais,c.ciudad,e.nit,e.matricula,e.telefonos,e.celular,e.mail,es.estado
                FROM empresas e
                INNER JOIN paises p ON e.pais = p.id
                INNER JOIN ciudades c ON e.ciudad = c.id
                INNER JOIN estados es ON e.estado = es.id
                INNER JOIN tipoclasificacion tp ON e.tipo = tp.id where e.tipo <> '9'";
           $empresas = array();
           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $empresas[$r['id']] = array(
                            'id' => $r['id'],
                            'nombre_proponente' => $r['nombre_proponente'],
                            'tipo' => $r['tipo'],
                            'pais' => $r['pais'],
                            'ciudad' => $r['ciudad'],
                            'nit' => $r['nit'],
                            'matricula' => $r['matricula'],
                            'telefonos' => $r['telefonos'],
                            'celular' => $r['celular'],
                            'mail' => $r['mail'],
                            'estado' => $r['estado'],
                            'suma'=>$i,                
                        );
                        $i++;
                    }
           return array_values($empresas); 
    }
    public function listaprempresasproveedor(){
          $sql="SELECT e.id,e.nombre_proponente,p.pais,c.ciudad,e.nit,e.matricula,e.telefonos,e.celular,e.mail,es.estado
                FROM empresas e
                INNER JOIN paises p ON e.pais = p.id
                INNER JOIN ciudades c ON e.ciudad = c.id
                INNER JOIN estados es ON e.estado = es.id
                INNER JOIN tipoclasificacion tp ON e.tipo = tp.id where e.tipo = '9'";
           $empresaspr = array();
           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $empresaspr[$r['id']] = array(
                            'id' => $r['id'],
                            'nombre_proponente' => $r['nombre_proponente'],
                            'pais' => $r['pais'],
                            'ciudad' => $r['ciudad'],
                            'nit' => $r['nit'],
                            'matricula' => $r['matricula'],
                            'telefonos' => $r['telefonos'],
                            'celular' => $r['celular'],
                            'mail' => $r['mail'],
                            'estado' => $r['estado'],
                            'suma'=>$i,                
                        );
                        $i++;
                    }
           return array_values($empresaspr); 
    }
    
    public function listaprempresasacc(){
          $sql="SELECT *
                FROM empresas
                WHERE tipo <> 5";
           $empresas = array();
           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $empresas[$r['id']] = array(
                            'id' => $r['id'],
                            'nombre_proponente' => $r['nombre_proponente'],                
                        );
                        $i++;
                    }
           return array_values($empresas); 
    }
    public function datosempresacuenta($username) {
        $sql = "SELECT *
                FROM empresas
                WHERE mail = '$username'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    
    public function listaexperiencia($ide) {
        $sql = "SELECT e.id,e.id_entidad, e.contratante, e.objeto_contrato, d.departamento ,e.ubicacion, e.relacion_estado,a.area,e.monto_contrato, 
                date_format(e.fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(e.fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                e.porcentaje_asociacion, e.nombre_socios,t.tipo
                FROM experienciaentidad e
                INNER JOIN tipoexperiencia t ON e.tipo = t.id
                LEFT JOIN departamentos d ON e.id_departamento = d.id
                LEFT JOIN areacalificacion a ON e.id_area = a.id
                WHERE id_entidad = $ide
                ORDER BY e.id DESC";
        return db::query(Database::SELECT, $sql)->execute()->as_array();
    }
    
    public function listasocios($ide) {
        $sql = "SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = $ide
                ORDER BY s.porcentaje_participacion DESC";
        return db::query(Database::SELECT, $sql)->execute()->as_array();
    }
    
    public function editarexperiencia($idex) {
        $sql = "SELECT e.id,e.id_entidad, e.contratante, e.objeto_contrato, e.ubicacion, e.monto_contrato, 
                date_format(e.fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(e.fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                e.porcentaje_asociacion, e.nombre_socios,e.tipo
                FROM experienciaentidad e
                WHERE e.id = $idex";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function serachForKeyword($keyword) {
  
    $keyword = '%'.$keyword.'%';
    $sql = "SELECT nombre_proponente from empresas where empresas.nombre_proponente like '$keyword' and tipo <> 5 and estado = 4";
    $dat = @mysql_query($sql);
    $results = array();
    $index=0;
    while($reg = @mysql_fetch_assoc($dat)){
        $results[$index] = $reg['nombre_proponente'];
        $index++;
    }
    return $results;
    }
    public function emailrepetido($email_proponente){
        $email = '%'.$email_proponente.'%';
        $sql = "SELECT id from empresas where mail like '$email'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['id'])){
            return true;
        }else{
            return false;
        }
    }
    public function nomproprepetido($nompropuniq){
        $nomprop = '%'.$nompropuniq.'%';
        $sql = "SELECT id from empresas where nombre_proponente like '$nomprop'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['id'])){
            return true;
        }else{
            return false;
        }
    }
    public function verificadatos($idempresa){
        $sql = "SELECT * from empresas where id = '$idempresa'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(!empty($reg['nombre_proponente']) and !empty($reg['user_id']) and $reg['estado'] > 1){
            return "ok";
        }else{
            return "incompleto";
        }
    }

    public function generapin($idempresa){
        $pin = 100000+$idempresa;
        $update = "UPDATE empresas set `pin` = '$pin' where id = '$idempresa'";
        mysql_query($update);
    }
    public function pinsocio($idempresa,$pin){
        if(empty($pin)){
            return '0';
        }else{
            $sql = "SELECT id from empresas where empresas.id = '$idempresa' and empresas.pin_empresa = '$pin'";
            $reg = @mysql_fetch_assoc(mysql_query($sql));
            if(!empty($reg['id'])){
                return '1';
            }else{
                return '0';
            }    
        }
        
    }
    public function verificahabilitado($ide){
        $sql = "SELECT * from empresas where id = '$ide' and estado = '4'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(!empty($reg['id'])){
            return "ok";
        }else{
            return "sinhabilitar";
        }
    }
    public function guardarubroinsumos($id){
        $update = "UPDATE empresas set id_rubroarea = (SELECT GROUP_CONCAT(rubroarea.id) from proveedormateriales 
        INNER JOIN Insumosrequeridos on proveedormateriales.material_id = Insumosrequeridos.id
        INNER JOIN rubroarea on Insumosrequeridos.descripcion = rubroarea.nombre
        where proveedormateriales.empresa_id = '$id' and proveedormateriales.tipo = '2') where empresas.id = '$id'";
        mysql_query($update);
    }
    
}



?>
