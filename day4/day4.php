<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test1.txt'); //Get the first test input
    $rows = explode("\n", $input); //Split the file by each line
    
    function separateNumbers($row){
        $withoutId = explode(':', $row);
        $separated = explode('|', $withoutId[1]);

        return $separated;
    }

    function part1($rows) {
        $sum = 0;
           
        foreach ($rows as $row) {
            $numbers = separateNumbers($row);
            preg_match_all('/\d+/', $numbers[0], $winningNumbers);
            preg_match_all('/\d+/', $numbers[1], $numbersIHave);
            $winnings = 0;

            foreach($numbersIHave[0] as $candidate){
                foreach($winningNumbers[0] as $winningNumber){
                    if($candidate == $winningNumber){
                        $winnings = $winnings === 0 ? 1 : $winnings * 2;
                    }
                }
            }

            $sum += $winnings;
        }

        return $sum;
    }

    function part2($rows) {
        $sum = 0;
        $games = [];
           
        foreach ($rows as $rowIndex => $row) {
            $separateId = explode(':', $row);
            $separateNumbers = explode('|', $separateId[1]);

            preg_match_all('/\d+/', $separateNumbers[0], $winningNumbers);
            preg_match_all('/\d+/', $separateNumbers[1], $numbersIHave);
            $numberOfMatches = 0;

            foreach($numbersIHave[0] as $candidate){
                foreach($winningNumbers[0] as $winningNumber){
                    if($candidate == $winningNumber){
                        $numberOfMatches++;
                    } 
                }
            }

            array_push($games, ["id" => $rowIndex + 1, "wins" => $numberOfMatches, "instances" => 1]);
        }

        for ($j = 0; $j < sizeof($games); $j++){
            for ($i = $j + 1; $i <= $j + $games[$j]["wins"]; $i++){
                $games[$i]["instances"] = $games[$i]["instances"] + $games[$j]["instances"];;
            };
        }
        
        foreach($games as $game){
            $sum += $game["instances"];
        }

        return $sum;
    }

    $result = part2($rows);
    echo "result: $result \n";
?>
