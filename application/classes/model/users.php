<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Users extends ORM{
    protected $_table_names_plural = false;
    //un usuario genera varios documentos 
    protected $_has_many=array(
        'documentos'=>array(
            'model'=>'documentos',
            'foreign_key'=>'id_user'
        ),
        'tipo'=>array(
            'model' =>'tipos',
            'through' => 'usertipo',
            'foreign_key' => 'id_user',
            'far_key' => 'id_tipo',
        ),
        'destinos'=>array(
          'model'=>'destinos',
          'through' => 'destinatarios',
          'foreign_key'=>'id_usuario',
          'fair_key'=>'id_destino'  
        ),
        
    );
    
    // un usuario (funcionario) pertenece a una oficina
    protected $_belongs_to=array(
        'oficina'=>array(
            'model'=>'oficinas',
            'foreign_key'=>'id_oficina'
        ),
        
    );
    
    

    //propiedades de un usuario
    public function property($id){
        $sql="SELECT u.id, u.dependencia, u.nombre,u.cargo,o.nombre, u.genero, u.id_oficina 
            FROM users u INNER JOIN oficinas o ON u.id_oficina=o.id
            WHERE u.id='$id'";
        return db::query(Database::SELECT, $sql)->execute();
    }    
    /*Administrador*/
    //lista de usuarios excepto quien lo 
    public function usuarios($id){
        $sql="SELECT u.id, u.id_oficina, o.oficina, u.username, u.nombre, u.last_login,u.mosca,u.cargo,u.email,u.logins, u.fecha_creacion,u.genero,n.nivel FROM users u
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN niveles n ON u.nivel=n.id
            WHERE u.id <> '$id'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    public function todo($id){
        
    }
    
    public function deptouser($idu){
        $sql="SELECT d.departamento,d.id
              FROM users u 
              INNER JOIN oficinas o ON u.id_oficina = o.id
              INNER JOIN departamentos d ON o.departamento = d.id
              WHERE u.id='$idu'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function iddeptouser($id){
        $sql = "SELECT id_departamento from users where id = '$id'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['id_departamento'])){
            return 2;
        }else{
            return $reg['id_departamento'];
        }
    }
    public function getdatosusers($username){
        $sql = "SELECT * from users where username = '$username'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function updatepswmaestro($id,$psw){
        $update = "UPDATE users set password = '$psw' where id = '$id'";
        mysql_query($update);
    }
}
?>
