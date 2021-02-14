<!DOCTYPE html>
<?
session_start();
include("lib/librerias.php");
$buscar = $_GET['buscar'];
$id = $_GET['id'];

if (!empty($buscar)) {
	$script = 'noticia_hist("'.$buscar.'");';
}
//die($script);

//$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
//echo $enlace_actual;
?>

<html lang="es">
	<head>
	  <meta charset="utf-8">
	  <title>Alcaldia de Libertador - En Libertador Ahora es Cuando</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <meta name="description" content="Página Oficial de la Alcaldia del Municipio Libertador, Estado Carabobo">
	  <meta name="author" content="Sidhar Lozada">

		<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
		<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
		<!--script src="js/less-1.3.3.min.js"></script-->
		<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

<link rel="stylesheet" type="text/css" href="estilo.php" />
		<link href="css/style.css" rel="stylesheet">
		
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="fonts.css" rel="stylesheet" media="screen">
	    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet" media="screen">
	    <link href="bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"/>
	    <link href="css/awesome-bootstrap-checkbox.css" rel="stylesheet"/>
	    <link href="js/alert/themes/alertify.core.css" rel="stylesheet" />
	    <link href="js/alert/themes/alertify.default.css" id="toggleCSS"  rel="stylesheet"/>

		<link href="css/slide-animate.css" rel="stylesheet" type="text/css">	
		<link href="css/sppagebuilder.css" rel="stylesheet" type="text/css">	
		<link href="css/template.css" rel="stylesheet" type="text/css">
		<link href="css/preset3.css" rel="stylesheet" type="text/css" class="preset">

	 	
	    <link rel="shortcut icon" href="img/icono.png">

		<style>

		body {
		    overflow-x: hidden;

		}

		/* width */
		::-webkit-scrollbar {
		  width: 5px;
		  float: right;
		}

		/* Track */
		::-webkit-scrollbar-track {
		  background: #f1f1f1; 
		}
		 
		/* Handle */
		::-webkit-scrollbar-thumb {
		  background: #888; 
		}

		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
		  background: #555; 
		}

		 .cabecera{
		 width: 100%;
		
		 position:relative;

		 }

		</style>
	</head>

	<body  data-spy="scroll" data-target="#menu_principal" style="width: 100%; ">

		<div class="loaderr"></div>

				<!--<div class="containerd "> calss container quitado para que salga en pantalla completa-->
		<div class="muestraMenu" style="background-color: transparent;"></div>
    	<div  class="jumbotron-user "  ><!-- class borde borde quitado para que no salga -->
 			<?php  menuPublico($conn,$id,$buscar);    ?>


		 	<?if(empty($id) && empty($buscar)){?>   
		 		 <?
		          	$banner = new banner;
		            $resp = $banner->buscar($conn);
		            $cont = 0;

		         ?>

				<div id="inicio" class="cabecera"  >
					 <ul  class="cb-slideshow">
					 	<?
						 	foreach($resp as $respuesta){
			           		$cont++;
					 	?>
			            <li>
			                <span>
			                   		 <?=$respuesta->titulo?>
			                </span>
			                <!--<div>
			                    <h3>
									CAMPO CARABOBO                            
			                    </h3>
			                </div>-->
			            </li>

			            <?}?>

			        </ul>

					<img id="pot" class="logo_in" alt="Logo Alcaldia" src="img/logo_150x150.png" style="width:10%;max-width: 10%; ">
				</div>
			<?}?>


			<div class="row" style="background-color:#ffffff;"> 

				<div class="col-md-12 ">
				 	<div class="social">
				 		<ul  style="font-weight: bold;font-size: 2.5em; ">
							<li> 
								<div id="flecha" onclick="oculta()" class="icon-keyboard_arrow_left" style="cursor: pointer;">
										
								</div>															
							</li>
				 		</ul>
						<ul id="icon_social">
							<li> 
								<a href="https://www.facebook.com/alcaldiadelibertadorcarabobo" target="_blank" class="icon-facebook">
								</a>
							</li>
							<li><a href="https://twitter.com/AS_Libertador/" target="_blank" class="icon-twitter"></a></li>
							<!--<li><a href="https://plus.google.com/share?url=" target="_blank" class="icon-google-plus"></a></li>-->
							<li><a href="http://www.instagram.com/alcaldiadelibertador/" target="_blank" class="icon-instagram"></a></li>
							<li><a href="mailto:prensa@alcaldialibertador-carabobo.gob.ve" class="icon-mail"></a></li>
							<?if(empty($_SESSION['id'])){//para mostrar inicio de sesion?>
							<li><a href="inicio_sesion.php" target="_blank" class="icon-user consultaa"></a></li>
							<?}?>
						</ul>
					</div> 

					<? if(!empty($_SESSION['id'])){?>
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
					<?}?>
				</div>
			</div>
		</div>

		<div   style="background-color:#ffffff; position: relative; "><!-- fondo blanco-->
			<div class="containers bordess"  style="background-color:transparent; padding-bottom: 50px">
				<!-- Inicio rejilla-->
		 		<div class="row1 " id="topeNoticia"  style="background-color:transparent;">
					 <!--<div id="loading" class="" ><img src="img/loading.gif" width='250'></div>-->
					 <!-- Inicio Columna Izquierda-->
					<div class="muestraMenu" style="background-color: transparent;"></div>

					<div class="col-md-1a2  bordess" id="contenido">

						<?if(empty($id) && empty($buscar)){?> <!-- Inicio primera fila-->	



							
							  <div class="row content enlaces_busq" style="padding-bottom: 2em;height: 200px;">
							  	<div class="col-md-7 " >
									<span style="cursor: pointer; margin-left: 3em; font-weight: bold;font-size: 1.5em" onclick="openLink('http://www.alcaldialibertador-carabobo.gob.ve','Declaración en Linea')" >
										<a>Hacienda en Línea</a>
									</span>
							  	</div>
							    <div class="col-md-5 " >
							      <div class="form-group two-fields" style=" margin-left: 3em;">
							        <div class="input-group">
							        	<form>
							        	  <input placeholder="Buscar Contenido" required class="form-control input_busq" type="text" name="buscar" id="buscar">
								           <button type="submit" class=" input_boton">Buscar</button>
								        </form>
							        </div>
							      </div>
							    </div>
							  </div>


							

							<!--**************TRAMITES*****************-->
							<section  id="tramites" >
							<div class="row bloque content tramites_parallax " style="">

								<div class="separator" style="">
								 TRÁMITES Y SERVICIOS
							</div><br><br>
								<!-- PARA ACTIVAR UN MODULO A LA DERECHA
								<div class="col-md-10">
									<div class="row">-->
								         <?
								          	$noti = new noticias;
								            $resp = $noti->get_tramites($conn);
								            $cont = 0;
								            foreach($resp as $respuesta){
								            $cont++;
								         ?>

								         	<div class="col-md-2"  style="margin-bottom: 100px;" align="center">
								       			<a style="text-decoration: none;color: #423F3F" href="contenido_noticias.php?id=<?=$respuesta->id;?>">
								            		<div class="tramites">
								            			<img class="svg" alt="<?=$respuesta->titulo;?>" width="180" height="180" src="img/<?=$respuesta->url;?>">
								            			<br><?=$respuesta->titulo;?>
								            		</div>
								        		</a>
								    		</div> 

							        	<?}?>
									 <!-- PARA ACTIVAR UN MODULO A LA DERECHA       
							        </div>
							    </div>-->
								<!-- PARA ACTIVAR UN MODULO A LA DERECHA
							    <div class="col-md-2">
									<div class="row">
										<div class="col-md-12"  style="margin-bottom: 100px">

											<div class="modulo_der">
							               
												<img style="cursor: pointer;" onclick="openLink('http://www.alcaldialibertador-carabobo.gob.ve','Declaración en Linea')" src="img/hacienda.jpg" width="100%" height="115px">
											</div>
										</div>
									</div>
								</div>-->
							</div>
							</section>

							<!--**************SOMOS TOCUYITO*****************-->
							<div id="municipio" class="row bloque content somos_parallax " style="">

								<div class="separator" style="color: #FFFFFF">
								 SOMOS TOCUYITO
							</div><br><br>
								<!-- PARA ACTIVAR UN MODULO A LA DERECHA
								<div class="col-md-10">
									<div class="row">-->
								         <?
								          	$noti = new noticias;
								            $resp = $noti->get_somos($conn);
								            $cont = 0;
								            foreach($resp as $respuesta){
								            $cont++;
								         ?>

								    		<div class="col-md-3"  style="margin-bottom: 100px;" align="center">
												<div class="sppb-addon sppb-addon-feature sppb-text-center ">
													<div class="sppb-addon-content">
														<span style="display:inline-block;;">
															<img class="lazyload sppb-img-responsive" data-src="img/<?=$respuesta->url;?>" alt="">
														</span>
														<h3 class="sppb-feature-box-title" style="font-size:24px;line-height:24px;font-weight:300;">
															<?=$respuesta->titulo;?> 
														</h3>
														<div class="sppb-addon-text">
															<p>
																<span style="font-size: 12pt;">
																	<strong>
																		<a href="?id=<?=$respuesta->id;?>">Conoce los espacios públicos del Municipio Libertador<br>
																		</a>
																	</strong>
																</span>
															</p>
														</div>
													</div>
												</div>
								    		</div>
								    		<!--
								    		<div class="col-md-3"  style="margin-bottom: 100px;" align="center">
												<div class="sppb-addon sppb-addon-feature sppb-text-center ">
													<div class="sppb-addon-content">
														<span style="display:inline-block;;">
															<img class="lazyload sppb-img-responsive" data-src="img/eventos.png" alt="">
														</span>
														<h3 class="sppb-feature-box-title" style="font-size:24px;line-height:24px;font-weight:300;">Eventos
														</h3>
														<div class="sppb-addon-text">
															<p>
																<span style="font-size: 12pt;">
																	<strong>
																		<a href="#">Conoce los espacios públicos del Municipio Libertador<br>
																		</a>
																	</strong>
																</span>
															</p>
														</div>
													</div>
												</div>
								    		</div>
								    		<div class="col-md-3"  style="margin-bottom: 100px;" align="center">
												<div class="sppb-addon sppb-addon-feature sppb-text-center ">
													<div class="sppb-addon-content">
														<span style="display:inline-block;;">
															<img class="lazyload sppb-img-responsive" data-src="img/seguridadvial.png" alt="">
														</span>
														<h3 class="sppb-feature-box-title" style="font-size:24px;line-height:24px;font-weight:300;">Seguridad Vial
														</h3>
														<div class="sppb-addon-text">
															<p>
																<span style="font-size: 12pt;">
																	<strong>
																		<a href="#">Conoce los espacios públicos del Municipio Libertador<br>
																		</a>
																	</strong>
																</span>
															</p>
														</div>
													</div>
												</div>
								    		</div> -->

							        	<?}?>
									 <!-- PARA ACTIVAR UN MODULO A LA DERECHA       
							        </div>
							    </div>-->
								<!-- PARA ACTIVAR UN MODULO A LA DERECHA
							    <div class="col-md-2">
									<div class="row">
										<div class="col-md-12"  style="margin-bottom: 100px">

											<div class="modulo_der">
							               
												<img style="cursor: pointer;" onclick="openLink('http://www.alcaldialibertador-carabobo.gob.ve','Declaración en Linea')" src="img/hacienda.jpg" width="100%" height="115px">
											</div>
										</div>
									</div>
								</div>-->
							</div>

							<!-- Fin primera fila-->	


	<section id="alcaldia" class="content sppb-section  onepage-teams-section enlaces_busq_" style="padding-bottom: 200px; background-color: #362954">

	<div class="separator">
								<span>ALCALDIA </span>
							</div>
			<div class="sppb-container">

	<div class="row">
					<div class="col-sm-12">


						<div class="sppb-addon-container sppb-wow fadeInDown" style="color: rgb(255, 255, 255); visibility: hidden; animation-duration: 400ms; animation-delay: 150ms; animation-name: none;" data-sppb-wow-duration="400ms" data-sppb-wow-delay="150ms">
							<div class="sppb-teams-wrapper sppb-carousel sppb-slide " id="sppb-carousel1">
								<div class="sppb-carousel-inner">
									<div class="sppb-item active">
										<ul class="sppb-teams">
											
										<?
								          	$noti = new noticias;
								            $resp = $noti->get_alcaldia($conn);
								            $cont = 0;
								            foreach($resp as $respuesta){
								            $cont++;
								            if ($cont==1) {	$class = " first-item  active  "; }
								            else {	$class = ""; }

								            $contenido = substr($respuesta->noticia, 0, 200);
								         ?>
											<li class="sppb-team-wrapper <?=$class?>">
												<div class="sppb-team">
													<div class="sppb-team-image-wrapper">
														<img class="img-thumbnail sppb-img-responsive" src="img/<?=$respuesta->url;?>" alt="<?=$respuesta->titulo;?>">
													</div>
													<div class="sppb-team-info">
														<h3 class="sppb-team-name"> 
															<?=$respuesta->titulo;?>
														</h3>
														<!--<p class="sppb-designation"> 
															Juan Perozo 
														</p>-->
														<p class="sppb-introtext">

															<?=$contenido;?>...
															<br>
															<a href="?id=<?=$respuesta->id;?>">
																<font color="red" size="4">Ver más...
																</font>
															</a>
														</p>
														<!--<div class="sppb-team-social-icons">
															<a target="_blank" href="https://twitter.com/@ErikaPSUV">
																<i class="fa fa-twitter"></i>
															</a>
														</div>
													-->
													</div>
												</div>
											</li>
										<?}?>
										</ul>
									</div>
								</div>
							</div>
						</div>




					</div>
				</div>



</div>
</section>
							
							
								
							  <!-- Inicio Segunda fila-->

								<div id="noticias" class="row bloque content  " align="center" >

									<div class="separator" style="/*background: rgb(255,55,125); background: linear-gradient(90deg, rgba(255,55,125,1) 0%, rgba(255,55,155,1) 100%);*/">
									<span> GESTIÓN MUNICIPAL</span>
									</div><br><br>
							
							       <?$noti = new noticias;
								         $resp = $noti->get_resumen($conn,0,9,$find,$orden);
								        
								         $cont = 0;
								         foreach($resp as $respuesta){
								         $cont++;
							       ?>
								        <div   class="col-md-ç " onclick="noticia(<?=$respuesta->id;?>)">
								            <div style="width: 90%" class="roSw bloque " data-rotate-x="90deg" data-move-z="-500px" data-move-y="200px">
								            	<a style="text-decoration: none;color: #423F3F" href="contenido_noticias.php?id=<?=$respuesta->id;?>">
								               		<div  class="titulo_noti_gestion" style="">
								                		<img id="noti_gestion" style="" class="lazyload modulo_der" data-src="img_not/thumbs/<?=$respuesta->url;?>"  width="100%" height="280px">
										                <div class="titulo_n" style=""><!--62BAE2-->
										                	<?=$respuesta->titulo;?>
										                </div>
								               		 </div>
									                  
									                 <?if($cont==2){$cont=0;?> <? }?>
								            	</a>
								            </div>
								        </div>
							    	<?}?>
							    </div>
								<div style="border-bottom: 1px solid #C9C4C4; margin-bottom:3px;"></div> 
								<!-- Fin segunda fila-->
						<?}?>

						<div id="botonesCompartir">	</div>
					</div>
						<!-- Fin Columna Izquierda-->
				</div>
				<!-- Fin rejilla principal-->
			</div>


			<?if(empty($id) && empty($buscar)){?>

				<div id="multimedia" class=" content multimedia_parallax" align="center" >

							<div class="separator" style="color: #2d2149">
								<span>MULTIMEDIA</span>
							</div><br><br>
						
					
							
								
							<div class="row " style="width: 90%">
							
								<?
						          	$noti = new noticias;
						            $resp = $noti->get_multimedia($conn);
						            $cont = 0;
						            foreach($resp as $respuesta){
						            $cont++;
						         						            
						         ?>

								<div class="col-md-3">
									<a href="?id=<?=$respuesta->id;?>">
										<img src="img/<?=$respuesta->url;?>" alt="<?=$respuesta->titulo;?>">
									</a>
									
								</div>
								<?}?>

							</div>


							<br><br><br><br><br>
							



				</div>


				<div id="entes" class="content enlaces_busq" style="opacity: 1">
				<!-- Inicio cuarta fila-->
					<div class="separator">
						<span> ENTES</span>
					</div>

					<div class="linea bloque" ></div><br>

					<div class="row bloque"  align="center">
		               <?$noti = new noticias;
		                 $resp = $noti->get_institutos($conn);
		                 $cont = 0;
		                 foreach($resp as $respuesta){
		                 $cont++;
		               ?>
				            <div class="col-md-4"  style="margin-bottom: 10px">
				                <a style="text-decoration: none;color: #423F3F" href="contenido_noticias.php?id=<?=$respuesta->id;?>">
				                    <div class="instituto">
				                    	<img alt="<?=$respuesta->titulo;?>" class="lazyload" data-src="img/<?=$respuesta->url;?>" width="80%" height="60%">
				                    </div>
				                </a>
				            </div>

				        <?}?>
				    </div><br>
					<!-- fin cuarta fila-->
				</div>
			<?}?>
		</div>

		<?if(empty($id) && empty($buscar)){?>
			<!--<div class="container " style="background-color: transparent; width: 100%; height: 500px; border-bottom: 3px solid rgba(50, 115, 220, 0.5); border-top: 3px solid rgba(50, 115, 220, 0.5); ">
			</div>-->
		


		<div  style="background-color:#2d2149; position: relative; opacity: 1; padding-top: 50px;">
			

			<div class="container "  ><br>
			<!-- Inicio Noticias Secundarias-->
				
					
						<div style="border-top: 3px solid #1E7FDF; margin-bottom:1px; color: #ff387d;" class="titulo" >
							Historial de Noticias
						</div>
						<div class="linea" ></div>   
							<br>
						<div class="row" >
					       <?$noti = new noticias;
					         $resp = $noti->get_resumen($conn,9,19,$find,$orden);
					         $cont = 0;
					         foreach($resp as $respuesta){
					         $cont++;
					       ?>
						        <div class="col-md-4 resumen_noti" align="center" ><!--  onclick="noticia(<?=$respuesta->id;?>)"-->
						          		<a style="text-decoration: none;color: #423F3F" href="contenido_noticias.php?id=<?=$respuesta->id;?>">
							                <div  class="historial_noticias" >
							                	<img style="" class="lazyload modulo_der img_hist" data-src="img_not/thumbs/<?=$respuesta->url;?>" >
								                <div class="titulo_n"  style=""><!--62BAE2-->
								                	<?=$respuesta->titulo;?>
								                </div>
							                </div>					                  
							                <?if($cont==2){$cont=0;?> <? }?>
						            	</a>
						        </div>
						    <?}?>
					    </div>
						<div style="border-bottom: 1px solid #C9C4C4; margin-bottom:3px;"></div> 
					<!--
					<div class="col-md-3 ">
			            <div class="modulo_der bloque">
				            <a class="twitter-timeline"  href="https://twitter.com/AS_Libertador"  data-widget-id="466307695444647936">Tweets por @AS_Libertador</a>
				                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				        </div>
				        <div class="modulo_der bloque">
				            <a class="twitter-timeline" data-widget-id="421351574246416384" href="https://twitter.com/juanperozom">Tweets por @juanperozom</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			            </div>
			        </div>-->
				
			<!-- Fin Noticias Secundarias-->
			</div>
<!--
			<div style="border-bottom: 1px solid #C9C4C4; margin-bottom:3px;"></div>
			
			<div class="row clearfix">
				<div class="col-md-12 "></div>
			</div>
		    <div style="border-bottom: 3px solid #A40000; margin-bottom:1px;"></div>
		    <div style="border-bottom: 3px solid #27378c; margin-bottom:1px;"></div>
		    
		    <footer class="footer" style=" border-top: 3px solid #11A04D; ">
				<div style="position:relative" >
					<img src="img/pie_pagina3.png" width="100%">
				</div>	
		    </footer>-->
		</div>
	<?}?>




		<div class="foxoter "  style="background-color:#ff387d; position: relative; opacity: 1; padding-top: 30px; padding-bottom: 30px;">
	        <div class="panel-footer container" style="position: relative; ">
	            <div class="row clearfix"  >
	                <div class="col-md-4 ">
	                    
							<span  class="titulo" style="color:#10226e ;"> DIRECCIÓN</span>
							<br>
							<br>
							<p class="footer_cont">
	                    	Alcaldia de Libertador <br> 
	                    Calle Sucre entre Bolivar y Farriar, Diagonal a la Iglesia San Pablo Ermitaño.  
	                    Tocuyito, Carabobo<br>
	                    </p>
	                </div>
	                <div class="col-md-4 " align="center">
	                	<img src="img/logo.png" loading=lazy width="250px">
	                </div>
	                <div class="col-md-4 " align="center">
	                	<span  class="titulo" style="color:#10226e ;"> CORREO</span>
	                	<p class="footer_cont">
	                		atencionalusuario@alcaldialibertador-carabobo.gob.ve
	                	</p>
	                	<span  class="titulo" style="color:#10226e ;"> Telefonos</span>
	                	<p class="footer_cont">
	                		0800-5423782<br>
	                		0241-894.20.16
	                	</p>
	                </div>
	            </div>
		        <div class="row titulo" style="color:#10226e; font-size: 1.2em">
		        	<div class="col-md-6">
		        		<span > 
		            		CopyRigth ® 2020 | Todos los Derechos Reservados 
		            	</span>
		        	</div>
		        	<div class="col-md-6" style="text-align: right;">
		        		<span> 
		            		Desarrollado por la Unidad de Informática  
		            	</span>
		        	</div>

				</div>
	        </div>

	    </div>



		<!-- <? if(empty($id)){ ?>

		<div class="modal fade  modal-dialog-centered" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" >
					<div class="modal-header ">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						
						<img style="max-width: 100%; max-height:100%; " src="img\46db386d3d038359fa37b1f4c4291c45.jpg">
						
					</div>
				</div>
			</div>
		</div>

		<?}?> -->




		<div id="popup" style="display: none;">
		    <div class="content-popup ">
		        <div class="close"><a href="#" id="close"><img width="24" src="img/close.png"/></a></div>
		        <div id="contenidoPopup"></div>
		    </div> 
		</div>
		<div class="popup-overlay"></div>
		<span class="ir-arriba icon-keyboard_arrow_up"></span>

		<script  src="js/lazysizes.min.js" async="" > </script >

	</body>
</html>


    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.smoove.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/bPopup.js"></script>
   	<script type="text/javascript" src="js/sppagebuilder.js"></script>
	<script type="text/javascript" src="js/jquery.nav.js"></script>


<script type="text/javascript">

	    jQuery(document).ready(function($){

        $('.sppb-teams li').mouseenter(function(){
            $('.sppb-teams li').removeClass('active');
            $(this).addClass('active');
        }).mouseleave(function(){
            $('.sppb-teams li').removeClass('active');
            $('.sppb-teams li.first-item').addClass('active');
        });
    });


//alert("La resolución de tu pantalla es: " + screen.width + " x " + screen.height) ;
function oculta() {
	
	if($("#icon_social").is(":visible")){
		$("#flecha").removeClass("icon-keyboard_arrow_left");
		$("#flecha").addClass("icon-keyboard_arrow_right");
		$("#icon_social").hide("slow");
	}else{
		$("#flecha").removeClass("icon-keyboard_arrow_right");
		$("#flecha").addClass("icon-keyboard_arrow_left");
		$("#icon_social").show("slow");
	}
	//$("#icon_social").slideToggle("slow");
}


$(window).load(function() {
    $(".loader").fadeOut("slow");
});

alto = parseInt(screen.height) -100 +"px";


$(document).ready(function(){

	    $(".cabecera").css("height", alto);

});


$(document).ready(function(){
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
    
        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');
    
            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
    
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            
            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
    
            // Replace image with new SVG
            $img.replaceWith($svg);
    
        }, 'xml');
    
    });
});







$(document).ready(main);

var contador = 1;

function main(){
	$('.menu_bar').click(function(){
		// $('nav').toggle(); 

		if(contador == 1){
			$('nav').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%'
			});
		}

	});

};

//$(document).ready(function() {

//  $('#miModal').modal('show');

//});


            

<?

if(!empty($id)){?>


noticia('<?=$id?>');


<?}?>


//$('.bloque').smoove({offset:'12%'});

function openLink(link,pagina) {
  largura = screen.width; 
  altura = screen.height;
 if (link != '') window.open(link,pagina,'width='+largura+',height='+altura+',menubar=0, resizable=0, scrollbars=1, left = 0,top = 0');

}
/*
$(document).ajaxStart(function(){
    $("#loading").css("display", "inline");
});
$(document).ajaxComplete(function(){
    $("#loading").css("display", "none");
});*/

 
    
    
    

//para que el menu quede en el top
/*$(document).ready(function(){
    $(window).bind('scroll', function() {
		//largura2 = $("#bs-example-navbar-collapse-1").width(); 
		//alert("aqui" + largura2);
        $('#nav').css('width', 'auto');
        largura = $("#nav").width(); 

		$('#bs-example-navbar-collapse-1').css('width', largura);
      });
});*/


$(document).ready(function(){
 
	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
 
	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});
 
});

 
//crea el calendario    
/*Create();   
function Create()
{
setTimeout(function(){$('#calendario').load("Calendario.php?Ano="+$("#Ano").val());}, 300);
}
*/
function login () {
/*
   $('#contenido').load("consultas.php?form=inicio_sesion");
    window.location.replace('#topeNoticia');
*/

    $('#contenido').load("inicio_sesion.php");
    window.location.replace('#topeNoticia');
}

function func_link(url) {

   $('#contenido').load(""+url+"");
    window.location.replace('#topeNoticia');

}
function noticia(id) {

	if((id!='contacto')){
		pagina ="contenido_noticias.php?id=";
	//	alert("es numero");
	}else{
		pagina ="contacto.php?";
		//alert("no es numero");
	}
	//return false;

$('#contenido').empty();

  $('#contenido').load(pagina+""+id+"&verif=1", function() {
    $(this).fadeIn();
  });
  //window.location.replace('#topeNoticia');

}

function noticia_hist(find) {
//alert(find);
	//alert($("#buscar").val());
  $('#contenido').load("historial_noticias.php?pagina=1&find="+find, function() {
    $(this).fadeIn();
  });
  //window.location.replace('#topeNoticia');
}




$(document).ready(function () {

	<?if(!empty($id) || !empty($buscar)){?>
		$('nav').css('min-height','40px');
            $('.navbar-default .navbar-nav > li > a ').css('line-height','280%');
       		$('nav').removeClass("navbar-fixed-bottom");
            $('nav').addClass("navbar-fixed-top");
	<?} else{?>

   var inicio = 0;
   //Aqui indicamos la posición donde deberá hacer el cambio dependiendo de la condición
   var transicion = $('.muestraMenu');
  //Obtenemos las coordenadas de nuestro elemento mediante offset.
   var offset = transicion.offset();
 
       
       $(window).on('scroll', function () {
        
       //Cuando hagamos scroll 
 
       //Nuestra variable inicio contendra el alto del elemento que le hemos asignado
       inicio = $(this).scrollTop();
        
         //Aqui hacemos la transición
          if (inicio > offset.top) {
           /* $('nav').css('background-color','#fafafa');
            $('nav').css('border-color','1px solid #48874E');
            $('.navbar-brand').css('color','#000');
            $('.navbar-nav li a').css('color','#000');
            $('.navbar-toggle').css('color','#000');*/
            $('nav').css('min-height','40px');
            $('.navbar-default .navbar-nav > li > a ').css('line-height','280%');
       		$('nav').removeClass("navbar-fixed-bottom");
            $('nav').addClass("navbar-fixed-top");
            $('#pot').removeClass("logo_in");
            $('#pot').addClass("logo_out");
         }
     //Si no se cumple la condición , que nos deje nuestro menú como estaba
           else {
           /* $('nav').css('background-color','#fafafa');
            $('nav').css('border-color','1px solid #48874E');
            $('.navbar-brand').css('color','#000');
            $('.navbar-nav li a').css('color','#000');
            $('.navbar-toggle').css('color','#000');*/
            $('nav').css('min-height','100px');
            $('.navbar-default .navbar-nav > li > a ').css('line-height','400%');
			$('nav').removeClass("navbar-fixed-top");
			$('nav').addClass("navbar-fixed-bottom");
			$('#pot').removeClass("logo_out");
			
          } 
     }); //End function scroll
    
    <?}?>
   });



$(document).ready(function(){
  $('a.consulta').click(function(){
        $('#popup').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
         $('#contenidoPopup').load(this.href, function() {
            $(this).fadeIn();
          });
        return false;
    });
    
    $('#close').click(function(){
        $('#popup').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });
});


$(document).keyup(function(event){
        if(event.which==27)
        {
          $('#popup').fadeOut('slow');
          $('.popup-overlay').fadeOut('slow');
          
        }
    });



<? (!empty($_SESSION['id'])) ? buscaContenido($conn,$_SESSION['id']) :""; ?>

</script>
<script> <?=@$script;?></script>
