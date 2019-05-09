# TRON Blockchain Documentation

[TOC]

# 1 Project Repository

Github Url: https://github.com/tronprotocol
java-tron is the source code of the main net, protocol is the defination of the api and data structure, wallet-cli is the official command line wallet

Test net Configuration:
https://github.com/tronprotocol/TronDeployment/blob/master/test_net_config.conf

Main net Configuration:
https://github.com/tronprotocol/TronDeployment/blob/master/main_net_config.conf

# 2 Tron Super Representatives and Committee

## 2.1 How to become a super representative

 In TRON network, any account can apply to become a super representative candidate. Every account can vote for super representative candidates. The top 27 candidates with the most votes are the super representatives. Super representatives can produce blocks. The votes will be counted every 6 hours, so super representatives may also change every 6 hours. 

 To prevent vicious attack, TRON network burns 9999 TRX from the account that applies to become a super representative candidate.

## 2.2 Super representatives election

 To vote, you need to have TRON Power(TP). To get TRON Power, you need to freeze TRX. Every 1 frozen TRX accounts for one TRON Power(TP).

 Every account in TRON network has the right to vote for a super representative candidate.

 After you unfreeze your frozen TRX, you will lose the responding TRON Power(TP), so your previous vote will be invalid.

 Note: Only your latest vote will be counted in TRON network which means your previous vote will be over written by your latest vote.

+ Examples (Using wallet-cli):

```
freezebalance 10,000,000 3 // Freeze 10 TRX to get 10 TRON Power(TP)
votewitness witness1 4 witness2 6 // Vote 4 votes for witness1, 6 votes for witness2
votewitness witness1 3 witness2 7 // Vote 3 votes for witness1, 7 votes for witness2
```

The final output above is: Vote 3 votes for witness1, 7 votes for witness2

## 2.3 Reward for super representatives

1. Votes reward. Every 6 hours, the top 127 super representative candidates with the most votes will share a total amount of 115,200 TRX according to their votes percentage. The annual votes reward is 168,192,000 TRX in total.

2. Block producing reward. Every time after a super representative produces a block, it will be reward 32 TRX. The 27 super representatives take turns to produce blocks every 3 seconds. The annual block producing reward is 336,384,000 TRX in total.

+ Every time after a super representative produces a block, the 32 TRX block producing reward will be sent to it's sub account. The sub-account is a read-only account, it allows a withdraw action from sub-account to super representative account every 24 hours.

## 2.4 Committee

### 2.4.1 What is committee
Committee can modify the TRON network parameters, like transacton fees, block producing reward amount, etc. Committee is composed by the current 27 super representatives. Every super representative has the right to start a proposal. The proposal will be passed after it gets more than 19 approves from the super representatives and will become valid in the next maintenance period.

### 2.4.2 Create a proposal
Only the account of a super representative can create a proposal. The network parameters can be modified([min,max]):
- 0: MAINTENANCE_TIME_INTERVAL, [3 * 27* 1000 ,24 * 3600 * 1000] //super representative votes count time interval, currently 6 * 3600 * 1000 ms
- 1: ACCOUNT_UPGRADE_COST, [0,100 000 000 000 000 000]  //the fee to apply to become a super representative candidate, currently 9999_000_000 Sun
- 2: CREATE_ACCOUNT_FEE, [0,100 000 000 000  000 000] //the fee to create an account, currently 100_000 Sun
- 3: TRANSACTION_FEE, [0,100 000 000 000 000 000] //the fee for bandwidth, currently 10 Sun/byte
- 4: ASSET_ISSUE_FEE, [0,100 000 000 000 000 000] //the fee to issue an asset, currently 1024_000_000 Sun
- 5: WITNESS_PAY_PER_BLOCK, [0,100 000 000 000 000 000] //the block producing reward, currently 32_000_000 Sun
- 6: WITNESS_STANDBY_ALLOWANCE, [0,100 000 000 000 000 000] //the votes reward for top 127 super representative candidates, currently 115_200_000_000 Sun
- 7: CREATE_NEW_ACCOUNT_FEE_IN_SYSTEM_CONTRACT, []//the fee to create an account in system, currently 0 Sun
- 8: CREATE_NEW_ACCOUNT_BANDWIDTH_RATE, //the consumption of bandwith or TRX while creating an account, using together with #7
- 9: ALLOW_CREATION_OF_CONTRACTS, //to enable the VM
- 10: REMOVE_THE_POWER_OF_THE_GR  //to clear the votes of GR
- 11: ENERGY_FEE, [0,100 000 000 000 000 000] //sun
- 12: EXCHANGE_CREATE_FEE, [0,100 000 000 000 000 000] //sun
- 13: MAX_CPU_TIME_OF_ONE_TX, [0, 1000] //ms
- 14: ALLOW_UPDATE_ACCOUNT_NAME, //to allow users to change account name and allow account duplicate name, currently 0, means false
- 15: ALLOW_SAME_TOKEN_NAME, //to allow create a token with duplicate name, currently 1, means true
- 16: ALLOW_DELEGATE_RESOURCE, //to enable the resource delegation
- 17: TOTAL_ENERGY_LIMIT, //to modify the energy limit
- 18: ALLOW_TVM_TRANSFER_TRC10, //to allow smart contract to transfer TRC-10 token, currently 0, means false


+ API:
`
createproposal id0 value0 ... idN valueN
id0_N: parameter number
value0_N: parameter value
`

Note: In TRON network, 1 TRX = 1000_000 Sun

### 2.4.3 Vote for a proposal
Proposal only support YES vote. Since the creation time of the proposal, the proposal is valid within 3 days. If the proposal does not receive enough YES votes within the period of validity, the proposal will be invalid beyond the period of validity. Yes vote can be cancelled.


+ API:
`
approveProposal id is_or_not_add_approval
id: Proposal id
is_or_not_add_approval: YES vote or cancel YES vote
`

### 2.4.4 Cancel proposal
Proposal creator can cancel the proposal before it is passed.

+ API:
`
deleteProposal proposalId
id: Proposal id
`

### 2.4.5 Query proposal

Query all the proposals list (ListProposals), Query all the proposals list by pagination (GetPaginatedProposalList), Query a proposal by proposal id (GetProposalById)     
For more api detail, please refer to [Tron-http](Tron-http.md)

# 3 TRON Account
## 3.1 Introduction
TRON uses account model. An account's identity is address, it needs private key signature to operate an account. An account has many attributes, like TRX balance, tokens balance, bandwidth, etc. TRX and tokens can be transfered from account to account and it costs bandwidth. An account can also issue a smart contract, apply to become a super representative candidate, vote, etc. All TRON's activities are based on account.
## 3.2 Way to create an account
a) Use a wallet to generate the address and private key
To active the account, you need to transfer TRX or transfer token to the new created account
b) Use an account already existed in TRON network to create an account 
## 3.3 Key-pair generation algorithm
Tron signature algorithm is ECDSA, curve used is SECP256K1. Private key is a random bumber, public key is a point in the elliptic curve. The process is: first generate a random number d to be the private key, then caculate P = d * G as the public key, G is the elliptic curve base point.
## 3.4 Address format
Use the public key P as the input, by SHA3 get the result H. The length of the public key is 64 bytes, SHA3 uses Keccak256. Use the last 20 bytes of H, and add a byte of 0x41 in front of it, then the address come out.
Do basecheck to address, here is the final address. All addresses start with 'T'.
basecheck process: first do sha256 caculation to address to get h1, then do sha256 to h1 to get h2, use the first 4 bytes as check to add it to the end of the address to get address||check, do base58 encode to address||check to get the final result.
character map:
ALPHABET = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz"
## 3.5 Signature
Signature introduction, please refer to:
https://github.com/tronprotocol/Documentation/blob/fix_http/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E4%BA%A4%E6%98%93%E7%AD%BE%E5%90%8D%E6%B5%81%E7%A8%8B.md

# 4 TRON Network Node
## 4.1 SuperNode
### 4.1.1 SuperNode introduction
[Super Representative](https://github.com/tronprotocol/Documentation/blob/master/中文文档/波场区块链浏览器介绍/什么是超级代表.md)(abbr: SR) is the block producer in TRON network, there are 27 SR. They verify the transactions and write the transactions into the blocks, they take turns to produce blocks. The super Representatives' information is public to everyone in TRON network. The best way to browse is using [tronscan](https://tronscan.org/#/representatives)
### 4.1.2 SuperNode deployment
[superNode deployment](https://github.com/tronprotocol/java-tron#running-a-super-representative-node-for-mainnet)
### 4.1.3 Recommended hardware configuration
minimum requirement:  
CPU: 16 cores, RAM: 32G, Bandwidth: 100M, Disk: 1T  
Recommended requirement:  
CPU: > 64 cores RAM: > 64G, Bandwidth: > 500M, Disk: > 20T

## 4.2 FullNode
### 4.2.1 FullNode introduction
FullNode has the complete block chain data, can update data in real time. It can broadcast the transactions and provide api service.
### 4.2.2 FullNode deployment
please refer to [tron-deployment](https://github.com/tronprotocol/tron-deployment)
[fullNode deployment](https://github.com/tronprotocol/tron-deployment#deployment-of-fullnode-on-the-one-host)
### 4.2.3 Recommended hardware configuration
minimum requirement:    
CPU: 16 cores, RAM: 32G, Bandwidth: 100M, Disk: 1T   
Recommended requirement:  
CPU: > 64 cores RAM: > 64G, Bandwidth: > 500M, Disk: > 20T

## 4.3 SolidityNode
### 4.3.1 SolidityNode introduction
SolidityNode only synchronize solidified blocks data from the fullNode it specifies, It also provie api service.
### 4.3.2 SolidityNode deployment
please refer to [tron-deployment](https://github.com/tronprotocol/tron-deployment)
[solidityNode deployment](https://github.com/tronprotocol/tron-deployment#deployment-of-soliditynode-on-the-one-host)
### 4.3.3 Recommended hardware configuration
minimum requirement:    
CPU: 16 cores, RAM: 32G, Bandwidth: 100M, Disk: 1T   
Recommended requirement:  
CPU: > 64 cores RAM: > 64G, Bandwidth: > 500M, Disk: > 20T

## 4.4 TRON Network Instructure
TRON network uses Peer-to-Peer(P2P) network instructure, all nodes status equal. There are three types of node: SuperNode, FullNode, SolidityNode. SuperNode produces blocks, FullNode synchronizes blocks and broadcasts transactions, SolidityNode synchronizes solidified blocks. Any device that deploy the java-tron code can join TRON network as a node.
![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/network.png)
## 4.5 FullNode and SolidityNode Fast Deployment
Download fast deployment script, run the script according to different types of node. 
please refer to [node fast deployment](https://github.com/tronprotocol/tron-deployment#deployment-of-soliditynode-on-the-one-host)
## 4.6 Main net, Test net, Private net
Main net, Test net, Private net all use the same code, only the node start configuration varies.
### 4.6.1 Main net
[main net configuration](https://github.com/tronprotocol/tron-deployment/blob/master/main_net_config.conf)
### 4.6.2 Test net
[test net configuration](https://github.com/tronprotocol/tron-deployment/blob/master/test_net_config.conf)
### 4.6.3 Private net
#### 4.6.3.1 Preconditions
  1、at least two accounts; [how to generate an account](https://tronscan.org/#/wallet/new)  
  2、at least deploy one SuperNode to produce blocks; 
  3、deploy some FullNode to synchronize blocks and broadcast transactions; 
  4、SuperNode and FullNode comprise the private network;  
#### 4.6.3.2 Deployment
##### 4.6.3.2.1 Step 1: SuperNode Deployment
 1、Download private_net_config.conf  
 ```
 wget https://github.com/tronprotocol/tron-deployment/blob/master/private_net_config.conf
 ```
 2、add your private key in localwitness 
 3、set genesis.block.witnesses as the private key's corresponding address
 4、set p2p.version, any positive integer but 11111  
 5、set the first SR needSyncCheck = false, others can be set true  
 6、set node.discovery.enable = true  
 7、run the script  
 ```
 nohup java -Xmx6g -XX:+HeapDumpOnOutOfMemoryError -jar FullNode.jar  --witness  -c private_net_config.conf
 ```
 ```
 command line parameters introduction:
 --witness: start witness function, i.e.: --witness
 --log-config: specify the log configuration file path, i.e.: --log-config logback.xml
 -c: specify the configuration file path, i.e.: -c config.conf

 The usage of the log file:
 Can change the level of the module to control the log output, the default level of each module is INFO, for example: only print the message with the level higher than warn
 <logger name="net" level="WARN"/>
 ```
 The parameters in configuration file that need to modify:  
 localwitness:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/localwitness.jpg)
 witnesses:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/witness.png) 
 version:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/p2p_version.png)  
 enable:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/discovery_enable.png) 

##### 4.6.3.2.2 Step 2: FullNode Deployment
 1、Download private_net_config.conf  
 ```
 wget https://github.com/tronprotocol/tron-deployment/blob/master/private_net_config.conf 
 ```
 2、set seed.node ip.list with SR's ip and port  
 3、set p2p.version the same as SuperNode's p2p.version  
 4、set genesis.block the same as genesis.block
 5、set needSyncCheck true  
 6、set node.discovery.enable true  
 7、run the script  
 ```
 nohup java -Xmx6g -XX:+HeapDumpOnOutOfMemoryError -jar FullNode.jar  --witness  -c private_net_config.conf
 ```
 ```
 command lines parameters
 --witness: start witness function，i.e.: --witness
 --log-config: specify the log configuration file path, i.e.: --log-config logback.xml
 -c: specify the configuration file path, i.e.: -c config.conf
 
 The usage of the log file:
 Can change the level of the module to control the log output, the default level of each module is INFO, for example: only print the message with the level higher than warn
 <logger name="net" level="WARN"/>
 ```
 The parameters in configuration file that need to modify:    
 ip.list:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/ip_list.png)
 p2p.version:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/p2p_version.png)
 genesis.block:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/genesis_block.png)
 needSyncCheck:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/need_sync_check.png)
 node.discovery.enable:  
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/fix_http/TRX_CN/figures/discovery_enable.png)
 
## 4.7 DB Engine
### 4.7.1 Rocksdb
#### 4.7.1.1 Configuration
 Use rocksdb as the data storage engine, need to set db.engine to "ROCKSDB"
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/master/TRX_CN/figures/db_engine.png)
 Note: rocksdb only support db.version=2, do not support db.version=1
 The optimization parameters rocksdb support:
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/master/TRX_CN/figures/rocksdb_tuning_parameters.png)

#### 4.7.1.2 Use rocksdb's data backup function
 Choose rocksdb to be the data storage engine, you can use it's data backup funchtion while running
 ![image](https://raw.githubusercontent.com/tronprotocol/Documentation/master/TRX_CN/figures/db_backup.png)
 Note: FullNode can use data backup function; In order not to affect SuperNode's block producing performance, SuperNode does not support backup service, but SuperNode's backup service node can use this function.
#### 4.7.1.3 Convert leveldb data to rocksdb data
 The data storage structure of leveldb and rocksdb is not compatible, please make sure the node use the same type of data engine all the time. We provide data conversion script which can convert leveldb data to rocksdb data.
 Usage:
```text
  cd to the source code root directory
  ./gradlew build   #build the source code
  java -jar build/libs/DBConvert.jar  #run data conversion command
```
  Note: If the node's data storage directory is self-defined, before run DBConvert.jar, you need to add the following parameters:
  <br>
  <b>src_db_path</b>: specify LevelDB source directory, default output-directory/database
  <br>
  <b>dst_db_path</b>: specify RocksDb source directory, default output-directory-dst/database
  <br>
  for example, if you run the script like this:
  ```text
     nohup java -jar FullNode.jar -d your_database_dir &
  ```
  then, you should run DBConvert.jar this way:
  ```text
  java -jar build/libs/DBConvert.jar  your_database_dir/database  output-directory-dst/database
  ```
  Note: You have to stop the running of the node, and then to run the data conversion script.
  If you do not want to stop the running of the node for too long, after node is shut down, you can copy leveldb's output-directory to the new directory, and then restart the node.
  <br>
  run DBConvert.jar in the previous directory of the new directory, and specify the parameters: `src_db_path`和`dst_db_path` 
  for example:
  ```text
  cp -rf output-directory /tmp/output-directory
  cd /tmp
  java -jar DBConvert.jar output-directory/database  output-directory-dst/database
 ```
  All the whole data conversion process may take 10 hours.
  
#### 4.7.1.4 rocksdb vs leveldb 
you can refer to:
<br>
[rocksdb vs leveldb](https://github.com/tronprotocol/documentation/blob/master/TRX_CN/Rocksdb_vs_Leveldb.md)
<br>
[ROCKSDB vs LEVELDB](https://github.com/tronprotocol/documentation/blob/master/TRX/Rocksdb_vs_Leveldb.md)

# 5 Smart Contract
## 5.1 TRON Smart Contract Introduction

Smart contract is a computerized transaction protocol that automatically implements its terms. Smart contract is the same as common contract, they all define the terms and rules related to the participants. Once the contract is started, it can runs in the way it is designed.

TRON smart contract support Solidity language in (Ethereum). Currently recommend Solidity language version is 0.4.24~0.4.25. Write a smart contract, then build the smart contract and deploy it to TRON network. When the smart contract is triggered, the corresponding function will be executed automatically.

## 5.2 TRON Smart Contract Features
TRON virtual machine is based on Etherum solidity language, it also has TRON's own features.

### 5.2.1 Smart Contract
TRON VM is compatible with Etherum's smart contract, using protobuf to define the content of the contract:

    message SmartContract {
      message ABI {
        message Entry {
          enum EntryType {
            UnknownEntryType = 0;
            Constructor = 1;
            Function = 2;
            Event = 3;
            Fallback = 4;
          }
          message Param {
            bool indexed = 1;
            string name = 2;
            string type = 3;
            // SolidityType type = 3;
          }
          enum StateMutabilityType {
            UnknownMutabilityType = 0;
            Pure = 1;
            View = 2;
            Nonpayable = 3;
            Payable = 4;
          }

          bool anonymous = 1;
          bool constant = 2;
          string name = 3;
          repeated Param inputs = 4;
          repeated Param outputs = 5;
          EntryType type = 6;
          bool payable = 7;
          StateMutabilityType stateMutability = 8;
        }
        repeated Entry entrys = 1;
      }
      bytes origin_address = 1;
      bytes contract_address = 2;
      ABI abi = 3;
      bytes bytecode = 4;
      int64 call_value = 5;
      int64 consume_user_resource_percent = 6;
      string name = 7；
      int64 origin_energy_limit = 8;
    }
    
origin_address: smart contract creator address

contract_address: smart contract address

abi: the api information of the all the function of the smart contract

bytecode: smart contract byte code

call_value: TRX transferred into smart contract while call the contract

consume_user_resource_percent: resource consumption percentage set by the developer

name: smart contract name

origin_energy_limit: energy consumption of the developer limit in one call, must greater than 0. For the old contracts, if this parameter is not set, it will be set 0, developer can use updateEnergyLimit api to update this parameter (must greater than 0). 


Through other two grpc message types CreateSmartContract and TriggerSmartContract to create and use smart contract


### 5.2.2 The usage of the function of smart contract

1. constant function and inconstant function

There are two types of function according to whether any change will be made to the properties on the chain: constant function and inconstant function
Constant function uses view/pure/constant to decorate, will return the result on the node it is called and not be broadcasted in the form of a transaction
Inconstant function will be broadcasted in the form of a transaction while be called, the function will change the data on the chain, such as transfer, changing the value of the internal variables of contracts, etc.

Note: If you use create command inside a contract (CREATE instruction), even use view/pure/constant to decorate the dynamically created contract function, this function will still be treated as inconstant function, be dealt in the form of transaction

2. message calls

Message calls can call the functions of other contracts, also can transfer TRX to the accounts of contract and none-contract. Like the common TRON triggercontract, Message calls have initiator, recipient, data, transfer amount, fees and return attributes. Every message call can generate a new one recursively. Contract can define the distribution of the remaining energy in the internal message call. If it comes with OutOfEnergyException in the internal message call, it will return false, but not error. In the meanwhile, only the gas sent with the internal message call will be consumed, if energy is not specified in call.value(energy), all the remaining energy will be used.


3. delegate call/call code/libary

There is a special type of message call, delegate call. The difference with common message call is the code of the target address will be run in the context of the contract that initiates the call, msg.sender and msg.value remain unchanged. This means a contract can dynamically loadcode from another address while running. Storage, current address and balance all point to the contract that initiates the call, only the code is get from the address being called. This gives Solidity the ability to achieve the 'lib' function: the reusable code lib can be put in the storage of a contract to implement complex data structure library.

4. CREATE instruction

This command will create a new contract with a new address. The only difference with Ethrum is the newly generated TRON address used the smart contract creation transaction id and the hash of nonce called combined. Different from Ethrum, the defination of nonce is the comtract sequence number of the creation of the root call. Even there are many CREATE commands calls, contract number in sequence from 1. Refer to the source code for more detail. 
Note: Different from creating a contract by grpc's deploycontract, contract created by CREATE command does not store contract abi.

5. built-in function and built-in function attribute (Since Odyssey-v3.1.1, TVM built-in function is not supported temporarily

1）TVM is compatible with solidity language's transfer format, including:
accompany with constructor to call transfer
accompany with internal function to call transfer
use transfer/send/call/callcode/delegatecall to call transfer

Note: 波场的智能合约与波场系统合约的逻辑不同，如果转账的目标地址账户不存在，不能通过智能合约转账的形式创建目标地址账户。这也是与以太坊的不同点。

2）不同账户为超级节点投票 (Odyssey-v3.1.1及之后的版本暂时不支持)

3）超级节点获取所有奖励 (Odyssey-v3.1.1及之后的版本暂时不支持)

4）超级节点通过或否定提案 (Odyssey-v3.1.1及之后的版本暂时不支持)

5）超级节点提出提案 (Odyssey-v3.1.1及之后的版本暂时不支持)

6）超级节点删除提案 (Odyssey-v3.1.1及之后的版本暂时不支持)

7）波场byte地址转换为solidity地址 (Odyssey-v3.1.1及之后的版本暂时不支持)

8）波场string地址转换为solidity地址 (Odyssey-v3.1.1及之后的版本暂时不支持)

9）向目标账户地址发送token转账 (Odyssey-v3.1.1及之后的版本暂时不支持)

10）查询目标账户地址的指定token的数量 (Odyssey-v3.1.1及之后的版本暂时不支持)

11）兼容所有以太坊内置函数

>注意：
波场2）- 10）为波场自己的内置函数 具体中文文档请参看：https://github.com/tronprotocol/Documentation/blob/master/中文文档/虚拟机/虚拟机内置函数.md

>以太坊 RIPEMD160 函数不推荐使用，波场返回的是一个自己的基于sha256的hash结果，并不是准确的以太坊RIPEMD160。以后会考虑删除这个函数。
 
### 5.2.3 合约地址在solidity语言的使用

以太坊虚拟机地址为是20字节，而波场虚拟机解析地址为21字节。
1. 地址转换
在solidity中使用的时候需要对波场地址做如下处理 （推荐）：
```    
    /**
     *  @dev    convert uint256 (HexString add 0x at beginning) tron address to solidity address type
     *  @param  tronAddress uint256 tronAddress, begin with 0x, followed by HexString
     *  @return Solidity address type
     */
     
    function convertFromTronInt(uint256 tronAddress) public view returns(address){
        return address(tronAddress);
    }
```

这个和在以太坊中其他类型转换成address类型语法相同。
2. 地址判断
solidity中有地址常量判断，如果写的是21字节地址编译器会报错，只用写20字节地址即可，如：
```
    function compareAddress(address tronAddress) public view returns (uint256){
        // if (tronAddress == 0x41ca35b7d915458ef540ade6068dfe2f44e8fa733c) { // compile error
        if (tronAddress == 0xca35b7d915458ef540ade6068dfe2f44e8fa733c) { // right
            return 1;
        } else {
            return 0;
        }
    }
```
tronAddress从wallet-cli传入是0000000000000000000041ca35b7d915458ef540ade6068dfe2f44e8fa733c这个21字节地址，即正常的波场地址时，是会返回1的，判断正确。
3. 地址赋值
solidity中有地址常量的赋值，如果写的是21字节地址编译器会报错，只用写20字节地址即可，solidity中后续操作直接利用这个20位地址，波场虚拟机内部做了补位操作。如：
```
    function assignAddress() public view {
        // address newAddress = 0x41ca35b7d915458ef540ade6068dfe2f44e8fa733c; // compile error
        address newAddress = 0xca35b7d915458ef540ade6068dfe2f44e8fa733c;
        // do something
    }
```
如果想直接使用string 类型的波场地址（如TLLM21wteSPs4hKjbxgmH1L6poyMjeTbHm）请参考内置函数的两种地址转换方式 （见II-4-7,II-4-8）。

### 5.2.4 与以太坊有区别的特殊常量

1 货币

类似于solidity对ether的支持，波场虚拟机的代码支持的货币单位有trx和sun，其中1trx = 1000000sun，大小写敏感，只支持小写。目前tron-studio支持trx和sun，在remix中，不支持trx和sun，如果使用ether、finney等单位时，注意换算(可能会发生溢出错误)。
我们推荐使用tron-studio代替remix进行tron智能合约的编写。

2 区块相关

•	block.blockhash(uint blockNumber) returns (bytes32)：指定区块的区块哈希——仅可用于最新的 256 个区块且不包括当前区块；而 blocks 从 0.4.22 版本开始已经不推荐使用，由 blockhash(uint blockNumber) 代替
	
•	block.coinbase (address): 产当前区块的超级节点地址
	
•	block.difficulty (uint): 当前区块难度，波场不推荐使用，设置恒为0
	
•	block.gaslimit (uint): 当前区块 gas 限额，波场暂时不支持使用, 暂时设置为0
	
•	block.number (uint): 当前区块号
	
•	block.timestamp (uint): 当前区块以秒计的时间戳
	
•	gasleft() returns (uint256)：剩余的 gas
	
•	msg.data (bytes): 完整的 calldata
	
•	msg.gas (uint): 剩余 gas - 自 0.4.21 版本开始已经不推荐使用，由 gesleft() 代替
	
•	msg.sender (address): 消息发送者（当前调用）
	
•	msg.sig (bytes4): calldata 的前 4 字节（也就是函数标识符）
	
•	msg.value (uint): 随消息发送的 sun 的数量
	
•	now (uint): 目前区块时间戳（block.timestamp）
	
•	tx.gasprice (uint): 交易的 gas 价格，波场不推荐使用，设置值恒为0
	
•	tx.origin (address): 交易发起者




## 5.3 Energy介绍
智能合约运行时执行每一条指令都需要消耗一定的系统资源，资源的多少用Energy的值来衡量。

### 5.3.1 Energy的获取

冻结获取Energy，即将持有的trx锁定，无法进行交易，作为抵押，并以此获得免费使用Energy的权利。具体计算与全网所有账户冻结有关，可参考相关部分计算。

##### FreezeBalance 冻结获得能量

```
freezeBalance frozen_balance frozen_duration [ResourceCode:0 BANDWIDTH,1 ENERGY]
```

通过冻结TRX获取的Energy， 额度 = 为获取Energy冻结的TRX / 整个网络为获取Energy冻结的TRX 总额 * 50_000_000_000。
也就是所有用户按冻结TRX平分固定额度的Energy。

示例：

```
如全网只有两个人A，B分别冻结2TRX，2TRX。

二人冻结获得的可用Energy分别是

A: 25_000_000_000 且energy_limit 为25_000_000_000

B: 25_000_000_000 且energy_limit 为25_000_000_000

当第三人C冻结1TRX时。

三人冻结获得的可用Energy调整为

A: 20_000_000_000 且energy_limit调整为20_000_000_000

B: 20_000_000_000 且energy_limit调整为20_000_000_000

B: 10_000_000_000 且energy_limit 为10_000_000_000

```

##### FreezeBalance 恢复能量

所消耗的能量会在24小时内平滑减少至0。

示例：

```
在某一时刻A的Energy已使用量为72_000_000 Energy

在没有其他消耗或冻结的操作下：

一小时后A的Energy已使用量为 72_000_000 - (72_000_000 * (60*60/60*60*24)) Energy = 69_000_000 Energy

24小时后A的Energy已使用量为 0 Energy。
```

### 5.3.2 如何填写feeLimit(用户必读)
***
*在本节范围内，将合约的开发部署人员，简称为“开发者”；将调用合约的用户或者其他合约，简称为“调用者”。*

*调用合约消耗的Energy能以一定比例折合成trx（或者sun），所以在本节范围内，指代合约消耗的资源时，并不严格区分Energy和 trx；仅在作为 数值的单位时，才区分Energy、trx和sun。*

***

合理设置feeLimit，一方面能尽量保证正常执行；另外一方面，如果合约所需Energy过大，又不会过多消耗调用者的trx。在设置feeLimit之前，需要了解几个概念：

1). 合法的feeLimit为0 - 10^9 之间的整数值，单位是sun，折合0 - 1000 trx；

2). 不同复杂度的合约，每次正常执行消耗不同的Energy；相同合约每次消耗的Energy基本相同[1]；执行合约时，逐条指令计算并扣除Energy，如果超过feeLimit的限制，则合约执行失败，已扣除的Energy不退还；

3). 目前feeLimit仅指调用者愿意承担的Energy折合的trx[2]；执行合约允许的最大Energy还包括开发者承担的部分；

4). 一个恶意合约，如果最终执行超时，或者因bug合约崩溃，则会扣除该合约允许的所有energy；

5). 开发者可能会承担一定比例的Energy消耗（比如承担90%）。但是，当开发者账户的Energy不足以支付时，剩余部分完全由调用者承担。在feeLimit限制范围内，如调用者的Energy不足，则会燃烧等价值的trx。[2]

开发者通常会有充足的Energy，以鼓励低成本调用；调用者在估算feeLimit时，可以假设开发者能够承担其承诺比例的Energy，如果一次调用因为feeLimit不足而失败，可以再适当扩大。

##### 示例5.3.2.1
下面将以一个合约C的执行，来具体举例，如何估算feeLimit：

 * 假设合约C上一次成功执行时，消耗了18000 Energy，那么预估本次执行消耗的Energy上限为20000 Energy；[3]
 * 冻结trx时，当前全网用于CPU冻结的TRX总量和Energy总量的比值，假设是冻结1 trx，可以获得400 Energy；
 * 燃烧trx时，1 trx固定可以兑换10000 Energy；[4]
 * 假设开发者承诺承担90%的Energy，而且开发者账户有充足的Energy；
 
则，feeLimit的预估方法为： 

1). A = 20000 energy * (1 trx / 400 energy) = 50 trx = 50_000_000 sun, 

2). B = 20000 energy * (1 trx / 10000 energy) = 2 trx = 2_000_000 sun，

3).  取A和B的最大值，为50_000_000 sun，

4).  开发者承诺承担90%，用户需要承担10%，

那么，建议用户填写的feeLimit为 50_000_000 sun * 10% = 5_000_000 sun。


小节附录：

[1] 根据tron各节点的情况，每次执行消耗的Energy可能会有小幅度的浮动。

[2] tron可能会视后续公链的情况，调整这一策略。

[3] 预估的下一次执行所需Energy上限，应该略大于上一次实际消耗的Energy。

[4] 1 trx = 10^4 energy 为目前的燃烧trx的比例，后续Tron可能会根据全网拥塞情况调整，调整后，将通知到全网的节点。


### 5.3.3 Energy的计算(开发者必读)

在讨论本章节前，需要了解：

1). tron为了惩罚恶意开发者，对于异常合约，如果执行超时（超过50ms），或因bug异常退出（不包含revert），会扣除本次的最大可用Energy。若合约正常执行，或revert，则仅扣除执行相关指令所需的Energy；

2). 开发者可以设置执行合约时，消耗Energy中自己承担的比例，该比例后续可修改。一次合约调用消耗的Energy，若开发者的Energy不足以支付其承担的部分，剩余部分全由调用者支付；

3). 目前执行一个合约，可用的Energy总数由 调用者调用时设置的feeLimit 和 开发者承担部分共同决定；

	注意：
	1.若开发者不确定合约是否正常，请勿将用户承担比例设置为0%，否则在被判为恶意执行时，会扣除开发者的所有Energy。[1]
	2.因此建议开发者设置的用户承担的比例为10%~100%。[2]

下面具体举例，详细描述合约可用Energy的计算方法。

##### 示例5.3.3.1
如果一个账户A的balance是 100 TRX(100000000 SUN)，冻结 10 TRX 获得了100000 Energy，未冻结的balance是 90 TRX。有一个合约C设置的消耗调用者资源的比例是100%，也就是完全由调用者支付所需资源。
此时A调用了合约C，填写的feeLimit是 30000000(单位是SUN, 30 TRX)。那么A此次调用能够使用的Energy是由两部分计算出来的：

* A冻结剩余的Energy
这部分的价格是根据账户A当前冻结的TRX和当前冻结所获得的Energy总量按比例计算出来的，也就是：1 Energy = (10 / 100000) TRX，还剩100000 Energy，价值10 TRX，小于feeLimit，则能获得所有的100000 Energy，价值的10 TRX算进feeLimit中。
* 按照固定比例换算出来的Energy
如果feeLimit大于冻结剩余Energy价值的TRX，那么需要使用balance中的TRX来换算。固定比例是： 1 Energy = 100 SUN, feeLimit还有(30 - 10) TRX = 20 TRX，获得的Energy是 20 TRX / 100 SUN = 200000 Energy

所以，A此次调用能够使用的Energy是 (100000 + 200000) = 300000 Energy
如果合约执行成功，没有发生任何异常，则会扣除合约运行实际消耗的Energy，一般都远远小于此次调用能够使用的Energy。如果发生了Assert-style异常，则会消耗feeLimit对应的所有的Energy。Assert-style异常的介绍详见[异常介绍](https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E8%99%9A%E6%8B%9F%E6%9C%BA/%E5%BC%82%E5%B8%B8%E5%A4%84%E7%90%86.md)
##### 示例5.3.3.2
如果一个账户A的balance是 100 TRX(100000000 SUN)，冻结 10 TRX 获得了100000 Energy，未冻结的balance是 90 TRX。有一个合约C设置的消耗调用者资源的比例是40%，也就是由合约开发者支付所需资源的60%，开发者是D，冻结 50 TRX 获得了500000 Energy。
此时A调用了合约C，填写的feeLimit是 200000000(单位是SUN, 200 TRX)。
那么A此次调用能够使用的Energy是于以下三部分相关：

* 调用者A冻结剩余的Energy（X Energy）
这部分的价格是根据账户A当前冻结的TRX和当前冻结所获得的Energy总量按比例计算出来的，也就是：1 Energy = (10 / 100000) TRX，还剩100000 Energy，价值10 TRX，小于剩下的feeLimit，则能获得所有的100000 Energy，价值的10 TRX算进feeLimit中。
* 从调用者A的balance中，按照固定比例换算出来的Energy （Y Energy）
如果feeLimit大于1和2的和，那么需要使用A的balance中的TRX来换算。固定比例是： 1 Energy = 100 SUN, feeLimit还有(200 - 10)TRX = 190 TRX，但是A的balance只有90 TRX，按照min(190 TRX, 90 TRX) = 90 TRX来计算获得的Energy，即为 90 TRX / 100 SUN = 900000 Energy
* 开发者D冻结剩余的Energy (Z Energy)
开发者D冻结剩余500000 Energy。
会出现以下两种情况：
当(X + Y) / 40% >= Z / 60%，A此次调用能够使用的Energy是 X + Y + Z Energy。
当(X + Y) / 40% < Z / 60%，A此次调用能够使用的Energy是 (X + Y) / 40% Energy。

若A此次调用能够使用的Energy是 Q Energy
同上，如果合约执行成功，没有发生任何异常，消耗总Energy小于Q Energy，如消耗 500000 Energy ，会按照比例扣除合约运行实际消耗的Energy，调用者A消耗500000 * 40=200000 Energy，开发者D消耗500000 * 60% = 300000 Energy。 
一般实际消耗Energy都远远小于此次调用能够使用的Energy。如果发生了Assert-style异常，则会消耗feeLimit对应的所有的Energy。Assert-style异常的介绍详见[异常介绍](https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E8%99%9A%E6%8B%9F%E6%9C%BA/%E5%BC%82%E5%B8%B8%E5%A4%84%E7%90%86.md)
##### 注意事项
1. 开发者创建合约的时候，consume_user_resource_percent不要设置成0，也就是开发者自己承担所有资源消耗。
开发者自己承担所有资源消耗，意味着当发生了Assert-style异常时，会消耗开发者冻结的所有Energy(Assert-style异常的介绍详见[异常介绍](https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E8%99%9A%E6%8B%9F%E6%9C%BA/%E5%BC%82%E5%B8%B8%E5%A4%84%E7%90%86.md) )。为避免造成不必要的损失consume_user_resource_percent建议值是10-100。

## 5.4 智能合约开发工具介绍
### 5.4.1 TronStudio
波场智能合约开发工具。提供可视化界面，支持开发者对solidity语言智能合约进行编译，调试，运行等功能。
https://developers.tron.network/docs/tron-studio-intro
### 5.4.2 TronBox
波场智能合约部署工具。支持solidity语言智能合约的编译，部署，移植等功能。
https://developers.tron.network/docs/tron-box-user-guide
### 5.4.3 TronWeb
波场智能合约开发使用的http api库。提供和主链交互，合约部署调用等接口。
https://developers.tron.network/docs/tron-web-intro
### 5.4.4 TronGrid
波场智能合约事件查询服务。可以查询智能合约中写入的事件log信息。
https://developers.tron.network/docs/tron-grid-intro

## 5.5 使用命令行工具进行智能合约开发

在tron上进行智能合约的开发，除了使用现有的工具之(tron-studio)外，也可以直接使用wallet-cli命令行工具进行智能合约的开发，编译和部署。编写智能合约，可以使用使用TronStudio进行编译、调试等前期的开发工作。 当合约开发完成之后，可以把合约复制到[SimpleWebCompiler](https://github.com/tronprotocol/tron-demo/tree/master/SmartContractTools/SimpleWebCompiler)中进行编译，获取ABI和ByteCode。 我们提供一个简单的数据存取的合约代码示例，以这个示例来说明编译、部署、调用的步骤。

```
pragma solidity ^0.4.0;
contract DataStore {

    mapping(uint256 => uint256) data;

    function set(uint256 key, uint256 value) public {
        data[key] = value;
    }
    
    function get(uint256 key) view public returns (uint256 value) {
        value = data[key];
    }
}
```

### 启动私有链

确保前提条件中，私有链已经在本地部署完成。可以检查FullNode/logs/tron.log中，是否有持续产块的log信息出现：“Produce block successfully”

### 开发智能合约

把上述代码复制到remix中编译，调试，确保代码的逻辑是自己需要的，编译通过，没有错误

### 在SimpleWebCompiler编译得到ABI和ByteCode

因为波场的编译器与以太坊的编译略有差异，正在与Remix集成中，所以临时采用改方案获取ABI和ByteCode，而不是通过Remix直接获取ABI和ByteCode。
把上述代码复制到SimpleWebCompiler中，点击Compile按钮，获取ABI和ByteCode。

### 通过Wallet-cli部署智能合约

下载Wallet-Cli，文件然后编译。

```
shell
# 下载源代码
git clone https://github.com/tronprotocol/wallet-cli
cd  wallet-cli
# 编译
./gradlew build
cd  build/libs
```

> Note：wallet-cli 默认的配置会连接本地127.0.0.1:50051的 fullnode，如果开发者需要连接不同的其他节点或者端口可在 config.conf 文件中进行修改

启动wallet-cli

```
java -jar wallet-cli.jar
```

启动之后，可在命令中交互式输入指令。导入私钥，并查询余额是否正确

```
importwallet
<输入你自己的设定的钱包密码2次>
<输入私钥：da146374a75310b9666e834ee4ad0866d6f4035967bfc76217c5a495fff9f0d0>
login
<输入你自己的设定的钱包密码>
getbalance
```

部署合约

```
Shell
# 合约部署指令
DeployContract contractName ABI byteCode constructor params isHex fee_limit consume_user_resource_percent <value> <library:address,library:address,...>

# 参数说明
contract_name:自己制定的合约名
ABI:从SimpleWebCompiler中获取到的 ABI json 数据
bytecode:从SimpleWebCompiler中获取到的二进制代码
constructor:部署合约时，会调用构造函数，如果需要调用，就把构造函数的参数类型填写到这里，例如：constructor(uint256,string)，如果没有，就填写一个字符#
params：构造函数的参数，使用逗号分隔开来，例如  1,"test"   ，如果没有构造函数，就填写一个字符#
fee_limit:本次部署合约消耗的TRX的上限，单位是SUN(1 SUN = 10^-6 TRX)，包括CPU资源、STORAGE资源和可用余额的消耗
consume_user_resource_percent:指定的使用该合约用户的资源占比，是[0, 100]之间的整数。如果是0，则表示用户不会消耗资源。如果开发者资源消耗完了，才会完全使用用户的资源。
value:在部署合约时，给该合约转账金额，使用十六进制32位表示
library:address,library:address,...:如果合约包含library，则需要在部署合约的时候指定library的地址，具体见下文；没有library的话则不需要填写。

# 运行例子
deploycontract DataStore [{"constant":false,"inputs":[{"name":"key","type":"uint256"},{"name":"value","type":"uint256"}],"name":"set","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"key","type":"uint256"}],"name":"get","outputs":[{"name":"value","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"}] 608060405234801561001057600080fd5b5060de8061001f6000396000f30060806040526004361060485763ffffffff7c01000000000000000000000000000000000000000000000000000000006000350416631ab06ee58114604d5780639507d39a146067575b600080fd5b348015605857600080fd5b506065600435602435608e565b005b348015607257600080fd5b50607c60043560a0565b60408051918252519081900360200190f35b60009182526020829052604090912055565b600090815260208190526040902054905600a165627a7a72305820fdfe832221d60dd582b4526afa20518b98c2e1cb0054653053a844cf265b25040029 # # false 1000000 30 0
部署成功会显示Deploy the contract successfully
```

得到合约的地址

```
Your smart contract address will be: <合约地址>

# 在本例中
Your smart contract address will be: TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6
```

调用合约存储数据、查询数据

```
Shell
# 调用合约指令
triggercontract <contract_address> <method> <args> <is_hex> <fee_limit> <value>

# 参数说明
contract_address:即之前部署过合约的地址，格式 base58，如：TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6
method:调用的函数签名，如set(uint256,uint256)或者 fool()，参数使用','分割且不能有空格
args:如果非十六进制，则自然输入使用','分割且不能有空格，如果是十六进制，直接填入即可
is_hex：输入参数是否为十六进制，false 或者 true
fee_limit:和deploycontract的时候类似，表示本次部署合约消耗的TRX的上限，单位是SUN(1 SUN = 10^-6 TRX)，包括CPU资源、STORAGE资源和可用余额的消耗。
value:在部署合约时，给该合约转账金额，使用十六进制32位表示

# 调用的例子
## 设置 mapping 1->1
triggercontract TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6 set(uint256,uint256) 1,1 false 1000000  0000000000000000000000000000000000000000000000000000000000000000

## 取出 mapping key = 1的 value
triggercontract TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6 get(uint256) 1 false 1000000  0000000000000000000000000000000000000000000000000000000000000000
```

如果调用的函数是 constant 或 view，wallet-cli 将会直接返回结果

如果包含library，则需要在部署合约之前先部署library，部署完library之后，知道了library地址，将地址填进library:address,library:address,...

```
# 比如使用remix生成的合约，bytecode是
608060405234801561001057600080fd5b5061013f806100206000396000f300608060405260043610610041576000357c0100000000000000000000000000000000000000000000000000000000900463ffffffff168063f75dac5a14610046575b600080fd5b34801561005257600080fd5b5061005b610071565b6040518082815260200191505060405180910390f35b600073<b>__browser/oneLibrary.sol.Math3__________<\b>634f2be91f6040518163ffffffff167c010000000000000000000000000000000000000000000000000000000002815260040160206040518083038186803b1580156100d357600080fd5b505af41580156100e7573d6000803e3d6000fd5b505050506040513d60208110156100fd57600080fd5b81019080805190602001909291905050509050905600a165627a7a7230582052333e136f236d95e9d0b59c4490a39e25dd3a3dcdc16285820ee0a7508eb8690029  
```

之前部署的library地址是：TSEJ29gnBkxQZR3oDdLdeQtQQykpVLSk54
那么部署的时候，需要将 browser/oneLibrary.sol.Math3:TSEJ29gnBkxQZR3oDdLdeQtQQykpVLSk54 作为deploycontract的参数。

# 6 内置合约以及API说明
## 6.1 内置合约说明
请参考:

https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E4%BA%A4%E6%98%93%E6%93%8D%E4%BD%9C%E7%B1%BB%E5%9E%8B%E8%AF%B4%E6%98%8E.md

## 6.2 gRPC 接口说明
请参考:

https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md

## 6.3 http 接口说明
请参考:

https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-http.md

# 7 Tron TRC10 token说明
TRON网络支持2种token，一种是通过智能合约发行的TRC20协议的token，一种是通过Tron公链内置的TRC10 token。   

下面对TRC10 token进行说明。
## 7.1 如何发行TRC10 token
[grpc接口](https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md#7-%E9%80%9A%E8%AF%81%E5%8F%91%E8%A1%8C)

http接口：

wallet/createassetissue
作用：发行Token
demo：curl -X POST  http://127.0.0.1:8090/wallet/createassetissue -d '{
"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0",
"name":"0x6173736574497373756531353330383934333132313538",
"abbr": "0x6162627231353330383934333132313538",
"total_supply" :4321,
"trx_num":1,
"num":1,
"precision":1,
"start_time" : 1530894315158,
"end_time":1533894312158,
"description":"007570646174654e616d6531353330363038383733343633",
"url":"007570646174654e616d6531353330363038383733343633",
"free_asset_net_limit":10000,
"public_free_asset_net_limit":10000,
"frozen_supply":{"frozen_amount":1, "frozen_days":2}
}'
参数说明：
owner_address发行人地址；name是token名称；abbr是token简称；total_supply是发行总量；trx_num和num是token和trx的兑换价值；precision是精度，也就是小数点个数；start_time和end_time是token发行起止时间；description是token说明，需要是hexString格式；url是token发行方的官网，需要是hexString格式；free_asset_net_limit是Token的总的免费带宽；public_free_asset_net_limit是每个token拥护者能使用本token的免费带宽；frozen_supply是token发行者可以在发行的时候指定冻结的token
返回值：发行Token的Transaction
【注意】
- 当前不支持precision，也就是说，目前的precision默认为0。只有当委员会通过AllowSameTokenName提议后，才允许设置精度。
- 当前不支持token重名。只有当委员会通过AllowSameTokenName提议后，才允许发行相同名字的token。

## 7.2 参与TRC10 token
[grpc接口](https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md#12-%E5%8F%82%E4%B8%8E%E9%80%9A%E8%AF%81%E5%8F%91%E8%A1%8C)

http接口：

wallet/participateassetissue
作用：参与token发行
demo：curl -X POST http://127.0.0.1:8090/wallet/participateassetissue -d '{
"to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0",
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1", 
"amount":100, 
"asset_name":"3230313271756265696a696e67"
}'
参数说明：
to_address是Token发行人的地址，需要是hexString格式
owner_address是参与token人的地址，需要是hexString格式
amount是参与token的数量
asset_name是token的名称，需要是hexString格式
返回值：参与token发行的transaction

【注意】
- 当前的asset_name为token名称。当委员会通过AllowSameTokenName提议后asset_name改为token ID的String类型。

## 7.3 TRC10 token转账
[grpc接口](https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md#11)

http接口：

wallet/transferasset
作用：转账Token
demo：curl -X POST  http://127.0.0.1:8090/wallet/transferasset -d '{
  "owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", 
  "to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", 
  "asset_name": "0x6173736574497373756531353330383934333132313538", 
  "amount": 100
}'
参数说明：
  owner_address是token转出地址，需要是hexString格式；
  to_address是token转入地址，需要是hexString格式；
  asset_name是token名称，需要是hexString格式；
  amount是token转账数量
返回值：token转账的Transaction
【注意】
- 当前的asset_name为token名称。当委员会通过AllowSameTokenName提议后asset_name改为token ID的String类型。

# 8 Tron资源（Resource）模型
## 8.1 资源模型介绍

TRON网络中的资源有4种：带宽，CPU，存储和内存。得益于波场独有的内存模型，TRON网络中的内存资源几乎是无限的。   
TRON网络引入了Bandwidth point 和 Energy 两种资源概念。其中Bandwidth Point表示带宽资源，Energy表示CPU和存储资源。   
**注意** 
- 普通交易仅消耗Bandwidth points
- 智能合约的操作不仅要消耗Bandwidth points，还会消耗Energy

## 8.2 Bandwidth Points


交易以字节数组的形式在网络中传输及存储，一条交易消耗的Bandwidth Points = 交易字节数 * Bandwidth Points费率。当前Bandwidth Points费率 = 1。

如一条交易的字节数组长度为200，那么该交易需要消耗200 Bandwidth Points。

**注意** 由于网络中总冻结资金以及账户的冻结资金随时可能发生变化，因此账户拥有的Bandwidth Points不是固定值。

### 8.2.1 Bandwidth PointsBandwidth Points的来源

Bandwidth Points的获取分两种：

- 一种是通过冻结TRX获取的Bandwidth Points， 额度 = 为获取Bandwidth Points冻结的TRX / 整个网络为获取Bandwidth Points冻结的TRX 总额 * 43_200_000_000。
也就是所有用户按冻结TRX平分固定额度的Bandwidth Points。

- 还有一种是每个账号每天有固定免费额度的带宽，为5000。

### 8.2.2 Bandwith Points的消耗

除了查询操作，任何交易都需要消耗bandwidth points。

还有一种情况，如果是转账，包括普通转账或发行Token转账，如果目标账户不存在，转账操作则会创建账户并转账，只会扣除创建账户消耗的Bandwidth Points，转账不会再消耗额外的Bandwidth Points。

### 8.2.3 Bandwidth Points的计算规则

Bandwidth Points是一个账户1天内能够使用的总字节数。一定时间内，整个网络能够处理的Bandwidth为确定值。

如果交易需要创建新账户，Bandwidth Points消耗如下：

    1、尝试消耗交易发起者冻结获取的Bandwidth Points。如果交易发起者Bandwidth Points不足，则进入下一步。
    
    2、尝试消耗交易发起者的TRX，这部分烧掉0.1TRX。

如果交易是发行Token转账，Bandwidth Points消耗如下：

    1、依次验证 发行Token资产总的免费Bandwidth Points是否足够消耗，转账发起者的Token剩余免费Bandwidth Points是否足够消耗，
    Token发行者冻结TRX获取Bandwidth Points剩余量是否足够消耗。如果满足则扣除Token发行者的Bandwidth Points，任意一个不满足则进入下一步。
    
    2、尝试消耗交易发起者冻结获取的Bandwidth Points。如果交易发起者Bandwidth Points不足，则进入下一步。
    
    3、尝试消耗交易发起者的免费Bandwidth Points。如果免费Bandwidth Points也不足，则进入下一步。
    
    4、尝试消耗交易发起者的TRX，交易的字节数 * 10 sun。

如果交易普通交易，Bandwidth Points消耗如下：

    1、尝试消耗交易发起者冻结获取的Bandwidth Points。如果交易发起者Bandwidth Points不足，则进入下一步。
    
    2、尝试消耗交易发起者的免费Bandwidth Points。如果免费Bandwidth Points也不足，则进入下一步。
    
    3、尝试消耗交易发起者的TRX，交易的字节数 * 10 sun。

### 8.2.4 带宽的自动恢复
在网络总锁定资金以及账户锁定资金不变的情况向，账户的带宽的已使用量随着时间增加而按比例衰减，24h衰减到0。如时间T1时刻，账户带宽已使用量为U，到T1+12h，账户再次使用带宽u,此时账户已使用带宽为 U/2 + u。具体公式如下：

![image](https://github.com/tronprotocol/Documentation/blob/fix_http/TRX_CN/figures/bandwidthRestoreEqn.gif)

即可以理解为每24h，用户已使用的带宽值重置为0。

## 8.3 Energy
[5.3 Energy介绍](#5.3 Energy介绍)

## 8.4 资源委托（resource delegate）
在TRON中，一个账户可以通过冻结TRX来获取带宽和能量。同时，也可以把冻结TRX获取的带宽或者能量委托（delegate）给其他地址。
此时，主账号拥有冻结的TRX以及相应的投票权，受委托账户拥有冻结获取的资源（带宽或者能量）。
和普通冻结一样，委托资源也至少冻结3天。
资源委托的命令如下：
`
  freezeBalance frozen_balance frozen_duration [ResourceCode:0 BANDWIDTH,1 ENERGY] [receiverAddress]
`
其中frozen_balance是冻结的TRX数量（单位为sun），frozen_duration为冻结的天数（目前固定为3天），
ResourceCode表示要获取的资源是带宽还是能量，receiverAddress表示受委托账户的地址
【注意】资源委托功能需要委员会开启


## 8.5 其他交易费

|交易类型|费用|
| :------|:------:|
|创建witness|9999TRX|
|发行token|1024TRX|
|创建account|0.1TRX|
|创建exchange|1024TRX|

# 9 去中心化交易所(DEX)说明

## 9.1 什么是交易对
TRON网络原生支持去中心化交易所(DEX)。去中心化交易所由多个交易对构成。一个交易对（Exchange）是token与token之间，或者token与TRX之间的交易市场（Exchange Market）。
任何账户都可以创建任何token之间的交易对，即使TRON网络中已经存在相同的交易对。交易对的买卖与价格波动遵循Bancor协议。
TRON网络规定，所有交易对中的两个token的权重相等，因此它们数量（balance）的比率即是它们之间的价格。
举一个简单的例子，假设一个交易对包含ABC和DEF两种token，ABC的balance为1000万，DEF的balance为100万，由于权重相等，因此10 ABC = 1 DEF，也就是说，当前ABC对于DEF的价格为10ABC/DEF。

## 9.2 创建交易对 
任何账户都可以创建任何token之间的交易对。创建交易对的手续费是1024TRX，这个手续费会被TRON网络烧掉。   
创建交易对相当于为该交易对注入（inject）原始资本，因此创建者账户中要拥有该交易对的初始balance。当创建成功后，会立即从创建者账户中扣除这两个token的balance。   
创建交易对的合约是ExchangeCreateContract，该合约有4个参数：
- first_token_id，第1种token的id   
- first_token_balance，第1种token的balance   
- second_token_id，第2种token的id   
- second_token_balance，第2种token的balance   

其中token的id由token的name得到，具体概念请参见token发行相关部分的文档。如果交易对中包含TRX，则使用"_"表示TRX的id。需要注意的是，TRX的单位是sun，即10-6 TRX。    
例子：
`    
ExchangeCreate abc 10000000 _ 1000000000000    
`
该交易会创建abc与TRX之间的交易对，初始balance分别为10000000个abc和1000000000000 sun（1000000TRX），
如果创建者没有足够的abc和TRX，则交易对创建失败；否则创建者账户中立即扣除相应的abc和TRX，交易对创建成功，可以开始交易。

【注意】
- 当前的asset_name为token名称。当委员会通过AllowSameTokenName提议后asset_name改为token ID的String类型。  

## 9.3 交易
任何账户都可以在任何交易对中进行交易。交易量和价格完全遵循Bancor协议。也就是说，一个账户在交易时，交易的对象是exchange。交易是即时的，不需要挂单和抢单，只要有足够的token，就可以交易成功。     
交易的合约是ExchangeTransactionContract，该合约有3个参数：     
 - exchange_id，交易对的id，TRON网络会根据交易对创建时间顺序给每个交易对唯一的id
 - token_id，要卖出的token的id
 - quant，要卖出的token的金额
 - expected，期望得到的另一个token的最小金额。如果小于此数值，交易不会成功

例子：       
我们在刚刚创建的abc与TRX的交易对中进行交易，假设此交易对id为1，当前交易对中abc balance为10000000，TRX balance为1000000，如果期望花100个TRX买到至少990个abc，则      
`  
ExchangeTransaction 1 _ 100 990 
`     
其中"_"表示TRX，即向交易对卖出100个TRX。如果成功，该交易会使得交易对中增加100个TRX，并根据Bancor协议计算出减少的abc的数量，交易对创建者的账户中abc和TRX的数量会相应地增加和减少。

【注意】
- 当前的asset_name为token名称。当委员会通过AllowSameTokenName提议后asset_name改为token ID的String类型。

## 9.4 注资
当一个交易对其中1种token的balance很小时，只需要很小的交易量就会造成很大的价格波动，这不利于正常交易。为了避免这种情况，该交易对的创建者可以选择向该交易对注资（inject）。
一个交易对只能由该交易对的创建者来注资。注资不需要手续费。    
注资需要指定一种token以及注资金额，TRON网络会自动根据当前交易对中两种token的比例，计算出另一个token所需的金额，从而保证注资前后，交易对中两个token的比例相同，价格没有变化。    
与创建交易对相同，注资要求创建者拥有足够多的两种token的balance。    
注资的合约是ExchangeInjectContract，该合约有3个参数： 

 - exchange_id，交易对的id
 - token_id，要注资的token的id
 - quant，要注资的token的金额

例子：    
我们对刚刚创建的abc与TRX的交易对进行注资，假设此交易对id为1（TRON网络中第1个交易对），当前交易对中abc balance为10000000，TRX balance为1000000，如果要增加10%的abc，则
`
ExchangeInject 1 abc 1000000
`    
如果成功，该交易会使得交易对中增加1000000个abc，并增加100000个TRX，交易对创建者的账户中abc和TRX的数量会相应地减少。

【注意】
- 当前的asset_name为token名称。当委员会通过AllowSameTokenName提议后asset_name改为token ID的String类型。

## 9.5 撤资
一个交易对中的所有资产都是创建者的。创建者可以随时撤资（withdraw），把交易对中的token赎回到自身账户中。一个交易对只能由该交易对的创建者来撤资。撤资不需要手续费。    
和注资一样，撤资需要指定一种token以及撤资金额，TRON网络会自动根据当前交易对中两种token的比例，计算出另一个token撤资的金额，从而保证撤资前后，交易对中两个token的比例相同，价格没有变化。    
【风险提示】撤资前后价格没有变化，但是价格波动会更大    
撤资的合约是ExchangeWithdrawContract，该合约有3个参数：    
 - exchange_id，交易对的id
 - token_id，要撤资的token的id
 - quant，要撤资的token的金额

例子：    
我们对之前创建的abc与TRX的交易对进行撤资，假设此交易对id为1，当前交易对中abc balance为10000000，TRX balance为1000000，如果要赎回10%的abc，则    
`
ExchangeWithdraw 1 abc 1000000
`    
如果成功，该交易会使得交易对中减少1000000个abc，以及减少100000个TRX，交易对创建者的账户中abc和TRX的数量会相应地增加。

【注意】
- 当前的asset_name为token名称。当委员会通过AllowSameTokenName提议后asset_name改为token ID的String类型。

## 9.6 查询
### 9.6.1 查询交易
有三个查询交易对的接口，包括：查询所有交易对信息（ListExchanges）、分页查询交易对信息（GetPaginatedExchangeList）(Odyssey-v3.1.1暂不支持)，查询指定交易对信息（GetExchangeById）。
相关api详情，请查询[波场RPC-API说明]。

https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md#64-%E6%9F%A5%E8%AF%A2%E6%8C%87%E5%AE%9A%E4%BA%A4%E6%98%93%E5%AF%B9

### 9.6.2 计算当前价格
交易中token的当前价格信息的计算过程：\
假设 first_token 当前的价格为 100 Sun，first_token_balance 为1000_000,second_token_balance 为2000_000，\
second_token 当前的价格为 first_token*first_token_balance/second_token_balance = 50 Sun \
first_token的价格可有"first_token&&TRX"交易对计算获得。

### 9.6.3 计算交易获得token量
交易中花费first_token置换获得的second_token的数量的计算过程：\
假设 sellTokenQuant是要卖出的first_token的金额，buyTokenQuant是要买入的second_token的金额。

supply = 1_000_000_000_000_000_000L；\
supplyQuant = -supply * (1.0 - Math.pow(1.0 + (double) sellTokenQuant/（firstTokenBalance + sellTokenQuant）, 0.0005)); \
buyTokenQuant = （long）balance * (Math.pow(1.0 + (double) supplyQuant / supply, 2000.0) - 1.0)；

注意：由于网络其他账户发生交易，价格可能发生变化。    

相关api详情，请查询[Tron-http](Tron-http.md)。

# 10 多重签名
详细信息请参考
https://github.com/tronprotocol/documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E5%A4%9A%E9%87%8D%E7%AD%BE%E5%90%8D.md

# 11 钱包介绍
## 11.1 wallet-cli功能介绍
请参考:

  https://github.com/tronprotocol/wallet-cli/blob/master/README.md

## 11.2 计算交易ID

对交易的RawData取Hash。
```
Hash.sha256(transaction.getRawData().toByteArray())

```
## 11.3 计算blockID
block id是块高度和块头raw_data的hash的混合，具体是计算出块头中raw_data的hash。用
 块的高度替换该hash中的前8个byte。具体代码如下：
```
private byte[] generateBlockId(long blockNum, byte[] blockHash) { 
  byte[] numBytes = Longs.toByteArray(blockNum); 
  byte[] hash = blockHash; 
  System.arraycopy(numBytes, 0, hash, 0, 8); 
  return hash;
  }
```

## 11.4 如何本地构造交易
根据交易的定义，自己填充交易的各个字段，本地构造交易。需要注意是交易里面需要设置refference block信息和Expiration信息，所以在构造交易的时候需要连接mainnet。建议设置refference block为fullnode上面的最新块，设置Expiration为最新块的时间加N分钟。N的大小根据需要设定，后台的判断条件是(Expiration > 最新块时间 and Expiration < 最新块时时 + 24小时），如果条件成立则交易合法，否则交易为过期交易，不会被mainnet接收。 refference block 的设置方法：设置RefBlockHash为最新块的hash的第8到16(不包含)之间的字节，设置BlockBytes为最新块高度的第6到8（不包含）之间的字节，代码如下：
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
Expiration 和交易时间戳的设置方法：
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
         .setTimestamp(System.currentTimeMillis())//交易时间戳设置毫秒形式
         .setExpiration(newestBlock.getBlockHeader().getRawData().getTimestamp() + 10 * 60 * 60 * 1000);//交易所可以根据实际情况设置超时时间
     Transaction transaction = transactionBuilder.build();
     Transaction refTransaction = setReference(transaction, newestBlock);
     return refTransaction;
   }
```
## 11.5 相关demo

本地构造交易、签名的demo请参考 


https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java

nodejs的demo，具体请参考

https://github.com/tronprotocol/tron-demo/tree/master/demo/nodejs
