$(document).ready(function() {
    $('input#input_text, textarea#textarea1').characterCounter();
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $("#btn_remove_input"); //Fields wrapper
    var add_button      = $("#btn_add_input"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  });
        