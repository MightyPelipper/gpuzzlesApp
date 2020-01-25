<?php
//this will upload the inputs into the localhost database
include_once 'db_configuration.php';

if (isset($_POST['creatorname'])){

    echo "HERE";
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $topic = mysqli_real_escape_string($db, $_POST['creatorname']);
    $name = mysqli_real_escape_string($db,$_POST['name']);
    $author_name = mysqli_real_escape_string($db,$_POST['author_name']);
    $book_name = mysqli_real_escape_string($db,$_POST['book_name']);
    
    $notes = mysqli_real_escape_string($db,$_POST['notes']);
    $puzzle_image = basename($_FILES["puzzle_image"]["name"]);
    //$solution_image = basename($_FILES["solution_image"]["name"]);
    //$validate = true;
    //$validate = emailValidate($answer);
    
    
    //if($validate){
        
        $target_dir = "Images/puzzle_images/";
        $target_file = $target_dir . basename($_FILES["puzzle_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["puzzle_image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                header('location: modifyPuzzle.php?createPuzzle=fileRealFailed');
                $uploadOk = 0;
            }
        }
        /** Check if file already exists
        if (file_exists($target_file)) {
            header('location: createPuzzle.php?createPuzzle=fileExistFailed');
            $uploadOk = 0;
        }
        **/
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            header('location: modifyPuzzle.php?modifyPuzzle=fileTypeFailed');
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["puzzle_image"]["tmp_name"], $target_file)) {
                
                $sql = "UPDATE gpuzzles
                SET creator_name = '$topic',
                    name = '$name',
                    author_name ='$author_name',
                    book_name = '$book_name',
                    puzzle_image = '$puzzle_image',
                    notes = '$notes'
                WHERE id ='$id'";

                mysqli_query($db, $sql);
                header('location: puzzles_list.php?modifyPuzzle=Success');
                }
            }
        //}else{
            //header('location: createPuzzle.php?createPuzzle=PuzzleFailed'); 
    //}        

}//end if
/*
function emailValidate($answer){
    global $choice1,$choice2,$choice3,$choice4;
    if($answer == $choice1 or $answer == $choice2 or $answer == $choice3 or $answer == $choice4){
        return true;
    }else{
        return false;
    }      
}

**/
?>