Questions on the Full Node in private networks
-----
1.	Q: Do I need to delete other addresses when replacing genesis.block.witnesses under config.conf with the address string given upon registration on https://tronscan.org/?
    A: There is no need to delete. However, those address will be part of your network too, and useless if you don’ t have their private key. Att: Zion, Sun and Blackhole Accounts can not be deleted from genesis block config file, however you can change their addresses.

2.	Q: After replacing the seed.node.ip.list with the IP-address of my own public network and entering the command "java -jar java-tron.jar", how can I test if the deployment has been successful? Are there any testing interfaces or commands such as the "redis" command (which sends a ping to a server and gets a png back from the server) for a successfull deployment?
    A: There is no default interface with java-tron. There are several ways to check if you have a successful deployment, as once your server is running you can send gRPC commands. First thing you will need to check is if the gRPC port is open:


        netstat -tulnp| grep 50051

       If the port is open, you can test your node using tronscan.org. Make sure your port and IP is open on internet. If you are using a private IP only, you will need to use other gRPC software

    ![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/FAQ/查询节点.png)

    You can also check if your node is running using the following terminal command:

         tail -f logs/tron.log |grep "MyheadBlockNumber"



Questions on the Super Node in private networks
-----
1.	Q:  On a private network-environment, what relation exists between a Super Node and a FullNode? Is it preferred to deploy a Super Node over a FullNode?
    A:  A: On a private deployment, you will need at least one Super Node, no minimum requirements for FullNode.

2.	Q: As user voting determines Super Node selection in private networks, do I need to submit any application materials to the TRON foundation to be approved as a Super Node?
    A: You don’ t need to submit material to TRON Foundation.

3.	Q: Why is data in private environments continuously synchronized and why is the journal still continuously updated to all other nodes? What is the difference between a private and a public environment then?
    A: If this is related to the IP list-> A: On config.conf you need to update the seed.ip, if you use the same of the public network, and your computer is connected to the internet, it will attempt to connect to those nodes and the IP list will be saved in the DB, even if the connection fails.
       If this is related to the Block and transactions -> A: On a private environment, you need to change p2p version and parent hash. If you use the same of mainnet or testnet, and your computer is connected to the internet. Your node will synchronize with public network.


Questions regarding operation in public networks
-----
1.	Q: Which amount of memory is currently supported by the java software?
    A: This will depend on your system environment: If you use 32-bit references, your heap is limited to 32 GB. If you are using 64-bit references, the size will be limited by your OS
       Is a good practice to limit JVM heap size to fit inside one NUMA region (Around 1 TB on the bigger machines). If its JVM spans NUMA regions, GC will take much longer.

2.	Q: What performance does a processor need to have in order to run the node software?
    A: At least 2 core CPUs are required to run a full node, at the minimum performance. If you are running on a private environment, with fewer transactions, then you will be fine with 4 CPU cores. So, the amount of network requests determines the CPU performance required to run the nodes. You will need to monitor your machine to decide the best requirements. In the PUBLIC NETWORK, TRON recommend at least 64CPU cores machine for a Super Representative to be approved.


3.	Q: What ports should be opened to be externally accessible?
    A: 18888 and 50051 are the two default ports.

4.  Q: What amount of data traffic can I expect? Will the data to be spread out to many hosts or will it be enough to just provide several nodes myself?
    A: The network traffic will depend on the number of transactions. For a fast reference you could use the number of 200Bytes per transactions. Current network specification is 2000TPS (Transactions per seconds).

5.	Q: Upon successful token issuance, how do I change the status from “not started yet” to “participate”?
    A: It is not possible to change the start date after you issue a token. You will need to wait for the time and date you have specified during creation. One can only change URL and Description after a token is created.


Questions regarding error occurrences/messages for Super Nodes
-----
1.	Q: How can I interpret the following error message?

       17:02:42.699 INFO [o.t.c.s.WitnessService] Try Produce Block        17:02:42.699 INFO [o.t.c.s.WitnessService] Not sync 

    A: This message means your node is not in sync with the network. To start produce blocks, you need to be in sync. Check your block height with the command:

        tail -f logs/tron.log |grep "MyheadBlockNumber"

Questions regarding block generation by Super Nodes
-----
1.	Q: Do Super Nodes produce blocks in rotation? What is the speed of block production? If there is no heartbeat message for 24 hours, will the node be removed from the list of Super Nodes?
    A: Yes, Super Nodes produce blocks in rotation. Within current testing environment, one block is produced every 3 seconds.

2.	Q: If a Super Node cannot connect to the TRON network, how long will it take to be able to connect to the network again?
    A: An SR's recovery depends only on it's connection speeds and it has nothing to do with the TRON network.

3.	Q: What’s the formula of the miss rate of Super Nodes’ block production?
    A: “The number of blocks which supposedly should have been produced but aren't” will be taken into account. The number will keep accumulating and not be cleared.

4.	Q: Are the test version or the source code of Super Node server accessible now?
    A: Yes, they are open-source and can be found at https://github.com/tronprotocol/java-tron.

5.	Q: How do I know if my test Super Node is running?
    A: A: Run the following command:

         tail -f logs/tron.log |grep "Try Produce Block"

6.	Q: Based on this command: java -jar java-tron.jar -p yourself private key --witness -c yourself config.conf(Example：/data/java-tron/config.conf, how do I know that I am running a Super Node?
    A: Run the following command:

         tail -f logs/tron.log |grep "Try Produce Block"

7.	Q: What are some command-line commands that can generate an address to be sent to TRON? Is web wallet the only way?
    A: You can use Wallet CLI: https://github.com/tronprotocol/wallet-cli

8.	Q: If we want to test block production and other functions of the Super Node, do we need your votes to first become elected?
    A: We will vote for you during your test trial.

9.	Q: How do we know if our own node has produced any blocks?
    A: You can have this information using “https://tronscan.org/#/address/YOURADDRESS”

10.	Q: Will block production speed be 1 block / 5 seconds initially when the main-net launches? What is the expected timeline for this speed to reach 1 block / 3 seconds?
    A: As soon as the main-net launches, the block production speed will be 1 block / 3 seconds. This will be updated to 1 block / 1 second in the future.

11.	Q: Is it within TRON’s plan to reduce the reward of TRX for block production by half? If yes, when?
    A: The TRON Foundation is currently not planning to halve the TRX reward per block in the future.

12.	Q: If any of the 27 nodes malfunctions, will it be detected automatically and disqualified from elections? Will it remain as a Super Representative if such thing occur? If it won't, how and when it can regain the status?
   A: An event of incompetency & missed block rates will be kept permanently and will be public. We expect voters to make a rational judgement by not voting for that particular SR in future voting cycles.

Questions on the Super Representatives election
-----

1.	Q: Why I can't see any votes for my node at https://tronscan.org/#/network even though I’ve just submitted 2 million votes for it in the current voting round?
    A: Results are updated every 6 hours, which will be announce only after this round of voting.

2.	Q: The amount of votes one holds is equivalent to the amount of his/her holding of TRX, so one vote can be made for one TRX, right? And the vote can be made to more than one Super Representative candidate?
    A: A: Every TRX equals one vote can only be casted for one candidate. However, if you have more then one TP( or frozen TRX), you can spread the votes among all the candidates you want to.

3.	Q: Since TRX is required to obtain the right to vote, do we need to deposit a certain amount of TRX into Tronscan wallet? 
    A:Yes, you need to have TRX in order to be able to freeze them. But no, since your balance is held on the blockchain and not on Tronscan you can use any other wallet or means to freeze your TRX.

4.	Q: Is there a threshold for the daily election of 27 Super Representatives? Or is it encouraged to compete freely?
    A: Free competition. Solicit the votes if you want them. Due to the existence of the GR system, an SR needs at least 100 million votes to replace a GR. There is no reward for GRs’ work.

5.	Q: Will TRX rewards be distributed evenly among these 27 Super Representatives or based on their hashrate?
    A: As they produce blocks in rotation, the distribution of reward is irrelevant to hashrate.

6.	Q: If large mining operations run for the election, is hashrate exceeding 50% a possibility?
    A: No.

7.	Q: What does the community support plan in the guidelines refer to?
    A: it can be understood as the budget and attention to community development.

8.	Q: Does voting consume TRX?
    A: Voting does not consume your TRX.

9.	Q: Does the status of Super Representatives only last for 24 hours?
    A:  No. The status of Super Representatives lasts for 6 hours. But if the results of the next election remains the same, the status will be maintained for another 6 hours.

10.	Q: Information on my node is not included in either of the two configuration nodes, namely build/resources/main/config.conf and build/resources/main/config.conf in the wallet. Is it still possible to discover my node and proceed to block production?
    A: Set your own private key in the configuration file. With a successful vote a block will be produced.

11.	Q: How should I configurate my node after I’ve generated my private key?
    A: Find localwitness within the configuration file and set your private key for the voting account.

Others
-----
1.	Q: Where can I find the file for RPC interface?
    A: https://github.com/tronprotocol/documentation/tree/master/TRX

2.	Q: How do I specify the data storage directory when I activate my node?
    A: Currently we can’t specify data storage directory yet. This function will be made possible in the upcoming version.

3.	Q: Can nodes serve as wallets?
    A: There is a RPC interface for wallet on nodes, but no command can call the wallet directly. Wallets on full nodes can be used through the wallet-cli(commandline wallet) on another repo.

4.	Q: I don’t need to calculate my own address with the private key generated according to the file, do I?
    A: You don’t have to worry about private key generation once you’ve successfully registered for an account. All you need to do is log in with you pin-code to access your address.

5.	Q: Is there a specific file to the calling of API like Bitcoin and Ethereum do?
    A: Yes. It can be found in our Github documentation, please check https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/TRON_Wallet_RPC-API.md

6.	Q: Can Solidity Node and Full Node be employed on the same machine? Since we can’t specify data directory, will there be consequences to the two nodes’ sharing data?
    A: You actually can specify data directory, config file parameter: db.directory = "database", and index.directory = "index". But you can also run FullNode.jar and SolidityNode.jar in different directories, and totally separate the data and log files. Remember to change the ports on config.conf, as two applications cant run on the same port.

7.	Q: Without Txid, how can we tell the users to inquire the transaction after our transfer?
    A: You can use transaction hash as TXID.

8.	Q: Do Solidity Nodes synchronize blocks in accordance with Full Nodes?
    A: Yes.

9.	Q: Is gateway for the connection to Solidity Nodes?
    A: Solidity Nodes are set up for the storage of irrevocable blocks, a few blocks behind Full Nodes, so they are more suitable for the confirmation of transfer. You can connect to both Solidity Node and Full Node through gateway.

10.	Q: Listaccounts is a list of all addresses in the network?
    A: For now, yes. But that may change, as it requires further discussion if the address base becomes enormous.

11.	Q:  How many decimal places are there for the balance?
    A: Six.

12.	Q: Is the machines of the nodes in Beijing? Is the wall an issue?
    A: Only 39.106.220.120 is in Beijing. The rest are in the US, Europe and Hong Kong.

13. Q: Can token holders hold trx on tron.network for main-net conversion. If not what other wallets may be capable, or if only exchanges.

    A: No wallets are capable. Only exchanges.

14. Q: In regards to TRON wallets, how many wallets are currently created.

    A: We already have wallet-cli, a web wallet and an iOS, android and chrome wallet.

15. Q:Is 25Gbps a requirement or is 10Gbps satisfactory, or what is the threshold that is acceptable?

    A: There is no hard requirement for the network TRON Power(TP). The specification we gave is just an advice.

16. Q: The people outside of the top 27 but in the top 100, are they ranked in order, 28-100 or is there an algorithm to just select who would be next if someone is voted out?

    A: For testnet we now just simply pick top 27 nodes with most votes. For mainnet and future testnet we may chose a different algorithm to add some randomness to part of the SR election.

17. Q: Is a well formed technical plan all we need, or must we have the hardware before applying.

    A: The technical plan has two parts:1 before June 26 the first election & 2 after June 26 the first election. The second part just need the plan. For the first part you can only have the plan for now but only after you have hardware we can test your node and tell everyone "yes, they do have a test node."Applying to be a SR has no direct connection to qualifying a SR.
