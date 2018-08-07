# 搭建自己的Dapp开发环境
Version 0.1

## 介绍
我们目前可以基于波场的私有链搭建智能合约开发环境，不消耗公链上的资源，可以节约开发成本。波场对以太坊虚拟机具有较高的兼容性，大部分基于Solidity的智能合约都可以直接运行在波场上。基于波场的智能合约，可以提供高的TPS，以及针对大多数场景下的免费使用权限，对整个智能合约开发生态具有重要的意义。目前底层虚拟机部分已经基本开发完毕，围绕虚拟机的周边生态正在逐步建立中，包括各种开发工具等。本文介绍一种比较初级的开发方式来部署合约，以及与合约交互。

## 前提条件

### 合约运行的网络

由于在波场网络协议中，部署和调用合约都需要消耗相应的资源(内存，CPU，存储等)，所以建议开发者在搭建自己的私有网络进行智能合约的调试和测试，在确认合约可用之后，再将合约部署在测试网或主网之上。搭建私有网络可参考[Deployment of FullNode(PrivateNet: Just one witness node) on the one host.](https://github.com/tronprotocol/TronDeployment)

该私有链的产块节点的地址：TPL66VK2gCXNCD7EJg9pgJRfqcRazjhUZY

Witness私钥：da146374a75310b9666e834ee4ad0866d6f4035967bfc76217c5a495fff9f0d0

### 钱包客户端

wallet-cli是波场网络的命令行钱包，开发者可以使用wallet-cli在主网上进行合约的部署和发布，以及其他相关的操作。

## 智能合约的开发
编写智能合约，我们暂时推荐使用[Remix](http://remix.ethereum.org/)进行编译、调试等前期的开发工作。
当合约开发完成之后，可以把合约复制到[SimpleWebCompiler](https://github.com/tronprotocol/tron-demo/tree/master/SmartContractTools/SimpleWebCompiler)中进行编译，获取ABI和ByteCode。
我们提供一个简单的数据存取的合约代码示例，以这个示例来说明编译、部署、调用的步骤。
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

### 1、启动私有链
确保前提条件中，私有链已经在本地部署完成。可以检查FullNode/logs/tron.log中，是否有持续产块的log信息出现：“Produce block successfully”

### 2、开发智能合约
把上述代码复制到remix中编译，调试，确保代码的逻辑是自己需要的，编译通过，没有错误

### 3、在SimpleWebCompiler编译得到ABI和ByteCode
因为波场的编译器与以太坊的编译略有差异，正在与Remix集成中，所以临时采用改方案获取ABI和ByteCode，而不是通过Remix直接获取ABI和ByteCode。  
把上述代码复制到SimpleWebCompiler中，点击Compile按钮，获取ABI和ByteCode。

### 4、通过Wallet-cli部署智能合约
下载Wallet-Cli，文件然后编译。
```shell
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
```Shell
importwallet
<输入你自己的设定的钱包密码2次>
<输入私钥：da146374a75310b9666e834ee4ad0866d6f4035967bfc76217c5a495fff9f0d0>
login
<输入你自己的设定的钱包密码>
getbalance
```
部署合约


``` Shell
# 合约部署指令
deploycontract <contract_name> <ABI> <code><max_cpu_usage>  <max_net_usage>  <max_storage_useage> <value>

# 参数说明
ABI:从SimpleWebCompiler中获取到的 ABI json数据
code:二进制代码
max_cpu_usage:cpu资源可用量
max_net_usage:网络资源可用量
max_storage_useage:storage 资源可用量
value:在部署合约时，给该合约转账金额，使用十六进制32位表示

# 运行例子
deploycontract DataStore [{"constant":false,"inputs":[{"name":"key","type":"uint256"},{"name":"value","type":"uint256"}],"name":"set","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"key","type":"uint256"}],"name":"get","outputs":[{"name":"value","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"}] 608060405234801561001057600080fd5b5060de8061001f6000396000f30060806040526004361060485763ffffffff7c01000000000000000000000000000000000000000000000000000000006000350416631ab06ee58114604d5780639507d39a146067575b600080fd5b348015605857600080fd5b506065600435602435608e565b005b348015607257600080fd5b50607c60043560a0565b60408051918252519081900360200190f35b60009182526020829052604090912055565b600090815260208190526040902054905600a165627a7a72305820fdfe832221d60dd582b4526afa20518b98c2e1cb0054653053a844cf265b25040029 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000
```
部署成功会显示Deploy the contract successfully

得到合约的地址
```
Your smart contract address will be: <合约地址>

# 在本例中
Your smart contract address will be: TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6
```

调用合约存储数据、查询数据
```Shell
# 调用合约指令
triggercontract <合约地址> <函数签名> <输入参数> <十六进制> <max_cpu_usage>  <max_net_usage>  <max_storage_useage> <value>

# 参数说明
合约地址:即之前部署过合约的地址，格式 base58，如：TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6
函数签名:调用的函数签名，如set(uint256,uint256)或者 fool()，参数使用','分割且不能有空格
输入参数:如果非十六进制，则自然输入使用','分割且不能有空格，如果是十六进制，直接填入即可
十六进制：输入参数是否为十六进制，false 或者 true
max_net_usage:网络资源可用量
max_storage_useage:storage 资源可用量
value:在部署合约时，给该合约转账金额，使用十六进制32位表示

# 调用的例子
## 设置 mapping 1->1
triggercontract TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6 set(uint256,uint256) 1,1 false 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000

## 取出 mapping key = 1的 value
triggercontract TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6 get(uint256) 1 false 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000
```

如果调用的函数是 constant 或 view，wallet-cli 将会直接返回结果