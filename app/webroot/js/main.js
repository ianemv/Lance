$(document).ready(function() {  
	$(".corner").corner();
    $(".colorbox").corner();
    $('.text label, .password label').labelOver('label-over'); 
    $("a.modal").colorbox({opacity:0.55,scrolling:false}); 
	$("a[rel='plazas']").colorbox({transition:"fade"}); 
	if ($.trim($("#message_hint").html()) != "") {
		messageHint($("#message_hint").html());
	}
	$(".vote_box .close").click(function() { 
		alert(id);
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

function showLogin(a,b) {  
    var marco = $("#plaza_"+a.id);   
    var plazaImg = $(marco).find('.plaza_img');
    var thumbRel = $(marco).find('.plaza_img img').attr('rel'); 
	if (b) {  
		$(marco).find("label").each(function() { 
			$(this).css({textIndent:0});
			$('#' + $(this).attr('for')).val(''); 
		})   
	   
		$(plazaImg).fadeIn('slow');
		$(marco).find(".vote_box").fadeOut(); 
		$(marco).find('.vote_bottom').show();
	} else {     
    	$(plazaImg).fadeOut();
        $(marco).find(".vote_box").blur(showLogin(a, true)).effect('slide', {direction:'up'}, 200).effect('transfer', {to: $(".plaza_thumb img[rel='"+thumbRel+"']")}, 500);
        $(marco).find('.vote_dialog').effect('bounce', {direction:'down'},200);
        $(marco).find('.vote_bottom').hide();
        $(".plaza_thum img[rel='"+thumbRel+"']").animate({opacity: 1.0}, 1000);   
	}
	return false;
}

function votePlaza(a) {  
    $.post("/votes/plaza", $("#form_"+a.id).serialize(), function(result) { 
        if (!result.success) {
            if (result.login) {
                showLogin(a);
            }
            messageHint(result.message);
        } else {  
            if (result.message) {
                messageHint(result.message);
            } 
		  	showLogin(a,true);
        }
    }, "json");
    return false;
}

function messageHint(m) {
    var msg = $("#message_hint").html(m);
    $("#message_hint").slideDown(500, function() {
        setTimeout(function() {
            $("#message_hint").slideUp(500);
        }, 6000);
    });
    $('.remove-btn').click(function() {
        $("#message_hint").slideUp(500);
        return false;
    });
}
