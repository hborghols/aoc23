<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test2.txt'); //Get the first test input
    $blocks = explode("\n\n", $input); //Split the file by each block

    function getMap($block){
        $ranges = array();
        $rows = explode("\n", $block);
        $lowest = PHP_INT_MAX;
        $highest = 0;

        foreach($rows as $index=>$row){
            if($index > 0){
                $numbers = explode(" ", $row);

                if($numbers[1] < $lowest){
                    $lowest = $numbers[1];
                }

                if(($numbers[1] + $numbers[2]) > $highest){
                    $highest = $numbers[1] + $numbers[2];
                }
                
                array_push($ranges, ["destinationRangeStart"=>$numbers[0], "sourceRangeStart"=>$numbers[1], "rangeLength"=>$numbers[2]]);
            }
        }

        return [$ranges, ["minMap" => $lowest, "maxMap" => $highest]];
    }

    function findInMap($source, $map){
        if($source < $map[1]["minMap"] || $source > $map[1]["maxMap"]){
            return $source;
        }

        $destination = $source;

        foreach($map[0] as $mapLine){
            $rangeLength = $mapLine['rangeLength'];
            $sourceStart = $mapLine['sourceRangeStart'];
            $sourceEnd = $sourceStart + $rangeLength - 1;
            $destinationStart = $mapLine['destinationRangeStart'];

            if(($sourceStart <= $source) && ($sourceEnd >= $source)){
                $differenceWithStart = $source - $sourceStart;
                $destination = $destinationStart + $differenceWithStart;

                return $destination;
            }
        }
        
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
            echo "Looking at pair $i which runs from $pairStart to $pairEnd \n";
            for($j = $pairStart; $j <= $pairEnd; $j++){
                $soilTarget = findInMap($j, $seedToSoil);
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

            echo "New lowest value: $lowestLocation \n";
        }

        return $lowestLocation;
    }

    $result = part2($blocks);
    echo "result: $result \n";
?>
