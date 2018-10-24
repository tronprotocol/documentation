# TRON公链文档

# 1 项目仓库
仓库地址：https://github.com/tronprotocol
其中 java-tron是主网代码，protocol是api和数据结构定义。wallet-cli是官方命令行钱包。
配置文件：
testnet的配置请参照https://github.com/tronprotocol/TronDeployment/blob/master/test_net_config.conf
mainnet的配置请参考https://github.com/tronprotocol/TronDeployment/blob/master/main_net_config.conf

# 2 Tron超级代表与委员会

## 2.1 申请成为超级代表候选人规则

 在TRON网络中，任何账户都可以申请成为超级代表候选人，都有机会成为超级代表。每个账户都可以投票给超级代表候选人，获取投票数最高的27个超级代表候选人就是超级代表。就具有出链块的权利。
 投票统计每6小时统计一次，超级代表也就每6个小时变更一次。

 为了防止恶意攻击，成为超级代表候选人也需要一定代价的。TRON网络将直接烧掉申请者账户9999TRX。申请成功后，您就可以竞选超级代表了。

## 2.2 选举超级代表

 投票需要TRON Power(TP)，你的TRON Power(TP)的多少由当前冻结资金决定。TRON Power(TP)的计算方法：每冻结1TRX，就可以获得1单位TRON Power(TP)。
 
 TRON网络中的每一个账户都具有选举权，可以通过投票选出自己认同的超级代表了。

 在解冻后，你没有了冻结的资产，相应地失去了所有的TRON Power(TP)，因此以前的投票会失效。你可以通过重新冻结并投票来避免投票失效。

注意: 波场网络只记录你最后一次投票的状态，也就是说你的每一次投票都会覆盖以前所有的投票效果

+ 示例：

```
freezebalance 10,000,000 3 // 冻结了10TRX，获取了10单位TRON Power(TP)
votewitness witness1 4 witness2 6 // 同时给witness1投了4票，给witness2投了6票
votewitness witness1 3 witness2 7 // 同时给witness1投了3票，给witness2投了7票
```

以上命令的最终结果是给witness1投了3票，给witness2投了7票

## 2.3 超级代表的奖励

1. 票数奖励，每6小时，票数排名前127名的超级代表会获得共计115,200 TRX的票数奖励，这部分奖励将按照票数比例分发。每年的票数奖励总计168,192,000 TRX。

2. 出块奖励，波场协议网络每3秒中会出一个区块，每个区块将给予超级代表32个TRX奖励，每年总计336,384,000 TRX将会被奖励给超级代表。

+ 超级代表每次出块完成后，出块奖励都会发到超级代表的子账号当中，超级代表不能直接使用这部分资产，但可以查询。 每24h允许一次提取操作。从该子账号转移到超级代表的账户中。

## 2.4 委员会

### 2.4.1 什么是委员会
委员会用于修改Tron网络动态参数，如出块奖励、交易费用等等。委员会由当前的27个超级代表组成。每个超级代表都具有提议权、对提议的投票权，
当提议获得19个代表及以上的赞成票时，该提议获得通过，并在下个维护期内进行网络参数修改。

### 2.4.2 创建提议
只有超级代表对应账户具有提议权，其他账户无法创建提议。允许修改的网络动态参数以及编号如下( [min,max] )：
- 0: MAINTENANCE_TIME_INTERVAL, [3 * 27* 1000 ,24 * 3600 * 1000] //修改超级代表调整时间间隔，目前为6 * 3600 * 1000ms
- 1: ACCOUNT_UPGRADE_COST, [0,100 000 000 000 000 000]  //修改账户升级为超级代表的费用，目前为9999_000_000 Sun
- 2: CREATE_ACCOUNT_FEE, [0,100 000 000 000  000 000] // 修改创建账户费用，目前为100_000Sun
- 3: TRANSACTION_FEE, [0,100 000 000 000 000 000] // 修改TRX抵扣带宽的费用，目前为10Sun/byte
- 4: ASSET_ISSUE_FEE, [0,100 000 000 000 000 000] // 修改资产发行费用，目前为1024_000_000 Sun
- 5: WITNESS_PAY_PER_BLOCK, [0,100 000 000 000 000 000] // 修改超级代表出块奖励，目前为32_000_000 Sun
- 6: WITNESS_STANDBY_ALLOWANCE, [0,100 000 000 000 000 000] // 修改分给前127名超级代表候选人的奖励，115_200_000_000 Sun
- 7: CREATE_NEW_ACCOUNT_FEE_IN_SYSTEM_CONTRACT, []// 修改系统创建账户的费用，目前为0 Sun
- 8: CREATE_NEW_ACCOUNT_BANDWIDTH_RATE, // 提议7、8，组合使用，用于修改创建账户时对资源或TRX的消耗
- 9: ALLOW_CREATION_OF_CONTRACTS, // 用于控制虚拟机功能的开启
- 10: REMOVE_THE_POWER_OF_THE_GR  // 用于清除GR的创世票数
- 11: ENERGY_FEE, [0,100 000 000 000 000 000] //sun
- 12: EXCHANGE_CREATE_FEE, [0,100 000 000 000 000 000] //sun
- 13: MAX_CPU_TIME_OF_ONE_TX, [0, 1000] //ms
- 14: ALLOW_UPDATE_ACCOUNT_NAME, // 用于允许用户更改昵称以及昵称同名，目前为0，表示不允许
- 15: ALLOW_SAME_TOKEN_NAME, // 用于允许创建相同名称的token，目前为0，表示不允许


+ API：
`
createproposal id0 value0 ... idN valueN
id0_N: 参数编号
value0_N: 新参数值
`

注：Tron网络中，1 TRX = 1000_000 Sun。

### 2.4.3 对提议进行投票
提议仅支持投赞成票，不投票代表不赞同。从提议创建时间开始，3天时间内为提议的有效期。超过该时间范围，该提议如果没有获得足够的
赞成票，该提议失效。允许取消之前投的赞成票。


+ API：
`
approveProposal id is_or_not_add_approval
id: 提议Id，根据提议创建时间递增
is_or_not_add_approval: 赞成或取消赞成
`

### 2.4.4 取消提议
提议创建者，能够在提议生效前，取消提议。

+ API：
`
deleteProposal proposalId
id: 提议Id，根据提议创建时间递增
`

### 2.4.5 查询提议

以下接口可以查询提议，包括：
查询所有提议信息（ListProposals）、分页查询提议信息（GetPaginatedProposalList），查询指定提议信息（GetProposalById）。     
相关api详情，请查询[Tron-http](Tron-http.md)。

# 3 Tron账号（安文）
## 3.1 账号模型介绍
## 3.2 创建账号的方式
## 3.3 生成秘钥对算法
## 3.4 地址格式说明
## 3.5 签名说明

# 4 Tron节点类型（思聪）
## 4.1 SR
### 4.1.1 SR介绍
### 4.1.2 SR部署方式
### 4.1.3 建议硬件配置

## 4.2 full node
### 4.2.1 full node介绍
### 4.2.2 full node部署方式
### 4.2.3 建议硬件配置

## 4.3 solidity node
### 4.3.1 solidity node介绍
### 4.3.2 solidity node部署方式
### 4.3.3 建议硬件配置

## 4.4 Tron网络结构（以图形加文字说明）

## 4.5 一键部署full node和solidity node

## 4.6 如何连接主网

## 4.7 如何连接测试网

## 4.8 如何搭建私有链


# 5 智能合约（振远）
## 5.1 Tron智能合约介绍
## 5.2 Tron智能合约特性（地址等）
## 5.3 Energy介绍
### 5.3.1 Energy的获取
### 5.3.2 Energy的消耗
## 5.4 智能合约开发工具介绍
## 5.5 智能合约的开发，编译，部署方法

# 6 内置合约以及API说明（任成常）
## 6.1 内置合约说明
## 6.2 gRPC 接口说明
## 6.3 http 接口说明

# 7 Tron Token说明
## 7.1 如何发行token
## 7.2 如何参与token

# 8 Tron交易费用（刘绍华）
## 8.1 [带宽介绍](https://github.com/tronprotocol/Documentation/blob/fix_http/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E8%B4%B9%E7%94%A8%E6%A8%A1%E5%9E%8B.md)
## 8.2 交易费用说明
### 8.2.1 费用总体说明
### 8.2.2 创建账号手续费
### 8.2.3 Token转账费用
## 8.3 [交易费明细]

# 9 去中心化交易对说明

## 9.1 什么是交易对
TRON网络原生支持去中心化交易所。去中心化交易所由多个交易对构成。一个交易对（Exchange）是token与token之间，或者token与TRX之间的交易市场（Exchange Market）。
任何账户都可以创建任何token之间的交易对，即使TRON网络中已经存在相同的交易对。交易对的买卖与价格波动遵循Bancor协议。
TRON网络规定，所有交易对中的两个token的权重相等，因此它们数量（balance）的比率即是它们之间的价格。
举一个简单的例子，假设一个交易对包含ABC和DEF两种token，ABC的balance为1000万，DEF的balance为100万，由于权重相等，因此10 ABC = 1 DEF，也就是说，当前ABC对于DEF的价格为10ABC/DEF。

## 9.2 创建交易对 
任何账户都可以创建任何token之间的交易对。创建交易对的手续费是1024TRX，这个手续费会被TRON网络烧掉。   
创建交易对相当于为该交易对注入（inject）原始资本，因此创建者账户中要拥有该交易对的初始balance。当创建成功后，会立即从创建者账户中扣除这两个token的balance。   
创建交易对的合约是ExchangeCreateContract，该合约有4个参数：
- first_token_id，第1种token的id   
- first_token_balance，第1种token的balance   
- second_token_id，第2种token的id   
- second_token_balance，第2种token的balance   

其中token的id由token的name得到，具体概念请参见token发行相关部分的文档。如果交易对中包含TRX，则使用"_"表示TRX的id。需要注意的是，TRX的单位是sun，即10-6 TRX。    
例子：
`    
ExchangeCreate abc 10000000 _ 1000000000000    
`
该交易会创建abc与TRX之间的交易对，初始balance分别为10000000个abc和1000000000000 sun（1000000TRX），
如果创建者没有足够的abc和TRX，则交易对创建失败；否则创建者账户中立即扣除相应的abc和TRX，交易对创建成功，可以开始交易。
相关api:      

## 9.3 交易
任何账户都可以在任何交易对中进行交易。交易量和价格完全遵循Bancor协议。也就是说，一个账户在交易时，交易的对象是exchange。交易是即时的，不需要挂单和抢单，只要有足够的token，就可以交易成功。     
交易的合约是ExchangeTransactionContract，该合约有3个参数：     
 - exchange_id，交易对的id，TRON网络会根据交易对创建时间顺序给每个交易对唯一的id
 - token_id，要卖出的token的id
 - quant，要卖出的token的金额
 - expected，期望得到的另一个token的最小金额。如果小于此数值，交易不会成功

例子：       
我们在刚刚创建的abc与TRX的交易对中进行交易，假设此交易对id为1，当前交易对中abc balance为10000000，TRX balance为1000000，如果期望花100个TRX买到至少990个abc，则      
`  
ExchangeTransaction 1 _ 100 990 
`     
其中"_"表示TRX，即向交易对卖出100个TRX。如果成功，该交易会使得交易对中增加100个TRX，并根据Bancor协议计算出减少的abc的数量，交易对创建者的账户中abc和TRX的数量会相应地增加和减少。


## 9.4 注资
当一个交易对其中1种token的balance很小时，只需要很小的交易量就会造成很大的价格波动，这不利于正常交易。为了避免这种情况，该交易对的创建者可以选择向该交易对注资（inject）。
一个交易对只能由该交易对的创建者来注资。注资不需要手续费。    
注资需要指定一种token以及注资金额，TRON网络会自动根据当前交易对中两种token的比例，计算出另一个token所需的金额，从而保证注资前后，交易对中两个token的比例相同，价格没有变化。    
与创建交易对相同，注资要求创建者拥有足够多的两种token的balance。    
注资的合约是ExchangeInjectContract，该合约有3个参数： 
   
 - exchange_id，交易对的id
 - token_id，要注资的token的id
 - quant，要注资的token的金额

例子：    
我们对刚刚创建的abc与TRX的交易对进行注资，假设此交易对id为1（TRON网络中第1个交易对），当前交易对中abc balance为10000000，TRX balance为1000000，如果要增加10%的abc，则
`
ExchangeInject 1 abc 1000000
`    
如果成功，该交易会使得交易对中增加1000000个abc，并增加100000个TRX，交易对创建者的账户中abc和TRX的数量会相应地减少。

## 9.5 撤资
一个交易对中的所有资产都是创建者的。创建者可以随时撤资（withdraw），把交易对中的token赎回到自身账户中。一个交易对只能由该交易对的创建者来撤资。撤资不需要手续费。    
和注资一样，撤资需要指定一种token以及撤资金额，TRON网络会自动根据当前交易对中两种token的比例，计算出另一个token撤资的金额，从而保证撤资前后，交易对中两个token的比例相同，价格没有变化。    
【风险提示】撤资前后价格没有变化，但是价格波动会更大    
撤资的合约是ExchangeWithdrawContract，该合约有3个参数：    
 - exchange_id，交易对的id
 - token_id，要撤资的token的id
 - quant，要撤资的token的金额

例子：    
我们对之前创建的abc与TRX的交易对进行撤资，假设此交易对id为1，当前交易对中abc balance为10000000，TRX balance为1000000，如果要赎回10%的abc，则    
`
ExchangeWithdraw 1 abc 1000000
`    
如果成功，该交易会使得交易对中减少1000000个abc，以及减少100000个TRX，交易对创建者的账户中abc和TRX的数量会相应地增加。

## 9.6 查询
### 9.6.1 查询交易
有三个查询交易对的接口，包括：查询所有交易对信息（ListExchanges）、分页查询交易对信息（GetPaginatedExchangeList）(Odyssey-v3.1.1暂不支持)，查询指定交易对信息（GetExchangeById）。
相关api详情，请查询[波场RPC-API说明](波场钱包RPC-API.md)。

### 9.6.2 计算当前价格
交易中token的当前价格信息的计算过程：\
假设 first_token 当前的价格为 100 Sun，first_token_balance 为1000_000,second_token_balance 为2000_000，\
second_token 当前的价格为 first_token*first_token_balance/second_token_balance = 50 Sun \
first_token的价格可有"first_token&&TRX"交易对计算获得。

### 9.6.3 计算交易获得token量
交易中花费first_token置换获得的second_token的数量的计算过程：\
假设 sellTokenQuant是要卖出的first_token的金额，buyTokenQuant是要买入的second_token的金额。
 
supply = 1_000_000_000_000_000_000L；\
supplyQuant = -supply * (1.0 - Math.pow(1.0 + (double) sellTokenQuant/（firstTokenBalance + sellTokenQuant）, 0.0005)); \
buyTokenQuant = （long）balance * (Math.pow(1.0 + (double) supplyQuant / supply, 2000.0) - 1.0)；
 
注意：由于网络其他账户发生交易，价格可能发生变化。    

相关api详情，请查询[Tron-http](Tron-http.md)。

# 10 钱包介绍（任成常）
## 10.1 wallet-cli功能介绍
## 10.2 计算交易ID
## 10.3 计算blockID
## 10.4 如何本地构造交易
## 10.5 相关demo
