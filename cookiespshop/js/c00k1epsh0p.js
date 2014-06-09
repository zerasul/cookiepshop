function showModal()
  {
   $('#cookiemodal').css('display','');
   $('#cookiemodal').modal('show');  	
  }
  function RemoveModal()
  {
  	$('#cookiemodal').css('display','none');
   $('#cookiemodal').modal('hide');
  }
  function setCook(){
  	 $.cookie('showMessage','1',{expires:7});
     $('#cookie-message').css('display','none');
  }