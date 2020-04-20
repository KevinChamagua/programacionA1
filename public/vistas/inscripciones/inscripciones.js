var appinscripciones = new Vue({
    el:'#frm-inscripciones',
    data:{
        Inscripcion:{
            idInscripcion : 0,
            accion    : 'nuevo',
            codigo    : '',
            nombre    : '',        
            msg       : ''
        }
    },
    methods:{
        guardarinscripciones(){
            fetch(`private/Modulos/inscripciones/procesos.php?proceso=recibirDatos&inscripciones=${JSON.stringify(this.inscripciones)}`).then( resp=>resp.json() ).then(resp=>{
                this.inscripciones.msg = resp.msg;
            });
        },
        limpiarInscripcions(){
            this.inscripciones.idInscripcion=0;
            this.inscripciones.accion="nuevo";
            this.inscripciones.codigo="";
            this.inscripciones.nombre="";
            this.inscripciones.msg="";
        }
    }
});