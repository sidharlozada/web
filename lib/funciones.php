<? 
function menuIzquierdo($conn,$id_usuario)
{
$menu = new menu();
$dependencia = $menu->getAllModulosPorUsuario($conn,$id_usuario);
$nivel = 1;
//($_SERVER['REQUEST_URI']=='/libertador/system/') ? $url="" : $url="../";
if(is_array($dependencia)){ ?>
  <div class="accordion" id="leftMenu">
    <? foreach($dependencia as $dep){ ?>
        <div class="accordion-group">
            <div class="accordion-heading" data-toggle="collapse" data-parent="#leftMenu" href="#collapse<?=$dep->id?>" style="cursor:pointer">
                <a class="accordion-toggle" >
                    <i class="icon-list-alt"></i> <?=$dep->descripcion?>
                </a>
            </div>
            <div id="collapse<?=$dep->id?>" class="accordion-body collapse" style="height: 0px; ">
           
       <? $modulos = $menu->getAllOpsPorUsuarioModuloNivel($conn, $id_usuario, $dep->id, $nivel);
            if(is_array($modulos)){
              foreach($modulos as $mod) {  ?>
                <div class="accordion-group">
                  <?if($mod->tipo == 'V'){?>
                    <div class="accordion-inner">
                      <div class="list-group">
                        <a href="<?=$url.''.$mod->pagina?>" target="contenido" class="contenido_<?=$mod->descrip?> list-group-item"><?=$mod->descripcion?></a>
                      </div>                 
                    </div>
                  <?}else{?>

                  <div class="accordion-heading-sub" data-toggle="collapse" data-parent="#leftMenu" href="#collapse1<?=$mod->id?>" style="cursor:pointer"  onclick="cambiarClass('<?=$mod->id?>');">
                   <span id="capa<?=$mod->id?>" class="glyphicon glyphicon-folder-close" style="color:#646562;" ></span>
                    <a class="accordion-toggle" >
                      <i class="icon-list-alt"></i><?=$mod->descripcion?>
                    </a>
                  </div>
                  <div id="collapse1<?=$mod->id?>" class="accordion-body collapse" style="height: 0px; ">
                      <div class="accordion-group">
                          <? echo $menu->getSubCarpetas($conn, $id_usuario, $mod->id, '',$url); ?>
                      </div>
                  </div>
                  <?} ?>

                </div>
              <?
                }//foreach modulos
                }//is array modulos
              ?>
            </div>
        </div>
    <?  } //foreach dependencias ?>
       <!-- <div class="accordion-inner">
             <div class="list-group">
                 <a href="<?=$url?>salir.php" class="contenido list-group-item" style="padding-left:1px;">Salir</a>
            </div>                
        </div>-->                     
  </div>

<?
  }//is array dependencias 
  }//funcion menuIzquierdo();
?>
<?php function menuPublico($conn,$id,$buscar){ 
     $menu = new menu(); 
    $modulos = $menu->getAllModulosPublico($conn);
    ?>
    <!--
    <nav class="navbar navbar-default navbar-static-top navbar-fixed-top" style="margin-bottom: 0px; ">-->
    <nav id="menu_principal" class="navbar navbar-default navbar-static-top navbar-fixed-bottom " style="margin-bottom: 0px; ">

            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="navbar-brand" href="index.php">
                <img alt="Logo Alcaldia" src="img/logo_75x75.png" width="47"></a>
            </div>
    <?php
    if(is_array($modulos)){ ?>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1" >
							<ul class="nav navbar-nav ">
        <?php      foreach($modulos as $mod) { ?>
                   
                   <?php $operaciones = $menu->getOperacionesPublico($conn,$mod->id);
                          if(is_array($operaciones)){  ?>
                             <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$mod->descripcion?><strong class="caret"></strong></a>
                                    <ul class="nav dropdown-menu">
                         <?php foreach($operaciones as $op) {  ?>
                                      <li>
                                            <a href="<?=$url.''.$op->pagina?>"><?=$op->descripcion?></a>
                                        </li>
                               <?php  } ?>       
                                 </ul>
								</li>
                            <?php }else{  ?>
                          <li class="dropdown">
                            <?if(empty($id) && empty($buscar)){?>
                              <a href="<?=$mod->url?>"> <?=$mod->descripcion?></a>
                            <?}else{?>
                              <a href="http://localhost/web<?=$mod->url?>"> <?=$mod->descripcion?></a>
                            <?}?>
                          </li>
                            <?php  }
                                
                               ?> 
           <?php  } ?>
            </ul>
            <!--
<div class="" style="top: 5px; right: 20px; position: absolute;">

                            <form class="navbar-form navbar-left" role="search">
                                <div style="" class="form-group inner-addon right-addon">
                                   
                                    <input placeholder="Buscar" class="form-control input_busq" type="text" name="buscar" id="buscar">
                                    <button  class="btn btn-default input_boton">Buscar</button>
                                </div>
                                
                            </form>

              </div>-->

          </div>

       <?php  } ?>

   </nav>

<?php   }  ?>
<?
  function buscaContenido($conn,$id_usuario)
  {
    $menu = new menu(); 
    $operaciones = $menu->getOperaciones($conn,$id_usuario);

    if(is_array($operaciones)){
    foreach($operaciones as $ope) {  ?>
 
        $(document).ready(function(){
        $("a.contenido_<?=$ope->descrip?>").click(function(){
        
           $('#contenido').load(this.href, function() {
            $(this).fadeIn();
          });
          return false;
        });
      });
 <? 
    }//foreach modulos
    }//is array modulos
    }//funcion
?>



<? Function menu_horizontal(){ ?>

  <div class="navbar navbar-inverse">
      <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand active" href="inicio.php">Inicio</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="registro_notas.php" class="contenido_registro_notas">Registro de Notas</a></li>
              <li><a href="inscripcionCurricular.php" class="contenido_inscripcionCurricular">Inscripción Curricular</a></li>
              <li><a href="constancia_estudios.php" class="contenido_constancia_estudio">Constancia de Estudios</a></li>
              <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>-->
            </ul>
          </div><!--/.nav-collapse -->
     </div>
      </div>
<?php
}


function num2letras($num, $fem = false, $dec = true) {
    $numAux=$num;
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande");
   $matuni[2]  = "dos";
   $matuni[3]  = "tres";
   $matuni[4]  = "cuatro";
   $matuni[5]  = "cinco";
   $matuni[6]  = "seis";
   $matuni[7]  = "siete";
   $matuni[8]  = "ocho";
   $matuni[9]  = "nueve";
   $matuni[10] = "diez";
   $matuni[11] = "once";
   $matuni[12] = "doce";
   $matuni[13] = "trece";
   $matuni[14] = "catorce";
   $matuni[15] = "quince";
   $matuni[16] = "dieciseis";
   $matuni[17] = "diecisiete";
   $matuni[18] = "dieciocho";
   $matuni[19] = "diecinueve";
   $matuni[20] = "veinte";
   $matunisub[2] = "dos";
   $matunisub[3] = "tres";
   $matunisub[4] = "cuatro";
   $matunisub[5] = "quin";
   $matunisub[6] = "seis";
   $matunisub[7] = "sete";
   $matunisub[8] = "ocho";
   $matunisub[9] = "nove";

   $matdec[1] = "diez";
   $matdec[2] = "veint";
   $matdec[3] = "treinta";
   $matdec[4] = "cuarenta";
   $matdec[5] = "cincuenta";
   $matdec[6] = "sesenta";
   $matdec[7] = "setenta";
   $matdec[8] = "ochenta";
   $matdec[9] = "noventa";
   $matsub[3]  = 'mill';
   $matsub[5]  = 'bill';
   $matsub[7]  = 'mill';
   $matsub[9]  = 'trill';
   $matsub[11] = 'mill';
   $matsub[13] = 'bill';
   $matsub[15] = 'mill';
   $matmil[4]  = 'millones';
   $matmil[6]  = 'billones';
   $matmil[7]  = 'de billones';
   $matmil[8]  = 'millones de billones';
   $matmil[10] = 'trillones';
   $matmil[11] = 'de trillones';
   $matmil[12] = 'millones de trillones';
   $matmil[13] = 'de trillones';
   $matmil[14] = 'billones de trillones';
   $matmil[15] = 'de billones de trillones';
   $matmil[16] = 'millones de billones de trillones';

   $num = trim((string)@$num);
   if ($num[0] == '-') {
      $neg = 'menos ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++) {
      $n = $num[$c];
      if (! (strpos(".,'''", $n) === false)) {
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }

      }elseif (! (strpos('0123456789', $n) === false)) {
         if ($punt) {
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else

            $ent .= $n;
      }else

         break;

   }
   $ent = '     ' . $ent;
   if ($dec and $fra and ! $zeros) {
      $fin = ' con';
      $flag = 0;
      for ($n = 0; $n < strlen($fra); $n++) {
        if((((strlen($fra)<2) || ($fra[1]=='0')) && $flag == 0)){
            if($fra=='2'){
                $fin .= ' ' . $matuni[$fra."0"];
            }else{
                $fin .= ' ' . $matdec[$fra[0]];
            }
            $flag=1;
        } else {
            if($flag==0){
                 if (($s = $fra[$n]) == '0')
                    $fin .= ' cero';
                 elseif ($s == '1'){
                    if($fra[$n+1]!=''){
                        $fin .= ' ' . $matuni[$fra];
                        $flag=1;
                    }else
                        $fin .= $fem ? ' una' : 'un';
                 }else{

                    if($fra > 20 && $fra < 30){
                        if ($n==0 && $fra[$n+1]!=''){
                            $fin .= ' ' . $matdec[$s].'i';
                        }else{
                            $fin .= '' . $matuni[$s];
                        }
                    }else{
                        if ($n==0 && $fra[$n+1]!=''){
                            $fin .= ' ' . $matdec[$s].' y ';
                        }else{
                            $fin .= ' ' . $matuni[$s];
                        }                       
                    }
                }
            }
         }
      }
      $fin .= ' centimos';
   }else
      $fin = '';
   if ((int)$ent === 0) return 'Cero ' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
   while ( ($num = substr($ent, -3)) != '   ') { $var = substr($ent, -3);
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem) {
         $matuni[1] = 'una';
         $subcent = 'as';
      }else{
         $matuni[1] = $neutro ? 'un' : 'uno';
         $subcent = 'os';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00') {
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30) {
         $n3 = $num[2];
         if ($n3 != 0) $t = 'i' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
      $n = $num[0];
      if ($n == 1) {//echo substr(intval($numAux),-6);
        if(substr(intval($var),-6)=='100000' || substr(intval($var),-3)=='100'){
            $t = ' cien' . $t;
        }else{
            $t = ' ciento' . $t;
        }
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
      }
      if ($sub == 1) {

      }elseif (! isset($matsub[$sub])) {
         if ($num == 1) {
            $t = ' mil';
         }elseif ($num > 1){
            $t .= ' mil';
         }
      }elseif ($num == 1) {
         $t .= ' ' . $matsub[$sub] . 'on';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ones';
      }
      if ($num == '000') $mils ++;
      elseif ($mils != 0) {
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   return ucfirst($tex);
}

function obtieneMes($nmes){
  switch ($nmes) {
    case "1" : $mes = "Enero"; break;
    case "2" : $mes = "Febrero"; break;
    case "3" : $mes = "Marzo"; break;
    case "4" : $mes = "Abril"; break;
    case "5" : $mes = "Mayo"; break;
    case "6" : $mes = "Junio"; break;
    case "7" : $mes = "Julio"; break;
    case "8" : $mes = "Agosto"; break;
    case "9" : $mes = "Septiembre"; break;
    case "10" : $mes = "Octubre"; break;
    case "11" : $mes = "Noviembre"; break;
    case "12" : $mes = "Diciembre"; break;
  }
  return $mes;
}


function guardafecha($fecha){
  $ano = substr ($fecha, 6, 4);
  $mes = substr ($fecha, 3, 2);
  $dia = substr ($fecha, 0, 2);
  $fecha="$ano-$mes-$dia";

  if($fecha=='--'){ $fecha=''; }
  
  return $fecha;
  
}

function muestrafecha($fecha){
  $fecha = (empty($fecha)) ? date("Y-m-d") : $fecha;
  $x = date("d/m/Y", strtotime($fecha));
  return $x;
}

function muestrafloat($monto){//se7ho
  return number_format($monto, 2, ',', '.');
}

//Para mostrar las cedulas
function muestracedula($ced){//se7ho
  return number_format($ced, 0, ',', '.');
}

//Para mostrar las retenciones que tienen mas de 3 decimales
function muestrafloat3($monto){//se7ho
  return number_format($monto, 3, ',', '.');
}

function guardafloat($monto){//se7ho
  return str_replace(',','.',str_replace('.','',$monto));
}

function bucatransaccion($connlib,$abreviacion)
{
  
   /* $q="SELECT c.descripcion, c.id, d.accion  ";
    $q.="FROM tributaria.ramo_imp AS a  ";
    $q.="INNER JOIN tributaria.ramo_transaccion AS b ON a.id=b.id_ramo_imp  ";
    $q.="INNER JOIN tributaria.tipo_transaccion AS c ON b.id_tipo_transaccion = c.id  ";
    $q.="INNER JOIN vehiculo.transaccion_vehiculo AS d ON c.id = d.id_transaccion  ";
    $q.="WHERE a.abreviacion = '$abreviacion'  order by 3 ";*/
    $q="SELECT codigo AS id, impuesto AS descripcion FROM public.impuestos WHERE codigo ILIKE '0500%' ORDER BY 1 ";
    //die($q);
        $transacciones = $connlib->Execute($q);
        $i=0;
          while(!$transacciones->EOF){
            $relTransacion[$i] = array();
            $relTransacion[$i][0] = $transacciones->fields['id'];
            $relTransacion[$i][1] = $transacciones->fields['descripcion'];
            $relTransacion[$i][2] = 0;
        
             $transacciones->movenext();
            $i++;
          }
           return $relTransacion;

}

function getLastId($conn, $id, $tabla){
  $q = "SELECT max($id) AS id FROM $tabla ";
  if($r = $conn->execute($q))
    return $r->fields[$id];
  else
    return false;
}


function getCorrelativo($conn, $campo, $tabla, $id){
  $q = "SELECT $campo FROM $tabla ORDER BY $id desc";
  if($r = $conn->execute($q)){
    $Codigo=$r->fields[$campo];
    $Digitos=strlen($r->fields[$campo]);
    do{
      $Codigo=$Codigo+1;
      $Digitos2=strlen($Codigo);
      while($Digitos>$Digitos2){
        $Codigo="0".$Codigo;
        $Digitos2=strlen($Codigo);
      }
      $r = $conn->execute("SELECT $campo FROM $tabla WHERE $campo='$Codigo'");
    }while(!$r->EOF);
    return $Codigo;
  }
  else
    return false;
}


function archivo_txt($cod,$conn){

        $archivo=$_FILES['archivo']['name'];
        $a = explode('.',$archivo);
        // Obtengo el ultimo elemento del arreglo
        $b = end($a);

       // Convierto a minusculas
        $c = strtolower($b);

      if($c=='txt'){
        $nom = $cod.".".$c;

        $_FILES['archivo']['name']= $nom;
        $dar=$_FILES['archivo']['name'];
        $dire="txt/".$dar;

        if(is_uploaded_file($_FILES['archivo']['tmp_name'])){

        move_uploaded_file($_FILES['archivo']['tmp_name'],$dire);
        }


      return 1;
      }else{

        return 0;
      }

}

function FechaIni($Contrato,$Operador,$Fecha,$FormatoEnt,$FormatoSal){
  $Fecha=explode ($Operador ,$Fecha);
  if($FormatoEnt==1){
    $DiaIndex=0;
    $MesIndex=1;
    $AnoIndex=2;
  }
  if($FormatoEnt==2){
    $DiaIndex=2;
    $MesIndex=1;
    $AnoIndex=0;
  }
  $UltimoDiaMes=DiaFin($Fecha[$MesIndex]);
  switch(true){
    case ($Contrato=="0" OR $Contrato=="3"):{
      $Dia=$Fecha[$DiaIndex]+1;
      if($Dia>$UltimoDiaMes){
        $Dia=$Dia-$UltimoDiaMes;
        $Mes=$Fecha[$MesIndex]+1;
        if($Mes<10 && strlen($Mes)<2){
          $Mes="0".$Mes;
        }
        if($Mes>12){
          $Mes='01';
          $Ano=$Fecha[$AnoIndex]+1;
        }else{
          $Ano=$Fecha[$AnoIndex];
        }
      }else{
        $Mes=$Fecha[$MesIndex];
        $Ano=$Fecha[$AnoIndex];
      }
      if($Dia<10 && strlen($Dia)<2){
        $Dia="0".$Dia;
      }
      return $Dia."/".$Mes."/".$Ano;
    }
    case $Contrato=="1":{
      if($Fecha[$DiaIndex]=='15'){
        return "16/".$Fecha[$MesIndex]."/".$Fecha[$AnoIndex];
      }
      if($Fecha[$DiaIndex]==$UltimoDiaMes){
        $Mes=$Fecha[$MesIndex]+1;
        if($Mes>12 ){
          $Mes='01';
          $Ano=$Fecha[$AnoIndex]+1;
        }else{
          $Ano=$Fecha[$AnoIndex];
        }
        if($Mes<10 && strlen($Mes)<2){
          $Mes="0".$Mes;
        }
        return "01/".$Mes."/".$Ano;
      }
    }
    case $Contrato=="2":{
      $Mes=$Fecha[$MesIndex]+1;
      if($Mes>12 ){
        $Mes='01';
        $Ano=$Fecha[$AnoIndex]+1;
      }else{
        $Ano=$Fecha[$AnoIndex];
      }
      if($Mes<10 && strlen($Mes)<2){
        $Mes="0".$Mes;
      }
      return "01/".$Mes."/".$Ano;
    }
  }
}
function FechaFin($Contrato,$Operador,$Fecha,$FormatoEnt,$FormatoSal,$conn = -1,$ContratoC=-1){
  $Fecha=explode($Operador ,$Fecha);
  if($FormatoEnt==1){
    $DiaIndex=0;
    $MesIndex=1;
    $AnoIndex=2;
  }
  if($FormatoEnt==2){
    $DiaIndex=2;
    $MesIndex=1;
    $AnoIndex=0;
  }
  $UltimoDiaMes=DiaFin($Fecha[$MesIndex]);
  switch($Contrato){
    case "0":{
      $Dia= $Fecha[$DiaIndex]+6;
      if($Dia>$UltimoDiaMes){
        $Dia=$Dia-$UltimoDiaMes;
        $Mes=$Fecha[$MesIndex]+1;
        if($Mes<10 && strlen($Mes)<2){
          $Mes="0".$Mes;
        }
        if($Mes>12){
          $Mes='01';
          $Ano=$Fecha[$AnoIndex]+1;
        }else{
          $Ano=$Fecha[$AnoIndex];
        }
      }else{
        $Mes=$Fecha[$MesIndex];
        $Ano=$Fecha[$AnoIndex];
      }
      if($Dia<10 && strlen($Dia)<2){
        $Dia="0".$Dia;
      }
      return $Dia."/".$Mes."/".$Ano;
    }
    case "1":{
      if($Dia<10 && strlen($Dia)<2){
        $Dia="0".$Dia;
      }
      if($Fecha[$DiaIndex]=='01'){
        return "15/".$Fecha[$MesIndex]."/".$Fecha[$AnoIndex];
      }
      if($Fecha[$DiaIndex]=='16'){
        return $UltimoDiaMes."/".$Fecha[$MesIndex]."/".$Fecha[$AnoIndex];
      }
    }
    case "2":{
      return $UltimoDiaMes."/".$Fecha[$MesIndex]."/".$Fecha[$AnoIndex];
      break;
    }
    case "3":{
      $q = "SELECT * FROM rrhh.nomina WHERE cont_cod=$ContratoC";
      $r = $conn->Execute($q);
      return !$r->EOF ? muestrafecha($r->fields['nom_fec_fin']) : date("d/m/Y");
    }
  }
}

function DiaFin($Mes,$Año="2014"){
  switch ($Mes)
  {
    Case 01:
      $DiaFin = "31";
      break;
    Case 02 :
      $DiaFin = (($Año % 4 == 0) && ($Año % 100 != 0)) ? "29" : "28";
      break;
    Case 03:
      $DiaFin = "31";
      break;
    Case 04:
      $DiaFin = "30";
      break;
    Case 05:
      $DiaFin = "31";
      break;
    Case 06:
      $DiaFin = "30";
      break;
    Case 07:
      $DiaFin = "31";
      break;
    Case "08":
      $DiaFin = "31";
      break;
    Case "09":
      $DiaFin = "30";
      break;
    Case 10:
      $DiaFin = "31";
      break;
    Case 11:
      $DiaFin = "30";
      break;
    Case 12:
      $DiaFin = "31";
      break;
  }
  return($DiaFin);
}


// 06.03.07.CEPV.EN
  function getPeriodoVacacionesValido($conn,$Trabajador,$EstTrab,$FechaIni,$FechaFin)
  {
  $valido=true;
  if($EstTrab==1){
    $q = "SELECT * FROM rrhh.preparar_vac WHERE tra_cod=$Trabajador";
    $rFVac = $conn->Execute($q);
    if(!$rFVac->EOF){
      $FechaIniVac=$rFVac->fields['fecha_ini'];
      $FechaFinVac=$rFVac->fields['fecha_fin'];
      $Disfrute=$rFVac->fields['disfrute'];
    }
    else{
      $q = "SELECT * FROM rrhh.vacaciones WHERE tra_cod=$Trabajador";
      $rFVac = $conn->Execute($q);
      $FechaIniVac=$rFVac->fields['vac_fec_ini'];
      $FechaFinVac=$rFVac->fields['vac_fec_fin'];
      $Disfrute=$rFVac->fields['disfrute'];
    }
    $diasI= intval((strtotime($FechaIniVac)-strtotime(guardafecha($FechaIni)))/86400);
    $diasF= intval((strtotime(guardafecha($FechaFin))-strtotime($FechaFinVac))/86400);
    if(!empty($FechaIniVac) && ($diasI<=0 && $diasF<=0) && $Disfrute!='0'){
      $valido=false;
    }
  }
  return $valido;
  }


  function Formula($conn,$CFormula,$Trabajador,$Contrato,$FechaIni,$FechaFin,$FechaIngresoTrabajador,$FechaEgresoTrabajador){
  //BUSCO LOS CODIGOS DE LAS VARIABLES EN LA FORMULA DEL CONCEPTO
  $IndexVar=0;
  for($i=0;$i<strlen($CFormula);$i++){
    $CharActual=substr($CFormula,$i,1);
    if($CharActual=="["){
      $Variable="";
      while($CharActual!="]"){
        $Variable.=$CharActual;
        $i++;
        $CharActual=substr($CFormula,$i,1);
      }
      $Variable.=$CharActual;
      $IndexVar++;
      $Variables[$IndexVar]=$Variable;
    }
  }
  //BUSCO LOS VALORES DE LAS VARIABLES EN DB.
  for($i=1;$i<=$IndexVar;$i++){
    $TipoVar=substr($Variables[$i],1,4);
    $Codigo=explode("_",$Variables[$i]);
    $Codigo=explode(":",$Codigo[0]);
    $Valor[$i]= BuscarValor($conn,$TipoVar,$Codigo[1],$Trabajador,$Contrato,$FechaIni,$FechaFin,$FechaIngresoTrabajador,$FechaEgresoTrabajador);

  }
  for($i=1;$i<=$IndexVar;$i++){
    $CFormula= str_replace($Variables[$i],$Valor[$i],$CFormula);
  }
  return $CFormula;
}

function BuscarValor($conn,$TipoVar,$Codigo,$Trabajador,$Contrato,$FechaIni,$FechaFin,$FechaIngresoTrabajador,$FechaEgresoTrabajador){
  switch($TipoVar){
    case "Vari": { //VARIABLES
      $q = "SELECT var_tra_val AS valor FROM rrhh.var_tra WHERE var_cod=$Codigo AND tra_cod=$Trabajador";
      $rAux = $conn->Execute($q);
      return (!$rAux->EOF ? $rAux->fields['valor'] : 0);
      //ESTE CODIGO LO UTILICE PARA GENERAR LOS ACUMULADOS EN BASE A HISTORICOS SN
/*      $MES=explode("/",$FechaIni);
      $MES=$MES[1];
      $q = "SELECT sum(B.var_tra_val) as valor FROM rrhh.historial_nom AS A INNER JOIN rrhh.hist_nom_var_tra AS B On A.int_cod=B.hnom_cod WHERE to_char(A.nom_fec_fin,'MM') = '$MES' AND B.tra_cod=$Trabajador AND B.var_cod=$Codigo";
      $rAux = $conn->Execute($q);
      if(!$rAux->EOF){
        if(!(empty($rAux->fields['valor']) || $rAux->fields['valor']==0)){
          return $rAux->fields['valor'];
        }else{
          $q = "SELECT var_tra_val AS valor FROM rrhh.var_tra WHERE var_cod=$Codigo AND tra_cod=$Trabajador";
          $rAux = $conn->Execute($q);
          return (!$rAux->EOF ? $rAux->fields['valor'] : 0);
        }

      }else{
        $q = "SELECT var_tra_val AS valor FROM rrhh.var_tra WHERE var_cod=$Codigo AND tra_cod=$Trabajador";
        $rAux = $conn->Execute($q);
        return (!$rAux->EOF ? $rAux->fields['valor'] : 0);
      } */
      //ESTE CODIGO LO UTILICE PARA GENERAR LOS ACUMULADOS EN BASE A HISTORICOS EN

    }
    case "Cons": { //CONSTANTES
      $q = "SELECT cons_val AS valor FROM rrhh.constante WHERE int_cod=$Codigo";
      $rAux = $conn->Execute($q);
      return (!$rAux->EOF ? $rAux->fields['valor'] : 0);
    }
    case "Conc": { //CONCEPTOS ACUMULADOS
      $q = "SELECT (SUM(conc_val) - (CASE WHEN (SELECT sum(B.conc_val) AS conc_val FROM rrhh.pago_acumulado AS A INNER JOIN rrhh.pago_acumulado_conc AS B ON A.int_cod=B.pago_acum_cod WHERE A.tra_cod=$Trabajador AND B.conc_cod=$Codigo) IS NULL THEN 0 ELSE (SELECT sum(B.conc_val) AS conc_val FROM rrhh.pago_acumulado AS A INNER JOIN rrhh.pago_acumulado_conc AS B ON A.int_cod=B.pago_acum_cod WHERE A.tra_cod=$Trabajador AND B.conc_cod=$Codigo) END)) AS total FROM rrhh.acum_tra_conc WHERE tra_cod=$Trabajador AND conc_cod=$Codigo";
      $rAux = $conn->Execute($q);
      if(!$rAux->EOF){
        return (!empty($rAux->fields['total']) ? $rAux->fields['total'] : 0);
      }else{
        return 0;
      }
    }
    case "Gvar": { //VARIABLES GLOBALES
      switch($Codigo){
        case 1: { //CALCULO DE LA VARIABLE GLOBAL: SUELDO MENSUAL
          $q = "SELECT tra_sueldo FROM rrhh.trabajador WHERE int_cod=$Trabajador";
          $rAux = $conn->Execute($q);
          return (!empty($rAux->fields['tra_sueldo']) ? $rAux->fields['tra_sueldo'] : 0);
          //ESTE CODIGO LO UTILICE PARA GENERAR LOS ACUMULADOS EN BASE A HISTORICOS SN

/*          $MES=explode("/",$FechaIni);
          $MES=$MES[1];
          $q = "SELECT B.tra_sueldo FROM rrhh.historial_nom AS A INNER JOIN rrhh.hist_nom_tra_sueldo AS B On A.int_cod=B.hnom_cod WHERE to_char(A.nom_fec_fin,'MM') = '$MES' AND B.tra_cod=$Trabajador";
          $rAux = $conn->Execute($q);
          $i=0;
          $Sueldo=0;
          while(!$rAux->EOF){
            $i++;
            $Sueldo+=(!empty($rAux->fields['tra_sueldo']) ? $rAux->fields['tra_sueldo'] : 0);
            $rAux->movenext();
          }

          return $i==0? 0 : $Sueldo/$i; */
          //ESTE CODIGO LO UTILICE PARA GENERAR LOS ACUMULADOS EN BASE A HISTORICOS EN

        }
        case 2: { //CALCULO DE LA VARIABLE GLOBAL: TIPO DE CONTRATO
          $q = "SELECT cont_tipo FROM rrhh.contrato WHERE int_cod=$Contrato";
          $rAux = $conn->Execute($q);
          return  ($rAux->fields['cont_tipo']);
        }
        case 3: { //CALCULO DE LA VARIABLE GLOBAL: DIAS NO CONTABILIZABLES POR INGRESO Y/O EGRESO
          $Fecha=explode("/",$FechaIni,20);
          $FechaNomIni=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
          $Fecha=explode("/",$FechaFin,20);
          $FechaNomFin=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
          $segundos  = strtotime($FechaIngresoTrabajador)-strtotime($FechaNomIni);
          $diasI= intval($segundos/86400);
          $segundos  = strtotime($FechaNomFin)-strtotime($FechaIngresoTrabajador);
          $diasF= intval($segundos/86400);
          if($diasI>=0 && $diasF>=0){
            $ValorI=$diasI;
          }else{
            $ValorI=0;
          }
          $segundos  = strtotime($FechaEgresoTrabajador)-strtotime($FechaNomIni);
          $diasI= intval($segundos/86400);
          $segundos  = strtotime($FechaNomFin)-strtotime($FechaEgresoTrabajador);
          $diasF= intval($segundos/86400);
          if($diasI>=0 && $diasF>=0){
            $ValorF=$diasF ;
          }else{
            $ValorF=0;
          }
          return ($ValorI + $ValorF);
        }
        case 4: { //CALCULO DE LA VARIABLE GLOBAL: NUMERO DE LUNES EN EL PERIODO DE LA NOMINA
          $NroLunes=0;
          $diasI= intval((strtotime($FechaIngresoTrabajador)-strtotime(guardafecha($FechaIni)))/86400);
          $diasF= intval((strtotime(guardafecha($FechaFin))-strtotime($FechaIngresoTrabajador))/86400);
          if($diasI>=0 && $diasF>=0){
            $FechaI=$FechaIngresoTrabajador;
          }else{
            $FechaI=guardafecha($FechaIni);
          }
          $diasI= intval((strtotime($FechaEgresoTrabajador)-strtotime(guardafecha($FechaIni)))/86400);
          $diasF= intval((strtotime(guardafecha($FechaFin))-strtotime($FechaEgresoTrabajador))/86400);
          if($diasI>=0 && $diasF>=0){
            $FechaF=$FechaEgresoTrabajador;
          }else{
            $FechaF=guardafecha($FechaFin);
          }
          $Dias= intval((strtotime($FechaF)-strtotime($FechaI))/86400);
          $Dia=date("d",strtotime($FechaI));
          $Mes=date("m",strtotime($FechaI));
          $Ano=date("Y",strtotime($FechaI));
          for($i=0;$i<=$Dias;$i++){
            if(date("l",mktime(0,0,0,$Mes,$Dia,$Ano))=="Monday"){
              $NroLunes++;
            }
            $Dia++;
            if($Dia>DiaFin($Mes)){
              $Dia=1;
              $Mes++;
              if($Mes>12){
                $Mes=1;
                $Ano++;
              }
            }
          }
          return $NroLunes;
        }
        case 5: { //CALCULO DE LA VARIABLE GLOBAL: NUMERO DE LUNES EN El MES (Tomando Fecha Inicio de Nomina)
          $NroLunes=0;
          $Fecha=explode("/",$FechaIni,20);
          $Dia=1;
          $Mes=$Fecha[1];
          $Ano=$Fecha[2];
          while($Dia<=DiaFin($Mes)){
            if(date("l",mktime(0,0,0,$Mes,$Dia,$Ano))=="Monday"){
              $NroLunes++;
            }
            $Dia++;
          }
          return $NroLunes;
        }
        case 6: { //CALCULO DE LA VARIABLE GLOBAL: PRESTAMO
          $q = "SELECT B.cuota_monto,B.int_cod FROM rrhh.prestamo AS A INNER JOIN rrhh.prestamo_cuotas AS B ON A.int_cod=B.pres_cod WHERE A.cont_cod=$Contrato AND A.tra_cod=$Trabajador AND A.pres_estatus=1 AND B.cuota_nom_fec_ini='$FechaIni' AND B.cuota_nom_fec_fin='$FechaFin' AND B.cuota_estatus='Por Cobrar'";
          $r = $conn->Execute($q);
          if(!$r->EOF){
            $Cuota=$r->fields['int_cod'];
            $q = "UPDATE rrhh.prestamo_cuotas SET cuota_estatus='Cobrando' WHERE int_cod=$Cuota";
            $rAux = $conn->Execute($q);
          }
          return (!$r->EOF ? $r->fields['cuota_monto'] : 0);
        }
        case 7: { //CALCULO DE LA VARIABLE GLOBAL: NRO DE CUOTAS DE PRESTAMO
          $q = "SELECT B.cuota_nro FROM rrhh.prestamo AS A INNER JOIN rrhh.prestamo_cuotas AS B ON A.int_cod=B.pres_cod WHERE A.cont_cod=$Contrato AND A.tra_cod=$Trabajador AND A.pres_estatus=1 AND B.cuota_nom_fec_ini='$FechaIni' AND B.cuota_nom_fec_fin='$FechaFin' AND B.cuota_estatus!='Cancelado'";
          $rAux = $conn->Execute($q);
          return (!$rAux->EOF ? $rAux->fields['cuota_nro'] : 0);
        }
        case 8: { //CALCULO DE LA VARIABLE GLOBAL: TOTAL DE CUOTAS DE PRESTAMO
          $q = "SELECT pres_cuotas FROM rrhh.prestamo WHERE cont_cod=$Contrato AND tra_cod=$Trabajador AND pres_estatus=1 ";
          $rAux = $conn->Execute($q);
          return (!$rAux->EOF ? $rAux->fields['pres_cuotas'] : 0);
        }
        case 9: { //CALCULO DE LA VARIABLE GLOBAL: MESES DE ANTIGUEDAD
          return (strtotime(guardafecha($FechaFin)) - strtotime($FechaIngresoTrabajador))/2592000;
        }
        case 10: { //CALCULO DE LA VARIABLE GLOBAL: AÑOS DE ANTIGUEDAD
          return (strtotime(guardafecha($FechaFin)) - strtotime($FechaIngresoTrabajador))/31536000;
        }
        case 11: { //CALCULO DE LA VARIABLE GLOBAL: AÑOS DE ANTIGUEDAD PARA VACACIONES
          return (int)((strtotime(guardafecha($FechaIni)) - strtotime($FechaIngresoTrabajador))/31536000);
        }
        case 12: { //CALCULO DE LA VARIABLE GLOBAL: NRO DE DIAS FERIADOS CONTANDO SABADOS Y DOMINGOS EN EL PERIODO DE LA NOMINA
          $Dias= intval((strtotime(guardafecha($FechaFin))-strtotime(guardafecha($FechaIni)))/86400);
          $Dia=date("d",strtotime(guardafecha($FechaIni)));
          $Mes=date("m",strtotime(guardafecha($FechaIni)));
          $Ano=date("Y",strtotime(guardafecha($FechaIni)));
          $DiasTotal=0;
          for($i=0;$i<=$Dias;$i++){
            $DiaI= strlen($Dia)<2 ? "0".$Dia : $Dia;
            $MesI= strlen($Mes)<2 ? "0".$Mes : $Mes;
            $Fecha=$Ano."-".$MesI."-".$DiaI;
            $q = "SELECT * FROM rrhh.feriados WHERE fecha='$Fecha'";
            $rF = $conn->Execute($q);
            if(!$rF->EOF){
              $DiasTotal++;
            }
            $Dia++;
            if($Dia>DiaFin($Mes)){
              $Dia=1;
              $Mes++;
              if($Mes>12){
                $Mes=1;
                $Ano++;
              }
            }
          }
          return $DiasTotal;
        }
        case 13: { //CALCULO DE LA VARIABLE GLOBAL: NUMERO DE SABADOS Y DOMINGOS EN EL PERIODO DE LA NOMINA
          $NroSyD=0;
          $diasI= intval((strtotime($FechaIngresoTrabajador)-strtotime(guardafecha($FechaIni)))/86400);
          $diasF= intval((strtotime(guardafecha($FechaFin))-strtotime($FechaIngresoTrabajador))/86400);
          if($diasI>=0 && $diasF>=0){
            $FechaI=$FechaIngresoTrabajador;
          }else{
            $FechaI=guardafecha($FechaIni);
          }
          $diasI= intval(strtotime($FechaEgresoTrabajador)-strtotime(guardafecha($FechaIni))/86400);
          $diasF= intval(strtotime(guardafecha($FechaFin))-strtotime($FechaEgresoTrabajador)/86400);
          if($diasI>=0 && $diasF>=0){
            $FechaF=$FechaEgresoTrabajador;
          }else{
            $FechaF=guardafecha($FechaFin);
          }
          $Dias= intval((strtotime($FechaF)-strtotime($FechaI))/86400);
          $Dia=date("d",strtotime($FechaI));
          $Mes=date("m",strtotime($FechaI));
          $Ano=date("Y",strtotime($FechaI));
          for($i=0;$i<=$Dias;$i++){
            if(date("l",mktime(0,0,0,$Mes,$Dia,$Ano))=="Saturday" || date("l",mktime(0,0,0,$Mes,$Dia,$Ano))=="Sunday"){
              $NroSyD++;
            }
            $Dia++;
            if($Dia>DiaFin($Mes)){
              $Dia=1;
              $Mes++;
              if($Mes>12){
                $Mes=1;
                $Ano++;
              }
            }
          }
          return $NroSyD;
        }
        case 14: { //CALCULO DE LA VARIABLE GLOBAL: NUMERO DE DIAS EN EL PERIODO DE LA NOMINA
          return  (intval((strtotime(guardafecha($FechaFin))-strtotime(guardafecha($FechaIni)))/86400) + 1);
        }
        case 15: { //SUELDO ANTERIOR AL ACTUAL
          $q = "SELECT tra_sueldo FROM rrhh.hist_nom_tra_sueldo WHERE tra_cod=$Trabajador ORDER BY int_cod DESC";
          $r = $conn->Execute($q);
          return  !$r->EOF ? $r->fields['tra_sueldo'] : 0;
        }
        case 16: { //DIAS A DESCONTAR POR VACACIONES
          $q = "SELECT * FROM rrhh.preparar_vac WHERE tra_cod=$Trabajador AND disfrute = '1'";
          $rFVac = $conn->Execute($q);
          if(!$rFVac->EOF){
            $FechaIniVac=$rFVac->fields['fecha_ini'];
            $FechaFinVac=$rFVac->fields['fecha_fin'];
          }
          else{
          $q = "SELECT * FROM rrhh.vacaciones WHERE tra_cod=$Trabajador AND disfrute = '1'";
          $rFVac = $conn->Execute($q);
          $FechaIniVac=$rFVac->fields['vac_fec_ini'];
          $FechaFinVac=$rFVac->fields['vac_fec_fin'];
          }
          if(!$rFVac->EOF){
            $Fecha=explode("/",$FechaIni,20);
            $FechaNomIni=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
            $Fecha=explode("/",$FechaFin,20);
            $FechaNomFin=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
            $segundos  = strtotime($FechaIniVac)-strtotime($FechaNomIni);
            $diasI= intval($segundos/86400);
            $segundos  = strtotime($FechaNomFin)-strtotime($FechaIniVac);
            $diasF= intval($segundos/86400);
            if($diasI>=0 && $diasF>=0){
              $ValorF=$diasF+1; //Modificado 05/05/2010
            }else{
              $ValorF=0;
            }
            $segundos  = strtotime($FechaFinVac)-strtotime($FechaNomIni);
            $diasI= intval($segundos/86400);
            $segundos  = strtotime($FechaNomFin)-strtotime($FechaFinVac);
            $diasF= intval($segundos/86400);
            if($diasI>=0 && $diasF>=0){
              $ValorI=$diasI+1; //Modificado 05/05/2010;
            }else{
              $ValorI=0;
            }
          }
          return ($ValorI + $ValorF);
        }
        case 17: { //CALCULO DE LA VARIABLE GLOBAL: NUMERO DE LUNES A DESCONTAR POR VACACIONES
          $NroLunes=0;
          $q = "SELECT * FROM rrhh.preparar_vac WHERE tra_cod=$Trabajador";
          $rFVac = $conn->Execute($q);
          if(!$rFVac->EOF){
            $FechaIniVac=$rFVac->fields['fecha_ini'];
            $FechaFinVac=$rFVac->fields['fecha_fin'];
          }
          else{
            $q = "SELECT * FROM rrhh.vacaciones WHERE tra_cod=$Trabajador";
            $rFVac = $conn->Execute($q);
            $FechaIniVac=$rFVac->fields['vac_fec_ini'];
            $FechaFinVac=$rFVac->fields['vac_fec_fin'];
          }
          $diasI= intval((strtotime($FechaIniVac)-strtotime(guardafecha($FechaIni)))/86400);
          $diasF= intval((strtotime(guardafecha($FechaFin))-strtotime($FechaFinVac))/86400);
          $diasIA= intval((strtotime($FechaFinVac)-strtotime(guardafecha($FechaIni)))/86400);
          $diasFA= intval((strtotime(guardafecha($FechaFin))-strtotime($FechaIniVac))/86400);
          if(!empty($FechaIniVac) && ($diasI>=0 || $diasF>=0) && ($diasIA>=0 && $diasFA>=0)){
            $diasI= intval((strtotime($FechaIniVac)-strtotime(guardafecha($FechaIni)))/86400);
            $diasF= intval((strtotime(guardafecha($FechaFin))-strtotime($FechaIniVac))/86400);
            if($diasI>=0 && $diasF>=0){
              $FechaI=$FechaIniVac;
            }else{
              $FechaI=guardafecha($FechaIni);
            }
            $diasI= intval((strtotime($FechaFinVac)-strtotime(guardafecha($FechaIni)))/86400);
            $diasF= intval((strtotime(guardafecha($FechaFin))-strtotime($FechaFinVac))/86400);
            if($diasI>=0 && $diasF>=0){
              $FechaF=$FechaFinVac;
            }else{
              $FechaF=guardafecha($FechaFin);
            }
            $Dias= intval((strtotime($FechaF)-strtotime($FechaI))/86400)+1;
            $Dia=date("d",strtotime($FechaI));
            $Mes=date("m",strtotime($FechaI));
            $Ano=date("Y",strtotime($FechaI));
            for($i=0;$i<=$Dias;$i++){
              if(date("l",mktime(0,0,0,$Mes,$Dia,$Ano))=="Monday"){
                $NroLunes++;
              }
              $Dia++;
              if($Dia>DiaFin($Mes)){
                $Dia=1;
                $Mes++;
                if($Mes>12){
                  $Mes=1;
                  $Ano++;
                }
              }
            }
          }
          return $NroLunes;
        }

        case 18: {//CALCULO DE LA VARIABLE GLOBAL: NUMERO DE MESES BONIFICACION FIN DE AÑO

          $fechaInicio =muestrafecha($FechaIngresoTrabajador);
          $fechaActual = $FechaFin;

          $diaActual = substr($fechaActual, 0, 2);
          $mesActual = substr($fechaActual, 3, 5);
          $anioActual = substr($fechaActual, 6, 10);
          $diaInicio = substr($fechaInicio, 0, 2);
          $mesInicio = substr($fechaInicio, 3, 5);
          $anioInicio = substr($fechaInicio, 6, 10);
          $b = 0;
          $mes = $mesInicio-1;
          if($mes==2){
          if(($anioActual%4==0 && $anioActual%100!=0) || $anioActual%400==0){
          $b = 29;
          }else{
          $b = 28;
          }
          }
          else if($mes<=7){
          if($mes==0){
           $b = 31;
          }
            else if($mes%2==0){
            $b = 30;
            }
            else{
            $b = 31;
            }
            }
            else if($mes>7){
            if($mes%2==0){
            $b = 31;
            }
            else{
            $b = 30;
            }
            }
             if(($anioInicio>$anioActual) || ($anioInicio==$anioActual && $mesInicio>$mesActual) ||
            ($anioInicio==$anioActual && $mesInicio == $mesActual && $diaInicio>$diaActual)){
          //  echo "La fecha de inicio ha de ser anterior a la fecha Actual";
            }else{
            if($mesInicio <= $mesActual){
            $anios = $anioActual - $anioInicio;
            if($diaInicio <= $diaActual){
            $meses = $mesActual - $mesInicio;
            $dies = $diaActual - $diaInicio;
            }else{
            if($mesActual == $mesInicio){
            $anios = $anios - 1;
            }
            $meses = ($mesActual - $mesInicio - 1 + 12) % 12;
            $dies = $b-($diaInicio-$diaActual);
            }
            }else{
            $anios = $anioActual - $anioInicio - 1;
            if($diaInicio > $diaActual){
            $meses = $mesActual - $mesInicio -1 +12;
            $dies = $b - ($diaInicio-$diaActual);
            }else{
            $meses = $mesActual - $mesInicio + 12;
            $dies = $diaActual - $diaInicio;
            }
            }
            /*echo "Años: ".$anios." <br />";
            echo "Meses: ".$meses." <br />";
            echo "Días: ".$dies." <br />";
            */
            $resultado= $diaInicio - 15;
           // echo $resultado;
            if($resultado<=0){

            $meses++;

            }

          // echo "Meses: ".$meses." <br />";
           //echo "dia: ".$diaInicio." <br />";

          }
           return $meses;

        }
        case 19: { //CALCULA DIAS ADICIONALES DE ANTIGUEDAD
          $dias_adicionales_antiguedad = 0;
          $FechaI=explode("/",$FechaIngresoTrabajador,20);
          $Fecha=explode("/",$FechaFin,20);

          if($FechaI[1] == $Fecha[1]){
            $antiguedad = 0;
            $antiguedad = (int)((strtotime(guardafecha($FechaFin)) - strtotime($FechaIngresoTrabajador))/31536000);
            $dias_adicionales_antiguedad = (2*$antiguedad)-2; // 2 dias adicionales a partir del segundo año
          }
          return $dias_adicionales_antiguedad;
        }
      }
    }
  }
}
function calculafloat($monto,$decimales){//se7ho
  return number_format($monto, $decimales, '.', '');
}
function Cadena($Cadena){
  $Vector=preg_split("/ /",$Cadena,500);
  if($Vector[1]){
    $Palabra=$Vector[1];
    $Palabra=$Palabra[0].".";
  }
  return $Vector[0]." ".$Palabra;
}

function FechaFinVacaciones($conn,$FechaIni,$DiasF){
  $DiaFin=date("d",strtotime(guardafecha($FechaIni)));
  $MesFin=date("m",strtotime(guardafecha($FechaIni)));
  $AnoFin=date("Y",strtotime(guardafecha($FechaIni)));
  $DiaFin--;
  for($i=$DiasF;$i>0;$i--){
    $Bandera=false;
    while(!$Bandera){
      $DiaFin++;
      if($DiaFin>DiaFin($MesFin,$AnoFin)){
        $DiaFin=1;
        $MesFin++;
        if($MesFin>12){
          $MesFin=1;
          $AnoFin++;
        }
      }
      $DiaFin=strlen($DiaFin)<2 ? "0".$DiaFin : $DiaFin;
      $MesFin=strlen($MesFin)<2 ? "0".$MesFin : $MesFin;
      $Fecha=$AnoFin."-".$MesFin."-".$DiaFin;
      $q = "SELECT * FROM rrhh.feriados WHERE fecha='$Fecha'";
      $rF = $conn->Execute($q);
      $Bandera= $rF->EOF ;
    }
  }
  $DiaFin=strlen($DiaFin)<2 ? "0".$DiaFin : $DiaFin;
  $MesFin=strlen($MesFin)<2 ? "0".$MesFin : $MesFin;
  return $DiaFin."/".$MesFin."/".$AnoFin;
}



  function calculaedad($fecha1,$fecha2){
    /*list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
      $ano_diferencia--;*/
    list($Y,$m,$d) = explode("-",$fecha1);
    list($Y2,$m2,$d2) = explode("-",$fecha2);

    //return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    if($m2.$d2 < $m.$d){
      return $Y2-$Y-1;
    }else{
      return $Y2-$Y;
    }

  //  return $ano_diferencia;

  }

function Aniocorrelativo(){

    //$anio = date("Y");
    $anio = 2016;

    return $anio;

  }


function convertImageToWebP($source, $destination, $quality=80) {
  $extension = pathinfo($source, PATHINFO_EXTENSION);
  if ($extension == 'jpeg' || $extension == 'jpg') 
    $image = imagecreatefromjpeg($source);
  elseif ($extension == 'gif') 
    $image = imagecreatefromgif($source);
  elseif ($extension == 'png') 
    $image = imagecreatefrompng($source);
  return imagewebp($image, $destination, $quality);
  
}

 ?>