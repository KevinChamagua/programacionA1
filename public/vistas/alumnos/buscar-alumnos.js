var appBuscarAlumnos = new Vue({
    el:'#frm-buscar-alumnos',
    data:{
        misalumnos:[],
        valor:''
    },
    methods:{
        buscarAlumno:function(){
            fetch(`private/Modulos/alumnos/procesos.php?proceso=buscarAlumno&alumno=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misalumnos = resp;
             });
            },
            modificarAlumno:function(alumno){
                appalumnos.alumno = alumno;
                appalumnos.alumno.accion = 'modificar';
            },
            eliminarAlumno:function(idAlumno){
                alertify.confirm("Mantenimiento Alumnos","Esta seguro de eliminar",
                ()=>{
                    fetch(`private/Modulos/alumnos/procesos.php?proceso=eliminarAlumno&alumno=${idAlumno}`).then( resp=>resp.json() ).then(resp=>{
                        this.buscarAlumnos();
                    });
                    alertify.success('Registro Eliminado correctamente.');
                },
                ()=>{
                    alertify.error('Eliminacion cancelada por el usuario.');
                });
            }
        },
        created:function(){
            this.buscarAlumno();
        }
    });
    