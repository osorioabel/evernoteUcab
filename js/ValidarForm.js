/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
	$("#contactForm").validate({
		rules: {
			username_login: "required",
			password_login: "required"
			
		},
		messages: {
			username_login: "Please enter your username",
			password_login: "Please enter your Password"
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