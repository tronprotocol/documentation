
# 1.BackGround

Event is an important funcionality to help developer confirm, check, search specific status for their smart contract. This article explain how to decode event the result get from transactionHistory database.

# 2. Event example in solidity
```
contract EventExampleContract {
    event Transfer(address indexed toAddress, uint256 amount);
    constructor() payable public{}
    function contractTransfer(address toAddress, uint256 amount){
        toAddress.transfer(amount);
        emit Transfer(toAddress, amount);
    }
}
```

# 3. Event structure

Solidity use LOG instruction to record event information in a transaction. The structure in protobuf:
```
message TransactionInfo {
  enum code {
    SUCESS = 0;
    FAILED = 1;
  }
  // LOG Structure represent single event
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
  // A list of LOG represent list of events in a transaction
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
- Address: the contract address

- topics:

 topics[0] => event hash. This is an optional item. If the event is modificated by anonymous keyword, topics[0] is the first indexed param.
 
 topics[1] => event first indexed param if exist.
 
 topics[2] => event second indexed param if exist.
 
 topics[3] => event third indexed param if exist (Maximum 3).

- data:       other params value without being indexed. If it is more than one parameters, all the parameter will be appended one by one. And you can decode them the same way as the contract result in https://github.com/tronprotocol/Documentation/blob/master/中文文档/虚拟机/TVM调用结果解析说明.md basing on abi

# 4. Example of decoding events.
Use the solidity code in section 2 above.
ABI can be get as
```
[{"constant":false,"inputs":[{"name":"toAddress","type":"address"},{"name":"amount","type":"uint256"}],"name":"contractTransfer","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":true,"stateMutability":"payable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"toAddress","type":"address"},{"indexed":false,"name":"amount","type":"uint256"}],"name":"Transfer","type":"event"}]
```
so the event abi is
```
{"anonymous":false,"inputs":[{"indexed":true,"name":"toAddress","type":"address"},{"indexed":false,"name":"amount","type":"uint256"}],"name":"Transfer","type":"event"}
```
Use `gettransactioninfobyid <id>` to get the result of your transaction
```
LogList:
address:
289C4D540B32C7BC56953E55631F8B141EB86434                          // contract address
data:
0000000000000000000000000000000000000000000000000000000000000001
TopicsList
69ca02dd4edd7bf0a4abb9ed3b7af3f14778db5d61921c7dc7cd545266326de2  // topics[0]
000000000000000000000000E552F6487585C2B58BC2C9BB4492BC1F17132CD0  // topics[1]
```
Check along with ABI:

- topics[0] is 69ca02dd4edd7bf0a4abb9ed3b7af3f14778db5d61921c7dc7cd545266326de2. It is the result of keccak("event(address,uint256)").

- topics[1] is 000000000000000000000000E552F6487585C2B58BC2C9BB4492BC1F17132CD0. It is the first indexed param (toAddress) with type address.

- data is 0000000000000000000000000000000000000000000000000000000000000001. It is the param without being indexed (amount)  with type uint256.
