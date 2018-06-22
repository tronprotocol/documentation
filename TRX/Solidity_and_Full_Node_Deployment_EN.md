# Deployment of SolidityNode and FullNode on the same host

Create separate directories for fullnode and soliditynode
```
    /deploy
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

## Deployment guide

  1. Build the java-tron project
```
    cd /deploy/java-tron 
    ./gradlew build
```

  2. Copy the FullNode.jar and SolidityNode.jar along with config files into the respective directories.
```
    cp build/libs/FullNode.jar ../fullnode
    cp src/main/resources/config.conf ../fullnode

    cp build/libs/SolidityNode.jar ../soliditynode
    cp src/main/resources/config.conf ../soliditynode
```

  3. You can now run your Fullnode using the following command：
```
      java -jar FullNode.jar -c config.conf
```

  4. Configure the SolidityNode configuration file. You'll need to edit `config.conf` to connect to your local `FullNode`. Change  `trustNode` in `node` to local `127.0.0.1:50051`, which is the default rpc port. Set `listen.port` to any number within the range of 1024-65535. Please don't use any ports between 0-1024 since you'll most likely hit conflicts with other system services. Also change `rpc port` to `50052` or something to avoid conflicts.
```
    node {
        trustNode = "127.0.0.1:50051"
        listen.port = 18889 // This needs to be changed.
    }
    rpc {
      port = 50052
    }
```

  5. You can now run your SolidityNode using the following command：
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

# Stop node gracefully
Create file stop.sh，use kill -15 to close java-tron.jar（or FullNode.jar、SolidityNode.jar）.
You need to modify pid=`ps -ef |grep java-tron.jar |grep -v grep |awk '{print $2}'` to find the correct pid.
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

