<?php
    session_start();
    include 'functions.php';
    include 'constants.php';

    $response = array();

    //Creating a connection to the Database
    $pdo = create_pdo();

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        $post_data = file_get_contents("php://input");
        $post_teacher_id = json_decode($post_data)->{'teacher'};
        $post_subject_id = json_decode($post_data)->{'subject'};
        $post_hours = json_decode($post_data)->{'hours'};
        $post_group = json_decode($post_data)->{'group'};

        $lessons_stmnt = $pdo->prepare("CALL insertLessons(:id_teachers, :hours, :group, :id_subjects)");
        $lessons_stmnt->bindParam(':id_teachers', $post_teacher_id);
        $lessons_stmnt->bindParam(':id_subjects', $post_subject_id);
        $lessons_stmnt->bindParam(':hours', $post_hours);
        $lessons_stmnt->bindParam(':group', $post_group);

        $lessons_stmnt->execute();
        $lessons_stmnt->closeCursor();


        $response = array(
          'status' => SUCCESS
        );

        $pdo->commit();
    } catch (Exception $e) {
      //Response if there is a SQL Error
      $pdo->rollBack();
      $response = array('status' => SQL_FAIL, 'error' => $e);
    }

    echo json_encode($response);
?>
