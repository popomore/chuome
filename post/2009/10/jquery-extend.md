# jquery扩展

- date: 2009-10-12

--------------------------


使用jquery已经有一段时间了，其强大的选择器使人感觉简单易用，不过本文并不是要写如果使用选择器，而是关于jquery的扩展性。jquery的扩展性做的很好，因为jquery是重新定义了一个对象，是对Element对象的一个封装，所以所有的扩展都是对jquery对象的扩展。jquery定义了扩展的接口，使爱好者很方便的开发插件，很多插件可以到[官网下到](http://plugins.jquery.com/)。

jquery有两个扩展接口，分别是jQuery.fn.extend和jQuery.extend，jquery本身很多方法也是靠这两个接口实现的。jQuery.fn.extend是扩展jquery实例，也就是将element对象封装后所拥有的方法。而jQuery.extend是扩展jquery对象本身，按面向对象来说就是扩展类的静态方法。

摘自jquery的代码

[cc]
jQuery.fn.extend({    
//2894行，扩展所有事件    
bind: function( type, data, fn ) {        
return type == "unload"
? this.one(type, data, fn)
: this.each(function(){            
jQuery.event.add( this, type, fn || data, fn && data );        
});    
},    
one: function( type, data, fn ) {        
var one = jQuery.event.proxy( fn || data, function(event) {            
jQuery(this).unbind(event, one);            
return (fn || data).apply( this, arguments );        
});        
return this.each(function(){            
jQuery.event.add( this, type, one, fn && data);        
});    
},    
......
});
[/cc]

[cc]
jQuery.extend({  
//3018行，扩展load事件
isReady: false,
readyList: [], // Handle when the DOM is ready
ready: function() { // Make sure that the DOM is not already loaded
if ( !jQuery.isReady ) {
// Remember that the DOM is ready
jQuery.isReady = true;
// If there are functions bound, to execute
if ( jQuery.readyList ) {
// Execute all of them
jQuery.each( jQuery.readyList, function(){
this.call( document, jQuery );
});
// Reset the list of functions
jQuery.readyList = null;
}
// Trigger any bound ready events
jQuery(document).triggerHandler("ready");
}
}
});
[/cc]

在此基础上我也写了一个[小扩展](http://dl.getdropbox.com/u/358534/jsdemo/lib/suggestText.js)作为练习，这个扩展的功能是在文本表单的框内显示提示信息，当输入文本时提示信息为空，当内容为空时显示提示信息。

这个扩展同样由两种方式实现，如$('.info').suggestText()只有class为info的才有这个功能，如$.suggestText()使所有的文本表单都具有这个功能。

