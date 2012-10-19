# mon_python编译

- date: 2008-10-27

--------------------------


今天在编译mod_python,如果要在apache中使用python，那么就需要这模块，其实跟php是类似的。按照这个[文档](http://man.chinaunix.net/develop/python/mod_python/mod_python.html#head-8dc10c299d655d8391b0fb70699bf3eca52143c6)进行编译，这个文档已经比较老了，但还是有参考价值的。在编译的时候遇到了这个问题
checking for C compiler default output file name.. configure: error: C compiler cannot create executables
起初以为是python依赖库的问题，最后查了些帖子原来是g++没装
sudo aptitude install g++

之后还是有问题，编译时需要apxs，因为mod_python只支持DSO，DSO的好处是模块安装时不需要重新编译Apache,并且需要时再使用。网上很多帖子说apsx在/usr/local/_apache_/bin/_apxs_这个目录，但我并未找到。最后安装了apache2-threaded-dev,apxs的目录为/usr/bin/apxs2
然后继续编译
./configure --with-apxs=/usr/bin/apxs2

然后继续报错，说是没有找到python。然后添加with-python
./configure --with-python=/usr/bin/python2.5 --with-apxs=/usr/bin/apxs2
还是报错
checking checking where python libraries are installed... /usr/lib/python2.5
checking for Py_NewInterpreter in -lpython2.5... no
configure: error: Can not link to python
有一个[帖子](http://ubuntuforums.org/showthread.php?t=556955)说没装python-dev，果然是这样
sudo aptitude install python-dev

./configure --with-python=/usr/bin/python2.5 --with-apxs=/usr/bin/apxs2
成功
make
sudo make install
