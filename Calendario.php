<?
include("adodb/adodb.inc.php");
//include('../libertador/system/adodb/adodb-exceptions.inc.php');
//include("conn.php");
//include("funciones.php");
include("lib/librerias.php");

    $Ano=$_REQUEST['Ano'];
    $Ano= date('Y');
    $Mes= date('m');
    $Res= "<table align=\"center\" style=\"background-color:#fff;\" class=\"\" width=\"auto\" border=\"0\">\n";
    for($tr=1;$tr<=1;$tr++){
        $Res.= "<tr valign=\"top\" style=\"font-weight: bold;\">\n";
        for($td=$Mes;$td<=$Mes;$td++){
            if($tr==1 && $td==1){
                $MesNum=01;
                $MesText="Enero";
            }
            if($tr==1 && $td==2){
                $MesNum=02;
                $MesText="Febrero";
            }
            if($tr==1 && $td==3){
                $MesNum=03;
                $MesText="Marzo";
            }
            if($tr==1 && $td==4){
                $MesNum=04;
                $MesText="Abril";
            }
            if($tr==2 && $td==1){
                $MesNum=05;
                $MesText="Mayo";
            }
            if($tr==2 && $td==2){
                $MesNum=06;
                $MesText="Junio";
            }
            if($tr==2 && $td==3){
                $MesNum=07;
                $MesText="Julio";
            }
            if($tr==2 && $td==4){
                $MesNum='08';
                $MesText="Agosto";
            }
            if($tr==3 && $td==1){
                $MesNum='09';
                $MesText="Septiembre";
            }
            if($tr==3 && $td==2){
                $MesNum=10;
                $MesText="Octubre";
            }
            if($tr==3 && $td==3){
                $MesNum=11;
                $MesText="Noviembre";
            }
            if($tr==3 && $td==4){
                $MesNum=12;
                $MesText="Diciembre";
            }
            $Res.= "<td  align=\"center\">\n";
                $Res.= "<table  class=\"table-condensed\" style=\"border:solid 1px;height:250px;border-color:#000000; font-size: 13px;\"  >\n";
                $Res.= "<tr>\n";
                $Res.= "<td style=\"background-color:#eee\" colspan=\"7\"  align=\"center\">$MesText</td>\n";
                $Res.= "</tr>\n";
                $Res.= "<tr style=\"background-color:#BDBDBD\">\n";
                $Res.= "<td>Dom</td>\n";
                $Res.= "<td>Lun</td>\n";
                $Res.= "<td>Mar</td>\n";
                $Res.= "<td>Mie</td>\n";
                $Res.= "<td>Jue</td>\n";
                $Res.= "<td>Vie</td>\n";
                $Res.= "<td>Sab</td>\n";
                $Res.= "</tr>\n";
                $Filas=1;
                if(date("l",mktime(0,0,0,$MesNum,1,$Ano))!="Sunday"){
                    $Res.= "<tr align=\"center\">\n";
                    $Res.="<td>&nbsp;</td>\n";
                    if(date("l",mktime(0,0,0,$MesNum,1,$Ano))!="Monday"){
                        $Res.="<td>&nbsp;</td>\n";
                        if(date("l",mktime(0,0,0,$MesNum,1,$Ano))!="Tuesday"){
                            $Res.="<td>&nbsp;</td>\n";
                            if(date("l",mktime(0,0,0,$MesNum,1,$Ano))!="Wednesday"){
                                $Res.="<td>&nbsp;</td>\n";
                                if(date("l",mktime(0,0,0,$MesNum,1,$Ano))!="Thursday"){
                                    $Res.="<td>&nbsp;</td>\n";
                                    if(date("l",mktime(0,0,0,$MesNum,1,$Ano))!="Friday"){
                                        $Res.="<td>&nbsp;</td>\n";
                                        if(date("l",mktime(0,0,0,$MesNum,1,$Ano))!="Saturday"){
                                            $Res.="<td>&nbsp;</td>\n";
                                        }   
                                    }
                                }
                            }
                        }
                    }
                }
                for($Dia=1;$Dia<=DiaFin($MesNum,$Ano);$Dia++){
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Sunday"){
                        $Res.= "<tr align=\"center\">\n";
                    }
                    $q="SELECT * FROM public.fecha_eventos WHERE fecha='$Ano-$MesNum-$Dia'";
                    $r= $conn->Execute($q);
                    $Color="transparent";
                    $letraColor="#000000";
                    if(!$r->EOF){
                        //$Color="#BDBDBD";
                        $letra="#BDBDBD";
                        $letraColor="red";
                    }
                    //DOMINGO
                    $Res.= "<td id=\"".$Ano."_".$MesNum."_".$Dia."\" style=\"cursor:pointer;background-color:$Color;font-weight: $letra;color: $letraColor; \" onClick=\"Guardar('$Ano-$MesNum-$Dia','".$Ano."_".$MesNum."_".$Dia."')\" >";
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Sunday"){
                        $Res.= $Dia;
                    }
                    //LUNES
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Monday"){
                        $Res.= $Dia;
                    }
                    //Martes
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Tuesday"){
                        $Res.= $Dia;
                    }
                    //Miercoles
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Wednesday"){
                        $Res.= $Dia;
                    }
                    //Jueves
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Thursday"){
                        $Res.= $Dia;
                    }
                    //Viernes
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Friday"){
                        $Res.= $Dia;
                    }
                    //Sabado
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Saturday"){
                        $Res.= $Dia;
                    }
                    $Res.= "</td>\n";
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Saturday"){
                        $Res.= "</tr>\n";
                    }
                    
                }
                $Dia--;
                while(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))!="Saturday"){
                    $Res.="<td>&nbsp;</td>\n";
                    $Dia++;
                    if(date("l",mktime(0,0,0,$MesNum,$Dia,$Ano))=="Saturday"){
                        $Res.= "</tr>\n";
                    }
                }
                $Res.= "</table>\n";
            $Res.= "</td>\n";
        }
        $Res.= "</tr>\n";
        $Res.= "<tr style=\"font-weight: normal;font-size: 10px;\" align=\"left\">";
        $Res.= "<td><img src=\"img/\"style=\"background-color:red\" width=\"10px\"> Sabados, Domingos y Feriados</td>";
        $Res.= "</tr>";
        $Res.= "<tr style=\"font-weight: normal;font-size: 10px;\" align=\"left\">";
        $Res.= "<td><img src=\"img/\"style=\"background-color:green\" width=\"10px\"> Eventos</td>";
        $Res.= "</tr>";
    }
    $Res.= "</table>\n";
    echo $Res;
?>
