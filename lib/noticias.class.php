<?
class noticias{

    // Propiedades
    var $int_cod;
    var $div_cod;
    var $div_nom;
    var $emp_cod;

    var $total;

    function get($conn, $id){
        try {
            $q = "SELECT * FROM public.noticias WHERE id='$id' ";
            //die($q);
            $r = $conn->Execute($q);
            if(!$r->EOF){
                $this->id = $r->fields['id'];
                $this->titulo = $r->fields['titulo'];
                $this->fecha = $r->fields['fecha'];
                $this->fecha_reg = $r->fields['fecha_reg'];
                $this->hora = $r->fields['hora'];
                $this->noticia = $r->fields['noticia'];
                $this->url = $r->fields['url'];
                $this->id_usuario = $r->fields['id_usuario'];
                $this->estatus = $r->fields['estatus'];
                $this->tipo_publicacion = $r->fields['tipo_publicacion'];
                $this->mantener = $r->fields['mantener'];
                $this->sub_noti = $r->fields['sub_noti'];
                
                $usuario = new usuario;
                $res = $usuario->get($conn,$this->id_usuario);

                $this->usuario = $res->nombre." ".$res->apellido;

                return $this;
            }
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }

    function get_resumen($conn, $from=0, $max=0, $find, $orden='a.mantener DESC,a.fecha DESC,a.hora'){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1  AND tipo_publicacion='1' ";
            $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
            $q.= !empty($find) ? "AND ilike '%$find%' " :"";
            $q.= "ORDER BY a.mantener DESC,a.fecha DESC,a.hora ";
           // $q.= "LIMIT $limite ";

           // die($q);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);

            //$r =  $conn->Execute($q);

            $this->total = $r->RecordCount();
           // echo "hola4";exit;
            $collection=array();

            while(!$r->EOF){ 
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           //var_dump($coleccion);
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }


    function get_institutos($conn){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1  AND tipo_publicacion='2' ";
            $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
           // $q.= "LIMIT $limite ";

            //die($q);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);

            //$r =  $conn->Execute($q);

            $this->total = $r->RecordCount();
           // echo "hola4";exit;
            $collection=array();

            while(!$r->EOF){ 
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }


    function get_tramites($conn){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1  AND tipo_publicacion='6' ";
            $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
           // $q.= "LIMIT $limite ";

            //die($q);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);

            //$r =  $conn->Execute($q);

            $this->total = $r->RecordCount();
           // echo "hola4";exit;
            $collection=array();

            while(!$r->EOF){ 
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }


    function get_alcaldia($conn){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1  AND tipo_publicacion='3' ";
            $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
            $q.= "order by id ";

            //die($q);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);

            //$r =  $conn->Execute($q);

            $this->total = $r->RecordCount();
           // echo "hola4";exit;
            $collection=array();

            while(!$r->EOF){ 
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }

    function get_somos($conn){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1  AND tipo_publicacion='5' AND sub_noti=0 ";
            $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
            $q.= "order by id ";

            //die($q);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);

            //$r =  $conn->Execute($q);

            $this->total = $r->RecordCount();
           // echo "hola4";exit;
            $collection=array();

            while(!$r->EOF){ 
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }

    function get_sub_noti($conn,$id){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1  AND tipo_publicacion='5' AND sub_noti=$id ";
            $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
            $q.= "order by id ";

            //die($q);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);

            //$r =  $conn->Execute($q);

            $this->total = $r->RecordCount();
           // echo "hola4";exit;
            $collection=array();

            while(!$r->EOF){ 
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }

    function get_multimedia($conn){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1  AND tipo_publicacion='7'  ";
            $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
            $q.= "order by id ";

            //die($q);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);

            //$r =  $conn->Execute($q);

            $this->total = $r->RecordCount();
           // echo "hola4";exit;
            $collection=array();

            while(!$r->EOF){ 
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }

    function get_busqueda($conn, $from=0, $max=0, $find, $orden='a.mantener DESC,a.fecha DESC,a.hora'){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1   ";
            $q.= empty($find) ? "AND a.tipo_publicacion = '1' " :"";
            $q.= !empty($_SESSION['id']) ? "" : " AND a.estatus='2' ";
            $q.= !empty($find) ? "AND noticia ilike '%$find%'  OR titulo ilike  '%$find%' " :"";
            $q.= "ORDER BY $orden ";
           // $q.= "LIMIT $limite ";

          //  die($q." secion=".$_SESSION['id']);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);
            //$r =  $conn->Execute($q);
            $this->total = $r->RecordCount();
            $collection=array();
            while(!$r->EOF){
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }
function get_busqueda2($conn, $from=0, $max=0, $find, $orden='a.mantener DESC,a.fecha DESC,a.hora'){
        try {
            $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1   ";
            $q.= "  AND a.tipo_publicacion!='1' ";//esto es para que no muestre los enlaces
            $q.= !empty($_SESSION['id']) ? "" : " AND a.estatus='2' ";
            $q.= !empty($find) ? "AND noticia ilike '%$find%'  OR titulo ilike  '%$find%' " :"";
            $q.= "ORDER BY $orden ";
           // $q.= "LIMIT $limite ";

          //  die($q." secion=".$_SESSION['id']);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);
            //$r =  $conn->Execute($q);
            $this->total = $r->RecordCount();
            $collection=array();
            while(!$r->EOF){
                $ue = new noticias;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }
    function get_all($conn, $estatus, $descripcion, $cedula, $dependencia, $from=0, $max=0, $orden="a.id"){
        try {
            $q = "SELECT a.id FROM fondo_medico.siniestros AS a ";
            $q.= "INNER JOIN fondo_medico.asegurados AS b ON (b.id=a.id_asegurado) ";
            $q.= "WHERE 1=1 ";
            $q.= !empty($descripcion) ? "AND (b.nombres ILIKE '%$descripcion%' OR b.apellidos ILIKE '%$descripcion%') ": "";
            $q.= !empty($cedula) ? "AND a.cedula ILIKE '%$cedula%' ": "";
            $q.= !empty($dependencia) ? "AND id_dependencia = '$dependencia' ": "";
            $q.= ($estatus != 3) ? "AND a.estatus = '$estatus' " : "";
            $q.= "ORDER BY $orden ";

            //die($q);

            $r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);
            $this->total = $r->RecordCount();
            $collection=array();
            while(!$r->EOF){
                $ue = new siniestros;
                $ue->get($conn, $r->fields['id']);
                $coleccion[] = $ue;
                $r->movenext();
            }
           
            return $coleccion;
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }

    function add($conn, $titulo, $fecha, $noticia, $url, $tipo_publicacion, $estatus, $mantener,$sub_noti){
        (empty($mantener)) ? $mantener = '0' :"";
        (empty($sub_noti)) ? $sub_noti = '0' :"";
        $id_usuario = $_SESSION['id'];
        $fecha_reg = date("Y-m-d");
        $hora = date("H:i:s");
        $fecha = guardafecha($fecha);

        try {
            $q = "INSERT INTO public.noticias ";
            $q.= "(titulo, fecha, noticia, url, hora, id_usuario,fecha_reg,tipo_publicacion,estatus,mantener,sub_noti) ";
            $q.= "VALUES ";
            $q.= "('$titulo','$fecha','$noticia','$url','$hora','$id_usuario','$fecha_reg','$tipo_publicacion','$estatus','$mantener','$sub_noti') ";
           
            //die($q);
            if($conn->Execute($q)){
                //$this->foto_thumbs($url);
                return 1;
            }else{
                return 2;
            }
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }

    function set($conn, $titulo, $fecha, $noticia, $url, $tipo_publicacion, $estatus, $mantener,$id,$sub_noti){
        (empty($mantener)) ? $mantener = '0' :"";
        (empty($sub_noti)) ? $sub_noti = '0' :"";
        $id_usuario = $_SESSION['id'];
        $fecha_reg = date("Y-m-d");
        $hora = date("H:i:s");
        $fecha = guardafecha($fecha);

        try { 
            $q = "UPDATE public.noticias SET titulo='$titulo', fecha='$fecha', noticia='$noticia', url='$url', hora='$hora', id_usuario='$id_usuario', fecha_reg='$fecha_reg', tipo_publicacion='$tipo_publicacion', estatus='$estatus', mantener='$mantener' , sub_noti='$sub_noti' ";
            $q.= "WHERE id=$id";  
          //die($q);
           if($conn->Execute($q)){
             //$this->foto_thumbs($url);
                return 3;
            }else{
                return 4;
            }
        }
        catch( ADODB_Exception $e ){
            if($e->getCode()==-1)
                return ERROR_CATCH_VFK;
            elseif($e->getCode()==-5)
                return ERROR_CATCH_VUK;
            else
                return ERROR_CATCH_GENERICO;
        }
    }


    function foto_thumbs($dire)
    {
        $thumb = new thumbnail($dire);            // generate image_file, set filename to resize
            $a = explode('/',$dire);
            $dar= end($a);
            $thumb->size_width(144);              // set width for thumbnail, or
            $thumb->size_height(184);             // set height for thumbnail, or
            //$thumb->size_auto(184);             // set the biggest width or height for thumbnail
            $thumb->jpeg_quality(100);            // [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
            //$thumb->show();                     // show your thumbnail
            $thumb->save("img_not/thumbs/".$dar);    
    }


}
?>