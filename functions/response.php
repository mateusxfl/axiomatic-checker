<!-- 
    
    & ~> CONJUNÇÃO
    # ~> DISJUNÇÃO
    > ~> IMPLICAÇÃO
    ~ ~> NEGAÇÃO

 -->

 <?php

    // Array com todos os axiomas possíveis.
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

    // Array com os símbolos atômicos.
    $atomicSymbols = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    
    // Array com os conectivos.
    $connectives = array('&','#','>');
    
    // Array com os conectivos unários.
    $unaryConnectives = array('~');
    
    // Array com os símbolos auxiliares.
    $auxiliarySymbols = array('(',')');

    // Array que armazena cada linha da resposta dada na tela.
    $response = array();


    // Converte um array em uma string.
    function arrayToString($array) {

        $string = "";

        for ( $i = 0 ; $i < count($array) ; $i++ ) {
            $string .= $array[$i];
        }

        return $string;

    }

    // Aplica uma padronização de parênteses, com intuito de evitar erros.
    function parenthesesPattern($formula){
        
        $formula = str_replace(' ', '', $formula);

        $formula = str_split($formula);

        $counter = 0;

        $j = 0;

        // Verifica se esse parêntese fecha corretamente.
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

        /**
         * Se o tamaho do vetor de caracteres ($formula) for == $j, quer dizer que o primeiro parêntese da 
         * fórmula fecha com o último.
         */
        if(count($formula) == $j){

            $formula = arrayToString($formula);

            // Removo os parênteses externos.
            $formula = substr($formula, 1, -1);

            /**
             * Chamo a função com a nova fórmula, até que nao tenha nenhum parêntese externo, exemplo:
             * 
             * ((a > b))
             * (a > b)
             * a > b
             * 
             */
            return parenthesesPattern($formula);

        }else{

            // Caso seja uma formula do tipo ~~~~a ou simplismente a, retorno ela mesma.
            $pattern = "/^\~*[a-z]{1}$/";
            
            if(preg_match($pattern, arrayToString($formula))){
                $formula = arrayToString($formula);
            }else{

                /**
                 * Caso seja do tipo a > b, como no exemplo, adiciono os parênteses externos e retorno a fórmula padronizada.
                 */
                $formula = "(".arrayToString($formula).")";

            }
            
            // Retorna a fórmula padronizada.
            return $formula;

        }

    }

    // Usa um regex para validar o alfabeto de uma fórmula.
    function checkAlphabet($formula) {

        $formula = str_replace(' ', '', $formula);

        $pattern = "/^[a-z&\#\>\~\)\(]+$/";

        if(preg_match($pattern, $formula)){
            return 1;
        }else{
            return 0;
        }

    }

    // Checa se a sintaxe de uma fórmula é válida.
    function checkSyntax($formula) {

        // Importo todas as variáveis globais para a função.
        global $atomicSymbols, $connectives, $unaryConnectives, $auxiliarySymbols;

        $formula = str_replace(' ', '', $formula);

        $formula = str_split($formula);
        
        /**
         * Verifica a primeira posição quando há somente um caractere na fórmula, caso o único 
         * caractere não seja um símbolo atômico, a fórmula é inválida.
         */
        if(count($formula) == 1 && !in_array($formula[0], $atomicSymbols)){
            return 0;
        }

        /**
         * Verifica a primeira posição quando há mais de um caractere na fórmula, caso o primeiro 
         * caractere não seja um símbolo atômico, uma negação ou um ( , a fórmula é inválida.
         */
        if(count($formula) > 1 && !in_array($formula[0], $atomicSymbols) && !in_array($formula[0], $unaryConnectives) && $formula[0] != "("){
            return 0;
        }

        /**
         * Verifica a última posição quando há mais de um caractere na fórmula, caso o primeiro 
         * caractere não seja um símbolo atômico ou um ) , a fórmula é inválida.
         */
        if(count($formula) > 1 && !in_array($formula[(count($formula)-1)], $atomicSymbols) && $formula[(count($formula)-1)] != ")"){
            return 0;
        }

        // Recorre todo o sequente verificando seu caractere posterior.
        for ( $i = 0 ; $i < count($formula) ; $i++ ){
            
            if(in_array($formula[$i], $auxiliarySymbols)){

                $counter = 0;

                $j = $i;

                if($formula[$i] == "("){

                    // O próximo caractere só pode ser um símbolo atômico, uma negação ou ( .
                    if(isset($formula[$i+1])){
                        if(!in_array($formula[$i+1], $atomicSymbols) && !in_array($formula[$i+1], $unaryConnectives) && $formula[$i+1] != "("){
                            return 0;
                        }
                    }

                    // Verifica se esse parêntese fecha corretamente.
                    do{
                        if($formula[$j] == "("){
                            $counter++;
                        }else if($formula[$j] == ")"){
                            $counter--;
                        }
    
                        $j++;
                    }while($counter != 0 && $j < count($formula));

                }else if($formula[$i] == ")"){
                    
                    // O próximo caractere só pode ser um conectivo ou ) .
                    if(isset($formula[$i+1])){
                        if(!in_array($formula[$i+1], $connectives) && $formula[$i+1] != ")"){
                            return 0;
                        }
                    }

                    // Verifica se esse parêntese fecha corretamente.
                    do{
                        if($formula[$j] == "("){
                            $counter--;
                        }else if($formula[$j] == ")"){
                            $counter++;
                        }
    
                        $j--;
                    }while($counter != 0 && $j >= 0);

                    /**
                     * Verifico se fecha voltando pelo fato de que poderia ter uma fórmula (a > b)),
                     * que iria validar, pois verificou somente os parênteses indo.
                     */
    
                }

                /** 
                 * Após a verificação se dado parêntese ) ou ( , é verificado se o mesmo fecha
                 * corretamente, se ele não fechar corretamente, $counter será diferente de 0.
                */
                if($counter != 0){
                    return 0;
                }

            }else if(in_array($formula[$i], $atomicSymbols)){

                // O próximo caractere só pode ser um conectivo ou ) .
                if(isset($formula[$i+1])){
                    if(!in_array($formula[$i+1], $connectives) && $formula[$i+1] != ")"){
                        return 0;
                    }
                }

            }else if(in_array($formula[$i], $connectives)){

                // O próximo caractere só pode ser um símbolo atômico, uma negação ou ( .
                if(isset($formula[$i+1])){
                    if(!in_array($formula[$i+1], $atomicSymbols) && !in_array($formula[$i+1], $unaryConnectives) && $formula[$i+1] != "("){
                        return 0;
                    }
                }

            }else if(in_array($formula[$i], $unaryConnectives)){

                // O próximo caractere só pode ser um símbolo atômico, uma negação ou ( .
                if(isset($formula[$i+1])){
                    if(!in_array($formula[$i+1], $atomicSymbols) && !in_array($formula[$i+1], $unaryConnectives) && $formula[$i+1] != "("){
                        return 0;
                    }
                }

            }

        }

        // Caso nenhuma das restrições tenha retornado false, a fórmula é válida, retornando true.
        return 1;
        
    }

    // Aplica um axioma $a, com os átomos $p, $q, $r.
    function applyAxiom($a, $p, $q = NULL, $r = NULL) { 

        if(is_numeric($a)){

            // Se foi passado o número 1, é aplicado o axioma de índice 0 no vetor.
            $a -= 1;
        
            if($a >= 0 && $a <= 9){   

                /**
                 * $p, $q, $r, e $status representam a validade dos átomos p, q, r e da fórmula
                 * respectivamente, elas tem intenção de verificar se dado um axioma X, todos
                 * os seus parâmetros foram informados corretamente.
                 */
                $status = 0; $status_p = 0; $status_q = 0; $status_r = 0;

                // Verifica se $p é válido.
                if(checkAlphabet($p) && checkSyntax($p)){
                    $status_p = 1; $p = str_replace(' ', '', $p);
                }

                // Verifica se $q é válido.
                if(checkAlphabet($q) && checkSyntax($q)){
                    $status_q = 1; $q = str_replace(' ', '', $q);
                }

                // Verifica se $r é válido.
                if(checkAlphabet($r) && checkSyntax($r)){
                    $status_r = 1; $r = str_replace(' ', '', $r);
                }

                /**
                 * Essa função verifica se dado um axioma X, todos os seus parâmetros foram 
                 * informados corretamente, ou seja, o axioma de índice 9 precisa apenas do
                 * $p válido, já o do índice 1 ou 7 precisam de $p, $q, $r válidos. Caso 
                 * todos os parâmetros informados para a aplicação do axioma estejam 
                 * corretos, $status = 1, informando que eu posso aplicar o axioma.
                 */
                if($a == 9 && $status_p){
                    $status = 1;
                }else if(($a == 1 || $a == 7) && $status_p && $status_q && $status_r){
                    $status = 1;
                }else if($status_p && $status_q){
                    $status = 1;
                }

                // Aplica o axioma.
                if($status){
                
                    // Importo o vetor de axiomas e símbolos atômicos para a função.
                    global $axioms, $atomicSymbols;
                
                    // Retiro todos os espaçõs do axioma.
                    $instance = str_replace(' ', '', $axioms[$a]);

                    // Quebro o axioma em um vetor de caracteres.
                    $instance = str_split($instance);
        
                    /** 
                     * Recorre todo o sequente do axioma $a verificando se o caractere na posição $i é 
                     * um símbolo atômico, caso seja: o mesmo é substituido pelo valor passado pela 
                     * função, de acordo com $p, $q, $r. 
                     **/
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
        
                    // Retorna o axioma com $p, $q, $r substituídos.
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

    // Aplica o modus ponnes dada a linha atual e a linha do sequente $a e $b.
    function modusPonens($currentLine, $a, $b) {

        /**
         * Verifica se as linhas informadas são válidas, onde $a e $b não podem estar a frente da
         * $currentLine e nem podem ser iguais ($a == b), consequetemente, támbem não há linhas
         * abaixo de 0.
         */
        if($currentLine > $a && $currentLine > $b && $a != $b && $a > 0 && $b > 0){
            
            // Importo o array que armazena cada linha da resposta mostrada na tela de para a função.
            global $response;

            // $a vai receber o sequente que está no índice $a-1 do vetor $response.
            $a = $response[$a-1];
            // $b vai receber o sequente que está no índice $b-1 do vetor $response.
            $b = $response[$b-1];

            // Vejo qual sequente é maior, e posteriormente $b sempre será o maior.
            if(strlen($a) > strlen($b)){
                $auxiliary = $b;
                $b = $a;
                $a = $auxiliary;
            }

            // Retiro os parênteses extenos de $b.
            $b = substr($b, 1, -1);

            // Quebro o $b em um vetor de caracteres.
            $b = str_split($b);

            // Se existe a posição (tamanho de $a) no vetor de caracteres $b e esta posição é uma >.
            if(isset($b[strlen($a)]) && $b[strlen($a)] == ">") {
                $b = arrayToString($b);

                // Se todo o $b antes da implicação (>) for igual a $a, o modus ponnes é válido.
                if(substr($b, 0, strlen($a)) == $a) {

                    /**
                     * $b vai ser cortado antes da implicação (>), ou seja, vai receber todo o 
                     * conteúdo após a implicação do modus ponnes.
                     */
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

    /**
     * Responsável por chamar todas as outra funções, de acordo com as requisições do usuário; e 
     * também mostra a resposta ou possíveis erros na tela.
     */
    function returnResponse(){

        // Importo o array que armazena cada linha da resposta mostrada na tela de para a função.
        global $response;

        // Verifico se o sequente foi digitado.
        if(isset($_POST['sequent']) && !empty($_POST['sequent'])){
            
            // Recorro todos os sequentes, ou seja, verifico cada linha digitada.
            for ( $i = 0 ; $i < count($_POST['sequent']) ; $i++ ){

                // Verifico se existe um sequente na linha $i.
                if(isset($_POST['sequent'][$i])){

                    // Aplico a padronização de parênteses no sequente da linha $i.
                    $sequent = parenthesesPattern($_POST['sequent'][$i]);

                    // Verifico se o alfabeto do sequente da linha $i é válido.
                    if(checkAlphabet($sequent)){
                        
                        // Verifico se a sintaxe do sequente da linha $i é válido.
                        if(checkSyntax($sequent)){

                            // Verifico se existe uma operação (HIP,AX,MP) na linha $i.
                            if(isset($_POST['operation'][$i])){
                            
                                if($_POST['operation'][$i] == "AX"){
                        
                                    // Verifico se foi selecionado um axioma de 1 a 10.
                                    if(isset($_POST['sub-operation'][$i])){
                                        
                                        /**
                                         * Verifico se os dados referentes ao axioma da linha $i 
                                         * foram preenchidos.
                                         */
                                        if(isset($_POST['operation-data'][$i])){

                                            // Atribuo a $p, $q, $r os valores preenchidos.
                                            $p = isset($_POST['operation-data'][$i][0])? $_POST['operation-data'][$i][0]: NULL;
                                            $q = isset($_POST['operation-data'][$i][1])? $_POST['operation-data'][$i][1]: NULL;
                                            $r = isset($_POST['operation-data'][$i][2])? $_POST['operation-data'][$i][2]: NULL;
                                    
                                            /**
                                             * A resposta da linha $i vai receber o axioma aplicado 
                                             * com os dados digitados.
                                             */
                                            $response[$i] = applyAxiom($_POST['sub-operation'][$i][0], $p, $q, $r);

                                        }else{
                                            echo "<h4>".($i + 1)." - ".$sequent." ~> Enter all the fields for your axiom correctly.</h4>"; return 0;
                                        }

                                    }else{
                                        echo "<h4>".($i + 1)." - ".$sequent." ~> Axiom not selected.</h4>"; return 0;
                                    }

                                }else if($_POST['operation'][$i] == "MP"){

                                    /**
                                     * Atribuo a $a e $b o valores da linhas usadas para o modus 
                                     * ponnes 
                                     */
                                    $a = isset($_POST['operation-data'][$i][0])? $_POST['operation-data'][$i][0]: NULL;
                                    $b = isset($_POST['operation-data'][$i][1])? $_POST['operation-data'][$i][1]: NULL;
                    
                                    /**
                                     * A resposta da linha $i vai receber o modus ponnes aplicado 
                                     * com as linha digitadas, a função passa o parâmetro ($i+1),
                                     * que é a linha atual sendo executada.
                                     */
                                    $response[$i] = modusPonens(($i + 1), $a, $b);
                                    
                                }else if($_POST['operation'][$i] == "HIP"){

                                    /**
                                     * A resposta da linha $i vai apenas receber a hipótese digitada,
                                     * tendo em vista que a mesma é valida.
                                     */
                                    $response[$i] = $sequent;

                                }else{
                                    echo "<h4>".($i + 1)." - ".$sequent." ~> Invalid operation."; return 0;
                                }

                                $line = "";

                                /**
                                 * Esses IF's retornam o feedback da linha, exemplo: número da linha, 
                                 * qual operação foi usada e os dados referentes a operação, no caso
                                 * que a operação seja modus ponnes: é mostrado as linhas, axiomas:
                                 * é mostrado qual foi usado, e suas substituições, já na hipótese: 
                                 * é apenas informado que o sequente  da linha $i é uma hipótese,
                                 * na mesma támbem é mostrado o sequente inserido.
                                 */
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
                                
                                /**
                                 * Caso o sequente digitado seja diferente do esperado pelo sistema,
                                 * o sistema mostra como ele deveria ter sido feito (de acordo com
                                 * os dados da operação), e o corrige, posteriormente, parando a 
                                 * execução na linha do erro:
                                 * 
                                 *  1 - a | HIP
                                 *  2 - (a>b) | HIP
                                 *  3 - b | MP 1,2
                                 */
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