var appBuscarInscripciones = new Vue({
    el:'#frm-buscar-inscripcion',
    data:{
        misdatos:[],
        valor:''
    },
    methods:{
        buscarInscripcion:function(){
            fetch(`private/Modulos/inscripcion/procesos.php?proceso=buscarInscripcion&inscripciones=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misdatos = resp;
             });
            },
            modificarInscripcion:function(inscripciones){
                appinscripciones.inscripciones = inscripciones;
                appinscripciones.inscripciones.accion = 'modificar';
            },
            eliminarInscripcion:function(idInscripcion){
                fetch(`private/Modulos/inscripcion/procesos.php?proceso=eliminarInscripcion&inscripciones=${idInscripcion}`).then(resp=>resp.json()).then(resp=>{
                    this.buscarInscripcion();
                });
            }
        },
        created:function(){
            this.buscarInscripcion();
        }
    });