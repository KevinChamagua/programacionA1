var apppeliculas = new Vue({
    el:'#frm-peliculas',
    data:{
        pelicula:{
            idPelicula     : 0,
            accion         : 'nuevo',
            codigo         : '',
            nombre         : '',
            pelicualatotal : '',
            msg            : ''
        }
    },
    methods:{
        guardarPeliculas(){
            fetch(`private/Modulos/peliculas/procesos.php?proceso=recibirDatos&pelicula=${JSON.stringify(this.pelicula)}`).then( resp=>resp.json() ).then(resp=>{
                this.pelicula.msg = resp.msg;
                this.limpiarPeliculas();
            });
        },
        limpiarPeliculas(){
            this.pelicula.idPelicula=0;
            this.pelicula.accion="nuevo";
            this.pelicula.codigo="";
            this.pelicula.nombre="";
            this.pelicula.peliculatotal="";
            this.pelicula.msg="";
        }
    }
});