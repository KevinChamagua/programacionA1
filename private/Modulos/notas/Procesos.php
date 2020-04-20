<?php 
include('../../Config/Config.php');
$nota = new nota($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$nota->$proceso( $_GET['nota'] );
print_r(json_encode($nota->respuesta));

class nota{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($nota){
        $this->datos = json_decode($nota, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['codigo']) ){
            $this->respuesta['msg'] = 'por favor ingrese el codigo del nota';
        }
        if( empty($this->datos['materia']) ){
            $this->respuesta['msg'] = 'por favor ingrese el materia del nota';
        }
        $this->almacenar_nota();
    }
    private function almacenar_nota(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO notas (codigo,materia) VALUES(
                        "'. $this->datos['codigo'] .'",
                        "'. $this->datos['materia'] .'" 
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE notas SET
                        codigo      = "'. $this->datos['codigo'] .'",
                        materia      = "'. $this->datos['materia'] .'"
                    WHERE idnota = "'. $this->datos['idNota'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarNota($valor = ''){
        $this->db->consultas('
            select notas.idNota, notas.codigo, notas.materia
            from notas
            where notas.codigo like "%'. $valor .'%" or notas.materia like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarNota($idNota = 0){
        $this->db->consultas('
            DELETE notas
            FROM notas
            WHERE notas.idNota="'.$idNota.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>