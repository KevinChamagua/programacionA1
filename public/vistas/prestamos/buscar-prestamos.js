var appBuscarPrestamos = new Vue({
    el:'#frm-buscar-prestamos',
    data:{
        misprestamos:[],
        valor:''
    },
    methods:{
        buscarPrestamo:function(){
            fetch(`private/Modulos/prestamos/procesos.php?proceso=buscarPrestamo&prestamo=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misprestamos = resp;
             });
            },
            modificarPrestamo:function(prestamo){
                appprestamos.prestamo = prestamo;
                appprestamos.prestamo.accion = 'modificar';
            },
            eliminarPrestamo:function(idPrestamo){
                fetch(`private/Modulos/prestamos/procesos.php?proceso=eliminarPrestamo&prestamo=${idPrestamo}`).then(resp=>resp.json()).then(resp=>{
                    this.buscarPrestamo();
                });
            }
        },
        created:function(){
            this.buscarPrestamo();
        }
    });