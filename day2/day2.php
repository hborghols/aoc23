<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test1.txt'); //Get the first test input
    // $input = file_get_contents('test2.txt'); //Get the second test input
    $rows = explode("\n", $input); //Split the file by each line
    
    function part1($rows) {
        $sum = 0;
        $totalRedCubes = 12;
        $totalGreenCubes = 13;
        $totalBlueCubes = 14;
           
        foreach ($rows as $row) {
            echo "Looking at $row \n";
            $rowParts = explode(':', $row);
            preg_match_all('/\d+/', $rowParts[0], $matchId);
            $id = $matchId[0][0];
            $rowIsPossible = true;
            $draws = explode(';', $rowParts[1]);
            foreach($draws as $draw){
                echo "Looking at draw $draw \n";
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

            echo "The row above has id: $id and our current sum = $sum \n";
            if ($rowIsPossible){
                $sum += $id;
                echo "This game is possible! new sum = $sum \n";
            } else {
                echo "This game is not possible :( \n";
            }
            echo "\n";
        }

        return $sum;
    }

    function part2($rows) {
        // tbd
    }

    $result = part1($rows);
    echo "result: $result \n";
?>
