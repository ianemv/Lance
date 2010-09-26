$(document).ready(function() {
    $("a.modal").click(function(e) {
        e.preventDefault();
        $('#modal-content').load($(this).attr('href'));
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
        $('#mask').css({'width':maskWidth,'height':maskHeight});
        $('#mask').fadeTo(500,0.85);
        var winH = $(window).height();
        var winW = $(window).width();
        $("#modal").css('top', winH/2-$("#modal").height()/2)
        $("#modal").css('left', winW/2-$("#modal").width()/2);
        $("#modal").fadeIn(2000);
    });
    $('#modal-close').click(function() {
        $("#mask").hide();
        $(".modal-container").hide();
    });
});

jQuery.fn.labelOver = function(overClass) {
	return this.each(function(){
		var label = jQuery(this);
		var f = label.attr('for');
		if (f) {
			var input = jQuery('#' + f);
			
			this.hide = function() {
			  label.css({ textIndent: -10000 })
			}
			
			this.show = function() {
			  if (input.val() == '') label.css({ textIndent: 0 })
			}

			// handlers
			input.focus(this.hide);
			input.blur(this.show);
		  label.addClass(overClass).click(function(){ input.focus();});
			if (input.val() != '') this.hide(); 
		}
	});
}

function messageHint(m) {
    var msg = $("#message_hint").html(m);
    $("#message_hint").slideDown(200, function() {
        setTimeout(function() {
            $("#message_hint").slideUp(500);
        }, 6000);
    });
    $('.remove-btn').click(function() {
        $("#message_hint").slideUp(500);
        return false;
    });
}
