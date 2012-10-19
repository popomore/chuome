# 为什么用getElementById

- date: 2009-03-13

--------------------------


昨天吃饭的时候，师弟问我为什么很多地方都用document.getElementById()，看其他人层级访问很牛。这个问题我也一时没答上来，只是漫无边际的扯东扯西。其实我两年前也是这么觉得，当时对于DOM则一点概念都没有，只知道这个名词，然后去网上抄代码就一直用document.getElementById()，（js都是从抄开始的）。

想想这么些时间用下来也并不觉得层级访问很牛了，只要对照DOM的文档很方便的就能使用。那么对于这两种方式，到底哪一种更好更便于使用呢？其实两者是互补的，他们各有长处。

getElementById()是ppk所说的众多钩子中的一个，是结构和行为的连接纽带。没一个HTML标签都能定义一个ID，而且这个ID一个文件中是唯一的，那么使用getElementById()方法时就能很快速的获得该对象，而不需要去循环所有的标签。getElementById()很神奇，用这个方法返回的是Element接口，但会根据标签返回相应的HTML对象。如果该ID对应的是一个下拉列表，那么返回的是一个Select对象；如果对应的是一个表格，则返回一个table对象。所以这个方法比较全能，也是大家都去用的原因。

如果你知道一个标签对象，要去获取他，那么就不应该使用层级访问。如果这个标签嵌套着七八个或者更多的div，那么你需要一直调用firstChild方法，而且很容易多一个或者少一个。如果把这段代码给别人看或者自己回过头来看看，估计都无法理解，可读性很差。

层级访问用于小区域或者是微格式中是很好用的，尤其是想改变顺序或者是层次结构。比如一段评论的HTML结构：



<div class="comment">
<h3>name</h3>
<p>content</p>
</div>


如果想获取评论的人名


var comment = 获取对象
var name = comment.firstChild().nodeValue;


如果想将人名放在内容的后面


var comment = 获取对象
var name = comment.childNodes[0];
var content =comment.childNodes[1];
comment.insertBefore(content,name);


但是层级访问的前提需要有良好的HTML结构，这就是一直在谈论的结构表现行为分离。有一点前端开发经验的会很清楚这样的做的必要性，我在这就不说了。

还有一个方法getElementsByTagName，这与getElementById()一样常用，但对js刚入门的人来说会很少用。这个方法主要用来批量处理标签，获得文档中所有的指定标签。如果我想提取所有的链接地址


var linklist = [];
var links = document.getElementsByTagName('a');
for( n in links){
    linklist.push(links[n].href);
}


最后凡事都有其优缺点，正确对待就好。如果需要快速定位则用到getElementById()，如果需要修改文档结构则用到层级结构，如果要批量修改则用到getElementsByTagName()。
