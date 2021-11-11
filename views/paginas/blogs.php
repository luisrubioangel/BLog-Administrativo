<section id="services">
    <div class="container wow fadeInUp">
      
      <div class="row">
        <div class="">
          <h2 class="section-title">Blogs</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Solucionamos con tecnológia.</p>
        </div>
      </div>
    </div>

      <div class="imagens-blog">
        <?php
        // debuguear($Blogs);
        foreach($Blogs as $blog):; 
        ?>
        <a href="/blog?id=<?php echo $blog->id;?>">
        <div class="2">
          <div class="container-img">
            <div class="pic"><img src="imagenes/<?php echo $blog->imagen?>" alt="nombre-de-imagen"></div>
            <h3 class="titulo-blog"><?php echo $blog->Titulo;?></h3>
            <span><?php echo $blog->Descripcion?></span>
            
          </div>
        </div>
        </a>
          <?php endforeach; 
          ?>    
        
         
      </div>
    
  </section>