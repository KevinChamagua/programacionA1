document.addEventListener("DOMContentLoader", e=>{
    const form =document.querySelector("#frmConversores");
    form.addEventListener("submit",event=>{
        event.preventDefault();
        let de=document.querySelector("#cboDE").nodeValue,
        a= document.querySelector("#ccboA").nodeValue;
        console.log(de, a, cantidad);
        let monedas ={
            "dolar":1,
            "euro":0.93,
            "quetzal":7.63,
            "lempira":24.9,
            "cordoba":34.19
        };
        let $res = document.querySelector("#lblRespuesta");
        $res.innerHTML = `Respuesta: ${ (monedas[a]/monedas[de]*cantidad).toFixed(2) }`;
    })
})