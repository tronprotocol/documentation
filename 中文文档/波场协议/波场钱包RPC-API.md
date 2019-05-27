# 波场钱包RPC-API 

[API的具体定义请参考](#API的具体定义请参考)\
[你可能需要经常用到的如下几个API](#你可能需要经常用到的如下几个API)\

[1. 获取账户信息](#1)\
[2. 转让波场币](#2)\
[3. 广播交易](#3)\
[4. 创建账户](#4)\
[5. 更新账户](#5)\
[6. 投票](#6)\
[7. 通证发行](#7)\
[8. 查询超级代表候选人列表](#8)\
[9. 申请成为超级代表候选人](#9)\
[10. 更新超级代表候选人信息](#10)\
[11. 转让通证](#11)\
[12. 参与通证发行](#12)\
[14. 查询所有通证列表](#14)\
[13. 查询所有节点](#13)\
[15. 查询某个账户发行的通证列表](#15)\
[16. 按通证名称查询通证信息](#16)\
[17. 查询当前时间有效发行的通证列表](#17)\
[18. 获取当前区块](#18)\
[19. 按照高度获取区块](#19)\
[20. 获取交易总数](#20)\
[21. 通过ID查询交易](#21)\
[22. 通过时间查询交易（已删除）](#22)\
[23. 通过地址查询所有发起交易](#23)\
[24. 通过地址查询所有接收交易](#24)\
[25. 锁定资金](#25)\
[26. 解除资金锁定](#26)\
[27. 赎回出块奖励](#27)\
[28. 解冻通证](#28)\
[29. 查询下次维护时刻](#29)\
[30. 查询交易信息](#30)\
[31. 根据ID查询区块](#31)\
[32. 更新通证](#32)\
[33. 分页查询通证列表](#33)\
[34. 对交易进行签名](#34)\
[35. 创建地址和秘钥](#35)\
[36. TRX快捷转账](#36)\
[37. 生成地址和私钥](#37)\
[38. 转让波场币2](#38)\
[39. 更新账户2](#39)\
[40. 投票2](#40)\
[41. 通证发行2](#41)\
[42. 更新超级代表候选人信息2](#42)\
[43. 创建账户2](#43)\
[44. 申请成为超级代表候选人2](#44)\
[45. 转让通证2](#45)\
[46. 参与通证发行2](#46)\
[47. 锁定资金2](#47)\
[48. 解除资金锁定2](#48)\
[49. 解冻通证2](#49)\
[50. 赎回出块奖励2](#50)\
[51. 更新通证2](#51)\
[52. 获取当前区块2](#52)\
[53. 按照高度获取区块2](#53)\
[54. 分页获取区块2](#54)\
[55. 查询最后区块2](#55)\
[57. 通过地址查询所有发起交易2](#57)\
[58. 通过地址查询所有接收交易2](#58)\
[59. 创建交易对](#59)\
[60. 交易所注资](#60)\
[61. 交易所撤资](#61)\
[62. 交易所交易](#62)\
[63. 查询所有交易对](#63)\
[64. 查询指定交易对](#64)\
[65. 分页查询交易对](#65)\
[66. 创建提议](#66)\
[67. 赞成提议](#67)\
[68. 删除提议](#68)\
[69. 查询所有提议](#69)\
[70. 分页查询提议](#70)\
[71. 查询指定提议](#71) \
[72. 查询资源委派账户索引](#72) \
[73. 查询资源委派的详细信息](#73) \
[74. 通证快捷转账](#74) \
[75. 通证快捷转账（通过私钥）](#75) 
[76. 更新用户权限（用于多重签名）](#76)  
[77. 增加签名（用于多重签名）](#77)  
[78. 查询已签名地址（用于多重签名）](#78) 
[79. 查询交易签名权重（用于多重签名）](#79) \
[80. 部署智能合约 ](#80)\
[81. 执行智能合约 ](#81)
     
     
## <h2 id="API的具体定义请参考">API的具体定义请参考</h2> 

https://github.com/tronprotocol/java-tron/blob/develop/src/main/protos/api/api.proto

## <h2 id="你可能需要经常用到的如下几个API">你可能需要经常用到的如下几个API</h2>
 
1. 如何获取账号基本信息（类比比特币 getinfo）  
GetAccount
2. 如何获取余额（类比比特币：getbalance）  
GetAccount
3. 如何生成一个地址（类比比特币：getnewaddress）  
可以在本地生成一个地址  
可以通过一个已经存在的账号给一个新地址转账从而在区块链上生成一个新地址，通过CreateTransaction（TransferContract）完成
4. 如何获取一个地址的历史交易（类比比特币：listtransactions）  
GetTransactionsFromThis  
GetTransactionsToThis
5. 如何校验地址具有正确的格式  
+ 本地校验：经过decode58check后，会得到一个长度是21的byte数组，第一个字节是0x41(mainnet) 或者 0xa0(testnet).  
+ 如果想要验证一个地址是否存在于区块链上，请求API GetAccount。

## <h2 id="1">1. 获取账户信息</h2>

1.1	接口声明  
rpc GetAccount (Account) returns (Account) {};  
1.2	提供节点  
fullnode、soliditynode。  
1.3	参数说明  
Account：只需要输入address即可。  
1.4	返回值  
Account：返回账户所有的详细信息。  
1.5	功能说明  
查询余额列表。从返回的Account中可以展示所有的资产信息。

## <h2 id="2">2. 转让波场币</h2>

2.1	接口声明  
rpc CreateTransaction (TransferContract) returns (Transaction)　{};  
2.2	提供节点  
fullnode。  
2.3	参数说明  
TransferContract：包含提供方地址、接收方地址、金额，其中金额的单位为sun。  
2.4	返回值  
Transaction：返回包含转账合约的交易，钱包签名后再请求广播交易。  
2.5	功能说明  
转账。创建一个转账的交易。

## <h2 id="3">3. 广播交易</h2>

3.1	接口声明  
rpc BroadcastTransaction (Transaction) returns (Return) {};  
3.2	提供节点  
fullnode。  
3.3	参数说明  
Transaction：已经由钱包签名的交易。波场中需要改变区块链状态的操作都封装在交易中。  
3.4	返回值  
Return：成功或失败。广播交易前会预执行交易，返回其结果。注意：返回成功不一定保证交易成功。  
3.5	功能说明  
转账、投票、发行通证、参与通证发行等。将已签名的交易信息，发送到节点，由节点验证后广播到网络中。

## <h2 id="4">4. 创建账户</h2>

4.1	接口声明  
rpc CreateAccount (AccountCreateContract) returns (Transaction){};  
4.2	提供节点  
fullnode。  
4.3	参数说明  
AccountCreateContract：包含账户类型、账户地址。  
4.4	返回值  
Transaction：返回包含创建账户的交易，钱包签名后再请求广播交易。  
4.5	功能说明  
创建账号并写入区块链。应该先离线生成一个地址，再通过该API激活该地址。

## <h2 id="5">5. 更新账户</h2>

5.1	接口声明  
rpc UpdateAccount (AccountUpdateContract) returns (Transaction){};  
5.2	提供节点  
fullnode。  
5.3	参数说明  
AccountUpdateContract：包含账户名称、账户地址。  
5.4	返回值  
Transaction：返回包含更新账户的交易，钱包签名后再请求广播交易。  
5.5	功能说明  
更新账户名称。

## <h2 id="6">6. 投票</h2>

6.1	接口声明  
rpc VoteWitnessAccount (VoteWitnessContract) returns (Transaction){};  
6.2	提供节点  
fullnode。  
6.3	参数说明  
VoteWitnessContract：包含投票人地址和一个投票对象列表(最多不能超过30个投票对象)，包含候选人地址和投票数。  
6.4	返回值  
Transaction：返回包含投票的交易，钱包签名后再请求广播交易。  
6.5	功能说明  
投票功能。只能对超级代表候选人进行投票，投票总数量不能大于账户锁定资金的数量，参见25 锁定资金。

## <h2 id="7">7. 通证发行</h2>
        
7.1	接口声明  
rpc CreateAssetIssue (AssetIssueContract) returns (Transaction) {};  
7.2	提供节点  
fullnode。  
7.3	参数说明  
AssetIssueContract：包含发行人地址、通证名称、总发行量、波场币vs通证汇兑比例、开始时间、结束时间、衰减率、投票分数、详细描述、url、每账户最多消耗带宽值，总带宽消耗值以及token冻结资产。 
7.4	返回值  
Transaction：返回通证发行的交易，钱包签名后再请求广播交易。  
7.5	功能说明  
发行通证。所有人都可以发行通证，发行通证会消耗1024个trx。发行通证后，在有效期内任何人都可以参与通证发行，用trx按照比例兑换通证。
+ 示例：

`assetissue password abc 1000000 1 1 2018-5-31 2018-6-30 abcdef a.com 1000 1000000 200000 180 300000 365` 

以上命令的发行了名为abc的资产，发行总量为100万，abc与TRX的兑换比例为1:1，发行日期为2018-5-31至2018-6-30，描述为abcdef，网址为a.com，
每个账户每天的token转账最多消耗自己1000 bandwidth points，整个网络每天最多消耗自己1000000 bandwidth points。其中20万锁仓180天，30万锁仓365天。


## <h2 id="8">8. 查询超级代表候选人列表</h2>

8.1	接口声明  
rpc ListWitnesses (EmptyMessage) returns (WitnessList) {};  
8.2	提供节点  
fullnode、soliditynode。  
8.3	参数说明  
EmptyMessage：空。  
8.4 返回值  
WitnessList： Witness的列表。所有超级代表的候选人详细信息。  
8.5	功能说明  
投票前要查询所有候选人，并且展示出详细信息，供用户选择投票。

## <h2 id="9">9. 申请成为超级代表候选人</h2>

9.1 接口声明
rpc CreateWitness (WitnessCreateContract) returns (Transaction) {};  
9.2 提供节点  
fullnode。  
9.3 参数说明  
WitnessCreateContract：包含账户地址、Url。  
9.4 返回值  
Transaction：返回包含申请成为候选人的交易，钱包签名后再请求广播交易。  
9.5 功能说明  
每个波场用户都可以申请成为超级代表候选人。要求账户在区块链上已经创建。

## <h2 id="10">10. 更新超级代表候选人信息</h2>

10.1 接口声明  
rpc UpdateWitness (WitnessUpdateContract) returns (Transaction) {};  
10.2 提供节点  
fullnode。  
10.3 参数说明  
WitnessUpdateContract：包含账户地址、Url。  
10.4 返回值  
Transaction：返回包含更新候选人信息的交易，钱包签名后再请求广播交易。  
10.5 功能说明  
更新超级代表的url。

## <h2 id="11">11. 转让通证</h2>

11.1 接口声明  
rpc TransferAsset (TransferAssetContract) returns (Transaction){};  
11.2 提供节点  
fullnode。  
11.3 参数说明  
TransferAssetContract：包含通证名称、提供方地址、接收方地址、通证数量。  
11.4 返回值  
Transaction：返回包含转让通证的交易，钱包签名后再请求广播交易。  
11.5 功能说明  
转让通证。创建一个转让通证的交易。

## <h2 id="12">12. 参与通证发行</h2>

12.1 接口声明  
rpc ParticipateAssetIssue (ParticipateAssetIssueContract) returns (Transaction){};  
12.2 提供节点  
fullnode。  
12.3 参数说明  
ParticipateAssetIssueContract：包含参与方地址、发行方地址、通证名称、参与金额，其中金额的单位为sun。  
12.4 返回值  
Transaction：返回包含参与通证发行的交易，钱包签名后再请求广播交易。  
12.5 功能说明  
参与通证发行。


## <h2 id="13">13.  查询所有节点</h2>

13.1 接口声明  
rpc ListNodes (EmptyMessage) returns (NodeList) {};  
13.2 提供节点  
fullnode、soliditynode。  
13.3 参数说明  
EmptyMessage：空。  
13.4 返回值  
NodeList：Node的列表，包含ip和端口。  
13.5 功能说明  
列举所有在线的节点ip和端口。

## <h2 id="14">14. 查询所有通证列表</h2>

14.1 接口声明  
rpc GetAssetIssueList (EmptyMessage) returns (AssetIssueList) {};  
14.2 提供节点  
fullnode、soliditynode。  
14.3 参数说明  
EmptyMessage：空  
14.4 返回值  
AssetIssueList： AssetIssueContract的列表。所有已发行通证详细信息。  
14.5 功能说明  
全部通证列表。展示所有通证，供用户选择参与。

## <h2 id="15">15. 查询某个账户发行的通证列表</h2>

15.1 接口声明  
rpc GetAssetIssueByAccount (Account) returns (AssetIssueList) {};  
15.2 提供节点  
fullnode、soliditynode。  
15.3 参数说明  
Account：只需要输入address即可  
15.4 返回值  
AssetIssueList： AssetIssueContract的列表。  
15.5 功能说明  
查询某个账户发行的所有通证。

## <h2 id="16">16. 按通证名称查询通证信息</h2>

16.1 接口声明  
rpc GetAssetIssueByName (BytesMessage) returns (AssetIssueContract) {};  
16.2 提供节点  
fullnode、soliditynode。  
16.3 参数说明  
BytesMessage：通证名称。  
16.4 返回值  
AssetIssueContract：通证详细信息。  
16.5 功能说明  
按照通证名称查询通证。通证名称在波场中确保唯一。

## <h2 id="17">17. 查询当前时间有效发行的通证列表</h2>

17.1 接口声明  
rpc GetAssetIssueListByTimestamp (NumberMessage) returns (AssetIssueList){};  
17.2 提供节点  
soliditynode。  
17.3 参数说明  
NumberMessage：当前时间。相对于1970年的毫秒数。  
17.4 返回值  
AssetIssueList： AssetIssueContract的列表。所有正在发行的通证详细信息。  
17.5 功能说明  
全部通证列表。展示当前发行通证，供用户选择参与。

## <h2 id="18">18. 获取当前区块</h2>

18.1 接口声明  
rpc GetNowBlock (EmptyMessage) returns (Block) {};  
18.2 提供节点  
fullnode、soliditynode。  
18.3 参数说明  
EmptyMessage：空。  
18.4 返回值  
Block：当前区块信息。  
18.5 功能说明  
获取当前最新的区块。

## <h2 id="19">19. 按照高度获取区块</h2>

19.1 接口声明  
rpc GetBlockByNum (NumberMessage) returns (Block) {};  
19.2 提供节点  
fullnode、soliditynode。  
19.3 参数说明  
NumberMessage：区块高度。  
19.4 返回值  
Block：区块信息。  
19.5 功能说明  
获取指定高度的区块，如果找不到则返回创世区块。

## <h2 id="20">20. 获取交易总数</h2>

20.1 接口声明  
rpc TotalTransaction (EmptyMessage) returns (NumberMessage) {};  
20.2 提供节点  
fullnode、soliditynode。  
20.3 参数说明  
EmptyMessage：空。  
20.4 返回值  
NumberMessage：交易总数。  
20.5 功能说明  
获取交易的总数量。

## <h2 id="21">21. 通过ID查询交易</h2>

21.1 接口声明  
rpc getTransactionById (BytesMessage) returns (Transaction) {};  
21.2 提供节点  
soliditynode。  
21.3 参数说明  
BytesMessage：交易ID，也就是其Hash值。  
21.4 返回值  
Transaction：被查询的交易。  
21.5 功能说明  
通过ID查询交易的详细信息，ID就是交易数据的Hash值。

## <h2 id="22">22. 通过时间查询交易（已删除）</h2>

22.1 接口声明  
rpc getTransactionsByTimestamp (TimeMessage) returns (TransactionList) {};  
22.2 提供节点  
soliditynode。  
22.3 参数说明  
TimeMessage：包含开始时间和结束时间。  
22.4 返回值  
TransactionList：交易列表。  
22.5 功能说明  
通过起止时间查询所有发生的交易。

## <h2 id="23">23. 通过地址查询所有发起交易(新版本将不再支持)</h2>

23.1 接口声明  
rpc getTransactionsFromThis (Account) returns (TransactionList) {};  
23.2 提供节点  
soliditynode。  
23.3 参数说明  
Account:发起方账户，只需要地址。   
offset: 分页的起始值，大于10000将提示错误。  
limit:  分页大小，最大为50，这个值可能会调整。当limit>50，或offset+limit>10000时，调整后满足limit<=50且offset+limit<=10000  
startTime:起始时间。  
endTime: 结束时间，获取[startTime,endTime]时间段的交易。  
23.4 返回值  
TransactionList：交易列表，按照交易创建时间的降序排列。 
total: 在[startTime,endTime]时间段内允许分页的最大交易数。  
rangeTotal: 在[startTime,endTime]时间段内的所有交易数，则默认返回最近7天的数据。   
23.5 功能说明  
通过账户地址查询所有发起的交易。  
23.6 备注说明  
该接口在新版本节点中将不再提供，如需要该功能，可以使用中心节点提供的接口，47.90.247.237:8091/walletextension/gettransactionsfromthis,
使用参考getTransactionsFromThis。

## <h2 id="24">24. 通过地址查询所有接收交易(新版本将不再支持)</h2>

24.1 接口声明  
rpc getTransactionsToThis (Account) returns (NumberMessage) {};  
24.2 提供节点  
soliditynode。  
24.3 参数说明  
Account：接收方账户，只需要地址。  
offset: 分页的起始值，大于10000将提示错误。  
limit:  分页大小，最大为50，这个值可能会调整。当limit>50，或offset+limit>10000时，调整后满足limit<=50且offset+limit<=10000  
startTime:起始时间。  
endTime: 结束时间，获取[startTime,endTime]时间段的交易，如果不传递，则默认返回最近7天的数据。    
24.4 返回值  
TransactionList：交易列表,按照交易创建时间的降序排列。    
total: 在[startTime,endTime]时间段内允许分页的最大交易数。  
rangeTotal: 在[startTime,endTime]时间段内的所有交易数。  
24.5 功能说明  
通过账户地址查询所有其它账户发起和本账户有关的交易。  
24.6 备注说明  
该接口在新版本节点中将不再提供，如需要该功能，可以使用中心节点提供的接口，47.90.247.237:8091/walletextension/gettransactionstothis,
使用参考getTransactionsToThis。

## <h2 id="25">25. 锁定资金</h2>

25.1 接口声明                                                                                  
rpc FreezeBalance (FreezeBalanceContract) returns (Transaction) {};                                                                                  
25.2 提供节点                                                                                                                                                           
fullnode。                                                                                  
25.3 参数说明                                                                                                                                                
FreezeBalanceContract：包含地址、锁定资金、锁定时间。目前锁定时间只能是3天。                                                                                  
25.4 返回值                                                                                                                                          
Transaction：返回包含资金的交易，钱包签名后再请求广播交易。                                                                                   
25.5 功能说明                                                                                                                                            
锁定资金将带来两个收益：
a.获得带宽。                                                                                                                                                                    
b.获得投票的权利。

## <h2 id="26">26. 解除资金锁定</h2>

26.1 接口声明                                                                                  
rpc UnfreezeBalance (UnfreezeBalanceContract) returns (Transaction) {};                                                                                  
26.2 提供节点                                                                                    
fullnode。                                                                                    
26.3 参数说明                                                                                   
UnfreezeBalanceContract：包含地址。                                                                                  
26.4 返回值                                                                                   
Transaction：返回交易，钱包签名后再请求广播交易。                                                                                   
26.5 功能说明                                                                                    
锁定资金3天之后才允许解除锁定。解除锁定，将清除投票记录和带宽。

## <h2 id="27">27. 赎回出块奖励</h2>

27.1 接口声明                                                                                  
rpc WithdrawBalance (WithdrawBalanceContract) returns (Transaction) {};                                                                                    
27.2 提供节点                                                                                    
fullnode。                                                                                    
27.3 参数说明                                                                                          
WithdrawBalanceContract：包含地址。                                                                                       
27.4 返回值                                                                                   
Transaction：返回交易，钱包签名后再请求广播交易。                                                                                       
27.5 功能说明                                                                                       
本接口仅提供给超级代表。超级代表记账成功后，将获得奖励，奖励不直接增加到账户余额上。每24小时允许提取一次到账户余额。

## <h2 id="28">28. 解冻通证</h2>

28.1 接口声明  
rpc UnfreezeAsset (UnfreezeAssetContract) returns (Transaction) {};  
28.2 提供节点  
fullnode。  
28.3 参数说明                                                                                  
UnfreezeAssetContract：包含地址。  
28.4 返回值                                                                                  
Transaction：返回交易，钱包签名后再请求广播交易。                                                                                       
28.5 功能说明                                                                                  
通证发行者解冻发行时冻结的通证。

## <h2 id="29">29. 查询下次维护时刻</h2>

29.1 接口声明                                                                                  
rpc GetNextMaintenanceTime (EmptyMessage) returns (NumberMessage) {};  
29.2 提供节点                                                                                  
fullnode。  
29.3 参数说明                                                                                  
EmptyMessage：无需参数  
29.4 返回值                                                                                  
NumberMessage：下次维护时刻  
29.5 功能说明                                                                                  
获取下次维护时刻

## <h2 id="30">30. 查询交易信息</h2>

30.1 接口声明                                                                                  
rpc GetTransactionInfoById (BytesMessage) returns (TransactionInfo) {};  
30.2 提供节点                                                                                  
soliditynode。  
30.3 参数说明                                                                                  
BytesMessage：交易ID  
30.4 返回值                                                                                  
TransactionInfo：交易信息  
30.5 功能说明                                                                                  
查询交易的费用、所在区块、所在区块时间戳

## <h2 id="31">31.  根据ID查询区块</h2>
31.1 接口声明                                                                                  
rpc GetBlockById (BytesMessage) returns (Block) {};  
31.2 提供节点                                                                                  
fullnode。  
31.3 参数说明                                                                                  
BytesMessage：区块ID  
31.4 返回值                                                                                  
Block：区块  
31.5 功能说明                                                                                  
根据输入的区块的ID查询区块

## <h2 id="32">32.  更新通证</h2>
32.1 接口声明                                                                                  
rpc UpdateAsset (UpdateAssetContract) returns (Transaction) {};  
32.2 提供节点                                                                                  
fullnode。  
32.3 参数说明                                                                                  
UpdateAssetContract：包括通证发行者的地址、通证的描述、通证的url、每账户最多消耗带宽值、总带宽消耗值  
32.4 返回值                                                                                  
Transaction：返回交易，钱包签名后再请求广播交易。                                                                                         
32.5 功能说明                                                                                  
只能由通证发行者发起，更新通证的描述、通证的url、每账户最多消耗带宽值、总带宽消耗值

## <h2 id="33">33. 分页查询通证列表</h2>
33.1 接口声明                                                                                  
rpc GetPaginatedAssetIssueList (PaginatedMessage) returns (AssetIssueList) {};  
33.2 提供节点                                                                                  
fullnode、soliditynode。  
33.3 参数说明                                                                                  
PaginatedMessage：起始查询下标 （从下标0开始计算）， 一页所取得的通证个数  
33.4 返回值                                                                                  
AssetIssueList： AssetIssueContract的分页列表，发行通证详细信息。  
33.5 功能说明                                                                                  
分页通证列表。分页展示通证，供用户选择参与。

## <h2 id="34">34. 对交易进行签名</h2>
34.1 接口说明                                                                                  
rpc GetTransactionSign (TransactionSign) returns (Transaction) {};  
34.2 提供节点                                                                                  
fullnode  
34.3 参数说明                                                                                  
TransactionSign：待签名Transaction对象和签名用的private key  
34.4 返回值                                                                                  
Transaction：签名的Transaction对象

## <h2 id="35">35. 创建地址和秘钥</h2>
35.1 接口说明                                                                                  
rpc CreateAdresss (BytesMessage) returns (BytesMessage) {};  
35.2 提供节点                                                                                  
fullnode  
35.3 参数说明                                                                                  
BytesMessage：Passphrase  
35.4 返回值                                                                                  
BytesMessage：地址

## <h2 id="36">36. TRX快捷转账</h2>
36.1 接口说明                                                                                  
rpc EasyTransfer (EasyTransferMessage) returns (EasyTransferResponse) {};  
36.2 提供节点                                                                                  
fullnode  
36.3 参数说明                                                                                  
EasyTransferMessage：转账用的密码，toAddress，转账的数量  
36.4 返回值                                                                                  
EasyTransferResponse：转账创建的transaction，交易ID，以及广播的结果result

## <h2 id="37">37. 生成地址和私钥</h2>
37.1 接口说明                                                                                  
rpc GenerateAddress (EmptyMessage) returns (AddressPrKeyPairMessage) {};  
37.2 提供节点                                                                                  
fullnode, soliditynode  
37.3 参数说明                                                                                  
EmptyMessage：空  
37.4 返回值                                                                                  
AddressPrKeyPairMessage：生成地址，生成私钥  
37.5 功能说明                                                                                  
可用于生成地址和私钥，请务必仅在受信断网节点调用，以免私钥外泄

## <h2 id="38">38. 转让波场币2</h2>
38.1	接口声明  
rpc CreateTransaction2 (TransferContract) returns (TransactionExtention)　{};  
38.2	提供节点  
fullnode。  
38.3	参数说明  
TransferContract：包含提供方地址、接收方地址、金额，其中金额的单位为sun。  
38.4	返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
38.5	功能说明  
转账。创建一个转账的交易。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="39">39. 更新账户2</h2>

39.1	接口声明  
rpc UpdateAccount2 (AccountUpdateContract) returns (TransactionExtention){};  
39.2	提供节点  
fullnode。  
39.3	参数说明  
AccountUpdateContract：包含账户名称、账户地址。  
39.4	返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
39.5	功能说明  
更新账户名称。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="40">40. 投票2</h2>

40.1	接口声明  
rpc VoteWitnessAccount2 (VoteWitnessContract) returns (TransactionExtention){};  
40.2	提供节点  
fullnode。  
40.3	参数说明  
VoteWitnessContract：包含投票人地址和一个投票对象列表(最多不能超过30个投票对象)，包含候选人地址和投票数。  
40.4	返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。   
40.5	功能说明  
投票功能。只能对超级代表候选人进行投票，投票总数量不能大于账户锁定资金的数量，参见25 锁定资金。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="41">41. 通证发行2</h2>
        
41.1	接口声明  
rpc CreateAssetIssue2 (AssetIssueContract) returns (TransactionExtention) {};  
41.2	提供节点  
fullnode。  
41.3	参数说明  
AssetIssueContract：包含发行人地址、通证名称、总发行量、波场币vs通证汇兑比例、开始时间、结束时间、衰减率、投票分数、详细描述、url、每账户最多消耗带宽值，总带宽消耗值以及token冻结资产。 
41.4	返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。 
41.5	功能说明  
发行通证。所有人都可以发行通证，发行通证会消耗1024个trx。发行通证后，在有效期内任何人都可以参与通证发行，用trx按照比例兑换通证。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

+ 示例：

`assetissue password abc 1000000 1 1 2018-5-31 2018-6-30 abcdef a.com 1000 1000000 200000 180 300000 365` 

以上命令的发行了名为abc的资产，发行总量为100万，abc与TRX的兑换比例为1:1，发行日期为2018-5-31至2018-6-30，描述为abcdef，网址为a.com，
每个账户每天的token转账最多消耗自己1000 bandwidth points，整个网络每天最多消耗自己1000000 bandwidth points。其中20万锁仓180天，30万锁仓365天。

## <h2 id="42">42. 更新超级代表候选人信息2</h2>

42.1 接口声明  
rpc UpdateWitness2 (WitnessUpdateContract) returns (TransactionExtention) {};  
42.2 提供节点  
fullnode。  
42.3 参数说明  
WitnessUpdateContract：包含账户地址、Url。  
42.4 返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
42.5 功能说明  
更新超级代表的url。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="43">43. 创建账户2</h2>

43.1	接口声明  
rpc CreateAccount2 (AccountCreateContract) returns (TransactionExtention){};  
43.2	提供节点  
fullnode。  
43.3	参数说明  
AccountCreateContract：包含账户类型、账户地址。  
43.4	返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
43.5	功能说明  
创建账号并写入区块链。应该先离线生成一个地址，再通过该API激活该地址。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="44">44. 申请成为超级代表候选人2</h2>

44.1 接口声明
rpc CreateWitness2 (WitnessCreateContract) returns (TransactionExtention) {};  
44.2 提供节点  
fullnode。  
44.3 参数说明  
WitnessCreateContract：包含账户地址、Url。  
44.4 返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
44.5 功能说明  
每个波场用户都可以申请成为超级代表候选人。要求账户在区块链上已经创建。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="45">45. 转让通证2</h2>

45.1 接口声明  
rpc TransferAsset2 (TransferAssetContract) returns (TransactionExtention){};  
45.2 提供节点  
fullnode。  
45.3 参数说明  
TransferAssetContract：包含通证名称、提供方地址、接收方地址、通证数量。  
45.4 返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
45.5 功能说明  
转让通证。创建一个转让通证的交易。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="46">46. 参与通证发行2</h2>

46.1 接口声明  
rpc ParticipateAssetIssue2 (ParticipateAssetIssueContract) returns (TransactionExtention){};  
46.2 提供节点  
fullnode。  
46.3 参数说明  
ParticipateAssetIssueContract：包含参与方地址、发行方地址、通证名称、参与金额，其中金额的单位为sun。  
46.4 返回值  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
46.5 功能说明  
参与通证发行。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="47">47. 锁定资金2</h2>

47.1 接口声明                                                                                  
rpc FreezeBalance2 (FreezeBalanceContract) returns (TransactionExtention) {};                                                                                  
47.2 提供节点                                                                                                                                                           
fullnode。                                                                                  
47.3 参数说明                                                                                                                                                
FreezeBalanceContract：包含地址、锁定资金、锁定时间。目前锁定时间只能是3天。                                                                                  
47.4 返回值                                                                                                                                          
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。                                                                                   
47.5 功能说明                                                                                                                                            
锁定资金将带来两个收益：
a.获得带宽。                                                                                                                                                                    
b.获得投票的权利。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="48">48. 解除资金锁定2</h2>

48.1 接口声明                                                                                  
rpc UnfreezeBalance2 (UnfreezeBalanceContract) returns (TransactionExtention) {};                                                                                  
48.2 提供节点                                                                                    
fullnode。                                                                                    
48.3 参数说明                                                                                   
UnfreezeBalanceContract：包含地址。                                                                                  
48.4 返回值                                                                                   
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。                                                                                   
48.5 功能说明                                                                                    
锁定资金3天之后才允许解除锁定。解除锁定，将清除投票记录和带宽。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="49">49. 解冻通证2</h2>

49.1 接口声明  
rpc UnfreezeAsset2 (UnfreezeAssetContract) returns (TransactionExtention) {};  
49.2 提供节点  
fullnode。  
49.3 参数说明                                                                                  
UnfreezeAssetContract：包含地址。  
49.4 返回值                                                                                  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。                                                                                       
49.5 功能说明                                                                                  
通证发行者解冻发行时冻结的通证。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="50">50. 赎回出块奖励2</h2>

50.1 接口声明                                                                                  
rpc WithdrawBalance2 (WithdrawBalanceContract) returns (TransactionExtention) {};                                                                                    
50.2 提供节点                                                                                    
fullnode。                                                                                    
50.3 参数说明                                                                                          
WithdrawBalanceContract：包含地址。                                                                                       
50.4 返回值                                                                                   
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。                                                                                       
50.5 功能说明                                                                                       
本接口仅提供给超级代表。超级代表记账成功后，将获得奖励，奖励不直接增加到账户余额上。每24小时允许提取一次到账户余额。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="51">51.  更新通证2</h2>
51.1 接口声明                                                                                  
rpc UpdateAsset2 (UpdateAssetContract) returns (TransactionExtention) {};  
51.2 提供节点                                                                                  
fullnode。  
51.3 参数说明                                                                                  
UpdateAssetContract：包括通证发行者的地址、通证的描述、通证的url、每账户最多消耗带宽值、总带宽消耗值  
51.4 返回值                                                                                  
TransactionExtention：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。                                                                                         
51.5 功能说明                                                                                  
只能由通证发行者发起，更新通证的描述、通证的url、每账户最多消耗带宽值、总带宽消耗值
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="52">52. 获取当前区块2</h2>

52.1 接口声明  
rpc GetNowBlock2 (EmptyMessage) returns (BlockExtention) {};  
52.2 提供节点  
fullnode、soliditynode。  
52.3 参数说明  
EmptyMessage：空。  
52.4 返回值  
BlockExtention：当前区块信息，包含区块id。  
52.5 功能说明  
获取当前最新的区块。

## <h2 id="53">53. 按照高度获取区块2</h2>

53.1 接口声明  
rpc GetBlockByNum2 (NumberMessage) returns (BlockExtention) {};  
53.2 提供节点  
fullnode、soliditynode。  
53.3 参数说明  
NumberMessage：区块高度。  
53.4 返回值  
BlockExtention：区块信息，包含区块id。  
53.5 功能说明  
获取指定高度的区块，如果找不到则返回创世区块。

## <h2 id="54">54. 分页获取区块2</h2>

54.1 接口声明  
rpc GetBlockByLimitNext2 (BlockLimit) returns (BlockListExtention) {};  
54.2 提供节点  
fullnode  
54.3 参数说明  
BlockLimit：区块起止范围。  
54.4 返回值  
BlockListExtention：区块列表。  
54.5 功能说明  
根据范围查询区块，用与分页查询所有区块。

## <h2 id="55">55. 查询最后区块2</h2>

55.1 接口声明  
rpc GetBlockByLatestNum2 (NumberMessage) returns (BlockListExtention) {};  
55.2 提供节点  
fullnode  
55.3 参数说明  
NumberMessage：需要查询的区块数量。  
55.4 返回值  
BlockListExtention：区块列表。  
55.5 功能说明  
查询最后的一定数量的区块。

## <h2 id="56">56. 对交易进行签名2</h2>
56.1 接口说明                                                                                  
rpc GetTransactionSign2 (TransactionSign) returns (TransactionExtention) {};  
56.2 提供节点                                                                                  
fullnode  
56.3 参数说明                                                                                  
TransactionSign：待签名Transaction对象和签名用的private key  
56.4 返回值                                                                                  
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
56.5	功能说明  
使用API对交易进行签名。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## <h2 id="57">57. 通过地址查询所有发起交易2</h2>

57.1 接口声明  
GetTransactionsFromThis2 (AccountPaginated) returns (TransactionListExtention) {};  
57.2 提供节点  
soliditynode。  
57.3 参数说明  
AccountPaginated：发起方账户地址及查询范围。  
57.4 返回值  
TransactionListExtention：交易列表。  
57.5 功能说明  
通过账户地址查询所有发起的交易。

## <h2 id="58">58. 通过地址查询所有接收交易2</h2>

58.1 接口声明  
rpc GetTransactionsFromThis2 (AccountPaginated) returns (TransactionListExtention) {};  
58.2 提供节点  
soliditynode。  
58.3 参数说明  
AccountPaginated：发起方账户地址及查询范围。  
58.4 返回值  
TransactionListExtention：交易列表。  
58.5 功能说明  
通过账户地址查询所有其它账户发起和本账户有关的交易。

## <h2 id="59">59. 创建交易对</h2> 

59.1 接口声明  
rpc ExchangeCreate (ExchangeCreateContract) returns (TransactionExtention) {};  
59.2 提供节点  
fullnode。  
59.3 参数说明   
first_token_id，第1种token的id
first_token_balance，第1种token的balance
second_token_id，第2种token的id
second_token_balance，第2种token的balance  
59.4 返回值                                          
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
59.5 功能说明  
创建交易对


## <h2 id="60">60. 交易所注资</h2>  

60.1 接口声明  
rpc ExchangeInject (ExchangeInjectContract) returns (TransactionExtention) {};  
60.2 提供节点  
fullnode。  
60.3 参数说明   
exchange_id：交易对id
token_id：注资的token的id
quant：注资数量
60.4 返回值                                          
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
60.5 功能说明 
对交易对进行注资

## <h2 id="61">61. 交易所撤资</h2> 

61.1 接口声明  
rpc ExchangeWithdraw (ExchangeWithdrawContract) returns (TransactionExtention) {};  
61.2 提供节点  
fullnode。  
61.3 参数说明   
exchange_id：交易对id
token_id：撤资的token的id
quant：撤资数量
61.4 返回值                                          
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
61.5 功能说明 
对交易对进行撤资


## <h2 id="62">62. 交易所交易</h2> 

62.1 接口声明  
rpc ExchangeTransaction (ExchangeTransactionContract) returns (TransactionExtention) {};  
62.2 提供节点  
fullnode。  
62.3 参数说明    
exchange_id：交易对id
token_id：撤资的token的id
quant：撤资数量
expected：期望得到的另一个token的最小金额
62.4 返回值                                          
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
62.5 功能说明 
交易

## <h2 id="63">63. 查询所有交易对</h2> 

63.1 接口声明  
rpc ListExchanges (EmptyMessage) returns (ExchangeList) {};  
63.2 提供节点  
fullnode。  
63.3 参数说明    
无
63.4 返回值                                          
ExchangeList：所有交易对。
63.5 功能说明 

## <h2 id="64">64. 查询指定交易对</h2> 

64.1 接口声明  
rpc GetExchangeById (BytesMessage) returns (Exchange) {};  
64.2 提供节点  
fullnode。  
64.3 参数说明 
value：交易对id
64.4 返回值                                          
Exchange：交易对。
64.5 功能说明 

## <h2 id="65">65. 分页查询交易对</h2> 

65.1 接口声明  
rpc GetPaginatedExchangeList (PaginatedMessage) returns (ExchangeList) {};  
65.2 提供节点  
fullnode。  
65.3 参数说明 
offset：偏移量
limit：个数限制
65.4 返回值                                          
Exchange：交易对。
65.5 功能说明 
 
## <h2 id="66">66. 创建提议</h2> 

66.1 接口声明  
rpc ProposalCreate (ProposalCreateContract) returns (TransactionExtention) {};  
66.2 提供节点  
fullnode。  
66.3 参数说明 
parameters：提议参数
66.4 返回值                                             
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
66.5 功能说明 

## <h2 id="67">67. 赞成提议</h2> 

67.1 接口声明  
rpc ProposalApprove (ProposalApproveContract) returns (TransactionExtention) {};  
67.2 提供节点  
fullnode。  
67.3 参数说明 
proposal_id ：提议id
is_add_approval ：赞成或取消赞成
67.4 返回值                                             
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
67.5 功能说明 

## <h2 id="68">68. 删除提议</h2> 

68.1 接口声明  
rpc ProposalDelete (ProposalDeleteContract) returns (TransactionExtention) {};  
68.2 提供节点  
fullnode。  
68.3 参数说明 
proposal_id ：提议id 
68.4 返回值                                             
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
68.5 功能说明 

## <h2 id="69">69. 查询所有提议</h2> 

69.1 接口声明  
rpc ListProposals (EmptyMessage) returns (ProposalList) {};  
69.2 提供节点  
fullnode。  
69.3 参数说明 
无
69.4 返回值                                             
ProposalList：提议列表
69.5 功能说明 

## <h2 id="70">70. 分页查询提议</h2> 

70.1 接口声明  
rpc GetPaginatedProposalList (PaginatedMessage) returns (ProposalList) {};  
70.2 提供节点  
fullnode。  
70.3 参数说明 
offset：偏移量
limit：个数限制
70.4 返回值                                             
ProposalList：提议列表
70.5 功能说明 

## <h2 id="71">71. 查询指定提议</h2> 

71.1 接口声明  
rpc GetProposalById (BytesMessage) returns (Proposal) {};  
71.2 提供节点  
fullnode。  
71.3 参数说明 
proposal_id ：提议id 
71.4 返回值                                             
ProposalList：提议列表
71.5 功能说明 

## <h2 id="72">72. 查询资源委派账户索引</h2> 

72.1 接口声明  
rpc GetDelegatedResourceAccountIndex (BytesMessage) returns (DelegatedResourceAccountIndex) { };\
72.2 提供节点  
fullnode。  
72.3 参数说明 
BytesMessage ：查询的账户地址\
72.4 返回值               
account：查询的地址 \
fromAccounts：从哪些账户中获得了资源 \
toAccounts：给哪些账户中委派了资源\
72.5 功能说明 

## <h2 id="73">73. 查询资源委派的详细信息</h2> 

73.1 接口声明  
rpc GetDelegatedResource (DelegatedResourceMessage) returns (DelegatedResourceList) {
  };\
73.2 提供节点  
fullnode。  
73.3 参数说明  
fromAddress ：资源委派发起地址 \
toAddress ：资源委派接受地址\
73.4 返回值         
DelegatedResourceList:只包含一个元素 \
from:发起资源委派的地址\
to:接受资源委派的地址\
frozen_balance_for_bandwidth:委派的带宽\
frozen_balance_for_energy:委派的energy\
expire_time_for_bandwidth:委派的带宽解冻时间\
expire_time_for_energy:委派的energy解冻时间\
73.5 功能说明  

## <h2 id="74">74. 通证快捷转账</h2> 

74.1 接口说明                                                                                  
rpc EasyTransferAsset (EasyTransferAssetMessage) returns (EasyTransferResponse) {};  
74.2 提供节点                                                                                  
fullnode  
74.3 参数说明                                                                                  
EasyTransferAssetMessage：转账用的密码，toAddress，通证ID，转账的数量  
74.4 返回值                                                                                  
EasyTransferResponse：转账创建的transaction，交易ID，以及广播的结果result

## <h2 id="75">75. 通证快捷转账（通过私钥）</h2>

75.1 接口说明                                                                                  
rpc EasyTransferAssetByPrivate (EasyTransferAssetByPrivateMessage) returns (EasyTransferResponse) {};  
75.2 提供节点                                                                                  
fullnode  
75.3 参数说明                                                                                  
EasyTransferAssetByPrivateMessage：转账用的私钥，toAddress，通证ID，转账的数量  
75.4 返回值                                                                                  
EasyTransferResponse：转账创建的transaction，交易ID，以及广播的结果result

## <h2 id="76">76. 更新用户权限（用于多重签名）</h2>

76.1 接口说明                                                                                  
rpc AccountPermissionUpdate (AccountPermissionUpdateContract) returns (TransactionExtention)  {}\
76.2 提供节点                                                                                  
fullnode  
76.3 参数说明                                                                                  
owner_address：待修改权限的账户的地址\
owner：修改后的 owner 权限\
witness：修改后的 witness 权限（如果是 witness ）\
actives：修改后的 actives 权限
 
76.4 返回值                                                                                  
TransactionExtention：转账创建的transaction，交易ID，以及广播的结果result




## <h2 id="77">77. 增加签名（用于多重签名）</h2>

77.1 接口说明                                                                                  
rpc AddSign (TransactionSign) returns (TransactionExtention) {}\
77.2 提供节点                                                                                  
fullnode  
77.3 参数说明                                                                                  
TransactionSign：交易，私钥  
77.4 返回值                                                                                  
TransactionExtention：转账创建的transaction，交易ID，以及广播的结果result

## <h2 id="78">78. 查询已签名地址（用于多重签名）</h2>

78.1 接口说明                                                                                  
rpc GetTransactionApprovedList(Transaction) returns (TransactionApprovedList)   {}\
78.2 提供节点                                                                                  
fullnode  
78.3 参数说明                                                                                 
Transaction：交易\
78.4 返回值                                                                                  
TransactionApprovedList：已签名的地址，交易

## <h2 id="79">79. 查询交易签名权重（用于多重签名）</h2>

79.1 接口说明                                                                                  
rpc GetTransactionSignWeight (Transaction) returns (TransactionSignWeight) {}\
79.2 提供节点                                                                                  
fullnode  
79.3 参数说明                                                                                 
Transaction：交易\
79.4 返回值                                                                                  
TransactionSignWeight：结果result（交易的签名是否满足权限阈值）

## <h2 id="80">80. 部署智能合约</h2>

80.1 接口说明                                                                                  
rpc DeployContract (CreateSmartContract) returns (TransactionExtention) {};\
80.2 提供节点                                                                                  
fullnode  
80.3 参数说明                                                                                 
CreateSmartContract：提供创建合约信息的交易类型对象，包含owner_address(交易发送者地址), new_contract（SmartContract类型对象）, call_token_value(trc10), token_id(trc10) 4个参数\
附new_contract: smartcontract信息，包括，origin_address（合约部署者地址）， contract_address（合约地址，默认为空），abi，bytecode，call_value（trx放入合约数量），consume_user_resource_percent（调用合约时用户方需支付的energy占所有花费比例）， name（合约名字）， origin_energy_limit（开发者愿意帮助用户支付的最高energy数量) \
80.4 返回值                                                                                  
TransactionExtention：展示交易执行结果的信息类型对象，包含transaction, transaction_id, constant_result 以及 on-block result.

## <h2 id="81">81. 执行智能合约</h2>

81.1 接口说明                                                                                  
rpc TriggerContract (TriggerSmartContract) returns (TransactionExtention) {};\
81.2 提供节点                                                                                  
fullnode  
81.3 参数说明                                                                                 
TriggerSmartContract：提供执行合约信息的交易类型对象，包含owner_address(交易发送者地址), contract_address, call_value(随交易打入合约的trx数量), data(被调用的方法的签名及参数), call_token_value(trc10数量), token_id(trc10 id) 6个参数\
81.4 返回值                                                                                  
TransactionExtention：展示交易执行结果的信息类型对象，包含transaction, transaction_id, constant_result 以及 on-block result.
