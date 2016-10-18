$('#form-signup').on('submit',function(e){
	e.preventDefault();
	var form = $(this);

	$.ajax({
   	url:form.attr('action'),
   	type:"POST",
   	data:form.serialize(),
   	async:false,
   	success:function(res)
   	{

   		if(res.status==true)
   		{
   			form.find('input,select').val('');
   			//$('#modalContent').load('view/'+res.id);
   			$('#main-content').prepend('<div class="alert alert-success" role="alert" style="display: block"><p>User Signup Successfully</p></div>');
   			// $('#modal').modal('hide');
   			// $('body').removeClass('modal-open');
   			// $('.modal-backdrop').remove();
   			// $('#main-content').load('company/view/'+res.id);
   			
   		}
   		else
   		{
   			$('#main-content').prepend('<div class="alert alert-danger" role="alert" style="display: block"><p>User Signup Failed!!!!</p></div>');
   			// $(".alert").toggleClass('alert-success', 'alert-danger');
   			// $('.alert').html('Error in creating company');
   			// $('.alert').css('display','block');
   		}
   	}
   });
});
 

function fill_data()
{
	var zip_code = $('#customer-zip_code').val();
	$.ajax({
		type: "POST",
		url:  "getlocation",
		data: {zip_code: zip_code},
		success:function(res)
		{
			var data = res.split("+");
			$('#city').val(data[0]);
			$('#provience').val(data[1]);
		}
	});
}