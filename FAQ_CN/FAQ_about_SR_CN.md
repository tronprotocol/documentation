
Private运行环境下full node模式的问题
-----
1. config.conf中的genesis.block.witnesses替换成在https://trxscan.org/注册时给出的address字符串：
  是否需要删除其他address？url和voteCount字段是否需要删除？
  
2. seed.node ip.list 替换成自己公网的ip地址后，使用启动命令 java -jar java-tron.jar 启动后，如何测试部署是否正常，比如是否有测试接口或者命令，类似redis，get ping 会返回 pong？


Private运行环境下super node模式的问题
-----
1. 在部署private 环境时，Super Node和Full Node 关系是什么样子？是否需要先部署Super Node ,然后部署Full Node ？

2. Private环境，因为我看官网是通过手动投票产生的SuperNode节点，是否还需要提交TRON资料审核注册成为Super Node节点？

3. 既然是Private环境，为什么日志还持续的更新全网其他节点，并同步保存信息？那么private 和public 的区别是什么？


public运行环境下关于网络结构的问题
-----

1. 单点的java程序最大能支持多少内存，cpu，处理请求等？

2. 这个网络流量大概是多少，我们是准备多台主机前面挂负载，还是提供多节点即可？

3. 对公网需要暴露那些服务端口？

4. tokens 申请完成后，如何由not started yet 变更成 participate?


运行超级节点报错
-----
1. 以下错误信息表达了什么意思？

       17:02:42.699 INFO [o.t.c.s.WitnessService] Try Produce Block
       17:02:42.699 INFO [o.t.c.s.WitnessService] Not sync


超级节点出块问题
-----
1. 超级节点也是轮流出块的吗？出块间隔是多少？是不是24小时无心跳消息就从超级节点列表里删除了？

2. 在最坏情况下，万一超级节点无法联通，最多允许多长时间恢复服务？

3. 超级节点出块miss率的计算公式是什么？

4. 超级节点服务器的测试版本，或者源码开放了吗？

5. 我怎样才能知道我的测试超级节点在运行了呢？

6. 另外，根据这个命令：java -jar java-tron.jar -p yourself private key --witness -c yourself config.conf(Example：/data/java-tron/config.conf，我怎样才知道运行的是超级节点？

7. 有什么命令行命令可以生成地址，发送tron的吗？一定要通过web wallet?

8. 我们要测试超级节点出块和性能的情况，是不是需要你们投票我们的节点才能竞选上？

9. 那现在是不是可以看节点有没有出块了？

10. 请问刚上线是否出块时间是5秒一块？预计在什么时间会变成1秒1块？

11. 未来大概会有出块的TRX会减半的计划吗？如果有的话，大概在什么时间点？

12. 当27节点中有一个 出现故障时， 会自动检测并取消轮询资格吧？  出现这种情况保留超级代表资格否？ 如果资格被取消后，何时可以恢复资格？


超级代表选举问题
-----

1. 为啥我刚才给自己的节点投了 2百万的 trx 投票，在 https://tronscan.org/#/network 看我自己的节点的投票数还是 0 trx 啊？

2. 持有的票数是和目前持有的TRX相等，每个TRX等于一票对吗。而且这个票可以投不止一个超级代表候选人？

3. 请问我们目前选的是否是100个超级代表候选人的资格？

4. 这个需要用Tron来投票，是否代表我们需要在Tronscan钱包里存入一定数量的Tron？

5. 针对每日选举的27个超级节点，是否有个门槛？还是鼓励自由竞争？

6. 这27个超级代表获得的TRX是否是平均分配，还是是依据算力自由竞争？

7. 如果有大型矿厂参与竞选的话，是否有可能会出现算力超过50%的问题？

8. 按照每秒出一个块的速度，出块的32TRX的奖励给对应出块的节点是吗？基于tron 公链的交易数量是否能达到每秒都有呢？

9. 细则里的社区支持方案具体是指什么？
   
   答：可以理解为计划多大的预算或者精力去发展社区


其他问题
-----
1. RPC的接口文档在哪？

2. 咱们币安能否开一下USDT和BNB的交易对?

3. 启动节点的时候怎么制定数据存储目录？

4. 节点有钱包功能吗？

5. 生成地址不需要按照文档里面自己生成私钥，计算生成地址吧？

6. API调用有没有更具体的文档，类似比特币或者以太坊的？

7. SolidityNode 和 fullnode可以装在同一台机器上吗？数据目录不能指定，两个节点会共用数据吗？有没有问题？

8. 没有Txid很麻烦，我们出金后怎么告诉用户 怎么查询出金交易？

9. full节点看不到区块同步目录？

10. solidity是根据full同步区块的吗？

11. geteway是链接solidity节点的吗？

12. listaccounts是全网所有地址吗？

13. 余额小数位是多少？

14. Q: Can token holders hold trx on tron.network for main-net conversion. If not what other wallets may be capable, or if only exchanges.

    A: No wallets are capable. Only exchanges.

15. Q: In regards to Tron wallets, how many wallets are currently created.

    A: As far as I know, we already have a cli wallet, a web wallet and an ios wallet. And I believe after the programming contest there will be plenty well-designed wallets.

16. Q:Is 25Gbps a requirement or is 10Gbps satisfactory, or what is the threshold that is acceptable.

    A: There is no hard requirement for the network bandwidth. The specification we gave is just an advice.

17. Q: The people outside of the top 27 but in the top 100, are they ranked in order, 28-100 or is there an algorithm to just select who would be next if someone is voted out?

    A: or testnet we now just simply pick top 27 nodes with most votes. For mainnet and future testnet we may chose a different algorithm to add some randomness to part of the SR election.
    
18. Q: Is a well formed technical plan all we need, or must we have the hardware before applying.

    A: The technical plan has two parts:1 before June 26 the first election & 2 after June 26 the first election. The second part just need the plan. For the first part you can only have the plan for now but only after you have hardware we can test your node and tell everyone "yes, they do have a test node."Applying to be a SR has no direct connection to qualifying a SR.


































 