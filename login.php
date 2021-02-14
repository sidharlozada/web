<? 
//session_start();
require("lib/conn.php");
require("lib/usuario.class.php");
require("lib/JSON.php");


    $usuario = new usuario;
    $resp = $usuario->access_login($conn, $_POST['usuario'],$_POST['contra']);
//die("id =  ".$_SESSION['id']);
    $json=new Services_JSON();
    echo $json->encode($resp);

?>