// Armazerna a cor do tema no localStorage, para sempre ficar ativo de acordo com quem o aplicou.
var myColor = localStorage.getItem("myColor");

// Armazena o conteudo da div box, para caso o usuário precise voltar a página, a mesma estar preenchida.
var myBox = sessionStorage.getItem("myBox");

/**
 * Verifica se ja existe uma linha definida (para caso o myBox seja usado, ao adicionar uma linha, a 
 * mesma começar a partir de onde parou).
 */
var myLine = sessionStorage.getItem("myLine");

// Se não há uma cor definida é setado o tema padrão.
if(myColor != null){
    document.getElementById('theme').setAttribute('href', 'css/colors/'+myColor+'.css');
}else{
    document.getElementById('theme').setAttribute('href', 'css/colors/7.css');
}

// Captura os 10 últimos digitos da url.
var page = window.location.href.substr(-10)

/**
 * Se a página está no index, e my Box tem conteúdo, implica que ele voltou a página, entao a div box
 * é preenchida novamente com o conteudo de myBox.
 */
if(myBox != null && page != "result.php"){

    document.getElementsByClassName('box')[0].innerHTML = myBox;

    $('.select2-container').remove();

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

}

// Seta o valor da linha = myLine, caso não exista é setado como 1.
if(myLine != null){
    line = myLine;
}else{
    line = 1;
}

// Captura o estado do formulário ao enviar a página.
function stateCapture(){ 

    // myBox recebe todo o conteudo da div box.
    myBox = document.getElementsByClassName("box")[0].innerHTML;

    // MyBox e MyLine são armazenados no sessionStorage.
    sessionStorage.setItem("myBox", myBox);
    sessionStorage.setItem("myLine", line);

}

// Adiciona uma linha na div box.
function addLine(){

    $('.box').append(
        '<div id="sequent-line-'+line+'">'
            +'<div class="row">'
                +'<div class="col-md-1 delete-btn">'
                    +'<div class="container-contact100-form-btn">'
                        +'<div class="wrap-contact100-form-btn">'
                            +'<div class="contact100-form-bgbtn"></div>'
                            +'<a id="delete-btn-line-'+line+'"onclick="deleteLine('+line+');" class="contact100-form-btn">'
                                +'<span class="btn-span">'
                                    +'<i class="fa fa-trash" aria-hidden="true"></i>'
                                +'</span>'
                            +'</a>'
                        +'</div>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-4">'
                    +'<div class="wrap-input100 validate-input">'
                        +'<span class="label-input100" id="span-line-'+line+'">Line '+line+'</span>'
                        +'<input class="input100" id="placeholder-line-'+line+'" type="text" name="sequent[]" placeholder="Line '+line+'">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-7" id="operation-line-'+line+'">'
                    +'<div class="wrap-input100 input100-select">'
                        +'<span class="label-input100">Operation</span>'
                        +'<div>'
                            +'<select id="select-operation-line-'+line+'" onchange="addOperationData(this, '+line+')" class="selection-2" name="operation[]">'
                                +'<option value="HIP" selected>HIP</option>'
                                +'<option value="MP">MP</option>'
                                +'<option value="AX">AX</option>'
                            +'</select>'
                        +'</div>'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
                +'<div id="sub-operation-line-'+line+'"></div>'
                +'<div id="operation-data-line-'+line+'"></div>'
            +'</div>'
        +'</div>'
    );

    this.line++;

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
    
}

/**
 * Adiciona os inputs relativos ao dados necessarios para determinada operação, exemplo: para axiomas
 * é adicionado os inputs p,q; já para o modus ponnes é adicionado os inputs line 1 e 2.
 */
function addOperationData(operation, line){ 

    $('#operation-line-'+line).empty();
    $('#sub-operation-line-'+line).empty();
    $('#operation-data-line-'+line).empty();

    if(operation.value == "HIP"){

        document.getElementById('operation-line-'+line).className = "col-md-7";
        document.getElementById('sub-operation-line-'+line).className = "";
        document.getElementById('operation-data-line-'+line).className = "";

        $('#operation-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-12">'
                    +'<div class="wrap-input100 input100-select">'
                        +'<span class="label-input100">Operation</span>'
                        +'<div>'
                            +'<select id="select-operation-line-'+line+'" onchange="addOperationData(this, '+line+')" class="selection-2" name="operation[]">'
                                +'<option value="HIP" selected>HIP</option>'
                                +'<option value="MP">MP</option>'
                                +'<option value="AX">AX</option>'
                            +'</select>'
                        +'</div>'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

    }else if(operation.value == "MP"){

        document.getElementById('operation-line-'+line).className = "col-md-1";
        document.getElementById('sub-operation-line-'+line).className = "";
        document.getElementById('operation-data-line-'+line).className = "col-md-6";

        $('#operation-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-12">'
                    +'<div class="wrap-input100 input100-select">'
                        +'<span class="label-input100">OP</span>'
                        +'<div>'
                            +'<select id="select-operation-line-'+line+'" onchange="addOperationData(this, '+line+')" class="selection-2" name="operation[]">'
                                +'<option value="HIP">HIP</option>'
                                +'<option value="MP" selected>MP</option>'
                                +'<option value="AX">AX</option>'
                            +'</select>'
                        +'</div>'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

        $('#operation-data-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-6">'
                    +'<div class="wrap-input100 validate-input">'
                        +'<span class="label-input100">Line 1</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-6">'
                    +'<div class="wrap-input100 validate-input">'
                        +'<span class="label-input100">Line 2</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

    }else if(operation.value == "AX"){

        document.getElementById('operation-line-'+line).className = "col-md-1";
        document.getElementById('sub-operation-line-'+line).className = "col-md-1";
        document.getElementById('operation-data-line-'+line).className = "col-md-5";

        $('#operation-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-12">'
                    +'<div class="wrap-input100 input100-select">'
                        +'<span class="label-input100">OP</span>'
                        +'<div>'
                            +'<select id="select-operation-line-'+line+'" onchange="addOperationData(this, '+line+')" class="selection-2" name="operation[]">'
                                +'<option value="HIP">HIP</option>'
                                +'<option value="MP">MP</option>'
                                +'<option value="AX" selected>AX</option>'
                            +'</select>'
                        +'</div>'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

        $('#sub-operation-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-12">'
                    +'<div class="wrap-input100 input-axiom input100-select">'
                        +'<span class="label-input100">Axiom</span>'
                        +'<div>'
                            +'<select id="select-axiom-line-'+line+'" onchange="changeAxiom(this, '+line+')" class="selection-2" name="sub-operation['+(line-1)+'][]">'
                                +'<option value="1" title="p → (q → p)">01</option>'
                                +'<option value="2" title="(p → (q → r)) → ((p → q) → (p → r))">02</option>'
                                +'<option value="3" title="p → (q → (p ∧ q))">03</option>'
                                +'<option value="4" title="(p ∧ q) → p">04</option>'
                                +'<option value="5" title="(p ∧ q) → q">05</option>'
                                +'<option value="6" title="p → (p ∨ q)">06</option>'
                                +'<option value="7" title="q → (p ∨ q)">07</option>'
                                +'<option value="8" title="(p → r) → ((q → r) → ((p ∨ q) → r))">08</option>'
                                +'<option value="9" title="(p → q) → ((p → ¬q) → ¬p)">09</option>'
                                +'<option value="10" title="¬¬p → p">10</option>'
                            +'</select>'
                        +'</div>'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

        $('#operation-data-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-6">'
                    +'<div class="wrap-input100 input-subs validate-input">'
                        +'<span class="label-input100">P</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-6">'
                    +'<div class="wrap-input100 input-subs validate-input">'
                        +'<span class="label-input100">Q</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

    }

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
    
}

// Ao mudar o valor do select que contem os 10 axiomas, os inputs relativos a p, q, r são modificados.
function changeAxiom(axiom, line){

    $('#operation-data-line-'+line).empty();

    if(axiom.value == 10){

        $('#operation-data-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-12">'
                    +'<div class="wrap-input100 input-subs validate-input">'
                        +'<span class="label-input100">P</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

    }else if(axiom.value == 2 || axiom.value == 8){

        $('#operation-data-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-4">'
                    +'<div class="wrap-input100 input-subs validate-input">'
                        +'<span class="label-input100">P</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-4">'
                    +'<div class="wrap-input100 input-subs validate-input">'
                        +'<span class="label-input100">Q</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-4">'
                    +'<div class="wrap-input100 input-subs validate-input">'
                        +'<span class="label-input100">R</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

    }else{

        $('#operation-data-line-'+line).append(
            '<div class="row">'
                +'<div class="col-md-6">'
                    +'<div class="wrap-input100 input-subs validate-input">'
                        +'<span class="label-input100">P</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
                +'<div class="col-md-6">'
                    +'<div class="wrap-input100 input-subs validate-input">'
                        +'<span class="label-input100">Q</span>'
                        +'<input class="input100 data-line-'+line+'" type="text" name="operation-data['+(line-1)+'][]">'
                        +'<span class="focus-input100"></span>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );

    }

    $("#select-axiom-line-"+line+" option").each(function(){
        if ($(this).val() == axiom.value){
            $(this).attr("selected","selected");
        }else{
            $(this).removeAttr("selected");
        }
    });

}

// Deleta uma linha do formulário, realocando todas as suas posteriores.
function deleteLine(line){ 
    
    $('#sequent-line-'+line).remove();

    for(var i = (line + 1) ; i < this.line ; i++ ){
        
        document.getElementById('delete-btn-line-'+i).setAttribute('onclick', 'deleteLine('+(i - 1)+');');
        document.getElementById('span-line-'+i).innerHTML = "Line " + (i - 1);
        document.getElementById('placeholder-line-'+i).setAttribute('placeholder', 'Line ' + (i - 1));
        document.getElementById('select-operation-line-'+i).setAttribute('onchange', 'addOperationData(this, '+(i - 1)+');');
        
        document.getElementById('sequent-line-'+i).setAttribute('id', 'sequent-line-'+(i - 1));
        document.getElementById('delete-btn-line-'+i).setAttribute('id', 'delete-btn-line-'+(i - 1));
        document.getElementById('span-line-'+i).setAttribute('id', 'span-line-'+(i - 1));
        document.getElementById('placeholder-line-'+i).setAttribute('id', 'placeholder-line-'+(i - 1));
        document.getElementById('select-operation-line-'+i).setAttribute('id', 'select-operation-line-'+(i - 1));
        document.getElementById('operation-line-'+i).setAttribute('id', 'operation-line-'+(i - 1));
        document.getElementById('sub-operation-line-'+i).setAttribute('id', 'sub-operation-line-'+(i - 1));
        document.getElementById('operation-data-line-'+i).setAttribute('id', 'operation-data-line-'+(i - 1));

        var lengthClass = document.getElementsByClassName('data-line-'+i).length
        
        if(lengthClass != 0){
            for ( var j = 0 ; j < lengthClass ; j++ ){
                document.getElementsByClassName('data-line-'+i)[0].setAttribute('name', 'operation-data['+((i - 1)-1)+'][]');
                document.getElementsByClassName('data-line-'+i)[0].setAttribute('class', 'input100 data-line-'+(i - 1));
            }
        }

        if(document.getElementById('select-axiom-line-'+i)){
            document.getElementById('select-axiom-line-'+i).setAttribute('onchange', 'changeAxiom(this, '+(i - 1)+');');
            document.getElementById('select-axiom-line-'+i).setAttribute('name', 'sub-operation['+((i - 1)-1)+'][]');
            document.getElementById('select-axiom-line-'+i).setAttribute('id', 'select-axiom-line-'+(i - 1));
        }
    
    }

    this.line--;

}

// Abre menu lateral.
function openMenu(){ 
    document.getElementById("menu").style.width = "50px";
    document.getElementById("menu").style.borderRight = "solid 2px white";   
}

// Fecha menu lateral
function closeMenu(){
    document.getElementById("menu").style.width = "0";
    document.getElementById("menu").style.borderRight = "";
}

// Troca o tema do sistema.
function changeTheme(color){ 
    localStorage.setItem("myColor", color);
    document.getElementById('theme').setAttribute('href', 'css/colors/'+color+'.css');
}