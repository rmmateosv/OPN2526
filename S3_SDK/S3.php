<?php
    //require_once 'vendor/autoload.php';

    use Aws\S3\S3Client;

    class S3{
        private $region = 'us-east-1';
        public function __construct(){
           try {
             //Conectar con S3
            $conexion = new S3Client([
                'version' => 'latest',
                'region' => $this->region
            ]);
           } catch (\Throwable $th) {
            echo '<h3 style="color:red">'.$th->getMessage().'</h3>';
           }
        }
    }
?>