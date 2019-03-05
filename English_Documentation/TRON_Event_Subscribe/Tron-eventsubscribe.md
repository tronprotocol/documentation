# Tron event subscribe support 
## 1.  Background
TRON has implemented the event subscription mechanism to support developer community, we have finished the testing. The featured has been released on version 3.5 of Java-tron, and developers could start experiencing now.


## 2.  New features
1. Supporting event plug-ins, kafka & mongodb plug-ins have been released, developers can also customize their own plug-ins according to their own needs.

2. Supporting subscription of chain data, such as block, transaction, contract log, contract event and so on. For transaction events, developers can get information such as internal transactions, contract info and so on; for contract events, developers could configure the contract addresses list or contract topic list to receive the specified events, and event subscription has a very low latency. The deployed fullnode can receive event information immediately after the contract is executed.

3. Event query service tron-eventquery, online Event query service provided. Developers can query trigger information in the last seven days through https, and the query address is https://api.tronex.io.

## 3. github project
- [java-tron](https://github.com/tronprotocol/java-tron) master branch 
- [eventplugin](https://github.com/tronprotocol/event-plugin) master branch
- [tron-eventquery](https://github.com/tronprotocol/tron-eventquery) master branch

## 4. event subscribe
- TIP: https://github.com/tronprotocol/TIPs/issues/12
- Description: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/Tron-event_description.md

## 5. event plugin
- kafka plugin: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/eventplugin_deploy.md

- mongodb plugin: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/mongodb_deploy.md

## 6. tron-eventquery
### Deploy
- https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/tron-eventquery_deploy.md
### Http API
- https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/tron-eventquery.md
