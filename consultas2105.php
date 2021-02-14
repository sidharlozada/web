<?php
include("lib/librerias.php");

$op = $_REQUEST ['op'];
$form = $_REQUEST['form'];

switch ($form) {

	case 'noticias': 
		$noticias = new noticias;

		if(empty($_REQUEST['id']))
		{

			$resp = $noticias->add($conn, $_REQUEST['titulo'],$_REQUEST['fecha'],$_REQUEST['editor'],$_REQUEST['url'],$_REQUEST['tipo_publicacion'],$_REQUEST['estatus'],$_REQUEST['mantener']);
			
			$json=new Services_JSON();
			echo $json->encode($resp);
		}else{

			$resp = $noticias->set($conn, $_REQUEST['titulo'],$_REQUEST['fecha'],$_REQUEST['editor'],$_REQUEST['url'],$_REQUEST['tipo_publicacion'],$_REQUEST['estatus'],$_REQUEST['mantener'],$_REQUEST['id']);
			
			$json=new Services_JSON();
			echo $json->encode($resp);


		}
    
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
	default:
		echo "no entro en la opciones=".$_REQUEST['form'];
	break;
}




?>
