$(function () {
	$('#comment-form').hide();
	$('#comment-form-toggle').on('click', function(event){
		event.preventDefault();
		$('#comment-form').slideToggle('slow',function(){
			if($('#comment-form').is(":hidden")) {
				$('#comment-form-toggle').html('Comment');
				$('#comment-form-toggle').removeClass('fa-angle-up').removeClass('visitor-cancel-comment').addClass('fa-commenting');
                clearForm();
			}else{
				$('#comment-form-toggle').html('Cancel');
				$('#comment-form-toggle').removeClass('fa-commenting').addClass('fa-angle-up').addClass('visitor-cancel-comment');
			}
		});
	});
    if($("#comment-form-errors").length){
        $('#comment-form').show();
        $('#comment-form-toggle').html('Cancel');
        $('#comment-form-toggle').removeClass('fa-commenting').addClass('fa-angle-up');
    }
    
    function clearForm(){
        $('#visitor-name-input').val('');
        $('#visitor-email-input').val('');
        $('#visitor-message-input').val('');
    }
    
    $('.visitor-cancel-comment').on('click', function(event){
        $('#comment-form').hide();
    })

    $("#visitor-message-input").keyup(function(){
        $('#visitor-message-input').val($(this).val().substring(0,255));
        $("#visitor-message-count").text("Remaining characters: " + (255 - $(this).val().length));
    });
});