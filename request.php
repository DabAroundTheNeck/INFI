<?php

    $conn = mysqli_connect("80.123.206.40:3306", "root", "nicholas paranoia cucumber", "INFI");

    //Check connection
    if (!$conn) {
        die("Connection failed, pls try again");
    }

    echo "<h1> Lehrveranstaltungsvisualisierungswerkzeuginternetapplikationsfrontend </h1>";

    echo '<p style="background-color: blue">Connection established</p>';

    $join = "INNER JOIN ON";

    $sql = "SELECT * FROM subjects";
    $result = mysqli_query($conn, $sql);

    echo "<h2> Subjects </h2>";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["id"]. " - Name: " . $row["lvnr"]. " " . $row["title"]. "<br>";
        }

    } else {
        echo "No results";
        echo mysqli_error();
        echo $result;
    }

    $sql = "SELECT * FROM teachers";
    $result = mysqli_query($conn, $sql);

    echo "<h2> Teachers </h2>";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["id"]. " - Name: " . $row["f_name"]. " " . $row["l_name"]. . $row["short"] . "<br>";
        }

    } else {
        echo "No results";
        echo mysqli_error();
        echo $result;
    }

    $sql = "SELECT * FROM lessons";
    $result = mysqli_query($conn, $sql);

    echo "<h2> Lessons </h2>";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["id"]. " - Teacher: " . $row["id_teachers"]. " Haurs " . $row["hours"] . " Group " . $row["group"] . " Subject: " . $row["id_subjecs"] . "<br>";
        }

    } else {
        echo "No results";
        echo mysqli_error();
        echo $result;
    }
    $conn->close();

 ?>
