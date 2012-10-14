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
            username_signup: {
                required: true, 
                minlength: 2
            },
            email_signup: {
                required: false, 
                minlength: 2
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
            },
            dropboxmail_signup:{
                required: false, 
                email: true
            },
            dropboxpass_signup: {
                required: false
                
            }

			
        },
        messages: {
            username_signup:{  
                required:"username require",  
                minlength:"enter at least 3 characters"  
            },  
            email_signup:
            {  
                required:"required email",  
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
                required:"required email",  
                equalTo:" Passwords Missmatch"
            },    
            dropboxmail_signup:{  
                required:"email required ",  
                email :"invalid email" 
            },  
            dropboxpass_signup: {  
                required:"required  pass"
                
            }
        
        }
        
        
        
        
    });
	
        
        
});
