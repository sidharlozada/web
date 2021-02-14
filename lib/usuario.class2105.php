<?
class usuario{  
 function get($conn,$id)
    {
        $q="SELECT * FROM usuarios WHERE id='$id' limit 1";
        $r=$conn->Execute($q);

        $this->id = $r->fields['id'];
        $this->cedula = $r->fields['cedula'];
        $this->nombre = $r->fields['nombre'];
        $this->apellido = $r->fields['apellido'];
        $this->login = $r->fields['login'];

        return $this;
    }

    //funcion que hace el proceso de loggeo
    function access_login($conn, $login, $password){
        $passmd5 = md5($password);
        $q="SELECT * FROM usuarios WHERE login='$login' limit 1";
        //die($q);
        $r=$conn->Execute($q);
        if(!$r->EOF){
            if ($r->fields['password']==$passmd5) {
                //CEPV.100706.SM VALIDANDO LA EMPRESA EN CASO QUE EL SISTEMA SEA MULTIEMPRESA
             /*   if($MultiEmpresa!=1 || $this->validar_empresa($conn,$r->fields['id'],$Empresa)){*/
                    session_start();
                    $_SESSION['login'] = $r->fields['login'];   // lleno la variable de sesion
                    $_SESSION['id'] = $r->fields['id'];
                    $_SESSION['nombre'] = $r->fields['nombre'];
                    $_SESSION['apellido'] = $r->fields['apellido'];
                    //$_SESSION['id_reg_session'] = $this->RegistroLogin($conn);
                    return 1;
              /*  }else{
                    return 0;
                }*/
                //CEPV.100706.EM 
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }


function RegistroLogin($conn)
{
    $info=$this->detectSystem();
    //echo "Sistema operativo: ".$info["os"];
    $sistema = $info["os"];

    $ip = $_SERVER['REMOTE_ADDR'];
    $mac = $this->GetMacEquipo($ip);

    $id_usuario = $_SESSION['_AL_id'];
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");


    $q = "INSERT INTO public.reg_session ";
    $q.= "(id_usuario, ip, mac, fecha, hora, sistema) ";
    $q.= "VALUES ";
    $q.= "('$id_usuario','$ip','$mac', '$fecha', '$hora', '$sistema') ";
        //die($q);
    $r = $conn->Execute($q);

    $q="SELECT MAX(id) AS id FROM public.reg_session WHERE id_usuario='$id_usuario' ";
    $r = $conn->Execute($q);

    return $r->fields['id'];
}

function GetMacEquipo($ip)
{
    $comando = `/usr/sbin/arp $ip`;
    ereg(".{1,2}-.{1,2}-.{1,2}-.{1,2}-.{1,2}-.{1,2}|.{1,2}:.{1,2}:.{1,2}:.{1,2}:.{1,2}:.{1,2}", $comando,$mac);
    //echo "<br>La IP <b>".$ip."</b><br>tiene esta MAC Address <b>".strtoupper($mac[0])."</b><br>";

    $mac = strtoupper($mac[0]);
    return $mac;
}

function detectSystem()

{
    $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
    $os=array("WIN","MAC","LINUX");

    # definimos unos valores por defecto para el navegador y el sistema operativo
    $info['browser'] = "OTHER";
    $info['os'] = "OTHER";

    # buscamos el navegador con su sistema operativo
    foreach($browser as $parent)
    {
        $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
        $f = $s + strlen($parent);
        $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
        $version = preg_replace('/[^0-9,.]/','',$version);
        if ($s)
        {
            $info['browser'] = $parent;
            $info['version'] = $version;
        }
    }

    # obtenemos el sistema operativo
    foreach($os as $val)
    {
        if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
        $info['os'] = $val;
    }

    # devolvemos el array de valores
    return $info;
}

    
function add($conn, $cedula,$nombre,$apellido,$login,$password){
		try{
            
            
            $q="SELECT id FROM usuarios WHERE cedula='$cedula' limit 1;";
        $r = $conn->Execute($q);
        if(!$r->EOF){ //SE BUSCA EL REGISTRO
           return 2;
        }
           $q="SELECT id FROM usuarios WHERE login='$login' limit 1;";
        $r = $conn->Execute($q);
        if(!$r->EOF){ //SE BUSCA EL REGISTRO
           return 3;
        } 
            
            
            
			$passMD5 = md5($password);
			$q = "INSERT INTO usuarios ";
			$q.= "(nombre, apellido, cedula, login, password) ";
			$q.= "VALUES ";
			$q.= "('$nombre', '$apellido', $cedula,  '$login', '$passMD5') ";
			//die($q);
			$r=$conn->Execute($q);
            if($r){//SE INSERTA EL REGISTRO
                 return 1; 
            }
             else //ERROR AL REGISTRAR EL REGISTRO
             return 4; 

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
  function set($conn,$id,$cedula,$nombre,$apellido,$login,$password){
		try{
			$passMD5 = md5($password);
			$q = "UPDATE usuarios SET cedula = '$cedula', nombre = '$nombre', apellido = '$apellido', login = '$login', ";
			$q.= "password = '$passMD5' ";
			$q.= "WHERE id='$id' ";
			//die($q);
			$r=$conn->Execute($q);
			if($r)
			 return 5;
            else
             return 4;   
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