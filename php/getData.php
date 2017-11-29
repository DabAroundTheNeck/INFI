<?php
    session_start();
    include 'functions.php';
    include 'constants.php';

    $response = array();

    //Creating a connection to the Database
    $pdo = create_pdo();

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::FETCH_ASSOC:);
        $pdo->beginTransaction();

        $data_stmnt = $pdo->prepare("select * from subjects");

        $data_stmnt->execute();
        $data = $data_stmnt->fetchAll();

        $data_stmnt->closeCursor();

        $response = array(
          'status' => SUCCESS,
          'subjects' => $data
        );

        $pdo->commit();
    } catch (Exception $e) {
      //Response if there is a SQL Error
      $pdo->rollBack();
      $response = array('status' => SQL_FAIL, 'error' => $e);
    }

    echo json_encode($response);

/*
    //Check connection
    if (!$conn) {
        die("Connection failed, pls try again");
    }
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
    */
?>
