<?php
(function(){
echo "<nav class=\"nav\">\n\t<a href=\"#\" class=\"logo\"><img src=\"assets/images/logo.png\" alt=\"Logo\"></a>";
$nav = '
    <ul class="nav-list">
      <li class="nav-li"><a href="/">Strona główna</a></li>
      <li class="nav-li"><a href="/sklep">Sklep</a></li>
      <li class="nav-li"><a href="/kontakt">Kontakt</a></li>
      <li class="nav-li"><a href="/regulamin">Regulamin</a></li>
    </ul>
';
$pos = strpos($nav, $_SERVER['REQUEST_URI']); if ($pos!==false) {$pos-=11;} // $URI
$nav = substr($nav, 0, $pos) . ' active' . substr($nav, $pos); // Insert string into string
echo $nav;
echo '    <div class="nav-toggle">
<span></span>
<span></span>
<span></span>
</div>
</nav>
<script>document.querySelector(".nav-toggle").onclick=()=>{document.querySelector(".nav").classList.toggle("active");}</script>
';
})();