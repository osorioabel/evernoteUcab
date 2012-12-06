/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
	$("#contactForm").validate({
		rules: {
			username_login: "required",
			password_login: "required",
                        tituloBook:{
                            required:true,
                            minlength:2,
                            maxlength:25
                        },
                        tittleNote:{
                            required:true,
                            minlength:2,
                            maxlength:25
                        },
                        descrip:{
                            required:true,
                            minlength:10,
                            maxlength:500
                        },
                         Note:{
                            required:true,
                            minlength:5,
                            maxlength:500
                        }
                        
                        
			
		},
		messages: {
			username_login: "Please enter your username",
			password_login: "Please enter your Password",
                        tituloBook:{
                             required:"tittle required",  
                             minlength:"enter at least 2 characters",
                             maxlength:"enter less than 25 characters"
                        },
                        tittleNote:{
                             required:"tittle required",  
                             minlength:"enter at least 2 characters",
                             maxlength:"enter less than 25 characters"
                        },
                        descrip:{
                             required:"Description required",  
                             minlength:"enter at least 10 characters",
                             maxlength:"enter less than 500 characters"
                        },
                        Note:{
                             required:"Content required",  
                             minlength:"enter at least 5 characters",
                             maxlength:"enter less than 500 characters"
                        }
                        
		}
	});
			
});


$(document).ready(function(){
    $("#sc-modify-form").validate({
        rules: {
            name_modify: {
                required: true, 
                minlength: 2
            },
            lastname_modify: {
                required: true, 
                minlength: 2
            },
            email_modify: {
                email: true
            }
			
        },
        messages: {
            name_modify:{  
                required:"name required",  
                minlength:"enter at least 2 characters"  
            },  
            lastname_modify:{  
                required:"lastname require",  
                minlength:"enter at least 2 characters"  
            } , 
            email_modify:
            {  
                email :"invalid email" 
            }
        }
    });
			
});