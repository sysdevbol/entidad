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
    public function cantpn($dato1,$dato2,$dato4,$dato5){
        if($dato2 == "10"){
            $dat21 = '11';
        }
        if($dato2 == "11"){
            $dat21 = '12';
        }
        if($dato2 == "12"){
            $dat21 = '13';
        }
        if($dato2 == "15"){
            $dat21 = '14';
        }
        if($dato2 == "16"){
            $dat21 = '15';
        }
        $sql = "SELECT COUNT(tb1.id_consultor) as 'cant', GROUP_CONCAT(tb1.id_consultor) as 'ids' from (SELECT tb.id_consultor,tb.tiemgeneral,tb.tiempoespecifico FROM (SELECT experienciaconsultor.id_consultor, 
(CASE WHEN((SUM(round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2))) is NULL) then '0.00' else (SUM(round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2))) end) as 'tiemgeneral',
(CASE WHEN((sum(case when (experienciaconsultor.id_tipoexperiencia = '1') then round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2) else 0 end)) is null) then '0.00' else (sum(case when (experienciaconsultor.id_tipoexperiencia = '1') then round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2) else 0 end)) end) as 'tiempoespecifico' 
from experienciaconsultor 
INNER join consultores on experienciaconsultor.id_consultor = consultores.id where 
consultores.id_departamento = '$dato1' and consultores.estado = 4 and (consultores.tipo = '$dato2' or '$dato21' like CONCAT('%',consultores.id_rubroarea,'%')) group by experienciaconsultor.id_consultor) as tb where tb.tiemgeneral >= '$dato5' and tb.tiempoespecifico >= '$dato4') as tb1";
        $dat = mysql_query($sql);
        $reg = @mysql_fetch_assoc($dat);
        $resultado = array();
        $resultado[0] = $reg['cant'];
        $resultado[1] = $reg['ids'];
        return $resultado;
    }
    public function cantpn1($dato1,$dato2,$dato4,$dato5){
        if($dato2 == "16"){
            $dat21 = '15';
        }
        $sql = "SELECT COUNT(tb1.id_consultor) as 'cant', GROUP_CONCAT(tb1.id_consultor) as 'ids' from 
(SELECT tb.id_consultor,tb.tiemgeneral,tb.tiempoespecifico, tb.cantexp FROM 
(SELECT experienciaconsultor.id_consultor, 
(CASE WHEN((SUM(round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2))) is NULL) then '0.00' else (SUM(round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2))) end) as 'tiemgeneral', 
(CASE WHEN((sum(case when (experienciaconsultor.id_tipoexperiencia = '1') then round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2) else 0 end)) is null) then '0.00' else (sum(case when (experienciaconsultor.id_tipoexperiencia = '1') then round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2) else 0 end)) end) as 'tiempoespecifico', 
SUM(CASE WHEN(experienciaconsultor.id_tipoexperiencia = '1') then 1 else 0 end) as 'cantexp'
from experienciaconsultor INNER join consultores on experienciaconsultor.id_consultor = consultores.id 
where consultores.id_departamento = '$dato1' and consultores.estado = 4 and (consultores.tipo = '$dato2' or '$dato21' like CONCAT('%',consultores.id_rubroarea,'%')) group by experienciaconsultor.id_consultor) as tb where tb.tiemgeneral >= '$dato5' and tb.tiempoespecifico >= '2' and tb.cantexp >= '$dato4') as tb1";
        $dat = mysql_query($sql);
        $reg = @mysql_fetch_assoc($dat);
        $resultado = array();
        $resultado[0] = $reg['cant'];
        $resultado[1] = $reg['ids'];
        return $resultado;
    }
    public function cantpn2($dato1,$dato2,$dato4){
        $sql = "SELECT COUNT(tb1.id_consultor) as 'cant', GROUP_CONCAT(tb1.id_consultor) as 'ids' from (SELECT tb.id_consultor,tb.tiemgeneral,tb.tiempoespecifico FROM (SELECT experienciaconsultor.id_consultor, 
(CASE WHEN((SUM(round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2))) is NULL) then '0.00' else (SUM(round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2))) end) as 'tiemgeneral',
(CASE WHEN((sum(case when (experienciaconsultor.id_tipoexperiencia = '1') then round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2) else 0 end)) is null) then '0.00' else (sum(case when (experienciaconsultor.id_tipoexperiencia = '1') then round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2) else 0 end)) end) as 'tiempoespecifico' 
from experienciaconsultor 
INNER join consultores on experienciaconsultor.id_consultor = consultores.id where 
consultores.id_departamento = '$dato1' and consultores.estado = 4 and consultores.tipo = '$dato2' group by experienciaconsultor.id_consultor) as tb where tb.tiempoespecifico >= '$dato4') as tb1";
        $dat = mysql_query($sql);
        $reg = @mysql_fetch_assoc($dat);
        $resultado = array();
        $resultado[0] = $reg['cant'];
        $resultado[1] = $reg['ids'];
        return $resultado;
    }
    
}



?>
