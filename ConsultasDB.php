<?php


class ConsultasDB {
    
    protected $mysqli;
    const LOCALHOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'esec';
    
    /**
     * Constructor de clase
     */
    public function __construct() {           
        try{
            
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
            
         }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión
            http_response_code(500);
            exit;
        }     
    } 
    
    
    public function getAuth($user='',$pass=''){
        
        //$stmt = $this->mysqli->prepare("SELECT id_usuario, id_rol, nombre, email, contrasena, telefono, direccion, identificacion  FROM usuario WHERE email=? and contrasena=? ");
        $stmt = $this->mysqli->prepare("SELECT u.id_usuario, r.id_rol, r.nombre nombrerol, u.nombre, u.email, u.contrasena, u.telefono, u.direccion, u.identificacion  FROM usuario u, rol r WHERE u.email=? and u.contrasena=? and r.id_rol = u.id_rol ");
        $stmt->bind_param('si', $user,$pass);
        print_r($user);
        $stmt->execute();
        $result = $stmt->get_result();
        $peoples = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $peoples;
    }
    
    public function getUsuarios(){
        
        $stmt = $this->mysqli->prepare("SELECT u.id_usuario, r.id_rol, r.nombre nombrerol, u.nombre, u.email, u.contrasena, u.telefono, u.direccion, u.identificacion  FROM usuario u, rol r where r.id_rol = u.id_rol and u.estado = 'Activo'");
        $stmt->execute();
        $result = $stmt->get_result();
        $peoples = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $peoples;
    }
    



    public function setUsuario($nombre='',$email='',$contrasena='',$id_rol=0,$telefono='',$direccion='',$identificacion=''){
        session_start();
        $stmt = $this->mysqli->prepare("insert into usuario(nombre,email,contrasena,id_rol,telefono,direccion,identificacion)values('$nombre','$email','$contrasena','$id_rol','$telefono','$direccion','$identificacion')");
        $r = $stmt->execute();
        $stmt = $this->mysqli->prepare("insert into logs(nombre_usuario,descripcion) values ('".$_SESSION['name']."','realiza creacion de usuario$nombre  con un rol: $id_rol'); ");
        $r = $stmt->execute();
        
        return $r;
    }

    public function setTarjeta($codigo_tarjeta='',$descripcion='',$id_usuario=0){
        session_start();
        $stmt = $this->mysqli->prepare("insert into tarjeta(codigo_tarjeta,descripcion,id_usuario)values('$codigo_tarjeta','$descripcion','$id_usuario')");
        $r = $stmt->execute();
        $stmt = $this->mysqli->prepare("insert into logs(nombre_usuario,descripcion) values ('".$_SESSION['name']."','realiza creacion de usuario$nombre  con un rol: $id_rol'); ");
        $r = $stmt->execute();
        
        return $r;
    }

    public function getRoles(){
        
        $stmt = $this->mysqli->prepare("SELECT * FROM rol");
        $stmt->execute();
        $result = $stmt->get_result();
        $Roles = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $Roles;
    }

    public function setRecarga($id=0,$valor=0){
        session_start();
        $stmt = $this->mysqli->prepare("insert into recarga(id_tarjeta,valor)values($id,$valor)");
        $r = $stmt->execute();
        
        $usuario=$_SESSION['name'];
        echo "ususario: "+$usuario;
        $stmt = $this->mysqli->prepare("update tarjeta set saldo=saldo+$valor where id_tarjeta=$id");
        $r = $stmt->execute();
        $stmt = $this->mysqli->prepare("insert into logs(nombre_usuario,descripcion) values ('".$_SESSION['name']."','realiza recarga a la tarjeta $id  por valor de $valor'); ");
        $r = $stmt->execute();
        
        return $r;
    }
    


    public function getRecargasAll(){
        
        $stmt = $this->mysqli->prepare("SELECT * FROM recarga order by fecha desc");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $peoples = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $peoples;
    }
    
    public function setOrdenServicio($id=0,$minutos=0){
        session_start();
        $valor=($minutos*50);
        $stmt = $this->mysqli->prepare("insert into orden_de_servicio(id_tarjeta,minutos,estado) values ('$id','$minutos','Pendiente')");
        $r = $stmt->execute();
        
        $stmt = $this->mysqli->prepare("update tarjeta set saldo=saldo-$valor where id_tarjeta=$id");
        $r = $stmt->execute();

        $stmt = $this->mysqli->prepare("insert into logs(nombre_usuario,descripcion) values ('".$_SESSION['name']."','realiza consumo a la tarjeta $id cargando $minutos por valor de $valor'); ");
        $r = $stmt->execute();
        
        return $r;
    }
    
    public function getOrdenesServicioAll(){
        
        $stmt = $this->mysqli->prepare("SELECT * FROM orden_de_servicio order by fecha_orden desc");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $peoples = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $peoples;
    }

    

    public function getTarjetas($id=0){
        
        $stmt = $this->mysqli->prepare("SELECT * FROM tarjeta where id_usuario = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $Tarjetas = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $Tarjetas;
    
    }

    public function getTarjetasAll(){
        
        $stmt = $this->mysqli->prepare("SELECT t.id_tarjeta,u.nombre,t.codigo_tarjeta, t.descripcion, t.saldo  FROM tarjeta t, usuario u where t.id_usuario = u.id_usuario");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $Tarjetas = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $Tarjetas;
    }
    

    public function getSaldo($id=0){
        
        $stmt = $this->mysqli->prepare("SELECT * FROM tarjeta where id_tarjeta = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $Tarjetas = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $Tarjetas;
    }
    


}
