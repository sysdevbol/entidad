<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Sociosaccidental extends ORM{
    protected $_table_names_plural = false;

    public function veryficarcodigo($id) {
        $sql = "SELECT e.*,COUNT(*) as resultado
                FROM empresas e
                WHERE e.id = $id";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function resetlider($ide){
        $query = db::update('sociosaccidental')->set(array('lider' =>'No'))->where('id_empresa_acc', '=', $ide)->execute();
    }
    
    public function listaprsocioaccidental($id_empresa_acc){
            $sql="SELECT sociosaccidental.id, 
            sociosaccidental.id_empresa_acc, 
            sociosaccidental.id_empresa_socios,
            (SELECT empresas.nombre_proponente from empresas where empresas.id = '$id_empresa_acc') as 'nombre_proponente_acc',
            empresas.nombre_proponente, 
            empresas.matricula, 
            sociosaccidental.lider, 
            sociosaccidental.porcentaje_participacion
            FROM sociosaccidental INNER JOIN empresas ON sociosaccidental.id_empresa_socios = empresas.id
            where sociosaccidental.id_empresa_acc = '$id_empresa_acc'";
                
           $sociosaccidental = array();
           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $sociosaccidental[$i] = array(
                            'id' => $r['id'],
                            'nombre_proponente_acc' => $r['nombre_proponente_acc'],
                            'nombre_proponente_socio' => $r['nombre_proponente'],
                            'matricula' => $r['matricula'],
                            'empresa_lider' => $r['lider'],
                            'porcentaje_participacion' => $r['porcentaje_participacion'],                
                        );
                        $i++;
                    }
           return array_values($sociosaccidental); 
    }
     public function idsocio($asociado){
        $sql = "SELECT id from empresas where empresas.nombre_proponente = '$asociado'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        return $reg['id'];
     }
     public function updateempresalider($id, $idempresa){
        $update = "UPDATE sociosaccidental set sociosaccidental.lider = 'No' where sociosaccidental.id_empresa_acc='$idempresa'";
        mysql_query($update);
        $update1 = "UPDATE sociosaccidental set sociosaccidental.lider = 'Si' where sociosaccidental.id_empresa_acc='$idempresa' and sociosaccidental.id='$id'";
        mysql_query($update1);
     }
     
     
    
}



?>
