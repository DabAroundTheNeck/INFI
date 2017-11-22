<?php

    $conn = mysqli_connect("localhost:3306", "root", "nicholas paranoia cucumber", "INFI");

    //Check connection
    if (!$conn) {
        die("Connection failed, pls try again");
    }

    echo "<h1> Lehrveranstaltungsvisualisierungswerkzeuginternetapplikationsfrontend </h1>";

    echo '<p style="background-color: blue">Connection established</p>';

    $join = "INNER JOIN ON";

    $sql = "SELECT * FROM subjects" . $join;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["id"]. " - Name: " . $row["lvnr"]. " " . $row["title"]. "<br>";
        }

    } else {
        echo "No results";
    }

    $conn->close();

 ?>
