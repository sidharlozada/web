<?session_start();?>
<link href="css/bootstrap.css" rel="stylesheet">
<style>
.container {
   
    width:50%;

    height: 50%;
}
</style>

 <div class="container " >
 <div class="jumbotron-usder" >
   <div  class = "row" style="margin-top:20%">

       

        <div  class = "col-md-12" >

<div class="pandel panel-primearry">

            <div class="panel-heading">
              <span class="titulo" >Inicio de Sesión</span><div class="linea" ></div>
            </div>

        <div class=" bordee" style="background-color:#fdfdfd; padding:5px">

 
<br/>
<br/>

   
      <form class="form-signin" role="form" method="POST" action="consultas.php" name="sesion" id="sesion">
        <table border="0"  align="center" class="table-cond4ensed titulo" >
            <tr>
                <td> Usuario: <br> 
                <input type="text" class="form-control" placeholder="Usuario" name="usuario" id="usuario"  autofocus ></td>
            </tr>           
  
            <tr>
                <td> Contraseña: <br>
                 <input type="password" class="form-control" placeholder="Contraseña" name="contra" id="contra" > </td>
            </tr>

            <tr>
    
  
  <td align="right"><input onclick="iniciar(); return false;" type="button" class="btn btn-primary" value="Entrar" name="entrar" id="entrar"></td>
            </tr>

            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr >
                
                <!--<td><a href="registro.php">Registro Nuevo Usuario</a></td>-->
            </tr>
            <tr>
               
                <!--<td><a href="">¿Olvido Su Contraseña?</a></td>-->
            </tr>
        </table>


          <input type="hidden" class="form-control input-group" name="form" id="form" value="sesion">
          <input type="hidden" class="form-control input-group" name="inicio" id="inicio" value="1">

        
      </form>


   
       
      
      <div class="panel-footerr" align="right" style="background-color:#fff; border:0;">
       <a href="">Olvido Contraseña?</a> 
      </div>
    </div><!--panel panel-primary-->
    </div>
    </div><!--col-md-6-->
  

  </div><!--row-->
  
    </div>
  </div>
 <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" language="javascript">

function validar() {
    if($("#usuario").val()=="") {
      alert("Debe Ingresar un Usuario");
      $('#usuario').focus();
      return false;
    }else if ($("#contra").val()=="") {
      alert("Debe Ingresar una Contraseña");
      $('#contra').focus();
      return false;
    }else{

      return true;
    }
}

function iniciar(){
var op = validar();
if(op){
        var parametros = new FormData($("#sesion")[0]);
        $.ajax({
                data:  parametros,
                url:   'login.php',
                type:  'post',
                contentType: false,
                processData:false,
                cache:false,
                beforeSend: function () {
                     $("#env").show();
                },
                success:  function (response) {
                var json = JSON.parse(response);

                if (json ==1){
                   // alert("<? echo ("id =  ".$_SESSION['id']);?>");
                  //document.location.href("index.php");
                  window.location.href = 'config.php';
                }else{
                  alert("Usuario o Contraseña Incorrectas");  
                  //limpiar(); 
                }
              }
        });

}


}

</script>