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

$sql = "SELECT * FROM datos_co2 ORDER BY fecha DESC LIMIT 100";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de CO2</title>
    <style>
        /* ... (el estilo permanece igual) ... */
    </style>
</head>
<body>
    <h1>Últimas mediciones de CO2</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Serie</th>
            <th>CO2 (ppm)</th>
            <th>Fecha y Hora</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["serie"]."</td>
                    <td>".$row["valor_co2"]."</td>
                    <td>".$row["fecha"]."</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay datos disponibles</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
