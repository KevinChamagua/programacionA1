var appusuarios = new Vue({
    el:'#frm-usuarios',

    data:{
        usuario:{
            idUsuario : 0,
            accion    : 'nuevo',
            fusuario   : '',
            email     : '',
            password  : '',
            msg       : ''
        }
    },
    //este el metodo que se usa para guardar los datos a la base de datos
    methods:{ 

        guardarUsuarios(){
            fetch(`private/Modulos/registros/procesos.php?proceso=recibirDatos&usuario=${JSON.stringify(this.usuario)}`).then( resp=>resp.json() ).then(resp=>{         
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
        
    }
});