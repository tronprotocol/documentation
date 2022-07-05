# Deployment of SolidityNode and FullNode on the same host

Create separate directories for fullnode and soliditynode
```
    /deploy/fullnode
    /deploy/soliditynode
```

Create two folders for fullnode and soliditynode.

Clone our latest master branch of https://github.com/tronprotocol/java-tron and extract it to
```      
    /deploy/java-tron 
```

Make sure you have the proper dependencies.

* JDK 1.8 (JDK 1.9+ is not supported yet)
* On Linux Ubuntu system (e.g. Ubuntu 16.04.4 LTS), ensure that the machine has [__Oracle JDK 8__](https://www.digitalocean.com/community/tutorials/how-to-install-java-with-apt-get-on-ubuntu-16-04), instead of having __Open JDK 8__ in the system. If you are building the source code by using __Open JDK 8__, you will get [__Build Failed__](https://github.com/tronprotocol/java-tron/issues/337) result.
* Open **UDP** ports for connection to the network
* **MINIMUM** 2 CPU Cores

## Deployment guide

  1. Build the java-tron project
```
    cd /deploy/java-tron 
    ./gradlew build
```

  2. Copy the FullNode.jar and SolidityNode.jar along with config files into the respective directories.
```
    download your needed config file from https://github.com/tronprotocol/TronDeployment.
    main_net_config.conf is the config for mainnet, and test_net_config.conf is the config for testnet.
    please rename the config file to `config.conf` and use this config.conf to start fullnode and soliditynode.

    cp build/libs/FullNode.jar ../fullnode
    cp build/libs/SolidityNode.jar ../soliditynode
```

  3. You can now run your Fullnode using the following command：
```
      java -jar FullNode.jar -c config.conf // make sure that your config.conf is downloaded from https://github.com/tronprotocol/TronDeployment
```

  4. Configure the SolidityNode configuration file. You'll need to edit `config.conf` to connect to your local `FullNode`. Change  `trustNode` in `node` to local `127.0.0.1:50051`, which is the default rpc port. Set `listen.port` to any number within the range of 1024-65535. Please don't use any ports between 0-1024 since you'll most likely hit conflicts with other system services. Also change `rpc port` to `50052` or something to avoid conflicts. **Please forward the UDP port 18888 for FullNode.**
```
    rpc {
      port = 50052
    }
```

  5. You can now run your SolidityNode using the following command：
```        
    java -jar SolidityNode.jar -c config.conf //make sure that your config.conf is downloaded from https://github.com/tronprotocol/TronDeployment
```

# Logging and network connection verification

Logs for both nodes are located in `/deploy/\*/logs/tron.log`. Use `tail -f /logs/tron.log/` to follow along with the block syncing.

You should see something similar to this in your logs for block synchronization:

## FullNode

      00:01:14.073 INFO  [nioEventLoopGroup-6-28] [o.t.c.n.TronNetDelegate](TronNetDelegate.java:176) Success process block Num:9171046,ID:00000000008bf06616a0895f515a91fda077e2c7c762b902f2e84414d536ca39.

## SolidityNode

      20:06:10.866 INFO  [Thread-14] [app](SolidityNode.java:142) Get last remote solid blockNum: 0, remoteBlockNum: 0, cost: 4
      
# Stop node gracefully
Create file stop.sh，use kill -15 to close java-tron.jar（or FullNode.jar、SolidityNode.jar）.
You need to modify pid=`ps -ef |grep java-tron.jar |grep -v grep |awk '{print $2}'` to find the correct pid.
```
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
```
