# TRON protobuf protocol

## TRON使用Google protobuf协议，协议内容涉及到账户，区块，传输多个层面。

+	账户有基本账户、资产发布账户和合约账户三种类型。一个账户包含：账户名称，账户类型，地址，余额，投票，其他资产6种属性。
+	更进一步的，基本账户可以申请成为验证节点，验证节点具有额外的属性，投票统计数目，公钥，URL，以及历史表现等参数。

   3种`Account`类型：`Normal`，`AssetIssue`，`Contract`。

    enum AccountType {   
      Normal = 0;   
      AssetIssue = 1;   
      Contract = 2; 
     }

   一个`Account`包含6种参数：  
   `account_name`：该账户的名称——比如： ”_SicCongsAccount_”。  
   `type`:该账户的类型——比如：  _0_ 代表的账户类型是`Normal`。  
   `balance`:该账户的TRX余额——比如：_4213312_。  
   `votes`:账户所得投票数——比如：_{(“0x1b7w…9xj3”,323),(“0x8djq…j12m”,88),…,(“0x82nd…mx6i”,10001)}_。  
   `asset`：除TRX以外账户上的其他资产——比如：_{<”WishToken”,66666>,<”Dogie”,233>}_。

    // Account 
    message Account {   
      message Vote {     
        bytes vote_address = 1;     
        int64 vote_count = 2;   
       }   
       bytes accout_name = 1;   
       AccountType type = 2;   
       bytes address = 3;   
       int64 balance = 4;   
       repeated Vote votes = 5;   
       map<string, int64> asset = 6; 
     }

   一个`Witness`包含8种参数：  
   `address`：验证节点的地址——比如：_“0xu82h…7237”_。   
   `voteCount`：验证节点所得投票数——比如：_234234_。  
   `pubKey`：验证节点的公钥——比如：_“0xu82h…7237”_。  
   `url`：验证节点的url链接——比如：_“https://www.noonetrust.com”_。  
   `totalProduce`：验证节点产生的区块数——比如：_2434_。  
   `totalMissed`：验证节点丢失的区块数——比如：_7_。  
   `latestBlockNum`：最新的区块高度——比如：_4522_。

    // Witness 
    message Witness {   
      bytes address = 1;   
      int64 voteCount = 2;   
      bytes pubKey = 3;   
      string url = 4;   
      int64 totalProduced = 5;   
      int64 totalMissed = 6;   
      int64 latestBlockNum = 7;
      }

+	一个区块由区块头和多笔交易构成。区块头包含时间戳，交易字典树的根，父哈希，签名等区块基本信息。

   一个`block`包含`transactions`和`block_header`。  
   `transactions`：区块里的交易信息。  
   `block_header`：区块的组成部分之一。

    // block 
    message Block {   
      repeated Transaction transactions = 1;   
      BlockHeader block_header = 2;
      }

   `BlockHeader` 包括`raw_data`和`witness_signature`。  
   `raw_data`：`raw`信息。  
   `witness_signature`：区块头到验证节点的签名。

   message `raw`包含6种参数：  
   `timestamp`：该消息体的时间戳——比如：_14356325_。  
   `txTrieRoot`：Merkle Tree的根——比如：_“7dacsa…3ed”_。  
   `parentHash`：上一个区块的哈希值——比如：_“7dacsa…3ed”_。  
   `number`：区块高度——比如：_13534657_。  
   `witness_id`：验证节点的id——比如：_“0xu82h…7237”_。  
   `witness_address`：验证节点的地址——比如：_“0xu82h…7237”_。

    message BlockHeader {   
      message raw {     
        int64 timestamp = 1;     
        bytes txTrieRoot = 2;     
        bytes parentHash = 3;    
        //bytes nonce = 5;    
        //bytes difficulty = 6;     
        uint64 number = 7;     
        uint64 witness_id = 8;     
        bytes witness_address = 9;   
       }   
       raw raw_data = 1;   
       bytes witness_signature = 2;
      }

+	交易合约有多种类型，包括账户创建合约、转账合约、转账断言合约、资产投票合约、见证节点投票合约、见证节点创建合约、资产发布合约、部署合约8种类型。

   `AccountCreatContract`包含3种参数：  
   `type`：账户类型——比如：_0_ 代表的账户类型是`Normal`。  
   `account_name`： 账户名称——比如： _"SiCongsaccount”_。  
   `owner_address`：合约持有人地址——比如： _“0xu82h…7237”_。

    message AccountCreateContract {   
      AccountType type = 1;   
      bytes account_name = 2;   
      bytes owner_address = 3;  
     }

`TransferContract`包含3种参数：  
`amount`：TRX数量——比如：_12534_。  
`to_address`： 接收方地址——比如：_“0xu82h…7237”_。  
`owner_address`：合约持有人地址——比如：_“0xu82h…7237”_。

    message TransferContract {   
      bytes owner_address = 1;   
      bytes to_address = 2;   
      int64 amount = 3;
      }

   `TransferAssetContract`包含4种参数：  
   `asset_name`：资产名称——比如：_”SiCongsaccount”_。  
   `to_address`：接收方地址——比如：_“0xu82h…7237”_。  
   `owner_address`：合约持有人地址——比如：_“0xu82h…7237”_。  
   `amount`：目标资产数量——比如：_12353_。

    message TransferAssetContract {   
      bytes asset_name = 1;   
      bytes owner_address = 2;   
      bytes to_address = 3;   
      int64 amount = 4; 
     }

   `VoteAssetContract`包含4种参数：  
   `vote_address`：投票人地址——比如：_“0xu82h…7237”_。  
   `support`：投票赞成与否——比如：_true_。  
   `owner_address`：合约持有人地址——比如：_“0xu82h…7237”_。  
   `count`：投票数目——比如：_2324234_。

    message VoteAssetContract {   
      bytes owner_address = 1;   
      repeated bytes vote_address = 2;   
      bool support = 3;   
      int32 count = 5;
     }

   `VoteWitnessContract`包含4种参数：  
   `vote_address`：投票人地址——比如：_“0xu82h…7237”_。  
   `support`：投票赞成与否——比如：_true_。   
   `owner_address`：合约持有人地址——比如：_“0xu82h…7237”_。  
   `count`：投票数目——比如：_32632_。 

    message VoteWitnessContract {   
      bytes owner_address = 1;   
      repeated bytes vote_address = 2;   
      bool support = 3;   
      int32 count = 5; 
     }

   `WitnessCreateContract`包含3种参数：  
   `private_key`：合约的私钥——比如：_“0xu82h…7237”_。  
   `owner_address`：合约持有人地址——比如：_“0xu82h…7237”_。  
   `url`：合约的url链接——比如：_“https://www.noonetrust.cn”_。

    message WitnessCreateContract {   
      bytes owner_address = 1;   
      bytes private_key = 2;   
      bytes url = 12;
      }

   `AssetIssueContract`包含11种参数：  
   `name`：合约名称——比如：_“SiCongcontract”_。  
   `total_supply`：合约的赞成总票数——比如：_100000000_。  
   `owner_address`：合约持有人地址——比如：_“0xu82h…7237”_。  
   `trx_num`：对应TRX数量——比如：_232241_。  
   `num`： 对应的自定义资产数目。  
   `start_time`：开始时间——比如：_20170312_。  
   `end_time`：结束时间——比如：_20170512_。  
   `decav_ratio`：衰减速率。  
   `vote_score`：合约的评分——比如：_12343_。  
   `description`：合约的描述——比如：_”trondada”_。  
   `url`：合约的url地址链接——比如：_“https://www.noonetrust.cn”_。

    message AssetIssueContract {   
      bytes owner_address = 1;   
      bytes name = 2;   
      int64 total_supply = 4;   
      int32 trx_num = 6;   
      int32 num = 8;   
      int64 start_time = 9;   
      int64 end_time = 10;   
      int32 decay_ratio = 15;  
      int32 vote_score = 16;  
      bytes description = 20;   
      bytes url = 21; 
     }

   `DeployContract`包含2种参数：  
   `script`：脚本。  
   `owner_address`：合约持有人地址——比如：_“0xu82h…7237”_。

    message DeployContract {   
      bytes owner_address = 1;   
      bytes script = 2; 
     }

+	每一个交易还包含多个输入与多个输出，以及其他一些相关属性。其中交易内的输入，交易本身，区块头均需签名。

   消息体 `Transaction`包括`raw_data`和`signature`。  
   `raw_data`: 消息体`raw`。  
   `signature`: 所有输入节点的签名。

   `raw_data`包含7种参数：  
   `type`：消息体raw的交易类型。  
   `vin`： 输入值。  
   `vout`： 输出值。  
   `expiration`：过期时间——比如：_20170312_。  
   `data`： 数据。  
   `contract`： 该交易内的合约。  
   `script`： 脚本。

   消息体 `Contract`包含`type`和`parameter`。  
   `type`：合约的类型。  
   `parameter`：任意参数。

   有八种账户类型合约：`AccountCreateContract`，`TransferContract`，`TransferAssetContract`，`VoteAssetContract`，`VoteWitnessContract`，`WitnessCreateContract`，`AssetIssueContract` 和`DeployContract`。

   `TransactionType`包括`UtxoType`和`ContractType`。

    message Transaction {   
      enum TranscationType {     
        UtxoType = 0;     
        ContractType = 1;   
       }   
       message Contract {    
         enum ContractType {       
           AccountCreateContract = 0;       
           TransferContract = 1;       
           TransferAssetContract = 2;       
           VoteAssetContract = 3;       
           VoteWitnessContract = 4;      
           WitnessCreateContract = 5;       
           AssetIssueContract = 6;       
           DeployContract = 7;     
          }     
          ContractType type = 1;     
          google.protobuf.Any parameter = 2;  
        }   
        message raw {     
          TranscationType type = 2;     
          repeated TXInput vin = 5;     
          repeated TXOutput vout = 7;     
          int64 expiration = 8;     
          bytes data = 10;     
          repeated Contract contract = 11;     
          bytes scripts = 16;   
         }   
         raw raw_data = 1;   
         repeated bytes signature = 5; 
     }

   消息体 `TXOutputs`由`outputs`构成。  
   `outputs`: 元素为`TXOutput`的数组。

    message TXOutputs {   
      repeated TXOutput outputs = 1;
      }

   消息体 `TXOutput`包括`value`和`pubKeyHash`。  
   `value`：输出值。  
   `pubKeyhash`：公钥的哈希。

    message TXOutput {   
      int64 value = 1;   
      bytes pubKeyHash = 2;
      }

   消息体 `TXIutput`包括`raw_data`和`signature`。  
   `raw_data`：消息体`raw`。  
   `signature`：`TXInput`的签名。

   消息体 `raw`包含`txID`，`vout`和 `pubKey`。  
   `txID`：交易ID。  
   `Vout`：上一个输出的值。  
   `pubkey`:公钥。

    message TXInput {   
      message raw {     
        bytes txID = 1;     
        int64 vout = 2;     
        bytes pubKey = 3;   
       }   
       raw raw_data = 1;  
       bytes signature = 4; }

+	传输涉及的协议Inventory主要用于传输中告知接收方传输数据的清单。

   `Inventory`包括`type`和`ids`。  
   `type`：清单类型——比如：_0_ 代表`TRX`。  
   `ids`：清单中的物品ID。

   `InventoryType`包含`TRX`和 `BLOCK`。  
   `TRX`：交易。  
   `BLOCK`：区块。

    // Inventory 
    message Inventory {   
      enum InventoryType {     
        TRX = 0;     
        BLOCK = 1;   
       }   
       InventoryType type = 1;   
       repeated bytes ids = 2;
      }

   消息体 `Items`包含4种参数：  
   `type`：物品类型——比如：_1_ 代表 `TRX`。  
   `blocks`：物品中区块。  
   `blockheaders`：区块头。  
   `transactions`：交易。

   `Items`有四种类型，分别是 `ERR`， `TRX`，`BLOCK` 和`BLOCKHEADER`。  
   `ERR`：错误。  
   `TRX`：交易。  
   `BLOCK`：区块。  
   `BLOCKHEADER`：区块头。

    message Items {   
      enum ItemType {     
        ERR = 0;     
        TRX = 1;     
        BLOCK = 2;     
        BLOCKHEADER = 3;   
       }   
       ItemType type = 1;   
       repeated Block blocks = 2;   
       repeated BlockHeader block_headers = 3;   
       repeated Transaction transactions = 4; 
     }

   `Inventory`包含`type`和`items`。  
   `type`：物品种类。  
   `items`：物品清单。

    message InventoryItems {   
      int32 type = 1;   
      repeated bytes items = 2; 
     }

+	钱包服务RPC

   `Wallet`钱包服务包含多个RPC。  
   __`Getbalance`__：获取`Account`的余额。  
   __`CreatTransaction`__：通过`TransferContract`创建交易。  
   __`BroadcastTransaction`__：广播`Transaction`。  
   __`CreateAccount`__：通过`AccountCreateContract`创建账户。  
   __`CreatAssetContract`__：通过`AssetIssueContract`发布一个资产。

    service Wallet {    
    
      rpc GetBalance (Account) returns (Account) {    
      
      };   
      rpc CreateTransaction (TransferContract) returns (Transaction) {    
      
      };    
      rpc BroadcastTransaction (Transaction) returns (Return) {    
      
      };    
      rpc CreateAccount(AccountCreateContract) returns (Transaction) {    
      
      };    rpc CreateAssetIssue(AssetIssueContract) returns (Transaction) {    
      
      };  
      
     };

   消息体`Return`只含有一个参数：  
   `result`: 布尔表类型标志位。  

    message `Return` {   
      bool result = 1; 
     }


# 详细的协议见附属文件。详细协议随着程序的迭代随时都可能发生变化，请以最新的版本为准。