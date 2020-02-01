<?php

include_once 'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $file = mysqli_real_escape_string($db, $_POST['puzzle_image']);

    unlink($file);

    $sql = "DELETE FROM gpuzzles
            WHERE id = '$id'";

    mysqli_query($db, $sql);
    header('location: puzzles_list.php?PuzzleDeleted=Success');
}//end if
?>

