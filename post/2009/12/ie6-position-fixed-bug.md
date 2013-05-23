# 纯CSS解决ie6下position:fixed问题

- pubdate: 2009-12-25

--------------------------


前不久做一个网页,需要做一个分页始终位于底部,不会因为窗口的缩放和滚动条的滚动而变化.那么一开始想到的肯定是_position:fixed_,只要设置这个CSS属性就能达到刚刚说的目的,但世界永远不是这么完美的,因为有IE6的存在.IE6不支持这个属性,所以问题就来了.


### 需要解决的问题






1. 当页面内容比较少时,分页也要位于底部,不会随着内容的多少而移动.这里设置absolute就能解决问题,但当有滚动条出现时分页确会随着移动,这就是要解决的第二个问题.


2. 当页面内容比较多时,会出现滚动条,当页面滚动时,分页也必须不会随着一起移动.


3. 窗口变化时也会影响到上面两个方面




### JS的解决方案


JS是我最不愿使用的解决方案,因为这种纯样式的bug用JS来解决有点大材小用,而且JS需要DOM载入后才执行,有可能会出现闪屏的现象.

JS的解决方案很简单,通过设置一个top来实现,top是指分页的上边距离document的上边的长度,可以被分解成下面几项(并不是完整的代码)


top = scrollTop + clientHeight - height(分页的高度)


![](http://www.developer.com/img/2007/06/Scroll05.jpg)

scrollTop和clientHeight分别用来解决上面两个问题,滚动条的滚动会影响到scrollTop,而窗口的变化会影响到clientHeight,所以当这两个事件被触发时必须重置top,于是就形成类似下面的代码,但这段脚本的刷新率会非常高,估计有性能问题.


window.onresize = window.onscroll = function(){
//reset top
};




### CSS Expression的解决方案


上面这段脚本可以直接搬到CSS上来,因为CSS支持expression,可以通过JS代码来实现,不用事件监听,具体就不多说了,但这个也存在性能问题.


top:expreesion(scrollTop + clientHeight - height);




### 纯CSS的解决方案


这里提供一种纯CSS的解决方案,其实也挺简单的,这里是[demo](http://dl.dropbox.com/u/358534/jsdome/bug/ie6-position-fixed.html).先贴些代码


<body>
<div id="container"></div>
<div id="bottom"></div>
</body>




html, body {
margin: 0;
padding: 0;
height: 100%;
width: 100%;
_overflow: hidden;
}

#container {
_width: 100%;
_height: 100%;
_overflow-y: scroll;
}

#bottom {
background-color: #0ff;
height: 30px;
width: 100%;
position: fixed;
bottom: 0;
z-index: 999;

/Applications /Library /Network /System /Users /Volumes /bin /cores /dev /etc /home /mach_kernel /net /private /sbin /tmp /usr /var ie6 fixed */
_position: absolute;
_bottom:-1px;
_right: 17px;
}


将要固定的bottom和容器container放在并列的位置,将html,body,container都设为100%,那么可以把container当成body来使,将html和body设成overflow:hidden,而让container滚动,这时当文本溢出时只是container内部滚动,而bottom是放在container的外部,不会受其影响.

问题已经解决了,但是由于bottom是盖在container上面的,所以也会盖住滚动条,设置一个right就能使各浏览器显示相同.

上面几种方案我之前都有用过,所以我建议大家纯样式问题最好不要动用JS,能用CSS解决的还是用CSS.
