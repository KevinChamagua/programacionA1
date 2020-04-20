<?php 
include('../../Config/Config.php');
$matricula = new matricula($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$matricula->$proceso( $_GET['matricula'] );
print_r(json_encode($matricula->respuesta));

class matricula{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($matricula){
        $this->datos = json_decode($matricula, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['codigo']) ){
            $this->respuesta['msg'] = 'por favor ingrese el codigo del estudiante';
        }
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del estudiante';
        }
        if( empty($this->datos['direccion']) ){
            $this->respuesta['msg'] = 'por favor ingrese la direccion del estudiante';
        }
        $this->almacenar_matricula();
    }
    private function almacenar_matricula(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO matriculas (codigo,nombre,direccion,telefono) VALUES(
                        "'. $this->datos['codigo'] .'",
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['direccion'] .'",
                        "'. $this->datos['telefono'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE matriculas SET
                        codigo     = "'. $this->datos['codigo'] .'",
                        nombre     = "'. $this->datos['nombre'] .'",
                        direccion  = "'. $this->datos['direccion'] .'",
                        telefono   = "'. $this->datos['telefono'] .'"
                    WHERE idMatricula = "'. $this->datos['idMatricula'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarMatricula($valor = ''){
        $this->db->consultas('
            select matriculas.idMatricula, matriculas.codigo, matriculas.nombre, matriculas.direccion, matriculas.telefono
            from matriculas
            where matriculas.codigo like "%'. $valor .'%" or matriculas.nombre like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarMatricula($idMatricula = 0){
        $this->db->consultas('
            DELETE matriculas
            FROM matriculas
            WHERE matriculas.idMatricula="'.$idMatricula.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>