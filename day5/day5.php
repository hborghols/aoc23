<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test1.txt'); //Get the first test input
    $blocks = explode("\n\n", $input); //Split the file by each block

    function getMap($block){
        $map = [];
        $rows = explode("\n", $block);

        foreach($rows as $index=>$row){
            preg_match_all("/\d+/", $row, $numbers);
            if($index > 0){
                array_push($map, ["destinationRangeStart"=>$numbers[0][0], "sourceRangeStart"=>$numbers[0][1], "rangeLength"=>$numbers[0][2]]);
            }
        }

        return $map;
    }

    function findInMap($source, $map){
        $destination = $source;

        foreach($map as $mapLine){
            $rangeLength = $mapLine['rangeLength'];
            $sourceStart = $mapLine['sourceRangeStart'];
            $sourceEnd = $sourceStart + $rangeLength - 1;
            $destinationStart = $mapLine['destinationRangeStart'];

            if(($sourceStart <= $source) && ($sourceEnd >= $source)){
                // echo "We converten want $sourceStart <= $source en $sourceEnd >= $source \n";
                $differenceWithStart = $source - $sourceStart;
                // echo "New destination is $destinationStart + $differenceWithStart \n";
                $destination = $destinationStart + $differenceWithStart;
            }
        }

        // echo "new destination: $destination \n";
        
        return $destination;
    }

    function part1($blocks) {
        $lowestLocation = -1;
        preg_match_all("/\d+/", $blocks[0], $seeds);

        $seedToSoil = getMap($blocks[1]);
        $soilToFertilizer = getMap($blocks[2]);
        $fertilizerToWater = getMap($blocks[3]);
        $waterToLight = getMap($blocks[4]);
        $lightToTemperature = getMap($blocks[5]);
        $temperatureToHumidity = getMap($blocks[6]);
        $humidityToLocation = getMap($blocks[7]);

        forEach($seeds[0] as $seed){
            $soilTarget = findInMap($seed, $seedToSoil);
            $fertilizerTarget = findInMap($soilTarget, $soilToFertilizer);
            $waterTarget = findInMap($fertilizerTarget, $fertilizerToWater);
            $lightTarget = findInMap($waterTarget, $waterToLight);
            $temperatureTarget = findInMap($lightTarget, $lightToTemperature);
            $humidityTarget = findInMap($temperatureTarget, $temperatureToHumidity);
            $location = findInMap($humidityTarget, $humidityToLocation);

            if(($lowestLocation == -1) || ($location < $lowestLocation)){
                $lowestLocation = $location;
            }
        }

        return $lowestLocation;
    }

    function part2($blocks) {
        $lowestLocation = -1;
        preg_match_all("/\d+/", $blocks[0], $seeds);

        $seedToSoil = getMap($blocks[1]);
        $soilToFertilizer = getMap($blocks[2]);
        $fertilizerToWater = getMap($blocks[3]);
        $waterToLight = getMap($blocks[4]);
        $lightToTemperature = getMap($blocks[5]);
        $temperatureToHumidity = getMap($blocks[6]);
        $humidityToLocation = getMap($blocks[7]);

        for($i = 0; $i < sizeof($seeds[0]); $i +=2){
            $pairStart = $seeds[0][$i];
            $pairEnd = $seeds[0][$i] + $seeds[0][$i+1];
            // echo "Looking at pair $i which runs from $pairStart to $pairEnd \n";
        }

        // $arraySize = sizeof($seeds[0]);
        // echo "$arraySize \n";
        for($i = 0; $i < sizeof($seeds[0]); $i +=2){
            $pairStart = $seeds[0][$i];
            $pairEnd = $seeds[0][$i] + $seeds[0][$i+1];
            echo "Looking at pair $i which runs from $pairStart to $pairEnd \n";
            for($j = $pairStart; $j <= $pairEnd; $j++){
                // echo "Looking at seed $j \n";
                $soilTarget = findInMap($j, $seedToSoil);
                $fertilizerTarget = findInMap($soilTarget, $soilToFertilizer);
                $waterTarget = findInMap($fertilizerTarget, $fertilizerToWater);
                $lightTarget = findInMap($waterTarget, $waterToLight);
                $temperatureTarget = findInMap($lightTarget, $lightToTemperature);
                $humidityTarget = findInMap($temperatureTarget, $temperatureToHumidity);
                $location = findInMap($humidityTarget, $humidityToLocation);
                // echo "Found location $location \n";

                if(($lowestLocation == -1) || ($location < $lowestLocation)){
                    $lowestLocation = $location;
                }

                // echo "\n";
            }
        }

        return $lowestLocation;
    }

    $result = part2($blocks);
    echo "result: $result \n";
?>
