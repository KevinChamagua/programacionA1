<?php 
include('../../Config/Config.php');
$alumno = new alumno($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$alumno->$proceso( $_GET['alumno'] );
print_r(json_encode($alumno->respuesta));

class alumno{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($alumno){
        $this->datos = json_decode($alumno, true);
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
        $this->almacenar_Alumno();
    }
    private function almacenar_Alumno(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO alumnos (nombre,direccion,telefono, codigo) VALUES(
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['direccion'] .'",
                        "'. $this->datos['telefono'] .'",
                        "'. $this->datos['codigo'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE alumnos SET
                        nombre     = "'. $this->datos['nombre'] .'",
                        direccion  = "'. $this->datos['direccion'] .'",
                        telefono   = "'. $this->datos['telefono'] .'",
                        codigo      = "'. $this->datos['codigo'] .'"                      
                    WHERE idAlumno = "'.$this->datos['idAlumno'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            } else{
                $this->respuesta['msg'] = 'Registro no se actualizado correctamente';
            }
        }
    }
    public function buscarAlumno($valor = ''){
        $this->db->consultas('
            select alumnos.idAlumno, alumnos.nombre, alumnos.direccion, alumnos.telefono, alumnos.codigo
            from alumnos
            where alumnos.nombre like "%'. $valor .'%" or alumnos.direccion like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarAlumno($idAlumno = 0){
        $this->db->consultas('
            DELETE alumnos
            FROM alumnos
            WHERE alumnos.idAlumno="'.$idAlumno.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>