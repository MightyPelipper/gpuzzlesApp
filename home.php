<?php 
//require 'bin/functions.php';
require 'db_configuration.php';
include('header.php'); 

?>

<html>
    <head>
        <title>QuizMaster</title>
    </head>
    <style>
        .image {
            width: 100px;
            height: 100px;
            padding: 20px 20px 20px 20px;
            transition: transform .2s;
        }
        .image:hover {
            transform: scale(1.2)
        }
        #table_1 {
            border-spacing: 300px 0px;
        }
        #table_2 {
            margin-left: auto;
            margin-right: auto;
        }
        #silc {
            width: 300;
            height: 85;
        }
        #welcome {
            text-align: center;
        }
        #directions {
            text-align: center;
        }
        #title {    
            color: black;        
            text-align: center;
        }
        a:visited, a:link, a:active {
            text-decoration: none;
        }
        #title2 {
        text-align: center;
        color: darkgoldenrod;
        }


    </style>
    <body>
    <?php
        if(isset($_GET['preferencesUpdated'])){
            if($_GET["preferencesUpdated"] == "Success"){
                echo "<br><h3 align=center style='color:green'>Success! The Preferences have been updated!</h3>";
            }
        }
    ?>
    <h1 id = "title2">Welcome to QuizMaster</h1>
    <h2 id = "directions">Select a topic to test your knowledge about India</h2><br>
    
    <?php

    $sql1 = "SELECT `value` FROM `preferences` WHERE `name`= 'NO_OF_TOPICS_PER_ROW'";
    $sql4 = "SELECT `value` FROM `preferences` WHERE `name`= 'NO_OF_QUESTIONS_TO_SHOW'";
    //this is to get the numbers of questions from preferences so i can limit the number of questions printed
    //$sqlpref = "SELECT `value` FROM `preferences` WHERE `name`= 'NO_OF_QUESTIONS_TO_SHOW'";
    //$resultspref = mysqli_query($db,$sqlpref);
    //if(mysqli_num_rows($resultspref)>0){
    //    while($row = mysqli_fetch_assoc($resultspref)){
    //         $pref[] = $row;
   //     }
    //}

    //select puzzles using the preferences restrictions
    $sql2 = "SELECT `name` FROM `gpuzzles` WHERE `creator_name` = 'Vowel Changer'  ORDER BY RAND() LIMIT 12";
    $sql3 = "SELECT `puzzle_image` FROM `gpuzzles` WHERE `creator_name` = 'Vowel Changer' ORDER BY RAND() LIMIT 12";

    $results1 = mysqli_query($db,$sql1);
    $results2 = mysqli_query($db,$sql2);
    $results3 = mysqli_query($db,$sql3);
    $results4 = mysqli_query($db,$sql4);

    if(mysqli_num_rows($results1)>0){
        while($row = mysqli_fetch_assoc($results1)){
            $column[] = $row;
        }
    }
    
    
    if(mysqli_num_rows($results2)>0){
        while($row = mysqli_fetch_assoc($results2)){
            $topics[] = $row;
        }
    }

    if(mysqli_num_rows($results3)>0){
        while($row = mysqli_fetch_assoc($results3)){
            $pics[] = $row;
        }
    }

    if(mysqli_num_rows($results4)>0){
        while($row = mysqli_fetch_assoc($results4)){
            $numPuzz[] = $row;
        }
    }



    $columns = $column[0]['value'];

    $numPuzzles = $numPuzz[0]['value'];

    $count= count($topics);
    
    echo "<table id = 'table_2'>
    <!--Links to quizzes can be put inside the href = -->";
    echo "<tr>";
    for($a=0;$a<$count;$a){
        for($b=0;$b<$columns;$b++){
            
            if($a>=$count){
                break;
            }else{
                
        $topic = $topics[$a]['name'];
        $pic = $pics[$a]['puzzle_image'];
        echo "
        <td>
            <a href = 'display_quiz.php?topic=$topic' title = $topic>
                <image class = 'image' src= 'Images/puzzle_images/$pic'  alt= $pic></image>
                
            </a>
        </td>";
        $a++;
            }
        }
    echo "</tr>";
    }   
    echo"</table>";
    ?>
    
    </body>
</html>