<?php

session_start();

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'db_movimientos'
);


/*if ($conn) {
    echo "La base de datos está conectada.";
} else {
    echo "Error en la conexión: " . mysqli_connect_error();
}

?>*/