# SolidityNode and FullNode Deployment on The Same Host

Create separate directories for fullnode and soliditynode
```text
/deploy/fullnode
/deploy/soliditynode
```

Create two folders for fullnode and soliditynode.

Clone the latest master branch of [https://github.com/tronprotocol/java-tron](https://github.com/tronprotocol/java-tron) and extract it to
```text      
/deploy/java-tron 
```

Make sure you have the proper dependencies.

* JDK 1.8 (JDK 1.9+ is not supported yet)
* On Linux Ubuntu system (e.g. Ubuntu 16.04.4 LTS), ensure that the machine has [__Oracle JDK 8__](https://www.digitalocean.com/community/tutorials/how-to-install-java-with-apt-get-on-ubuntu-16-04), instead of having __Open JDK 8__ in the system. If you are building the source code by using __Open JDK 8__, you will get [__Build Failed__](https://github.com/tronprotocol/java-tron/issues/337) result.
* Open **UDP** ports for connection to the network
* **MINIMUM** 2 CPU Cores

## Deployment Guide

1.&nbsp;Build the java-tron project  
```text
cd /deploy/java-tron 
./gradlew build
```

2.&nbsp;Copy the FullNode.jar and SolidityNode.jar along with configuration files into the respective directories
```text
download your needed configuration file from https://github.com/tronprotocol/TronDeployment.  

main_net_config.conf is the configuration for MainNet, and test_net_config.conf is the configuration for TestNet.  

please rename the configuration file to `config.conf` and use this config.conf to start FullNode and SoliditNode.  

cp build/libs/FullNode.jar ../fullnode  

cp build/libs/SolidityNode.jar ../soliditynode
```

3.&nbsp;You can now run your FullNode using the following command
```text
java -jar FullNode.jar -c config.conf // make sure that your config.conf is downloaded from https://github.com/tronprotocol/TronDeployment
```

4.&nbsp;Configure the SolidityNode configuration file  

You need to edit `config.conf` to connect to your local FullNode. Change  `trustNode` in `node` to local `127.0.0.1:50051`, which is the default rpc port. Set `listen.port` to any number within the range of 1024-65535. Please don't use any ports between 0-1024 since you'll most likely hit conflicts with other system services. Also change `rpc port` to `50052` or something to avoid conflicts. **Please forward the UDP port 18888 for FullNode.**
```text
rpc {
      port = 50052
    }
```

5.&nbsp;You can now run your SolidityNode using the following command：
```text        
java -jar SolidityNode.jar -c config.conf //make sure that your config.conf is downloaded from https://github.com/tronprotocol/TronDeployment
```

# Logging and Network Connection Verification

Logs for both nodes are located in `/deploy/\*/logs/tron.log`. Use `tail -f /logs/tron.log/` to follow along with the block syncing.

You should see something similar to this in your logs for block synchronization:

**FullNode**
```text
12:00:57.658 INFO  [pool-7-thread-1] [o.t.c.n.n.NodeImpl](NodeImpl.java:830) Success handle block Num:236610,ID:0000000000039c427569efa27cc2493c1fff243cc1515aa6665c617c45d2e1bf
```
**SolidityNode**
```text
12:00:40.691 INFO  [pool-17-thread-1] [o.t.p.SolidityNode](SolidityNode.java:88) sync solidity block, lastSolidityBlockNum:209671, remoteLastSolidityBlockNum:211823
```
# Stop Node Gracefully
Create file stop.sh，use kill -15 to close java-tron.jar（or FullNode.jar、SolidityNode.jar）.
You need to modify pid=`ps -ef |grep java-tron.jar |grep -v grep |awk '{print $2}'` to find the correct pid.
```text
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
