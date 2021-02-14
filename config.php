<? session_start();

include("lib/librerias.php");

?> 

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="fonts.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="css/awesome-bootstrap-checkbox.css" rel="stylesheet"/>
    <link href="js/alert/themes/alertify.core.css" rel="stylesheet" />
    <link href="js/alert/themes/alertify.default.css" id="toggleCSS"  rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="css/estilo.php" />

<div class="row" style="background-color:#ffffff;"> 
    <div class="col-md-2 ">
        <div style="width: 200px">
            <?if(!empty($_SESSION['id'])){?>
                <div class="titulo" >Menu de Opciones</div>
                <div class="linea"></div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="">
                            <?=menuIzquierdo($conn,$_SESSION['id']);?>
                        </div>
                    </div>
                </div>
                <div style="border-bottom: 1px solid #C9C4C4; margin-bottom:3px;"></div>
            <?}?>
        </div>
    </div>

    <div class="col-md-10 " style="background-image:  url(img/logo_claro.png); background-size:50% auto; background-repeat: no-repeat; height: 600px" >
        <div id="contenido"></div>
    </div>
</div>    
    <div class=" bordee" style="background-color:#196938; color:#fff; font-weight: bold; position: fixed; bottom: 0; left: 0; z-index: 1000;"><!--Para futuras noticias-->
        <div class="col-md-12" align="left" >					            
            <span><?= ($_SESSION['nombre']." ".$_SESSION['apellido']); ?></span>  &nbsp; 
            <span>
            	<a href="config.php" target="_blank" title="Configuración" class="glyphicon glyphicon-cog" style="color:#0d2175;" ></a>
            </span> &nbsp;
            <span>
            	<a href="salir.php" title="Salir" class="glyphicon glyphicon-off" style="color:red;" > </a>
            </span>					            
        </div>
    </div>


<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.smoove.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/bPopup.js"></script>

    <script type="text/javascript">
        <? (!empty($_SESSION['id'])) ? buscaContenido($conn,$_SESSION['id']) :""; ?>
    </script>