var appBuscarAlquileres = new Vue({
    el: '#frm-buscar-alquileres',
    data:{
        misalquileres:[],
        valor:''
    },
    methods:{
        buscarAlquileres(){
            fetch(`private/Modulos/alquileres/procesos.php?proceso=buscarAlquiler&alquiler=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.misalquileres = resp;
            });
        },
        modificarAlquiler(alquiler){
            appalquileres.alquiler = alquiler;
            appalquileres.alquiler.accion = 'modificar';
        },
        eliminarAlquiler(idAlquiler){
            fetch(`private/Modulos/alquileres/procesos.php?proceso=eliminarAlquiler&alquiler=${idAlquiler}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarAlquileres();
            });
        }
    },
    created(){
        this.buscarAlquileres();
    }
});