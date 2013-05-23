# for in 的顺序

- pubdate: 2013-05-23

---

最近在开发 [Base](http://aralejs.org/base/) 的时候发现了 isPlainObject 的问题。

Base 的 isPlainObject 来自于 jquery，可以先看下 [jquery@1.9.1](https://github.com/jquery/jquery/blob/1.9.1/src/core.js#L449-L476) 的实现。

```
isPlainObject: function( obj ) {
  // Must be an Object.
  // Because of IE, we also have to check the presence of the constructor property.
  // Make sure that DOM nodes and window objects don't pass through, as well
  if ( !obj || jQuery.type(obj) !== "object" || obj.nodeType || jQuery.isWindow( obj ) ) {
    return false;
  }

  try {
    // Not own constructor property must be Object
    if ( obj.constructor &&
      !core_hasOwn.call(obj, "constructor") &&
      !core_hasOwn.call(obj.constructor.prototype, "isPrototypeOf") ) {
      return false;
    }
  } catch ( e ) {
    // IE8,9 Will throw exceptions on certain host objects #9897
    return false;
  }

  // Own properties are enumerated firstly, so to speed up,
  // if last one is own, then all properties are own.

  var key;
  for ( key in obj ) {}

  return key === undefined || core_hasOwn.call( obj, key );
},
```

PlainObject 是指简单对象，只能是 `{}` 或 `new Object()` 生成，上面的逻辑有这么几步

1. 判断是否是一个 Object，不多说，最起码的判断
2. 判断是否是一个 DOM 对象，这也是一个 Object
3. 判断上层原型链的对象是否有 isPrototypeOf 属性，也就是说对象是 Object 构造出来的(isPrototypeOf 是 Object.prototype 的属性)

上面几步已经基本能确定是否为 PlainObject 了，但还有一种情况，手动修改了原型，使得原型上也可枚举

```
function Foo() {
  this.a = 1;
  this.b = 2;
}

Foo.prototype = {
  c: 3,
  d: 4
};

foo = new Foo();

console.log(foo.constructor.prototype.hasOwnProperty('isPrototypeOf')) // => true
```

所以还需要一层判断：是否还有上层的原型链。

如何实现的呢？这才到这个话题的重点「for in 是如何运行」，可以先看下 emca 262，那写的很清楚

> Enumerating the properties of an object includes enumerating properties of its prototype, and the prototype of the prototype, and so on, recursively;

枚举的时候会先读对象自己的属性，然后再从原型链上依次往上找，这些属性是要可枚举的。现在应该可以看懂上面的代码了，**循环完后读的最后一个属性如果还是对象自身的话那说明已经没有上层的原型链了**。

但是...事情还未结束，还有诡异的 IE 存在，这也是问题的根源。IE6-8 执行的顺序是相反的，也就是先读取原型链的，再读自己的，可以在 IE 下跑这个 [demo](http://jsfiddle.net/popomore/pjNKf/14/)。

jQuery 在 1.10 才修复[这个问题](http://bugs.jquery.com/ticket/12199)，最后增加了一段代码

```
// Support: IE<9
// Handle iteration over inherited properties before own properties.
if ( jQuery.support.ownLast ) {
  for ( key in obj ) {
    return core_hasOwn.call( obj, key );
  }
}
```

正因为相反，所以在 IE6-8 的时候取第一个属性，判断是否为自己的，完整的代码可以看 [jQuery@1.10](https://github.com/jquery/jquery/blob/1.10.0-beta1/src/core.js#L450-L485) 的。

了解了这个原理后就解决了 isPlainObject 的 bug，继续干活吧。感叹下 jQuery 竟然把这个 bug 埋了那么久。
