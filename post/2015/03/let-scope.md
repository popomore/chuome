# let 作用域

- pubdate: 2015-03-04

---

> 请使用 strict 模式测试代码，可直接使用 [iojs](http://iojs.org)，并在文件头部添加 `’use strict’;`。

## TL;DR

ES6 增加了两个关键字 `let` 和 `const`，`var` 只有全局和函数作用域，而新增的两个具有块级作用域。`let` 和 `const` 可以在任何场景取代 `var`，而且 `var` 会在不久的将来成为历史。

## 作用域差异

块级作用域是在 `{..}` 内的代码形成的作用域，从这个角度来说函数也属于一个块级作用域。

```
if (true) {
  let a = 1;
  var b = 1;
}
console.log(a); // ReferenceError: a is not defined
console.log(b);
```

`a` 在 if 的块级作用域使用 `let` 定义，所以在作用域外就会报错，而 `var` 并不识别块级作用域。

来看看一直困扰我们的 for 引用问题

```
var funcs = {};
for(var i = 0; i < 3; i++) {
  funcs[i] = function() {
    console.log(i);
  }
}
funcs[0](); // 3
```

上面期望的结果应该是 0，但由于函数引用外部的 i 变量，而 i 一直在循环过程中变化，所以返回的是最终的值。

```
var funcs = {};
for(let i = 0; i < 3; i++) {
  funcs[i] = function() {
    console.log(i);
  }
}
funcs[0](); // 0
```

换成 let 后 i 变量只在当前循环的作用域生效，非常简单地解决了这个问题。

## 变量提升

变量提升一直以来都存在。

```
console.log(a); // undefined
var a = 1;
console.log(a); // 1

console.log(b); // ReferenceError: b is not defined
```

第一个变量 `a` 返回了 `undefined`，因为在作用域中 `a` 已经被提升了，并初始化为 `undefined`。之后 `a` 被赋值为 1，取值为 1。作为对比，如果未申明 b 会抛出 `ReferenceError`。

除了变量申明，函数申明也会变量提升，而且是块级作用域。

```
if (true) {
  f(); // 1
  function f() {
    console.log(1);
  }
}
f(); // ReferenceError: f is not defined
```

函数申明会在[当前块级作用域被提升](https://esdiscuss.org/topic/in-es6-strict-mode-do-function-declarations-within-a-block-hoist)，但在作用域外部调用会报错。

## TDZ

TDZ 指 Temporal Dead Zone（术语就不翻译了），在使用 `let` 和 `const` 时了解下有备无患。

```
let x = 1;
(function() {
  console.log(x); // 1
})();
```

如果当前作用域未定义变量，会从父级作用域获取，上述代码返回父级作用域定义的 `x` 变量。

```
(function() {
  console.log(x); // ReferenceError: x is not defined
  let x = 1;
})();
```

但如果同一作用域中，在申明之前调用变量会抛出 `ReferenceError`，这说明变量未被提升？

```
let x = 2;
(function() {
  console.log(x); // ReferenceError: x is not defined
  let x = 1;
})();
```

上述例子依然会报错，如果变量未被提升应该会使用父级作用域的变量，而这里没有。

这就被称为 TDZ 的东西，当进入作用域会提升变量，但不会初始化，直到申明语句为止，如果未赋值会初始化为 `undefined`。

而 `var` 是没有 TDZ，在变量提升时已经被初始化成 `undefined` 了。

[读 ES6 规范能了解更多信息](http://es6rocks.com/2015/01/temporal-dead-zone-tdz-demystified/#the-gory-details)。

## 结论

- const 的作用域和 let 类似，不做更多的说明。

- 使用 `let` 和 `const` 完全替代 `var`。

- 块级作用域无处不在，需要注意在不同作用域之间的变量定义。

- 注意 TDZ，在作用域中提前申明。 

## Reference

- [TEMPORAL DEAD ZONE (TDZ) DEMYSTIFIED](http://es6rocks.com/2015/01/temporal-dead-zone-tdz-demystified/)
- [let 和 const 命令](http://es6.ruanyifeng.com/#docs/let)
- [Variables and scoping in ECMAScript 6](http://www.2ality.com/2015/02/es6-scoping.html)
- [es6-feature let + const](https://github.com/lukehoban/es6features#let--const)