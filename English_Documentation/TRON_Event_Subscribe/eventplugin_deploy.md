## Tron event subscribe plugin
This is an implementation of Tron event subscribe model.

- api module defines IPluginEventListener, a protocol between Java-tron and event plugin. 
- app module is an example for loading plugin, developers could use it for debugging.
- kafkaplugin module is the implementation for kafka, it implements IPluginEventListener, it receives events subscribed from Java-tron and relay events to kafka server. 
- mongodbplugin module is the implementation for mongodb. 

### Setup/Build
- git clone https://github.com/tronprotocol/event-plugin.git
- cd eventplugin
- ./gradlew build

Currently, we support two kinds of event plugins, kafka and mongodb. The build command will produced plugin-kafka-1.0.0.zip, plugin-mongodb-1.0.0.zip,  which are located in the **eventplugin/build/plugins/** directory.

Edit config.conf of Java-tron， add the following fileds:
event.subscribe = 
{
    path= "/Users/tron/sourcecode/eventplugin/build/plugins/plugin-kafka-1.0.0..zip" // absolute path of event plugin
    server = "127.0.0.1:9092" // target server address to receive event triggers
    dbconfig="" //dbname|username|passwordformongodb plugin

    topics = [
    {
      triggerName = "block"
      enable = false
      topic = "block"
    },
    {
      triggerName = "transaction"
      enable = false
      topic = "transaction"
    },
    {
      triggerName = "contractevent"
      enable = true
      topic = "contractevent"
    },
    {
      triggerName = "contractlog"
      enable = true
      topic = "contractlog"
    }
    ]
}

- **path**: is the absolute path of "plugin-kafka-1.0.0.zip" or "plugin-mongodb-1.0.0.zip"
- **server**: Kafka server address or mongodb server address 
- **dbconfig**: this is mongodb configuration, assign it to "" for kafka plugin 
- **topics**: each event type maps to one Kafka topic, we support four event types subscribing, block, transaction, contract log and contract event.
- **triggerName**: the trigger type, the value can't be modified.
- **enable**: plugin can receive nothing if the value is false.
- **topic**: the value is the kafka topic or mongodb collection to receive events. Make sure it has been created and Kafka process is running

### Install Kafka
**Note**:

Make sure the version of Kafka is the same as the version set in build.gradleof eventplugin project.(The specified version is: kafka_2.10-0.10.2.2)

#### On Mac:

> - brew install kafka

#### On Linux:

> - cd /usr/local
> 
> - wget http://archive.apache.org/dist/kafka/0.10.2.2/kafka_2.10-0.10.2.2.tgz
> 
> - tar -xzvf kafka_2.10-0.10.2.2.tgz
> 
> - mv kafka_2.10-0.10.2.2 kafka

edit /etc/profile, add "export PATH=$PATH:/usr/local/kafka/bin" to end of /etc/profile 

> source /etc/profile

### Run Kafka
#### On Mac:

> zookeeper-server-start /usr/local/etc/kafka/zookeeper.properties & -
> kafka-server-start /usr/local/etc/kafka/server.properties

#### On Linux:

> zookeeper-server-start.sh /usr/local/kafka/config/zookeeper.properties
> &

Sleep about 3 seconds

> kafka-server-start.sh /usr/local/kafka/config/server.properties &

Create topics to receive events, the topic is defined in config.conf
#### On Mac:
- kafka-topics --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic block 
- kafka-topics --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic transaction 
- kafka-topics --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic contractlog 
- kafka-topics --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic contractevent

#### On Linux:
- kafka-topics.sh --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic block 
- kafka-topics.sh --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic transaction 
- kafka-topics.sh --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic contractlog 
- kafka-topics.sh --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic contractevent

### Kafka consumer
#### On Mac:
- kafka-console-consumer --bootstrap-server localhost:9092 --topic block
- kafka-console-consumer --bootstrap-server localhost:9092 --topic transaction
- kafka-console-consumer --bootstrap-server localhost:9092 --topic contractlog
- kafka-console-consumer --bootstrap-server localhost:9092 --topic contractevent

#### On Linux:
- kafka-console-consumer.sh --zookeeper localhost:2181 --topic block
- kafka-console-consumer.sh --zookeeper localhost:2181 --topic transaction
- kafka-console-consumer.sh --zookeeper localhost:2181 --topic contractlog
- kafka-console-consumer.sh --zookeeper localhost:2181 --topic contractevent

### Load plugin in Java-tron
add--estocommand line, for example:

>  java -jar FullNode.jar -p privatekey -c config.conf --es

Check plugin logs:

> tail -f logs/tron.log |grep -i eventplugin

For example, if plugin is loaded, you will see the output like this

> [o.t.c.l.EventPluginLoader](EventPluginLoader.java:194) 'your plugin
> path/plugin-kafka-1.0.0.zip' loaded

If there is no kafka or mongodb related exception, the plugin is loaded successfully. Otherwise please check whether your configuration is correct.

**Note**: We should make sure kafka or mongodb is launched successfully before launching FullNode, and the configuration is configured correctly, otherwise eventplugin will not work.

### Event filter
which is defined in config.conf, the path is: event.subscribe

filter = {
       fromblock = "" // the value could be "", "earliest" or a specified block number as the beginning of the queried range
       toblock = "" // the value could be "", "latest" or a specified block number as end of the queried range
       contractAddress = [
           "TVkNuE1BYxECWq85d8UR9zsv6WppBns9iH" // contract address you want to subscribe, if it's set to "", you will receive contract logs/events with any contract address.
       ]

       contractTopic = [
           "f0f1e23ddce8a520eaa7502e02fa767cb24152e9a86a4bf02529637c4e57504b" // contract topic you want to subscribe, if it's set to "", you will receive contract logs/events with any contract topic.
       ]
    }