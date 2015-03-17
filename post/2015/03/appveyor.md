# Windows 上测试 Node 应用

- pubdate: 2015-03-17

---

如果你写了一个 Node 应用，但没有使用持续集成的话，说明你的应用是不完整的，你无法保证在长期的维护过程中应用的稳定性。

一般我们会使用 [travis](https://travis-ci.org) 做持续集成工具，只要添加一个 .travis.yml 文件就轻松搞定，但你缺少了 Windows 平台的测试。

服务端应用使用 Windows 并不多见，但从 [npm 官网推荐](https://www.npmjs.com/#explicit)来看很多是客户端工具，所以对 Windows 的支持必不可少。

[Appvoyer](https://ci.appveyor.com/) 提供了可以在 Windows 上做持续集成的工具。

## Appvoyer 注册

Appvoyer 和 travis 类似，操作也很像。

1. 首先要注册一个账号，可以直接用 github 授权。注意和 help 是两个账号体系！！！

2. 授权完就可以在主页选择自己的项目添加了。

3. 添加后点一下 `NEW BUILD` 就可以开始跑了，而且每次 push 后都会自己跑。

## Appvoyer 配置

配置很简单，只需要在项目根目录添加一个文件（appveyor.yml）就可以了。

```
init:
  - git config --global core.autocrlf input

environment:
  matrix:
    - nodejs_version: 0.10
    - nodejs_version: 0.11
    - nodejs_version: 0.12
    - nodejs_version: 1

install:
  - ps: Install-Product node $env:nodejs_version
  - npm install

build: off

test_script:
  - node --version
  - npm --version
  - npm run cov
```

官网有[非常详细的教程](http://www.appveyor.com/docs/lang/nodejs-iojs)，我这里以[自己的项目](https://github.com/popomore/father)为例说明一下各项配置。

```
init:
  - git config --global core.autocrlf input
```

Windows 的 line ending 和其他平台不同，设置成 input 会和 linux 平台保持一致，将 `\r\n` 转换成 `\n`。

```
environment:
  matrix:
    - nodejs_version: 0.10
    - nodejs_version: 0.11
    - nodejs_version: 0.12
    - nodejs_version: 1
```

可以指定多个 Node 版本，1.x 直接使用 [io.js](https://iojs.org/cn/index.html)，每次 push 都会创建多个 task 分别跑不同的版本。

```
install:
  - ps: Install-Product node $env:nodejs_version
  - npm install
```

指定 ps 可调用 PowerScript 的脚本，`Install-Product` 用来指定当前的使用的 Node 版本。安装时直接使用 npm 安装。

```
build: off
```

因为只跑持续集成，没有编译需求。

```
test_script:
  - node --version
  - npm --version
  - npm run cov
```

跑测试脚本，我使用 `npm run cov`，很多人直接使用 `npm test` 也没有问题。

最后要注意 Windows 上是不支持 Makefile 的，所以最好都用 npm scripts。

## Appvoyer 的生命周期

上面的配置文件只是我自己项目的流程，但 [Appvoyer 的生命周期](http://www.appveyor.com/docs/build-configuration#build-pipeline)更加强大。

- init 初始化。
- clone 代码，cd 到指定目录。
- 执行 install 脚本。
- patch 文件（我也不懂），不过新项目是默认关闭的。
- 修改 hosts 文件。
- 启动服务。
- build 脚本，有前后置的 hook。
- test 脚本，有前后置的 hook。
- 调用 build_success 的 webhooks
- deploy 脚本，有前后置的 hook。

还提供更多的 hook

- 如果成功会调用 deployment_success 的 webhooks 和 on_success。
- 如果成功会调用 build_failure 和 deployment_failure 的 webhooks，及 on_success。
- 完成后都会调用 on_finish。

## 总结

没有持续集成的项目是不完美的，Windows 持续集成可以让你的项目更加稳定。
