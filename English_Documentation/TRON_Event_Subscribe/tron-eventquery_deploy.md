###  Tron Event Query Service
TronEventQuery is implemented with Tron's new event subscribe model. It uses same query interface with Tron-Grid. Users can also subscribe block trigger, transaction trigger, contract log trigger, and contract event trigger. TronEvent is independent of a particular branch of java-tron, the new event subscribes model will be released on version 3.5 of java-tron.

For more information of tron event subscribe model, please refer to https://github.com/tronprotocol/TIPs/issues/12.

## Download sourcecode
git clone https://github.com/tronprotocol/tron-eventquery.git
cd troneventquery

## Build
- mvn package

After the build command is executed successfully, troneventquery jar to release will be generated under troneventquery/target directory. 

Configuration of mongodb "config.conf" should be created for storing mongodb configuration, such as database name, username, password, and so on. We provided an example in sourcecode, which is " troneventquery/config.conf ". Replace with your specified configuration if needed.

**Note**: 
Make sure the relative path of config.conf and troneventquery jar. The config.conf 's path is the parent of troneventquery jar.

 - mongo.host=IP 
 - mongo.port=27017 
 - mongo.dbname=eventlog
 - mongo.username=tron
 - mongo.password=123456
 - mongo.connectionsPerHost=8
 - mongo.threadsAllowedToBlockForConnectionMultiplier=4

Any configuration could be modified except **mongo.dbname**, "**eventlog**" is the specified database name for event subscribe.

## Run
- troneventquery/deploy.sh is used to deploy troneventquery
- troneventquery/insertIndex.sh is used to setup mongodb index to speedup query.