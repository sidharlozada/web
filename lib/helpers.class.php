<?php
error_reporting (0);
//include("lib/comun.php");

class helpers{
	

	/*********************************************************************************************************************	
    Dibuja un combo (nodo select) a partir de un patron
    
   superCombo(   $conn, << conexion adodb
                 $patron, << esta variable puede recibir 3 elementos:
                          1) El nombre de una tabla, de ser utilizado este patron los atributos name y id seran iguales
                             al nombre de la misma.
                             a la cual se va a hacer la consulta tipo "SELECT * FROM $tabla",
                          2) Un query sql, en caso que sea una consulta mas complicada
                          3) Un array de objetos
                 $id_seleccionado='', << si tenemos un registro seleccionado, aca enviamos el ID (value)
                 $nombre='', << atributo name del nodo Select
                 $id='', << atributo id del nodo Select
                 $style='', << atributo style del nodo Select
                 $onchange='', << atributo onchange del nodo Select
                 $descValor = 'id', << nombre del campo en la BD que sera el value del nodo Select
                 $descDescripcion = 'descripcion', << nombre del campo en la BD que sera la descripcion del nodo Select
                 $orden='', << SQL: "ORDER BY $orden"
                 $tamanoDesc='', << cantidad de caracteres maximo para la descripcion
                 $attr='', << algun atributo adicional como por ejemplo, readonly=readonly
                 $valorCero='Seleccione') << descripcion del valor cero del combo
	*********************************************************************************************************************/
	function superCombo($conn,
                       $patron,
                       $id_seleccionado='', 
                       $nombre='', 
                       $id='', 
                       $style='', 
                       $onchange='',
                       $descValor = 'id',
                       $descDescripcion = 'descripcion',
                       $orden='',
                       $tamanoDesc='',
                       $attr='',
                       $valorCero='Seleccione',
                       $class='form-control'){
		$xml = new DomDocument();
		$nodoSelect = $xml->createElement('select');
		$nodoSelect->setAttribute('name', $nombre);
		$nodoSelect->setAttribute('id', $id);
		if(!empty($style))
			$nodoSelect->setAttribute('style', $style);
		if(!empty($class))
			$nodoSelect->setAttribute('class', $class);
		if(!empty($onchange))
			$nodoSelect->setAttribute('onchange', $onchange);
		if(!empty($valorCero)){
			$nodoSelect->setAttribute('data-toggle', 'tooltip');
			$nodoSelect->setAttribute('title', $valorCero);
			//$nodoSelect->setAttribute('data-placement', 'left');

		}
		if(!empty($attr))
			switch($attr){
				case "disabled":
					$nodoSelect->setAttribute('disabled', 'disabled');
					break;
				case "multiple":
					$nodoSelect->setAttribute('multiple', 'multiple');
					break;
				default:
					break;
			}
		$nodoOption = $xml->createElement('option');
		if(!empty($valorCero)){
			$nodoOption->setAttribute('value', 0);
			$nodoOption->appendChild($xml->createTextNode($valorCero));
			$nodoSelect->appendChild($nodoOption);
		}

		switch (gettype($patron)) {
			case 'array':
				foreach($patron as $objeto){
					$nodoOption = $xml->createElement('option');
					$nodoOption->setAttribute('value', $objeto->$descValor);
					$descripcion = $objeto->$descDescripcion;
					if(!empty($tamanoDesc) && (strlen($descripcion) > $tamanoDesc))
						$descripcion = substr($descripcion, 0, $tamanoDesc)."(...)";
					$nodoTextoDescripcion = $xml->createTextNode($descripcion);
					$nodoOption->appendChild($nodoTextoDescripcion);
					if($objeto->$descValor == $id_seleccionado)
						$nodoOption->setAttribute('selected', 'selected');
					$nodoSelect->appendChild($nodoOption);
				}
				break;
			case 'string':
				if(str_word_count($patron) == 1){
					$nombre = empty($nombre)? $patron : $nombre;
					$id = empty($id) ? $patron : $id;
				}
				$orden = !empty($orden) ? "ORDER BY $orden" : "";
				$q = strstr($patron, " ") == false ? "SELECT * FROM $patron $orden " : $patron;
				if(!$r = $conn->Execute($q))
					return false;
				while(!$r->EOF){
					$nodoOption = $xml->createElement('option');
					$nodoOption->setAttribute('value', $r->fields[$descValor]);
					$descripcion = $r->fields[$descDescripcion];
					if(!empty($tamanoDesc) && (strlen($descripcion) > $tamanoDesc))
						$descripcion = substr($descripcion, 0, $tamanoDesc)."(...)"; 
					$nodoTextoDescripcion = $xml->createTextNode($descripcion);
					$nodoOption->appendChild($nodoTextoDescripcion);
					if($r->fields[$descValor] == $id_seleccionado)
						$nodoOption->setAttribute('selected', 'selected');
					$nodoSelect->appendChild($nodoOption);
					$r->movenext();
				}
		}
		return $xml->saveXML($nodoSelect);
	}
	

	function combo_us($conn, $tabla, $style='', $order='id', $nombre='', $id='', $onchange,$sql){
	$q = empty($sql) ? "SELECT * FROM $tabla ORDER BY $order" : $sql;
	$r = $conn->Execute($q);
	$nombre = (empty($nombre)? $tabla : $nombre);
	$id = (empty($id)? $tabla : $id);
	$combo = "<select onchange=\"$onchange\" name=\"$nombre\" id=\"$id\"";
	$combo.= (!empty($style))? "class=\"$style\"" : "";
	$combo.= ">\n";
	$combo.="<option value=\"0\">Seleccione</option>\n";
	while(!$r->EOF){
		$id = $r->fields['id'];
		$descripcion = $r->fields['nombre'] ." ".$r->fields['apellido'];
		if($id == $id_selected)
			$combo.="<option value=\"$id\" selected=\"selected\">$descripcion</option>\n";
		else
			$combo.="<option value=\"$id\">$descripcion</option>\n";
		$r->movenext();
	}
	$combo.="</select>\n";
	return $combo;
	}
	
	function combo_tipo_donacion($conn, 
								$tabla, 
								$id_selected='', 
								$style='', 
								$order='id', 
								$nombre='',
								$Campo1='', 
								$Campo2='', 
								$id='', 
								$atributo='',
								$sql='',
								$onchange='',
								$Seleccione='',
								$SeleccioneDesc='Seleccione',
								$donaciones=''){
		
		$q = empty($sql) ? "SELECT * FROM social.$tabla ORDER BY $order" : $sql;
		$r = $conn->Execute($q);
	
		$i=0;
		$i=count($donaciones);
				
		$nombre = empty($nombre)? $tabla : $nombre;
		$id = empty($id) ? $nombre : $id;
		$combo = "<select class=\"form-control input-group\" onChange=\"$onchange\" name=\"$nombre\" id=\"$id\" ";
		$combo.= (!empty($atributo))? "$atributo" : "";
		$combo.= (!empty($style))? " style=\"$style\"" : "";
		$combo.= ">\n";
		if(!empty($Seleccione)){ $combo.="<option value=\"-1\">$SeleccioneDesc</option>\n";}
		//die($combo);
		
		while(!$r->EOF){
				
			$id = $r->fields[$Campo1];
			$descripcion = $r->fields[$Campo2];
			
			if($i==0){
			if($id == $id_selected)
				$combo.="<option value=\"$id\" selected=\"selected\">$descripcion</option>\n";
			else
				$combo.="<option value=\"$id\">$descripcion</option>\n";
			}else{
			
			$band=0;
			
			for($j=0;$j<$i;$j++){
			if($id == $donaciones[$j]['id_tipo_donacion'])
			$band=1;
			}
			
			if($band==1)
				$combo.="<option value=\"$id\" selected=\"selected\">$descripcion</option>\n";
			else
				$combo.="<option value=\"$id\">$descripcion</option>\n";
			}
			
						
			$r->movenext();
		}
		
		
		
		$combo.="</select>\n";
		return $combo;
	}



function combonominaIV($conn, 
								$tabla, 
								$id_selected='', 
								$style='', 
								$order='int_cod', 
								$nombre='',
								$Campo1='', 
								$Campo2='', 
								$Campo3='', 
								$Campo4='',
								$id='', 
								$atributo='',
								$sql='',
								$onchange='',
								$Seleccione='',
								$tamanoDesc='',
								$SeleccioneDesc='Seleccione'){
		$q = empty($sql) ? "SELECT * FROM $tabla ORDER BY $order" : $sql;
		//echo $q;
		$class="form-control select";
		$r = $conn->Execute($q);
		$nombre = empty($nombre)? $tabla : $nombre;
		$id = empty($id) ? $nombre : $id;
		$combo = "<select class=\"$class\" onChange=\"$onchange\" name=\"$nombre\" id=\"$id\"";
		$combo.= (!empty($atributo))? "$atributo" : "";
		$combo.= (!empty($style))? " style=\"$style\"" : "";
		$combo.= ">\n";
		if(!empty($Seleccione)){ $combo.="<option value=\"-1\">$SeleccioneDesc</option>\n";}
		//die($combo);
		while(!$r->EOF){
			$id = $r->fields[$Campo1];
			
			$descripcion = $r->fields[$Campo2]." ".$r->fields[$Campo3];
			!empty($Campo4) ? $descripcion.= " - ".$r->fields[$Campo4] : "";
			!empty($r->fields['dep_nom']) ? $descripcion.= " - ".$r->fields['dep_nom'] : "";

			if(!empty($tamanoDesc) && (strlen($descripcion) > $tamanoDesc))
						$descripcion = substr($descripcion, 0, $tamanoDesc)."(...)"; 

			if($id == $id_selected)
				$combo.="<option value=\"$id\" selected=\"selected\">$descripcion</option>\n";
			else
				$combo.="<option value=\"$id\">$descripcion</option>\n";
			$r->movenext();
		}
		$combo.="</select>\n";
		return $combo;
	}
	


	function combogrid($obj, $posicion, $id = 'id', $descripcion='descripcion', $textoSeleccion='Seleccionar..', $nombregrid='mygrid'){
		//die($descripcion);
		//die(print_r($obj));
			echo "$nombregrid.getCombo($posicion).put('0','".$textoSeleccion."');";
			if(is_array($obj)){
				foreach($obj as $objeto){
					 echo "$nombregrid.getCombo($posicion).put('".$objeto->$id."','".$objeto->$descripcion."');";
				}
			}
	}
	

}
?>
