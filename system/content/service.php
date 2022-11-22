<?php
if (substr($_SERVER['REQUEST_URI'], 8, 1)!=='/') {header('Location: /store'); die();}
$service = str_replace(['/', '#'], '', substr($_SERVER['REQUEST_URI'], 9));
try {
  $service = $mongo_db->store->services->findOne(array('name' => $service));
  if ($service===NULL) {
    header("Location: /store"); die();
  }
} catch(MongoConnectionException $e) {}
?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>UltimateCraft.net</title>
    <link rel="icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>
  <body>
    <nav class="store-categories" style="position: relative;">
      <a href="/" class="fas fa-chevron-left"></a>
      <ul class="nav-list">
        <li class="nav-li active"><a href="">Rangi</a></li>
        <!--<li class="nav-li"><a href="#">Monety</a></li>-->
        <!--<li class="nav-li"><a href="#">Gemy</a></li>-->
        <!--<li class="nav-li"><a href="#">Boostery</a></li>-->
      </ul>
    </nav>
    <main class="main">
      <div class="store space-around">
        <div class="store-content purchause-adapt">
          <a href="#" class="service">
            <div class="s-img"><img src="../../<?php echo $service['image']; ?>" alt="<?php echo $service['name']; ?>"></div>
            <div class="s-name">Ranga <span class="<?php echo $service['name']; ?>"><?php echo $service['display_name']; ?></span></div>
            <?php if (!isset($service['promotion'])) {
              echo '<div class="s-price">Koszt: '.number_format($service['price'], 2, ',').' PLN</div>';
            } else {
              echo '<div class="s-price">Koszt: '.number_format($service['promotion'], 2, ',').' PLN</div>
                    <div class="s-promotion previous-prince" style="text-align: center; text-decoration: line-through;">'.number_format($service['price'], 2, ',').' PLN</div>';
            } ?>
          </a>
          <div class="service-purchause">
            <div class="service-info">Aby dokonać zakupu za pomocą płatności przelew wpisz poniżej swój nick a następnie przejdź do płatności. Zamówienie realizowane jest natychmiastowo po zaakceptowaniu płatności przez system Twojego banku lub operatora.</div>
            <form action="/buy" method="post" class="service-form">
              <input type="hidden" name="service" value="<?php echo $service['name'];?>">
              <input type="text" name="nickname" placeholder="Wprowadź swój nickname"><br>
              <input type="text" name="email" placeholder="Wprowadź swój adres e-mail"><br>
              <span><input type="checkbox" name="accept-rules" required> Akceptuje zasady <a href="/regulamin">regulaminu</a>.</span><br>
              <input type="submit" value="Przejdź do płatności">
            </form>
            <div class="service-info returns">Nie przyjmujemy zwrotów! Przemyśl rozsądnie zakup!</div>
            <div class="service-payments">
              <h3>Płatności</h3>
              <div class="payments-box"><img src="../../assets/images/payments/bluemedia/logotypy/SVG/BM pion blue.svg" alt="BlueMedia"></div>
            </div>
          </div>
        </div>
      </div>
      </main>
    <?php include(E.'/footer.php');?>
  </body>
</html>