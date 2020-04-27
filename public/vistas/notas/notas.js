var appnotas = new Vue({
    el:'#frm-notas',
    data:{
        nota:{
            idNota : 0,
            accion    : 'nuevo',
            codigo    : '',
            nombre    : '',
            notatotal : '',
            msg       : ''
        }
    },
    methods:{
        guardarNotas(){
            fetch(`private/Modulos/notas/procesos.php?proceso=recibirDatos&nota=${JSON.stringify(this.nota)}`).then( resp=>resp.json() ).then(resp=>{
                this.nota.msg = resp.msg;
                this.limpiarNotas();
            });
        },
        limpiarNotas(){
            this.nota.idNota=0;
            this.nota.accion="nuevo";
            this.nota.codigo="";
            this.nota.nombre="";
            this.nota.notatotal="";
            this.nota.msg="";
        }
    }
});