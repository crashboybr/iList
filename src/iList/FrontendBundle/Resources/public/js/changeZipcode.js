
    

    function changeZipcode(entity)
    {
        //alert($("#ilist_frontendbundle_ad_zipcode").val());
        

        var url = 'http://cep.correiocontrol.com.br/' + $("#ilist_frontendbundle_" + entity + "_zipcode").val() + '.json';

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

	    });

    }
