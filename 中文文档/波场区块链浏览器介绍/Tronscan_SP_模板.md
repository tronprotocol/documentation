## 简介

超级代表可以通过Tronscan向投票人直接发布信息。

超级代表们可以使用此模板，搭建在Troscan的静态页面。个人链接将会在候选人姓名后显示。

通过编辑Github库中的文件，超级代表可以管理自己的展示页面。

## 使用方法

本指南默认您已经注册账户，并有超级代表（候选人）资格。

### 第一步：将Github上的模板克隆/创建分支。

* 前往 https://github.com/tronscan/tronsr-template
* 对库创建分支  

![](https://raw.githubusercontent.com/tronscan/docs/master/images/fork-repo.png)

在分叉后，会跳转至您自己本地的tronsr-template库，您可以在此进行修改。

## 第二步：编辑模板

接下来可以通过修改Github文件对模板进行编辑。

* 选择您要编辑的文件。  

![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-open-file.png)

* 进入编辑模式。

![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-edit-file.png)

* 添加信息。

![](https://raw.githubusercontent.com/tronscan/docs/master/images/edit-team-intro.png)

文件编辑采用Markdown格式，在https://guides.github.com/features/mastering-markdown/可以找到详细教程。

* 更新logo.png和banner.png
 
![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-upload-files.png)  

接着选择“选择文件”，并确保您准备上传的图标或横幅图片分别命名为logo.png和banner.png，这样才能覆盖之前同名的占位文件。

编辑好模板后，可以在https://tronscan.org上进行发布。

## 第三步：在Tronscan发布

* 前往https://tronscan.org

* 登录您的账户，下面的示例使用私钥登录，您也可以选择其他登录方式。

![](https://raw.githubusercontent.com/tronscan/docs/master/images/login-with-private-key.png)

* 进入账户页面，确认显示“代表”标志 

![](https://raw.githubusercontent.com/tronscan/docs/master/images/open-account.png)

* 下滑至页面底部，点击“设置Github链接”。

![](https://raw.githubusercontent.com/tronscan/docs/master/images/set-github-link.png)

* 输入Github用户名，选择“链接Github”。
  
![](https://raw.githubusercontent.com/tronscan/docs/master/images/input-username.png)

* 查看您的新页面！

![](https://raw.githubusercontent.com/tronscan/docs/master/images/view-page.png)

## 示例

下面的示例展示了各文件在页面上对应的展示位置。在Github文件发生变动时，此页面也会即刻更新。

![](https://raw.githubusercontent.com/tronscan/docs/master/images/example-page.png)

## 常见问题

* 我已经修改了Github文件，但是tronscan.org上为什么看不到相应变化？  

库中文件通过使用aggressive caching的Github CDN传输，可能需要几分钟的时间，所有变化才能在页面上显示。

* 为什么HTML元素在Github可见，但在tronscan.org上不可见？

安全起见，Tronscan.org会删除所有HTML标签，只有常规的markdown标签允许保留。