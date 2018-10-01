# Full Overview of TRON

## 1.1 Project repositories
### https://github.com/tronprotocol
- [Java-TRON](https://github.com/tronprotocol/java-tron) - main repository for TRON nodes
- [Documentation](https://github.com/tronprotocol/Documentation) - all documentation
- [TronDeployment](https://github.com/tronprotocol/TronDeployment) - deployment scripts and config files for java-tron

## 1.2 Block explorer
- https://tronscan.org - Created by [Rovak](https://github.com/Rovak)

## 1.3 TRON consensus algorithm
TRON adopts TPoS, an improved DPoS algorithm.

## 1.4 Block Producing Speed of TRON
The network currently produces 1 block per 3 seconds.

## 1.5 Transaction model
The adopted transaction model is the account model instead of the UTXO model. The smallest unit of TRX is sun, 1 TRX=1,000,000 sun. Currently, only one-to-one transaction services are available, meaning that one-to-many or many-to-one transactions are not supported.

## 1.6 Account model
One account has only one corresponding address, which is needed for transfers. The multi-signature mechanism is not yet implemented on the current version of network. There are three ways to create an account on the main blockchain.
```
a.  Create account with an existing account.
b.  Send TRX to a new address to create account.
c.  Send tokens to a new address to create account.
```

# 2. TRON’s network structure

## 2.1 Node types
There are three types of nodes on TRON’s network: Witnesses(Super Representatives), Full Nodes and Solidity Nodes. A witness is responsible for block production; a full node provides APIs, and broadcasts transactions and blocks; a solidity node synchronizes irrevocable blocks and provides inquiry APIs.

## 2.2 Mainnet and testnet

### Mainnet
- Block Explorer: https://tronscan.org
- Config: https://github.com/tronprotocol/TronDeployment/blob/master/main_net_config.conf

### Testnet
- Block Explorer: https://test.tronscan.org
- Config: https://github.com/tronprotocol/TronDeployment/blob/master/test_net_config.conf

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
Please follow the guide here to configure and deploy both nodes: 
- https://github.com/tronprotocol/Documentation/blob/master/TRX/Solidity_and_Full_Node_Deployment_EN.md

We also provide a script to deploy fullnode and soliditynode:
- https://github.com/tronprotocol/TronDeployment/blob/master/README.md

# 4. TRON API
The TRON Nodes support both a gRPC Service and a HTTP Gateway

## 4.1 API Definition
Please see the protobuf protocol for the raw API.
- [Protobuf API](https://github.com/tronprotocol/protocol/blob/master/api/api.proto)
- [Protobuf Structures](https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/TRON_Protobuf_Protocol_document.md)

## 4.2 Explanation of APIs
### 4.2.1 gRPC interface
The Full Node and Solidity Nodes each run a gRPC service that you can connect to.

- [gRPC Tutorial](https://grpc.io/docs/)
- [gRPC API](https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/TRON_Wallet_RPC-API.md)

Please refer to the following two classes for a gRPC example in Java.
```
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/WalletApi.java

https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/GrpcClient.java
```

### 4.2.2 HTTP Interface
The FullNode and SolidityNode both have an HTTP Service running on them. All parameters are encoded as `HEX` and returned as Hex or `base58check`. If you're trying to pass an address in, please decode from `base58check` and convert it to `HEX`.

- [HTTP Service API](https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-http.md)

- [Address DEBUG Tool](https://github.com/tronprotocol/tron-demo/raw/master/TronConvertTool.zip)

# 5. Transaction Fees
Having too many transactions will clog our network like Ethereum and may incur delays on transaction confirmation. To keep the network operating smoothly, TRON network grants every account a free pool of `Bandwidth points` for free transactions every 24 hours. To engage in transactions more frequently requires freezing TRX for additional bandwidth points, or paying the fee in TRX.

See also: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Mechanism_Introduction.md

## 5.1 Definition of Bandwidth Points
Transactions are transmitted and stored in the network in byte arrays. Bandwidth points consumed in a transaction equals the size of its byte array.
If the length of a byte array is 200 then the transaction consumes 200 bandwidth points.

## 5.2 Freeze/unfreeze mechanism 
TRX can be frozen for a minimum of 3 days to gain both `TRON Power (TP)` for voting and `Bandwidth points` for covering network fees. `TRON Power` is gained at a 1:1 ratio with the amount of frozen TRX.

The amount of bandwidth points granted follows a formula:
```
Your Frozen TRX
---------------- * 54Gb of network bandwidth points available = Your available share of bandwidth points
Total Frozen TRX
```

## 5.3 Bandwidth points consumption rules
When there is available `Bandwidth points`, no TRX is charged. If a transaction fee is charged, it will be recorded in the fee field in the transaction results. If no transaction fee is charged, meaning that corresponding bandwidth points have been deducted, the fee field will read “0”. There will only be a service charge after a transaction has been written into the blockchain. For more information on the fee field, please see also `Transaction.Result.fee`, with the corresponding proto file at https://github.com/tronprotocol/protocol/blob/master/core/Tron.proto.
 
# 6. User address generation
## 6.1 Algorithm description
1. First generate a key pair and extract the public key (a 64-byte byte array representing its x,y coordinates). 
2. Hash the public key using sha3-256 function and extract the last 20 bytes of the result. 
3. Add `41` to the beginning of the byte array. Length of the initial address should be 21 bytes. 
4. Hash the address twice using sha256 function and take the first 4 bytes as verification code. 
5. Add the verification code to the end of the initial address and get an address in base58check format through base58 encoding. 
6. An encoded mainnet address begins with T and is 34 bytes in length.
```
Please note that the sha3 protocol we adopt is KECCAK-256.
```

## 6.2 Mainnet addresses begin with 41
```
    address = 41||sha3[12,32): 415a523b449890854c8fc460ab602df9f31fe4293f 
    sha256_0 = sha256(address): 06672d677b33045c16d53dbfb1abda1902125cb3a7519dc2a6c202e3d38d3322 
    sha256_1 = sha256(sha256_0): 9b07d5619882ac91dbe59910499b6948eb3019fafc4f5d05d9ed589bb932a1b4 
    checkSum = sha256_1[0, 4): 9b07d561 
    addchecksum = address || checkSum: 415a523b449890854c8fc460ab602df9f31fe4293f9b07d561 
    base58Address = Base58(addchecksum): TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW
```

## 6.3 Java code demo
See: https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/ECKeyDemo.java

# 7. Transaction signing
See: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/Procedures_of_transaction_signature_generation.md

# 8. Calculation of transaction ID
Hash the Raw data of the transaction.
in java
```
Hash.sha256(transaction.getRawData().toByteArray())
```
in php  by William
```
try {
      $request = new \Protocol\NumberMessage(); 
      $request->setNum(319139);
      list($reply, $status) = $fullnode->GetBlockByNum($request)->wait();
      $i=0;
      foreach($reply->getTransactions() as $trans){
        echo $i++;
        echo ": ";
        echo hash("sha256", $trans->getRawData()->serializeToString());
        echo "\n";
      }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
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
Based on your own needs there are two methods to construct a transaction. You can either invoke the gRPC / HTTP API through a full node to build the transaction externally, or create the transaction locally.

## 10.1 Invoke APIs on the full node
You can construct transactions with corresponding APIs.

- gRPC API: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/TRON_Wallet_RPC-API.md
- HTTP API: https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-http.md

Individual Contract protocol file is available here: https://github.com/tronprotocol/protocol/blob/master/core/Contract.proto

## 10.2 Local construction
Based on your method of constructing a transaction you are required to populate all fields of a transaction to construct it locally. Please note that you will need to configure the details of reference block and expiration, so you will need to connect to the mainnet during transaction construction. We advise that you set the latest block on the full node as your reference block and production time of the latest block+N minutes as your expiration time. N could be any number you find fit. The backstage condition is `Expiration > production time of the latest block and Expiration < production time of the latest block + 24 hours`. If the condition is fulfilled, then the transaction is legitimate, and if not, the transaction is expired and will not be acknowledged by the network.
A method of setting reference block: set RefBlockHash as subarray of newest block's hash from 8 to 16, set BlockBytes as subarray of newest block's height from 6 to 8. [The demo code](https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java) is as follows:  
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
Look at a method of setting Expiration and transaction timestamp:
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
After a transaction is constructed, it can be signed using the ECDSA algorithm. For security reasons, we suggest all exchanges to adopt offline signatures. 

https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Procedures_of_transaction_signature_generation.md


## 10.4 Demo
The demo for local transaction construction and signing can be found at:
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java.

# 11. demo
For our nodejs demo, please refer https://github.com/tronprotocol/tron-demo/tree/master/demo/nodejs

# 12. ERC20 TRX to Mainnet TRX Swap
TRON will always support swapping ERC20 TRX to TRON Mainnet TRX.

- For users: Please deposit your ERC20 in an exchange that supports the swap.
- For Exhanges: Please contact TRON to swap your ERC20 TRX to Mainnet TRX

# 13. Super Representatives and Voting
The Super Representatives(SR) take important roles to build and operate on TRON network such as block generation and transaction packing. They receive some TRX as rewards. Every 3 seconds a new block is generated. The top 27 SRs receive 32 TRX per block in sequence, and the top 127 SRs share 32 TRX proportional to the amount of votes they hold. This means that the top 27 SRs will be rewarded over 32 TRX per block.

All TRX holders can vote for SRs as long as they have Tron Power available. Tron Power can be gained by freezing TRX. To vote for SR candidates you can use your favorite wallet or [TronScan, the official Web wallet](https://tronscan.org).

See also: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Blockchain_Explorer/Guide_to_voting_on_the_new_blockchain_explorer.md


# 14. Relevant files
See also: https://github.com/tronprotocol/Documentation#documentation-guide

