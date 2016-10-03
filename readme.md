实用的小工具箱

安装方法：

修改`application/config/config.php`中的`encryption_key`修改加密秘药，为16位长度的秘钥

修改`application/config/database.php`中的数据库配置，并且**创建数据库wefficiency**

修改`application/controller/Seeder.php`中的数据，可以自定义生成的数据并且插入到数据库

``` bash
cd /var/www/html/WorkEfficiency #cd到项目的根目录下
php index.php migrate
php index.php seeder start
```

[DEMO](http://todo.jwlchina.cn)
