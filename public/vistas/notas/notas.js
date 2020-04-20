var appnotas = new Vue({
    el:'#frm-notas',
    data:{
        Nota:{
            idNota : 0,
            accion    : 'nuevo',
            codigo    : '',
            materia    : '',        
            msg       : ''
        }
    },
    methods:{
        guardarNotas(){
            fetch(`private/Modulos/notas/procesos.php?proceso=recibirDatos&nota=${JSON.stringify(this.nota)}`).then( resp=>resp.json() ).then(resp=>{
                this.nota.msg = resp.msg;
            });
        },
        limpiarNotas(){
            this.Nota.idNota=0;
            this.nota.accion="nuevo";
            this.nota.codigo="";
            this.nota.materia="";
            this.nota.msg="";
        }
    }
});