var appalumnos = new Vue({
    el:'#frm-alumnos',
    data:{
        alumno:{
            idAlumno : 0,
            accion    : 'nuevo',
            nombre    : '',
            direccion : '',
            telefono  : '',
            codigo    : '',
            msg       : ''
        }
    },
    //este el metodo que se usa para guardar los datos a la base de datos
    methods:{ 

        guardarAlumnos(){
            fetch(`private/Modulos/alumnos/procesos.php?proceso=recibirDatos&alumno=${JSON.stringify(this.alumno)}`).then( resp=>resp.json() ).then(resp=>{         
               //con las siguientes condicionales
                if( resp.msg.indexOf("correctamente")>=0 ){//si la conexion se logro se mandara el mensaje de correcto
                    alertify.success(resp.msg);//mientras si la conexion falla se mostrara este mensaje de error
                } else if(resp.msg.indexOf("Error")>=0){
                    alertify.error(resp.msg);
                } else{
                    alertify.warning(resp.msg);// en forma de adventecia que se mostrara en pantalla
                }
            });
        },
        //aqui esta el metodo para limpiar el formalario de todos los datos que se allan 
        limpiarAlumnos(){
            this.alumno.idAlumno=0;
            this.alumno.accion="nuevo";
            this.alumno.nombre="";
            this.alumno.direccion="";
            this.alumno.telefono="";
            this.alumno.codigo="";
            this.alumno.msg="";
        }
    }
});