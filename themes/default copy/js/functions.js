// JavaScript Document
$(document).ready(function(){	
$("a.lightbox").fancybox();
$(".popular_post") .hide();
$(".popular_post:first") .show();
$(".nav_post ul li").click(function() {
$(".nav_post ul li").removeClass("active"); //Remove any "active" class
$(this).addClass("active");
 Cufon.refresh();//Add "active" class to selected tab
$(".popular_post").hide(); //Hide all tab content
var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
$(activeTab).fadeIn(); //Fade in the active content
return false;
});

$("#nav ul li ul") .prev() .addClass("dropdown");
$("#nav ul li a.dropdown") .append("<em>&nbsp;</em>");
$("#nav ul li ul li a.dropdown") .children("em") .remove();
Cufon.replace('h1',{hover:true});
Cufon.replace('h2',{hover:true});
Cufon.replace('h3',{hover:true});
Cufon.replace('h4',{hover:true});
Cufon.replace('.right_comment li a.btn_submit',{hover:true});
Cufon.replace('.nav_post  li a ',{hover:true});
Cufon.replace('#nav > ul >  li > a',{hover:true});
Cufon.replace('.nav_news li a',{hover:true});
$("#gallery_sec li").hover(function() {
$(this).css({'z-index' : '10'});
$(this).find('a').addClass("hover").stop()
.animate({
top: '-30px', 
left: '-30px'
}, 100);

} , function() {
$(this).css({'z-index' : '0'});
$(this).find('a').removeClass("hover").stop()
.animate({
marginTop: '0px', 
marginLeft: '0px', 
top: '0px', 
left: '0px'
}, 200);
});
$("#nav ul li ul li a.dropdown") .removeAttr("href");
$("#nav ul li ul li a.dropdown") .click (function () {
$(this) .toggleClass ("activebg") .next () .slideToggle ("normal");
});
//$("#nav ul li") .hover (function (){Cufon.refresh();});

$(".content_news") .hide();
$(".content_news:first") .show();
$(".nav_news ul li").click(function() {
$(".nav_news ul li").removeClass("active"); //Remove any "active" class
$(this).addClass("active");
 Cufon.refresh();//Add "active" class to selected tab
$(".content_news").hide(); //Hide all tab content
var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
$(activeTab).fadeIn(); //Fade in the active content
return false;
});



$("#nav  li ") .hover (function (){
$(this) .addClass ("hoveract") .children() .removeClass("hoveract");
	},function (){
		$(this) .removeClass ("hoveract");
		Cufon.refresh();	
	});

});
$(document) .ready (function(){
	$('#banner_images').cycle({
fx:     'fade',
delay:	5000,
timeout:  5000,
pager:"#pager"

});
	});