<?php
    require_once 'vendor/autoload.php';

    use Aws\S3\S3Client;

    class S3{
        private $region = 'us-east-1';
        private $conexion;

        public function __construct(){
           try {
             //Conectar con S3
            $this->conexion = new S3Client([
                'version' => 'latest',
                'region' => $this->region
            ]);
           } catch (\Throwable $th) {
                global $error;
                $error=$th->getMessage();
           }
        }

        public function crearBucket($nombre){
            $resultado = false;
            try {
                $this->conexion->createBucket([
                    'Bucket' => $nombre
                ]);
                $resultado = true;
            } catch (\Throwable $th) {
               global  $error;
               $error=$th->getMessage();
            }

            return $resultado;
        }

        public function obtenerBuckets(){
            $resultado = array();
            try {
                //Obtenemos toda la información de los buckets
                //creado en s3
                $tmp = $this->conexion->listBuckets();
                //Devolvemos solamente el nombre de los buckets.
                //Los buckets está en la clave Bucket del array $tmp.
                foreach($tmp['Buckets'] as $b){
                    //El nombre está la clave Name del array $b
                    $resultado[]=$b['Name'];
                }
            } catch (\Throwable $th) {
                global  $error;
                $error=$th->getMessage();
            }
            return $resultado;
        }

        public function cargarObjeto($bucket, $rutaObjeto, $nombreObjeto){
            $resultado = false;
            try {
                $this->conexion->putObject([
                    'Bucket'=>$bucket,
                    'Key'=> $nombreObjeto,
                    'SourceFile' => $rutaObjeto,
                    'ContentType' => mime_content_type($rutaObjeto)
                ]);
                $resultado = true;
            } catch (\Throwable $th) {
                global  $error;
                $error=$th->getMessage();
            }
            return $resultado;
        }
        public function crearObjeto($bucket,$texto){
            $resultado=false;
            try {
                $this->conexion->putObject([
                    'Bucket'=>$bucket,
                    'Key'=> 'fichero'.date('YmdHis').'.txt',
                    'Body' => $texto
                ]);
                $resultado = true;
            } catch (\Throwable $th) {
                global  $error;
                $error=$th->getMessage();
            }
            return $resultado;
        }
    }
?>