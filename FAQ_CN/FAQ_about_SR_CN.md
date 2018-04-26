1. 按照每秒出一个块的速度，出块的32TRX的奖励给对应出块的节点是吗？

2. 基于tron 公链的交易数量是否能达到每秒都有呢？ 如何确保每秒出块？
   
3. 当27节点中有一个 出现故障时， 会自动检测并取消轮询资格吧？  出现这种情况保留超级代表资格否？ 如果资格被取消后，何时可以恢复资格？

4. 问：细则里的社区支持方案具体是指什么？

   答：可以理解为计划多大的预算或者精力去发展社区
   
5. 我已经按照github里的readme编译并运行了节点，我也按照运行超级节点的配置和命令执行了，我怎样才能知道我的测试超级节点在运行了呢？

6. 另外，有什么命令行命令可以生成地址，发送tron的吗？一定要通过web wallet?

7. 以下错误信息表达了什么意思？

       17:02:42.699 INFO [o.t.c.s.WitnessService] Try Produce Block
       17:02:42.699 INFO [o.t.c.s.WitnessService] Not sync

8. 另外，根据这个命令：java -jar java-tron.jar -p yourself private key --witness -c yourself config.conf(Example：/data/java-tron/config.conf，我怎样才知道运行的是超级节点？

9. Q: Can token holders hold trx on tron.network for main-net conversion. If not what other wallets may be capable, or if only exchanges.

    A: No wallets are capable. Only exchanges.

10. Q: In regards to Tron wallets, how many wallets are currently created.

    A: As far as I know, we already have a cli wallet, a web wallet and an ios wallet. And I believe after the programming contest there will be plenty well-designed wallets.

11. Q:Is 25Gbps a requirement or is 10Gbps satisfactory, or what is the threshold that is acceptable.

    A: There is no hard requirement for the network bandwidth. The specification we gave is just an advice.

12. Q: The people outside of the top 27 but in the top 100, are they ranked in order, 28-100 or is there an algorithm to just select who would be next if someone is voted out?

    A: or testnet we now just simply pick top 27 nodes with most votes. For mainnet and future testnet we may chose a different algorithm to add some randomness to part of the SR election.
    
13. Q: Is a well formed technical plan all we need, or must we have the hardware before applying.

    A: The technical plan has two parts:1 before June 26 the first election & 2 after June 26 the first election. The second part just need the plan. For the first part you can only have the plan for now but only after you have hardware we can test your node and tell everyone "yes, they do have a test node."And if you can not have the hardware set until June 26, you can just eat your words and still can apply for SR. Applying to be a SR has no direct connection to qualifying a SR.
