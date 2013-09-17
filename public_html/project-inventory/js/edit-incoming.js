$(document).ready(function(){
	$('#view-incoming tr').on("click",function(){
		var url = 'edit-incoming.php';
		var form = $('<form class="hidden" id="hform" action="' + url + '" method="post">' +
		'<input type="text" name="uid" value="' + $(this).attr("uid") + '" />' +
		'</form>');
		$('body').append(form);
		$("#hform").submit();
	});
});