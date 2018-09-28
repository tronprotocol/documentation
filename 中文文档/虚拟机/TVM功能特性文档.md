# Tron virtual machine 功能特性介绍及基于Tron的solidity语言使用文档

Tron virtual machine 基于以太坊 solidity 语言实现，兼容以太坊虚拟机的特性，但基于tron自身属性也有部分的区别。

## I 智能合约
波场虚拟机运行的智能合约兼容以太坊智能合约特性，以protobuf的形式定义合约内容：

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
    }
    
origin_address: 合约创建者地址

contract_address: 合约地址

abi:合约所有函数的接口信息

bytecode：合约字节码

call_value：随合约调用传入的trx金额

consume_user_resource_percent：程序开发人员与调用程序者的资源扣费百分比

name：合约名称（token名称）

通过另外两个grpc message类型 CreateSmartContract 和 TriggerSmartContract 来创建和使用smart contract


## II 合约函数的使用

1. constant function和非constant function

函数调用从对链上属性是否有更改可分为两种：constant function 和 非constant function。
Constant function 是指用 view/pure/constant 修饰的函数。会在调用的节点上直接返回结果，并不以一笔交易的形式广播出去。
非constant function是指需要依托一笔交易的形式被广播的方法调用。函数会改变链上数据的内容，比如转账，改变合约内部变量的值等等。

>注意，如果在合约内部使用create指令（CREATE instruction），即使用view/pure/constant来修饰这个动态创建的合约合约方法，这个合约方法仍会被当作非constant function，以交易的形式来处理。

2. 消息调用 （message calls）

消息调用可以向其他的合约发起函数调用，也可以向合约的账户或非合约的账户转帐trx。 与普通的波场triggercontract类似， 消息调用也有调用的发起者，接受者，数据，转账金额，扣费，以及返回值等属性。每一个消息调用都可以递归的生成新的消息调用。
合约可以决定在其内部的消息调用中，对于剩余的 energy ，应发送和保留多少。如果在内部消息调用时发生了OutOfEnergyException
异常（或其他任何异常）,会返回false，但不会以异常的形式抛出。此时，只有与该内部消息调用一起发送的gas会被消耗掉，如果不表明消息调用所传入的费用call.value(energy)，则会扣掉所有的剩余energy。 


3. 委托调用/代码调用和库 (delegatecall/callcode/libary)

有一种特殊类型的消息调用，被称为 委托调用(delegatecall) 。它和一般的消息调用的区别在于，目标地址的代码将在发起调用的合约的上下文中执行，并且msg.sender 和msg.value 不变。 这意味着一个合约可以在运行时从另外一个地址动态加载代码。存储、当前地址和余额都指向发起调用的合约，只有代码是从被调用地址获取的。 这使得 Solidity 可以实现”库“能力：可复用的代码库可以放在一个合约的存储上，如用来实现复杂的数据结构的库。

4. CREATE 指令 （CREATE instruction）

另一个与合约调用相关的是调用指令集的时候使用CREATE指令。这个指令将会创建一个新的合约并生成新的地址。与以太坊的创建唯一的不同在于波场新生成的地址使用的是传入的本次智能合约交易id与调用的nonce的哈希组合。和以太坊不同，这个nonce的定义为本次根调用开始创建的合约序号。即如果有多次的 CREATE指令调用，从1开始，顺序编号每次调用的合约。详细请参考代码。还需注意，与deploycontract的grpc调用创建合约不同，CREATE的合约并不会保存合约的abi。

5. 内置功能属性及内置函数 (Odyssey-v3.1.1及之后的版本暂时不支持TVM内置函数)

1）TVM兼容solidity语言的转账形式，包括：
伴随constructor调用转账
伴随合约内函数调用转账
transfer/send/call/callcode/delegatecall函数调用转账

>注意，波场的智能合约与波场系统合约的逻辑不同，如果转账的目标地址账户不存在，不能通过智能合约转账的形式创建目标地址账户。这也是与以太坊的不同点。

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
 
## III 合约地址在solidity语言的使用

以太坊虚拟机地址为是20字节，而波场虚拟机解析地址为21字节。
### 1. 地址转换
在solidity中使用的时候需要对波场地址做如下处理 （推荐）：
    
    /**
     *  @dev    convert uint256 (HexString add 0x at beginning) tron address to solidity address type
     *  @param  tronAddress uint256 tronAddress, begin with 0x, followed by HexString
     *  @return Solidity address type
     */
    function convertFromTronInt(uint256 tronAddress) public view returns(address){
        return address(tronAddress);
    }
这个和在以太坊中其他类型转换成address类型语法相同。
### 2. 地址判等
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
### 3. 地址赋值
solidity中有地址常量的赋值，如果写的是21字节地址编译器会报错，只用写20字节地址即可，solidity中后续操作直接利用这个20位地址，波场虚拟机内部做了补位操作。如：
```
    function assignAddress() public view {
        // address newAddress = 0x41ca35b7d915458ef540ade6068dfe2f44e8fa733c; // compile error
        address newAddress = 0xca35b7d915458ef540ade6068dfe2f44e8fa733c;
        // do something
    }
```
如果想直接使用string 类型的波场地址（如TLLM21wteSPs4hKjbxgmH1L6poyMjeTbHm）请参考内置函数的两种地址转换方式 （见II-4-7,II-4-8）。

## IV 与以太坊有区别的特殊常量

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
	
•	tx.origin (address): 交易发起者（完全的调用链）



