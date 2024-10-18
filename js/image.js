$(function(){
$('.previewPane, #zoomer').css('background-image','url('+$('.imgkey').first().attr('src')+')');
$('.imgkey').click(function(){
$('.previewPane').css('background-image','url('+$(this).attr('src')+')');
			});
$('.previewPane').mousemove(function(ev){
$('#zoomer').css('display','inline-block');
var img = $(this).css('background-image').replace(/^url\(['"](.+)['"]\)/, '$1');
var posX = ev.offsetX ? (ev.offsetX) : ev.pageX - $(this).offset().left;
var posY = ev.offsetY ? (ev.offsetY) : ev.pageY - $(this).offset().top;
$('#zoomer').css('background-position',((-posX * 3) + "px " + (-posY * 3) + "px"));
$('#zoomer').css('background-image','url('+img+')');
			});
$('.previewPane').mouseleave(function(){$('#zoomer').css('display','none');});
		});