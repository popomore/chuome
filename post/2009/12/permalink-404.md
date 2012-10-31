# 换permalink页面404的错误

- date: 2009-12-31

--------------------------


以前博客的链接地址是以参数的形式存在的,这样用户的体验并不好,然后打算把他设成日期加文章名的形式,这样也更具有REST风格.但是问题来了,一设成固定链接,则所有的链接都失效了.和[这篇文章](http://wutiam.net/2008/06/resolve-wordpress-permalinks-404-error/)是同样的问题,通过设置`/index.php/%year%/%monthnum%/%postname%/`也能访问,但这篇文章并不能解决我的问题.最后花了半天时间把问题解决了,这里总结一下.


### rewrite模块


重定向需要用到rewrite模块,所以首先可以在phpinfo里查看rewrite模块是否已经打开.如果没有需要去http.conf将以下代码的注释去掉.

`#LoadModule rewrite_module modules/mod_rewrite.so`


### AllowOverride


这个可能很多人没注意,我就是遇到这个问题.要让apache能够解析.htaccess文件,就必须设置AllowOverride参数.如果设为none,那么文件就不会生效.我偷懒设置为all,更多参数可以看[这里](http://www.ccvita.com/281.html).

`

AllowOverride None

`


### .htaccess


这个比较重要,如何重定向主要就看这个文件,在这里提供一个模板好了.

`

RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]

`
