
    

    function changeZipcode(entity)
    {
        //alert($("#ilist_frontendbundle_ad_zipcode").val());
        
        var zipcode = $("#ilist_frontendbundle_" + entity + "_zipcode").val();
        zipcode = zipcode.slice(0,5) + zipcode.slice(6,9);

        var url = 'http://cep.correiocontrol.com.br/' + zipcode + '.json';
        
        var jqxhr = $.getJSON( url, {
    		format: "json"
  		})
	    .done(function( data ) {
			$.each( data, function( key, item ) {
		        
		        switch(key)
				{
					case "uf":
					  $('#ilist_frontendbundle_' +  entity + '_state').find('option[value=' + item+ ']').attr('selected',true);
					  break;
					case "localidade":
						$('#ilist_frontendbundle_' + entity + '_city').val(item);
						break;
					case "logradouro":
						$('#ilist_frontendbundle_' + entity + '_street').val(item);
						break;
					case "bairro":
						$('#ilist_frontendbundle_' + entity + '_neighbourhood').val(item);
						break;		
				}

		    });

	    })
	    .error(function (data) { 
	    	$('#ilist_frontendbundle_' + entity + '_city').val("");
	    	$('#ilist_frontendbundle_' + entity + '_state').find('option[value=""]').attr('selected',true);
	    	$('#ilist_frontendbundle_' + entity + '_street').val("");
	    	$('#ilist_frontendbundle_' + entity + '_neighbourhood').val("");
	    	$("#ilist_frontendbundle_" + entity + "_zipcode_error").show().html("<p class='alert-text'>CEP não encontrado!</p>");

		});

    }
