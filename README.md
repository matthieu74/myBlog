before working on this project, you need :
- to install tomcat appach, php 7 and mysql, the best way is to install wamp or lamp solution
- to composer
- creating the database of the blog : use the sql script 'myblog.sql'
- installing all the 
- to install several php library, in the project directory run the following command :
php composer.phar update

now you have to configure your project:
myBlog/app/config/Config.yml
doctrine:
    host: 'localhost' #mysql host address 
    dbname: 'myblog' #the name database
    user: 'root' #user
    password: '' #password
asset: 'http://localhost/myblog/web' #path for css, js and img files


myBlog/app/config/Mailer.yml
smtp: 'smtp.gmail.com'
port: 587
protocole: 'tls'
user: 'peromatthieu@gmail.com'
password: ''

