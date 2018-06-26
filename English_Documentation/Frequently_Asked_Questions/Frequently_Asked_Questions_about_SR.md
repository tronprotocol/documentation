Questions on the Full Node in private networks
-----
1.	When replacing genesis.block.witnesses under config.conf with the address string given upon registration on https://trxscan.org/, do I need to delete other addresses? And do I need to delete the fields of url and voteCount?

2.	After seed.node ip.list has been replaced with the ip address of my own public network and the initiation command java -jar java-tron.jar is given, how can I test if the deployment is successful? For instance, are there testing interfaces or commands such as the redis command (sending PING to server and be returned with PONG) for successful deployment?

Questions on the Super Node in private networks
-----
1.	When deploying a private network environment, what’s the relationship between Super Node and Full node? Should I deploy Super Node prior to Full Node?

2.	As the Super Node is selected through user voting, in a private network, do I need to submit application materials to TRON to be approved as a Super Node?

3.	Running in private environment, why is data synchronized and the journal continuously updated to all other nodes? What, then, is the difference between a private and a public environment?

Questions on operation in public networks
-----
1.	What’s the maximal memory, cpu and request processing capacity supported by the java program on a node?

2.	How much is the data flow? Should several hosts balance the load or is it enough to provide several nodes?

3.	Q: What ports should be open to public network?
    A: Ports 18888 and 50051.

4.	Upon successful token issuance, how do I change the status from “not started yet” to “participate”?


Question on error alert for Super Node
-----
1.	What does the following error alert mean?

       17:02:42.699 INFO [o.t.c.s.WitnessService] Try Produce Block        17:02:42.699 INFO [o.t.c.s.WitnessService] Not sync 

Questions on block generation by Super Node
-----
1.	Q: Do Super Nodes produce blocks in rotation? What is the speed of block production? If there is no heartbeat message for 24 hours, will the node be removed from the list of Super Nodes?
    A: Yes, Super Nodes produce blocks in rotation. Within current testing environment, one block is produced every 5 seconds. TRON will calculate the miss rate of Super Node, based on which a Super Node will be voted out if its production rate is too low.

2.	Q: In the worst case scenario, if a Super Node cannot connect to network, how long will it have to restore service?
    A: As long as a voting cycle to recover service, but its block production rate will be taken into permanent record.

3.	Q: What’s the formula of the miss rate of Super Nodes’ block production?
    A: “The number of blocks which supposedly should have been produced but weren’t” will be taken into count. The number will keep accumulating and not be cleared.

4.	Q: Are the test version or the source code of Super Node server accessible now?
    A: Yes, they are open-source and can be found at https://github.com/tronprotocol/java-tron.

5.	Q: How do I know if my test Super Node is running?

6.	Q: Based on this command: java -jar java-tron.jar -p yourself private key --witness -c yourself config.conf(Example：/data/java-tron/config.conf, how do I know that I am running a Super Node?

7.	Q: What are some command-line commands that can generate an address to be sent to TRON? Is web wallet the only way?

8.	Q: If we want to test block production and other functions of the Super Node, do we need your votes to first become elected?
    A: We will vote for you during your test trial.

9.	Do we get to know whether our node has produced any block?

10.	Q: Is the block production speed 1 block every 5 seconds shortly after the main net launches? When does TRON expect the speed to become 1 block every 3 seconds?
    A: Block production speed will be 1 block every 3 seconds as soon as the mainnet launches.

11.	Q: Is it within TRON’s plan to reduce the reward of TRX for block production by half? If yes, when?
    A: There is no such plan.

12.	Q: When one of the 27 nodes malfunctions, will it be automatically detected and disqualified for polling? Under such circumstances, will its eligibility for Super Representative be maintained? If suspended, when will it be able to regain qualification?
    A: A record of its incompetency will be kept permanently, based on which people will make the rational judgement to not vote for it.

Questions on the Super Representatives election
-----

1.	Q: Why is there still no vote for my node at https://tronscan.org/#/network when I’ve just made 2 million votes for myself?
    A: Results are updated every 6 hours, which will be announce only after this round of voting.

2.	The amount of votes one holds is equivalent to the amount of his/her holding of TRX, so one vote can be made for one TRX, right? And the vote can be made to more than one Super Representative candidate?

3.	Q: Are we currently voting for 100 eligible Super Representative candidates?
    A: The selection of these 100 candidates is based on the result of the vote. Currently we intend to let prospective nodes test in advance by running an election.

4.	Q: Since TRX is required to obtain the right to vote, do we need to deposit a certain amount of TRX into Tronscan wallet? A: Yes, TRX deposit is needed for application for witness node and for voting.

5.	Q: Is there a threshold for the daily election of 27 Super Representatives? Or is it encouraged to compete freely?
    A: Free competition. Solicit the votes if you want them.

6.	Q: Will TRX rewards be distributed evenly among these 27 Super Representatives or based on their hashrate?
    A: As they produce blocks in rotation, the distribution of reward is irrelevant to hashrate.

7.	Q: If large mining operations run for the election, is hashrate exceeding 50% a possibility?
    A: No.

8.	At the speed of one block every 3 seconds, 32 TRX per block will be rewarded to the corresponding node, right? Based on the number of transactions on TRON’s public blockchain, will blocks be produced every second?

9.	Q: What does the community support plan in the guidelines refer to?
    A: it can be understood as the budget and attention to community development.

10.	Q: Who does the TRX I vote with belong to?
    A: Voting does not consume your TRX.

11.	Q: Does the status of Super Representatives only last for 24 hours?
    A: Yes. But if the results of the next election remains the same, the status will be maintained.

12.	Q: Information on my node is not included in either of the two configuration nodes, namely build/resources/main/config.conf and build/resources/main/config.conf in the wallet. Is it still possible to discover my node and proceed to block production?
    A: Set your own private key in the configuration file. With a successful vote a block will be produced.

13.	Q: How should I configurate my node after I’ve generated my private key?
    A: Find localwitness within the configuration file and set your private key for the voting account.

Others
-----
1.	Q: Where can I find the file for RPC interface?
    A: https://github.com/tronprotocol/documentation/tree/master/TRX

2.	Can we form trading pairs with USDT and BNB on Binance?

3.	Q: How do I specify the data storage directory when I activate my node?
    A: Currently we can’t specify data storage directory yet. This function will be made possible in the upcoming version.

4.	Q: Can nodes serve as wallets?
    A: There is a RPC interface for wallet on nodes, but no command can call the wallet directly. Wallets on full nodes can be used through the commandline wallet on another repo.

5.	Q: I don’t need to calculate my own address with the private key generated according to the file, do I?
    A: You don’t have to worry about private key generation once you’ve successfully registered for an account. All you need to do is log in with you pin-code to access your address.

6.	Q: Is there a specific file to the calling of API like Bitcoin and Ethereum do?
    A: We are still enlarging our collection of files which is not yet adequate. A new file on rpc-api for wallet has just been added to the Documentation repository.

7.	Can Solidity Node and Full Node be employed on the same machine? Since we can’t specify data directory, will there be consequences to the two nodes’ sharing data?

8.	Q: Without Txid, how can we tell the users to inquire the transaction after our transfer?
    A: For now there is no transaction id or service charge. Transaction id is in development.

9.	Q: Do Solidity Nodes synchronize blocks in accordance with Full Nodes?
    A: Yes.

10.	Q: Is gateway for the connection to Solidity Nodes?
    A: Solidity Nodes are set up for the storage of irrevocable blocks, a few blocks behind Full Nodes, so they are more suitable for the confirmation of transfer. You can connect to both Solidity Node and Full Node through gateway.

11.	Q: Listaccounts is a list of all addresses in the network?
    A: For now, yes. But we are uncertain if that’s going to change, because we need to further think it through as the address base if enourmous.

12.	Q:  How many decimal places is there for the balance?
    A: Six.

13.	Q: Is the machines of the nodes in Beijing? Is the wall an issue?
    A: Only 39.106.220.120 is in Beijing. The rest are in the US, Europe and Hong Kong.

14. Q: Can token holders hold trx on tron.network for main-net conversion. If not what other wallets may be capable, or if only exchanges.

    A: No wallets are capable. Only exchanges.

15. Q: In regards to TRON wallets, how many wallets are currently created.

    A: As far as I know, we already have a cli wallet, a web wallet and an ios wallet. And I believe after the programming contest there will be plenty well-designed wallets.

16. Q:Is 25Gbps a requirement or is 10Gbps satisfactory, or what is the threshold that is acceptable?

    A: There is no hard requirement for the network TRON Power(TP). The specification we gave is just an advice.

17. Q: The people outside of the top 27 but in the top 100, are they ranked in order, 28-100 or is there an algorithm to just select who would be next if someone is voted out?

    A: For testnet we now just simply pick top 27 nodes with most votes. For mainnet and future testnet we may chose a different algorithm to add some randomness to part of the SR election.

18. Q: Is a well formed technical plan all we need, or must we have the hardware before applying.

    A: The technical plan has two parts:1 before June 26 the first election & 2 after June 26 the first election. The second part just need the plan. For the first part you can only have the plan for now but only after you have hardware we can test your node and tell everyone "yes, they do have a test node."Applying to be a SR has no direct connection to qualifying a SR.
