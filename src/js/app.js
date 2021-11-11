//codigo 2021/08/26

document.addEventListener('DOMContentLoaded', function() {
    sentinela();
    clickMenuMovil();
    animaciontext();
    advertecioCrear();
    editor();
    iniciarCrear();
    EditoresActualizar();
    sentinela3Wha();
    animacionMArcas()
    //enviarpost();
});

//funcion para funcion de click para que aparesca las secciones
function iniciarCrear(){
    let Secction =document.querySelector('#secciones');
let c =document.querySelector('#ActualizarSeccion');
if(c){
    document.getElementById("ActualizarSeccion").addEventListener("click", function( event ) {
        let cantidadSecction =document.querySelector('#secciones');
        console.log(cantidadSecction.value)
        crearsecciones(cantidadSecction.value);
    }, false);

   
}
let condition=document.getElementById("Actualizar-nuevas-Seccion");
if (condition) {
    document.getElementById("Actualizar-nuevas-Seccion").addEventListener("click", function( event ) {
        let cantidadSecction =document.querySelector('#secciones-nuevas');
        console.log(cantidadSecction.value);
        NuevasSecciones(cantidadSecction.value);
    }, false);
}

}
//sentinela para grande 
function sentinela2(){ 
    console.log('sentinela2..')  
    let  id2= setInterval(function(){
        let element = document.getElementById('mobile-nav-toggle');
        let elementStyle = window.getComputedStyle(element);
        let elementDisplay = elementStyle.getPropertyValue('display');
        if(elementDisplay=='none') 
        {   
    
           aparecerMenuDesktop();
            clearInterval(id2);
            console.log('fin de sentinela2')
            sentinela();
        }
    }, 1000); 

}
//aparecer menu Desktop
function aparecerMenuDesktop(){
    document.body.className='';
    console.log('menu desktop')
    
    let menu=document.querySelector('.container-header');
    
    if (menu) {
        menu.querySelector('nav').id='nav-menu-container';
       menu.querySelector('ul').className='nav-menu';
        //menuClon=menu;
            
       let menuhijo =document.querySelector('.menu-has-children');
       //menuhijo.querySelector("ul").style.display = "none";
       menuhijo.classList.toggle('fa');
       menuhijo.querySelector("i").classList.toggle('fa-angle-down');
       menuhijo.querySelector("i").classList.toggle('fa-chevron-down');
       menuhijo.querySelector("i").classList.toggle('fa-chevron-up');
       menuhijo.querySelector("i").style.padding='0';       
     }
}
//sentinela para telefona
function sentinela(){ 
    console.log('sentinela..')  
let id = setInterval(function(){
    let element = document.getElementById('mobile-nav-toggle');
    let elementStyle = window.getComputedStyle(element);
    let elementDisplay = elementStyle.getPropertyValue('display');
    if(elementDisplay=='block') 
    {   

       
        aparecerMenu();
        clearInterval(id);
        console.log('fin de sentinela1')
        sentinela2();
    }
}, 1000); 


}

//funcion click Menu movil
function clickMenuMovil(){
    let element = document.getElementById('mobile-nav-toggle'); 
    //
     element.addEventListener("click",function(e){
        
         
         e.preventDefault()
         
         if( document.body.className=='mobile-nav-active'){document.body.className='';}else{document.body.className='mobile-nav-active';}
         menuSeccion=document.getElementById('icon-menu');
         menuSeccion.classList.toggle("fa-bars");
         menuSeccion.classList.toggle("fa-times"); 
        },false);
        
       let menuhijo =document.querySelector('.menu-has-children');
       menuhijo.querySelector("ul").style.display = "none";
       menuhijo.classList.toggle('fa');
       menuhijo.querySelector("i").classList.toggle('fa-angle-down');
       menuhijo.querySelector("i").classList.toggle('fa-chevron-down');
       menuhijo.querySelector("i").style.padding='0';
 
       menuhijo.addEventListener("click",function(e){
          //  menuhijo.classList.toggle('menu-item-active');
           x = menuhijo.querySelector("ul");
           if (x.style.display === "none") {
             x.style.display = "block";
           } else {
             x.style.display = "none";
           }
           menuhijo.querySelector("i").classList.toggle('fa-chevron-down');
           menuhijo.querySelector("i").classList.toggle('fa-chevron-up');
         
       },false)
}
//funcion aparecer menu
function aparecerMenu(){
    console.log('sdsd','666')
    let menu=document.getElementById('nav-menu-container');
    if (menu) {
       menu.querySelector('ul').id='';
       menu.querySelector('ul').className='';
       //menuClon=menu;
       menu.id='mobile-nav';
   
        
    }
   console.log('menu apareecer...');
       
} 
//capturar click para la seccion de celular


//funcion para creacion de seccion en la pagina de secciones
function crearsecciones(cantidad){
    let d2 = document.getElementById('llenado-blog-div');
    //var d1 = document.getElementById('froma-1');
    d2.innerHTML='';
    for (let i = 1; i <= cantidad; i++) {
        
       console.log(i);
       html=`<fieldset id="froma-llenado-${i}">
       <div id="container-froma-llenado-${i}">
           <legend>LLenado de Blog ${i}</legend>
           <label for="seccion">nombre de seccion</label>
           <input type="text" name="seccion${i}" id="seccion">    
           <br/><p>imagen</p>      
           <input type="file" id="imageFile${i}" name="imagen${i}" accept=".jpg,.png">
           <br/><p>video</p>    
           <input type="file" id="videoFile${i}" name="video${i}" accept=".mp4">
           <br/> 
           <label for="contenido">contenido </label><br/>
           <div name="contenido${i}" id="contenido${i}" class="editor" cols="30" rows="10"></div>
           <textarea  class="ocultar" name="contenido${i}" id="textarea-contblog${i}" cols="30" rows="10"></textarea>
       </div>  
   </fieldset>`;
   
    setTimeout(()=>{
        let a=`contenido${i}`; 
        let b=`textarea-contblog${i}`;
        let contenidoi = document.getElementById(a);
        edi= QuillPersonalisado(contenidoi);
        cargartextarea('boton-crear',edi,b);
    },1000); 
   
    
  

   var d1 = document.getElementById('llenado-blog-div');
   d1.insertAdjacentHTML('beforeend',html);
    }
      
}
function NuevasSecciones(cantidad){
    //var d1 = document.getElementById('froma-1');
    let secciones=document.getElementById('secciones');
    let nuevaCantidad = Number(secciones.value)+Number(cantidad);
    console.log(nuevaCantidad);
    ee=document.getElementById('nuevas-secciones');
    ee.innerHTML='';
    for (let i = Number(secciones.value)+1; i <= nuevaCantidad; i++) {     
       html=`<fieldset id="froma-llenado-${i}">
       <div id="container-froma-llenado-${i}">
           <legend>LLenado de Blog ${i}</legend>
           <label for="seccion">nombre de seccion</label>
           <input type="text" name="seccion${i}" id="seccion">    
           <br/><p>imagen</p>      
           <input type="file" id="imageFile${i}" name="imagen${i}" accept=".jpg,.png">
           <br/><p>video</p>    
           <input type="file" id="videoFile${i}" name="video${i}" accept=".mp4">
           <br/> 
           <label for="contenido">contenido </label><br/>
           <div name="editor${i}" id="contenido-add${i}" cols="30" rows="10"></div>
           <textarea class="" name="contenido${i}" id="textarea-blog-Add${i}" cols="30" rows="10"></textarea>
       </div>  
   </fieldset>`;
   //let a=`contenido${i}`;
   //console.log(a,'xxxxx');


   /* setTimeout(() => {
    let contenidoi = document.getElementById(a);
    QuillPersonalisado(contenidoi);
   },1000); */
   setTimeout(()=>{
    let a=`contenido-add${i}`; 
    let b=`textarea-blog-Add${i}`;
    let contenidoi = document.getElementById(a);
    edi= QuillPersonalisado(contenidoi);
    cargartextarea('boton-actualizar',edi,b);
},1000); 



   var d1 = document.getElementById('nuevas-secciones');
   d1.insertAdjacentHTML('beforeend',html);
 }
      
}

 
function advertecioCrear(){
    pincel=document.querySelector('#secciones');
    
    if(pincel){
        BotonCrear=document.querySelector('button.boton-azul');
        BotonCrear.addEventListener("click",function(e){
            sentinela=document.querySelector('#videoFile1');
            if (!sentinela) {
                alert('Recuerde puede agregar mas secciones haciendo click en "ok"'); 
              // e.preventDefault();
            }
        });
    }
   
}

// funcion creacion de animacion de texto
function animaciontext(){
   
let animatxt =document.querySelector('span.rotating')
if(animatxt){
    let arraytxt=animatxt.textContent.split(',')
    animatxt.innerText=arraytxt[3];
    setInterval(() => {
        arraytxt.forEach((element,index) => {
            setTimeout(() => {
                animatxt.innerText=element;
                //console.log(element)
            }, index*1000);
        });
    
    }, 4000);

}
}