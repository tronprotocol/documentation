# 在一台主机上同时部署SolidityNode和FullNode

+ 对于fullnode和soliditynode，分别创建两个目录

      /deploy
      /fullnode
      /deploy/soliditynode

+ 对fullnode和soliditynode分别进入两个文件夹，然后执行以下操作：
 
  ## FullNode 部署方案：

        cd /deploy/fullnode
        git clone https://github.com/tronprotocol/java-tron
        cd java-tron/
        ./gradlew build
        cp build/libs/FullNode.jar ../
        cp src/main/resources/config.conf ../
        cd ..

    然后就可以启动FullNode了：  
            
            nohup java -jar FullNode.jar -c config.conf &
            
  ## SolidityNode部署方案
 
        cd /Users/huzhenyuan/deploy/SolidityNode
        git clone https://github.com/tronprotocol/java-tron
        cd java-tron/
        ./gradlew build
        cp build/libs/SolidityNode.jar ../
        cp src/main/resources/config.conf ../
        cd ..
 
     为了避免和`FullNode`端口冲突，和连接本地的`FullNode`，需要打开`config.conf`。把`node`里面的`trustNode`修改为本地`127.0.0.1:50051`。把`listen.port`修改为18888以外的数字，需要主要的是端口的设置范围是1024-65525，端口0-0124是禁用的，像这样：
 
            node {
             # trust node for solidity node
             # trustNode = "ip:port"
            trustNode = "127.0.0.1:50051"
            listen.port = 18889 //需要设置的端口
 
    然后就可以启动SolidityNode了：
        
            nohup java -jar SolidityNode.jar -c config.conf &
    
 ## 日志和网络连接的验证
    fullnode和soliditynode对应的日志在目录`/deploy/\*/logs/tron.log`，可以通过命令`tail -f /logs/tron.log/`去查看bolck同步的情况。日志大致如下：
 ### FullNode
     12:00:57.658 INFO  [pool-7-thread-1] [o.t.c.n.n.NodeImpl](NodeImpl.java:830) Success handle block Num:236610,ID:0000000000039c427569efa27cc2493c1fff243cc1515aa6665c617c45d2e1bf
 ### SolidityNode
     12:00:40.691 INFO  [pool-17-thread-1] [o.t.p.SolidityNode](SolidityNode.java:88) sync solidity block, lastSolidityBlockNum:209671, remoteLastSolidityBlockNum:211823 
