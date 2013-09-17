$(document).ready(function(){

	$(".heading:first-child").append('<button class="btn" onClick="javascript: window.print();">Print</button>');

	$(".leftpane .menu-item").on("click",function(){
		var url=$(this).attr("to");
		window.location= url;
	});

	var i=2;

	$("#add-more").live("click",function(){
		
		$("#button-grp").remove();

		$("#purchase-form").append('<div id="item-added"><div class="control-group inline"><label class="control-label" for="inputEmail">Item</label><div class="controls"><input class="span3" placeholder="Item" name="item'+ i +'" id="item'+ i +'" type="text"></div></div><div class="control-group inline"><label class="control-label" for="inputEmail">Quantity</label><div class="controls"><input class="span2" placeholder="Quantity" name="quant'+ i +'" id="quant'+ i +'"  type="number" step="any" min="0">&nbsp;&nbsp;&nbsp;<input class="span2" placeholder="Units" name="qunit'+ i +'"  id="qunit'+ i +'"   type="text"></div></div><div class="control-group inline"><label class="control-label" for="inputEmail">Rate</label><div class="controls"><input class="span2" placeholder="Rate" name="rate'+ i +'" id="rate'+ i +'"   type="number" step="any" min="0"></div></div></div><div id="button-grp"><div class="control-group"><div class="controls"><a id="add-more" class="btn btn-large btn-warning">+</a></div></div><div class="control-group"><div class="controls"><button class="btn btn-large btn-success" type="submit">Submit</button></div></div></div>')
		i++;
	});


});



function confirmIncomingDelete()
{
	var agree=confirm("Are you sure you want to delete?");
	if (agree)
	{
	$("#edit-form").attr("action","delete-incoming.php");
	return true ;
	}
	else
	return false ;
}

function confirmOutgoingDelete()
{
	var agree=confirm("Are you sure you want to delete?");
	if (agree)
	{
	$("#edit-form").attr("action","delete-outgoing.php");
	return true ;
	}
	else
	return false ;
}