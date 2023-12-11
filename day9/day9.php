<?php
    // $input = file_get_contents('input.txt'); //Get the file
    $input = file_get_contents('test2.txt'); //Get the file

    function getDiffs($currentSequence, $sequences){
        if(sizeof($currentSequence) < 2){
            return $sequences;
        }

        // echo "sequences is: " . json_encode($sequences) . "\n";
        $diffSequence = [];
        $lagerThanZero = false;

        for($i = 0; $i < sizeof($currentSequence) - 1; $i++){
            $difference = $currentSequence[$i + 1] - $currentSequence[$i];

            array_push($diffSequence, $difference);
            $lagerThanZero = $difference > 0;
        }

        array_push($sequences, $diffSequence);

        if ($lagerThanZero){
            return getDiffs($diffSequence, $sequences);
        } else {
            return $sequences;
        }
    }

    function findNextHistoryValue($sequences){
        $nSequences = sizeof($sequences);

        $nextValue = $sequences[$nSequences - 1][array_key_last($sequences[$nSequences - 1])];

        for ($i = sizeof($sequences) - 2; $i >= 0; $i--){
            $currentValue = $sequences[$i][array_key_last($sequences[$i])];
            $lastValue = $sequences[$i+1][array_key_last($sequences[$i+1])];
            
            $nextValue = $currentValue + $lastValue;
            if(!isset($lastValue)){
                echo "No last value found! " . json_encode($sequences) . " with length " . sizeof($sequences[$i]) . "\n";
            }
            echo "The next value of " . json_encode($sequences[$i]) . " is $currentValue + $lastValue = $nextValue" . "\n";
            array_push($sequences[$i], $nextValue);
        }

        echo "Na " . $nSequences . " te hebben bekeken is de nextValue " . $nextValue . " \n";
        return $nextValue;
    }

    function part1($input) {
        $rows = explode("\n", $input);
        $sum = 0;

        foreach($rows as $row){
            preg_match_all('/\d+/', $row, $matches);
            $history = $matches[0];
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
