# Deployment of SolidityNode and FullNode on the same host

Create separate directories for fullnode and soliditynode

    /deploy
    /deploy/fullnode
    /deploy/soliditynode

Create two folders for fullnode and soliditynode.

Download our latest release https://github.com/tronprotocol/java-tron/releases and extract it to
      
    /deploy/java-tron 
 
## Deployment guide

  1. Make sure you have the proper dependencies.
```
    JDK 1.8 (JDK 1.9+ is not supported yet)

    On Linux Ubuntu system (e.g. Ubuntu 16.04.4 LTS), ensure that the machine has [__Oracle JDK 8__](https://www.digitalocean.com/community/tutorials/how-to-install-java-with-apt-get-on-ubuntu-16-04), instead of having __Open JDK 8__ in the system. If you are building the source code by using __Open JDK 8__, you will get [__Build Failed__](https://github.com/tronprotocol/java-tron/issues/337) result.
```

  2. Build the java-tron project
```
      cd /deploy/java-tron 
      ./gradlew build
```

  3. Copy the FullNode.jar and SolidityNode.jar along with config files into the respective directories.
```
      cp build/libs/FullNode.jar ../fullnode
      cp src/main/resources/config.conf ../

      cp build/libs/SolidityNode.jar ../soliditynode
      cp src/main/resources/config.conf ../fullnode
```

  4. Configure the FullNode configuration file. Please edit `config.conf` and copy the list of addresses contained in `ip.list` in `seed.node` to `active` of `node`.
```       
      active = [  
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
```  

  5. You can now run your Fullnode using the following command：
```
      java -jar FullNode.jar -c config.conf
```

  6. Configure the SolidityNode configuration file. You'll need to edit `config.conf` to connect to your local `FullNode`. Change  `trustNode` in `node` to local `127.0.0.1:50051`, which is the default rpc port. Set `listen.port` to any number within the range of 1024-65535. Also change the `rpc port` to something other than `50051`. Please don't use any ports between 0-1024 since you'll most likely hit conflicts with other system services.
```
      node {
          trustNode = "127.0.0.1:50051"
          listen.port = 18889 // This needs to be changed.
          }
      
      rpc {
          port = 50052
          }
```

  7. You can now run your SolidityNode using the following command：
```        
      java -jar SolidityNode.jar -c config.conf
```

# Logging and network connection verification

Logs for both nodes are located in `/deploy/\*/logs/tron.log`. Use `tail -f /logs/tron.log/` to follow along with the block syncing.

You should see something similar to this in your logs for block synchronization:

## FullNode

      12:00:57.658 INFO  [pool-7-thread-1] [o.t.c.n.n.NodeImpl](NodeImpl.java:830) Success handle block Num:236610,ID:0000000000039c427569efa27cc2493c1fff243cc1515aa6665c617c45d2e1bf

## SolidityNode

      12:00:40.691 INFO  [pool-17-thread-1] [o.t.p.SolidityNode](SolidityNode.java:88) sync solidity block, lastSolidityBlockNum:209671, remoteLastSolidityBlockNum:211823



