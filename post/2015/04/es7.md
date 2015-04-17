# ES7 的那些提案

- pubdate: 2015-04-18

---

TC39 三月份会议在巴黎举行了，这里很水的聊聊 [ES7 的相关提案](https://github.com/tc39/agendas/blob/master/2015/03.md)吧。

## [Class Properties](https://gist.github.com/jeffmo/054df782c05639da2adb)

ES6 的类其实并不支持属性，如果想初始化属性可以在 constructor。

```
class MyClass {
  constructor() {
    this.myProp = 42;
    console.log(this.myProp); // 42
  }
}
```

这个提案想提供初始化属性的定义

```
class MyClass {
  myProp = 42;

  constructor() {
    console.log(this.myProp); // 42
  }
}
```

## [Class decorators](https://github.com/wycats/javascript-decorators)

相信期待注解很久了吧，使用他来写路由是何等幸福。

```
@route('/index.html')
exports.home = function*(){
  this.body = 'hello world';
}
```

## [ReverseIterable](https://github.com/leebyron/ecmascript-reverse-iterable)

反向迭代器可支持以相反的顺序循环数据

在 ES6 中

```
for (let [i, v] of a.entries()) {
  doSomething(v, i);
}
```

而使用 `iterator.reverse()` 可反向循环

```
for (let [i, v] of a.entries().reverse()) {
  doSomething(v, i);
}
```

## [Additional Meta Properties for ES7](https://github.com/allenwb/ESideas/blob/master/ES7MetaProps.md)

除了 ES6 中定义的 Meta Property `new.target`，这里新增了一些函数相关的。

### function.callee

指向当前运行的函数，只能在函数中使用，类似之前的 `arguments.callee`

```
function func() {
  console.log(function.callee === func); // true
}
func();
```

### function.count

运行时函数参数的个数，只能在函数中使用。

```
function func() {
  console.log(function.count);
}
func(); // 0
func(1); // 1
func(1, 2); // 2
```

### function.arguments

运行时参数的数组，只能在函数中使用，每次都会新生成一个数组。

```
function func() {
  console.log(function.arguments);
}
func(); // []
func(1); // [1]
func(1, 2); // [1, 2]
```

### function.next

没看明白，自行理解

## [ECMAScript Function Bind Syntax](https://github.com/zenparsing/es-function-bind)

增加一种新的语法 `::` 可绑定函数和方法提取。

比如，你只希望使用 jQuery 的部分功能，希望提供各种函数。

```
let { find, html } = jake;

document.querySelectorAll("div.myClass")::find("p")::html("hahaha");
```

`::` 其实是让函数绑定作用域，等同于

```
var ele = document.querySelectorAll("div.myClass");
ele = find.bind(ele)("p");
html.bind(ele)("hahaha");
```

## [A Private Fields Proposal](https://github.com/zenparsing/es-private-fields)

定义私有属性，以 `@` 开头的为私有属性，使用时可以省略 `this`。

```
class Point {

    @x;
    @y;

    constructor(x = 0, y = 0) {
        @x = +x;
        @y = +y;
    }

    get x() { return @x }
    set x(value) { @x = +value }

    get y() { return @y }
    set y(value) { @y = +value }

    toString() { return `Point<${ @x },${ @y }>` }

}
```

## [Composition Functions](https://github.com/jhusain/compositional-functions)

async/await 这里就不多说了

## [Additional export-from statements](https://github.com/leebyron/ecmascript-more-export-from)

再增加两项 export-from

```
export v from "mod";
// 等同于
import v from "mod";
export {v};
```

```
export * as ns from "mod";
// 等同于
import * as ns from "mod";
export {ns};
```
