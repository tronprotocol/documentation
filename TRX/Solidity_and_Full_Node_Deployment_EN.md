# Deployment of SolidityNode and FullNode on the same host

Create separate directories for fullnode and soliditynode

      /deploy
      /deploy/fullnode
      /deploy/soliditynode

Create two folders for fullnode and soliditynode respectively and execute the following operations:
 
    **FullNode**：

        cd /deploy/fullnode
        git clone https://github.com/tronprotocol/java-tron
        cd java-tron/
        ./gradlew build
        cp build/libs/java-tron.jar ../
        cp src/main/resources/config.conf ../
        cd ..

In order to quickly sync to the TRON network, please edit `config.conf`. Copy the list of addresses contained in `ip.list` in `seed.node` to `active` of `node`.
       
     Example：
   
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
You can now run your Fullnode using the following command：
            
            java -jar FullNode.jar -c config.conf
            
    **SolidityNode**
 
        cd /deploy/SolidityNode
        git clone https://github.com/tronprotocol/java-tron
        cd java-tron/
        ./gradlew build
        cp build/libs/SolidityNode.jar ../
        cp src/main/resources/config.conf ../
        cd ..
 
You'll need to edit `config.conf` to connect to your local `FullNode`. Change  `trustNode` in `node` to local `127.0.0.1:50051`, which is the default rpc port. Set `listen.port` to any number within the range of 1024-65535. Please don't use any ports between 0-1024 since you'll most likely hit conflicts with other system services. Also change the `rpc port` to something other than `50051`.

     Example:
 
            node {
             # trust node for solidity node
             # trustNode = "ip:port"
            trustNode = "127.0.0.1:50051"
            listen.port = 18889 // This needs to be changed.
            }
            
            rpc {
                  port = 50052
                  }
 
You can now run your SolidityNode using the following command：
        
            java -jar SolidityNode.jar -c config.conf


Logs for both nodes are located in `/deploy/\*/logs/tron.log`. Use `tail -f /logs/tron.log/` to follow along with the block syncing.
