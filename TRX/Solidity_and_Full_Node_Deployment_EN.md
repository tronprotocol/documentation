# 在一台主机上同时部署SolidityNode和FullNode

+ 新建目录

      /Users/huzhenyuan/deploy
      /Users/huzhenyuan/deploy/FullNode
      /Users/huzhenyuan/deploy/SolidityNode

+ 对FullNode和SolidityNode分别进入两个文件夹，然后执行以下操作：
 
    **FullNode**：

        cd /Users/huzhenyuan/deploy/FullNode
        git clone https://github.com/tronprotocol/java-tron
        cd java-tron/
        ./gradlew build
        cp build/libs/java-tron.jar ../
        cpsrc/main/resources/config.conf ../
        cd ..

    为了能够快速的发现由Tron部署的节点，需要打开`config.conf`。把`seed.node`里面的`ip.list`中包含的地址列表复制到`node`的`active`中，像这样：  
    
            active = [  
                # Initial active peers   
               # Sample entries:   
               # "ip:port",   
               # "ip:port" 
            "47.254.16.55:18888", 
            "47.254.18.49:18888", 
            "18.188.111.53:18888",
             "54.219.41.56:18888", 
            "35.169.113.187:18888", 
            "34.214.241.188:18888", 
            "47.254.146.147:18888", 
            "47.254.144.25:18888", 
            "47.91.246.252:18888", 
            "47.91.216.69:18888",  
            "39.106.220.120:18888"   
            ]  
    然后就可以启动FullNode了：  
            
            nohupjava -jar java-tron.jar -c config.conf&
            
    **SolidityNode**
 
        cd /Users/huzhenyuan/deploy/SolidityNode
        git clone https://github.com/tronprotocol/java-tron
        cd java-tron/
        ./gradlewshadowJar -PmainClass=org.tron.program.SolidityNode
        cp build/libs/java-tron.jar ../
        cpsrc/main/resources/config.conf ../
        cd ..
 
     为了避免和`FullNode`端口冲突，和连接本地的`FullNode`，需要打开`config.conf`。把`node`里面的`trustNode`修改为本地`127.0.0.1:50051`。把`listen.port`修改为18888以外的数字，像这样：
 
            node {
             # trust node for solidity node
             # trustNode = "ip:port"
            trustNode = "127.0.0.1:50051"
            listen.port = 18889
 
    然后就可以启动SolidityNode了：
        
            nohup java -jar java-tron.jar -c config.conf&