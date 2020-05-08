var appprestamos = new Vue({
    el:'#frm-prestamos',
    data:{
        prestamo:{
            idPrestamo : 0,
            accion    : 'nuevo',
            nombre    : '',
            direccion : '',
            telefono  : '',
            libro      : '',
            fprestamo  : '',
            fdevolucion : '',
            msg       : ''
        }
    },
    methods:{
        guardarPrestamos(){
            fetch(`private/Modulos/prestamos/procesos.php?proceso=recibirDatos&prestamo=${JSON.stringify(this.prestamo)}`).then( resp=>resp.json() ).then(resp=>{         
                if( resp.msg.indexOf("correctamente")>=0 ){
                    alertify.success(resp.msg);
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);
                }
            });
        },
        limpiarPrestamos(){
            this.prestamo.idPrestamo=0;
            this.prestamo.accion="nuevo";
            this.prestamo.nombre="";
            this.prestamo.direccion="";
            this.prestamo.telefono="";
            this.prestamo.libro="";
            this.prestamo.fprestamo="";
            this.prestamo.fdevolucion="";
            this.prestamo.msg="";
        }
    }
});