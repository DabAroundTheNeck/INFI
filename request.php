<?php

    $conn = mysqli_connect("80.123.206.40:3306", "root", "nicholas paranoia cucumber", "infi");

    //Check connection
    if (!$conn) {
        die("Connection failed, pls try again");
    }

    echo "<p>Connection established \n</p>";



    $sql = "SELECT * FROM lessons";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["id"]. " - Name: " . $row["lvnr"]. " " . $row["title"]. "<br>";
        }
    } else {
        echo "0 results";
    }



    $conn->close();

 ?>
