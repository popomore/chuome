# Javascript模仿面向对象—实例化

- date: 2009-10-23

--------------------------


刚碰javascript的时候觉得是一门很简单的语言，就算没学过也能很快上手，这也是开发者的意图吧。虽然这门语言很易用，但其内部结构是非常松散灵活的，无法用面向对象的方法来解释。但如何让习惯于使用java这样的面向对象语言的人来使用javascript呢，这个问题很好解决，因为js是无所不能的。

在java中我们可以用Class关键字来定义类，然后用new来构造一个实例，但js中并没有class关键字，那js是如何构造实例的呢。还记得function么，他可以定义函数，同时他也可以当作构造函数来用，通过new关键字来实例化出一个对象。


function Person(leg){
this.leg = leg;
this.run = function(){
//run by leg
  };
}


定义好构造函数后，就可以进行实例化了，实例化的过程与面向对象的思路是一样的，生成实例后就可以调用这个实例的属性和方法，我们可以将其与java做一个对照


class Person {
public String leg = null;

public void Person(leg) {
this.leg = leg;
}

public void run(){
//run by leg
}
}


这下看明白了吧，用使用面向对象的方式来写js也是非常简单的。但有人会问，如果我想定义私有属性和方法怎么办，比如这个有自己的隐私不想被人看到，小便的时候不想被人看到。这时，对于js来说相当麻烦，因为js没有private这个关键字，使得实现方法相当复杂，如果不太熟悉函数式编程的同学应该不会接触这些概念。这里面会用到闭包的概念，可以去[google上搜一下](http://www.google.cn/search?hl=zh-CN&client=firefox-a&rls=org.mozilla%3Azh-CN%3Aofficial&hs=ltZ&newwindow=1&q=%E9%97%AD%E5%8C%85+js&btnG=Google+%E6%90%9C%E7%B4%A2)。js对象中不管是属性还是方法是以key/value形式存在的，所以只要定义了一个值那么就能调用它。那怎么样把属性和方法隐藏起来不被调用呢，那么先来看一段js代码。


var Person = (function(){
var secret = 'himitsu';
var pee = function(){
//use xxx
};

return function(leg) {
this.leg = leg;
this.run = function(){
//run by leg
  };
this.talk = function(){
alert(secret);
};
};
})();


初看这段代码比较奇怪，函数怎么都没有函数名的，而且为什么还要返回一个函数。其实这段代码就是用到了闭包，Person最后指向的是return后的函数，也就是说Person最后得到的与之前的构造函数是一样的，只是中间过渡了一步。那为什么要有这个过渡呢？**(function(){...})()**这种写法也是很特殊的，是直接运行一个匿名函数，它的目的就是要定义一些私有的属性和方法，看到secret属性和pee方法是定义在外面那个函数的，而返回的函数再引用这些属性和方法。当这个运行完这个函数后，函数本身已经烟消云散了，只不过这些私有属性和方法被引用，一直存在缓存中。实例化后，这些私有属性和方法并没有真实的存在对象中，外部是引用不到的，只有内部的函数才能调用得到。对照一下java代码


class Person  {
...

private String secret = "himitsu";
private void pee (){
//use xxx
}
}


这是还有人会问，怎么没有静态方法，其实这个对于js来说很简单，因为所有的对象都能动态添加属性和方法，所以添加静态属性和方法就很简单了


Person.bone = '206';


这样就定义了一个静态属性，那么如果想把这个静态属性定义在构造函数中要怎么做呢？那也好办，只需修改一下返回的函数就可以了。


var Person = (function(){
var secret = 'himitsu'; //private attribute
var pee = function(){ //private method
//use xxx
};

var value = function(leg) {
this.leg = leg; //public attibute
this.run = function(){ //public method
//run by leg
  };
this.talk = function(){ //ref secret
alert(secret);
};
};

value.bone = '206'; //static attribute

return value;
})();


现在我可以来模拟各种面向对象的关键字了，final还没想到一个好的实现方法，虽然在这里解释半天的面向对象实现方式，但我不太推荐使用面向对象。js有非常好的原型系统，如果运用熟练绝对能达到期望。
