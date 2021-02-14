<span class="titulo" >Administracion Menu Principal</span><div class="linea" ></div>
   <div  class = "row" style="margin-top:50px">

        <div  class = "col-md-2" > </div>

        <div  class = "col-md-8" >

        <div class=" borde" style="background-color:#fdfdfd; padding:5px">

 
<br/>
<br/>

   
      <form class="form-signin" role="form" method="POST" action="" name="formmodulo" id="formmodulo">
        <table border="0"  align="center" class="table-condensed titulo" >
            <tr>
                <td> Modulo: </td> 
                <td> <input type="text" class="form-control" placeholder="Modulo" name="modulo" id="modulo"  autofocus ></td>
            </tr>
            <tr>
                <td> Orden: </td>
                <td> <input  type="text" class="form-control" placeholder="Orden" name="orden" id="orden" > </td>
            </tr>
            <tr>
                <td colspan="2"><input type="button" name="admodulo" id="admodulo" value="Agregar Modulo" >  </td> 
               
            </tr>           
            <tr>
                <td> Lista de Modulos </td> 
                <td><select name="modulo" id="modulo"> 
                <option value="">Seleccione</option>
                </select> </td>
            </tr>
          </table>
           </form>
        <form class="form-signin" role="form2" method="POST" action="" name="formoperaciones" id="formoperaciones">
          <table border="0"  align="center" class="table-condensed titulo" >  
            <tr>
                <td> Descricion: </td>
                <td> <input  type="text" class="form-control" placeholder="Pagina" name="pagina" id="pagina" > </td>
            </tr>
            <tr>
                <td> Pagina: </td>
                <td> <input  type="text" class="form-control" placeholder="Pagina" name="pagina" id="pagina" > </td>
            </tr>
            <tr>
                <td> Tipo: </td>
                <td> <select name="tipo" id="tipo"> 
                <option value="">Seleccione</option>
                <option value="C">Carpeta</option>
                <option value="V">Vinculo</option>
                </select>
                </td>
            </tr>

            <tr>
                <td> Modulo: </td>
                <td> <select name="modulo" id="modulo"> 
                <option value="">Seleccione</option>
                </select>
                </td>
            </tr>
            <tr>
                <td> Orden: </td>
                <td> <input  type="text" class="form-control" placeholder="Orden" name="orden" id="orden" > </td>
            </tr>
            <tr>
                 <td colspan="2"><input type="button" name="adoperaciones" id="adoperaciones" value="Agregar" >  </td> 
            </tr>
            
            <tr >
                
                <!--<td><a href="registro.php">Registro Nuevo Usuario</a></td>-->
            </tr>
            <tr>
               
                <!--<td><a href="">¿Olvido Su Contraseña?</a></td>-->
            </tr>
        </table>

        
      </form>


   
    
      
    </div><!--panel panel-primary-->
    </div><!--col-md-6-->
  

  </div><!--row-->

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
                  document.location.reload();
                }else{
                  alert("Usuario o Contraseña Incorrectas");  
                  //limpiar(); 
                }
              }
        });

}


}

</script>