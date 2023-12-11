<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test1.txt'); //Get the file

    function getDiffs($currentSequence, $sequences){
        $diffSequence = [];
        $lagerThanZero = false;

        for($i = 0; $i < sizeof($currentSequence) - 1; $i++){
            $difference = (int)$currentSequence[$i + 1] - (int)$currentSequence[$i];

            array_push($diffSequence, $difference);
            $lagerThanZero = abs($difference) > 0;
        }

        array_push($sequences, $diffSequence);

        if ($lagerThanZero){
            return getDiffs($diffSequence, $sequences);
        } else {
            return $sequences;
        }
    }

    function findNextHistoryValue($sequences){
        $nextValue = 0;

        for ($i = sizeof($sequences) - 2; $i >= 0; $i--){
            $currentValue = (int)$sequences[$i][array_key_last($sequences[$i])];
            $lastValue = (int)$sequences[$i+1][array_key_last($sequences[$i+1])];
            
            $nextValue = $currentValue + $lastValue;
            array_push($sequences[$i], $nextValue);
        }

        return $nextValue;
    }

    function findPreviousHistoryValue($sequences){
        $previousValue = 0;

        for ($i = sizeof($sequences) - 2; $i >= 0; $i--){
            $currentValue = (int)$sequences[$i][array_key_first($sequences[$i])];
            $firstValue = (int)$sequences[$i+1][array_key_first($sequences[$i+1])];
            
            $previousValue = $currentValue - $firstValue;
            array_unshift($sequences[$i], $previousValue);
        }

        return $previousValue;
    }

    function part1($input) {
        $rows = explode("\n", $input);
        $sum = 0;

        foreach($rows as $row){
            $history = explode(' ', $row);
            $sequences = getDiffs($history , [$history]);
            $nextValue = findNextHistoryValue($sequences);
            $sum += $nextValue;
        }

        return $sum;
    }

    function part2($input) {
        $rows = explode("\n", $input);
        $sum = 0;

        foreach($rows as $row){
            $history = explode(' ', $row);
            $sequences = getDiffs($history , [$history]);
            $previousValue = findPreviousHistoryValue($sequences);
            $sum += $previousValue;
        }

        return $sum;
    }

    $result = part2($input);
    echo "result: $result \n";
?>
