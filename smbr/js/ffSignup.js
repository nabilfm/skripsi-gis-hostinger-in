$(document).ready(function(){
	$("#createUv").validate({
        rules: {
            u_fname: {
                required: true,
                minlength: 3,
                usercek:true
            },
            u_lname: {
                required: true,
                minlength: 3,
                usercek:true
            },
            uname: {
                required: true,
                usercek: true,
                minlength: 5,
				remote: {
					url: "http://birdpacker.org/userv",
					type: post
				}
            },
            email: {
                required: true,
                email:true
            },
            password: {
      				required: true,
      				pwcheck: true,
      				minlength: 5
      			},
            level:{
              required: true
            },
      			confirm_password: {
      				required: true,
      				minlength: 5,
      				equalTo: "#password"
      			},
      			u_phone: {
                      required: true,
                      number:true
                  },
            u_organization: {
                required: true,
                minlength: 3,
                usercek:true
            },
        },
        //For custom messages
        messages: {
        	u_fname:{
        		minlength: 	"please enter at least 3 characters.",
            	usercek: 	"Alphabet only"
        	},
        	u_lname:{
        		minlength: 	"please enter at least 3 characters.",
            	usercek: 	"Alphabet only"
        	},
          uname:{
                required: 	"Enter a username",
                minlength: 	"Enter at least 5 characters",
                usercek: 	"username must contain at least one number and one character and one uppercase",
			  	remote: 	"this username has been taken"
            },
        	password:{
                required: 	"Enter your password",
                minlength: 	"Enter at least 5 characters",
                pwcheck: 	"password must contain at least one number and one character and one uppercase"
            },
          level:{
                required: "please choose one "
          },
          u_organization:{
            minlength: "please enter at least 3 characters.",
            usercek: "Alphabet only"
          },
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
          	focusCleanup: true
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
	$("#editU").validate({
		rules: {
			u_fname: {
				required: true,
				minlength: 3,
				usercek:true
			},
			u_lname: {
				required: true,
				minlength: 3,
				usercek:true
			},
			uname: {
				required: true,
				usercek: true,
				minlength: 5
			},
			email: {
				required: true,
				email:true
			},
			password: {
				required: true,
				pwcheck: true,
				minlength: 5
			},
			level:{
				required: true
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			u_phone: {
				required: true,
				number:true
			},
			u_organization: {
				required: true,
				minlength: 3,
				usercek:true
			},
		},
		//For custom messages
		messages: {
			u_fname:{
				minlength: 	"please enter at least 3 characters.",
				usercek: 	"Alphabet only"
			},
			u_lname:{
				minlength: 	"please enter at least 3 characters.",
				usercek: 	"Alphabet only"
			},
			uname:{
				required: 	"Enter a username",
				minlength: 	"Enter at least 5 characters",
				usercek: 	"username must contain at least one number and one character and one uppercase"
			},
			password:{
				required: 	"Enter your password",
				minlength: 	"Enter at least 5 characters",
				pwcheck: 	"password must contain at least one number and one character and one uppercase"
			},
			level:{
				required: "please choose one "
			},
			u_organization:{
				minlength: "please enter at least 3 characters.",
				usercek: "Alphabet only"
			},
		},
		errorElement : 'div',
		errorPlacement: function(error, element) {
			var placement = $(element).data('error');
			if (placement) {
				focusCleanup: true
				$(placement).append(error)
			} else {
				error.insertAfter(element);
			}
		}
	});
  // var g = $('#lblLevel').val();  //for level
  // if (g==2) {
  //   $('input#test2').attr("checked", "checked");
  // }else{
  //   $('input#test1').attr("checked", "checked");
  // };

  $.validator.addMethod("usercek", function(value) {
     return /^[A-Za-z0-9\d]*$/.test(value) // consists of only these
         && /[a-z]/.test(value) // has a lowercase letter
  });
	$.validator.addMethod("pwcheck", function(value) {
	   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
	       && /[a-z]/.test(value) // has a lowercase letter
	       && /\d/.test(value) // has a digit
	});
  
/*	
  jQuery.validator.addMethod("password", function( value, element ) {
		var result = this.optional(element) || value.length >= 6 && /\d/.test(value) && /[a-z]/i.test(value);
		if (!result) {
			element.value = "";
			var validator = this;
			setTimeout(function() {
				validator.blockFocusCleanup = true;
				element.focus();
				validator.blockFocusCleanup = false;
			}, 1);
		}
		return result;
	}, "Your password must be at least 6 characters long and contain at least one number and one character.");

	// a custom method making the default value for companyurl ("http://") invalid, without displaying the "invalid url" message
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		return value != element.defaultValue;
	}, "");

	jQuery.validator.addMethod("billingRequired", function(value, element) {
		if ($("#bill_to_co").is(":checked"))
			return $(element).parents(".subTable").length;
		return !this.optional(element);
	}, "");

	jQuery.validator.messages.required = "";
	$("form").validate({
		invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1
					? 'You missed 1 field. It has been highlighted below'
					: 'You missed ' + errors + ' fields.  They have been highlighted below';
				$("div.error span").html(message);
				$("div.error").show();
			} else {
				$("div.error").hide();
			}
		},
		onkeyup: false,
		submitHandler: function() {
			$("div.error").hide();
			alert("submit! use link below to go to the other step");
		},
		messages: {
			password2: {
				required: " ",
				equalTo: "Please enter the same password as above"
			},
			email: {
				required: " ",
				email: "Please enter a valid email address, example: you@yourdomain.com",
				remote: jQuery.validator.format("{0} is already taken, please enter a different address.")
			}
		},
		debug:true
	});

  $("input.phone").mask("(999) 999-9999");
  $("input.zipcode").mask("99999");
  var creditcard = $("#creditcard").mask("9999 9999 9999 9999");

  $("#cc_type").change(
    function() {
      switch ($(this).val()){
        case 'amex':
          creditcard.unmask().mask("9999 999999 99999");
          break;
        default:
          creditcard.unmask().mask("9999 9999 9999 9999");
          break;
      }
    }
  );

  // toggle optional billing address
  var subTableDiv = $("div.subTableDiv");
  var toggleCheck = $("input.toggleCheck");
  toggleCheck.is(":checked")
  	? subTableDiv.hide()
	: subTableDiv.show();
  $("input.toggleCheck").click(function() {
      if (this.checked == true) {
        subTableDiv.slideUp("medium");
        $("form").valid();
      } else {
        subTableDiv.slideDown("medium");
      }
  });
*/

});