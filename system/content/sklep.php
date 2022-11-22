<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>UltimateCraft.net</title>
    <link rel="icon" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>
  <body>
    <nav class="store-categories" style="position: relative;">
      <a href="/" class="fas fa-chevron-left"></a>
      <ul class="nav-list">
        <li class="nav-li active"><a href="#">Rangi</a></li>
        <!--<li class="nav-li"><a href="#">Monety</a></li>-->
        <!--<li class="nav-li"><a href="#">Gemy</a></li>-->
        <!--<li class="nav-li"><a href="#">Boostery</a></li>-->
      </ul>
    </nav>
    <main class="main">
      <div class="store space-around">
        <div class="store-content">
          <?php
          foreach ($mongo_db->store->services->find() as $service) {
            echo 
'            <a href="service/'.$service['name'].'/" class="service">
              <div class="s-img"><img src="'.$service['image'].'" alt="'.strtolower($service['display_name']).'"></div>
              <div class="s-name">Ranga <span class="'.$service['name'].'">'.$service['display_name'].'</span></div>';
              if (!empty($service['promotion'])) {
                echo '<div class="s-price">'.number_format($service['promotion'], 2, ',').' PLN</div><div class="s-promotion previous-prince" style="text-align: center; text-decoration: line-through;">'.number_format($service['price'], 2, ',').' PLN</div>';
              } else {
                echo '<div class="s-price">'.number_format($service['price'], 2, ',').' PLN</div>';
              }
echo'            </a>';
          }
          ?>
        </div>
      </div>
    </main>

  </body>
</html>