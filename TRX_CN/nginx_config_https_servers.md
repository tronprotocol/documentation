**系统环境：Centos7 系列**

# 一、	安装nginx
		yum install nginx -y

# 二、	配置nginx
创建配置文件/etc/nginx/conf.d/ssl_proxy_host.conf,编辑内容如下：
		server {
			listen       80;
			listen       [::]:80;
			server_name  www.test.com;                      #此处配置你自己的域名
			return 301 https://$server_name$request_uri;
			}
		server {
			listen       443;
			listen       [::]:443;
			server_name  www.test.com;                      #此处配置你自己的域名
			ssl on;
			ssl_certificate /etc/pki/nginx/test.crt;        #此处配置你的证书'.crt'文件路径
			ssl_certificate_key /etc/pki/nginx/test.key;    #此处配置你的证书'.key'文件路径
			gzip on;
			gzip_min_length 1k;
			gzip_buffers 4 16k;
			gzip_comp_level 6;
			gzip_types text/css text/javascript application/css application/javascript image/jpeg image/gif image/png;
			gzip_vary on;
			location / {
				proxy_set_header X-Real-IP $remote_addr;
				proxy_set_header X-Forward-For $proxy_add_x_forwarded_for;
				proxy_set_header Host $http_host;
				proxy_set_header X-Nginx-Proxy true;
				proxy_pass http://127.0.0.1:8080;           #此处配置你想代理的服务器地址及端口       
				proxy_redirect off;
			}
			error_page 404 /404.html;
				location = /40x.html {
			}
			error_page 500 502 503 504 /50x.html;
				location = /50x.html {
			}
		}
# 三、	启动nginx服务
		systemctl start nginx

# 四、   附官网nginx配置https文档教程
[http://nginx.org/en/docs/http/configuring_https_servers.html](http://nginx.org/en/docs/http/configuring_https_servers.html)




