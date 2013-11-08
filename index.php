<?php
    include 'php/conn.php';
?>

<?php
    include 'elements/header.php';
?>

<div class="container-fluid-dashboard-home">
  <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="images/qualilog1.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>Portal dos Embaixadores.</h1>
              <p>Relacionamento direto com as universidades.</p>
              
            </div>
          </div>
        </div>
        <div class="item">
          <img src="images/qualilog2.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>SMSr.</h1>
              <p>Comunicação ágil entre os envolvidos.</p>
              
            </div>
          </div>
        </div>
        <div class="item">
          <img src="images/qualilog3.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>Logistic Center.</h1>
              <p>Centralização dos processos administrativos.</p>
              
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
</div>
  


<?php
    include 'elements/footer.php'; 
?>
