<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Consultores extends ORM{
    protected $_table_names_plural = false;
    public function veryficarcodigo($id) {
        $sql = "SELECT e.*,COUNT(*) as resultado
                FROM consultores e
                WHERE e.id = $id";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function veryficarcorreo($correo) {
        $sql = "SELECT COUNT(*) as resultado
                FROM consultores
                WHERE mail = '$correo'
                GROUP BY mail";
        return db::query(Database::SELECT, $sql)->execute();
    }

    public function datosconsultor($userid) {
        $sql = "SELECT *
                FROM consultores
                WHERE user_id = '$userid'";
        return db::query(Database::SELECT, $sql)->execute();
    }

    
    public function listaprconsultores(){
          $sql="SELECT consultores.id,consultores.nombre_completo,tipoclasificacion.tipo,consultores.procedencia,departamentos.departamento,consultores.profesion,consultores.ci,
          consultores.telefonos,consultores.celular,consultores.mail,estados.estado FROM consultores 
          INNER JOIN estados on consultores.estado = estados.id
          LEFT JOIN departamentos on consultores.id_departamento = departamentos.id
          INNER JOIN tipoclasificacion on consultores.tipo = tipoclasificacion.id";
           $consultorpr = array();
           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $consultorpr[$r['id']] = array(
                            'id' => $r['id'],
                            'nombre_completo' => $r['nombre_completo'],
                            'tipo' => $r['tipo'],
                            'procedencia' => $r['procedencia'],
                            'departamento' => $r['departamento'],
                            'profesion' => $r['profesion'],
                            'ci' => $r['ci'],
                            'telefonos' => $r['telefonos'],
                            'celular' => $r['celular'],
                            'mail' => $r['mail'],
                            'estado' => $r['estado'],
                            'suma'=>$i,                
                        );
                        $i++;
                    }
           return array_values($consultorpr); 
    }


    public function emailrepetidoconsultor($email_proponente){
        $email = '%'.$email_proponente.'%';
        $sql = "SELECT id from consultores where mail like '$email'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['id'])){
            return true;
        }else{
            return false;
        }
    }
    
    public function verifyestado($ide){
        $sql = "SELECT * from consultores where id = '$ide' and estado = '4'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(!empty($reg['id'])){
            return "ok";
        }else{
            return "sinhabilitar";
        }
    }
    
}



?>
