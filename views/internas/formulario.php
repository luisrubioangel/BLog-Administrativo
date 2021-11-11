   <!-- Seccion principal de formulario -->
   <?php
     if(boolval($Actualizar)){

              
            $ordenar=[];
            $ConteBlogOrde=[]; 
            foreach ($ConteBlog as $key => $value) {
              $value->seccion=intval($value->seccion);
              array_push($ordenar, $value->seccion);
            }

            sort($ordenar);

            foreach ($ordenar as $key1 => $value1) {
              
              foreach ($ConteBlog as $key => $value) {
                if ($value->seccion==$value1) {
                  array_push($ConteBlogOrde, $value);
                }
              }
            }

            $ConteBlog=$ConteBlogOrde;
            
            //debuguear($ConteBlogOrde);
  }
?>




<fieldset id="froma-1"> 
            
            <div id="container-froma-1">
              <legend>Descripción del blog </legend>
              <label for="titulo">Titulo</label>
              <input type="text" name="Titulo" id="titulo" required value="<?php echo $Blog ? $Blog->Titulo: '' ?>"><br/>
              <input type="file" name="imagen-titulo" accept="image/jpeg, image/png"/><br/>
              <?php
              if($Actualizar):?>
              <img src="/imagenes/<?php echo $Blog ? $Blog->imagen : ''; ?>" class="imagen-small">
              <?php endif;?>
              <label for="descripcion">Descripción</label><br/>
              <input type="text" name="Descripcion" id="descripcion" value="<?php echo $Blog ? $Blog->Descripcion:'';?>" >
              <label for="secciones">secciones</label><br/>
              <input type="number" name="Secciones" id="secciones"   value="<?php echo $Blog ? $Blog->Secciones:'';?>" ><br/>
              <?php
              //echo $Actualizar;
              if(!$Actualizar):?>
              <div id="ActualizarSeccion">
              <p>ok</p>  
              </div>
              <?php endif;?>
              <label for="contenido">contenido </label><br/>
              <div name="" class="editor" id="contenido" cols="30" rows="10" ><p></p><?php if($Actualizar):
                 if ($fp = fopen(CARPETA_TEXTO.$Blog->txt, "r")) {
                  if ($fp) {
                    while(!feof($fp)) {
                      $linea = fgets($fp);
                      echo $linea;
                      }
                      
                      fclose($fp);
                   }  
                } else{
                  echo '<>no hay texto<>';
                }
                         
              
                 endif
             ;?>
              </div>
              <textarea required class="ocultar" name="contenido" id="textarea-blog" cols="30" rows="10"></textarea>
            </div> 
</fieldset >
<div id="llenado-blog-div">
         <?php 
          if(boolval($Actualizar)):
            foreach($ConteBlog as $cont):?>
                   <fieldset id="froma-llenado-<?php echo $cont->seccion;?>">
                      <div id="container-froma-llenado-<?php echo $cont->seccion;?>">
                          <legend>LLenado de Blog <?php echo $cont->seccion;?></legend>
                          <label for="seccion">nombre de seccion</label>
                          <input type="text" name="seccion<?php echo $cont->seccion;?>" id="seccion<?php echo $cont->seccion;?>" value="<?php echo $cont->TituloSeccion; ?>">    
                          <br/><p>imagen</p>      
                          <input type="file" id="imageFile<?php echo $cont->seccion;?>" name="imagen<?php echo $cont->seccion;?>" accept=".jpg,.png">
                          <img src="imagenes/<?php  echo $cont->imagen;?>" alt="">
                          <br/><p>video</p>    
                          <input type="file" id="videoFile<?php echo $cont->seccion;?>" name="video<?php echo $cont->seccion;?>" accept=".mp4">
                          <br/> 
                          <video src="video/<?php  echo $cont->video;?>" controls></video><br/>
                          <label for="contenido">contenido </label><br/>
                          <div name="" id="contenido<?php echo $cont->seccion;?>" cols="30" rows="10"> <?php 
                       //echo CARPETA_TEXTO.$cont->txt;
                        
                        if ($fp = fopen(CARPETA_TEXTO.$cont->txt, "r")) {
                          if ($fp) {
                            while(!feof($fp)) {
                              $linea = fgets($fp);
                              echo $linea;
                              }
                              
                              fclose($fp);
                           }  
                        } else{
                          echo '<>no hay texto<>';
                        }                               
                        ?>
                        
                      </div>
                      <textarea class="ocultar" name="contenido<?php echo $cont->seccion;?>" id="text-area<?php echo $cont->seccion;?>" cols="30" rows="10"></textarea>
                      </div>  
                  </fieldset>
                  <input type="hidden" name="id<?php echo $cont->seccion?>" value="<?php echo $cont->id?>">
             <?php endforeach;?>
          <?php endif;?> 
</div>
          <!-- Seccion  segundaria de formulario -->
         