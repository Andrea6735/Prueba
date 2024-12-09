<?php
    require_once("c://xampp/htdocs/login/controller/homeController.php");
    $obj = new homeController();
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $confirmarContraseña = $_POST['confirmarContraseña'];
    $rut = $_POST['RUT'];
    $error = "";

    function validarRUT($RUT) {
    
    $RUT = strtoupper(preg_replace('/[^0-9K]/', '', $RUT));

    if (!preg_match('/^[0-9]{7,8}[0-9K]$/', $RUT)) {
        return false;
    }

    $numero = substr($RUT, 0, -1);
    $dv = substr($RUT, -1);

    $suma = 0;
    $multiplo = 2;

    for ($i = strlen($numero) - 1; $i >= 0; $i--) {
        $suma += $numero[$i] * $multiplo;
        $multiplo = $multiplo < 7 ? $multiplo + 1 : 2;
    }

    $resto = $suma % 11;
    $dvCalculado = 11 - $resto;

    if ($dvCalculado == 11) {
        $dvCalculado = '0';
    } elseif ($dvCalculado == 10) {
        $dvCalculado = 'K';
    } else {
        $dvCalculado = (string) $dvCalculado;
    }

    return $dvCalculado === $dv;
}

    if(empty($correo) && empty($contraseña) && empty($confirmarContraseña)){
        $error .= "<li>Los campos son iguales</li>";
        header("Location:signup.php?error=".$error."&&correo=".$correo."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);

        
    }else if($correo || $contraseña || $confirmarContraseña){
        if($contraseña == $confirmarContraseña){
            if($obj->guardarUsuario($correo,$contraseña) == false){
                $error .= "<li>Correo agregado</li>";
                header("Location:signup.php?error=".$error."&&correo=".$correo."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);
            }else{
                header("Location:login.php");
            }
        }else{
            $error .= "<li>Las contraseñas son iguales</li>";
            header("Location:signup.php?error=".$error."&&correo=".$correo."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);
        }
    }
?>
