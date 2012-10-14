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
