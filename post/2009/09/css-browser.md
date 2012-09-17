# 浏览器辨识CSS

- date: 2009-09-29

--------------------------


最近在做项目的时候常关注浏览器兼容性的问题，浏览器对CSS的渲染也各有不同，所以同一个CSS属性在不同浏览器的效果可能会不同，那么可以对不同的浏览器使用不同的CSS属性。

还好各种浏览器都有特殊的识别符，尤其是IE。




1. CSS后面的优先级比前面的高


2. !important表示重要性，如果同时设置两个值的话那么!important的优先级较高


3. 标准浏览器都支持!important，但不支持*和_


4. ie6支持*，还有特有的_


5. ie7支持*，同时也支持!important




### IE6不支持!important




<span style="color: #ff0000;"><span style="color: #000000;">.pro1 {</span></span><span style="color: #ff0000;"><span style="color: #000000;">
background-color:red<span style="color: #ff0000;">!important</span>;
   background-color:green;
}
</span></span>


IE6能够解析上面两条，但是忽略了!important，所以第一条并没有优先级，只是按照顺序解析，最终会显示绿色。


### 区分IE6和Firefox




<span style="color: #ff0000;"><span style="color: #000000;">.pro2 {
    background-color:red<span style="color: #ff0000;">!important</span>;
    background-color:green;
}
</span></span>


IE6如上面所说，会显示绿色；而firefox能识别!important，第一条的优先级会比较高，那么firefox下会显示红色。

第二条也可以在前面加上*和_，因为firefox无法识别，那么不加!important也能区分IE6和firefox，如


<span style="color: #ff0000;"><span style="color: #000000;">.pro2 {
    background-color:red;
    _background-color:green;
}</span></span>




### 区分IE7和Firefox




<span style="color: #ff0000;"><span style="color: #000000;">.pro3 {
    background-color:red;
    *background-color:green;
}
</span></span>


IE7能识别*，而firefox不能，所以两者还是很好区分的，但要注意顺序。IE7会显示绿色，firefox会显示红色。


### 区分IE6和IE7




<span style="color: #ff0000;"><span style="color: #000000;">.pro4 {
    background-color:green;
    _background-color:red;
}</span></span>


_是IE6的特殊属性，所以IE7只能识别第一条显示绿色，IE6两条都能识别显示为红色。



### 区分IE6，Firefox和IE7




<span style="color: #ff0000;"><span style="color: #000000;">.pro5{
    background-color:blue;
    *background-color:green<span style="color: #ff0000;">!important</span>;
    *background-color:red;
}</span></span>


首先第一条区分开firefox，firefox不能识别*，所以显示为蓝色；IE7能识别!important，所以显示为绿色；IE6都能识别，所以按照顺序显示红色。这里同样可以用_来区分IE6和IE7。



