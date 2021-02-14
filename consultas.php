<?php
include("lib/librerias.php");
session_start();
$op = $_REQUEST ['op'];
$form = $_REQUEST['form'];

switch ($form) {

	case 'noticias': 
		$noticias = new noticias;

		if(empty($_REQUEST['id']))
		{

			$resp = $noticias->add($conn, $_REQUEST['titulo'],$_REQUEST['fecha'],$_REQUEST['editor'],$_REQUEST['url'],$_REQUEST['tipo_publicacion'],$_REQUEST['estatus'],$_REQUEST['mantener'],$_REQUEST['sub_noti']);
			
			$json=new Services_JSON();
			echo $json->encode($resp);
		}else{

			$resp = $noticias->set($conn, $_REQUEST['titulo'],$_REQUEST['fecha'],$_REQUEST['editor'],$_REQUEST['url'],$_REQUEST['tipo_publicacion'],$_REQUEST['estatus'],$_REQUEST['mantener'],$_REQUEST['id'],$_REQUEST['sub_noti']);
			
			$json=new Services_JSON();
			echo $json->encode($resp);


		}
    
	break;
    case 'banner': 
		$banner = new banner;
        $json=new Services_JSON();
        $accion = $_REQUEST['tipooperaciones'];
        $cad="";
        $validextensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $_FILES["file"]["name"]);
            $file_extension = end($temporary);
           $type = basename($_FILES['file']['type']);
           $size=$HTTP_POST_FILES['file']['size']/1000;
           $bites=1579.759;//TAMAÑO MAXIMO DEL ARCHIVO PARA QUE EL ALUMNO SUBA LOS ARCHIVOS 
          $archivo="";
           
          if($size<$bites){//ANALIZA EL TAMAÑO DEL ARCHIVO
	   
	 $type = "imagen";
	        $archicorrecto=0;
         switch ($type) {
	  case 'imagen':      
	  $nombre=substr(md5(uniqid(rand(),true)),0,32);//genera una cadena unica de treinta y dos caracteres
      $hoy = date("j-n-Y-H-i-s");
	  $filename = "img/fondoInicio/".$nombre.".".$file_extension ;
	  $archivo=$nombre.".".$file_extension ;
	  if (file_exists($filename)) {
	       $nombre=substr(md5($hoy),0,32);
		   $filename = "img/fondoInicio/".$nombre.".".$file_extension ;
		   $archivo=$nombre.".".$file_extension ;
	   }
	   
	     $archicorrecto=1;
	   break;
	/*	 case 'png':
	  case 'x-png':
	  $nombre=substr(md5(uniqid(rand(),true)),0,32);//genera una cadena unica de treinta y dos caracteres
      $hoy = date("j-n-Y-H-i-s");
	  $filename = "img/fondoInicio/".$nombre.".".$file_extension ;
	  $archivo_alumno=$nombre.".".$file_extension ;
	  if (file_exists($filename)) {
	       $nombre=substr(md5($hoy),0,32);
		   $filename = "img/fondoInicio/".$nombre.".".$file_extension ;
		   $archivo=$nombre.".".$file_extension ;
	   }
	   $archicorrecto=1;
	    
      break;
		 */
	  default:        
	  fechaerror=="visible";
	   $documento="visible";
	  $cadenaError="<br/><div align='center' style='color:red;font-weight:bold;'><p>!ERROR formato Invalido del archivo</p><p>Sólo se permite Formato de Imagenes(*.jpg,png,gif)</p></div>"; 
	       echo strtoupper($cadenaError);exit;
	  break;
    }
         
      }
       else{
	  $cadenaError="<br/><div align='center' style='color:red;font-weight:bold;'><p>!ERROR EL ARCHIVO es muy pesado maximo 1579KB</p></div>";
	       echo strtoupper($cadenaError);exit;
	
	} 
        
        
        
        
     if($accion == 'Agregar' && !empty($_SESSION['id']))
		{    
              if($archicorrecto==1){
                  
                  $cadenaError=$banner->add($conn, $_REQUEST['titulo'],$_REQUEST['descripcion'],$archivo,$_REQUEST['estatu'],$_SESSION['id']);    
             if(@move_uploaded_file($_FILES['file']['tmp_name'],$filename)){
			$cadenaError.="<div align='center' style='color:green;font-weight:bold; '><p>se subio la imagen con exito</p><p>si no ve reflejados los cambios actualize el navegador web</p></div>";          //       unset($_POST);
			  echo strtoupper($cadenaError);
			  }
			  else{
			    $cadenaError.="<div align='center' style='color:red;font-weight:bold;'><p>ERROR NO SE actualizo el REGISTRO</p><p> PUEDE NO TENER PERMISOS PARA SUBIR ARCHIVOS O NO SE ENCUENTRA EL DIRECTORIO PARA MOVER EL ARCHIVO ENVIADO</p></div>";
			   /* $idinmueble=$handle->DB_insert_id();
			      $sql="DELETE FROM  inmuebles  where  id_inmueble='".$idinmueble."' limit 1";
				  $handle->DB_sql($sql);*/
				  echo strtoupper($cadenaError);
			      }
                  
              }
         
          
			
		}else if($accion == 'Actualizar'&& !empty($_SESSION['id'])){    
           if($archicorrecto==1){
             $cadenaError=$banner->set($conn, $_REQUEST['titulo'],$_REQUEST['descripcion'],$archivo,$_REQUEST['estatu'],$_SESSION['id'],$_REQUEST['idbanner']);  
             if(@move_uploaded_file($_FILES['file']['tmp_name'],$filename)){
			$cadenaError.="<div align='center' style='color:green;font-weight:bold; '><p>se subio la imagen con exito</p><p>si no ve reflejados los cambios actualize el navegador web</p></div>";         //       unset($_POST);
			  echo strtoupper($cadenaError);
                 @ unlink("img/fondoInicio/" . $_REQUEST['nombrefile']); //echo "**************DESPUES DE ELIMINAR**********=".$name_archivo;
			  }
			  else{
			    $cadenaError.="<div align='center' style='color:red;font-weight:bold;'><p>ERROR NO SE subio la imagen</p><p> PUEDE NO TENER PERMISOS PARA SUBIR ARCHIVOS O NO SE ENCUENTRA EL DIRECTORIO PARA MOVER EL ARCHIVO ENVIADO</p></div>";
			   /* $idinmueble=$handle->DB_insert_id();
			      $sql="DELETE FROM  inmuebles  where  id_inmueble='".$idinmueble."' limit 1";
				  $handle->DB_sql($sql);*/
				  echo strtoupper($cadenaError);
			      }
             
         }
         
		}
        else
           echo strtoupper("<div align='center' style='color:red;font-weight:bold; '><p>Error actualize el navegador web</p></div");
	break;
    case 'formmodulo':
         $menu= new menu;
        $json=new Services_JSON();
      //  echo "variable=".$_REQUEST['txtmodulo'];exit;
        if($_REQUEST['tipomodulo']=='Agregar'){
           $resp=$menu->addmodulo($conn,$_REQUEST['txtmodulo'],$_REQUEST['txtOrdenmodulo'], $_REQUEST['txttipo']); 
        }elseif($_REQUEST['tipomodulo']=='Actualizar'){
            $resp=$menu->setmodulo($conn,$_REQUEST['txtmodulo'],$_REQUEST['txtOrdenmodulo'], $_REQUEST['txttipo'], $_REQUEST['idmodulo']); 
        }
        
       echo $json->encode($resp);
	break;
    case 'editarmodulo': //echo "hola5555555555555";exit;
        $menu= new menu;
        $resp=$menu->getmodulo($conn,$_REQUEST['id_modulo']);
        $json=new Services_JSON();
			echo $json->encode($resp);
        break;
   case 'editaroperaciones': //echo "hola5555555555555";exit;
        $menu= new menu;
        $resp=$menu->getedioperaciones($conn,$_REQUEST['id_operaciones']);
        $json=new Services_JSON();
			echo $json->encode($resp);
        break;
   case 'formoperaciones':
        $json=new Services_JSON();
        $oOperaciones = new operaciones;
    $accion = $_REQUEST['tipooperaciones'];
       // echo "Hola"; exit;
     if($accion == 'Agregar'){  
          $resp=$oOperaciones->add($conn,$_POST['descripcion'],$_POST['pagina'],$_POST['modulo'],$_POST['padre'],$_POST['tipo'],$_POST['nivel1'],$_POST['orden']);
	//echo $json->encode($accion);exit;	
    }elseif($accion == 'Actualizar'){
	      $resp=$oOperaciones->set($conn,$_POST['idoperaciones'],$_POST['descripcion'],$_POST['pagina'],$_POST['modulo'],$_POST['padre'],$_POST['tipo'],$_POST['nivel1'],$_POST['orden']);
	
    }
        echo $json->encode($resp);
	break;
    case 'tablamodulo':
       include("contenido/tablademodulos.php");
        $pagina = $_REQUEST['pagina'];
        tabla_modulos($conn,$pagina);
    break;
    case 'tablabanner':
       include("contenido/tablademodulos.php");
        $pagina = $_REQUEST['pagina'];
        tabla_banner($conn,$pagina);
    break;
    case 'editarbanner': //echo "hola5555555555555";exit;
        $banner = new banner;
        $resp=$banner->get($conn,$_REQUEST['id_banner']);
        $json=new Services_JSON();
			echo $json->encode($resp);
        break;
    case 'tablausuarios':
       include("contenido/tablademodulos.php");
        $pagina = $_REQUEST['pagina'];
        tabla_usuarios($conn,$pagina);
    break;
    case 'editarusuario': //echo "hola5555555555555";exit;
        $usuario= new usuario;
        $resp=$usuario->get($conn,$_REQUEST['id_usuario']);
        $json=new Services_JSON();
			echo $json->encode($resp);
        break;
    case 'tablaoperaciones':
       include("contenido/tablademodulos.php");
        $pagina = $_REQUEST['pagina'];
        tabla_operaciones($conn,$pagina);
    break;
    case 'formusuario':
        $json=new Services_JSON();
       $usuario= new usuario;
       
        
       $accion = $_REQUEST['tipousuario'];
      //  echo "Hola8"; exit;
     if($accion == 'Agregar'){  
        $resp=$usuario->add($conn,$_POST['cedula'],$_POST['nombre'],$_POST['apellidos'],$_POST['login'],$_POST['pass']);
        // add($conn, $cedula,$nombre,$apellido,$login,$password)
	//echo $json->encode($accion);exit;	
    }elseif($accion == 'Actualizar'){
	     $resp=$usuario->set($conn,$_POST['idusuario'],$_POST['cedula'],$_POST['nombre'],$_POST['apellidos'],$_POST['login'],$_POST['pass']);
	
    }
        echo $json->encode($resp);
    break;
    case 'ActualizarClave':
       $oUsuarios = new usuario;
       $accion = $_REQUEST['accion'];
       // echo "hola";exit;
        if($accion == 'ActualizarClave'){
		         $a = $oUsuarios->verifica_password($conn, $_SESSION['id'], $_REQUEST['passwordActual']);
	      if($a){	 
		        $msj = $oUsuarios->set_password($conn,$_SESSION['id'], $_REQUEST['password']);
	//	$msj = "Su Clave es: ".$msj;
		       // $msj = "Contrase&ntilde;a Cambiada con Exito";
              echo 1;
	      }else{
		      echo 2;
	       }
}
    break;   

    case 'contacto':
        $resp =1;
        $json=new Services_JSON();
        echo $json->encode($resp);
      
    break;

    case 'sub_publicaciones':

    $id_noticia = $_POST['id_noticia'];
    $id_tipo = $_POST['id_tipo'];

      $q ="SELECT id, titulo as descripcion FROM public.noticias WHERE estatus='2' and tipo_publicacion=$id_tipo and sub_noti=0 ORDER BY id ";
      echo helpers::superCombo($conn, $q,$id_noticia, 'sub_noti', 'sub_noti', 'width:100%', "",'id','descripcion','','','','Seleccione','form-control');

    break;







	default:
		echo "no entro en la opciones=".$_REQUEST['form'];
	break;
}




?>
