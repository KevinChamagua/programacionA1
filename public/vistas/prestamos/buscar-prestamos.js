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
                alertify.confirm("Mantenimiento Prestamos","Esta seguro de eliminar",
                ()=>{
                    fetch(`private/Modulos/prestamos/procesos.php?proceso=eliminarPrestamo&prestamo=${idPrestamo}`).then( resp=>resp.json() ).then(resp=>{
                        this.buscarPrestamos();
                    });
                    alertify.success('Registro Eliminado correctamente.');
                },
                ()=>{
                    alertify.error('Eliminacion cancelada por el usuario.');
                });
            }
        },
        created:function(){
            this.buscarPrestamo();
        }
    });