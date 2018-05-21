# Deployment of SolidityNode and FullNode on the same host

+ Create new directory

      /Users/huzhenyuan/deploy
      /Users/huzhenyuan/deploy/FullNode
      /Users/huzhenyuan/deploy/SolidityNode

+ Create two folders for FullNode and SolidityNode respectively and execute the following operations:
 
    **FullNode**：

        cd /Users/huzhenyuan/deploy/FullNode
        git clone https://github.com/tronprotocol/java-tron
        cd java-tron/
        ./gradlew build
        cp build/libs/java-tron.jar ../
        cpsrc/main/resources/config.conf ../
        cd ..

    In order to quickly discover the nodes deployed by TRON, `config.conf` needs to be opened. Copy the list of addresses contained in `ip.list` in `seed.node` to `active` of `node`.
       
     as follows：
   
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
    Then FullNode can be switched on:  
            
            nohupjava -jar java-tron.jar -c config.conf&
            
    **SolidityNode**
 
        cd /Users/huzhenyuan/deploy/SolidityNode
        git clone https://github.com/tronprotocol/java-tron
        cd java-tron/
        ./gradlew shadowJar -PmainClass=org.tron.program.SolidityNode
        cp build/libs/java-tron.jar ../
        cpsrc/main/resources/config.conf ../
        cd ..
 
     `config.conf` is required to be executed in order to avoid conflicts with `FullNode` interface and connect local `FullNode`. Change  `trustNode` in `node` to local `127.0.0.1:50051`. Set 'listen.port' to any whole number within the range of 1024-65535. It is suggested to not use the numbers from 0-1024.
     as follows:
 
            node {
             # trust node for solidity node
             # trustNode = "ip:port"
            trustNode = "127.0.0.1:50051"
            listen.port = 18889
 
    Then SolidityNode can be switched on：
        
            nohup java -jar java-tron.jar -c config.conf&