function ajaxCallFunction(keyobj) {
	var ajaxType = keyobj.type;
    var ajaxData = keyobj.ajaxData;
    //ajaxData['jwtToken'] = document.cookie.replace("jwttoken=","")
	try {
		return $.ajax({
			type: ajaxType,
			url: keyobj.url,
			data: ajaxData,
           // xhrFields: { withCredentials: true },
            cache: false,
			dataType: keyobj.dataType,
			beforeSend: function() {

			},
			success: function(response){
				try
				{
					keyobj.callback(response,keyobj);
				} catch (e){
					console.log(e);
				}
			},
			error: function(error){
				console.log("failure---> error from ajax" + error);
				var res =JSON.stringify({ status: 0,message :"error from ajax"});
				keyobj.callback(res);
			},
            complete: function(data) {
             //alert("hiiii")      
            }
		});
	} catch (e) {
		console.log(e)
	}
}

function onlynumberValidation(evt) {

         var charCode = (evt.which) ? evt.which : event.keyCode;
         //console.log(charCode);
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
           return false;
         }
            

         return true;
}

function onlyalphabetValidation(e) {

	var regex = new RegExp("^[a-zA-Z \b]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);   
    var keystobepassedout="ArrowLeftArrowRightDeleteBackspaceTab";
    if(keystobepassedout.indexOf(e.key)!=-1)
    {
      return true;
    }
    if (!regex.test(key)) {
    	e.preventDefault();
        return false;
    }
}

function emailValidation(email) {
    //var mailformat =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var mailformat =/\b[a-zA-Z0-9\u00C0-\u017F._%+-]+@[a-zA-Z0-9\u00C0-\u017F.-]+\.[a-zA-Z]{2,}\b/;
    //var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
	if (email == '') {
		return 0;
	} else {
		if(email.match(mailformat)){
			return 1;
		}
		else{
			return -1;
		}
	}
	
}