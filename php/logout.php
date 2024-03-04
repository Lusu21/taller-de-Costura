<?php
    session_start();

    if (!isset($_SESSION['id_usu'])) {
        header("Location: ../index.html");
        exit();
    }

    session_unset(); // Elimina todas las variables de sesión
    session_destroy();

    echo '<script>alert("Vuelve Pronto");window.location.href="../index.html";</script>';
?>


    
    
    
    
    
    
    //session_start();

    //if (!isset($_SESSION['id_usu'])) {
        header("Location: ../index.html");
        exit();
   // }

    //session_destroy();

    //echo '<script>alert("Vuelve Pronto");windows.location.href="../index.html";</script>';
