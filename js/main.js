var myColor = localStorage.getItem("myColor");
var myBox = sessionStorage.getItem("myBox");
var myLine = sessionStorage.getItem("myLine");

if(myColor != null){
    document.getElementById('theme').setAttribute('href', 'css/colors/'+myColor+'.css');
}else{
    document.getElementById('theme').setAttribute('href', 'css/colors/7.css');
}

var page = window.location.href.substr(-10)

if(myBox != null && page != "result.php"){

    document.getElementsByClassName('box')[0].innerHTML = myBox;

    $('.select2-container').remove();

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

}

if(myLine != null){
    line = myLine;
}else{
    line = 1;
}

function stateCapture(){ // OK
    myBox = document.getElementsByClassName("box")[0].innerHTML;

    sessionStorage.setItem("myBox", myBox);
    sessionStorage.setItem("myLine", line);
}

function addLine(){ // OK

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

function addOperationData(operation, line){ // OK

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

function changeAxiom(axiom, line){ // OK

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

function deleteLine(line){ // OK
    
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

        lengthClass = document.getElementsByClassName('data-line-'+i).length
        
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
        
        // NAME sequent[]
        // NAME operation[]

        // #operation-line-
        // #sub-operation-line-
        // #operation-data-line-

        // #sequent-line-
        // deleteLine(line)                 - #delete-btn-line-
        // HTML span-line-                  - #span-line-
        // PLACEHOLDER placheholder-line-   - #placeholder-line-
        // OperationData(this, line)        - #select-operation-line-
        // NAME operation-data[line-1][]    - .data-line-
        // changeAxiom(this, line)          - #select-axiom-line-
        // name sub-operation[line-1]       - #select-axiom-line-
    
    }

    this.line--;

}

function openMenu(){ // OK
    document.getElementById("menu").style.width = "50px";
    document.getElementById("menu").style.borderRight = "solid 2px white";   
}

function closeMenu(){ // OK
    document.getElementById("menu").style.width = "0";
    document.getElementById("menu").style.borderRight = "";
}

function changeTheme(color){ // OK
    localStorage.setItem("myColor", color);
    document.getElementById('theme').setAttribute('href', 'css/colors/'+color+'.css');
}

// (function ($) {
//     "use strict";


//     /*==================================================================
//     [ Focus Contact2 ]*/
//     $('.input100').each(function(){
//         $(this).on('blur', function(){
//             if($(this).val().trim() != "") {
//                 $(this).addClass('has-val');
//             }
//             else {
//                 $(this).removeClass('has-val');
//             }
//         })    
//     })
  
  
//     /*==================================================================
//     [ Validate ]*/
//     var name = $('.validate-input input[name="name"]');
//     var email = $('.validate-input input[name="email"]');
//     var message = $('.validate-input textarea[name="message"]');


//     $('.validate-form').on('submit',function(){
//         var check = true;

//         if($(name).val().trim() == ''){
//             showValidate(name);
//             check=false;
//         }


//         // if($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
//         //     showValidate(email);
//         //     check=false;
//         // }

//         // if($(message).val().trim() == ''){
//         //     showValidate(message);
//         //     check=false;
//         // }

//         return check;
//     });


//     $('.validate-form .input100').each(function(){
//         $(this).focus(function(){
//            hideValidate(this);
//        });
//     });

//     function showValidate(input) {
//         var thisAlert = $(input).parent();

//         $(thisAlert).addClass('alert-validate');
//     }

//     function hideValidate(input) {
//         var thisAlert = $(input).parent();

//         $(thisAlert).removeClass('alert-validate');
//     }
    
    

// })(jQuery);