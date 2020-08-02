<?php

if(isset($_POST['referencia'])and
            isset($_POST['total'])and
            isset($_POST['sku'])and
            isset($_POST['descripcion'])){
    echo $_POST['referencia'];
    echo $_POST['total'];
    echo $_POST['sku'];
    echo $_POST['descripcion'];
}


/*
if(isset($_POST['referencia'])){
    $xml=json_decode($_POST['referencia']);
                
    header('Content-type:application/json');
    echo json_encode($xml,JSON_PRETTY_PRINT);
}

            if(isset($_POST['referencia'])and
            isset($_POST['total'])and
            isset($_POST['sku'])and
            isset($_POST['descripcion'])){

                $referencia=  $_POST["referencia"]; 
                $total=  $_POST["total"]; 


                $sku=json_decode($_POST["sku"], true)  ; 
                $descripcion=json_decode($_POST["descripcion"], true)   ; 
                
                    
                if($insert){
                    
                }else{
                    $xml='no es no';
                    header('Content-type:application/json');
                    echo json_encode($xml,JSON_PRETTY_PRINT);
                }
                $xml='hola mundo';
                    header('Content-type:application/json');
                    echo json_encode($xml,JSON_PRETTY_PRINT);
                
            }else{
                $xml='algo malo anterior';
                
                header('Content-type:application/json');
                echo json_encode($xml,JSON_PRETTY_PRINT);
            }
            */

?>