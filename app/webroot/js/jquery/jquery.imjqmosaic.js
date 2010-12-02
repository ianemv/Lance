                                                                                                                /*
 * imJQMosaic: a jQuery plugin
 *
 * imJQMosaic is a simple jQuery plugin for creating mosaic effect on an image
 * using JavaScript. It also allows user to put menu links on top of tiles.
 *
 * For usage and examples, visit:
 * http://imanish.co.in/demo/imjqmosaic
 *
 * Licensed under the MIT:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright (c) 2009 iManish.co.in (http://imanish.co.in)
 *
 * @author   Manish Gupta (manish - dawt- msgupta -at- gmail -dawt- com)
 * @requires jQuery v1.2 or later
 * @version  0.1
 */

(function ($) {
  $.extend($, {
	  mosaicO: '',
	  imJQMosaic: function (imageoptions, menuoptions) {
	    var t = this; 
		var totalTile = 0;
 		var image = new Image();
 		image.src = imageoptions.image;
	    mosaicO = {
	      	image:image,
			target: imageoptions.target,
			frameWidth: imageoptions.frameWidth?parseInt(imageoptions.frameWidth):image.width,
			frameHeight: imageoptions.frameHeight?parseInt(imageoptions.frameHeight):image.height,
			imageOffsetX: 0,
	    	imageOffsetY: 0,
			numberOfTilesX: imageoptions.numberOfTilesX?parseInt(imageoptions.numberOfTilesX):-1,
			numberOfTilesY: imageoptions.numberOfTilesY?parseInt(imageoptions.numberOfTilesY):-1,
			tileMargin: imageoptions.tileMargin?parseInt(imageoptions.tileMargin):0,
			tileBorder: imageoptions.tileBorder?parseInt(imageoptions.tileBorder):0,
			tileBorderColor: imageoptions.tileBorderColor,
			tileBorderRadius: parseInt(imageoptions.tileBorderRadius),
			effect: imageoptions.effect?imageoptions.effect:'flash',
			effectIntensity:(imageoptions.effectIntensity && parseFloat(imageoptions.effectIntensity)<1)?imageoptions.effectIntensity:'show',		
			effectColor: imageoptions.effectColor?imageoptions.effectColor:'#fff',
			menuFont: (menuoptions && menuoptions.menuStyle && menuoptions.menuStyle.font)?menuoptions.menuStyle.font:'Lucida Grande',
			menuFontSize: (menuoptions && menuoptions.menuStyle && menuoptions.menuStyle.fontSize)?menuoptions.menuStyle.fontSize:'1.0em',
			menuBackground: (menuoptions && menuoptions.menuStyle && menuoptions.menuStyle.background)?menuoptions.menuStyle.background:'none',
			menuFontColor: (menuoptions && menuoptions.menuStyle && menuoptions.menuStyle.fontColor)?menuoptions.menuStyle.fontColor:'#000',
			menuEffect: (menuoptions && menuoptions.menuEffect)?menuoptions.menuEffect:'zoom',
			menuItems: (menuoptions && menuoptions.menu)?menuoptions.menu:'', 
			menuCallback: (menuoptions && menuoptions.menuCallback)?menuoptions.menuCallback:'',
			menuUrl: (menuoptions && menuoptions.menuUrl)?menuoptions.menuUrl:''
 		};	

	    if(mosaicO.numberOfTilesX==-1){mosaicO.numberOfTilesX=10}
	    t.renderMosaic();
		if(menuoptions)	t.renderMenu();
		t.postRender();
    },
    
    renderMosaic: function(){
		var t = this;
		var html = '\n\t<div id="imjqmosaic" style="'
		 + 'width:' + mosaicO.frameWidth + 'px;'
		 + 'height:' + mosaicO.frameHeight + 'px;'
		 + 'position:relative;clear:both;'
		 + '"></div>';$('#'+ mosaicO.target).append(html);
		 
		var cc = 0, tx, ty, stepX, stepY;
		var ix = mosaicO.frameWidth - (mosaicO.numberOfTilesX*2*(mosaicO.tileMargin + mosaicO.tileBorder));
		if (ix<0) {return false;} 
		   
		var iy = mosaicO.frameHeight - (mosaicO.numberOfTilesY*2*(mosaicO.tileMargin + mosaicO.tileBorder));
		if (iy<0) {return false;}

		tx = Math.floor(ix/mosaicO.numberOfTilesX);
		stepX = 3*(mosaicO.tileMargin + mosaicO.tileBorder) + tx;
		ty = tx;
		stepY = stepX;
       
		if(mosaicO.numberOfTilesY!=-1){
			ty = Math.floor(iy/mosaicO.numberOfTilesY);
			stepY = 3*(mosaicO.tileMargin + mosaicO.tileBorder) + ty;
		}
		
		for ( var y = mosaicO.imageOffsetY; y < mosaicO.frameHeight; y += stepY) {
			for ( var x = mosaicO.imageOffsetX; x < mosaicO.frameWidth; x += stepX) {
				cc++;
				var html_f = '';
				html_f += '\n\t\t<div id="imjqmosaic_tile_' + cc
				        + '" class="imjqmosaic_tile" style="background-position:' + (-1 * x)
						+ 'px ' + (-1 * y) + 'px;'
						+ '">\n\t\t<div class="e"></div>\n\t\t</div>\n';

				$('#'+mosaicO.target).find('#imjqmosaic').append(html_f);
			}
		}
		this.totalTile = cc; 
    },
    
    renderMenu: function(){ 
    	var t = this;   
  	   	var length = (mosaicO.menuUrl && mosaicO.menuItems.length<=0)?this.totalTile:mosaicO.menuItems.length;
    	for(i = 0;i<length;i++){
			if (typeof(mosaicO.menuItems[i])!='undefined') {
        		var tileNumber = mosaicO.menuItems[i].tileNumber;
	        	var title = mosaicO.menuItems[i].title;
	        	var href = mosaicO.menuItems[i].href;
	        	var alt = mosaicO.menuItems[i].alt;
				var class = mosaicO.menuItems[i].class;     
			} else {
			   	var tileNumber = i+1;
				var href = mosaicO.menuUrl + '/'+ tileNumber;	
				var alt = '';
				var class = ''; 
			} 
			
        	var html = '';      
        	var el = $('#'+mosaicO.target + ' #imjqmosaic #imjqmosaic_tile_' + tileNumber).find('.e');
        	if (typeof(href)!='undefined') el.attr('title',alt);
        	if(typeof(href)!='undefined') { 
				if (typeof(class)!='undefined') {
					class = 'class="'+ class + '" ';
				} else {
					class = '';
				}
				if (typeof(title)!='undefined') {
					html = '<a href="' + href + '" style="text-decoration:none;color:'+ mosaicO.menuFontColor +';font-family:'+ mosaicO.menuFont +';font-size:'+ mosaicO.menuFontSize +'" '+class+'>' + '</a>';   
					el.html(title).css({"opacity":"0.6","cursor":"pointer", "background":mosaicO.menuBackground}).wrap(html); 
				} else {    
					html = '\n\t\t\t\t<a href="' + href + '" '+ class +'>'+'</a>';
					el.wrap(html);
				}    
        	} else {  
        		el.html(title).css({"opacity":"0.6","background":mosaicO.menuBackground, "color":mosaicO.menuFontColor, "fontSize": mosaicO.menuFontSize, "fontFamily":mosaicO.menuFont});
        	}
        	
    	}
    },
    
    postRender: function(){
    	var t = this;
    	$('#'+mosaicO.target + ' #imjqmosaic .imjqmosaic_tile').hover(function(){
				if($(this).find('.e').html()==''){
	    			if(mosaicO.effect == 'flash'){
	    				$(this).find('.e').animate({"opacity": mosaicO.effectIntensity}, "fast").animate({"opacity": "0.0"}, "fast");
	    			} 
				} else {
	    			if(mosaicO.menuEffect == 'zoom'){
	    				$(this).find('.e').animate({"opacity": mosaicO.effectIntensity}, "fast").animate({"opacity": "0.6"}, "fast");
	    			}
				}
    			
			},function(){}
    	);
    }    
  });
})(jQuery);