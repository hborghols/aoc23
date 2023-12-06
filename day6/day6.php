<?php
    // $input = file_get_contents('input.txt'); //Get the file
    $input = file_get_contents('input2.txt'); //Get the file
    // $input = file_get_contents('test1.txt'); //Get the first test input
    $rows = explode("\n", $input); //Split the file by each block

    function part1($rows) {
        $recordsBeat = 0;
        preg_match_all("/\d+/", $rows[0], $time);
        preg_match_all("/\d+/", $rows[1], $distance);
        $times = $time[0];
        $distances = $distance[0];
        for($i = 0; $i < sizeof($times); $i++){
            $timeHolding = (int)$times[$i] - 1;
            $wins = 0;
            
            while($timeHolding > 0){
                $distanceTravelled = ((int)$times[$i] - $timeHolding) * $timeHolding;
                if($distanceTravelled > $distances[$i]){
                    $wins++;
                }
                $timeHolding -= 1;
            }
            $recordsBeat = $recordsBeat == 0 ? $wins : $recordsBeat * $wins;
        }

        return $recordsBeat;
    }

    function part2($rows) {
        return part1($rows);
    }

    $result = part2($rows);
    echo "result: $result \n";
?>
