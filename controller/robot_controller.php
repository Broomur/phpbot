<?php
    require "../parts/robot.php"; 

    const ROBOT_NAME_PATTERN = "/[A-Z]{2}-[0-9]{4}/";

    if (preg_match(ROBOT_NAME_PATTERN, $_POST["name"]) or empty($_POST["name"]) and isset($_POST)) {
        $robot = new Robot();
        $robot->setName();
        $robot->setMysteryNum();
        $robot->greetings();
        $robot->giveTime();
        $robot->getNumber();
        $robot->getJoke();
        $robot->getCoffee();
        $robot->guessNumLoop();
        $robot->guessNum();
    } else {
        echo("<p>Mauvais format de nom</p>");
    }    
    

?>