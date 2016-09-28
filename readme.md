实用的小工具箱

安装方法：

修改`application/config/config.php`中的`base_url`修改为服务器的host地址

修改`application/config/database.php`中的数据库配置，并且**创建数据库**

修改`application/controller/Seeder.php`中的数据，可以自定义生成的数据并且插入到数据库

``` bash
cd /var/www/html/WorkEfficiency #cd到项目的根目录下
php index.php migrate
php index.php seeder start
```

默认帐号密码为`root root`