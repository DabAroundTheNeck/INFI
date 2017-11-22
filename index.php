<?php
    $conn = mysqli_connect("80.123.206.40:3306", "root", "nicholas paranoia cucumber", "INFI");

    //Check connection
    if (!$conn) {
        die("Connection failed, pls try again");
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./style.css">
        <title>Lehrveranstaltungsvisualisierungswerkzeuginternetapplikationsfrontend</title>
    </head>
    <body>
        <h1> Lehrveranstaltungsvisualisierungswerkzeuginternetapplikationsfrontend </h1>
        <p>Connection established</p>


        <h2>Subjects</h2>
            <?php
                $sql = "SELECT * FROM subjects";
                $result = mysqli_query($conn, $sql);

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
            ?>
        <h2>Teachers</h2>
            <?php
                $sql = "SELECT * FROM teachers";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "id: " . $row["id"]. " - Name: " . $row["f_name"]. " " . $row["l_name"]. " Kürzel " . $row["short"] . "<button>" . "<br>";
                    }

                } else {
                    echo "No results";
                    echo mysqli_error();
                    echo $result;
                }
            ?>
        <h2>Lessons</h2>
            <?php
                $sql = "SELECT * FROM lessons";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "id: " . $row["id"]. " - Teacher: " . $row["id_teachers"]. " Hours " . $row["hours"] . " Group " . $row["group"] . " Subject: " . $row["id_subjecs"] . "<br>";
                    }

                } else {
                    echo "No results";
                    echo mysqli_error();
                    echo $result;
                }
            ?>

        <script type="text/javascript">

        </script>
    </body>
</html>
