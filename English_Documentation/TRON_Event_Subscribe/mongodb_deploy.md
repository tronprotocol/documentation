## Suggested Configuration
- CPU/ RAM: 16Core / 32G	
- DISK: 500G	
- System: CentOS 64

## Download and install MongoDB
The version of MongoDB is **4.0.4**, below is the command:

- cd /home/java-tron
- curl -O https://fastdl.mongodb.org/linux/mongodb-linux-x86_64-4.0.4.tgz
- tar zxvf mongodb-linux-x86_64-4.0.4.tgz
- mv mongodb-linux-x86_64-4.0.4 mongodb

### Set environment
- export MONGOPATH=/home/java-tron/mongodb/
- export PATH=$PATH:$MONGOPATH/bin

### Create mongodb config
The path is : /etc/mongodb/mgdb.conf

- cd /etc/mongodb
- touch mgdb.conf

Create data&log folder for mongodb
Create data, log subfolder in mongodb directory,  and add their absolute path to mgdb.conf

#### Example：
- dbpath=/home/java-tron/mongodb/data
- logpath=/home/java-tron/mongodb/log/mongodb.log
- port=27017
- logappend=true
- fork=true
- bind_ip=0.0.0.0
- auth=true
- wiredTigerCacheSizeGB=2

#### Note:
- bind_ip must be configured to 0.0.0.0，otherwise remote connection will be refused.
- wiredTigerCacheSizeGB, must be configured to prevent OOM

## Launch MongoDB
  - mongod  --config /etc/mongodb/mgdb.conf
### Create admin account：
- mongo
- use admin
- db.createUser({user:"root",pwd:"admin",roles:[{role:"root",db:"admin"}]})

### Create eventlog and its owner account
- db.auth("root", "admin")
- use eventlog
- db.createUser({user:"tron",pwd:"123456",roles:[{role:"dbOwner",db:"eventlog"}]})

> database: eventlog，username:tron, password: 123456

### Firewall rule:
- iptables -A INPUT -p tcp -m state --state NEW -m tcp --dport 27017 -j ACCEPT

#### Remote connection via mongo：
- mongo 47.90.245.68:27017
- use eventlog
- db.auth("tron", "123456")
- show collections
- db.block.find()

#### Query block trigger data：
-  db.block.find({blockNumber: {$lt: 1000}});  // return records whose blockNumber less than1000

#### Set database index to speedup query：
cd /{projectPath}   
sh insertIndex.sh
