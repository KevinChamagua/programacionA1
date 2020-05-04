var appalquileres = new Vue({
    el:'#frm-alquileres',
    data:{
        alquiler:{
            idAlquiler : 0,
            accion    : 'nuevo',
            fechadeprestamo    : '',
            fechadedevolucion    : '',
            valor : '',
            msg       : ''
        }
    },
    methods:{
        guardarAlquileres(){
            fetch(`private/Modulos/alquileres/procesos.php?proceso=recibirDatos&alquiler=${JSON.stringify(this.alquiler)}`).then( resp=>resp.json() ).then(resp=>{
                this.alquiler.msg = resp.msg;
                this.limpiarAlquileres();
            });
        },
        limpiarAlquileres(){
            this.alquiler.idalquiler=0;
            this.alquiler.accion="nuevo";
            this.alquiler.fechadeprestamo="";
            this.alquiler.fechadedevolucion="";
            this.alquiler.valor="";
            this.alquiler.msg="";
        }
    }
});