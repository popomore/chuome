# markdown 写 ppt

- date: 2012-11-01

---

相信很多人都是做 ppt 的高手，一般的工具都是 PowerPoint，如果文艺点可能会用 Keynote，那大家有没有用过通过写页面的方式写 ppt 呢？

当然有人做过，[@lepture](http://lepture.com) 同学曾经就被老大要求做过一个页面，融合 html5 和 css3 技术做一个很炫的 ppt。但有没有更简单的，@lepture 同学当时还是费了点劲的。其实现在有很多 js 框架支持这个功能，[reveal.js](https://github.com/hakimel/reveal.js) 就是其中之一。可以看看他官方的 [demo](http://lab.hakim.se/reveal-js/)，是不是挺炫的？只要通过一些约定，在相应的地方写 html 或 markdown 就 ok 了。

可能有人会说麻烦，reveal.js 还提供了 [rvl.io](http://www.rvl.io/) 在线编辑，还提供 URL 直接访问。这样分享的时候就不用把 ppt 传来传去了，直接敲个 URL 就搞定了。

如果还不满意，想自己捣腾，那我推荐用下面的工具 [liquidluck-theme-reveal](https://github.com/popomore/liquidluck-theme-reveal/)。

这个工具可自动将 markdown 文件生成基于 reveal 的页面。他需要有一些约定，ppt 的每一页是由 `---` 分开的，如

    # Example for liquidluck theme reveal
    
    - date: 2012-11-01
    
    ---
    
    # First Slide
    
    ---
    
    # Second Slide
    
    ```
    <script>
    // javascript code
    </script>
    ```
    
具体使用可以查看 README。
