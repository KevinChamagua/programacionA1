            


document.addEventListener("DOMContentLoaded", (event) =>{
    const formAlumnos = document.querySelector("#frmAlumno");
    formAlumnos.addEventListener("submit", (e)=>{
        e.preventDefault(); 
        let codigo = document.querySelector("#txtCodigoAlumno").value,
            nombre = document.querySelector("#txtNombreAlumno").value,
            direccion = document.querySelector("#txtDireccionAlumno").value,
            telefono = document.querySelector("#txtTelefonoAlumno").value;
            //creo un array para guardar la informacion en un array para guardar mas de un datos del formulario
            var Guardarcodigo="codigo"+ ""+codigo;
            var Guardarnombre="nombre"+""+nombre;
            var Guardardireccion="direccion"+""+direccion;
            var Guardartelefono="telefono"+""+telefono;
            alert("Datos Guardados");
            //envio la datos a guardar localstorage
            if( 'localStorage' in window){
           var cod=localStorage.setItem(Guardarcodigo,codigo);
           var nomb=localStorage.setItem(Guardarnombre, nombre);
           var dire=localStorage.setItem(Guardardireccion, direccion);
           var tel=localStorage.setItem(Guardartelefono, telefono);
           //alerto al usuario que los datos se han guardado
           alert("Datos Guardados");
         } else {
            alert("almacenamiento en local NO soportado!!! Actualizate!");
        }
        console.log(codigo,nombre,direccion,telefono)
    });
    document.querySelector("#btnRecuperarAlumnos").addEventListener("click",(e)=>{
        if( 'localStorage' in window ){
           document.querySelector("#txtCodigoAlumno").value= window.localStorage.getItem("codigo");
           document.querySelector("#txtNombreAlumno").value= window.localStorage.getItem("nombre");
           document.querySelector("#txtDireccionAlumno").value= window.localStorage.getItem("direccion");
           document.querySelector("#txtTelefonoAlumno").value= window.localStorage.getItem("telefono");

        }  else {
            alert("almacenamiento en local NO soportado!!! Actualizate!");
        }
    
    });
});

/*document.addEventListener("DOMContentLoaded",init);*/

/*document.addEventListener("DOMContentLoaded",function(event){
    alert("Pagina cargo forma 2");
});*/

/*function init(event){
    alert("Hola la pagina a cargado");
}*/