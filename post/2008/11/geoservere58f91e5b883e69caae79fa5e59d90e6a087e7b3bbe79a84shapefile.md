# geoserver发布未知坐标系的shapefile

- date: 2008-11-10

--------------------------


刚开始用geoserver，并不是很熟，简单的用他给的例子配置了一下一会儿就出来了。但现在要用自己的数据就比较麻烦了，因为我的数据的坐标系是自己定义的，在geoserver的库中找不到，这就成了一件麻烦事儿。

geoserver具有自动查找坐标系的功能，在$geoserver_dir/data/user_projections文件夹中有一个epsg.properties文件，里面储存了所有的坐标系。载入shapefile后系统会匹配库里的坐标系，但是我的数据的坐标系并不在库中，并不是说没有坐标系，而是库中没有这个坐标系。但geoserver支持自定义坐标系，你可将自己坐标系的参数加在epsg.properties的最后，并且定义EPSG的编号（不可与其他编号冲突），坐标系参数可在prj文件中获得。最后在 [http://localhost:8080/geoserver/srsHelp.do](http://localhost:8080/geoserver/srsHelp.do)查看坐标系添加的是否正确。

关于发布shapefile的具体配置可以去[官方](http://geoserver.org/display/GEOSDOC/User+Tutorial+Shapefile)查看，如果自定义坐标载入成功的话，在"查找SRS"处就会找出刚刚自定义的编号。还需要注意bounding box，他的单位是根据坐标系来的，不过geoserver可以自动生成shapefile的bounding box。 最后可预览下,注意box还是要设对。
