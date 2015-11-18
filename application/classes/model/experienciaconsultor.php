<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Experienciaconsultor extends ORM{
    protected $_table_names_plural = false;

    
    public function listaprexperiencia($id_consultor){
            $sql="SELECT experienciaconsultor.id,experienciaconsultor.nombre_contratante,experienciaconsultor.objeto_contrato,
experienciaconsultor.lugar_contrato,experienciaconsultor.monto_contrato,experienciaconsultor.descripcion_contrato,
experienciaconsultor.inicio_contrato,experienciaconsultor.fin_contrato,tipoexperiencia.tipo, departamentos.departamento, experienciaconsultor.id_rubro 
FROM experienciaconsultor 
INNER JOIN tipoexperiencia ON experienciaconsultor.id_tipoexperiencia = tipoexperiencia.id 
LEFT JOIN departamentos ON experienciaconsultor.id_departamento = departamentos.id where `id_consultor` = '$id_consultor'";
            $experiencia = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $experiencia[$i] = array(
                            'id' => $r['id'],
                            'nombre_contratante' => $r['nombre_contratante'],
                            'objeto_contrato' => $r['objeto_contrato'],
                            'lugar_contrato' => $r['lugar_contrato'],
                            'monto_contrato' => $r['monto_contrato'],
                            'descripcion_contrato' => $r['descripcion_contrato'],
                            'tipo' => $r['tipo'],
                            'inicio_contrato' => $r['inicio_contrato'],
                            'fin_contrato' => $r['fin_contrato'],
                            'departamento' => $r['departamento'],
                            'rubro' => $r['id_rubro'],
                        );
                        $i++;
                    }
                    
           return array_values($experiencia); 
    }
    public function eliminaexp($id){
      $delete = "DELETE from experienciaconsultor where id = '$id'";
      mysql_query($delete);
    }
    public function montoexp($idempresa){
        $sql = "SELECT SUM(experienciaconsultor.monto_contrato) as 'monto' from experienciaconsultor where id_consultor = '$idempresa'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['monto'])){
            return 0;
        }else{
            return $reg['monto'];   
        }
    }
    public function cantaniosexp($idempresa){
        $date = date('Y');
        $date10 = ($date-10)."-01-01";
        $sql = "SELECT round((SUM(round(((to_days(experienciaconsultor.fin_contrato) - to_days(experienciaconsultor.inicio_contrato)) / 30),2))/12),2) AS 'anios' 
        from experienciaconsultor where id_consultor = '$idempresa' and inicio_contrato > '$date10' and id_tipoexperiencia = '1'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['anios'])){
            return 0;
        }else{
            return $reg['anios'];   
        }
    }
    public function porcentajepordepto($idempresa,$depto){
        $sql = "SELECT round((((SELECT COUNT(id) from experienciaconsultor where id_consultor = '$idempresa' and id_tipoexperiencia = '1' and id_departamento = '$depto')*100)/(SELECT COUNT(id) from experienciaconsultor where id_consultor = '$idempresa' and id_tipoexperiencia = '1')),2) as 'totalporcentaje'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['totalporcentaje'])){
            return 0;
        }else{
            return $reg['totalporcentaje'];   
        }
    }
    
}



?>
