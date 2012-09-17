# 从blogger搬到wordpress

- date: 2009-03-10

--------------------------


前几天刚把[cref 166 blog搬到wordpress]，弄了两天终于把最后的问题解决了，今天把blogger重定向给解决了。其实现在wordpress2.71导入已经很方便了，不过我还是记录一下吧。


### 1、从blogger导入


wordpress2.7导入已经非常方便了，在工具－>导入直接就有blogger的选项，一键就可以导入文章已经评论，还可以导入多个blog的。


### 2、将目录转换成标签


将blogger导入后，发现所有的标签都成了目录。于是上网找相应的工具，后来发现wordpress[已经自带了](http://en.blog.wordpress.com/2007/10/08/category-to-tag-converter/)，而且非常好用。


### 3、将blogger重定向到本站


现在wordpress已经能正常使用了，但所有的流量都在blogger里。但[PR是不能重blogger转向wordpress的](http://laffers.net/howtos/howto-redirect-blogger-to-wordpress)，因为301重定向只能作用于服务器，而blogger是不能操作服务器的，但可以通过脚本的方式将访客转发到wordpress。在head标签之间添加如下代码


<script type='text/javascript'>
window.location.replace('domain');
</script>




### 4、重定向到对应页面


现在已经能将blogger的页面转发到wordpress上了，但所有文章的链接都被转发到首页。所以还需安装[blogger-to-wordpress-redirection](http://wordpress.org/extend/plugins/blogger-to-wordpress-redirection/)插件，这个插件能根据原来的地址转发到相应的地址，但必须保证文章是原blogger导入的，而且只支持一个博客。开发者介绍了[配置的经过](http://www.devilsworkshop.org/blogger-to-wordpress-traffic-permalinks-redirection-plugin/)，插件安装后，需修改原博的地址。


> $oldBlogURL＝“你的blogger地址”;




### 5、合并评论？


在blogger的时候我使用intensedebate，所以评论都存在intensedebate里。虽然wordpress有相应的插件，但是同步到一个新的目录中，而且不能合并。听说有人正在开发一个[转换的插件](http://getsatisfaction.com/intensedebate/topics/migrated_blog_from_blogger_to_wordpress_need_help_installing_id_in_wordpress)，让我们拭目以待吧。

