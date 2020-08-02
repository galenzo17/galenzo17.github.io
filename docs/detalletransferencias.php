<?php
include("conexion.php");
?>
<?php 
ini_set('session.gc_maxlifetime', 86400);

                // each client should remember their session id for EXACTLY 1 hour
                session_set_cookie_params(86400);
                
                session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: newlogin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: newlogin.php");
  }
  if( !isset($_SESSION['last_access']) || (time() - $_SESSION['last_access']) > 86400 )
  $_SESSION['last_access'] = time();
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="gb18030">
	<title>Detalle Transferencia</title>
    <?php include("header.php"); ?> 
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
          -->
    <script src="jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadifive.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadifive.css">
</head>
<body>
    <style>
        .table {
  font-size: 15px;
}

.table tr,.table td {
   height: 15px;
   text-align: left
}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
{
  padding:3px; 
}
.select{
    padding:3px; 
}
    </style>
        
<?php   
include("conexion.php");
include("utils.php");
if (!empty($_GET["codigo"])) {
    $codigodesde= $_GET["codigo"];
                
    $dbHost = 'localhost';
    $dbUsername = 'ultraexp_ultraexp';
    $dbPassword = 'Impotec2018';
    $dbName = 'ultraexp_empleados';
    $_POST[$dbName] = 'b';
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    if ($db->connect_error) {
        die("Unable to connect database: " . $db->connect_error);
        echo "error";
    }
    
    //get content from database
   // $query = $db->query("SELECT * FROM transferencia where idventa =  $codigodesde");
  // $query = mysqli_query($con,"select * from controlventas INNER JOIN transferencia on controlventas.idventa =transferencia.idventa where controlventas.idventa=$codigodesde");
  $query = mysqli_query($con,"select sum(transferencia.mototransfe),numReferencia,Monto, numtranferencia, transferencia.usuario, transferencia.fecha, archivos, banco from controlventas 
  INNER JOIN transferencia on controlventas.idventa =transferencia.idventa 
  where controlventas.idventa=$codigodesde");
   // $alter3="SELECT * FROM controlventas where idventa =  $codigodesde;";
  //  $alter3="SELECT * FROM transferencia where idventa =  $codigodesde;";

   // $insert = $db->multi_query($alter3);
    } 
    
    $cmsData;
    
?>
    	<div class="wrapper">
    
		<div class="main-header">
        
			<!-- Logo Header -->
            
            	<?php include("logo_header.php"); ?>

            
            	<?php include("navbar_header.php"); ?>
            			
			<!-- End Navbar -->
            
		</div>

		<!-- Sidebar -->
        
        <div class="sidebar sidebar-style-2">			
            <div class="sidebar-wrapper">
                <div class="sidebar-content">
            
                    <ul class="nav nav-primary">
                        
                        
                        
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                        </li>
                        
                        
                                    
                        <li class="nav-item">
                            <a href="formularioventa.php">
                                <i class="fa fa-plus"></i>
                                <p>Agregar Venta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Listados.php">
                                <i class="fa fa-table"></i>
                                <p>Listado de ventas</p>
                            </a>                    
                        </li>
                        <?php 
                        if($_SESSION['username']=="Felipe"){
                            echo '
                            <li class="nav-item">
                                <a href="buscardetalletransfe.php">
                                    <i class="fa fa-table"></i>
                                    <p>Buscar transferencias</p>
                                </a>                    
                            </li>
                            <li class="nav-item">
                            <a href="detallevendedores.php">
                                <i class="fa fa-table"></i>
                                <p>Detalle vendedores</p>
                                </a>                    
                            </li>
                            ';
                        }
                        ?>
                        
                        
                        
                        
                        
                    </ul>
                </div>
            </div>
        </div>
        		        
		<!-- End Sidebar -->
        
        <!-- Contenido position: fixed;
  top: 0;
  left: 0;
  z-index: 999;
  width: 100%;
  height: 23px;
  
   
  <div style="position:fixed;background-color:#ffff ;width:100%;z-index: 10;">
        
                    
                </div> --> 
<style>
    .form-control{
        padding:3px;
    }
</style>   
		<div class="main-panel"  >
        
			<div class="content">
            
	        	
        
                <section class="testimonial " id="testimonial" >
                    <div class="container-fluid" style="margin-top: 5%;margin-bottom: 2%;">
                        <div class="row ">
                        <div class="col-md-6 offset-3  " style="border:1px grey solid;padding:10px;border-radius:20px;">
                                <div class="row ">
                                  <div class="col-md-12"><!--<h6>Datos de la venta</h6><hr>-->
                                  <div   style="border-bottom:1px grey solid;"><h7><strong>Datos de la transferencia</strong></h7> </div>
                                 
                                  </div>
                                  
                                </div>
                            
                                 <form action="" method="post" enctype="multipart/form-data" id="form1">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <h6>Numero transferencia </h6>
                                            <input   id="numtrans"  placeholder="Introduzca codigo transferencia" class="form-control" type="text" 
                                            style="text-align:center; font-weight: bold;" autocomplete="off"  >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h6>Banco</h6>
                                            <select class="form-control" id="banco">
                                                <option selected>Itau</option>
                                                <option >Banco Estado</option>
                                                <option >Webpay</option>
                                                <option >Pago en efectivo</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <h6>Monto transferencia </h6>
                                            <input   id="montotrans"  placeholder="Introduzca monto transferencia" class="form-control" type="text" 
                                            style="text-align:center; font-weight: bold;" autocomplete="off"  >
                                        </div>
                                        <div class="form-group col-md-6">
                                             
                                            <button   class=" rounded  btn btn-block btn-lg btn-succsess border" style="font-size:100%; font-weight: bold;margin-top:25px;" 
                                          name="submit" id="Login" value="submit" >Guardar</button>
                                          </div> 
                                          <div class="form-group col-md-6">
                                          <a href="https://ultraexpress.cl/ControlVenta/Listados.php" style="font-size:100%; font-weight: bold;margin-top:25px;"  class="rounded  btn btn-block btn-lg btn-succsess border" role="button" aria-pressed="true"
                                                        >Volver</a>
                                            </div>
                                          <input id="usuario"   placeholder="Introduzca direccion de despacho" class="form-control"   type="text"  autocomplete="off"  
                                        value="<?php echo  $_SESSION['username']; ?>" hidden>
                                        <input id="idventa"   placeholder="Introduzca direccion de despacho" class="form-control"   type="text"  autocomplete="off"  
                                        value="<?php echo  $_GET['codigo']; ?>" hidden >
                                        
                                        
                                        </div>
                                    </div>
                                 </form  > 
                        </div> 
                    </div> 
                </section>
                 
                 
                 <section class="testimonial " id="testimonial" >
                    <div class="container-fluid" style="margin-bottom:2%;"  id="divid">
                        <div class="row ">
                        <div class="col-md-6 offset-3  " style="border:1px grey solid;padding:10px;border-radius:20px;">
                                <div class="row ">
                                    <h6>Datos transferencia guardados </h6>
                                  <div class="col-md-12">
                                            <table class="table table-striped    table-sm table-hover" id="table_id"  >
                                                        <thead >
                                                        <tr style="background-color:#d9dcde; "  >
                                                            <th class=" " style="text-align:left;font-size: 12px; "><strong>Num. Venta</strong></th>
                                                            <th scope="col-md-1  " style="text-align:left;font-size: 12px; "><strong>Num. Transferencia</strong></th>
                                                            <th scope="col-md-1  " style="text-align:left;font-size: 12px; "><strong>Banco</strong></th>
                                                            <th scope="col-md-1  " style="text-align:left;font-size: 12px; "><strong>Comprobante</strong></th>
                                                            <th scope="col-md-1  " style="text-align:left;font-size: 12px; "><strong>Fecha</strong></th>
                                                            
                                                            <th scope="col-md-2  " style="text-align:left;font-size: 12px; "><strong>Usuario</strong> </th>
                                                            
                                                        </tr>
                                                        </thead>
                                                <tbody >
                                                     
                                                    <?php 
                                                      
                                                    try{
                                                            
                                                            if(mysqli_num_rows($query) == 0){
                                        					echo '<tr><td colspan="8">No hay datos.</td></tr>';
                                            				}else{
                                            				    
                                                                while($row = mysqli_fetch_assoc($query)){
                                                                    $cmsData=$row;
            					                               // echo va_dump($row);
                                                                echo '<tr>';
                                        						echo '<td  id="observacionid"style="width: 80px;text-align:left;">'.$row['numReferencia'].'</td>
                                        							<td  id="observacionid"style="width: 80px;text-align:left;   ">'.$row['numtranferencia'].'</td>
                                        							<td  id="observacionid"style="width: 80px;text-align:left;   ">'.$row['banco'].'</td>';
                                        							echo '<td style="width: 80px;text-align:left;   ">';
                                        							$imagenes=$row['archivos'];
                                                                    $imagenes=explode(",",$imagenes);
                                                                    foreach($imagenes as $var){
                                                                        if($var!=""){
                                                                            /*
                                                                            echo '<a href="https://ultraexpress.cl/ControlVenta/uploads/'.$var.'" class="btn   btn-sm fa fa-image" 
                                                                            style="max-height :40px;font-size:14px;padding:0px; width: 28px;background-color:#cacbcc;"
                                                                            data-toggle="popover" data-placement="left" data-html="true"  
                                                                            data-img="https://ultraexpress.cl/ControlVenta/uploads/'.$var.'" title="   " ></a> ';
                                                                            */
                                                                            echo '<a href="https://ultraexpress.cl/ControlVenta/uploads/'.$var.'" class="btn   btn-sm fa fa-image" 
                                                                            style="max-height :40px;font-size:14px;padding:0px; width: 28px;background-color:#cacbcc;"
                                                                            data-toggle="popover" data-placement="left" data-html="true"  
                                                                            data-img="https://ultraexpress.cl/ControlVenta/uploads/'.$var.'" title="   " ></a>';
                                                                        }else{
                                                                            echo '<td  id="observacionid"style="width: 80px;text-align:left;"><a href="https://ultraexpress.cl/ControlVenta/uploads/'.$var.'" class="btn   btn-sm fa fa-image" 
                                                                            style="max-height :40px;font-size:14px;padding:0px; width: 28px;background-color:#cacbcc;"
                                                                            data-toggle="popover" data-placement="left" data-html="true"  
                                                                            data-img="https://ultraexpress.cl/ControlVenta/uploads/'.$var.'" title="   " ></a></td> ';
                                                                        }
                                                                    }
                                                                echo '</td> 
                                                                <td  id="observacionid"style="width: 80px;text-align:left;">'.$row['fecha'].'</td>
                                                                <td  id="observacionid"style="width: 80px;text-align:left;">'.$row['usuario'].'</td>
                                                                </tr>';
                                                                }
                                            				}
                                                    }catch(Exception $e){
                                                        
                                                    }
                                                    ?>
                                                    </tbody >
                                                    </table>
                                               </div>
                                    </div>
                                    </div>
                        </div> 
                    </div> 
                </section>
                
                <section class="testimonial " id="testimonial" >
                    <div class="container-fluid" style="margin-bottom:2%;"  id="divid">
                        <div class="row ">
                            <div class="col-md-6 offset-3  " style="border:1px grey solid;padding:10px;border-radius:20px;">
                                <div class="row ">
                                        <div class="col-md-5" style="background-color:#b5ffc9;padding:10px;border-radius:20px;">
                                            <h1 style="text-align:center;">$ <?php echo $cmsData['Monto']; ?> </h1>
                                        </div>
                                        <?php
                                        //echo $cmsData['Monto'];
                                        $monto= (int)$cmsData['Monto'];
                                        $tranfe=(int)$cmsData['sum(transferencia.mototransfe)'];
                                        $resto= $monto-$tranfe;
                                        if($resto<5) {
                                            echo '<div class="col-md-5 offset-1" style="background-color:#b5ffc9;padding:10px;border-radius:20px;">
                                            <h1 style="text-align:center;">Pago Completo</h1>
                                        </div>';
                                        }else{
                                            echo '<div class="col-md-5 offset-1" style="background-color:#ffb5b5;padding:10px;border-radius:20px;">
                                            <h1 style="text-align:center;">Falta dinero</h1>
                                        </div>';
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div> 
                        </div> 
                </section>
                
              <!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 600px;  " >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>      
    </body>
    
    
    <script>



document.getElementById('Login').addEventListener('click', function(e) { 
     e.preventDefault();

           
    $.ajax({
        type: "POST",
        url: 'https://ultraexpress.cl/ControlVenta/postdetalletranfe.php',
         
        data:   {
               //name:"Impotec",
               banco:document.getElementById("banco").value,
               numtrans: document.getElementById("numtrans").value,
               usuario: document.getElementById("usuario").value,
               montotrans: document.getElementById("montotrans").value,	
               idventa: document.getElementById("idventa").value,
        } ,
         success: function(response){
        
        alert(response);
            
        },
        
     })
     .done(function( msg ) {
              
            
          });
        
        
    });
    

</script>
<script>
/*
    $("#pop").on("click", function() {
   $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
$("#popw").on("click", function() {
   $('#imagepreview').attr('src', $('#imageresourcew').attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
*/
 $(document).ready(function () {
      

            $('a').on('click', function (e) {
                
                var src = $(this).attr('href');
                var img = '<img src="' + src + '" class="img-fluid"/>';
                $('#imagemodal').modal();
                $('#imagemodal').on('shown.bs.modal', function () {
                    $('#imagemodal .modal-body').html(img);
                });
                $('#imagemodal').on('hidden.bs.modal', function () {
                    $('#imagemodal .modal-body').html('');

                });
            });

            $("#imagemodal").mouseup(function (e) {
                if (e.target !== this) return;
                $('#imagemodal').modal('hide');
            });

        });
</script>

                
</html>