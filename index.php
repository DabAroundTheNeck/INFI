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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/foundation.min.css">
        <link rel="stylesheet" href="./css/style.css">

        <link href="https://fonts.googleapis.com/css?family=Anton|Open+Sans" rel="stylesheet">

        <title>Lehrveranstaltungsvisualisierungswerkzeuginternetapplikationsfrontend</title>
    </head>
    <body>
        <h1>Lehrveranstaltungsvisualisierungswerkzeuginternetapplikationsfrontend</h1>

        <main class="container">
            <h2>Subjects</h2>

            <div class="container">
                <?php
                    $sql = "SELECT * FROM subjects";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "id: " . $row["id"]. " - Name: " . $row["lvnr"]. " " . $row["title"]. "<button> + </button>" . "<br>";
                        }
                    } else {
                        echo "No results";
                        echo mysqli_error();
                        echo $result;
                    }
                ?>
            </div>

            <h2>Teachers</h2>

            <div class="container">
                <?php
                    $sql = "SELECT * FROM teachers";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "id: " . $row["id"]. " - Name: " . $row["f_name"]. " " . $row["l_name"]. " Kürzel " . $row["short"] . "<button> + </button>" . "<br>";
                        }

                    } else {
                        echo "No results";
                        echo mysqli_error();
                        echo $result;
                    }
                ?>
            </div>
            <h2>Lessons</h2>
                <div class="container">
                    <?php
                        $sql = "SELECT * FROM lessons";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "id: " . $row["id"]. " - Teacher: " . $row["id_teachers"]. " Hours " . $row["hours"] . " Group " . $row["group"] . " Subject: " . $row["id_subjecs"] . "<button> + </button>" . "<br>";
                            }

                        } else {
                            echo "No results";
                            echo mysqli_error();
                            echo $result;
                        }
                    ?>
                </div>
        </main>

        <script src="./js/vendor/jquery.js" charset="utf-8"></script>
        <script src="./js/vendor/foundation.min.js" charset="utf-8"></script>
        <script src="./js/app.js" charset="utf-8"></script>
    </body>
</html>
