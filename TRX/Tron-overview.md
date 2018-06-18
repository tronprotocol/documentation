# Overview of Tron

# Overall Tron

## 1.1 Project repositories
Address of project repositories: https://github.com/tronprotocol. Java-tron repository contains code of the mainnet. The protocol repository contains documents on API and data structure. Wallet-cli repository contains documents on the official command-line wallet.

## 1.2 Block explorer
The address of the block explorer is: https://tronscan.org. Its creator is Rovak, whose GitHub page can be found at: https://github.com/Rovak.

## 1.3 Tron consensus algorithm
Tron adopts TPoS, an improved DPoS algorithm.

## 1.4 Block Producing Speed of Tron
For current version Odyssey-v2.0.1, 3 sec per block.

## 1.5 Transaction model
The adopted transaction model is the account model instead of the UTXO model. The smallest unit of TRX is sun, 1 TRX=1,000,000 sun. Currently, only one-to-one transaction services are available, meaning that one-to-many or many-to-one transactions are not supported.

## 1.6 Account model
One account has only one corresponding address, which is needed for transfers. The multi-signature mechanism is not yet implemented on the current version of network. There are three ways to create an account on the main blockchain.
```
a.  Create account with an existing account.
b.  Send TRX to a new address to create account.
c.  Send tokens to a new address to create account.
```
# 2. Tron’s network structure

## 2.1 Node types
There are three types of nodes on Tron’s network, namely witness, full node and solidity node. A witness is responsible for block production; a full node provides APIs, and broadcasts transactions and blocks; a solidity node synchronizes irrevocable blocks and provides inquiry APIs.

## 2.2 Network deployment (of exchanges)
Exchanges need to deploy a full node and a solidity node. The solidity node connects to the local full node which connects to the mainnet.

## 2.3 Mainnet and testnet
Currently there is only the mainnet and we will later deploy the testnet.

# 3. Operation of node

## 3.1 Recommended hardware specifications
```
Minimum specifications for full node deployment
CPU：16-core
RAM：16G
Bandwidth：100M
DISK：10T
Recommended specifications for full node deployment
CPU：64-core or more 
RAM：64G or more 
Bandwidth：500M and more
DISK：20T or more

Minimum specifications for solidity node deployment
CPU：16-core
RAM：16G
Bandwidth：100M
DISK：10T
Recommended specifications for solidity node deployment
CPU：64-core or more
RAM：64G or more
Bandwidth：500M and more
DISK：20T or more

DISK capacity depends on the actual transaction volume after deployment, but it’s always better to leave some excess capacity.
```

## 3.2 Start the full node and solidity node
Please follow the guide here to configure and deploy both nodes: https://github.com/tronprotocol/Documentation/blob/master/TRX/Solidity_and_Full_Node_Deployment_EN.md

# 4. Tron API
Currently Tron only supports gRPC interfaces and not http interfaces. The grpc-gateway is for the use of debugging only and we strongly suggest that developers do not use it for development.

## 4.1 Definition of API
For the definition of API, see also: https://github.com/tronprotocol/protocol/blob/master/api/api.proto

## 4.2 Explanation of APIs
APIs under wallet service are provided by the full node. APIs under walletSolidity and walletExtension services are provided by the solidity node. APIs under the walletExtension service, whose processing time is long, are provided by the solidity node. The full node provides APIs for operations on the blockchain and for data inquiry, while the solidity node only provides APIs for the latter. The difference between these two nodes is that data of the full node could be revoked due to forking, whereas the solidified data of the solidity one is irrevocable.
```
wallet/GetAccount
Function:Returns account information.

wallet/CreateTransaction
Function: Creates a transaction of transfer. If the recipient address does not exist, a corresponding account will be created on the blockchain.

wallet/ BroadcastTransaction
Function: Broadcasts transaction. Transaction has to be signed before being broadcasted.

wallet/ UpdateAccount
Function: Updates account name. Account name can only be updated once for each account.

wallet/ VoteWitnessAccount
Function:Users can vote for witnesses.

wallet/ CreateAssetIssue
Function: Creates token. Users can issue their own token on Tron’s public blockchain, which can be used for reciprocal transfers and be bought with TRX. Users can chose to freeze a certain portion of the token supply during token issuance.

wallet/ UpdateWitness
Function: Updates witness information.

wallet/ CreateAccount
Function: Created account. Existent accounts can revoke this API to create a new account with an address.

wallet/ CreateWitness
Function: Users can apply to become Super Representatives, which costs 9,999 TRX.

wallet/ TransferAsset
Function: Token transfer.

wallet/ ParticipateAssetIssue
Function: Token participation. Users can participate in token offerings with their TRX.

wallet/ FreezeBalance
Function: Freeze TRX. Freezing TRX gives users bandwidth points and Tron Power, which are used for transactions and voting for witnesses respectively.

wallet/ UnfreezeBalance
Function: Unfreezes TRX. Frozen TRX can only be unfrozen 3 days afterwards. Unfreezing TRX also takes away corresponding bandwidth points, Tron power and the votes.

wallet/ UnfreezeAsset
Function: Unfreezes tokens.

wallet/ WithdrawBalance
Function: SRs and SR candidates can withdraw block reward and witness reward for the top 127 candidates to their account balance. One withdrawal can be made by each account every 24 hours.

wallet/ UpdateAsset
Function: Updates information of an issued token.

wallet/ ListNodes
Function: Returns a list of all nodes.

wallet/ GetAssetIssueByAccount
Function: Get information on a token by account.

wallet/ GetAccountNet
Function: Get bandwidth information on an account, including complimentary bandwidth points and bandwidth points obtained from balance freeze.

wallet/ GetAssetIssueByName
Function: Inquire token by token name.

wallet/ GetNowBlock
Function: Returns the latest block.

wallet/ GetBlockByNum
Function: Inquire block by block height.

wallet/ GetBlockById
Function: Inquire block by block ID. The ID of a block is the hash of the blockheader’s Raw data. 

wallet/ GetBlockByLimitNext index
Function: Returns blocks indexed between the startNum and the endNum (including both ends).

wallet/ GetBlockByLatestNum
Function: Get the latest N blocks. N is defined in the parameter.

wallet/ GetTransactionById
Function: Get transaction by ID, which is the hash of the Raw data of the transaction.

wallet/ ListWitnesses
Function: Get a list of all witnesses.

wallet/ GetAssetIssueList
Function: Get a list of all issued tokens.

wallet/ TotalTransaction
Function: Get the total amount of transactions on the blockchain.

wallet/ GetNextMaintenanceTime
Function: Get the next maintenance time, namely the next update of witness votes count.

WalletSolidity/ GetAccount
Function:

WalletSolidity/ ListWitnesses
Function:

WalletSolidity/ GetAssetIssueList
Function:

WalletSolidity/ GetNowBlock
Function:

WalletSolidity/ GetBlockByNum
Function:

WalletExtension/ GetTransactionsFromThis
Function: Get the record of all outbound transactions from a certain account.

WalletExtension/ GetTransactionsToThis
Function: Get the record of all incoming transactions of a certain account.
```

## 4.3 API code generation
APIs are based on the gRPC protocol, see https://grpc.io/docs/ for more information.

## 4.4 API demo
Please refer to the following two classes for a GRPC example in Java.
```
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/WalletClient.java

https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/GrpcClient.java
```
# 5. Relevant expenses:
When there are sufficient bandwidth points, no TRX is charged. If a transaction fee is charged, it will be recorded in the fee field in the transaction results. If no transaction fee is charged, meaning that corresponding bandwidth points have been deducted, the fee field will read “0”. There will only be a service charge after a transaction has been written into the blockchain. For more information on the fee field, please see also Transaction.Result.fee, with the corresponding proto file at https://github.com/tronprotocol/protocol/blob/master/core/Tron.proto.

See also: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Mechanism_Introduction.md
## 5.1 Definition of bandwidth points
## 5.2 Freeze/unfreeze mechanism
## 5.3 Bandwidth consumption rules
## 5.4 Reward mechanism for Super Representative and Super Representative candidates

# 6. User address generation
## 6.1 Algorithm description
First generate a key pair and extract the public key (a 64-byte byte array representing its x,y coordinates). Hash the public key using sha3-256 function and extract the last 20 bytes of the result. For a testnet address, add `A0` to the beginning of the byte array. For a mainnet address, add `41` to the beginning of the byte array. Length of the initial address should be 21 bytes. Hash the address twice using sha256 function and take the first 4 bytes as verification code. Add the verification code to the end of the initial address and get an address in base58check format through base58 encoding. An encoded testnet address begins with 27 and is 35 bytes in length. An encoded mainnet address begins with T and is 34 bytes in length.
```
Please note that the sha3 protocol we adopt is KECCAK-256.
```

## 6.2 Example
    Public Key: 040defc55df809cca94abce297d432863bd8c9049fb420b1106cf53bfb4b85e0184802c495337c7a407e2b68ebd2323df2a8198d860df103de6496bd139ed24094 
    sha3 = SHA3(Public Key[1, 65)): 673f5c16982796e7bff195245a523b449890854c8fc460ab602df9f31fe4293f 
    TestNet: Address = A0||sha3[12,32): A0E11973395042BA3C0B52B4CDF4E15EA77818F275 
    sha256_0 = SHA256(Address): CD5D4A7E8BE869C00E17F8F7712F41DBE2DDBD4D8EC36A7280CD578863717084 
    sha256_1 = SHA256(sha256_0): 10AE21E887E8FE30C591A22A5F8BB20EB32B2A739486DC5F3810E00BBDB58C5C 
    checkSum = sha256_1[0, 4): 10AE21E8 
    addchecksum = address || checkSum: A0E11973395042BA3C0B52B4CDF4E15EA77818F27510AE21E8 
    base58Address = Base58(addchecksum): 27jbj4qgTM1hvReST6hEa8Ep8RDo2AM8TJo

## 6.3 Testnet addresses begin with A0
    address = a0||sha3[12,32): a05a523b449890854c8fc460ab602df9f31fe4293f 
    sha256_0 = sha256(address): 5f19ee7795d5df3868e05723cd8f345324ef148e034fa3cc622753057d9a0d12 
    sha256_1 = sha256(sha256_0): 481c8383f47f2e940b926867ba9dd237e5c03ccfa942ab39f8ab69aebd5f9ce8 
    checkSum = sha256_1[0, 4): 481c8383 
    addchecksum = address || checkSum: a05a523b449890854c8fc460ab602df9f31fe4293f481c8383 
    base58Address = Base58(addchecksum): 27XK5sBhwa773Svn9j2Mud6rajxtauEN4tr

## 6.4 Mainnet addresses begin with 41
    address = 41||sha3[12,32): 415a523b449890854c8fc460ab602df9f31fe4293f 
    sha256_0 = sha256(address): 06672d677b33045c16d53dbfb1abda1902125cb3a7519dc2a6c202e3d38d3322 
    sha256_1 = sha256(sha256_0): 9b07d5619882ac91dbe59910499b6948eb3019fafc4f5d05d9ed589bb932a1b4 
    checkSum = sha256_1[0, 4): 9b07d561 
    addchecksum = address || checkSum: 415a523b449890854c8fc460ab602df9f31fe4293f9b07d561 
    base58Address = Base58(addchecksum): TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW

## 6.5 Java code demo
See: https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/ECKeyDemo.java

# 7. Transaction signing
See: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Procedures_of_transaction_signature_generation.md

# 8. Calculation of transaction ID
Hash the Raw data of the transaction.
```
Hash.sha256(transaction.getRawData().toByteArray())
```

# 9. Calculation of block ID
Block ID is a combination of block height and the hash of the blockheader’s raw data. To get block ID, first hash the raw data of the blockheader and replace the first 8 bytes of the hash with the blockheight, as the following:
```
private byte[] generateBlockId(long blockNum, byte[] blockHash) { 
 byte[] numBytes = Longs.toByteArray(blockNum); 
 byte[] hash = blockHash; 
 System.arraycopy(numBytes, 0, hash, 0, 8); 
 return hash;
 }
```
BlockHash is the hash of the raw data of the blockheader, which can be calculated as the following:
```
Sha256Hash.of(this.block.getBlockHeader().getRawData().toByteArray())
```
# 10. Construction and signature of transaction
There are two ways to construct a transaction:
## 10.1 Invoke APIs on the full node
Based on your own needs, construct a corresponding local Contract and construct transactions with corresponding APIs. For the contract, please refer to https://github.com/tronprotocol/protocol/blob/master/core/Contract.proto.

## 10.2 Local construction
Based on the definition of a transaction, you will need to fill in all fields of a transaction to construct a transaction at your local. Please note that you will need to configure the details of reference block and expiration, so you will need to connect to the mainnet during transaction construction. We advise that you set the latest block on the full node as your reference block and production time of the latest block+N minutes as your expiration time. N could be any number you find fit. The backstage condition is (Expiration > production time of the latest block and Expiration < production time of the latest block + 24 hours). If the condition is fulfilled, then the transaction is legit, and if not, the transaction is expired and will not be received by the mainnet.
method of setting refference block: set RefBlockHash as subarray of newest block's hash from 8 to 16, set BlockBytes as subarray of newest block's height from 6 to 8. The code is as follows:  
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
method of setting Expiration and transaction timestamp
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
        .setTimestamp(System.currentTimeMillis())//timestamp should be in millisecond format
        .setExpiration(newestBlock.getBlockHeader().getRawData().getTimestamp() + 10 * 60 * 60 * 1000);//exchange can set Expiration by needs
    Transaction transaction = transactionBuilder.build();
    Transaction refTransaction = setReference(transaction, newestBlock);
    return refTransaction;
  }
```
## 10.3 Signature
After a transaction is constructed, it can be signed using the ECDSA algorithm. For security reasons, we suggest all exchanges to adopt offline signatures. The signing process is described here: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Procedures_of_transaction_signature_generation.md

## 10.4 Demo
The demo for local transaction construction and signing can be found at:
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java.

# 11. Migration plan
Token migration from ERC20 TRX to Mainnet TRX will occur between June 21st – June 25th (GMT+8). If your TRX is held on an exchange, no action is required. If your TRX is held in a wallet, you must deposit your TRX to an exchange before June 24, 2018 to avoid any losses. From June 21st– 25th, TRX withdrawals on exchanges will be suspended. On June 25th, both TRX deposits and withdraws on exchanges will be suspended. Deposits and withdraws will resume on June 26th. During this period, TRX trading will not be affected. If your TRX is held in a wallet and you were not aware of the migration notice, or saw the migration notice after June 25th, please visit our permanent token-exchange counter to exchange your tokens for mainnet TRX.

# 12. Relevant files
See also: https://github.com/tronprotocol/Documentation#documentation-guide

