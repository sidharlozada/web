<?php   
function tabla_modulos($conn,$pagina){ 
    $tamano_pagina = 5;
if (!$pagina)
{
  $pagina = 1;
  $inicio = 0;
}
else
  $inicio = ($pagina - 1) * $tamano_pagina;
    $q="SELECT * FROM modulos WHERE id is not null ORDER BY id DESC";
    $r = $conn->Execute($q);//	 $r->fields['id'];
    $total = $r->RecordCount();
   // $r = ($max!=0) ? $conn->SelectLimit($q,  $tamano_pagina, $inicio) : $conn->Execute($q);
     $r = $conn->SelectLimit($q,  $tamano_pagina, $inicio);
    ?><div >
    <table class="bordered"  >
        <thead><tr><th>ID</th><th>DESCRIPCIÓN</th><th>ORDEN</th></tr></thead>
    <?php
    while(!$r->EOF){	?>
     <tr onclick="funcEditarmenu(<?=$r->fields['id'];?>);" ><td><?=$r->fields['id'];?></td><td><?=$r->fields['descripcion'];?></td><td><?=$r->fields['orden'];?></td></tr> 
<?php 
        	$r->movenext();
	}  ?>
	</table>
<?php 
    $total_paginas = ceil($total / $tamano_pagina); ?>
   <table align="center">
       <tr class="filas">  
              <td colspan="7" align="center">
                <ul class="pagination  pagination-sm">
                <? if($pagina=='1'){ 
                     echo '<li class="disabled"><a href="#">«</a></li>';
                }else{
                      $pag = $pagina - 1;
                      echo '<li onclick="functablamodulos('.$pag.');"><a href="#">«</a></li>';
                }?>

                  <?
                  for ($j=1; $j<=$total_paginas; $j++)
                  {
                    if ($j==$pagina)
                      echo '<li class="active"><a href="#">'.($j>1 ? '':'').$j.'<span class="sr-only actual"></span></a></li>';
                    else
                      echo '<li onclick="functablamodulos('.$j.');"><a href="#"><span style="cursor:pointer" >'.($j>1 ? '':'').$j.'</span></a></li>';
                  }
                  ?>
                  <? if($pagina==$total_paginas){ 
                      echo '<li class="disabled"><a href="#">»</a></li>';
                  }else{
                      $pag = $pagina + 1;
                      echo '<li onclick="functablamodulos('.$pag.');"><a href="#">»</a></li>';
                  }?>

                </ul>
                <br>
                Pagina <strong><?=$pagina?></strong> de <strong><?=$total_paginas?></strong>
              </td>
            </tr>
   </table>
    </div>
     <?php
}

?>
<?php   
function tabla_operaciones($conn,$pagina){ //echo "HOLA JAJA";exit;
    $tamano_pagina = 5;
if (!$pagina)
{
  $pagina = 1;
  $inicio = 0;
}
else
  $inicio = ($pagina - 1) * $tamano_pagina;
    $q="SELECT * FROM operaciones WHERE id is not null ORDER BY id DESC";
    $r = $conn->Execute($q);//	 $r->fields['id'];
    $total = $r->RecordCount();
   // $r = ($max!=0) ? $conn->SelectLimit($q,  $tamano_pagina, $inicio) : $conn->Execute($q);
     $r = $conn->SelectLimit($q,  $tamano_pagina, $inicio);
    ?><div >
    <table class="bordered"  >
        <thead><tr><th>ID</th><th>DESCRIPCIÓN</th><th>PAGINA</th><th>ORDEN</th></tr></thead>
    <?php
    while(!$r->EOF){	?>
     <tr onclick="funcEditarOperaciones(<?=$r->fields['id'];?>);" ><td><?=$r->fields['id'];?></td><td><?=$r->fields['descripcion'];?></td><td><?=$r->fields['pagina'];?></td><td><?=$r->fields['orden'];?></td></tr> 
<?php 
        	$r->movenext();
	}  ?>
	</table>
<?php 
    $total_paginas = ceil($total / $tamano_pagina); ?>
   <table align="center">
       <tr class="filas">  
              <td colspan="7" align="center">
                <ul class="pagination  pagination-sm">
                <? if($pagina=='1'){ 
                     echo '<li class="disabled"><a href="#">«</a></li>';
                }else{
                      $pag = $pagina - 1;
                      echo '<li onclick="functablaoperaciones('.$pag.');"><a href="#">«</a></li>';
                }?>

                  <?
                  for ($j=1; $j<=$total_paginas; $j++)
                  {
                    if ($j==$pagina)
                      echo '<li class="active"><a href="#">'.($j>1 ? '':'').$j.'<span class="sr-only actual"></span></a></li>';
                    else
                      echo '<li onclick="functablaoperaciones('.$j.');"><a href="#"><span style="cursor:pointer" >'.($j>1 ? '':'').$j.'</span></a></li>';
                  }
                  ?>
                  <? if($pagina==$total_paginas){ 
                      echo '<li class="disabled"><a href="#">»</a></li>';
                  }else{
                      $pag = $pagina + 1;
                      echo '<li onclick="functablaoperaciones('.$pag.');"><a href="#">»</a></li>';
                  }?>

                </ul>
                <br>
                Pagina <strong><?=$pagina?></strong> de <strong><?=$total_paginas?></strong>
              </td>
            </tr>
   </table>
    </div>
     <?php
}

?>
<?php   
function tabla_usuarios($conn,$pagina){ 
    $tamano_pagina = 5;
if (!$pagina)
{
  $pagina = 1;
  $inicio = 0;
}
else
  $inicio = ($pagina - 1) * $tamano_pagina;
    $q="SELECT id, nombre, apellido, cedula, login, password, status
  FROM usuarios ORDER BY id DESC";
    $r = $conn->Execute($q);//	 $r->fields['id'];
    $total = $r->RecordCount();
   // $r = ($max!=0) ? $conn->SelectLimit($q,  $tamano_pagina, $inicio) : $conn->Execute($q);
     $r = $conn->SelectLimit($q,  $tamano_pagina, $inicio);
    ?><div >
    <table class="bordered"  >
        <thead><tr><th>USUARIO</th><th>NOMBRE</th><th>CEDULA</th></tr></thead>
    <?php
    while(!$r->EOF){	?>
     <tr onclick="funcEditarmenu(<?=$r->fields['id'];?>);" ><td><?=$r->fields['login'];?></td><td><?=$r->fields['nombre'];?></td><td><?=$r->fields['cedula'];?></td></tr> 
<?php 
        	$r->movenext();
	}  ?>
	</table>
<?php 
    $total_paginas = ceil($total / $tamano_pagina); ?>
   <table align="center">
       <tr class="filas">  
              <td colspan="7" align="center">
                <ul class="pagination  pagination-sm">
                <? if($pagina=='1'){ 
                     echo '<li class="disabled"><a href="#">«</a></li>';
                }else{
                      $pag = $pagina - 1;
                      echo '<li onclick="functablausuarios('.$pag.');"><a href="#">«</a></li>';
                }?>

                  <?
                  for ($j=1; $j<=$total_paginas; $j++)
                  {
                    if ($j==$pagina)
                      echo '<li class="active"><a href="#">'.($j>1 ? '':'').$j.'<span class="sr-only actual"></span></a></li>';
                    else
                      echo '<li onclick="functablausuarios('.$j.');"><a href="#"><span style="cursor:pointer" >'.($j>1 ? '':'').$j.'</span></a></li>';
                  }
                  ?>
                  <? if($pagina==$total_paginas){ 
                      echo '<li class="disabled"><a href="#">»</a></li>';
                  }else{
                      $pag = $pagina + 1;
                      echo '<li onclick="functablausuarios('.$pag.');"><a href="#">»</a></li>';
                  }?>

                </ul>
                <br>
                Pagina <strong><?=$pagina?></strong> de <strong><?=$total_paginas?></strong>
              </td>
            </tr>
   </table>
    </div>
     <?php
}

?>
<?php   
function tabla_banner($conn,$pagina){ 
    $tamano_pagina = 3;
if (!$pagina)
{
  $pagina = 1;
  $inicio = 0;
}
else
  $inicio = ($pagina - 1) * $tamano_pagina;
    $q="SELECT id, titulo, descripcion, imagen, estatus, activo, id_usuario, 
       id_noticia
  FROM banner WHERE id IS NOT NULL ORDER BY id DESC";
    $r = $conn->Execute($q);//	 $r->fields['id'];
    $total = $r->RecordCount();
   // $r = ($max!=0) ? $conn->SelectLimit($q,  $tamano_pagina, $inicio) : $conn->Execute($q);
     $r = $conn->SelectLimit($q,  $tamano_pagina, $inicio);
    ?><div >
    <table class="bordered"  align="center" >
        <thead><tr><th></th><th>TITULO</th><th>ESTATUS</th></tr></thead>
    <?php
    while(!$r->EOF){	?>
     <tr onclick="funcEditarmenu(<?=$r->fields['id'];?>);" ><td><img alt="" width="100px;" height="70px;" src="img/fondoInicio/<?=$r->fields['imagen'];?>"></td><td><?=$r->fields['titulo'];?></td><td><?=($r->fields['estatus']==1)?'ACTIVO':'INACTIVO';?></td></tr> 
<?php 
        	$r->movenext();
	}  ?>
	</table>
<?php 
    $total_paginas = ceil($total / $tamano_pagina); ?>
   <table align="center">
       <tr class="filas">  
              <td colspan="7" align="center">
                <ul class="pagination  pagination-sm">
                <? if($pagina=='1'){ 
                     echo '<li class="disabled"><a href="#">«</a></li>';
                }else{
                      $pag = $pagina - 1;
                      echo '<li onclick="functablabanner('.$pag.');"><a href="#">«</a></li>';
                }?>

                  <?
                  for ($j=1; $j<=$total_paginas; $j++)
                  {
                    if ($j==$pagina)
                      echo '<li class="active"><a href="#">'.($j>1 ? '':'').$j.'<span class="sr-only actual"></span></a></li>';
                    else
                      echo '<li onclick="functablabanner('.$j.');"><a href="#"><span style="cursor:pointer" >'.($j>1 ? '':'').$j.'</span></a></li>';
                  }
                  ?>
                  <? if($pagina==$total_paginas){ 
                      echo '<li class="disabled"><a href="#">»</a></li>';
                  }else{
                      $pag = $pagina + 1;
                      echo '<li onclick="functablabanner('.$pag.');"><a href="#">»</a></li>';
                  }?>

                </ul>
                <br>
                Pagina <strong><?=$pagina?></strong> de <strong><?=$total_paginas?></strong>
              </td>
            </tr>
   </table>
    </div>
     <?php
}

?>