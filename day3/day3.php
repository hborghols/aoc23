<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test1.txt'); //Get the first test input
    $rows = explode("\n", $input); //Split the file by each line

    class Coordinate {
        public $x;
        public $y;

        function set_x($x) {
            $this->x = $x;
        }

        function get_x() {
            return $this->x;
        }

        function set_y($y) {
            $this->y = $y;
        }

        function get_y() {
            return $this->y;
        }
    }
    
    function part1($rows) {
        $sum = 0;
        $coordinates = [];
           
        foreach ($rows as $rowIndex => $row) {
            preg_match_all('/[^.\d\n]/', $row, $symbols, PREG_OFFSET_CAPTURE);

            foreach($symbols[0] as $symbol){
                $coordinate = new Coordinate();
                $coordinate->set_y($rowIndex);
                $coordinate->set_x($symbol[1]);

                array_push($coordinates, $coordinate);
            }
        }

        foreach ($rows as $rowIndex => $row) {
            preg_match_all('/\d+/', $row, $numbers, PREG_OFFSET_CAPTURE);

            foreach($numbers[0] as $number){
                $numberY = $rowIndex;
                $firstX = $number[1];
                $lastX = $firstX + strlen($number[0]);

                foreach($coordinates as $coordinate){
                    $symbolY = $coordinate->get_y();
                    $symbolX = $coordinate->get_x();

                    if(($symbolY >= $numberY - 1) && ($symbolY <= $numberY + 1) && ($symbolX >= $firstX -1) && $symbolX <= $lastX){
                        $sum += $number[0];
                        break;
                    }
                }
            }
        }

        return $sum;
    }

    function part2($rows) {
        $sum = 0;
           
        foreach ($rows as $row) {
            //do stuff
        }

        return $sum;
    }

    $result = part1($rows);
    echo "result: $result \n";
?>
