/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// extend the current rules with new groovy ones
	
// this one requires the text "buga", we define a default message, too
$.validator.addMethod("buga", function(value) {
    return value == "buga";
}, 'Please enter "buga"!');
	
// this one requires the value to be the same as the first parameter
$.validator.methods.equal = function(value, element, param) {
    return value == param;
};
	

$(document).ready(function(){
    $("#sc-contact-form").validate({
        
        
        rules: {
            name_signup:{
                required: true, 
                minlength: 2
            },
            lastname_signup: {
                required: true, 
                minlength: 2
            },
            username_signup: {
                required: true, 
                minlength: 2
            },
            email_signup: {
                required: true, 
                email: true
            },
            pass_signup: {
                required: true, 
                minlength: 6,
                maxlength: 12
            },
            repass_signup:{
                required: true,
                minlength: 6,
                maxlength: 12,
                equalTo:"#pass_signup"
            }
           
			
        },
        messages: {
            name_signup:{  
                required:"name required",  
                minlength:"enter at least 2 characters"  
            },  
            lastname_signup: {  
                required:"name required",  
                minlength:"enter at least 2 characters"  
            },
            username_signup:{  
                required:"username require",  
                minlength:"enter at least 3 characters"  
            },  
            email_signup:
            {  
                required:"Email require",  
                email :"invalid email" 
            },
            pass_signup:
            {
                required:"password required ",  
                minlength:"enter at least 6 characters", 
                maxlength:"enter at top 12 characters"
            },
            repass_signup:
            {
                required:"password required",  
                equalTo:" Passwords Missmatch"
            }   
            
        
        }
        
        
        
        
    });
	
        
        
});
