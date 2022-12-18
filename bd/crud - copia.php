<?php
    session_start();
    include_once 'conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // Recepción de los datos enviados mediante POST desde el JS   
    $nom = (isset($_POST['nom'])) ? $_POST['nom'] : '';
    $apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $telefon = (isset($_POST['telefon'])) ? $_POST['telefon'] : '';
    $persones = (isset($_POST['persones'])) ? $_POST['persones'] : '';
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
    $hora = (isset($_POST['hora'])) ? $_POST['hora'] : '';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';

    switch($opcion){
        case 1: //alta
            $consulta = "INSERT INTO reservas (nom, apellidos, email, telefon, persones, data, hora) VALUES('$nom', '$apellidos', '$email', '$telefon','$persones', '$fecha', '$hora') ";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "SELECT * reservas ORDER BY id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2: //modificación
            $consulta = "UPDATE reservas SET nom='$nom', apellidos='$apellidos', email='$email', telefon='$telefon', persones='$persones', data='$fecha', hora='$hora' WHERE id='$id' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();        

            $consulta = "SELECT * FROM reservas WHERE id='$id'";       
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;        
        case 3://eliminar
            $consulta = "DELETE FROM reservas WHERE id='$id'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                           
            break; 
    }

    print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;
