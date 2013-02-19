# twitter 的包管理工具 - bower

- date: 2013-02-05

--------------------------

![image](../../uploads/2013/02/dec6c25df5e4437ad9d068a81fc9d65c.png
)

[Bower](http://twitter.github.com/bower/) 是 twitter 推出的一款包管理工具，那大家会问什么是包管理工具呢，包管理工具解决什么样的问题？

## 什么是包管理

Javascript 语言本身是没有模块的概念的，直到 node.js 的出现 CommonJS 规范应运而生，之后在浏览器端也出现了 AMD, CMD 等规范。这些规范都提供了一种组织方式使 javascript 的代码模块化，模块可以单独存在与使用，模块和模块之间存在联系。模块化的 javascript 可以打成一个包，所以需要提供一个工具来管理这些包。

包的组织形式因工具而异，但一个包管理工具一般都有这些功能：

 -  注册机制

    每个包需要确定一个唯一的 ID 使得搜索和下载的时候能够正确匹配，所以包管理工具需要维护注册信息，可以依赖其他平台。

 -  文件存储

    确定文件存放的位置，下载的时候可以找到，当然这个地址在网络上是可访问的。

 -  上传下载

    这是工具的主要功能，能提高包使用的便利性。比如想用 jquery 只需要 install 一下就可以了，不用到处找下载。上传并不是必备的，根据文件存储的位置而定，但需要有一定的机制保障。

 -  依赖分析

    这也是包管理工具主要解决的问题之一，既然包之间是有联系的，那么下载的时候就需要处理他们之间的依赖。下载一个包的时候也需要下载依赖的包。  

下面会穿插着说明 Bower 是如何实现这些功能的，先来看看如何使用。


## 如何使用

在使用之前需要先安装，bower 是基于 nodejs 开发的

```
npm install bower -g
```

### 下载

看看要使用 jquery 需要如何操作

```
$ bower install jquery
bower cloning git://github.com/components/jquery.git
bower cached git://github.com/components/jquery.git
bower fetching jquery
bower checking out jquery#1.9.1
bower copying /Users/popomore/.bower/cache/jquery/cf68c4c4e7507c8d20fee7b5f26709d9
bower installing jquery#1.9.1
```

Jquery 会被下载到 `./components` 目录下，在页面上直接调用就可以了。

Bower 在下载的时候会去 server 上找名字对应的 git 库，下载后切换到对应的版本，如果未指定则是最新的。

除了按名字下载，还有其他方式

1. 直接下载 git 库

    ```
    bower install git://github.com/components/jquery.git
    ```

2. github 的别名，自动解析成 git 库

    ```
    bower install components/jquery (same as above)
    ```

3. 下载线上的任意文件

    ```
    bower install http://foo.com/jquery.awesome-plugin.js
    ```

4. 下载本地库

    ```
    bower install ./repos/jquery
    ```

如果只是下载的话是不需要配置文件的。

### 注册

可以注册自己的包，这样其他人也可以使用了

```
bower register project git://github.com/yourname/project
```

这个操作只是在服务器上保存了一个隐射，服务器本身不托管代码。

### 配置文件

每个包应该有一个配置文件，描述包的信息，bower 的配置文件为 component.json。

```
{
  "name": "myProject",
  "version": "1.0.0",
  "main": "./path/to/main.css",
  "dependencies": {
    "jquery": "~1.7.2"
  }
}
```

name 和 version 描述包的名称和版本，dependencies 描述这个包依赖的其他包。main 指定包中的静态文件，可以为一个数组。

除了包的配置文件，bower 还有一个全局的配置文件(~/bowerrc)。

```
{
  "directory" : "components",
  "json"      : "component.json",
  "endpoint"  : "https://bower.herokuapp.com",
  "searchpath" : ["https://bower.herokuapp.com"]
}
```

directory 为 install 时生成的目录，json 指定配置文件的名称。

endpoint 指定 bower server，用于储存包的信息，默认是 bower 官方的，也可以自己搭建 [bower server](https://github.com/twitter/bower-server)。可以通过 register 命令将包信息注册到 endpoint 上。

searchpath 可以指定一系列的 bower server，但是只是用于查询。首先查询 endpoint，如果没有再按顺序查询 searchpath。

### 项目中使用

在项目中使用 bower 也比较简单。

给自己的项目也添加一个 component.json 配置文件，执行 `bower install`，bower 会将依赖的包下载到 components 的目录下。

如果依赖的包还依赖其他包，bower 也会下载到本地，直到把所有依赖的包都下载完成。bower 的目录结构是扁平化的，所有的包都在同级目录下。

如果想查看有哪些包和文件，可执行 `bower list --path`。比如 install 了 [flight](https://github.com/twitter/flight)，可以看到以下信息

```
{
  "es5-shim": "components/es5-shim",
  "flight": "components/flight/lib/index.js",
  "jquery": "components/jquery/jquery.js"
}
```

现在就可以使用了，在当前目录建一个页面，script 嵌入需要的 js，如果想对 js 做模块化管理可使用 [seajs](http://seajs.org/docs/)。

## 总结

Bower 非常简单易用，只要创建一个 component.json 添加依赖包的配置就可以使用了，再不需要到处去找了。

现在就开始使用吧，[找找有没有你想用的组件](http://sindresorhus.com/bower-components/)。