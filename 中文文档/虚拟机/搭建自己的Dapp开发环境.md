# 搭建自己的Dapp开发环境
Version 0.1

## 介绍
我们目前可以基于波场的私有链搭建智能合约开发环境，不消耗公链上的资源，可以节约开发成本。波场对以太坊虚拟机具有较高的兼容性，大部分基于Solidity的智能合约都可以直接运行在波场上。基于波场的智能合约，可以提供高的TPS，以及针对大多数场景下的免费使用权限，对整个智能合约开发生态具有重要的意义。目前底层虚拟机部分已经基本开发完毕，围绕虚拟机的周边生态正在逐步建立中，包括各种开发工具等。本文介绍一种比较初级的开发方式来部署合约，以及与合约交互。

## 前提条件
搭建波场私有链，参见
[Deployment of FullNode(PrivateNet: Just one witness node) on the one host.](https://github.com/tronprotocol/TronDeployment)
该私有链的产块节点的地址是：TPL66VK2gCXNCD7EJg9pgJRfqcRazjhUZY
私钥是：da146374a75310b9666e834ee4ad0866d6f4035967bfc76217c5a495fff9f0d0

## 部署智能合约
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
下载Wallet-Cli，然后编译
```
git clone https://github.com/tronprotocol/wallet-cli
cd  wallet-cli
./gradlew build
cd  build/libs
```
启动wallet-cli
```
java -jar wallet-cli.jar
```
导入私钥，并查询余额是否正确
```
importwallet
<输入你自己的设定的钱包密码2次>
<输入私钥：da146374a75310b9666e834ee4ad0866d6f4035967bfc76217c5a495fff9f0d0>
login
<输入你自己的设定的钱包密码>
getbalance
```
部署合约
deploycontract ABI BYTECODE
```
deploycontract [{"constant":false,"inputs":[{"name":"key","type":"uint256"},{"name":"value","type":"uint256"}],"name":"set","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"key","type":"uint256"}],"name":"get","outputs":[{"name":"value","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"}] 608060405234801561001057600080fd5b5060de8061001f6000396000f30060806040526004361060485763ffffffff7c01000000000000000000000000000000000000000000000000000000006000350416631ab06ee58114604d5780639507d39a146067575b600080fd5b348015605857600080fd5b506065600435602435608e565b005b348015607257600080fd5b50607c60043560a0565b60408051918252519081900360200190f35b60009182526020829052604090912055565b600090815260208190526040902054905600a165627a7a72305820fdfe832221d60dd582b4526afa20518b98c2e1cb0054653053a844cf265b25040029 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000
```
部署成功会显示Deploy the contract successfully

得到合约的地址
```
Your smart contract address will be: <合约地址>
```

调用合约存储数据、查询数据
```
triggercontract <合约地址> set(uint256,uint256) 1,1 false 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000

triggercontract <合约地址> get(uint256) 1 false 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000
```
