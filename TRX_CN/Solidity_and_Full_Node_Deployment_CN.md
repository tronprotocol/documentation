# 在一台主机上同时部署SolidityNode和FullNode

+ 对于fullnode和soliditynode，分别创建两个目录

      /deploy/fullnode
      /deploy/soliditynode

+ 对fullnode和soliditynode分别进入两个文件夹，然后执行以下操作：
 
  ## FullNode 部署方案：

        cd /deploy/fullnode
        从https://github.com/tronprotocol/java-tron/releases下载最新的release的代码,并解压
        cd java-tron/
        ./gradlew build
        cp build/libs/FullNode.jar ../
        cd ..
        从https://github.com/tronprotocol/TronDeployment处下载最新的配置文件，main_net_config.conf是主网配置，test_net_config.conf是测试网配置，下载之后文件重命名为<font color="red">config.conf</font>config.conf

    然后就可以启动FullNode了：  
            
            nohup java -jar FullNode.jar -c config.conf &
            
  ## SolidityNode部署方案
 
        cd /deploy/SolidityNode
        从https://github.com/tronprotocol/java-tron/releases下载最新的release的代码,并解压
        cd java-tron/
        ./gradlew build
        cp build/libs/SolidityNode.jar ../
        从https://github.com/tronprotocol/TronDeployment处下载最新的配置文件，main_net_config.conf是主网配置，test_net_config.conf是测试网配置，下载之后文件重命名为<font color="red">config.conf</font>config.conf
        cd ..
 
     为了避免和`FullNode`端口冲突，和连接本地的`FullNode`，需要打开`config.conf`。把`node`里面的`trustNode`修改为本地`127.0.0.1:50051`。把`listen.port`修改为18888以外的数字，需要主要的是端口的设置范围是1024-65525，端口0-0124是禁用的，像这样：
```
        node {
         # trust node for solidity node
         # trustNode = "ip:port"
        trustNode = "127.0.0.1:50051"
        listen.port = 18889 //需要设置的端口

        rpc {
          port = 50052
        }
```
 
    然后就可以启动SolidityNode了：
        
            nohup java -jar SolidityNode.jar -c config.conf &
    
 ## 日志和网络连接的验证
    fullnode和soliditynode对应的日志在目录`/deploy/\*/logs/tron.log`，可以通过命令`tail -f /logs/tron.log/`去查看bolck同步的情况。日志大致如下：
 ### FullNode
     12:00:57.658 INFO  [pool-7-thread-1] [o.t.c.n.n.NodeImpl](NodeImpl.java:830) Success handle block Num:236610,ID:0000000000039c427569efa27cc2493c1fff243cc1515aa6665c617c45d2e1bf
 ### SolidityNode
     12:00:40.691 INFO  [pool-17-thread-1] [o.t.p.SolidityNode](SolidityNode.java:88) sync solidity block, lastSolidityBlockNum:209671, remoteLastSolidityBlockNum:211823 

# 正确的停止节点
新建stop.sh，用kill -15关闭java-tron.jar（或者FullNode.jar、SolidityNode.jar）相关进程进程。
你需要修改下面的pid=`ps -ef |grep java-tron.jar |grep -v grep |awk '{print $2}'`来找到正确的进程号。
```
#!/bin/bash
count=1
while [ $count -le 60 ]; do
  pid=`ps -ef |grep java-tron.jar |grep -v grep |awk '{print $2}'`
  if [ -n "$pid" ]; then
    kill -15 $pid
    echo "kill -15 java-tron, counter $count"
    sleep 1
  else
    echo "java-tron killed"
    break
  fi
  count=$[$count+1]
  if [ $count -ge 60 ]; then
    kill -9 $pid
  fi
done
```

