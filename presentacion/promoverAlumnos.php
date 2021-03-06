<?php
/**
 * En este archivo,  
 * @version 1.0
  * @author Martinez Natali 
 * 
 */

//Agrega la interfaz del preceptor comun a todas las secciones
require_once "GUIPreceptor.class.php";


require "../logica/AlumnoxCurso.php";
require_once "../logica/Curso.php" ;
               
$gui_preceptor = new GUIPreceptor();
?>
<style>
  input[type=checkbox], input[type=radio]{
    margin: 1px 1px 1px 1px;
    width: 20px;
    height: 20px;
  }
</style>

<div class="content-wrapper">

  <section class="content-header">
     <h1>  
        <small> </small>
      </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Cursos</a></li>
      <li class="active">Promover Curso</li>
    </ol> 
  </section>


  <section class="content">
    <div class="panel panel-default">
      <div class="panel-body">
        <!-- formulario principal -->
        <form class="form-horizontal" role="form" id="datos_alumno"  method="post" action="../logica/cargarNuevoAnio.php">
          <?php
               
          date_default_timezone_set('America/Argentina/Buenos_Aires');
          $curso = $_REQUEST['sel']; //se obtiene el id del curso seleccionado desde el archivo cursos.php
          $alumnos = AlumnoxCurso::obtenerAlumnoxCurso($curso, (int) date("Y")); //se obtienen los alumnos del curso seleccionado del a�o actual
          $cantfilas = count($alumnos); //se cuentan los registros obtenidos de la consulta anterior
           ?>
            
             <?php
                          //se muestra en la tabla el curso actual
                $c = new Curso();
                $cursoActual = $c->obtenerCurso($curso);
      
              ?>
        </form>
        </div>      
      <div class="panel-heading " style="background-color:#ffffff">
        <div class="box-header">
            <h3 class="box-title"> </h3>

            <label for="curso" class="col-md-1 control-label"> CURSO </label> 
              <div class="col-md-2">
                <input type="text" value=" <?php    echo $cursoActual [0]['anio'] . ' ' . $cursoActual[0]['nombre'];  ?> " class="form-control input-sm" id="nombrecurso" name="nombrecurso" readonly>
              </div>

              <label for="curso" class="col-md-1 control-label">ID </label> 
              <div class="col-md-2">
                <input type="text" value=" <?php   echo $curso  ?> " class="form-control input-sm" id="curso" name="curso" readonly>
              </div>

          <label for="anio" class="col-md-1 control-label">AÑO</label>
          <div class="col-md-2">
            <input type="text" value=" <?php   echo  (int)date('Y') ?> " class="form-control input-sm" id="anio" name="anio" readonly>
          </div>
          <div class="col-md-2">
              <input type="submit" class="btn btn-danger" value="Pasar de año" id="pasar" name="pasar">
          </div>
        </div>
      </div>

      <!-- tabla donde estan contenidos todos los alumnos del curso seleccionado !-->
      <table class="table table-bordered table-hover" border="1" width="50%">
        <thead>
          <tr>
            <th scope="col" width="5%">#</th>
            <th scope="col" width="60%">Apellido y Nombre</th>
            <th scope="col" style="text-align: center;">Promover todos <br> 
              <input value="pasa"  type="checkbox" name="pasanTodos" id="pasanTodos" >
            </th>
          </tr>

           
        </thead>
          
        <?php
       
        for ($i = 0; $i < $cantfilas; $i++) {
            
            //se hace de manera dinamica la carga de los alumnos a la tabla, con sus respectivos 
            //checkbox donde se computan las faltas a clase y a ed-fisica.
            ?>
        
            <tr>
                <td><?php echo $i + 1 ?></td> <!-- se muestra el numero del alumno en la tabla -->
                <td><?php 
                $nombreAlumno=$alumnos[$i]["apellido"] . ", " . $alumnos[$i]["nombre"];
                if (mb_detect_encoding($nombreAlumno, 'utf-8', true) === false) {
                $nombreAlumno = mb_convert_encoding($nombreAlumno, 'utf-8', 'iso-8859-1');
                } 
                echo $nombreAlumno; ?> </td> 
                <!-- se muestra el nombre y apellido del alumno en la tabla --> 
               <td style="text-align: center;"> 

                   <!--checkbox para seleccionar alumno que pasa de anio-->
                   <input value="pasa"  class="pasanTodos" type="checkbox" name="<?php echo ($i + 1) . "pasa" ?>" id="<?php echo ($i + 1) . "pasa" ?>" > </td>
                   <input hidden value="<?php echo $alumnos[$i]["dni"] ?>" name="<?php echo $i + 1 ?>">
                   <input hidden value="<?php echo $cantfilas ?>" name="cantAlumnos" id="cantAlumnos">
                    <!--input hidden para enviar al servidor el curso actual -->
                    <input hidden value="<?php echo $curso ?>" name="cursoActual">
                </td>
            </tr>
            <?php                   
        }//cierre del for
        ?>
        </table>
      </div>     
    </div>
  </section>  
</div>


 <script src="../recursos/jquery-ajax.min.js">  //script para traer la libreria de Jquery </script>
 <script>
      $('#pasanTodos').change(function () {
         
         if($("#pasanTodos").prop('checked')){
            $('.pasanTodos').prop('checked', true);
        }else { $('.pasanTodos').prop('checked', false);}
     });
 </script>

</body>


<?php

//Agrega el footer comun a todas las secciones
$gui_preceptor->cargarFooter();

?>



