<?
//session_start();
/**
* clase de reportes
*/

class menu 
{    
    public $id;
    public $descripcion;
    public $orden;
    public $tipo;
    public $continua;

    function getAllModulosPorUsuario($conn, $id_usuario, $orden="d.orden"){
        $q = "SELECT b.id_modulo AS id, d.descripcion ";
        $q.= "FROM public.relacion_us_op AS a ";
        $q.= "INNER JOIN public.operaciones AS b ON (a.id_operacion = b.id) ";
        $q.= "INNER JOIN public.usuarios AS c ON (a.id_usuario = c.id) ";
        $q.= "INNER JOIN public.modulos AS d ON (b.id_modulo = d.id) ";
        $q.= "WHERE c.id = '$id_usuario' ";
        $q.= "GROUP BY b.id_modulo, d.descripcion,$orden ";
        $q.= "ORDER BY $orden ";
        //die($q);
        $r = $conn->Execute($q);
        while(!$r->EOF){
            $ue = new menu;
            $ue->id = $r->fields['id'];
            $ue->descripcion = $r->fields['descripcion'];
            $coleccion[] = $ue;
            $r->movenext();
        }
        return $coleccion;
    }
    function getAllModulosPublico($conn){
        $q = "SELECT id, descripcion, url ";
        $q.= "FROM  public.modulos  ";
        $q.= "WHERE tipo=false ORDER BY orden ASC ";
       /* $q.= "GROUP BY b.id_modulo, d.descripcion,$orden ";
        $q.= "ORDER BY $orden ";*/
        //die($q);
        $r = $conn->Execute($q);
        while(!$r->EOF){
            $ue = new menu;
            $ue->id = $r->fields['id'];
            $ue->descripcion = $r->fields['descripcion'];
            $ue->url = $r->fields['url'];
            $$q = "SELECT * FROM public.operaciones ";
            $q.= "WHERE id_modulo = ".$r->fields['id']." limit 1; ";
            $resul = $conn->Execute($q);
            if(!$resul->EOF){
               $ue->continua ="";
            }
            else 
                $ue->continua ="index.php";
            $coleccion[] = $ue;
            $r->movenext();
        }
        return $coleccion;
    }
    function getOperacionesPublico($conn,$id_modulo){
        $q = "SELECT * ";
        $q.= "FROM public.operaciones ";
        $q.= "WHERE id_modulo = $id_modulo ";
        $q.= " ORDER BY orden ASC ";
        //die($q);
        $r = $conn->Execute($q);
        $collection=array();
        while(!$r->EOF){
            $ue = new menu;
            $ue->id = $r->fields['id'];
            $ue->descripcion = $r->fields['descripcion'];
            $ue->pagina = $r->fields['pagina'];
            $ue->nivel = $r->fields['nivel'];
            $ue->id_padre = $r->fields['id_padre'];
            $ue->tipo = $r->fields['tipo'];
            $contenido = explode(".",$r->fields['pagina']);
            $ue->descrip = $contenido[0];

            $coleccion[] = $ue;
            $r->movenext();
        }
        return $coleccion;
    }
    
    function getAllOpsPorUsuarioModuloNivel($conn, $id_usuario, $id_modulo, $nivel, $orden="orden"){
        $q = "SELECT b.* ";
        $q.= "FROM public.relacion_us_op AS a ";
        $q.= "INNER JOIN public.operaciones AS b ON (a.id_operacion = b.id) ";
        $q.= "INNER JOIN public.usuarios AS c ON (a.id_usuario = c.id) ";
        $q.= "WHERE 1=1 ";
        $q.= "AND c.id = '$id_usuario' ";
        $q.= "AND b.id_modulo = '$id_modulo' AND b.nivel = '$nivel' ";
        $q.= "ORDER BY $orden ";
        //die($q);
        $r = $conn->Execute($q);
        $collection=array();
        while(!$r->EOF){
            $ue = new menu;
            $ue->id = $r->fields['id'];
            $ue->descripcion = $r->fields['descripcion'];
            $ue->pagina = $r->fields['pagina'];
            $ue->nivel = $r->fields['nivel'];
            $ue->id_padre = $r->fields['id_padre'];
            $ue->tipo = $r->fields['tipo'];
            $contenido = explode(".",$r->fields['pagina']);
            $ue->descrip = $contenido[0];

            $coleccion[] = $ue;
            $r->movenext();
        }
        return $coleccion;
    }


    function getSubCarpetas($conn, $idUsuario, $idNodoPadre, $num,$url){
        $nodos = menu::getAllOpsHijas($conn, $idUsuario, $idNodoPadre);
        $nbsp.= "&nbsp;&nbsp;";
        $left = 18;
        !empty($num) ? $left += $num :"";
        
        if(is_array($nodos)){

            for($k=0; $k<count($nodos);$k++){
                if($nodos[$k]->tipo != 'C'){
                   
                    $cont.="<div class='accordion-inner'> ";
                    $cont.="<div class='list-group'> ";
                    $cont.="<a href='".$url."".$nodos[$k]->pagina."'  target='contenido' class='contenido_".$nodos[$k]->descrip." list-group-item' style='padding-left: ".$left."px;'>".$nodos[$k]->descripcion."</a> ";
                    $cont.="</div> ";
                    $cont.="</div> "; 
                   // $js.= "\t\t\t\t\tmyobj = { label: \"".$nodos[$k]->descripcion."\", href: \"".$nodos[$k]->pagina."\", target: \"contenido\"};\n";
                   // $js.= "\t\t\t\t\tvar ".$nombreNodoPadre."_".$k." = new YAHOO.widget.TextNode(myobj, ".$nombreNodoPadre.", false);\n";
                }else{

                    $cont.="<div class='accordion-heading-sub' data-toggle='collapse' data-parent='#leftMenu' href='#collapse1".$nodos[$k]->id."' style='cursor:pointer' onclick='cambiarClass(".$nodos[$k]->id.");'>  ";
                    $cont.="$nbsp<span id='capa".$nodos[$k]->id."' class='glyphicon glyphicon-folder-close' style='color:#646562;'></span> ";
                    $cont.="<a class='accordion-toggle' > ";
                    $cont.="<i class='icon-list-alt'></i>&nbsp;".$nodos[$k]->descripcion." ";
                    $cont.="</a> ";
                    $cont.="</div> ";
                    $cont.="<div id='collapse1".$nodos[$k]->id."' class='accordion-body collapse' style='height: 0px;'> ";
                    $cont.= menu::getSubCarpetas($conn, $idUsuario, $nodos[$k]->id, '12',$url);      
                    $cont.="</div> ";
                   // $js.= "\t\t\t\t\tmyobj = { label: \"".$nodos[$k]->descripcion."\"};\n";
                   // $js.= "\t\t\t\t\tvar ".$nombreNodoPadre."_".$k." = new YAHOO.widget.TextNode(myobj, ".$nombreNodoPadre.", false);\n";
                   // $js.= menu::getSubCarpetas($conn, $idUsuario, $nodos[$k]->id, $nombreNodoPadre."_".$k);
                
                }
            }
                   
            return $cont;
        }
    }



    function getAllOpsHijas($conn, $id_usuario, $id_padre, $orden="orden"){
        $q = "SELECT operaciones.* ";
        $q.= "FROM public.relacion_us_op  ";
        $q.= "INNER JOIN public.operaciones ON (relacion_us_op.id_operacion = operaciones.id) ";
        $q.= "INNER JOIN public.usuarios ON (relacion_us_op.id_usuario = usuarios.id) ";
        $q.= "WHERE usuarios.id = '$id_usuario' AND operaciones.id_padre = '$id_padre' ";
        $q.= "ORDER BY $orden ";
        //die($q);
        $r = $conn->Execute($q);
        $collection=array();
        while(!$r->EOF){
            $ue = new menu;
            $ue->id = $r->fields['id'];
            $ue->descripcion = $r->fields['descripcion'];
            $ue->pagina = $r->fields['pagina'];
            $ue->nivel = $r->fields['nivel'];
            $ue->id_padre = $r->fields['id_padre'];
            $ue->tipo = $r->fields['tipo'];
            $contenido = explode(".",$r->fields['pagina']);
            $ue->descrip = $contenido[0];
            $coleccion[] = $ue;
            $r->movenext();
        }
        return $coleccion;
    }

    function getOperaciones($conn,$id_usuario, $orden="orden")
    {
        $q = "SELECT operaciones.* ";
        $q.= "FROM public.relacion_us_op  ";
        $q.= "INNER JOIN public.operaciones ON (relacion_us_op.id_operacion = operaciones.id) ";
        $q.= "INNER JOIN public.usuarios ON (relacion_us_op.id_usuario = usuarios.id) ";
        $q.= "WHERE 1=1 ";
        $q.= "AND usuarios.id = '$id_usuario' ";
        $q.= "AND operaciones.tipo = 'V' ";
        $q.= "ORDER BY $orden ";
        //die($q);
        $r = $conn->Execute($q);
        $collection=array();
        while(!$r->EOF){
            $ue = new menu;
            $ue->id = $r->fields['id'];
            $ue->descripcion = $r->fields['descripcion'];
            $ue->pagina = $r->fields['pagina'];
            $ue->nivel = $r->fields['nivel'];
            $ue->id_padre = $r->fields['id_padre'];
            $ue->tipo = $r->fields['tipo'];
            $contenido = explode(".",$r->fields['pagina']);
            $ue->descrip = $contenido[0];

            $coleccion[] = $ue;
            $r->movenext();
        }
        return $coleccion;
    }












    function getDependencias($conn,$id_usuario)
    {
        $q ="SELECT a.id AS id_dep, a.nombre AS dependencia ";//,  b.id AS id_mod, b.nombre AS modulo, c.descripcion AS operacion, c.pagina ";
        $q.="FROM public.dependencias AS a ";
        $q.="INNER JOIN public.modulos AS b ON (b.id_dependencias = a.id) ";
        $q.="INNER JOIN public.operaciones AS c ON (c.id_modulo = b.id) ";
        $q.="INNER JOIN public.operaciones_usuarios AS d ON (d.id_operacion = c.id) ";
        $q.="WHERE 1=1 ";
        $q.="AND a.estatus=0 ";
        $q.="AND d.id_usuario='$id_usuario' ";
        $q.="GROUP BY 1,2 ";
        //die($q);
        $r = $conn->Execute($q);

        while(!$r->EOF){
            $ue = new menu;
            $ue->id_dep = $r->fields['id_dep'];
            $ue->dependencia  = $r->fields['dependencia'];

            $coleccion[] = $ue;
            $r->movenext();
        }
        return $coleccion;
    }

    function getModulos($conn,$id_dep,$id_usuario)
    {
        $q ="SELECT a.id AS id_modulo, a.nombre AS modulo ";//,  b.id AS id_mod, b.nombre AS modulo, c.descripcion AS operacion, c.pagina ";
        $q.="FROM public.modulos AS a ";
        $q.="INNER JOIN public.operaciones AS b ON (b.id_modulo = a.id) ";
        $q.="INNER JOIN public.operaciones_usuarios AS c ON (c.id_operacion = b.id) ";
        $q.="WHERE 1=1 and a.id_dependencias='$id_dep' ";
        $q.="AND a.estatus=0";
        $q.="AND c.id_usuario='$id_usuario' ";
        $q.="GROUP BY 1,2";
        $q.="ORDER BY 1 ";
        //die($q);
        $r = $conn->Execute($q);

        while(!$r->EOF){
            $ue = new menu;
            $ue->id_modulo = $r->fields['id_modulo'];
            $ue->modulo = $r->fields['modulo'];

            $coleccion[] = $ue;
            $r->movenext();
        }
        return $coleccion;
    }
    function addmodulo($conn,$descripcion, $orden, $tipo){
       // $tipo=($tipo=='')? false:true;
       $tipo=($tipo==1)? 'true':'false';
        $q="SELECT id FROM modulos WHERE descripcion='$descripcion';";
        $r = $conn->Execute($q);
        if(!$r->EOF){ //SE BUSCA EL REGISTRO
           return 2;
        }
        $q="INSERT INTO modulos(descripcion, orden, tipo) VALUES ('$descripcion', $orden, $tipo);";
        $r = $conn->Execute($q);
        if($r){//SE INSERTA EL REGISTRO
           return 1; 
        }
        else //ERROR AL REGISTRAR EL REGISTRO
          return 5;  
    }
    function setmodulo($conn,$descripcion, $orden, $tipo,$id){
        $tipo=($tipo==1)? 'true':'false';
        $q="UPDATE modulos SET  descripcion='$descripcion', orden=$orden, tipo=$tipo
 WHERE id=$id;";
        $r = $conn->Execute($q);
        if($r){ //SE BUSCA EL REGISTRO
           return 3;
        }else //ERROR AL REGISTRAR EL REGISTRO
          return 4;  
    }
    function getmodulo($conn,$id){
            $this->id = new Services_JSON();
            $this->descripcion = new Services_JSON();
            $this->orden = new Services_JSON();
            $this->tipo = new Services_JSON();
        $q="SELECT * FROM modulos WHERE id=$id limit 1;";
        $r = $conn->Execute($q);
        if(!$r->EOF){ //SE BUSCA EL REGISTRO
            $this->id = $r->fields['id'];
            $this->descripcion = $r->fields['descripcion'];
            $this->orden = $r->fields['orden'];
            $this->tipo = ($r->fields['tipo']==f)? 1:2;
            
        }
         return $this;
    }
    function getedioperaciones($conn,$id){
            $this->id = new Services_JSON();
            $this->descripcion = new Services_JSON();
            $this->pagina =  new Services_JSON();
            $this->nivel =  new Services_JSON();
            $this->id_padre =  new Services_JSON();
            $this->tipo =  new Services_JSON();
            $this->orden =  new Services_JSON();
        $q="SELECT * FROM operaciones WHERE id=$id limit 1;";
        $r = $conn->Execute($q);
        if(!$r->EOF){ //SE BUSCA EL REGISTRO
            
            $this->id = $r->fields['id'];
            $this->descripcion = $r->fields['descripcion'];
            $this->pagina = $r->fields['pagina'];
            $this->nivel = $r->fields['nivel'];
            $this->modulo =  $r->fields['id_modulo'];
            $this->id_padre = $r->fields['id_padre'];
            $this->tipo = $r->fields['tipo'];
            $this->orden =  $r->fields['orden'];
            
        }
         return $this;
    }
}
?>