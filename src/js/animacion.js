function  animacionWhatsapp(){
    if (document.getElementById('icono-whatsapp')) {
        icono = document.getElementById('icono-whatsapp');
        
    }

}


function sentinela3Wha(){ 
    console.log('sentinela35..')  
    let  id2= setInterval(function(){
        let element = document.getElementById('icono-whatsapp');
        let topPos = element.getBoundingClientRect().top + window.scrollY;
        let leftPos = element.getBoundingClientRect().left + window.scrollX;
        let elementStyle = window.getComputedStyle(element);
        let elementOpacity = elementStyle.getPropertyValue('opacity');

        if(topPos>1330.71875) 
        {   
            console.log('fin de sentinela3 wha');
            element.style.opacity = "0.9";        
        }else{
            element.style.opacity = "0";
            console.log('fin de sentinela3 wha  elementStyle.opacity=0;');
        }

    }, 1000); 

}

function animacionMArcas(){
    window.addEventListener('scroll',(e)=>{
        let animation =document.getElementById('marcasDeEmpresa');
        let animationBlog =document.getElementById('services');
        let position =animation.getBoundingClientRect().top;
        let positionBlog =animationBlog.getBoundingClientRect().top
        let tamañoPantalla=window.innerHeight*0.9;
        if (position<tamañoPantalla) {
            animation.style.animation='slidein 1s ease-out';
        }
        if(positionBlog<tamañoPantalla){
            animationBlog.style.animation='aparicion 3s ease-out';
        }

    });
}