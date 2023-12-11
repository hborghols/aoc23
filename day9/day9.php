<?php
    // $input = file_get_contents('input.txt'); //Get the file
    $input = file_get_contents('test1.txt'); //Get the file

    function getDiffs($currentSequence, $sequences){
        echo "currentSequence is: " . json_encode($currentSequence) . "\n";
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
            echo "Een de diffSequence " . json_encode($diffSequence) . " \n";
            return $sequences;
        }
    }

    function findNextHistoryValue($sequences){
        $nSequences = sizeof($sequences);

        $nextValue = 0;

        for ($i = sizeof($sequences) - 2; $i >= 0; $i--){
            $currentValue = (int)$sequences[$i][array_key_last($sequences[$i])];
            $lastValue = (int)$sequences[$i+1][array_key_last($sequences[$i+1])];
            
            $nextValue = $currentValue + $lastValue;
            if(!isset($lastValue)){
                echo "No last value found! " . json_encode($sequences) . " with length " . sizeof($sequences[$i]) . "\n";
            }
            // echo "The next value of " . json_encode($sequences[$i]) . " is $currentValue + $lastValue = $nextValue" . "\n";
            array_push($sequences[$i], $nextValue);
        }

        echo "Na " . $nSequences . " te hebben bekeken is de nextValue " . $nextValue . " \n";
        return $nextValue;
    }

    function part1($input) {
        $rows = explode("\n", $input);
        $sum = 0;

        foreach($rows as $row){
            $matches = explode(' ', $row);
            $history = $matches;
            // print json_encode($history) . "\n";
            $sequences = getDiffs($history , [$history]);
            $nextValue = findNextHistoryValue($sequences);
            $sum += $nextValue;
            print "The next value is $nextValue, making the sum $sum \n";
        }

        return $sum;
    }

    function part2($input) {
        //do stuff
    }

    $result = part1($input);
    echo "result: $result \n";
?>
