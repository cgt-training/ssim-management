$(document).ready(function(){
	 $('#modalButton').click(function(){

		$('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
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