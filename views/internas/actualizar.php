
  <div class="container">
    <h1 class="titulo-crear"> Actualizar Blog </h1>
  </div>
  <div class="container-formulario">
<form class="formulario-crear" method="post" role="form" enctype='multipart/form-data'>
      <!-- Seccion principal de formulario -->
      <?php include __DIR__.'/formulario.php';
       ?>
    <!-- Seccion  segundaria de formulario -->
    <fieldset>
   
      <label for="secciones-nuevas">Agregar Secciones</label><br/>
      <input type="number" name="Secciones-nuevas" id="secciones-nuevas"   value="" ><br/>
      <div id="Actualizar-nuevas-Seccion">
              <p>ok</p>  
       </div>       

    </fieldset>
    <div id="nuevas-secciones">

    </div>
  
    <div class="text-center"><button id="boton-actualizar" class="boton-azul tamaño"  type="submit">Actualizar</button></div>
</form>
  </div>
 
