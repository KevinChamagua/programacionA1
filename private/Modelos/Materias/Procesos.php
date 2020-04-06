<?php 
include('../../Config/Config.php');
$materia = new materia($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$materia->$proceso( $_GET['materrias'] );
print_r(json_encode($materia->respuesta));

class materia{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];

    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($materias){
        $this->datos = json_decode($materias, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['facultad']) ){
            $this->respuesta['msg'] = 'por favor ingrese la facultad';
        }
        if( empty($this->datos['materia']) ){
            $this->respuesta['msg'] = 'por favor ingrese la materia';
        }
        $this->almacenar_materias();
    }
    private function almacenar_materias(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO materias (facultad,materia) VALUES(
                        "'. $this->datos['facultad'] .'",                
                        "'. $this->datos['materia'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                   UPDATE materias SET
                        facultad     = "'. $this->datos['facultad'] .'",
                        materia   = "'. $this->datos['materia'] .'"
                    WHERE idmateria = "'. $this->datos['idmateria'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarmateria($valor=''){
        $this->db->consultas('
            select materias.idmateria, materias.facultad, materias.materia,
            from materias
            where materias.facultad like "%'.$valor.'%" or materias.facultad like "%'.$valor.'%"
        ');
        return $this->respuesta = $this->db->obtener_datos();
    }
    public function eliminarmateria($idmateria=''){
        $this->db->consultas('
            delete materias
            from materias
            where materias.idmateria = "'.$idmateria.'"
        ');
        $this->respuesta['msg'] = 'Registro eliminado correctamente';
    }
  }
?> 