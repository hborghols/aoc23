<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test2.txt'); //Get the file
    $rows = explode("\n", $input); //Split the file by each block

    function getHandType($cards){
        $counts = count_chars($cards, 1);
        arsort($counts);
        $highestOccuringCard = chr(array_key_first($counts));
        if($highestOccuringCard == 'J'){
            $highestOccuringCard = chr(array_keys($counts)[1]);
        }
        $newCards = str_replace("J", $highestOccuringCard, $cards);
        echo "$cards is now $newCards \n";
        $uniqueCards = (int)strlen(count_chars($newCards, 3));
        echo "and it has $uniqueCards unique cards \n";
        
        switch($uniqueCards){
            case 1:
                //five of a kind
                return 7;
            case 2:
                foreach(count_chars($newCards, 1) as $val){
                    if($val == 4 || $val == 1){
                        //four of a kind
                        return 6;
                        break;
                    }

                    if($val == 3 || $val == 2){
                        //full house
                        return 5;
                        break;
                    }
                }
            case 3:
                foreach(count_chars($newCards, 1) as $val){
                    if($val == 3){
                        //three of a kind
                        return 4;
                        break;
                    }

                    if($val == 2){
                        //two pair
                        return 3;
                        break;
                    }
                }
            case 4:
                //one pair
                return 2;
            default:
                //high card
                return 1;
        }
    }    

    function compareHands($hand1, $hand2){
        // $cardStrength = ['A'=>12, 'K'=>11, 'Q'=>10, 'J'=>9, 'T'=>8, '9'=>7, '8'=>6, '7'=>5, '6'=>4, '5'=>3, '4'=>2, '3'=>1, '2'=>0]; // Part 1
        $cardStrength = ['A'=>12, 'K'=>11, 'Q'=>10, 'T'=>9, '9'=>8, '8'=>7, '7'=>6, '6'=>5, '5'=>4, '4'=>3, '3'=>2, '2'=>1, 'J'=> 0];
        // echo "Comparing $hand1 to $hand2 \n";

        for ($i = 0; $i < strlen($hand1); $i++) {
            $rankHand1 = $cardStrength[$hand1[$i]];
            $rankHand2 = $cardStrength[$hand2[$i]];

            if($rankHand1 > $rankHand2){
                // echo "$rankHand1 > $rankHand2 dus hand 1 wint \n";
                return 1;
            } else if($rankHand2 > $rankHand1){
                // echo "$rankHand2 > $rankHand1 dus hand 2 wint \n";
                return -1;
            }
        }
    }

    function sortHands($a, $b) {
        if ($a['type'] > $b['type']) {
            return 1;
        } elseif ($a['type'] < $b['type']) {
            return -1;
        }
        
        return compareHands($a['hand'], $b['hand']);
    }

    function part1($rows) {
        $hands = [];
        $winnings = 0;

        foreach ($rows as $row){
            list($cards, $bet) = explode(" ", $row);
            $type = getHandType($cards);
            // echo "Hand $cards with type $type has bet: $bet \n";
            array_push($hands, ["hand"=>$cards, "type"=>$type, "bet"=>$bet]);
        }

        usort($hands, 'sortHands');

        foreach($hands as $i=>$hand){
            $winnings = $winnings + (($i + 1) * $hand["bet"]);
        }

        return $winnings;
    }

    function part2($rows) {
        $hands = [];
        $winnings = 0;

        foreach ($rows as $row){
            list($cards, $bet) = explode(" ", $row);
            $type = getHandType($cards);
            echo "Hand $cards with type $type has bet: $bet \n";
            array_push($hands, ["hand"=>$cards, "type"=>$type, "bet"=>$bet]);
        }

        usort($hands, 'sortHands');

        foreach($hands as $i=>$hand){
            print_r($hand);
            $winnings = $winnings + (($i + 1) * $hand["bet"]);
            echo "i: $i, Winnings: $winnings \n\n";
        }

        return $winnings;
    }

    $result = part2($rows);
    echo "result: $result \n";
?>
