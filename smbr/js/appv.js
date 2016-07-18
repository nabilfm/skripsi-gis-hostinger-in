/**
 * Created by maryatimth on 4/30/2016.
 */

$(document).ready(function(){
    var token = $('meta[name=csrf-token]').attr('content');
    var azzz = $('input.ttes').val();
    $("#user").validate({
        rules:{
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
                idcek: true,
                minlength: 5,
                remote: {
                    url: window.location.protocol + "//" + window.location.host + "/userv",
                    type: "post",
                    data:  {
                        'tmpnm': azzz,
                        '_token': token
                    }
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
            }
        },
        messages:{
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
                idcek: 	"Alphabet only",
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
            }
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
        },
        submitHandler: function(form) {
            $('button[type=submit]').prop('disabled',true);
            form.submit();
        }

    });
    $("#formFauna").validate({
        rules:{
            fn_id:{
                required: true,
                idcek: true,
                minlength: 5,
                remote: {
                    url: window.location.protocol + "//" + window.location.host + "/fnv",
                    type: "post",
                    data:  {
                        'tmpnm': azzz,
                        '_token': token
                    }
                }
            },
            'fn_name-id':{required:true, usercek:true},
            'fn_name-en':{required:true, usercek:true},
            'fn_name-lat':{required:true, usercek:true},
            fn_family:{required:true, usercek:true},
            fn_keyword:{required:true, tags:true},
            fn_source:{required:true},

            i_deskripsi:{required:true,
                // deskripsi:true
            },
            i_distribution:{required:true,
                // deskripsi:true
            },
            i_musim:{required:true,
                // tags:true
            },
            i_sosial:{required:true,
                // usercek:true
            },
            i_ukuran:{required:true,
                // tags:true
            },
            i_kelompok:{required:true,
                // usercek:true
            },
            i_bentuk:{required:true,
                // usercek:true
            },
            
            e_deskripsi:{required:true,
                // deskripsi:true
            },
            e_distribution:{required:true,
                // deskripsi:true
            },
            e_musim:{required:true,
                // tags:true
            },
            e_sosial:{required:true,
                // usercek:true
            },
            e_ukuran:{required:true,
                // tags:true
            },
            e_kelompok:{required:true,
                // usercek:true
            },
            e_bentuk:{required:true,
                // usercek:true
            },
        },
        messages:{
            fn_id:{
                minlength: "Enter at least 5 characters",
                idcek: "alphabet only",
                remote: "this id has been taken"
            },
            'fn_name-id':{
                usercek: 	"Alphabet only"
            },
            'fn_name-en':{
                usercek: 	"Alphabet only"
            },
            'fn_name-lat':{
                usercek: 	"Alphabet only"
            },
            fn_family:{
                usercek: 	"Alphabet only"
            },
            fn_keyword:{
                usercek: 	"Alphabet only"
            },

            i_deskripsi: {deskripsi: "only characters [a-z] [0-9] [!()\"\'.,-] allowed"},
            i_musim:{tags:"only characters allowed: [a-z] [0-9] and comma"},
            i_sosial:{usercek:"only characters allowed: [a-z] [0-9] and space"},
            i_ukuran:{tags:"only characters allowed: [a-z] [0-9] and comma"},
            i_kelompok:{usercek:"only characters allowed: [a-z] [0-9] and space"},
            i_bentuk:{usercek:"only characters allowed: [a-z] [0-9] and space"},
            
            e_deskripsi:{deskripsi: "only characters [a-z] [0-9] [!()\"\'.,-] allowed"},
            e_musim:{tags:"only characters allowed: [a-z] [0-9] and comma"},
            e_sosial:{usercek:"only characters allowed: [a-z] [0-9]"},
            e_ukuran:{tags:"only characters allowed: [a-z] [0-9] and comma"},
            e_kelompok:{usercek:"only characters allowed: [a-z] [0-9] and space"},
            e_bentuk:{usercek:"only characters allowed: [a-z] [0-9] and space"}
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
        },
        submitHandler: function(form) {
            $('button[type=submit]').prop('disabled',true);
            form.submit();
        }
    });
    $("#formFlora").validate({
        rules:{
            fl_id:{required: true, idcek: true, minlength: 5, remote: {url: window.location.protocol + "//" + window.location.host + "/flv", type: "post", data: {'tmpnm': azzz, '_token': token}}},
            'fl_name-id':{required: true,usercek: true},
            'fl_name-en':{required: true,usercek: true},
            'fl_name-lat':{required: true,usercek: true},
            fl_family:{required: true,usercek: true},
            fl_height:{required: true,usercek: true},
            fl_leafSize:{required: true,tags: true},
            fl_flowerDiameter:{required: true,usercek: true},
            fl_keyword:{required: true,tags: true},
            fl_source:{required: true},

            i_deskripsi:{required:true,
                // deskripsi:true
            },
            i_distribution:{required:true,
                // deskripsi:true
            },
            i_musim:{required:true,
                // tags:true
            },
            i_sosial:{required:true,
                // usercek:true
            },
            i_ukuran:{required:true,
                // tags:true
            },
            i_kelompok:{required:true,
                // usercek:true
            },
            i_bentuk:{required:true,
                // usercek:true
            },

            e_deskripsi:{required:true,
                // deskripsi:true
            },
            e_distributions:{required:true,
                // deskripsi:true
            },
            e_musim:{required:true,
                // tags:true
            },
            e_sosial:{required:true,
                // usercek:true
            },
            e_ukuran:{required:true,
                // tags:true
            },
            e_kelompok:{required:true,
                // usercek:true
            },
            e_bentuk:{required:true,
                // usercek:true
            }
        },
        messages:{

            fl_id:{
                minlength: "Enter at least 5 characters",
                idcek: "alphabet only",
                remote: "this id has been taken"
            },
            'fl_name-id':{
                usercek: 	"Alphabet only"
            },
            'fl_name-en':{
                usercek: 	"Alphabet only"
            },
            'fl_name-lat':{
                usercek: 	"Alphabet only"
            },
            fl_family:{
                usercek: 	"Alphabet only"
            },
            fl_height:{
                usercek: 	"Alphabet only"
            },
            fl_leafSize:{
                tags: 	"Alphabet only"
            },
            fl_flowerDiameter:{
                usercek: 	"Alphabet only"
            },
            fl_keyword:{
                tags: 	"Alphabet only"
            },


            i_deskripsi: {deskripsi: "only characters [a-z] [0-9] [!()\"\'.,-] allowed"},
            i_musim:{tags:"only characters allowed: [a-z] [0-9] and comma"},
            i_sosial:{usercek:"only characters allowed: [a-z] [0-9] and space"},
            i_ukuran:{tags:"only characters allowed: [a-z] [0-9] and comma"},
            i_kelompok:{usercek:"only characters allowed: [a-z] [0-9] and space"},
            i_bentuk:{usercek:"only characters allowed: [a-z] [0-9] and space"},
            e_deskripsi:{deskripsi: "only characters [a-z] [0-9] [!()\"\'.,-] allowed"},
            e_musim:{tags:"only characters allowed: [a-z] [0-9] and comma"},
            e_sosial:{usercek:"only characters allowed: [a-z] [0-9]"},
            e_ukuran:{tags:"only characters allowed: [a-z] [0-9] and comma"},
            e_kelompok:{usercek:"only characters allowed: [a-z] [0-9] and space"},
            e_bentuk:{usercek:"only characters allowed: [a-z] [0-9] and space"}
        },
        errorElement:'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                focusCleanup: true;
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('button[type=submit]').prop('disabled',true);
            form.submit();
        }
    });
    $("#formFieldguide").validate({
        rules: {
            FG_label: {
                required: true,
                idcek: true,
                minlength: 5,
                remote: {
                    url: window.location.protocol + "//" + window.location.host + "/fgv",
                    type: "post",
                    data:  {
                        'tmpnm': azzz,
                        '_token': token
                    }
                }
            },
            FG_name: {
                required: true,
                // usercek: true,
                minlength: 5
            },
            FG_address: {
                required: true,
                // usercek: true,
                minlength: 5
            },
            FG_phone: {
                required: true,
                number: true,
                minlength: 5
            }
        },
        //For custom messages
        messages: {
            FG_label:{
                minlength: 	"Enter at least 5 characters",
                idcek: "alphabet only",
                remote: 	"this label has been taken"
            },
            FG_name:{
                minlength: 	"Enter at least 5 characters",
                usercek: 	"Alphabet only"
            },
            FG_address:{
                minlength: 	"Enter at least 5 characters",
                usercek: 	"Alphabet only"
            },
            FG_phone:{
                required: 	"Enter a label for fieldguide",
                minlength: 	"Enter at least 5 characters",
                number: 	"numbers only"
            }
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                focusCleanup: true;
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('button[type=submit]').prop('disabled',true);
            form.submit();
        }
    });
    $("#formSound").validate({
        rules:{
            credit: {required:true},
            namafile:{
                required: true,
                accept: "audio/wav",
                remote: {
                    url: window.location.protocol + "//" + window.location.host + "/sndv",
                    type: "post",
                    data:  {
                        'tmpnm': azzz,
                        '_token': token
                    }
                }
            },
            i_type:{"required":true},
            e_type:{"required":true}
        },
        messages:{
            namafile:{remote: "this file is already uploaded"}
        },
        errorElement:'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                focusCleanup: true;
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('button[type=submit]').prop('disabled',true);
            form.submit();
        }
    });
    $("#addImages").validate({
        rules:{
            credit: {required:true},
            namafile:{required:true}
        },
        messages:{
        },
        errorElement:'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                focusCleanup: true;
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('button[type=submit]').prop('disabled',true);
            form.submit();
        }
    });
    $("#formCons").validate({
        rules:{
            consStat:{"required":true},
            'consAuth_id':{"required":true},
            'consStat_id':{"required":true},
            'consAuth_en':{"required":true},
            'consStat_en':{"required":true},
        },
        messages:{
        },
        errorElement:'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                focusCleanup: true;
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('button[type=submit]').prop('disabled',true);
            form.submit();
        }
    });
    // $("#formDist").validate({
    //     rules: {
    //         lbl: {required: true},
    //         obs: {required: true},
    //         'desc_id': {required: true},
    //         'desc_en': {required: true},
    //         lat:{required: true, cekfloat: true},
    //         lon:{required: true, cekfloat: true}
    //     },
    //     messages: {
    //         lbl: {},
    //         obs: {},
    //         'desc_id': {},
    //         'desc_en': {},
    //         lat: {cekfloat: "must be float/double value (ex: -2.321)"},
    //         lon: {cekfloat: "must be float/double value (ex: 162.122)"}
    //     }
    //     ,
    //     errorElement:'div',
    //     errorPlacement: function(error, element) {
    //         var placement = $(element).data('error');
    //         if (placement) {
    //             focusCleanup: true;
    //             $(placement).append(error)
    //         } else {
    //             error.insertAfter(element);
    //         }
    //     },
    //     submitHandler: function(form) {
    //         $('button[type=submit]').prop('disabled',true);
    //         form.submit();
    //     }
    // });
    
    // var g = $('#lblLevel').val();  //for level
    // if (g==2) {
    //   $('input#test2').attr("checked", "checked");
    // }else{
    //   $('input#test1').attr("checked", "checked");
    // };

    $.validator.addMethod("usercek", function(value) {
        return /^[-]*[A-Za-z0-9\s\d][-A-Za-z0-9\s\d]*$/.test(value) // consists of only these
    });
    $.validator.addMethod("tags", function(value) {
        return /^[A-Za-z0-9,\s\d]*$/.test(value) // consists of only these
        // && /[a-z]/.test(value) // has a lowercase letter
    });
    $.validator.addMethod("deskripsi", function(value) {
        return /^[-+()\/.,"'!$]*[A-Za-z0-9\s\d][-+()\/.,"'!$A-Za-z0-9\s\d]*$/.test(value) // consists of only these
        // && /[a-z]/.test(value) // has a lowercase letter
    });
    $.validator.addMethod("idcek", function(value) {
        return /^[A-Za-z0-9\d]*$/.test(value) // consists of only these
        // && /[a-z]/.test(value) // has a lowercase letter
    });
    $.validator.addMethod("pwcheck", function(value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
    });

});