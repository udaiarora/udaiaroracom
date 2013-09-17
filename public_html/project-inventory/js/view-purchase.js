$(document).ready(function(){
	$('#view-incoming tr').on("click",function(){
		var url = 'view-purchase-full.php';
		var form = $('<form class="hidden" id="hform" action="' + url + '" method="post">' +
		'<input type="text" name="uid" value="' + $(this).attr("uid") + '" />' +
		'<input type="text" name="tt" value="' + $(this).attr("tt") + '" />' +
		'<input type="text" name="t" value="' + $(this).attr("t") + '" />' +
		'</form>');
		$('body').append(form);
		$("#hform").submit();
	});
});