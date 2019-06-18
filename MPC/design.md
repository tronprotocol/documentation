# Zcash存储方案及时间节点：
## 第一阶段（powers of tau）：
1.第一阶段的transcript大文件（100GB）存储 ：https://archive.org/details/transcript_201804   
2.phase1阶段22文件（2.3GB）由transcript验证后生成；官方存放于电炉：magnet:?xt=urn:btih:C3F316242FF3F4C2EC5F8CBFC27AE2CA2B599146&dn=powersoftau&tr=udp%3a%2f%2ftracker.opentrackr.org%3a1337%2fannounce   
3.第一阶段poweroftau中所有人的中间输出结果，记录在https://github.com/ZcashFoundation/powersoftau-attestations，每人一个目录：   
* 记录下硬件配置；记录下执行命令的流程；记录下hash值；文件名report.asc；
* 发布所有与组织者的往来邮件，文件存储于基金会的邮件目录，邮件的链接记录在README.md；
* 生成的response文件存放于amazonaws上，记录下存储地址，存储链接类似于：https://powersoftau-transcript.s3-us-west-2.amazonaws.com/f01f2679613a75ef09f94f588cc3253962c49c9129b174d9145336011ada960e29c8c91a21314705ebdbd081e526bd4d738447385b95e95d5043764786f01441
* 文件名README.md。某个用户的邮件参考：https://lists.zfnd.org/pipermail/zapps-wg/2017/000013.html   

4.总时间：89个人成功参与，2017-11-11~2018-04-11，共约150天，5个月。https://github.com/ZcashFoundation/powersoftau-attestations

## 第二阶段（sapling-mpc）：
1.第一个params由new.rs文件生成，官方存放于：https://storage.googleapis.com/sapling-mpc/params   
2.第二阶段每一个人参与，生成一个hash值。
* 从某个地方下载params文件（750MB），执行sapling-mpc的compute流程。记录下自己的hash值，把生成的new_params文件和hash发送给组织者；
* 没有说明params文件的存储位置，提到组织者给参与者发送一个连接地址，没有提到存储在哪儿；
* 组织者在github的wiki上记录每个参与者的姓名和hash值。https://github.com/zcash-hackworks/sapling-mpc/wiki；   

3.总时间：大约200人参与，其中90个人成功参与，2018-05~2018-08,大概3个月。https://z.cash/zh/technology/paramgen/

# Tron初步流程设计
## 第一阶段powersoftau初步流程设计
* 发布匿名交易的项目背景和需求，号召社区用户参与；并在github的wiki上记录时间节点和对应的操作流程；
* 在社区选取m个参与者，规划每个用户的参与时间节点，每个参与者预留4小时的参与时间（1小时下载/环境准备+1小时计算+1小时上传+1小时冗余），
* 组织者：生成第一个challenge文件（5分钟），并发布到aliyun云存储（1小时）；
* 组织者：发邮件或通过keybase通知第 i 个用户challenge文件的下载地址；
* 参与者(4小时)：   
  + rust运行环境准备及下载challenge文件，1.2GB（1小时）；   
  + 执行compute流程，中间需要用户随机至少32字节的随机字符串（1小时）；   
  + 完成后把hash值、response文件、硬件信息等通过keybase客户端发送给组织者（1小时）；  
  + 销毁机器，避免信息泄露；
* 组织者（5小时）：   
  + 验证challenge文件和response文件关系（4小时）；  
  + 若验证成功，生成new_challenge文件和response_hash值；new_challenge是response文件的未压缩版，把new_challenge上传到aliyun云存储（1小时），把new_challenge文件链接和hash发布到github的wiki。这个new_challenge是后一个参与者的challenge文件。每个参与者一个目录。  
  + 若验证失败，丢弃此次response文件；  
  + 通知第i+1个参与者，转4。
* 组织者：在所有m个用户参与完成后   
  + 添加随机信标，生成response文件。   
  + 把最终的response文件上传到aliyun云存储，把beacon值发布到github的wiki。
* 组织者把生成的所有new_challenge文件合并成一个大的transcript文件，便于其他参与者验证贡献。  
* 所有参与者：验证大的transcript文件，生成22个参数文件，并判定是否包含自己的贡献；或者只验证最后一个response，生成22个参数文件。
* 组织者：把这22个文件发布到amazon云存储服务器。
* 总时间估计：m天（每个用户工作日1天，休息日0.4天）* 1.4 + 合并大文件2天 + 上传大文件2天 + 校验大文件3天 = 1.4m + 7天。若30个人参与，需要50天。

## 第二阶段mpc初步流程设计

* 发布项目背景和需求，号召社区用户参与；并在github的wiki上记录时间节点和对应的操作流程；
* 在社区选取n个参与者，规划用户的参与时间节点，每轮预留9个小时的参与时间，1天大约可以让1.5个参与者完成；
* 把zcash第一阶段发布的22个参数文件（2.3GB）发布到amazon云存储服务器；
* 组织者：生成第一个param文件（770MB），发布到aliyun云存储服务器；
* 组织者：发邮件或通过keybase通知第 i 个用户params文件的下载地址；
* 参与者（6.5小时）：   
  + rust运行环境准备（0.5小时）；   
  + 下载22个参数文件和params文件，共约3GB（1小时）；   
  + 执行compute流程（4小时）；   
  + 完成后把hash值、new_params文件、硬件信息等通过keybase客户端发送给组织者（1小时）；
* 组织者（2.5小时）：   
  + 验证new_params是否可信：  
  + 若验证失败，丢弃本次new_params文件；  
  + 若验证成功，把new_params上传到aliyun云存储，并把参与者的名称、hash值、时间记录和new_params链接发布到github的wiki。每个用户一个目录   
  + 通知第i+1个参与者；
* 组织者：  
  + 在所有n个用户参与完成后添加随机信标beacon；     
  + 把params文件上传到amazon，把hash和params文件链接发布到github的wiki；
* 所有用户分割params文件，可以得到output，spend的proof key、verify key文件；
* 总时间估计：每周5个工作日可让7个用户完成。若30个人参与，需要4周约一个月。
