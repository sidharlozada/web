<?php header("Content-type: text/css");
include("lib/librerias.php");
//Creo un array con varios colores
  	$banner = new banner;
    $resp = $banner->buscar($conn);
    $cantidad = count($resp);
    $cont = 0;
    $tiempo = 6;
    $timeanimation = 6 * $cantidad;
    foreach($resp as $respuesta){
	  $cont++;
	if($cont == 1){
?>
.cb-slideshow li:nth-child(<?=$cont?>) span { background-image: url(img/fondoInicio/<?=$respuesta->imagen?>); }

<?}else{?>

.cb-slideshow li:nth-child(<?=$cont?>) span {
    background-image: url(img/fondoInicio/<?=$respuesta->imagen?>);
    -webkit-animation-delay: <?=$tiempo?>s;
    -moz-animation-delay: <?=$tiempo?>s;
    -o-animation-delay: <?=$tiempo?>s;
    -ms-animation-delay: <?=$tiempo?>s;
    animation-delay: <?=$tiempo?>s;
}


.cb-slideshow li:nth-child(<?=$cont?>) div {
    -webkit-animation-delay: <?=$tiempo?>s;
    -moz-animation-delay: <?=$tiempo?>s;
    -o-animation-delay: <?=$tiempo?>s;
    -ms-animation-delay: <?=$tiempo?>s;
    animation-delay: <?=$tiempo?>s;
}


<?
  $tiempo = $tiempo+6;
  }
}?>

.cb-slideshow li span {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    color: transparent;
    background-size: cover;
    background-position: 50% 50%;
    background-repeat: none;
    opacity: 0;
    z-index: 0;
  -webkit-backface-visibility: hidden;
    -webkit-animation: imageAnimation <?=$timeanimation?>s linear infinite 0s;
    -moz-animation: imageAnimation <?=$timeanimation?>s linear infinite 0s;
    -o-animation: imageAnimation <?=$timeanimation?>s linear infinite 0s;
    -ms-animation: imageAnimation <?=$timeanimation?>s linear infinite 0s;
    animation: imageAnimation <?=$timeanimation?>s linear infinite 0s;
}
.cb-slideshow li div {
    z-index: 1000;
    position: absolute;
    /*bottom: 10px;*/
    top:15%;
    left: 0px;
    width: 100%;
    text-align: center;
    opacity: 0;
    -webkit-animation: titleAnimation <?=$timeanimation?>s linear infinite 0s;
    -moz-animation: titleAnimation <?=$timeanimation?>s linear infinite 0s;
    -o-animation: titleAnimation <?=$timeanimation?>s linear infinite 0s;
    -ms-animation: titleAnimation <?=$timeanimation?>s linear infinite 0s;
    animation: titleAnimation <?=$timeanimation?>s linear infinite 0s;
}