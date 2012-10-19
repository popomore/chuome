# input在strict

- date: 2009-10-26

--------------------------


今天师傅说起了button盒模型的bug，不管是在ie还是firefox下button的盒模型始终是传统模型，也就是width=content+padding+border，这个bug[在ff下可以修复但ie下还是无法修复](http://www.quirksmode.org/css/tests/mozie_button.html)。但本文说的bug不是这个，在尝试寻找这个bug的过程中发现了另一个问题。


### Firefox的bug


用div包着一个input的时候，input离容器的上边框总是会有一段距离，注意这里是firefox（IE存在其他问题，下文会介绍）。查看了下input的margin，border，padding都为0，那这是什么造成的呢。下图中蓝色边框为容器，绿色为容器的背景，红色为input的背景。

[![1](../../uploads/2009/10/1-300x34.png)](../../uploads/2009/10/1.png)

后来无意中发现使用的Doctype是`<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">`

更换成`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">`就没问题了。

第一个Doctype是strict的html4，促发的是Strict Mode，而第二个是transitional的xhtml1.0，促发的是Almost Strict Mode，那么这个问题就找到了。Firefox下Strict Mode会造成这个bug，而Almost Strict Mode则不会。但具体为什么会有这个bug，暂时还没有结果，如果遇到问题换个Doctype就能解决了。

[我是测试页面](http://dl.getdropbox.com/u/358534/jsdome/bug/input-strictmode.html)


### IE的bug


IE遇到的问题又有所不同，不管是Strict Mode还是Almost Strict Mode下，IE会离上下边框1像素的距离，同样可以点击上面的链接进行测试。
