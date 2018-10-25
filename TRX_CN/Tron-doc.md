# TRON公链文档

# 1 项目仓库
仓库地址：https://github.com/tronprotocol
其中 java-tron是主网代码，protocol是api和数据结构定义。wallet-cli是官方命令行钱包。
配置文件：

testnet的配置请参照

https://github.com/tronprotocol/TronDeployment/blob/master/test_net_config.conf

mainnet的配置请参照

https://github.com/tronprotocol/TronDeployment/blob/master/main_net_config.conf

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

# 3 Tron账号
## 3.1 账户模型介绍
Tron采用账户模型。账户的唯一标识为地址address，对账户操作需要验证私钥签名。每个账户拥有TRX、Token余额及智能合约、带宽、能量等各种资源。通过发送交易可以增减TRX或者Token余额，需要消耗带宽；可以发布并拥有智能合约，也可以调用他人发布的智能合约，需要消耗能量。可以申请成为超级代表并被投票，也可以对超级代表进行投票。等等。Tron所有的活动都围绕账户进行。
## 3.2 创建账号的方式
首先用钱包或者浏览器生成私钥和地址，生成方法见3.3和3.4，公钥可以丢弃。
由已有老账户调用转账TRX(CreateTransaction2)、转让Token(TransferAsset2)或者创建账户(CreateAccount2)合约，并广播到网络后将完成账户创建的流程。
## 3.3 生成密钥对算法
Tron的签名算法为ECDSA，选用曲线为SECP256K1。其私钥为一个随机数，公钥为椭圆曲线上一个点。生成过程为，首先生成一个随机数d作为私钥，再计算P=d*G作为公钥；其中G为椭圆曲线的基点。
## 3.4 地址格式说明
用公钥P作为输入，计算SHA3得到结果H；这里公钥长度为64字节，SHA3选用Keccak256。
取H的最后20字节，在前面填充一个字节0x41得到address。
对address进行basecheck计算得到最终地址，所有地址的第一个字符为T。
其中basecheck的计算过程为：首先对address计算sha256得到h1，再对h1计算sha256得到h2，取其前4字节作为check填充到address之后得到address||check，对其进行base58编码得到最终结果。
我们用的字符映射表为：
ALPHABET = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz"
## 3.5 签名说明
签名说明请参照
https://github.com/tronprotocol/Documentation/blob/fix_http/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E4%BA%A4%E6%98%93%E7%AD%BE%E5%90%8D%E6%B5%81%E7%A8%8B.md

# 4 Tron节点类型（思聪）
## 4.1 SR
### 4.1.1 SR介绍
### 4.1.2 SR部署方式
### 4.1.3 建议硬件配置

## 4.2 FullNode
### 4.2.1 FullNode介绍
### 4.2.2 FullNode部署方式
### 4.2.3 建议硬件配置
最低配置要求：  
CPU：16核 内存：32G 带宽：100M 硬盘：1T
推荐配置要求：  
CPU：64核及以上 内存：64G及以上 带宽：500M及以上 硬盘：20T及以上

## 4.3 SolidityNode
### 4.3.1 SolidityNode介绍
SolidityNode是只从自己信任的FullNode同步固化块的节点，并提供区块、交易查询等服务。
### 4.3.2 SolidityNode部署方式
[部署solidityNode](https://github.com/tronprotocol/tron-deployment#deployment-of-soliditynode-on-the-one-host)
### 4.3.3 建议硬件配置
最低配置要求：  
CPU：16核 内存：32G 带宽：100M 硬盘：1T
推荐配置要求：  
CPU：64核及以上 内存：64G及以上 带宽：500M及以上 硬盘：20T及以上

## 4.4 Tron网络结构（以图形加文字说明）

## 4.5 一键部署FullNode和SolidityNode
下载一键部署脚本，根据不同的节点类型附加相应的参数来运行脚本。  
详见[一键部署节点](https://github.com/tronprotocol/tron-deployment#deployment-of-soliditynode-on-the-one-host)
## 4.6 主网、测试网、私有网络
加入主网或测试网或私有网络的节点在部署时运行的是同一份代码，区别仅仅在于节点启动时加载的配置文件不同。
### 4.6.1
[主网配置文件](https://github.com/tronprotocol/tron-deployment/blob/master/main_net_config.conf)
### 4.6.2
[测试网配置文件](https://github.com/tronprotocol/tron-deployment/blob/master/test_net_config.conf)
### 4.6.3



# 5 智能合约（振远）
## 5.1 Tron智能合约介绍
## 5.2 Tron智能合约特性（地址等）
## 5.3 Energy介绍
智能合约运行时执行每一条指令都需要消耗一定的系统资源，资源的多少用Energy的值来衡量。

### 5.3.1 Energy的获取

冻结获取Energy，即将持有的trx锁定，无法进行交易，作为抵押，并以此获得免费使用Energy的权利。具体计算与全网所有账户冻结有关，可参考相关部分计算。

##### FreezeBalance 冻结获得带宽或能量

```
freezeBalance frozen_balance frozen_duration [ResourceCode:0 BANDWIDTH,1 ENERGY]
```

### 5.3.2 Energy的消耗
##### 示例1
如果一个账户A的balance是 100 TRX(100000000 SUN)，冻结 10 TRX 获得了100000 Energy，未冻结的balance是 90 TRX。有一个合约C设置的消耗调用者资源的比例是100%，也就是完全由调用者支付所需资源。
此时A调用了合约C，填写的feeLimit是 30000000(单位是SUN, 30 TRX)。那么A此次调用能够使用的Energy是由两部分计算出来的：
1. A冻结剩余的Energy
这部分的价格是根据账户A当前冻结的TRX和当前冻结所获得的Energy总量按比例计算出来的，也就是：1 Energy = (10 / 100000) TRX，还剩100000 Energy，价值10 TRX，小于feeLimit，则能获得所有的100000 Energy，价值的10 TRX算进feeLimit中。
2. 按照固定比例换算出来的Energy
如果feeLimit大于冻结剩余Energy价值的TRX，那么需要使用balance中的TRX来换算。固定比例是： 1 Energy = 100 SUN, feeLimit还有(30 - 10) TRX = 20 TRX，获得的Energy是 20 TRX / 100 SUN = 200000 Energy
所以，A此次调用能够使用的Energy是 (100000 + 200000) = 300000 Energy

如果合约执行成功，没有发生任何异常，则会扣除合约运行实际消耗的Energy，一般都远远小于此次调用能够使用的Energy。如果发生了Assert-style异常，则会消耗feeLimit对应的所有的Energy。Assert-style异常的介绍详见[异常介绍](https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E8%99%9A%E6%8B%9F%E6%9C%BA/%E5%BC%82%E5%B8%B8%E5%A4%84%E7%90%86.md)
##### 示例2
如果一个账户A的balance是 100 TRX(100000000 SUN)，冻结 10 TRX 获得了100000 Energy，未冻结的balance是 90 TRX。有一个合约C设置的消耗调用者资源的比例是40%，也就是由合约开发者支付所需资源的60%，开发者是D，冻结 50 TRX 获得了500000 Energy。
此时A调用了合约C，填写的feeLimit是 200000000(单位是SUN, 200 TRX)。
那么A此次调用能够使用的Energy是于以下三部分相关：
1. 调用者A冻结剩余的Energy（X Energy）
这部分的价格是根据账户A当前冻结的TRX和当前冻结所获得的Energy总量按比例计算出来的，也就是：1 Energy = (10 / 100000) TRX，还剩100000 Energy，价值10 TRX，小于剩下的feeLimit，则能获得所有的100000 Energy，价值的10 TRX算进feeLimit中。
2. 从调用者A的balance中，按照固定比例换算出来的Energy （Y Energy）
如果feeLimit大于1和2的和，那么需要使用A的balance中的TRX来换算。固定比例是： 1 Energy = 100 SUN, feeLimit还有(200 - 10)TRX = 190 TRX，但是A的balance只有90 TRX，按照min(190 TRX, 90 TRX) = 90 TRX来计算获得的Energy，即为 90 TRX / 100 SUN = 900000 Energy
3. 开发者D冻结剩余的Energy (Z Energy)
开发者D冻结剩余500000 Energy。
会出现以下两种情况：
当(X+Y)/(40%) >= Z/(60%) ，A此次调用能够使用的Energy是 X+Y+Z Energy。
当(X+Y)/(40%) < Z/(60%) ，A此次调用能够使用的Energy是 (X+Y)/(40%) Energy。
若A此次调用能够使用的Energy是 Q Energy

同上，如果合约执行成功，没有发生任何异常，消耗总Energy小于Q Energy，如消耗 500000 Energy ，会按照比例扣除合约运行实际消耗的Energy，调用者A消耗500000 * 40=200000 Energy，开发者D消耗500000 * 60%=300000 Energy。 
一般实际消耗Energy都远远小于此次调用能够使用的Energy。如果发生了Assert-style异常，则会消耗feeLimit对应的所有的Energy。Assert-style异常的介绍详见[异常介绍](https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E8%99%9A%E6%8B%9F%E6%9C%BA/%E5%BC%82%E5%B8%B8%E5%A4%84%E7%90%86.md)
##### 怎么填写feeLimit
建议填写的feeLimit要略大于当前环境下，获得此次合约执行所需Energy要冻结的SUN的值。例如：
1. 此次合约执行大概需要的Energy，比如是20000 Energy
2. 当前全网用于CPU冻结的TRX总量和Energy总量的比值，假设是1 TRX = 100 Energy
3. feeLimit填写为200 TRX = 200 * 10^6 SUN = 200000000 SUN
##### 注意事项
1. 开发者创建合约的时候，consume_user_resource_percent不要设置成0，也就是开发者自己承担所有资源消耗。consume_user_resource_percent建议值是1-100。
2. feeLimit必须在0-1000TRX之间
## 5.4 智能合约开发工具介绍
## 5.5 智能合约的开发，编译，部署方法

# 6 内置合约以及API说明
## 6.1 内置合约说明
请参考:

https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E4%BA%A4%E6%98%93%E6%93%8D%E4%BD%9C%E7%B1%BB%E5%9E%8B%E8%AF%B4%E6%98%8E.md

## 6.2 gRPC 接口说明
请参考:

https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md

## 6.3 http 接口说明
请参考:

https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-http.md

# 7 Tron Token说明
用户在Tron公链发行token，有两种方式，一种是通过智能合约实现TRC20协议，一种是通过Tron公链内置的AssetIssueContract
合约。下面对AssetIssueContract合约发行token进行说明。
## 7.1 如何发行token
grpc接口

https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md#7-%E9%80%9A%E8%AF%81%E5%8F%91%E8%A1%8C

http接口

wallet/createassetissue
作用：发行Token
demo：curl -X POST  http://127.0.0.1:8090/wallet/createassetissue -d '{
"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0",
"name":"0x6173736574497373756531353330383934333132313538",
"abbr": "0x6162627231353330383934333132313538",
"total_supply" :4321,
"trx_num":1,
"num":1,
"start_time" : 1530894315158,
"end_time":1533894312158,
"description":"007570646174654e616d6531353330363038383733343633",
"url":"007570646174654e616d6531353330363038383733343633",
"free_asset_net_limit":10000,
"public_free_asset_net_limit":10000,
"frozen_supply":{"frozen_amount":1, "frozen_days":2}
}'
参数说明：
owner_address发行人地址；name是token名称；abbr是token简称；total_supply是发行总量；trx_num和num是token和trx的兑换价值；start_time和end_time是token发行起止时间；description是token说明，需要是hexString格式；url是token发行方的官网，需要是hexString格式；free_asset_net_limit是Token的总的免费带宽；public_free_asset_net_limit是每个token拥护者能使用本token的免费带宽；frozen_supply是token发行者可以在发行的时候指定冻结的token
返回值：发行Token的Transaction

## 7.2 如何参与token
grpc接口：

https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md#12-%E5%8F%82%E4%B8%8E%E9%80%9A%E8%AF%81%E5%8F%91%E8%A1%8C

http接口：

wallet/participateassetissue
作用：参与token发行
demo：curl -X POST http://127.0.0.1:8090/wallet/participateassetissue -d '{
"to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0",
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1", 
"amount":100, 
"asset_name":"3230313271756265696a696e67"
}'
参数说明：
to_address是Token发行人的地址，需要是hexString格式
owner_address是参与token人的地址，需要是hexString格式
amount是参与token的数量
asset_name是token的名称，需要是hexString格式
返回值：参与token发行的transaction

# 8 Tron交易费用
## 8.1 费用模型介绍

TRON网络中的资源有3种：带宽，CPU和存储。得益于波场独有的内存模型，TRON网络中的存储资源几乎是无限的。
但是过多无关紧要的交易仍然会消耗过多的带宽和CPU资源时，导致导致系统阻塞，影响正常交易的处理确认。
为了保持交易的相对公平，波场网络引入了Bandwidth point 和 Energy 两种资源。
其中带宽消耗的是Bandwidth Point，而CPU消耗的是Energy。   
**注意** 
- 普通交易仅消耗Bandwidth points
- 智能合约的操作不仅要消耗Bandwidth points，还会消耗Energy

#### 8.1.1 Bandwidth Points


交易以字节数组的形式在网络中传输及存储，一条交易消耗的Bandwidth Points = 交易字节数 * Bandwidth Points费率。当前Bandwidth Points费率 = 1。

如一条交易的字节数组长度为200，那么该交易需要消耗200 Bandwidth Points。

**注意** 由于网络中总冻结资金以及账户的冻结资金随时可能发生变化，因此账户拥有的Bandwidth Points不是固定值。

#### 8.1.2 Bandwidth PointsBandwidth Points的来源

Bandwidth Points的获取分两种：

- 一种是通过冻结TRX获取的Bandwidth Points， 额度 = 为获取Bandwidth Points冻结的TRX / 整个网络为获取Bandwidth Points冻结的TRX 总额 * 43_200_000_000。
也就是所有用户按冻结TRX平分固定额度的Bandwidth Points。

- 还有一种是每个账户固定免费额度的TRX，为5000。

#### 8.1.3 Bandwith Points的消耗

除了查询操作，任何交易都需要消耗bandwidth points。

还有一种情况，如果是转账，包括普通转账或发行Token转账，如果目标账户不存在，转账操作则会创建账户并转账，只会扣除创建账户消耗的Bandwidth Points，转账不会再消耗额外的Bandwidth Points。

#### 8.1.4 Bandwidth Points的计算规则

Bandwidth Points是一个账户1天内能够使用的总字节数。一定时间内，整个网络能够处理的Bandwidth为确定值。

如果交易需要创建新账户，Bandwidth Points消耗如下：

    1、尝试消耗交易发起者冻结获取的Bandwidth Points。如果交易发起者Bandwidth Points不足，则进入下一步。
    
    2、尝试消耗交易发起者的TRX，这部分烧掉0.1TRX。

如果交易是发行Token转账，Bandwidth Points消耗如下：

    1、依次验证 发行Token资产总的免费Bandwidth Points是否足够消耗，转账发起者的Token剩余免费Bandwidth Points是否足够消耗，
    Token发行者冻结TRX获取Bandwidth Points剩余量是否足够消耗。如果满足则扣除Token发行者的Bandwidth Points，任意一个不满足则进入下一步。
    
    2、尝试消耗交易发起者冻结获取的Bandwidth Points。如果交易发起者Bandwidth Points不足，则进入下一步。
    
    3、尝试消耗交易发起者的免费Bandwidth Points。如果免费Bandwidth Points也不足，则进入下一步。
    
    4、尝试消耗交易发起者的TRX，交易的字节数 * 10 sun。

如果交易普通交易，Bandwidth Points消耗如下：

    1、尝试消耗交易发起者冻结获取的Bandwidth Points。如果交易发起者Bandwidth Points不足，则进入下一步。
    
    2、尝试消耗交易发起者的免费Bandwidth Points。如果免费Bandwidth Points也不足，则进入下一步。
    
    3、尝试消耗交易发起者的TRX，交易的字节数 * 10 sun。



## 8.2 交易费用说明
### 8.2.1 费用总体说明
### 8.2.2 创建账号手续费
### 8.2.3 Token转账费用
## 8.3 交易费明细

|交易类型|费用|
| :------|:------:|
|创建witness|9999TRX|
|发行token|1024TRX|
|创建account|0.1TRX|
|创建exchange|1024TRX|

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

# 10 钱包介绍
## 10.1 wallet-cli功能介绍
请参考:

  https://github.com/tronprotocol/wallet-cli/blob/master/README.md

## 10.2 计算交易ID

对交易的RawData取Hash。
```
Hash.sha256(transaction.getRawData().toByteArray())

```
## 10.3 计算blockID
block id是块高度和块头raw_data的hash的混合，具体是计算出块头中raw_data的hash。用
 块的高度替换该hash中的前8个byte。具体代码如下：
```
private byte[] generateBlockId(long blockNum, byte[] blockHash) { 
  byte[] numBytes = Longs.toByteArray(blockNum); 
  byte[] hash = blockHash; 
  System.arraycopy(numBytes, 0, hash, 0, 8); 
  return hash;
  }
```

## 10.4 如何本地构造交易
根据交易的定义，自己填充交易的各个字段，本地构造交易。需要注意是交易里面需要设置refference block信息和Expiration信息，所以在构造交易的时候需要连接mainnet。建议设置refference block为fullnode上面的最新块，设置Expiration为最新块的时间加N分钟。N的大小根据需要设定，后台的判断条件是(Expiration > 最新块时间 and Expiration < 最新块时时 + 24小时），如果条件成立则交易合法，否则交易为过期交易，不会被mainnet接收。 refference block 的设置方法：设置RefBlockHash为最新块的hash的第8到16(不包含)之间的字节，设置BlockBytes为最新块高度的第6到8（不包含）之间的字节，代码如下：
```
public static Transaction setReference(Transaction transaction, Block newestBlock) {
     long blockHeight = newestBlock.getBlockHeader().getRawData().getNumber();
     byte[] blockHash = getBlockHash(newestBlock).getBytes();
     byte[] refBlockNum = ByteArray.fromLong(blockHeight);
     Transaction.raw rawData = transaction.getRawData().toBuilder()
         .setRefBlockHash(ByteString.copyFrom(ByteArray.subArray(blockHash, 8, 16)))
         .setRefBlockBytes(ByteString.copyFrom(ByteArray.subArray(refBlockNum, 6, 8)))
         .build();
     return transaction.toBuilder().setRawData(rawData).build();
   }
```
Expiration 和交易时间戳的设置方法：
```
public static Transaction createTransaction(byte[] from, byte[] to, long amount) {
     Transaction.Builder transactionBuilder = Transaction.newBuilder();
     Block newestBlock = WalletClient.getBlock(-1);
 
     Transaction.Contract.Builder contractBuilder = Transaction.Contract.newBuilder();
     Contract.TransferContract.Builder transferContractBuilder = Contract.TransferContract
         .newBuilder();
     transferContractBuilder.setAmount(amount);
     ByteString bsTo = ByteString.copyFrom(to);
     ByteString bsOwner = ByteString.copyFrom(from);
     transferContractBuilder.setToAddress(bsTo);
     transferContractBuilder.setOwnerAddress(bsOwner);
     try {
       Any any = Any.pack(transferContractBuilder.build());
       contractBuilder.setParameter(any);
     } catch (Exception e) {
       return null;
     }
     contractBuilder.setType(Transaction.Contract.ContractType.TransferContract);
     transactionBuilder.getRawDataBuilder().addContract(contractBuilder)
         .setTimestamp(System.currentTimeMillis())//交易时间戳设置毫秒形式
         .setExpiration(newestBlock.getBlockHeader().getRawData().getTimestamp() + 10 * 60 * 60 * 1000);//交易所可以根据实际情况设置超时时间
     Transaction transaction = transactionBuilder.build();
     Transaction refTransaction = setReference(transaction, newestBlock);
     return refTransaction;
   }
```
## 10.5 相关demo

本地构造交易、签名的demo请参考 


https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java

nodejs的demo，具体请参考

https://github.com/tronprotocol/tron-demo/tree/master/demo/nodejs
