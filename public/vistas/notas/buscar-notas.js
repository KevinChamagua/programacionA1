var appbuscar_notas = new Vue({
    el: '#frm-buscar-notas',
    data:{
        misnotas:[],
        valor:''
    },
    methods:{
        buscarNotas(){
            fetch(`private/Modulos/notas/procesos.php?proceso=buscarNota&nota=${this.valor}`).then( resp=>resp.json() ).then(resp=>{ 
                this.misnotas = resp;
            });
        },
        modificarNota(nota){
            appnotas.nota = nota;
            appnotas.nota.accion = 'modificar';
        },
        eliminarNota(idNota){
            fetch(`private/Modulos/notas/procesos.php?proceso=eliminarNota&nota=${idNota}`).then( resp=>resp.json() ).then(resp=>{
                this.buscarNotas();
            });
        }
    },
    created(){
        this.buscarNotas();
    }
});