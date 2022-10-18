$(document).ready(function() {

	//if submit button is clicked
	$('#boton').click(function () {		
		//Get the data from all the fields
		var name = $('input[name=name]');
		var mail = $('input[name=mail]');
		var phone = $('input[name=phone]');
		var message = $('textarea[name=message]');

		//Simple validation to make sure user entered something
		//If error found, add hightlight class to the text field
		if (name.val()=='') {
			name.addClass('hightlight');
			return false;
		} else name.removeClass('hightlight');
		
		if (mail.val()=='') {
			mail.addClass('hightlight');
			return false;
		} else mail.removeClass('hightlight');
		
		if (message.val()=='') {
			message.addClass('hightlight');
			return false;
		} else message.removeClass('hightlight');
		
		//organize the data properly
		var data = 'name=' + name.val() + '&mail=' + mail.val() + '&phone=' + 
		phone.val() + '&message='  + encodeURIComponent(message.val());
		
		//disabled all the text fields
		$('.text').attr('disabled','true');
		
		//show the loading sign
		$('.loading').show();
		
		//start the ajax
		$.ajax({
			//this is the php file that processes the data and send mail
			//colocar el archivo php, para ser verificado
			url: "enviar.php",	
			
			//GET method is used
			type: "get",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {				
				//if process.php returned 1/true (send mail success)
				if (html==1) {					
					//hide the form
					$('.form').fadeOut('slow');					
					
					//show the success message
					$('.done').fadeIn('slow');
					
				//if process.php returned 0/false (send mail failed)
				} else 
					alert('Gracias por contactarnos, tendrás pronto una respuesta.');
					location.reload();
					document.location.reload();
			}		
		});		
		//cancel the submit button default behaviours
		return false;
	});	
});	