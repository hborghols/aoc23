<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test1.txt'); //Get the first test input
    // $input = file_get_contents('test2.txt'); //Get the second test input
    $rows = explode("\n", $input); //Split the file by each line
    
    function part1($rows) {
        $sum = 0;
    
        foreach ($rows as $row) {
            $numbers = preg_match_all('/\d/', $row, $match);
            $first = $match[0][0];
            $last = end($match[0]);
            $calibrationValue = $first . $last;
            $sum += $calibrationValue;
        }

        return $sum;
    }

    function getDigitFromString ($string) {
        switch($string){
            case 'one':
                return 1;
            case 'two':
                return 2;
            case 'three':
                return 3;
            case 'four': 
                return 4;
            case 'five':
                return 5;
            case 'six':
                return 6;
            case 'seven':
                return 7;
            case 'eight':
                return 8;
            case 'nine':
                return 9;
            default:
                return $string;
        }
    }

    function part2($rows) {
        $sum = 0;
    
        foreach ($rows as $row) {
            $numbers = preg_match_all('/(?=(\d|one|two|three|four|five|six|seven|eight|nine))/', $row, $match);
            $first = getDigitFromString($match[1][0]);
            $last = getDigitFromString(end($match[1]));
            $calibrationValue = (string)$first . (string)$last;
            $sum += $calibrationValue;
        }

        return $sum;
    }

    $result = part2($rows);
    echo "result: $result \n";
?>
