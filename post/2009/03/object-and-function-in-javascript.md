# Object和Function

- date: 2009-03-31

--------------------------


> Object是对象但也是一个函数，Function是函数但也是一个对象。


Javascript中这两者是很容易混淆的，一般都这么认为，Object是一个对象，而Function是一个函数，但这种认识是有偏差的。

Function和Object都是内置的函数，他们都是由Function构造器生成的。Object同样是一个函数


typeof Object =='function' //true
<span class="objectBox objectBox-text">Object instanceof Function //ture</span>


上面说明Object的类型是一个函数，并且Object的隐式Prototype链是指向Function的（[instanceof的用法](http://blog.csdn.net/nksongzz/archive/2008/06/25/2585196.aspx)）。

Function则比较复杂，Function本身来说是一个函数，他具有prototype属性，而且他还有隐式的Prototype链，指向Object.prototype。这说明Function同时也是一个对象，那么继承自Function的函数同时也是对象。


typeof Function =='function' //false
<span class="objectBox objectBox-text">Function instanceof Object //ture</span>


因 为所有的函数都是由Function构造的，他们的隐式Prototype链都指向Function.prototype。而Function函数又是由 本身构造的，所以Function.prototype还是指向Function本身。即是说所有的函数的隐式Prototype链都指向 Function本身，所以函数能用到Function的方法。

而所有的对象，不管是由Object构造的还是自定义函数构造的，最终都指向Object.prototype，而这个值为空，所以像一些重写了Object的框架中并不能继承Object的属性。

先写这么多，说的比较抽象，如果完全不懂先看看[这篇文章](http://www.cnblogs.com/RicCC/archive/2008/02/15/javascript-object-model-execution-model.html)，很详细。
