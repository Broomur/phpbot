<?php
class Robot
{
    private ?string $name;
    private ?int $misteryNum;
    
    public function __construct() {
        $this->name = $_POST["name"];
        $this->misteryNum = intval($_POST["guessNum"]);
    }
    public function setName() {
        $l1 = chr(rand(65,90));
        $l2 = chr(rand(65,90));
        $n1 = rand(0,9);
        $n2 = rand(0,9);
        $n3 = rand(0,9);
        $n4 = rand(0,9);
        if (empty($_POST["name"])) {
            $this->name = "$l1$l2-$n1$n2$n3$n4";
        }
    }
    public function setMysteryNum() {
        if (empty($_POST["guessNum"])) {
            $this->misteryNum = rand(1, 1000);
        }
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getMisteryNum() {
        return $this->misteryNum;
    }
    
    public function greetings() {
        $name = $this->getName();
        echo("<p>Salut, humain. Je suis $name.");
    }
    
    public function giveTime() {
        date_default_timezone_set("Europe/Paris");
        $date = date("d m Y");
        $time = date("H:m");
        echo("<p>Nous sommes le $date, il est $time.");
    }
    
    public function getNumber() {
        $rand = rand(1, 10);
        if ($rand % 2 == 0) {
            echo("<p>J'ai choisi le nombre $rand, c'est un nombre pair.");
        } else {
            echo("<p>J'ai choisi le nombre $rand, c'est un nombre impair.");
        }
    }
    
    public function getJoke() {
        $name = $this->getName();
        $revert = strrev($name);
        echo("<p>Mon nom à l'envers s'écrit $revert. Ah. Ah. Ah.");
    }
    
    public function getCoffee() {
        if ($_POST["alignment"] === "random") {
            $rand = rand(1, 3);
            if ($rand == 1) {
                echo("<p style='color: red; font-weight: bold'>Extermination ! Extermination !</p>");
            } else {
                echo("<p>Vous voulez un café ?");
            }
        } else if ($_POST["alignment"] === "good") {
            echo("<p>Vous voulez un café ?</p>");
        } else if ($_POST["alignment"] === "evil") {
            echo("<p style='color: red; font-weight: bold'>Extermination ! Extermination !</p>");
        }
    }
    
    public function guessNumLoop() {
        $start = -microtime(true);
        $num = $this->getMisteryNum();
        $guess = 1;
        $strcount = "";
        $strmax = 100;
        while ($guess !== $num) {
            usleep(10000);
            $guess += 1;
            if (strlen($strcount) <= $strmax) { $strcount .= "-"; }
            else { $strcount .= "<br>"; $strmax += 100; }
            
        }
        echo("<p>".$strcount."></p>");
        $end = sprintf('%f', $start += microtime(true));
        echo("<p>J'ai trouvé en " . $end . " secondes avec une recherche par boucle ! C'est " . $guess . "...</p>");
    }
    
    public function dichotomia($begin, $end) {
        $value = $this->getMisteryNum();
        $strcount = "-";
        if ($begin <= $end) {
            usleep(10000);
            $strcount .= "-";
            $mid = intVal(($begin + $end)/2);
            if ($mid === $value) {
                echo("<p>".$strcount."></p>");
                return $value;
            } else if ($mid > $value) {
                $end = $mid-1;
            } else if ($mid < $value) {
                $begin = $mid +1;
            }
            return $this->dichotomia($begin, $end);
        } else {
            return $resultarray = [];
        }
    }
    
    public function guessNum() {
        $start = -microtime(true);
        $comput = $this->dichotomia(1, 1000);
        if (empty($comput)) {
            echo("<p>Je n'ai pas trouvé... Extermination !");
        } else {
            $end = sprintf('%f', $start += microtime(true));
            echo("<p>J'ai trouvé en " . $end . " secondes avec une recherche dichotomique ! C'est " . $comput . "...</p>");
            $this->getCoffee();
        }
    }
}
?>

