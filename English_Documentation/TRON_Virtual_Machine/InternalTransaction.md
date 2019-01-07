# InternalTransaction

## 1. BackGround

InternalTransactions represent all transactions happened in a smart contract call. Some important information are included in the transaction, such as the sender/reciever address in a token/trx transfer transaction, trx/token amount, transfer status, etc.

An user can check all the information about InternalTransactions in a interanlTransaction list, which contains all transaction in a single triggerSmartContract or createSmartContract call.

## 2. Structure of InternalTransaction information.

```
message InternalTransaction {
  bytes hash = 1;
  // the one send trx or token via function
  bytes caller_address = 2;
  // the one recieve trx or token via function
  bytes transferTo_address = 3;
  message CallValueInfo {
    // trx or token value
    int64 callValue = 1;
    // tokenId, trx should be empty
    string tokenId = 2;
  }
  repeated CallValueInfo callValueInfo = 4;
  bytes note = 5;
  bool rejected = 6;
}
```
* hash: unique identifier for a internal transaction. Should not exist same hash across all InternalTransactions or transactions.

* caller_address: the address send trx or trc10 token

* transferTo_address: the address recieve trx or trc10 token

* callValueInfo: indicate the amount and type of asset and trx transfer. It could be a list of <amount,id> pairs

   1. callvalue: the amount of trx or trc10 token.
   
   2. tokenId  : the trc10 tokenId. An empty value represents trx.
   
* note: note can only have 3 types of values, call, create, suicide, that represent the internaltransaction type.
       
   1. call: internaltransaction happened within a contract call contract case
   
   2. create: internaltransaction happened within a contract create contract case
   
   3. suicide: internaltransaction happened within a contract selfdestruct case

* rejected: boolean value. Show whether this internal transaction is rejected due to some error.

   1. true: The internal transaction is rejected and it is not be executed.
   
   2. false: The internal transaction is successfully executed.
   

## 3. How to get internalTransaction

Calling rpc api gettransactioninfobyid with a transaction id as its parameter on a internalTransaction supported node, a list of internaltransaction will be shown.

1. the searching node config.conf should have `saveInternalTx = true`

2. use rpc example: in wallet-cli, you can use command `gettransactioninfobyid <transactionId>` to check all the internaltransaction info in `internal_transactions` field.

Note: You may not be able to get the internal transaction for early transaction id, since the node hasn't switched on `saveInternalTx = true` at that time.  So, if you want a full data of internaltransactions, you need a fullnode which turn `saveInternalTx = true` on from the very beginning when tron launched tvm.
   
## 4. wallet-cli result example

```
InternalTransactionList: 
[
  hash:
  a07aaf40f35b42344d4909e8f739b32463c21a0c543fa212335f5d0d35f4db9d16  
  caller_address:
  4145867eff384dd351003dffc38fe6e25549fac58  
  transferTo_address:
  41537144c324033c5dc51759872f76e8f00f2edfa6  
  callValueInfo:
  [
    TokenName(Default trx):
    TRX(SUN)    
    callValue:
    10000000  
  ]
    
  note:
  create  
  rejected:
  false  
]
[
  hash:
  28fbeeeab85eda244cf83172380b1f26da07ad7a34bb90abdb75dff905736ab1c  
  caller_address:
  4143144c324033c5dc51776572f76e8f00f2edfa6  
  transferTo_address:
  412301d22dd9c7533b3d9c006f4279a823af41456  
  callValueInfo:
  [
    TokenName(Default trx):
    TRX(SUN)    
    callValue:
    10000000  
  ]
    
  note:
  call  
  rejected:
  false 
]
 ```
