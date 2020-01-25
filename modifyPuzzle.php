<?php $page_title = 'Gpuzzles > Modify Puzzle'; ?>
<?php 
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    //this stuff verifies logins Disabled for now.
    //$page="questions_list.php";
    //verifyLogin($page);

?>
<?php 
//connect to SQL server
    $mysqli = NEW MySQLi('localhost','root','','gpuzzles_db');
    $resultset = $mysqli->query("SELECT DISTINCT id FROM gpuzzles ORDER BY id ASC"); 
    $resultset2 =  $mysqli->query("SELECT DISTINCT creator_name  FROM gpuzzles ORDER BY creator_name ASC"); 
?>
<link href="css/form.css" rel="stylesheet">
<style>#title {text-align: center; color: darkgoldenrod;}</style>
<div class="container">
    <!--Check the CeremonyCreated and if Failed, display the error message-->
    <?php
    if(isset($_GET['createQuestion'])){
        if($_GET["createQuestion"] == "fileRealFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not real, Please Try Again!</h3>';
        }
    }
    if(isset($_GET['createQuestion'])){
        if($_GET["createQuestion"] == "answerFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your answer was not one of the choices, Please Try Again!</h3>';
        }
    }
    if(isset($_GET['createQuestion'])){
        if($_GET["createQuestion"] == "fileTypeFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not a valid image type (jpg,jpeg,png,gif), Please Try Again!</h3>';
        }
    }
    if(isset($_GET['createQuestion'])){
        if($_GET["createQuestion"] == "fileExistFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image does not exist, Please Try Again!</h3>';
        }
    }
  
    ?>
    <form action="modifyThePuzzle.php" method="POST" enctype="multipart/form-data">
        <br>
        <h3 id="title">Modify A Puzzle</h3> <br>
        
        <table>
            <tr>
                <td style="width:100px">Puzzle ID:</td>
                <td><select name="id">
                    <?php 
                    while($rows = $resultset->fetch_assoc()){
                        $topic=$rows['id']; 
                    echo"<option Value='$topic'>$topic</option>";}?>
                    </select></td>
            </tr>

            <tr>
                <td style="width:100px">Puzzle Type:</td>
                <td><select name="creatorname">
                    <?php 
                    while($rows2 = $resultset2->fetch_assoc()){
                        $topic2=$rows2['creator_name']; 
                    echo"<option Value='$topic2'>$topic2</option>";}?>
                    </select></td>
            </tr>

            <tr>
                <td style="width:100px">Puzzle Name:</td>
                <td><input type="text"  name="name" maxlength="100" size="50" required title="Please enter the name."></td>
            </tr>
            
            <tr>
                <td style="width:100px">Author Name:</td>
                <td><input type="text"  name="author_name" maxlength="50" size="50" required title="Please enter author name."></td>
            </tr>
            <tr>
                <td style="width:100px">Book Name:</td>
                <td><input type="text"  name="book_name" maxlength="50" size="50" required title="Please enter book name."></td>
            </tr>
            <tr>
                <td style="width:100px">Puzzle Image:</td>
                <td><input type="file"  name="puzzle_image" id="puzzle_image" maxlength="50" size="50" required title="Please enter the image name."></td>
            </tr>
            <!---
            <tr>
                <td style="width:100px">Solution Image:</td>
                <td><input type="file"  name="solution_image" id="puzzle_image" maxlength="50" size="50" required title="Please enter the image name."></td>
            </tr>
            --->
            <tr>
                <td style="width:100px">Notes:</td>
                <td><input type="text" name="notes"  maxlength="50" size="50" title="Please enter any notes."></td>
            </tr>
        </table>

        <br><br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Puzzle</button>
        </div>
        <br> <br>

    </form>
</div>

