<?php 
include('../../Config/Config.php');
$prestamo = new prestamo($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$prestamo->$proceso( $_GET['prestamo'] );
print_r(json_encode($prestamo->respuesta));

class prestamo{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($Prestamo){
        $this->datos = json_decode($Prestamo, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty(trim($this->datos['nombre'])) ){
            $this->respuesta['msg'] = 'por favor ingrese su Nombre de estudiante';
        }
        if( empty(trim($this->datos['direccion'])) ){
            $this->respuesta['msg'] = 'por favor ingrese su direccion ';
        }
        if( empty(trim($this->datos['telefono'])) ){
            $this->respuesta['msg'] = 'por favor ingrese su telefono';
        }
        $this->almacenar_Prestamo();
    }
    private function almacenar_Prestamo(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO prestamos (nombre,direccion,telefono, libro, fprestamo, fdevolucion) VALUES(
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['direccion'] .'",
                        "'. $this->datos['telefono'] .'",
                        "'. $this->datos['libro'] .'",
                        "'. $this->datos['fprestamo'] .'",
                        "'. $this->datos['fdevolucion'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE prestamos SET
                        nombre     = "'. $this->datos['nombre'] .'",
                        direccion  = "'. $this->datos['direccion'] .'",
                        telefono   = "'. $this->datos['telefono'] .'",
                        libro      = "'. $this->datos['libro'] .'",
                        fprestamo  = "'. $this->datos['fprestamo'] .'",
                        fdevolucion  = "'. $this->datos['fdevolucion'] .'"
                    WHERE idPrestamo = "'.$this->datos['idPrestamo'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            } else{
                $this->respuesta['msg'] = 'Registro no se actualizado correctamente';
            }
        }
    }
    public function buscarPrestamo($valor = ''){
        $this->db->consultas('
            select prestamos.idPrestamo, prestamos.nombre, prestamos.direccion, prestamos.telefono, prestamos.libro, prestamos.fprestamo, prestamos.fdevolucion
            from prestamos
            where prestamos.nombre like "%'. $valor .'%" or prestamos.direccion like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarPrestamo($idPrestamo = 0){
        $this->db->consultas('
            DELETE prestamos
            FROM prestamos
            WHERE prestamos.idPrestamo="'.$idPrestamo.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>