<?php
require_once 'S3.php';

function rellenarSeleccionado($bucket)
{
    if (isset($_POST['bucket']) && $_POST['bucket'] == $bucket) {
        return 'selected';
    }
}
//Crear conexión con S3
$awsS3 = new S3();
if ($awsS3 != null) {
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
    //Recuperar los buckets para mostrar en los selects
    $buckets = $awsS3->obtenerBuckets();
    if (isset($_POST['subirO'])) {
        //Comprobar que se ha seleccionado un fichero en el formulario
        if (!empty($_FILES['objeto']['name']) && !empty($_POST['bucket'])) {
            //Subir el objeto al bucket
            if ($awsS3->cargarObjeto(
                $_POST['bucket'],
                $_FILES['objeto']['tmp_name'],
                $_FILES['objeto']['name']
            )) {
                $mensaje = 'Objeto cargado';
            } else {
                $error = 'Error al cargar el objeto:' . $error;
            }
        } else {
            $error = 'Error: Debes rellenar el bucket y el objeto';
        }
    } elseif (isset($_POST['crearO'])) {
        //Comprobar que se ha escrito algo en el textarea
        if (!empty($_POST['texto']) && !empty($_POST['bucket'])) {
            if ($awsS3->crearObjeto($_POST['bucket'], $_POST['texto'])) {
                $mensaje = 'Objeto creado';
            } else {
                $error = 'Error al crear el objeto:' . $error;
            }
        } else {
            $error = 'Error: Debes rellenar el texto';
        }
    } elseif (isset($_POST['descargarO'])) {
        if (isset($_POST['bucket']) && isset($_POST['objeto'])) {
            $datos = $awsS3->descargarObjeto($_POST['bucket'], $_POST['objeto']);
            if ($datos == null) {
                $error = 'No se ha encontrado el objeto';
            }
        } else {
            $error = 'Rellena bucket y objeto';
        }
    } elseif (isset($_POST['borrarO'])) {
        if (isset($_POST['bucket']) && isset($_POST['objeto'])) {
            if ($awsS3->borrarObjeto($_POST['bucket'], $_POST['objeto'])) {
                $mensaje = 'Objeto borrado';
            } else {
                $error = 'Error al borrar objeto';
            }
        } else {
            $error = 'Rellena bucket y objeto';
        }
    }
} else {
    $error = 'Error: No se puede conectar con S3';
}
