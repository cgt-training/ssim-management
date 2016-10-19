$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
$(document).ready(function(){
	 $('.modalButton').click(function(){

		$('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
		

	});
});
$('body').on('beforeSubmit','form#form_dev', function(e) {
    //alert();
   var form = $(this);
   
   if(form.find('.has-error').length)
   {
   	return false;
   }
   $.ajax({
   	url:form.attr('action'),
   	type:"POST",
   	data:form.serialize(),
   	success:function(res)
   	{
   		if(res.status==true)
   		{
   			//form.find('input,select').val('');
   			//$('#modalContent').load('view/'+res.id);
   			//$('#main-content').prepend('<div class="alert alert-success" role="alert" style="display: none"><p>Company Created Successfully</p></div>');
   			
          
   			$('#main-content').load('view/'+res.id);
   		}
   		else
   		{
   			$(".alert").toggleClass('alert-success', 'alert-danger');
   			$('.alert').html('Error in creating company');
   			$('.alert').css('display','block');
   		}
   	}
   });
   return false;
});

$('a.delete-request').on('click',function(e){
	   e.preventDefault();
        var el = jQuery(this);
        bootbox.confirm({
            message: "Are you sure you want to delete this item?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.get(el.attr('href'), {}, function(response) {
                        if (response.status == true) {
                            bootbox.alert({
                                message: "Item deleted",
                                className: 'bootbox-success',
                                backdrop: true
                            });
                            pjax_container = jQuery('div[data-pjax-container]').attr('id');
                            jQuery.pjax.reload({ container: '#' + pjax_container });
                        }
                    });
                }
            }
        });

});


 var handleViewLoad = function(e) {
        e.preventDefault();
        var el = jQuery(this);

        jQuery.get(el.attr('href'), {}, function(response) {
            jQuery('div#main-content').html(response);
            lateBinding();
        });
    }

 var lateBinding = function() {

jQuery('a.update-company').on('click',handleViewLoad);
    }

jQuery('table').on('click', 'a[title]', handleViewLoad);
lateBinding();