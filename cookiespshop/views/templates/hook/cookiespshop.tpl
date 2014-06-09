<!-- cookieshop module -->
<div id="cookie-message">

 {if isset($showMessage) && $showMessage==0}
<div class="alert alert-success alert-dismissable" >
<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
 {l s='En cumplimiento con la Ley Ley 34/2002, de servicios de la sociedad de la información te recordamos que al navegar por este sitio estás aceptando el uso de cookies.' mod='cookiepshop'}
<a href="javascript:void(0)" onclick="showModal()">{l s='Más Información' mod='cookieshop'}</a><br/><br/>
<a href="javascript:void(0)" onclick="setCook()" class="btn btn-success">No Volver a Mostrar</a>



</div>
{/if}
<!-- Current Policy-->
<div class="modal fade" id="cookiemodal" style="display:none">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" onclick="RemoveModal()" style="margin-right: 5%;color:white;" >&times;</button>
        <h4 class="modal-title" style="color:white;">{l s='Politica de Cookies' mod='cookiepshop'}</h4>
      </div>
      <div class="modal-body" style="color:white;margin:0 10%;text-align: justify;">
      	{$ckpshop_politica|unescape:'html'}
      	
      </div>
    </div>
  </div>
</div>
</div>
<!-- end cookieshop module -->