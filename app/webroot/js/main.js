$(document).ready(function() {
    $(".colorbox").corner();
    $('label').labelOver('label-over'); 
    $("a.modal").colorbox({opacity:0.55,scrolling:false});
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
