<?php 
 if(!isset($_SESSION)){
  session_start();
};
?>
<!--mensajes -->  
  <?php

  if(boolval($mensaje)):?>
  <div class="container center">
      <h3 class="mensaje medio"><?php echo $mensaje." ".$_SESSION['name']?></h3>
  </div>
  <?php endif;?>
  
  <!-- -Crear Nuevo -->
   <div>
    <nav class="center">
        <a href="/crear" class="boton-azul">Nuevo Blog</a>
    </nav>
</div>
<!-- 8888888888888888 -->

  <section id="services">
    <div class="container wow fadeInUp">
      
      <div class="row">
        <div class="">
          <h2 class="section-title">Blogs</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Solucionamos con tecnológia.</p>
        </div>
      </div>

          <div class="imagens-blog">
        
      <?php foreach($Blogs as $blog):; 
        ?>
         
        <div class="2">
        <a href="/blog?id=<?php echo $blog->id;?>">
              <div class="container-img">
                <div class="pic"><img src="imagenes/<?php echo $blog->imagen?>" alt="ssss"></div>
                <h3 class="titulo-blog"><?php echo $blog->Titulo;?><?php $blog->id;?></h3>
                <span><?php echo $blog->Descripcion?></span>
              </div>
        </a>
              <div>
                      <form method="POST" class="w-100">
                          <input type="hidden" name="id" value="<?php echo $blog->id;?>">
                          <input type="submit" class="boton-rojo-block boton-rojo actualizar-eliminar" value="Eliminar">
                      </form>
                      <a href="/actualizar?id=<?php echo $blog->id;?>" class="boton-verde actualizar-eliminar">Actualizar</a>      
               </div>
        </div>
        
        
        
        



          <?php endforeach; 
          ?>  
        
             
      </div>
    </div>
  </section>

