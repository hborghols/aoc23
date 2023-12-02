<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test1.txt'); //Get the first test input
    $rows = explode("\n", $input); //Split the file by each line
    
    function part1($rows) {
        $sum = 0;
        $totalRedCubes = 12;
        $totalGreenCubes = 13;
        $totalBlueCubes = 14;
           
        foreach ($rows as $row) {
            $rowParts = explode(':', $row);
            preg_match_all('/\d+/', $rowParts[0], $matchId);
            $id = $matchId[0][0];
            $rowIsPossible = true;
            $draws = explode(';', $rowParts[1]);

            foreach($draws as $draw){
                preg_match_all('/\d+ (red|green|blue)/', $draw, $matchColors);
                foreach($matchColors[0] as $color){
                    $colorParts = explode(' ', $color);
                    $colorName = $colorParts[1];
                    $colorCount = $colorParts[0];
                    
                    if($colorName == 'red' && $colorCount > $totalRedCubes){
                        $rowIsPossible = false;
                        break;
                    }
    
                    if($colorName == 'green' && $colorCount > $totalGreenCubes){
                        $rowIsPossible = false;
                        break;
                    }
    
                    if($colorName == 'blue' && $colorCount > $totalBlueCubes){
                        $rowIsPossible = false;
                        break;
                    }
                };
            }

            if ($rowIsPossible){
                $sum += $id;
            }
        }

        return $sum;
    }

    function part2($rows) {
        $sum = 0;
           
        foreach ($rows as $row) {
            $minRedCubes = 0;
            $minGreenCubes = 0;
            $minBlueCubes = 0;

            $rowParts = explode(':', $row);
            preg_match_all('/\d+/', $rowParts[0], $matchId);
            $id = $matchId[0][0];
            $draws = explode(';', $rowParts[1]);

            foreach($draws as $draw){
                preg_match_all('/\d+ (red|green|blue)/', $draw, $matchColors);
                foreach($matchColors[0] as $color){
                    $colorParts = explode(' ', $color);
                    $colorName = $colorParts[1];
                    $colorCount = $colorParts[0];
                    
                    if($colorName == 'red' && $colorCount > $minRedCubes){
                        $minRedCubes = $colorCount;
                    }
    
                    if($colorName == 'green' && $colorCount > $minGreenCubes){
                        $minGreenCubes = $colorCount;
                    }
    
                    if($colorName == 'blue' && $colorCount > $minBlueCubes){
                        $minBlueCubes = $colorCount;
                    }
                };
            }

            $power = $minRedCubes * $minGreenCubes * $minBlueCubes;
            $sum += $power;
        }

        return $sum;
    }

    $result = part2($rows);
    echo "result: $result \n";
?>
