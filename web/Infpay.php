<?php

echo "Esta pagina muestras los datos de pago"."<br>";

if (isset($_GET["topic"])) {
echo $_GET["topic"];
}

if (isset($_GET["id"])) {
    echo $_GET["id"];
    }

echo "<br>";
echo "Se acabo de presentar los datos";

?>
