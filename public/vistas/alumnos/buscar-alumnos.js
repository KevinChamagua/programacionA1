var appBuscarAlumnos = new Vue({
    el:'#frm-buscar-alumnos',
    data:{
        misalumnos:[],
        valor:''
    },
    //Metodo para buscar el contenido de la base de datos 
    methods:{
        buscarAlumno:function(){
            fetch(`private/Modulos/alumnos/procesos.php?proceso=buscarAlumno&alumno=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misalumnos = resp;
             });
            },
            //metodo para modificar los datos de la base de datos
            modificarAlumno:function(alumno){
                appalumnos.alumno = alumno;
                appalumnos.alumno.accion = 'modificar';
            },
            //metodo para para eliminar datos de la base de datos
            eliminarAlumno:function(idAlumno){
                alertify.confirm("Mantenimiento Alumnos","Esta seguro de eliminar",
                ()=>{
                    fetch(`private/Modulos/alumnos/procesos.php?proceso=eliminarAlumno&alumno=${idAlumno}`).then( resp=>resp.json() ).then(resp=>{
                        this.buscarAlumnos();
                    });
                    alertify.success('Registro Eliminado correctamente.');//mensaje que se mostrara si la conexion fue con exito 
                },
                ()=>{
                    alertify.error('Eliminacion cancelada por el usuario.');//
                });
            }
        },
        //funcion de buscar alumnos
        created:function(){
            this.buscarAlumno();
        }
    });
    