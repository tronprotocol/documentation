# 波场钱包RPC-API 

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
TransferContract：包含提供方地址、接收方地址、金额，其中金额的单位为drop。  
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

## 4. 查询所有账户列表

4.1	接口声明  
rpc ListAccounts (EmptyMessage) returns (AccountList);  
4.2	提供节点  
fullnode、soliditynode。  
4.3	参数说明  
EmptyMessage：空。  
4.4	返回值  
AccountList： Account的列表。  
4.5	功能说明。  
查询目前在区块链中保存的所有账户信息。

## 5. 创建账户(删除，不再提供)

5.1	接口声明  
rpc CreateAccount (AccountCreateContract) returns (Transaction){};  
5.2	提供节点  
fullnode。  
5.3	参数说明  
AccountCreateContract：包含账户类型、账户名称、账户地址。  
5.4	返回值  
Transaction：返回包含创建账户的交易，钱包签名后再请求广播交易。  
5.5	功能说明  
注册。钱包注册时可以创建一个账户（也可以选择不创建，）。

## 6. 更新账户

6.1	接口声明  
rpc UpdateAccount (AccountUpdateContract) returns (Transaction){};  
6.2	提供节点  
fullnode。  
6.3	参数说明  
AccountUpdateContract：包含账户名称、账户地址。  
6.4	返回值  
Transaction：返回包含更新账户的交易，钱包签名后再请求广播交易。  
6.5	功能说明  
更新账户名称。

## 7. 投票

7.1	接口声明  
rpc VoteWitnessAccount (VoteWitnessContract) returns (Transaction){};  
7.2	提供节点  
fullnode。  
7.3	参数说明  
VoteWitnessContract：包含投票人地址和一个投票对象列表，包含候选人地址和投票数。  
7.4	返回值  
Transaction：返回包含投票的交易，钱包签名后再请求广播交易。  
7.5	功能说明  
<<<<<<< HEAD
投票功能。只能对超级代表候选人进行投票，投票总数量不能大于账户锁定资金的数量，（参见26 锁定资金）。
=======
投票功能。只能对超级代表候选人进行投票，投票总数量不能大于账户锁定资金的数量，参见26 锁定资金。
>>>>>>> upstream/master

## 8. 通证发行波场钱包RPC-API 
        
8.1	接口声明  
rpc CreateAssetIssue (AssetIssueContract) returns (Transaction) {};  
8.2	提供节点  
fullnode。  
8.3	参数说明  
AssetIssueContract：包含发行人地址、通证名称、总发行量、波场币vs通证汇兑比例、开始时间、结束时间、衰减率、投票分数、详细描述、url等。 
8.4	返回值  
Transaction：返回通证发行的交易，钱包签名后再请求广播交易。  
8.5	功能说明  
发行通证。所有人都可以发行通证，发行通证会消耗1024个trx。发行通证后，在有效期内任何人都可以参与通证发行，用trx按照比例兑换通证。

## 9. 查询超级代表候选人列表

9.1	接口声明  
rpc ListWitnesses (EmptyMessage) returns (WitnessList) {};  
9.2	提供节点  
fullnode、soliditynode。  
9.3	参数说明  
EmptyMessage：空。  
9.4 返回值  
WitnessList： Witness的列表。所有超级代表的候选人详细信息。  
9.5	功能说明  
投票前要查询所有候选人，并且展示出详细信息，供用户选择投票。

## 10. 申请成为超级代表候选人

10.1 接口声明
rpc CreateWitness (WitnessCreateContract) returns (Transaction) {};
10.2 提供节点  
fullnode。  
10.3 参数说明  
WitnessCreateContract：包含账户地址、Url。  
10.4 返回值  
Transaction：返回包含申请成为候选人的交易，钱包签名后再请求广播交易。  
10.5 功能说明  
每个波场用户都可以申请成为超级代表候选人。要求账户在区块链上已经创建。

## 11. 更新超级代表候选人信息

11.1 接口声明  
rpc UpdateWitness (WitnessUpdateContract) returns (Transaction) {};  
11.2 提供节点  
fullnode。
11.3 参数说明  
WitnessUpdateContract：包含账户地址、Url。  
11.4 返回值  
Transaction：返回包含更新候选人信息的交易，钱包签名后再请求广播交易。  
11.5 功能说明  
更新超级代表的url。

## 12. 转让通证

12.1 接口声明  
rpc TransferAsset (TransferAssetContract) returns (Transaction){};  
12.2 提供节点  
fullnode。  
12.3 参数说明  
TransferAssetContract：包含通证名称、提供方地址、接收方地址、通证数量。  
12.4 返回值  
Transaction：返回包含转让通证的交易，钱包签名后再请求广播交易。  
12.5 功能说明  
转让通证。创建一个转让通证的交易。

## 13. 参与通证发行

13.1 接口声明  
rpc ParticipateAssetIssue (ParticipateAssetIssueContract) returns (Transaction){};  
13.2 提供节点  
fullnode。  
13.3 参数说明  
ParticipateAssetIssueContract：包含参与方地址、发行方地址、通证名称、参与金额，其中金额的单位为drop。  
13.4 返回值  
Transaction：返回包含参与通证发行的交易，钱包签名后再请求广播交易。  
13.5 功能说明  
参与通证发行。


## 14 查询所有节点

14.1 接口声明  
rpc ListNodes (EmptyMessage) returns (NodeList) {};  
14.2 提供节点  
fullnode、soliditynode。  
14.3 参数说明  
EmptyMessage：空。  
14.4 返回值  
NodeList：Node的列表，包含ip和端口。  
14.5 功能说明  
列举所有在线的节点ip和端口。

## 15. 查询所有通证列表

15.1 接口声明  
rpc GetAssetIssueList (EmptyMessage) returns (AssetIssueList) {};  
15.2 提供节点  
fullnode、soliditynode。  
15.3 参数说明  
EmptyMessage：空  
15.4 返回值  
AssetIssueList： AssetIssueContract的列表。所有已发行通证详细信息。  
15.5 功能说明  
全部通证列表。展示所有通证，供用户选择参与。

## 16. 查询某个账户发行的通证列表

16.1 接口声明  
rpc GetAssetIssueByAccount (Account) returns (AssetIssueList) {};  
16.2 提供节点  
fullnode、soliditynode。  
16.3 参数说明  
Account：只需要输入address即可  
16.4 返回值  
AssetIssueList： AssetIssueContract的列表。  
16.5 功能说明  
查询某个账户发行的所有通证。

## 17. 按通证名称查询通证信息

17.1 接口声明  
rpc GetAssetIssueByName (BytesMessage) returns (AssetIssueContract) {};  
17.2 提供节点  
fullnode、soliditynode。  
17.3 参数说明  
BytesMessage：通证名称。  
17.4 返回值  
AssetIssueContract：通证详细信息。  
17.5 功能说明  
按照通证名称查询通证。通证名称在波场中确保唯一。

## 18. 查询当前时间有效发行的通证列表

18.1 接口声明  
rpc GetAssetIssueListByTimestamp (NumberMessage) returns (AssetIssueList){};  
18.2 提供节点  
soliditynode。  
18.3 参数说明  
NumberMessage：当前时间。相对于1970年的毫秒数。  
18.4 返回值  
AssetIssueList： AssetIssueContract的列表。所有正在发行的通证详细信息。  
18.5 功能说明  
全部通证列表。展示当前发行通证，供用户选择参与。

## 19. 获取当前区块

19.1 接口声明  
rpc GetNowBlock (EmptyMessage) returns (Block) {};  
19.2 提供节点  
fullnode、soliditynode。  
19.3 参数说明  
EmptyMessage：空。  
19.4 返回值  
Block：当前区块信息。  
19.5 功能说明  
获取当前最新的区块。

## 20. 按照高度获取区块

20.1 接口声明  
rpc GetBlockByNum (NumberMessage) returns (Block) {};  
20.2 提供节点  
fullnode、soliditynode。  
20.3 参数说明  
NumberMessage：区块高度。  
20.4 返回值  
Block：区块信息。  
20.5 功能说明  
获取指定高度的区块，如果找不到则返回创世区块。

## 21. 获取交易总数

21.1 接口声明  
rpc TotalTransaction (EmptyMessage) returns (NumberMessage) {};  
21.2 提供节点
fullnode、soliditynode。  
21.3 参数说明  
EmptyMessage：空。  
21.4 返回值  
NumberMessage：交易总数。  
21.5 功能说明  
获取交易的总数量。

## 22. 通过ID查询交易

22.1 接口声明  
rpc getTransactionById (BytesMessage) returns (Transaction) {};  
22.2 提供节点  
soliditynode。  
22.3 参数说明  
BytesMessage：交易ID，也就是其Hash值。  
22.4 返回值  
Transaction：被查询的交易。  
22.5 功能说明  
通过ID查询交易的详细信息，ID就是交易数据的Hash值。

## 23. 通过时间查询交易

23.1 接口声明  
rpc getTransactionsByTimestamp (TimeMessage) returns (TransactionList) {};  
23.2 提供节点  
soliditynode。  
23.3 参数说明  
TimeMessage：包含开始时间和结束时间。  
23.4 返回值  
TransactionList：交易列表。  
23.5 功能说明  
通过起止时间查询所有发生的交易。

## 24. 通过地址查询所有发起交易

24.1 接口声明  
rpc getTransactionsFromThis (Account) returns (TransactionList) {};  
24.2 提供节点  
soliditynode。  
24.3 参数说明  
Account：发起方账户，只需要地址。  
24.4 返回值  
TransactionList：交易列表。  
24.5 功能说明  
通过账户地址查询所有发起的交易。

## 25. 通过地址查询所有接收交易

25.1 接口声明  
rpc getTransactionsToThis (Account) returns (NumberMessage) {};  
25.2 提供节点  
soliditynode。  
25.3 参数说明  
Account：接收方账户，只需要地址。  
25.4 返回值  
TransactionList：交易列表。  
25.5 功能说明  
通过账户地址查询所有其它账户发起和本账户有关的交易。

<<<<<<< HEAD
## 26. 锁定资金  
26.1 接口声明 rpc FreezeBalance (FreezeBalanceContract) returns (Transaction) {};   
26.2 提供节点 fullnode。  
 26.3 参数说明 FreezeBalanceContract：包含地址、锁定资金、锁定时间。目前锁定时间只能是3天。   
26.4 返回值 Transaction：返回包含资金的交易，钱包签名后再请求广播交易。   
26.5 功能说明  
 锁定资金将带来两个收益：  
a.获得熵，每次要更新区块链的交易都需要消耗熵(如果当前交易距离上次交易超过10s，本次交易不消耗熵)。获得熵=drops*锁定天数。每次交易（所有会修改区块链账本的操作）消耗熵为100000。   
b.获得投票的权利，锁定多少个trx就获得多少个投票权。

## 27. 解除资金锁定  
27.1 接口声明 rpc UnfreezeBalance (UnfreezeBalanceContract) returns (Transaction) {};   
27.2 提供节点 fullnode。   
27.3 参数说明 UnfreezeBalanceContract：包含地址。  
 27.4 返回值 Transaction：返回交易，钱包签名后再请求广播交易。  
 27.5 功能说明  
只有最后一次锁定资金，3天之后才允许解除锁定。解除锁定，将清除投票记录。解除锁定，不会清除已经获得的带宽。 锁定资金超过3天后，不会自动解除锁定。

## 28. 赎回出块奖励  
28.1 接口声明 rpc WithdrawBalance (WithdrawBalanceContract) returns (Transaction) {};   
28.2 提供节点 fullnode。  
 28.3 参数说明 WithdrawBalanceContract：包含地址。  
 28.4 返回值 Transaction：返回交易，钱包签名后再请求广播交易。   
28.5 功能说明  
本接口仅提供给超级代表。超级代表记账成功后，将获得奖励，奖励不直接增加到账户余额上。而是单独保存在账户allowance字段，每24小时允许提取一次到账户余额。

=======
## 26. 锁定资金

26.1 接口声明                                                                                  
rpc FreezeBalance (FreezeBalanceContract) returns (Transaction) {};                                                                                  
26.2 提供节点                                                                                                                                                           
fullnode。                                                                                  
26.3 参数说明                                                                                                                                                
FreezeBalanceContract：包含地址、锁定资金、锁定时间。目前锁定时间只能是3天。                                                                                  
26.4 返回值                                                                                                                                          
Transaction：返回包含资金的交易，钱包签名后再请求广播交易。                                                                                   
26.5 功能说明                                                                                                                                            
锁定资金将带来两个收益：
a.获得带宽，每次要更新区块链的交易都需要消耗带宽(如果当前交易距离上次交易超过10s，本次交易不消耗带宽)。获得带宽=drops*锁定天数。每次交易（所有会修改区块链账本的操作）消耗带宽为100000。                                                                                                                                                                    
b.获得投票的权利，锁定多少个trx就获得多少个投票权。

## 27. 解除资金锁定

27.1 接口声明                                                                                  
rpc UnfreezeBalance (UnfreezeBalanceContract) returns (Transaction) {};                                                                                  
27.2 提供节点                                                                                    
fullnode。                                                                                    
27.3 参数说明                                                                                   
UnfreezeBalanceContract：包含地址。                                                                                  
27.4 返回值                                                                                   
Transaction：返回交易，钱包签名后再请求广播交易。                                                                                   
27.5 功能说明                                                                                    
只有最后一次锁定资金，3天之后才允许解除锁定。解除锁定，将清除投票记录。解除锁定，不会清除已经获得的带宽。
锁定资金超过3天后，不会自动解除锁定。

## 28. 赎回出块奖励

28.1 接口声明                                                                                  
rpc WithdrawBalance (WithdrawBalanceContract) returns (Transaction) {};                                                                                    
28.2 提供节点                                                                                    
fullnode。                                                                                    
28.3 参数说明                                                                                          
WithdrawBalanceContract：包含地址。                                                                                       
28.4 返回值                                                                                   
Transaction：返回交易，钱包签名后再请求广播交易。                                                                                       
28.5 功能说明                                                                                       
本接口仅提供给超级代表。超级代表记账成功后，将获得奖励，奖励不直接增加到账户余额上。而是单独保存在账户allowance字段，每24小时允许提取一次到账户余额。
>>>>>>> upstream/master

