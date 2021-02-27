<!-- 
    
    & ~> CONJUNÇÃO
    # ~> DISJUNÇÃO
    > ~> IMPLICAÇÃO
    ~ ~> NEGAÇÃO

 -->

 <?php

    $axioms = array(
        '(p > (q > p))',
        '((p > (q > r)) > ((p > q) > (p > r)))',
        '(p > (q > (p & q)))',
        '((p & q) > p)',
        '((p & q) > q)',
        '(p > (p # q))',
        '(q > (p # q))',
        '((p > r) > ((q > r) > ((p # q) > r)))',
        '((p > q) > ((p > ~q) > ~p))',
        '(~~p > p)',
    );

    $atomicSymbols = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    
    $connectives = array('&','#','>');
    
    $unaryConnectives = array('~');
    
    $auxiliarySymbols = array('(',')');

    $response = array();

    function arrayToString($array){ // OK

        /**
        * Convert array to string.
        **/

        $string = "";

        for ( $i = 0 ; $i < count($array) ; $i++ ){
            $string .= $array[$i];
        }

        return $string;

    }

    function parenthesesPattern($formula){ // OK

        /**
        * Standardize parentheses of the formula.
        **/
        
        $formula = str_replace(' ', '', $formula);

        $formula = str_split($formula);

        $counter = 0;

        $j = 0;

        if($formula[$j] == "("){

            do{
                if($formula[$j] == "("){
                    $counter++;
                }else if($formula[$j] == ")"){
                    $counter--;
                }

                $j++;
            }while($counter != 0 && $j < count($formula));

        }

        if(count($formula) == $j){

            $formula = arrayToString($formula);

            $formula = substr($formula, 1, -1);

            return parenthesesPattern($formula);

        }else{

            $pattern = "/^\~*[a-z]{1}$/";
            
            if(preg_match($pattern, arrayToString($formula))){
                $formula = arrayToString($formula);
            }else{
                $formula = "(".arrayToString($formula).")";
            }
            
            return $formula;

        }

    }

    function checkAlphabet($formula) { // OK

        /**
        * Validate alphabet of formula.
        **/

        $formula = str_replace(' ', '', $formula);

        $pattern = "/^[a-z&\#\>\~\)\(]+$/";

        if(preg_match($pattern, $formula)){
            return 1;
        }else{
            return 0;
        }

    }

    function checkSyntax($formula) { // OK

        /**
        * Validate formula syntax.
        **/

        global $atomicSymbols, $connectives, $unaryConnectives, $auxiliarySymbols;

        $formula = str_replace(' ', '', $formula);

        $formula = str_split($formula);

        // First position with a single position.
        if(count($formula) == 1 && !in_array($formula[0], $atomicSymbols)){
            return 0;
        }

        // First position with more than one position.
        if(count($formula) > 1 && !in_array($formula[0], $atomicSymbols) && !in_array($formula[0], $unaryConnectives) && $formula[0] != "("){
            return 0;
        }

        // Last position with more than one position.
        if(count($formula) > 1 && !in_array($formula[(count($formula)-1)], $atomicSymbols) && $formula[(count($formula)-1)] != ")"){
            return 0;
        }

        for ( $i = 0 ; $i < count($formula) ; $i++ ){
            
            if(in_array($formula[$i], $auxiliarySymbols)){

                $counter = 0;

                $j = $i;

                if($formula[$i] == "("){

                    if(isset($formula[$i+1])){
                        if(!in_array($formula[$i+1], $atomicSymbols) && !in_array($formula[$i+1], $unaryConnectives) && $formula[$i+1] != "("){
                            return 0;
                        }
                    }

                    do{
                        if($formula[$j] == "("){
                            $counter++;
                        }else if($formula[$j] == ")"){
                            $counter--;
                        }
    
                        $j++;
                    }while($counter != 0 && $j < count($formula));

                }else if($formula[$i] == ")"){
                    
                    if(isset($formula[$i+1])){
                        if(!in_array($formula[$i+1], $connectives) && $formula[$i+1] != ")"){
                            return 0;
                        }
                    }

                    do{
                        if($formula[$j] == "("){
                            $counter--;
                        }else if($formula[$j] == ")"){
                            $counter++;
                        }
    
                        $j--;
                    }while($counter != 0 && $j >= 0);
    
                }

                // It didn't close going, or it didn't close going back.
                if($counter != 0){
                    return 0;
                }

            }else if(in_array($formula[$i], $atomicSymbols)){
                if(isset($formula[$i+1])){
                    if(!in_array($formula[$i+1], $connectives) && $formula[$i+1] != ")"){
                        return 0;
                    }
                }
            }else if(in_array($formula[$i], $connectives)){
                if(isset($formula[$i+1])){
                    if(!in_array($formula[$i+1], $atomicSymbols) && !in_array($formula[$i+1], $unaryConnectives) && $formula[$i+1] != "("){
                        return 0;
                    }
                }
            }else if(in_array($formula[$i], $unaryConnectives)){
                if(isset($formula[$i+1])){
                    if(!in_array($formula[$i+1], $atomicSymbols) && $formula[$i+1] != "(" && !in_array($formula[$i+1], $unaryConnectives)){
                        return 0;
                    }
                }
            }

        }

        return 1;
        
    }
    
    function applyAxiom($a, $p, $q = NULL, $r = NULL) { // OK
        
        /**
        * Apply an axiom.
        **/

        global $axioms;

        if(is_numeric($a)){

            $a -= 1;
        
            if($a >= 0 && $a <= 9){   

                $status = 0; $status_p = 0; $status_q = 0; $status_r = 0;

                if(checkAlphabet($p) && checkSyntax($p)){
                    $status_p = 1; $p = str_replace(' ', '', $p);
                }

                if(checkAlphabet($q) && checkSyntax($q)){
                    $status_q = 1; $q = str_replace(' ', '', $q);
                }

                if(checkAlphabet($r) && checkSyntax($r)){
                    $status_r = 1; $r = str_replace(' ', '', $r);
                }

                if($a == 9 && $status_p){
                    $status = 1;
                }else if(($a == 1 || $a == 7) && $status_p && $status_q && $status_r){
                    $status = 1;
                }else if($status_p && $status_q){
                    $status = 1;
                }

                if($status){
                
                    global $axioms, $atomicSymbols;
                
                    $instance = str_replace(' ', '', $axioms[$a]);

                    $instance = str_split($instance);
        
                    for ( $i = 0 ; $i < count($instance) ; $i++ ){
        
                        if(in_array($instance[$i], $atomicSymbols)){
                            if($instance[$i] == "p"){
                                $instance[$i] = parenthesesPattern($p);
                            }else if($instance[$i] == "q"){
                                $instance[$i] = parenthesesPattern($q);
                            }else if($instance[$i] == "r"){
                                $instance[$i] = parenthesesPattern($r);
                            }
                        }
        
                    }
        
                    return arrayToString($instance);

                }else{
                    return "Inform all fields referring to your axiom correctly.";
                }
            }else{
                return "Axioms listed only from 1 to 10.";
            }
        }else{
            return "The axioms field receives only numerical values.";
        }

    }

    function modusPonens($currentLine, $a, $b) { // OK

        /**
        * Return the MP between two lines.
        **/

        if($currentLine > $a && $currentLine > $b && $a != $b && $a > 0 && $b > 0){
            
            global $response;

            $a = $response[$a-1];
            $b = $response[$b-1];

            if(strlen($a) > strlen($b)){
                $auxiliary = $b;
                $b = $a;
                $a = $auxiliary;
            }

            $b = substr($b, 1, -1);

            $b = str_split($b);

            if(isset($b[strlen($a)]) && $b[strlen($a)] == ">") {
                $b = arrayToString($b);

                if(substr($b, 0, strlen($a)) == $a) {
                    $b = substr($b, strlen($a) + 1); return $b;
                }else{
                    return "Modus ponnes invalid.";
                }

            }else{
                return "A does not imply B.";
            }

        }else{
            return "Invalid line numbering.";
        }
        
    }

    function returnResponse(){ // OK

        global $response;

        if(isset($_POST['sequent']) && !empty($_POST['sequent'])){
            
            for ( $i = 0 ; $i < count($_POST['sequent']) ; $i++ ){

                if(isset($_POST['sequent'][$i])){

                    $sequent = parenthesesPattern($_POST['sequent'][$i]);

                    if(checkAlphabet($sequent)){
                        
                        if(checkSyntax($sequent)){

                            if(isset($_POST['operation'][$i])){
                            
                                if($_POST['operation'][$i] == "AX"){
                        
                                    if(isset($_POST['sub-operation'][$i])){
                                        
                                        if(isset($_POST['operation-data'][$i])){

                                            $p = isset($_POST['operation-data'][$i][0])? $_POST['operation-data'][$i][0]: NULL;
                                            $q = isset($_POST['operation-data'][$i][1])? $_POST['operation-data'][$i][1]: NULL;
                                            $r = isset($_POST['operation-data'][$i][2])? $_POST['operation-data'][$i][2]: NULL;
                                    
                                            $response[$i] = applyAxiom($_POST['sub-operation'][$i][0], $p, $q, $r);

                                        }else{
                                            echo "<h4>".($i + 1)." - ".$sequent." ~> Enter all the fields for your axiom correctly.</h4>"; return 0;
                                        }

                                    }else{
                                        echo "<h4>".($i + 1)." - ".$sequent." ~> Axiom not selected.</h4>"; return 0;
                                    }

                                }else if($_POST['operation'][$i] == "MP"){

                                    $a = isset($_POST['operation-data'][$i][0])? $_POST['operation-data'][$i][0]: NULL;
                                    $b = isset($_POST['operation-data'][$i][1])? $_POST['operation-data'][$i][1]: NULL;
                    
                                    $response[$i] = modusPonens(($i + 1), $a, $b);
                                    
                                }else if($_POST['operation'][$i] == "HIP"){
                                    $response[$i] = $sequent;
                                }else{
                                    echo "<h4>".($i + 1)." - ".$sequent." ~> Invalid operation."; return 0;
                                }

                                $line = "";

                                if($_POST['operation'][$i] == "AX"){
                                    if($_POST['sub-operation'][$i] == 10){
                                        $line = ($i + 1)." - ".$sequent." | ".$_POST['operation'][$i]." ".$_POST['sub-operation'][$i][0]." | p := ".parenthesesPattern($_POST['operation-data'][$i][0]);
                                    }else if(($_POST['sub-operation'][$i] == 2 || $_POST['sub-operation'][$i] == 8)){
                                        $line = ($i + 1)." - ".$sequent." | ".$_POST['operation'][$i]." ".$_POST['sub-operation'][$i][0]." | p := ".parenthesesPattern($_POST['operation-data'][$i][0]).", q := ".parenthesesPattern($_POST['operation-data'][$i][1]).", r := ".parenthesesPattern($_POST['operation-data'][$i][2]);
                                    }else{
                                        $line = ($i + 1)." - ".$sequent." | ".$_POST['operation'][$i]." ".$_POST['sub-operation'][$i][0]." | p := ".parenthesesPattern($_POST['operation-data'][$i][0]).", q := ".parenthesesPattern($_POST['operation-data'][$i][1]);
                                    }
                                }else if($_POST['operation'][$i] == "MP"){
                                    $line = ($i + 1)." - ".$sequent." | ".$_POST['operation'][$i]." ".$_POST['operation-data'][$i][0].",".$_POST['operation-data'][$i][1];
                                }else if($_POST['operation'][$i] == "HIP"){
                                    $line = ($i + 1)." - ".$sequent." | ".$_POST['operation'][$i];
                                }
                                
                                if($sequent != $response[$i]){
                    
                                    $line .= " ~> ".$response[$i];
                                    
                                    echo "<h4>$line</h4><br><h4>Incorrect formula.</h4>";
                                    
                                    return 0;

                                }

                                echo "<h4>$line</h4>";

                            }else{
                                echo "<h4>".($i + 1)." - ".$sequent." ~> Operation not selected.</h4>"; return 0;
                            }

                        }else{
                            echo "<h4>".($i + 1)." - ".$sequent." ~> Invalid formula syntax.</h4>"; return 0;
                        }

                    }else{
                        echo "<h4>".($i + 1)." - ".$sequent." ~> Invalid formula alphabet.</h4>"; return 0;
                    }

                }else{
                    echo "<h4>".($i + 1)." - Ø ~> There is no sequent on the line.</h4>"; return 0;
                }

            }

            echo "<br><h4>Correct formula.</h4>";

        }else{
            echo "<h4>No sequent was sent.</h4>";
        }
    
    }

?>