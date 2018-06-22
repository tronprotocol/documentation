# 波场钱包RPC-API 

## API的具体定义请参考：

https://github.com/tronprotocol/java-tron/blob/develop/src/main/protos/api/api.proto

## 你可能需要经常用到的如下几个API：
 
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

## 1. 获取账户信息

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

## 2. 转让波场币

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

## 3. 广播交易  

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

## 4. 创建账户

4.1	接口声明  
rpc CreateAccount (AccountCreateContract) returns (Transaction){};  
4.2	提供节点  
fullnode。  
4.3	参数说明  
AccountCreateContract：包含账户类型、账户地址。  
4.4	返回值  
Transaction：返回包含创建账户的交易，钱包签名后再请求广播交易。  
4.5	功能说明  
注册。钱包注册时可以创建一个账户（也可以选择不创建，）。

## 5. 更新账户

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

## 6. 投票

6.1	接口声明  
rpc VoteWitnessAccount (VoteWitnessContract) returns (Transaction){};  
6.2	提供节点  
fullnode。  
6.3	参数说明  
VoteWitnessContract：包含投票人地址和一个投票对象列表，包含候选人地址和投票数。  
6.4	返回值  
Transaction：返回包含投票的交易，钱包签名后再请求广播交易。  
6.5	功能说明  
投票功能。只能对超级代表候选人进行投票，投票总数量不能大于账户锁定资金的数量，参见25 锁定资金。

## 7. 通证发行
        
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


## 8. 查询超级代表候选人列表

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

## 9. 申请成为超级代表候选人

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

## 10. 更新超级代表候选人信息

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

## 11. 转让通证

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

## 12. 参与通证发行

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


## 13 查询所有节点

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

## 14. 查询所有通证列表

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

## 15. 查询某个账户发行的通证列表

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

## 16. 按通证名称查询通证信息

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

## 17. 查询当前时间有效发行的通证列表

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

## 18. 获取当前区块

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

## 19. 按照高度获取区块

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

## 20. 获取交易总数

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

## 21. 通过ID查询交易

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

## 22. 通过时间查询交易

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

## 23. 通过地址查询所有发起交易

23.1 接口声明  
rpc getTransactionsFromThis (Account) returns (TransactionList) {};  
23.2 提供节点  
soliditynode。  
23.3 参数说明  
Account：发起方账户，只需要地址。  
23.4 返回值  
TransactionList：交易列表。  
23.5 功能说明  
通过账户地址查询所有发起的交易。

## 24. 通过地址查询所有接收交易

24.1 接口声明  
rpc getTransactionsToThis (Account) returns (NumberMessage) {};  
24.2 提供节点  
soliditynode。  
24.3 参数说明  
Account：接收方账户，只需要地址。  
24.4 返回值  
TransactionList：交易列表。  
24.5 功能说明  
通过账户地址查询所有其它账户发起和本账户有关的交易。

## 25. 锁定资金

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

## 26. 解除资金锁定

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

## 27. 赎回出块奖励

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

## 28. 解冻通证

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

## 29. 查询下次维护时刻

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

## 30. 查询交易信息

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

## 31.根据ID查询区块 
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

## 32.更新通证
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