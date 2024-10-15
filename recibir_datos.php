<?php
$dbhost = $_ENV['MYSQLHOST'];
$dbport = $_ENV['MYSQLPORT'];
$dbname = $_ENV['MYSQLDATABASE'];
$dbuser = $_ENV['MYSQLUSER'];
$dbpass = $_ENV['MYSQLPASSWORD'];

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if(isset($_POST['serie']) && isset($_POST['co2'])) {
    $serie = $_POST['serie'];
    $co2 = $_POST['co2'];
    
    $sql = "INSERT INTO datos_co2 (serie, valor_co2) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $serie, $co2);
    
    if ($stmt->execute()) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error al crear el registro: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "No se recibieron datos correctamente.";
}

$conn->close();
?>
