document.addEventListener("DOMContentLoaded", e=>{
    const form = document.querySelector("#frmConversores");
    form.addEventListener("submit", event=>{
        event.preventDefault();


        let de = document.querySelector("#cboDe").value,
            a = document.querySelector("#cboA").value,
            cantidad = document.querySelector("#txtCantidadConversor").value,
            opcion = document.getElementById('cboConvertirlo');

        console.log(de, a, cantidad);
        let monedas = {
            "dolar":1,
            "euro":0.93,
            "quetzal":7.63,
            "lempira":24.9,
            "cordoba":34.19 
        },
        tiempos={
            "horas":1,
            "minutos":60,
            "segundos":3600,
            "dias":0.0416667
        },
    pesos={
        "gramos":1000,
        "kilogramo":1,
        "libra":2.20462,
        "onzas":35.274,
        "toneladas":0.1,
    },
        longitudes={
            "milimetro":1000,
            "metro":1,
            "centimetro":100,
            "kilometro":0.001,
            "millas":0.000621371,
        };
        
       
        let $res = document.querySelector("#lblRespuesta");
        if(opcion.value == "moneda"){
            $res.innerHTML = `Respuesta: ${ (monedas[a]/monedas[de]*cantidad).toFixed(2) }`;
          } else if(opcion.value == "tiempo"){
            $res.innerHTML = `Respuesta: ${ (tiempos[a]/tiempos[de]*cantidad).toFixed(2) }`;
          } else if(opcion.value == "peso"){
            $res.innerHTML = `Respuesta: ${ (pesos[a]/pesos[de]*cantidad).toFixed(2) }`;
          } else if(opcion.value == "longitud"){
            $res.innerHTML = `Respuesta: ${ (longitudes[a]/longitudes[de]*cantidad).toFixed(2) }`;
          };
    });
});

function elegir_las_opciones(){
    let opcion =document.getElementById('cboConvertirlo'),
    de1 = document.getElementById('cboDe'),
    a1 = document.getElementById('cboA');

    de1.value="";
    a1.value="";
    de1.innerHTML="";
    a1.innerHTML="";

    
    if(opcion.value == "moneda"){
        var  array = ["dolar!Dolar","euro!Euro","quetzal!Quetzal","lempira!Lempira","cordoba!Cordoba"]; 
      } else if(opcion.value == "tiempo"){
        var array = ["horas!Horas","minutos!Minutos","segundos!Segundos","dias!Dias"];
      } else if(opcion.value == "pesos"){
        var array = ["gramos!Gramos","kilogramo!kilogramo","libra!Libra","onzas!Onzas","toneladas!Toneladas"];
      } else if(opcion.value == "longitud"){
        var array = ["milimetro!Milimetro","metro!Metro","centimetro!Centimetro","kilometros!Kilemtros","millas!Millas"];
      };
    
      for(var i=0;i<array.length;i++){ 
        var repair = array[i].split("!");
        var newop = document.createElement("option");
        newop.value = repair[0]
        newop.innerHTML = repair[1];
        de1.options.add(newop);
      };
      for(var i=0;i<array.length;i++){ 
        var repair = array[i].split("!");
        var newop = document.createElement("option");
        newop.value = repair[0]
        newop.innerHTML = repair[1];
        a1.options.add(newop);
      };
     }