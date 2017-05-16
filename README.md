__before working on this project, you need:__  
- to install TOMCAT APPACH, PHP 7 and MYSQL: the best way is to install WAMP or LAMP solution
- to install COMPOSER
- to create the database of the blog : use the sql script 'myblog.sql'
- to install several php libraries, in the project directory run the following command : php composer.phar update
  
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

