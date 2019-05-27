# 波场事件订阅机制
## 1.  项目背景
为了更好支持开发者社区，波场正式推出事件订阅机制，在3.5版本中已经上线,开发者目前可进行新功能体验。

## 2.  主要功能：
1. 事件plugin的支持，目前已支持kafka、mongodb两种插件，开发者也可以根据自己的需求定制自己的事件插件。
2. 支持block、transaction、contract log、contract event等链上数据的订阅。对于transaction event，开发者可以获取internal transaction、contract等信息；对于contract event，开发者可以配置contract address列表或者contract topic列表，只接收自己感兴趣的events，并且event订阅具有较低的时延，fullnode执行合约后便可以收到event信息。
3. 事件查询服务tron-eventquery，波场提供的线上Event查询服务，开发者可通过http方式查询最近七天的trigger信息，查询地址为: https://api.tronex.io。

## 3. github项目
- [java-tron](https://github.com/tronprotocol/java-tron) master分支
- [eventplugin](https://github.com/tronprotocol/event-plugin) master分支
- [tron-eventquery](https://github.com/tronprotocol/tron-eventquery) master分支

## 4. event subscribe
- https://github.com/tronprotocol/TIPs/issues/12

## 5. event plugin
- kafka plugin: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/eventplugin_deploy.md

- mongodb plugin: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/mongodb_deploy.md

## 6. tron-eventquery
### Deploy
- https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/tron-eventquery_deploy.md
### Http API
- https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Event_Subscribe/tron-eventquery.md
