<?php 
include('../../Config/Config.php');
$alquiler = new alquiler($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$alquiler->$proceso( $_GET['alquiler'] );
print_r(json_encode($alquiler->respuesta));

class alquiler{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($alquiler){
        $this->datos = json_decode($alquiler, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['fechadeprestamo']) ){
            $this->respuesta['msg'] = 'por favor ingrese el fechadeprestamo del materia';
        }
        if( empty($this->datos['fechadedevolucion']) ){
            $this->respuesta['msg'] = 'por favor ingrese el fechadedevolucion de la materia';
        }
        if( empty($this->datos['valor']) ){
            $this->respuesta['msg'] = 'por favor ingrese la valor del valor';
        }
        $this->almacenar_alquiler();
    }
    private function almacenar_alquiler(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO alquileres (fechadeprestamo,fechadedevolucion,valor,telefono,dui,nit) VALUES(
                        "'. $this->datos['fechadeprestamo'] .'",
                        "'. $this->datos['fechadedevolucion'] .'",
                        "'. $this->datos['valor'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE alquileres SET
                        fechadeprestamo      = "'. $this->datos['fechadeprestamo'] .'",
                        fechadedevolucion      = "'. $this->datos['fechadedevolucion'] .'",
                        nit         = "'. $this->datos['valor'] .'"
                    WHERE idAlquiler = "'. $this->datos['idAlquiler'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarAlquiler($valor = ''){
        $this->db->consultas('
            select alquileres.idAlquiler, alquileres.fechadeprestamo, alquileres.fechadedevolucion, alquileres.valor
            from alquileres
            where alquileres.fechadeprestamo like "%'. $valor .'%" or alquileres.fechadedevolucion like "%'. $valor .'%" or alquileres.valor like "%'. $valor .'%" 
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarAlquiler($idAlquiler = 0){
        $this->db->consultas('
            DELETE alquileres
            FROM alquileres
            WHERE alquileres.idAlquiler="'.$idAlquiler.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>