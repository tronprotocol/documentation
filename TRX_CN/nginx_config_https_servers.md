**系统环境：Centos7 系列**

# 一、	安装nginx
		yum install nginx -y

# 二、	配置nginx
创建配置文件/etc/nginx/conf.d/ssl_proxy_host.conf,编辑内容如下：<br>
<br>
>server {<br>
>listen       80;<br>
>listen       [::]:80;
>server_name  www.test.com;                      #此处配置你自己的域名<br>
>return 301 https://$server_name$request_uri;<br>
>}<br>
>server {<br>
>listen       443;<br>
>listen       [::]:443;<br>
>server_name  www.test.com;                      #此处配置你自己的域名<br>
>ssl on;<br>
>ssl_certificate /etc/pki/nginx/test.crt;        #此处配置你的证书'.crt'文件路径<br>
>ssl_certificate_key /etc/pki/nginx/test.key;    #此处配置你的证书'.key'文件路径<br>
>gzip on;<br>
>gzip_min_length 1k;<br>
>gzip_buffers 4 16k;<br>
>gzip_comp_level 6;<br>
>gzip_types text/css text/javascript application/css application/javascript image/jpeg image/gif image/png;<br>
>gzip_vary on;<br>
>location / {<br>
>proxy_set_header X-Real-IP $remote_addr;<br>
>proxy_set_header X-Forward-For $proxy_add_x_forwarded_for;<br>
>proxy_set_header Host $http_host;<br>
>proxy_set_header X-Nginx-Proxy true;<br>
>proxy_pass http://127.0.0.1:8080;           #此处配置你想代理的服务器地址及端口<br> 
>proxy_redirect off;<br>
>}<br>
>error_page 404 /404.html;<br>
>location = /40x.html {<br>
>}<br>
>error_page 500 502 503 504 /50x.html;<br>
>location = /50x.html {<br>
>}<br>
>}<br>
# 三、	启动nginx服务
		systemctl start nginx

# 四、   附官网nginx配置https文档教程
[http://nginx.org/en/docs/http/configuring_https_servers.html](http://nginx.org/en/docs/http/configuring_https_servers.html)




