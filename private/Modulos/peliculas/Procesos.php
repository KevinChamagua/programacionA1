<?php 
include('../../Config/Config.php');
$pelicula = new pelicula($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$pelicula->$proceso( $_GET['pelicula'] );
print_r(json_encode($pelicula->respuesta));

class pelicula{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($pelicula){
        $this->datos = json_decode($pelicula, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['codigo']) ){
            $this->respuesta['msg'] = 'por favor ingrese el codigo del materia';
        }
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre de la materia';
        }
        if( empty($this->datos['peliculatotal']) ){
            $this->respuesta['msg'] = 'por favor ingrese la peliculatotal del pelicula';
        }
        $this->almacenar_pelicula();
    }
    private function almacenar_pelicula(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO peliculas (codigo,nombre,peliculatotal,telefono,dui,nit) VALUES(
                        "'. $this->datos['codigo'] .'",
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['peliculatotal'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE peliculas SET
                        codigo        = "'. $this->datos['codigo'] .'",
                        nombre        = "'. $this->datos['nombre'] .'",
                        nit           = "'. $this->datos['peliculatotal'] .'"
                    WHERE idPelicula  = "'. $this->datos['idPelicula'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarPelicula($valor = ''){
        $this->db->consultas('
            select peliculas.idPelicula, peliculas.codigo, peliculas.nombre, peliculas.peliculatotal
            from peliculas
            where peliculas.codigo like "%'. $valor .'%" or peliculas.nombre like "%'. $valor .'%" or peliculas.peliculatotal like "%'. $valor .'%" 
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarPelicula($idPelicula = 0){
        $this->db->consultas('
            DELETE peliculas
            FROM peliculas
            WHERE peliculas.idPelicula="'.$idPelicula.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>