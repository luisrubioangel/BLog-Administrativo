///import { default as Quill } from "quill";

  function editor(){
    if(document.getElementById('contenido')){
      let container = document.getElementById('contenido');
      edi= QuillPersonalisado(container);

      cargartextarea('boton-crear',edi,'textarea-blog');
      cargartextarea('boton-actualizar',edi,'textarea-blog');
      
    }   
  }

  function cargartextarea(botonByid,edi,idtextArea){
    console.log('funcioin nueva')
    if (document.getElementById(botonByid)) {
      let boton=document.getElementById(botonByid);
    boton.addEventListener('click',(e)=>{
      console.log(edi.container.firstChild.innerHTML); 
      html=Aliatarforbd(edi);
      escribirAreaText(html,idtextArea);
      function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
      }
      console.log("esperando suba al textArea");
      sleep(2000).then(() => { console.log("se espero 2s"); });
      //e.preventDefault();

    });
      
    }
    

  }
  function QuillPersonalisado(container){
        var options = { 
        theme: 'snow',
        modules: {
          toolbar: [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline','blockquote','strike','code-block',{'align':['center','right','right','justify']}],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction
            ['image', 'code-block','video'],
            [{'color': ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466", 'custom-color']},
            { 'background': ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466", 'custom-color'] }],
            
          ]
        },
        placeholder: 'Compose an epic...',
        };
        let editor = new Quill(container, options);       
        console.log("editando editor",container);
        return editor;
  }
  function Aliatarforbd(edi){
    let edio=edi.container.firstChild.innerHTML; 
    return edio;
  }
  function escribirAreaText(html,id){
    let idtext =document.getElementById(id);
   // idtext.insertAdjacentHTML('beforeend',html);
    idtext.innerHTML=html;
    console.log(html,idtext);
}
function EditoresActualizar(){
  
  if (document.getElementById('secciones')) {
    setTimeout(()=>{
      secciones=document.getElementById('secciones');
      d = parseInt(secciones.value);
      console.log('editando la seccionde editor de actualizac',secciones.value,"++++++",d)
      
      for (let index = 1; index <= d; index++) {
        edi=QuillActualizar(index);
        console.log('editando la seccionde editor de actualizac',`${index}`)
        tranferencitexarea(index,edi);
      }
    },250);    
  }
}
function QuillActualizar(index){
  seccionActualizar=document.getElementById(`contenido${index}`);
  edi=QuillPersonalisado(seccionActualizar);
  return edi;
}
function tranferencitexarea(index,edi){
  setTimeout((e)=>{
    seccionActualizar=document.getElementById(`contenido${index}`);
    cargartextarea('boton-actualizar',edi,`text-area${index}`);
  },200)
 
}
