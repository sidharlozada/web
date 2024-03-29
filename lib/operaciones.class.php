<?
class operaciones{

	// Propiedades

	var $id;
	var $descripcion;
	var $pagina;
	var $id_modulo;
	var $id_padre;
	var $tipo;
	var $nivel;
	var $orden;
	var $nom_padre;
	var $total;

	function get($conn, $id){
		/*$q = "SELECT * FROM operaciones ";
		$q.= "WHERE id='$id'";*/
		$q = "SELECT A. *, B.descripcion AS padre, C.descripcion AS modulo ";
		$q.="FROM operaciones AS A ";
		$q.="LEFT JOIN operaciones AS B ON A.id_padre=B.id ";
		$q.="LEFT JOIN operaciones AS C ON B.id_padre=C.id ";
		$q.="WHERE A.id='$id'";
		//echo $q."<br>";
       // die($q);
		$r = $conn->Execute($q);
		if(!$r->EOF){
			$this->id = $r->fields['id'];
			$this->descripcion = $r->fields['descripcion'];
			$this->pagina = $r->fields['pagina'];
			$this->id_modulo = $r->fields['id_modulo'];
			$this->id_padre = $r->fields['id_padre'];
			$this->tipo = $r->fields['tipo'];
			$this->nivel = $r->fields['nivel'];
			$this->orden = $r->fields['orden'];
			$padre = $r->fields['padre'];
			$modulo = $r->fields['modulo'];
			if(!empty($modulo)){
				$this->nom_padre= $modulo."\\".$padre;
			} else {
				$this->nom_padre= $padre;
			}
			return true;
		}else
			return false;
	}

	function get_all($conn, $id_modulo='0', $orden="id"){
		$q = "SELECT * FROM operaciones WHERE 1=1 ";
		$q.= (!empty($id_modulo)) ? "AND id_modulo = '$id_modulo' " : "";
		$q.= "AND tipo = 'V' ";
		$q.= "ORDER BY $orden ";
		//die($q);
		$r = ($max!=0) ? $conn->SelectLimit($q, $max, $from) : $conn->Execute($q);
		$collection=array();
		while(!$r->EOF){
			$ue = new operaciones;
			$ue->get($conn, $r->fields['id']);
			$coleccion[] = $ue;
			$r->movenext();
		}
		$this->total = $r->RecordCount();
		return $coleccion;
	}

	function add($conn, $descripcion, $pagina, $id_modulo, $id_padre, $tipo, $nivel1, $orden){
		$nivel1 = ($nivel1 == '')? "NULL" : "1";
        $q="SELECT id FROM operaciones WHERE descripcion='$descripcion' AND id_modulo=$id_modulo;";
       // die($q);
        $r = $conn->Execute($q);
        
        if(!$r->EOF){ //SE BUSCA EL REGISTRO
           return 2;
        }
		$q = "INSERT INTO operaciones ";
		$q.= "(descripcion, pagina, id_modulo, id_padre, tipo, nivel, orden) ";
		$q.= "VALUES ";
		$q.= "('$descripcion', '$pagina', $id_modulo, NULL, '$tipo', $nivel1, $orden ) ";
		 // die($q);
		if($conn->Execute($q))
			return 1;
		else
			return $q;
      
	}

	function set($conn, $id, $descripcion, $pagina, $id_modulo, $id_padre, $tipo, $nivel1, $orden){
      $nivel1 = ($nivel1 == '')? "NULL" : "1";//id_padre ='$id_padre'
		$q = "UPDATE operaciones SET descripcion='$descripcion', pagina = '$pagina', id_modulo = $id_modulo, ";
		$q.= " tipo = '$tipo', nivel = $nivel1, orden = $orden ";
		$q.= "WHERE id=$id ";
		//die($q);
		if($conn->Execute($q))
			return 3;
		else
			return $q;
	}

	function del($conn, $id){
		$q = "DELETE FROM operaciones WHERE id='$id'";
		if($conn->Execute($q))
			return true;
		else
			return false;
	}

	function has_permiso($conn, $id_usuario, $id_operacion){
		$q = "SELECT id ";
		$q.= "FROM relacion_us_op  ";
		$q.= "WHERE id_usuario='$id_usuario' AND id_operacion = '$id_operacion' ";
		//die($q);
		//echo $q."<br/>";
		$r = $conn->Execute($q);
		if(!$r->EOF)
			return true;
		else
			return false;
	}

	function del_permiso($conn, $id_usuario, $id_operacion){
		$q = "DELETE FROM relacion_us_op WHERE id_usuario='$id_usuario' AND id_operacion = '$id_operacion' ";
		if($conn->Execute($q))
			return true;
		else
			return false;
	}

	function add_permiso($conn, $id_usuario, $id_operacion){
		$this->del_permiso($conn, $id_usuario, $id_operacion);
		$q = "INSERT INTO relacion_us_op ";
		$q.= "(id_usuario, id_operacion) ";
		$q.= "VALUES ";
		$q.= "('$id_usuario', '$id_operacion' ) ";
		if($conn->Execute($q))
			return true;
		else
			return false;
	}
	
	function getAllMods($conn, $orden="id"){
		$q = "SELECT * FROM modulos   WHERE tipo=true ";
		$q.= "ORDER BY $orden ";
		$r = $conn->Execute($q);
		$collection=array();
		while(!$r->EOF){
			$ue = new operaciones;
			$ue->id = $r->fields['id'];
			$ue->descripcion = $r->fields['descripcion'];
			$coleccion[] = $ue;
			$r->movenext();
		}
		return $coleccion;
	}
	
	function getCarpetas($conn, $id_modulo, $orden="id"){
		$q = "SELECT * FROM operaciones WHERE tipo = 'C' AND id_modulo = '$id_modulo' ";
		//die($q);
		//echo $q."<br>";
		if(!$r = $conn->Execute($q))
			return false;
		while(!$r->EOF){
			$id_padre = $r->fields['id_padre'];
			$q = "SELECT descripcion FROM operaciones WHERE id = $id_padre ";
			//die($q);
			//echo $q."<br>";
			$rs = $conn->Execute($q);
			$collection=array();
			if(!$rs->EOF && !empty($id_padre)){
				$descripcion = $rs->fields['descripcion']. "\\".$r->fields['descripcion'];
			}else{
				$descripcion = $r->fields['descripcion'];
			}
			$ue = new operaciones;
			$ue->id = $r->fields['id'];
			$ue->descripcion = $descripcion;
			$coleccion[] = $ue;
			$r->movenext();
		}
		return $coleccion;
	}

}
?>
