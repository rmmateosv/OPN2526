<?php
require_once 'S3.php';

$awsS3 = new S3();
if ($awsS3 != null) {
    //Recuperar los buckets para mostrar en los selects
    $buckets = $awsS3->obtenerBuckets();
    
    if (isset($_POST['crearB'])) {
        if (empty($_POST['nombre'])) {
            $error = 'El nombre del bucket no puede estar vacío';
        } else {
            if ($awsS3->crearBucket($_POST['nombre'])) {
                $mensaje = 'Bucket Creado';
            } else {
                $error = 'Error al crear el bucket:' . $error;
            }
        }
    }
}
else{
   $error = 'Error: No se puede conectar con S3'; 
}
