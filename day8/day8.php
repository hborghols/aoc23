<?php
    $input = file_get_contents('input.txt'); //Get the file
    // $input = file_get_contents('test2.txt'); //Get the file

    function part1($input) {
        list($strategy, $nodes) = explode("\n\n", $input);
        $rows = explode("\n", $nodes);
        $nodes = [];

        foreach($rows as $row){
            preg_match_all('/([A-Z]{3})/', $row, $stringNodes);
            $currentNode = $stringNodes[0][0];
            $leftTarget = $stringNodes[0][1];
            $rightTarget = $stringNodes[0][2];
            $nodes[$currentNode] = ["L"=>$leftTarget, "R"=>$rightTarget];
        }

        $target = 'AAA';
        $strategyPointer = $strategy[0];
        $steps = 0;

        while($target !== 'ZZZ'){
            $strategyIndex = $steps%strlen($strategy);
            $strategyPointer = $strategy[$strategyIndex];
            $target = $nodes[$target][$strategyPointer];
            $steps++;
        }

        return $steps;
    }

    function gcd($a, $b) {
        if ($a < 1 || $b < 1) {
            die("a or b is less than 1");
        }
        $r = 0;
        do {
            $r = $a % $b;
            $a = $b;
            $b = $r;
        } while ($b != 0);
        return $a;
    }

    function lcm($a, $b) {
        if ($a == 0 || $b == 0) {
            return 0;
        }
        $result = ($a * $b) / gcd($a, $b);
        return $result;
    }

    function part2($input) {
        list($strategy, $nodeList) = explode("\n\n", $input);
        $rows = explode("\n", $nodeList);
        $nodes = [];
        $targets = [];
        $steps = 0;

        foreach($rows as $row){
            preg_match_all('/([\w]{3})/', $row, $stringNodes);
            $currentNode = $stringNodes[0][0];
            $leftTarget = $stringNodes[0][1];
            $rightTarget = $stringNodes[0][2];
            $targetNode =  ["L"=>$leftTarget, "R"=>$rightTarget];
            $nodes[$currentNode] = $targetNode;

            if($currentNode[2] == 'A'){
                array_push($targets,["target"=>$currentNode,"foundZ"=>false]);
            }
        }

        $nTargets = sizeof($targets);
        $nEndNodes = 0;
        $strategyPointer = $strategy[0];
        $results = [];

        while($nEndNodes != $nTargets){
            $strategyIndex = $steps%strlen($strategy);
            $strategyPointer = $strategy[$strategyIndex];

            foreach($targets as &$target){
                if(!$target["foundZ"]){
                    $target["target"] = $nodes[$target["target"]][$strategyPointer];

                    if($target["target"][2] == 'Z'){
                        $nEndNodes++;
                        array_push($results, $steps + 1);
                        $target["foundZ"] = true;
                    }
                }
            }
            $steps++;
        }

        $result = array_reduce($results, 'lcm', $results[0]);

        return $result;
    }

    $result = part2($input);
    echo "result: $result \n";
?>
