<?
class banner{

    // Propiedades
    var $int_cod;
    var $div_cod;
    var $div_nom;
    var $emp_cod;

    var $total;

    function get($conn, $id){
        try {
            $q = "SELECT * FROM public.banner WHERE id='$id' ";
            //die($q);
            $r = $conn->Execute($q);
            if(!$r->EOF){
                $this->id = $r->fields['id'];
                $this->titulo = $r->fields['titulo'];
                $this->descripcion = $r->fields['descripcion'];
                $this->imagen = $r->fields['imagen'];
                $this->acivo = $r->fields['acivo'];
                $this->id_usuario = $r->fields['id_usuario'];
                $this->estatus = $r->fields['estatus'];
;
                
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
     function add($conn, $titulo,$descripcion,$imagen,$estatus,$id_usuario){
         
         $q="INSERT INTO banner(titulo, descripcion, imagen, estatus, activo, id_usuario) VALUES ('$titulo', '$descripcion','$imagen', $estatus,0,$id_usuario);" ;
         //die($q);
         $r = $conn->Execute($q);
            if($r){//SE INSERTA EL REGISTRO
                 return "<div align='center' style='color:green;font-weight:bold; '>El registro agregado Con exito</div>"; 
            }
             else //ERROR AL REGISTRAR EL REGISTRO
             return "<div align='center' style='color:red;font-weight:bold; '>Error no se agrego el registro </div>"; 
         
     }
    function set($conn,$titulo,$descripcion,$imagen,$estatus,$id_usuario,$id_banner){
		try{
			$q = "UPDATE banner SET  titulo='$titulo', descripcion='$descripcion', imagen='$imagen', estatus=$estatus, 
       id_usuario=$id_usuario WHERE id='$id_banner'; ";
			
			//die($q);
			$r=$conn->Execute($q);
			if($r)
			 return "<div align='center' style='color:green;font-weight:bold; '>Se realizo la actualizacion con exito</div>";
            else
             return "<div align='center' style='color:red;font-weight:bold; '>Error no se Actualizo el registro de los datos</div>".$q;   
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
    function buscar($conn, $orden='a.activo'){
        try {
            $q = "SELECT a.id FROM public.banner AS a ";
            $q.= "WHERE 1=1 ";
            $q.= "AND a.estatus='1' ";
            $q.= "ORDER BY $orden desc";

           // $q.= "LIMIT $limite ";

            //die($q);

            $r =  $conn->Execute($q);
   
            $this->total = $r->RecordCount();
            $collection=array();
            while(!$r->EOF){
                $ue = new banner;
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



}
?>
