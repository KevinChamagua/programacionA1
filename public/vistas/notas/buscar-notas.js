var appBuscarNotas = new Vue({
    el:'#frm-buscar-notas',
    data:{
        misnotas:[],
        valor:''
    },
    methods:{
        buscarNotas:function(){
            fetch(`private/Modulos/notas/procesos.php?proceso=buscarNotas&notas=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misnotas = resp;
             });
            },
            modificarNotas:function(nota){
                appnota.nota = nota;
                appnota.nota.accion = 'modificar';
            },
            eliminarNota:function(idNota){
                fetch(`private/Modulos/notas/procesos.php?proceso=eliminarNota&nota=${idnota}`).then(resp=>resp.json()).then(resp=>{
                    this.buscarNota();
                });
            }
        },
        created:function(){
            this.buscarNota();
        }
    });