var appbuscar_peliculas = new Vue({
    el: '#frm-buscar-peliculas',
    data:{
        mispeliculas:[],
        valor:''
    },
    methods:{
        buscarPeliculas(){
            fetch(`private/Modulos/peliculas/procesos.php?proceso=buscarPelicula&pelicula=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.mispeliculas = resp;
            });
        },
        modificarNota(pelicula){
            apppeliculas.pelicula = pelicula;
            apppeliculas.peliculas.accion = 'modificar';
        },
        eliminarPelicula(idPelicula){
            fetch(`private/Modulos/peliculas/procesos.php?proceso=eliminarPelicula&pelicula=${idPelicula}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarPeliculas();
            });
        }
    },
    created(){
        this.buscarPeliculas();
    }
});