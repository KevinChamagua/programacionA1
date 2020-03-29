<?php 
include('../../Config/Config.php');
$docente = new docente($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$docente->$proceso( $_GET['docente'] );
print_r(json_encode($docente->respuesta));

class docente{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];

    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($docente){
        $this->datos = json_decode($docente, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['codigo']) ){
            $this->respuesta['msg'] = 'por favor ingrese el codigo del estudiante';
        }
        if( empty($this->datos['nit']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nit del estudiante';
        }
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese la nombre del estudiante';
        }
        $this->almacenar_docente();
    }
    private function almacenar_docente(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO docentes (codigo,nit,nombre,telefono) VALUES(
                        "'. $this->datos['codigo'] .'",
                        "'. $this->datos['nit'] .'",
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['telefono'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                   UPDATE docentes SET
                        codigo     = "'. $this->datos['codigo'] .'",
                        nit     = "'. $this->datos['nit'] .'",
                        nombre  = "'. $this->datos['nombre'] .'",
                        telefono   = "'. $this->datos['telefono'] .'"
                    WHERE iddocente = "'. $this->datos['iddocente'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscardocente($valor=''){
        $this->db->consultas('
            select docentes.iddocente, docentes.codigo, docentes.nit, docentes.nombre, docentes.telefono
            from docentes
            where docentes.codigo like "%'.$valor.'%" or docentes.nit like "%'.$valor.'%"
        ');
        return $this->respuesta = $this->db->obtener_datos();
    }
    public function eliminardocente($iddocente=''){
        $this->db->consultas('
            delete docentes
            from docentes
            where docentes.iddocente = "'.$iddocente.'"
        ');
        $this->respuesta['msg'] = 'Registro eliminado correctamente';
    }
  }
?> 