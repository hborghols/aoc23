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
           
        foreach ($rows as $rowIndex => $row) {
            $numbers = separateNumbers($row);
            preg_match_all('/\d+/', $numbers[0], $winningNumbers);
            preg_match_all('/\d+/', $numbers[1], $numbersIHave);
            $winnings = 0;

            foreach($numbersIHave[0] as $candidate){
                foreach($winningNumbers[0] as $winningNumber){
                    if($candidate == $winningNumber){
                        $winnings = $winnings === 0 ? 1 : $winnings * 2;
                    } else {
                    }
                }
            }

            $sum += $winnings;
        }

        return $sum;
    }

    function part2($rows) {
        $sum = 0;
           
        foreach ($rows as $rowIndex => $row) {
            //do stuff
        }

        return $sum;
    }

    $result = part1($rows);
    echo "result: $result \n";
?>
