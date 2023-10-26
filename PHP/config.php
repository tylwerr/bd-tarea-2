<?php
class Cconexion{
    public static function ConexionBD(){
        $host = 'localhost';
        $dbname='prestigetravels';
        $username='root';
        $pasword='';

        try {
            $conn = new PDO ("mysql:host=$host;dbname=$dbname",$username,$pasword);
        } catch (PDOException $exp) {
            echo ("No se logro conectar correctamente, error:$exp");
            
        }
        return $conn;
    }
}
?>