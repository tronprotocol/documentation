

> Trigger 类别

可支持订阅的Event类型：

 - transactionTrigger:  transaction事件，区块时触发
 - blockTrigger: 区块事件，提交区块时触发
 - contractLogTrigger: 智能合约日志
 - contractEventTrigger:智能合约事件


> Filter定义

只针对智能合约日志、事件的订阅，具体包括如下字段：

fromBlock: 起始区块高度，可以设置为"", "earliest"或者具体的区块高度。
toBlock: 结束区块高度，可以设置为""，"latest"或者具体的区块高度。
contractAddress：智能合约地址列表
contractTopics：智能合约主题列表
**注意**: 不支持历史数据查询。


> 交易Log

交易信息用TransactionLogTrigger表示，包括如下参数:

 - transactionId, transaction哈希 
 - blockHash, 交易发生的区块hash 
 - blockNumber,交易发生的block number 
 - energyUsage, 能量使用 
 - energyFee，能量费用 
 - originEnergyUsage origin energy usage 
 - energyUsageTotal, total energy usage total


> 智能合约Log

智能合约日志对象用ContractLogTrigger表示，包括如下参数：

 - transactionId, transaction id 
 - contractAddress:  合约地址 
 - callerAddress:合约调用者地址 
 - blockNumber: 交易所在的块号 
 - blockTimestamp: 交易所在块的打包时间
 - contractTopics: Solidity 语言中 Log 能够输出的 topic 列表 
 - data: Solidity 语言中,Log 能够输出的 data
 - removed，如果日志已被删除则为true，有效日志则为false


> 智能合约Event

 - transactionId, transaction id 
 - contractAddress:  合约地址 
 - callerAddress:合约调用者地址 
 - blockNumber: 交易所在的块号 
 - blockTimestamp: 交易所在块的打包时间
 - eventSignature: Event 的签名字符串
 - topicMap: Solidity 语言中 Event 能够输出的 topic名称 => topic 值的映射
 - data: Solidity 语言中, Event 能够输出的 data 字段
 - removed，如果日志已被删除则为true，有效日志则为false


> Trigger触发

 - 区块事件的触发，区块插入时创建blockTrigger
 - 交易事件的触发，交易执行之前创建transactionTrigger
 - 智能合约日志的触发，在合约执行并且解析之后创建contractLogTrigger
 - 智能合约事件的触发，在合约执行并且解析之后创建contractEventTrigger


> Trigger发送

java-tron以异步方式将Trigger发送给插件，Trigger必须满足Filter的条件。

如下所示是一个Filter，Trigger的blockNumber必须在fromBlock与toBlock之间，contractAddresses必须是addressA，topics必须包括topicA，只有满足条件的Trigger才会被发送。

fromBlock: 0x1000000

toBlock: 0x1200000

contractAddresses: "addressA"

contractTopics: "TopicA"

