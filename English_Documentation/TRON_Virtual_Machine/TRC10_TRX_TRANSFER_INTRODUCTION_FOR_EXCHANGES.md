# I. Abstract

To detect a trx or trc10 transaction in tron mainly need to deal with 4 different types of contracts,TransferContract (System Contract Type) TransferAssetContract (System Contract Type), CreateSmartContract (Smart Contract Type), TriggerSmartContract (Smart Contract Type).

The data type also need to be notice are `Transaction`, `TransactionInfo` and `Block`, those contans all the result information for a smart contract transaction.

## Related Protobuf 
- TransferContract
```
message TransferContract {
  bytes owner_address = 1;
  bytes to_address = 2;
  int64 amount = 3;
}
```
- TransferAssetContract
```
message TransferAssetContract {
  bytes asset_name = 1; // this field is token name before the proposal ALLOW_SAME_TOKEN_NAME is active, otherwise it is token id and token is should be in string format.
  bytes owner_address = 2;
  bytes to_address = 3;
  int64 amount = 4;
}
```
- CreateSmartContract
```
message CreateSmartContract {
  bytes owner_address = 1;
  SmartContract new_contract = 2;
  int64 call_token_value = 3;
  int64 token_id = 4;
}

```
- TriggerSmartContract
```
message TriggerSmartContract {
  bytes owner_address = 1;
  bytes contract_address = 2;
  int64 call_value = 3;
  bytes data = 4;
  int64 call_token_value = 5;
  int64 token_id = 6;
}
```
- Transaction
```
message Transaction {
  message Contract {
    enum ContractType {
      AccountCreateContract = 0;
      TransferContract = 1;
      TransferAssetContract = 2;
      VoteAssetContract = 3;
      VoteWitnessContract = 4;
      WitnessCreateContract = 5;
      AssetIssueContract = 6;
      WitnessUpdateContract = 8;
      ParticipateAssetIssueContract = 9;
      AccountUpdateContract = 10;
      FreezeBalanceContract = 11;
      UnfreezeBalanceContract = 12;
      WithdrawBalanceContract = 13;
      UnfreezeAssetContract = 14;
      UpdateAssetContract = 15;
      ProposalCreateContract = 16;
      ProposalApproveContract = 17;
      ProposalDeleteContract = 18;
      SetAccountIdContract = 19;
      CustomContract = 20;
      // BuyStorageContract = 21;
      // BuyStorageBytesContract = 22;
      // SellStorageContract = 23;
      CreateSmartContract = 30;
      TriggerSmartContract = 31;
      GetContract = 32;
      UpdateSettingContract = 33;
      ExchangeCreateContract = 41;
      ExchangeInjectContract = 42;
      ExchangeWithdrawContract = 43;
      ExchangeTransactionContract = 44;
      UpdateEnergyLimitContract = 45;
      AccountPermissionUpdateContract = 46;
      PermissionAddKeyContract = 47;
      PermissionUpdateKeyContract = 48;
      PermissionDeleteKeyContract = 49;
    }
    ContractType type = 1;
    google.protobuf.Any parameter = 2;
    bytes provider = 3;
    bytes ContractName = 4;
  }

  message Result {
    enum code {
      SUCESS = 0;
      FAILED = 1;
    }
    enum contractResult {
      DEFAULT = 0;
      SUCCESS = 1;
      REVERT = 2;
      BAD_JUMP_DESTINATION = 3;
      OUT_OF_MEMORY = 4;
      PRECOMPILED_CONTRACT = 5;
      STACK_TOO_SMALL = 6;
      STACK_TOO_LARGE = 7;
      ILLEGAL_OPERATION = 8;
      STACK_OVERFLOW = 9;
      OUT_OF_ENERGY = 10;
      OUT_OF_TIME = 11;
      JVM_STACK_OVER_FLOW = 12;
      UNKNOWN = 13;
    }
    int64 fee = 1;
    code ret = 2;
    contractResult contractRet = 3;

    string assetIssueID = 14;
    int64 withdraw_amount = 15;
    int64 unfreeze_amount = 16;
    int64 exchange_received_amount = 18;
    int64 exchange_inject_another_amount = 19;
    int64 exchange_withdraw_another_amount = 20;
    int64 exchange_id = 21;
  }

  message raw {
    bytes ref_block_bytes = 1;
    int64 ref_block_num = 3;
    bytes ref_block_hash = 4;
    int64 expiration = 8;
    repeated authority auths = 9;
    // data not used
    bytes data = 10;
    //only support size = 1,  repeated list here for extension
    repeated Contract contract = 11;
    // scripts not used
    bytes scripts = 12;
    int64 timestamp = 14;
    int64 fee_limit = 18;
  }

  raw raw_data = 1;
  // only support size = 1,  repeated list here for muti-sig extension
  repeated bytes signature = 2;
  repeated Result ret = 5;
}
```
- TransactionInfo
```
message TransactionInfo {
  enum code {
    SUCESS = 0;
    FAILED = 1;
  }
  message Log {
    bytes address = 1;
    repeated bytes topics = 2;
    bytes data = 3;
  }
  bytes id = 1;
  int64 fee = 2;
  int64 blockNumber = 3;
  int64 blockTimeStamp = 4;
  repeated bytes contractResult = 5;
  bytes contract_address = 6;
  ResourceReceipt receipt = 7;
  repeated Log log = 8;
  code result = 9;
  bytes resMessage = 10;

  string assetIssueID = 14;
  int64 withdraw_amount = 15;
  int64 unfreeze_amount = 16;
  repeated InternalTransaction internal_transactions = 17;
  int64 exchange_received_amount = 18;
  int64 exchange_inject_another_amount = 19;
  int64 exchange_withdraw_another_amount = 20;
  int64 exchange_id = 21;
}
```
Block
```
message Block {
  repeated Transaction transactions = 1;
  BlockHeader block_header = 2;
}
```

# II. Detect and record Transfer with TransferContract and TransferAssetContract


These two contracts,  `TransferContract`and `TransferAssetContract`, are system contracts, which are used to transfer trx and trc10 respectively.A transaction contains only one contract, so the query transaction can get specific information about a contract, using interface `GetTransactionbyid`.In addition, using the interface `GetBlockByNum` can get all the transactions of a block.


## Steps

1. Get Block (optional step): Use `GetBlockByNum` to retreive block info (`Block`).

2. Get Transaction: Travel `Block` or use `GetTransactionInfoById` to get specific transaction (`Transaction`).

3. Check root Transaction result: Transaction.Result.code is FAILED, simply reject this transaction. No transferring happened. Otherwise, continue to read below.

4. Check `type` in `Transaction.raw` to get contract type information (`TransferContract` or `TransferAssetContract`).

5. Check `parameter` in `Transaction.raw` to get contract details according to `type`. 

#### TransferContract

  - `owner_address` (Bytes) is the trx  sender address. Need to convert Bytes to a base58Check String to show readable Tron address.
  
  - `to_address` (Bytes) is the trx  receiver address. Need to convert Bytes to a base58Check String to show readable Tron address.
  
  - `amount` (int64) is the trx amount send to the contract address. 
  
#### TransferAssetContract

  - `asset_name` (String) is the trc10 id. No need to do any convert to show readable Tron address. (This parameter used to represent the name of the trc10. After the proposal ALLOW_SAME_TOKEN_NAME, it has been modified to trc10 id)
  
  - `owner_address` (Bytes) is the trc10  sender address. Need to convert Bytes to a base58Check String to show readable Tron address.
  
  - `to_address` (Bytes) is the trc10  receiver address. Need to convert Bytes to a base58Check String to show readable Tron address.
  
  - `amount` (int64) is the trc10 amount send to the contract address.   
  

  

# III. Detect and record Transfer with CreateSmartContract and TriggerSmartContract.

In general, the way to detect `CreateSmartContract` and `TriggerSmartContract` is pretty similar. By using `GetTransactionbyid` or travel the latest block to get latest transactions one by one, transaction data can be retrieved. As long as you get transaction id, you can use `GetTransactionInfoById` to fetch InternalTransaction info and other smart contract execution details.

## Steps

1. Get Block (optional step): Use `GetBlockByNum` to retreive block info (`Block`).

2. Get Transaction: Travel `Block` or use `GetTransactionInfoById` to get specific transaction (`Transaction`).

3. Check root Transaction result: Transaction.Result.code is FAILED, simply reject this transaction. No transferring happened. Otherwise, continue to read below.

4. Check `type` in `Transaction.raw` to get contract type information (`CreateSmartContract` or `TriggerSmartContract`).

5. **Get trx and trc10 transfer information those send along with the root transaction:** Check `parameter` in `Transaction.raw` to get contract details according to `type`. 

#### CreateSmartContract

  - `owner_address` (Bytes) is the trx or trc10 sender address. Need to convert Bytes to a base58Check String to show readable Tron address.

  - `SmartContract.contract_address` (Bytes) is the trx or trc10 reciever's address and it **HAS-TO-BE** a smart contract address. Due to it is created in runtime, you cannot retrieve it from the `Transaction`, instead you have to use `GetTransactionInfoById` to get `contract_address` in `TransactionInfo`.  The data need to be converted from Bytes to a base58Check String to show readable Tron address.

  - `SmartContract.call_value` (int64) is the trx amount send to the contract address. 

  - `call_token_value` (int64) is the trc10 amount send to the contract address. 

  - `token_id` (String) is the related trc10 id. No need to do any convert to show readable Tron address

  #### TriggerSmartContract

  - `owner_address` (Bytes) is the trx or trc10 sender address. Need to convert Bytes to a base58Check String to show readable Tron address.

  - `contract_address` (Bytes) is the trx or trc10 reciever's address and it **HAS-TO-BE** a smart contract address. Need to convert Bytes to a base58 String to show readable Tron address.

  - `call_value` (int64) is the trx amount send to the contract address. 

  - `call_token_value` (int64) is the trc10 amount send to the contract address. 

  - `token_id` (String) is the related trc10 id. No need to do any convert to show readable Tron address

6. **Check trx transfering or trc10 transfering in `InternalTransaction`**. 

  - `caller_address` (Bytes) is the trx or trc10 token sender address. Need to convert Bytes to a base58Check String to show readable Tron address.

  - `transferTo_address`(Bytes) is the trx or trc10 token reciever address. Need to convert Bytes to a base58Check String to show readable Tron address.

  - `CallValueInfo` is a list of transfer details. 

  - `callvalue` (int64) represent trx amount if `tokenId` is empty. Otherwise it is the token transfer value. 

  - `tokenId` (String) is the token identifier. `rejected` represent whether this internaltransaction is failed and rejected. If it is `true`. You do not need to deal with current internaltrasaction, since some error occurred. Otherwise, it is successful with value `false`.


