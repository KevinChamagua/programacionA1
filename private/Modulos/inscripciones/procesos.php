<?php 
include('../../Config/Config.php');
$inscripcion = new inscripcion($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$inscripcion->$proceso( $_GET['inscripcion'] );
print_r(json_encode($inscripcion->respuesta));

class inscripcion{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($inscripcion){
        $this->datos = json_decode($inscripcion, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['codigo']) ){
            $this->respuesta['msg'] = 'por favor ingrese el codigo del inscripcion';
        }
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del inscripcion';
        }
        if( empty($this->datos['direccion']) ){
            $this->respuesta['msg'] = 'por favor ingrese la direccion del inscripcion';
        }
        $this->almacenar_inscripcion();
    }
    private function almacenar_inscripcion(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO inscripciones (codigo,nombre,direccion,telefono,dui,nit) VALUES(
                        "'. $this->datos['codigo'] .'",
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['direccion'] .'",
                        "'. $this->datos['responsable'] .'",
                        "'. $this->datos['telefono'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE inscripciones SET
                        codigo      = "'. $this->datos['codigo'] .'",
                        nombre      = "'. $this->datos['nombre'] .'",
                        direccion   = "'. $this->datos['direccion'] .'",
                        responsable = "'. $this->datos['responsable'] .'",
                        telefono    = "'. $this->datos['telefono'] .'"
                    WHERE idInscripcion = "'. $this->datos['idInscripcion'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarInscripcion($valor = ''){
        $this->db->consultas('
            select inscripciones.idInscripcion, inscripciones.codigo, inscripciones.nombre, inscripciones.direccion, inscripciones.responsable, inscripciones.telefono
            from inscripciones
            where inscripciones.codigo like "%'. $valor .'%" or inscripciones.nombre like "%'. $valor .'%" or inscripciones.responsable like "%'. $valor .'%" or inscripciones.telefono like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarInscripcion($idInscripcion = 0){
        $this->db->consultas('
            DELETE inscripciones
            FROM inscripciones
            WHERE inscripciones.idInscripcion="'.$idInscripcion.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>