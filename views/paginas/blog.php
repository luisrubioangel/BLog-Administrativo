<?php
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
/* echo "<pre>";
var_dump($ConteBlog);
echo "</pre>"; */
//debuguear($ConteBlogOrde);
?>

<div class="container-blog-principal">
 <section class="seccion-sugerencias">
<?php foreach($Blogsuge as $blogsu) :?>
  
  <a href="/blog?id=<?php echo $blogsu->id?>">        
        <div class="peque">
          <div class="">
            <div class=""><img src="imagenes/<?php echo $blogsu->imagen;?>" alt=""></div>
            <h3 class=""><?php echo $blogsu->Titulo;?></h3>
            <span><?php echo $blogsu->Descripcion?></span>
          </div>
        </div>
        </a>
<?php endforeach;?>
</section> 
<!-- seccion blog-autor -->
<section>
<div class="container-blog">
  <!-- contenedor de portada del blolg -->
      <div class="portado-blog">
        <h1 class="titulo-blog"><?php echo $Blog->Titulo?></h1>
        <p class="Descripcion"><?php echo $Blog->Descripcion;?></p>
        <img src="<?php echo "imagenes/".$Blog->imagen;?>" alt="imagen-de braso">
        <p><?php if ($fp = fopen(CARPETA_TEXTO.$Blog->txt, "r")) {
                          if ($fp) {
                            while(!feof($fp)) {
                              $linea =nl2br(fgets($fp));
                              echo $linea;
                              }
                              
                              fclose($fp);
                           }  
                        } else{
                          echo '<>no hay texto<>';
                        }?></p>
      </div>
      <!--fin de portado blog-->

      <?php 
      foreach($ConteBlog as $cont):
        
      ?> 
      <!-- inicio de contenido de blog -->
      <div class="seccion-blog">
        <h2><?php echo $cont->TituloSeccion?></h2>
        <?php
         if(boolval(file_exists(CARPETA_IMAGENES.$cont->imagen) && !empty($cont->imagen))):?>
        <img src="imagenes/<?php echo $cont->imagen?>" alt="">
        <?php endif;?>
         <?php
         if(boolval(file_exists('video/'.$cont->video) && !empty($cont->video))):
        
        ?>
        <video controls>
          <source src="video/<?php echo $cont->video;?>" type="video/mp4">
        </video>
        <?php endif;?>
        <p><?php 
        if ($fp = fopen(CARPETA_TEXTO.$cont->txt, "r")) {
                          if ($fp) {
                            while(!feof($fp)) {
                              $linea = nl2br(fgets($fp));
                              echo $linea;
                              }
                              
                              fclose($fp);
                           }  
                        } else{
                          echo '<>no hay texto<>';
                        }?></p>
     </div>
     <!-- fin de contenido de blog -->
      <?php endforeach;?>

</div>
 <!-- seccion de autor -->
<div>
  <h2 class="enunciado">Escrito por:</h2>
  <!-- inicio -->
   <!--seccion mostrar autor  -->
  
  <div class="container autor">
    <!-- seccion de contenido del autor -->
     <div>
       <figure>
       <img src="imagenes/<?php echo $autor->user_photo;?>" alt="foto">
       </figure>
       <p><?php echo $autor->user_name." ".$autor-> user_lastname; ?><br><span> <?php echo $autor->user_cargo?></span></p>
       <nav class="social">
              <a href=""><i class="fa fa-twitter "></i></a>
              <a href=""><i class="fa fa-facebook "></i></a>
              <a href=""><i class="fa fa-google-plus "></i></a>
              <a href=""><i class="fa fa-linkedin "></i></a>
       </nav>
     </div>
     <!-- fin de contenido del autor -->
  </div>
  <!-- fin de seccion de autor -->
</div>
</section>
<!--seccion derecha-blog -->

</div>
