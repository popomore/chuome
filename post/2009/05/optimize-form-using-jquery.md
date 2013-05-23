# 使用JQuery优化表单

- pubdate: 2009-05-14

--------------------------


好久没写关于JS的东西了，今天该了一个表单正好放上。表单是网页中最常见的要素，HTML中存在的基本标签则略显简单，想要做到既美观又好用则需要适当的加工。


### 隐藏式表单


这是现在比较常见的一种方式，在flickr的内容编辑时就采用了这种方式。最初以文本的形式呈现，单击后文本由表单代替，这是为编辑状态，保存后恢复成文本状态，内容被更新。这是一种很好的利于用户体验的方式，操作比较明了，

先写好HTML标签，span中为文本，input为表单，所以先要把input隐藏。


<span class="input_text">
    <span>text</span>
    <input style="display:none" type="text" />
    <input style="display:none" type="button" value="ok" />
</span>


接下来是一段JS


$(function(){
  //当点击文本时触发事件
  $('.input_text span').click(function(){
        //隐藏文本，显示表单
$(this).parent().children().toggle();
        //将文本的值添加到表单中
$(this).next().attr('value',$(this).text());
  });
  //当点击OK是触发事件
  $('.input_text :button').click(function(){
var value = $(this).prev().attr('value');
if(value!=''){
                //当在表单中输入值是才负值，否则保持原始值
$(this).prevAll('span').text(value);
}
$(this).parent().children().toggle();
  });

});


看起来很简单易懂的吧，看一下[例子](http://dl.getdropbox.com/u/358534/jsdemo/input_text.html)就更明白了。


### 文本表单的提示


有时在文本表单中会需要提示信息，告诉用户这里应该填写什么。但这种信息又不能太显眼，他们不是关键信息，所以在用户已经知道或者不需要他们的时候就把他们隐藏

HTML标签就是普通表单标签，再加上一个class，这个样式是为了让表单中的内容呈现灰色。


<input class="text" type="text" />


再来看JS


$(function(){
//给所有的表单添加提示信息
 $('.text').attr('value',inputdefault);
  $('.text').click(function(){
//点击表单后，去除提示信息，并去掉样式
var value = $(this).attr('value');
$(this).removeClass('text');
if(value==inputdefault){
$(this).attr('value','');
}
});




$('.text').blur(function(){
//表单失去焦点后，如果表单内容为空则还原默认信息
var value = $(this).attr('value');
if(value==''){
$(this).addClass('text');
$(this).attr('value',inputdefault);
}
});




});


例子在这里

其实这只是小试牛刀，HTML4的表单很简单，所以对他进行不同程度的换装才能更易用。
