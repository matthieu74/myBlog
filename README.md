__before working on this project, you need:__  
- to install TOMCAT APPACH, PHP 7 and MYSQL: the best way is to install WAMP or LAMP solution
- to install COMPOSER
- to create the database of the blog : use the sql script 'myblog.sql'
- to install several php libraries, in the project directory run the following command : php composer.phar update

__How to configure virtual hosts on your localhost__
we will create a virtual host under the name: "myBlog.dev"
- in the repository *C:\Windows\System32\drivers\etc*; open “hosts” file with admin privileges and add the following to its end;
127.0.0.1 *myblog.dev* 
- allow virtual hosts in httpd.conf  
-- ckick on wamp tray icon and Apache->httpd.conf  
-- search for *# Include conf/extra/httpd-vhosts.conf* and comment it out (by deleting the # caracter): *Include conf/extra/httpd-vhosts.conf*  
-- then at the bottom of the file add the *myBlog* project like this:  
<VirtualHost *:80>  
DocumentRoot "d:/projects/myBlog"  
ServerName zaintest  
<Directory "d:/projects/myBlog">  
AllowOverride All  
Require local  
</Directory>  
</VirtualHost>  
  
  
__now you have to configure your project:__  
*myBlog/app/config/Config.yml*  
doctrine:  
host: 'localhost' #mysql host address  
dbname: 'myblog' #the name database  
user: 'root' #user  
password: '' #password  
asset: 'http://localhost/myblog/web' #path for css, js and img files  
  
*myBlog/app/config/Mailer.yml*  
smtp: 'smtp.gmail.com'  
port: 587  
protocole: 'tls'  
user: 'peromatthieu@gmail.com'  
password: ''  

