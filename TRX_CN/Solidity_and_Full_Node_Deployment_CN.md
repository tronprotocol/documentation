# 在一台主机上同时部署SolidityNode和FullNode

1.	构建java-tron项目
    
    cd /deploy/java-tron 
    ./gradlew build

2.	将FullNode.jar、SolidityNode.jar以及配置文件复制到相应目录。
    
    download your needed config file from https://github.com/tronprotocol/TronDeployment.
    main_net_config.conf is the config for mainnet, and test_net_config.conf is the config for testnet.
    please rename the config file to `config.conf` and use this config.conf to start fullnode and soliditynode.

    cp build/libs/FullNode.jar ../fullnode
    cp build/libs/SolidityNode.jar ../soliditynode

3.	现在可以使用以下命令运行Fullnode
      
    java -jar FullNode.jar -c config.conf // make sure that your config.conf is downloaded from https://github.com/tronprotocol/TronDeployment

4.	设置SolidityNode配置文件，修改config.conf以连接本地Fullnode。将node中的trustnode修改为本地的默认rpc端口127.0.0.1:50051。将listen.port设置为1024-65535中的任一数字，禁用0-1024间的数字，否则可能会和其他系统服务产生冲突。将rpc port改为50052或其他数字，避免冲突。
    
    node {
        trustNode = "127.0.0.1:50051"
        listen.port = 18889 // This needs to be changed.
    }
    rpc {
      port = 50052
    }

5.	使用以下命令运行SolidityNode:
	    
	java -jar SolidityNode.jar -c config.conf //make sure that your config.conf is downloaded from https://github.com/tronprotocol/TronDeployment

# 日志和网络连接的验证
    
    fullnode和soliditynode对应的日志在目录`/deploy/\*/logs/tron.log`，可以通过命令`tail -f /logs/tron.log/`去查看block同步的情况。日志大致如下：

## FullNode
 
    12:00:57.658 INFO  [pool-7-thread-1] [o.t.c.n.n.NodeImpl](NodeImpl.java:830) Success handle block Num:236610,ID:0000000000039c427569efa27cc2493c1fff243cc1515aa6665c617c45d2e1bf

## SolidityNode

    12:00:40.691 INFO  [pool-17-thread-1] [o.t.p.SolidityNode](SolidityNode.java:88) sync solidity block, lastSolidityBlockNum:209671, remoteLastSolidityBlockNum:211823 

# 正确的停止节点

新建stop.sh，用kill -15关闭java-tron.jar（或者FullNode.jar、SolidityNode.jar）相关进程。 你需要修改下面的pid=ps -ef |grep java-tron.jar |grep -v grep |awk '{print $2}'来找到正确的进程号。

    #!/bin/bash
    while true; do
      pid=`ps -ef |grep java-tron.jar |grep -v grep |awk '{print $2}'`
      if [ -n "$pid" ]; then
        kill -15 $pid
        echo "The java-tron process is exiting, it may take some time, forcing the exit may cause damage to the database, please wait patiently..."
        sleep 1
      else
        echo "java-tron killed successfully!"
        break
      fi
    done



