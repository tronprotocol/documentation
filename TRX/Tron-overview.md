Overview of Tron

1.1 Project repositories
Address of project repositories: https://github.com/tronprotocol. Java-tron repository contains code of the mainnet. The protocol repository contains documents on API and data structure. Wallet-cli repository contains documents on the official command-line wallet.

1.2 Block explorer
The address of the block explorer is https://tronscan.org. Its creator is Rovak, whose GitHub page can be found at https://github.com/Rovak.

1.4 Tron consensus algorithm
Tron adopts TPoS, an improved DPoS algorithm.

1.5 Transaction model
The adopted transaction model is the account model instead of the UTXO model. The smallest unit of TRX is sun, 1 TRX=1,000,000 sun. Currently, only one-to-one transaction services are available, meaning that one-to-many or many-to-one transactions are not supported.

1.6 Account model
One account has only one corresponding address, which is needed for transfers. The multi-signature mechanism is not yet implemented on the current version of network. There are three ways to create an account on the main blockchain.
-Create account with an existing account.
-Send TRX to a new address to create account.
-Send tokens to a new address to create account.

2. Tron’s network structure
2.1 Node types
There are three types of nodes on Tron’s network, namely witness, full node and solidity node. A witness is responsible for block production; a full node provides APIs, and broadcasts transactions and blocks; a solidity node synchronizes irrevocable blocks and provides inquiry APIs.

2.2 Network deployment (of exchanges)
Exchanges need to deploy a full node and a solidity node. The solidity node connects to the local full node which connects to the mainnet.

2.3 Mainnet and testnet
Currently there is only the mainnet and we will later deploy the testnet.

3. Operation of node

3.1 Recommended hardware specifications

3.2 Start the full node
After downloading the latest code release:
./gradlew build
cd build/libs
java -jar java-tron.jar

3.3 Start the solidity node
After downloading the latest code release:
./gradlew build
Edit the configuration file, config.conf, to change the ip and port of trustNode to the address of the fullnode.
cd build/libs
java -jar SolidityNode.jar -c config.conf

3.4 Start witness node
Exchanges do not need to start a witness node, aka the Super Representative.

4. Tron API
Currently Tron only supports gRPC interfaces and not http interfaces. The grpc-gateway is for the use of debugging only and we strongly suggest that developers do not use it for development.

4.1 Definition of API
For the definition of API, see also:
https://github.com/tronprotocol/protocol/blob/master/api/api.proto

4.2 Explanation of APIs
APIs under wallet service are provided by the full node. APIs under walletSolidity and walletExtension services are provided by the solidity node. APIs under the walletExtension service, whose processing time is long, are provided by the solidity node. The full node provides APIs for operations on the blockchain and for data inquiry, while the solidity node only provides APIs for the latter. The difference between these two nodes is that data of the full node could be revoked due to forking, whereas the solidified data of the solidity one is irrevocable.

wallet/GetAccount
Function:Returns account information.
Parameter:Account; need to configure address.
Return:Account; all information of a blockchain account.

wallet/CreateTransaction
Function: Creates a transaction of transfer. If the recipient address does not exist, a corresponding account will be created on the blockchain.
Parameter:
Return:

wallet/ BroadcastTransaction
Function: Broadcasts transaction. Transaction has to be signed before being broadcasted.
Parameter:
Return:

wallet/ UpdateAccount
Function: Updates account name. Account name can only be updated once for each account.
Parameter:
Return:

wallet/ VoteWitnessAccount
Function:Users can vote for witnesses.
Parameter:
Return:

wallet/ CreateAssetIssue
Function: Creates token. Users can issue their own token on Tron’s public blockchain, which can be used for reciprocal transfers and be bought with TRX. Users can chose to freeze a certain portion of the token supply during token issuance.
Parameter:
Return:

wallet/ UpdateWitness
Function: Updates witness information.
Parameter:
Return:

wallet/ CreateAccount
Function: Created account. Existent accounts can revoke this API to create a new account with an address.
Parameter:
Return:

wallet/ CreateWitness
Function: Users can apply to become Super Representatives, which costs 9,999 TRX.
Parameter:
Return:

wallet/ TransferAsset
Function: Token transfer.
Parameter:
Return:

wallet/ ParticipateAssetIssue
Function: Token participation. Users can participate in token offerings with their TRX.
Parameter:
Return:

wallet/ FreezeBalance
Function: Freeze TRX. Freezing TRX gives users bandwidth points and Tron Power, which are used for transactions and voting for witnesses respectively.
Parameter:
Return:

wallet/ UnfreezeBalance
Function: Unfreezes TRX. Frozen TRX can only be unfrozen 3 days afterwards. Unfreezing TRX also takes away corresponding bandwidth points, Tron power and the votes.
Parameter:
Return:

wallet/ UnfreezeAsset
Function: Unfreezes tokens.
Parameter:
Return:

wallet/ WithdrawBalance
Function: SRs and SR candidates can withdraw block reward and witness reward for the top 127 candidates to their account balance. One withdrawal can be made by each account every 24 hours.
Parameter:
Return:

wallet/ UpdateAsset
Function: Updates information of an issued token.
Parameter:
Return:

wallet/ ListNodes
Function: Returns a list of all nodes.
Parameter:
Return:

wallet/ GetAssetIssueByAccount
Function: Get information on a token by account.
Parameter:
Return:

wallet/ GetAccountNet
Function: Get bandwidth information on an account, including complimentary bandwidth points and bandwidth points obtained from balance freeze.
Parameter:
Return:

wallet/ GetAssetIssueByName
Function: Inquire token by token name.
Parameter:
Return:

wallet/ GetNowBlock
Function: Returns the latest block.
Parameter:
Return:

wallet/ GetBlockByNum
Function: Inquire block by block height.
Parameter:
Return:

wallet/ GetBlockById
Function: Inquire block by block ID. The ID of a block is the hash of the blockheader’s Raw data. 
Parameter:
Return:

wallet/ GetBlockByLimitNext index
Function: Returns blocks indexed between the startNum and the endNum (including both ends).
Parameter:
Return:

wallet/ GetBlockByLatestNum
Function: Get the latest N blocks. N is defined in the parameter.
Parameter:
Return:

wallet/ GetTransactionById
Function: Get transaction by ID, which is the hash of the Raw data of the transaction.
Parameter:
Return:

wallet/ ListWitnesses
Function: Get a list of all witnesses.
Parameter:
Return:

wallet/ GetAssetIssueList
Function: Get a list of all issued tokens.
Parameter:
Return:

wallet/ TotalTransaction
Function: Get the total amount of transactions on the blockchain.
Parameter:
Return:

wallet/ GetNextMaintenanceTime
Function: Get the next maintenance time, namely the next update of witness votes count.
Parameter:
Return:

WalletSolidity/ GetAccount
Function:
Parameter:
Return:

WalletSolidity/ ListWitnesses
Function:
Parameter:
Return:

WalletSolidity/ GetAssetIssueList
Function:
Parameter:
Return:

WalletSolidity/ GetNowBlock
Function:
Parameter:
Return:

WalletSolidity/ GetBlockByNum
Function:
Parameter:
Return:

WalletExtension/ GetTransactionsFromThis
Function: Get the record of all outbound transactions from a certain account.
Parameter:
Return:

WalletExtension/ GetTransactionsToThis
Function: Get the record of all incoming transactions of a certain account.
Parameter:
Return:

4.3 API code generation
APIs are based on the gRPC protocol of Google’s, for which see also https://grpc.io/docs/.

4.4 API demo
Please refer to the following two classes:
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/WalletClient.java

https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/GrpcClient.java

5. Relevant expenses:
See also:
https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%9C%BA%E5%88%B6%E8%AF%B4%E6%98%8E.md
5.1 Definition of bandwidth points
5.2 Freeze/unfreeze mechanism
5.3 Bandwidth consumption rules
5.4 Reward mechanism for Super Representative and Super Representative candidates

6. User address generation
6.1 Algorithm description
First generate a key pair and extract the public key (a 64-byte byte array representing its x,y coordinates). Hash the public key using sha3-256 function and extract the last 20 bytes of the result. For a testnet address, add A0 to the beginning of the byte array. For a mainnet address, add 41 to the beginning of the byte array. Length of the initial address should be 21 bytes. Hash the address twice using sha256 function and take the first 4 bytes as verification code. Add the verification code to the end of the initial address and get an address in base58check format through base58 encoding. An encoded testnet address begins with 27 and is 35 bytes in length. An encoded mainnet address begins with T and is 34 bytes in length.
Please note that the sha3 protocol we adopt is KECCAK-256.

6.2 Exemplification
Public Key: 040defc55df809cca94abce297d432863bd8c9049fb420b1106cf53bfb4b85e0184802c495337c7a407e2b68ebd2323df2a8198d860df103de6496bd139ed24094 sha3 = SHA3(Public Key[1, 65)): 673f5c16982796e7bff195245a523b449890854c8fc460ab602df9f31fe4293f TestNet: Address = A0||sha3[12,32): A0E11973395042BA3C0B52B4CDF4E15EA77818F275 sha256_0 = SHA256(Address): CD5D4A7E8BE869C00E17F8F7712F41DBE2DDBD4D8EC36A7280CD578863717084 sha256_1 = SHA256(sha256_0): 10AE21E887E8FE30C591A22A5F8BB20EB32B2A739486DC5F3810E00BBDB58C5C checkSum = sha256_1[0, 4): 10AE21E8 addchecksum = address || checkSum: A0E11973395042BA3C0B52B4CDF4E15EA77818F27510AE21E8 base58Address = Base58(addchecksum): 27jbj4qgTM1hvReST6hEa8Ep8RDo2AM8TJo

6.3 Testnet addresses begin with A0
address = a0||sha3[12,32): a05a523b449890854c8fc460ab602df9f31fe4293f sha256_0 = sha256(address): 5f19ee7795d5df3868e05723cd8f345324ef148e034fa3cc622753057d9a0d12 sha256_1 = sha256(sha256_0): 481c8383f47f2e940b926867ba9dd237e5c03ccfa942ab39f8ab69aebd5f9ce8 checkSum = sha256_1[0, 4): 481c8383 addchecksum = address || checkSum: a05a523b449890854c8fc460ab602df9f31fe4293f481c8383 base58Address = Base58(addchecksum): 27XK5sBhwa773Svn9j2Mud6rajxtauEN4tr

6.4 Mainnet addresses begin with 41
address = 41||sha3[12,32): 415a523b449890854c8fc460ab602df9f31fe4293f sha256_0 = sha256(address): 06672d677b33045c16d53dbfb1abda1902125cb3a7519dc2a6c202e3d38d3322 sha256_1 = sha256(sha256_0): 9b07d5619882ac91dbe59910499b6948eb3019fafc4f5d05d9ed589bb932a1b4 checkSum = sha256_1[0, 4): 9b07d561 addchecksum = address || checkSum: 415a523b449890854c8fc460ab602df9f31fe4293f9b07d561 base58Address = Base58(addchecksum): TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW

6.5 Java code demo
See also: https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletcli/ECKeyDemo.java

7. Transaction signing
See also: https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E4%BA%A4%E6%98%93%E7%AD%BE%E5%90%8D%E6%B5%81%E7%A8%8B.md

8. Calculation of transaction ID
Hash the Raw data of the transaction.
Hash.sha256(transaction.getRawData().toByteArray())

9. Calculation of block ID
Block ID is a combination of block height and the hash of the blockheader’s raw data. To get block ID, first hash the raw data of the blockheader and replace the first 8 bytes of the hash with the blockheight, as the following:
private byte[] generateBlockId(long blockNum, byte[] blockHash) { 
 byte[] numBytes = Longs.toByteArray(blockNum); 
 byte[] hash = blockHash; 
 System.arraycopy(numBytes, 0, hash, 0, 8); 
 return hash;
 }

BlockHash is the hash of the raw data of the blockheader, which can be calculated as the following:
Sha256Hash.of(this.block.getBlockHeader().getRawData().toByteArray())

10. Migration plan
Token migration from ERC20 TRX to Mainnet TRX will occur between June 21st – June 25th (GMT+8). If your TRX is held on an exchange, no action is required. If your TRX is held in a wallet, you must deposit your TRX to an exchange before June 24, 2018 to avoid any losses. From June 21st– 25th, TRX withdrawals on exchanges will be suspended. On June 25th, both TRX deposits and withdraws on exchanges will be suspended. Deposits and withdraws will resume on June 26th. During this period, TRX trading will not be affected. If your TRX is held in a wallet and you were not aware of the migration notice, or saw the migration notice after June 25th, please visit our permanent token-exchange counter to exchange your tokens for mainnet TRX.

11. Relevant files
See also:
https://github.com/tronprotocol/Documentation#%E6%96%87%E6%A1%A3%E6%8C%87%E5%BC%95

