<?php
error_reporting(0);

function suma($a, $b)
    {
    $a += $b;
    return $a;
    }

    function bowlingScore($str){
        $translation = [];
        $jump = false;

        for ($i = 0; $i < strlen($str); $i++){
            if ($jump == true) {
                $jump = false;
            } elseif ($str[$i] === "X" || $str[$i] === "x") {
                array_push($translation,[10, 0]);
            } elseif ($str[$i+1] === "/") {
                array_push($translation, [intval($str[$i]), false]);
            } elseif ($str[$i+1] === "-") {
                array_push($translation, [intval($str[$i]), null]);
            } elseif (intval($str[$i]) > 0 && intval($str[$i]) < 10 && $i == strlen($str)-1) {
                array_push($translation, [intval($str[$i]), null]);
            } elseif (intval($str[$i]) > 0 && intval($str[$i]) && intval($str[$i+1]) > 0 && intval($str[$i+1]) < 10) {
                $jump = true;
                array_push($translation, [intval($str[$i]), intval($str[$i+1])]);
            } else {
                null;
            }
            
        }

        $score = [];
        for ($j = 0; $j < 10; $j++){
            $sum = 0;
            if($translation[$j][1] === 0 || $translation[$j][1] === false){
                $sum = 10;
                $translation[$j+1] ? $sum = $sum + $translation[$j+1][0] + intval($translation[$j+1][1]): null;
                $translation[$j+2] && $translation[$j][1] === 0 ? $sum = $sum + $translation[$j+2][0] + intval($translation[$j+2][1]): null;
                array_push($score, $sum);
            
            } else {
                $sum = $translation[$j][0] + $translation[$j][1];
                array_push($score, $sum);
            
              }

        }
        return json_encode(array_reduce($score, "suma"));
    }

    //bowlingScore("XXXXXXXXXXXXX");
    $score = $_POST['score'];
    echo bowlingScore($score);

    ?>
