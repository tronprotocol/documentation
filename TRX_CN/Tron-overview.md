# Tron公链概览
# 1 Tron总体介绍
## 1.1项目仓库
仓库地址：https://github.com/tronprotocol
其中 java-tron是主网代码，protocol是api和数据结构定义。wallet-cli是官方命令行钱包。
## 1.2 浏览器
https://tronscan.org
作者是Rovak，github账号
https://github.com/Rovak
## 1.3 Tron共识算法
Tpos, 一种改进的Dpos算法。
## 1.4 Tron出块速度
当前版本是3秒。
## 1.5 交易模型
基于账号模型，目前不支持UTXO模型。TRX的最小单位是Drop，1TRX = 1000000Drop。目前仅支持1对1交易，尚不支持1对n或者n对1转账。
## 1.6 账号模型
一个账号对应一个address，转账使用address。当前版本尚未支持多重签名机制。
在主链上创建账号有三种方式：
```
a.	使用已经存在的账号创建新账号
b.	给一个新address转账，会同时创建账号
c.	给一个新address转Token，会同时创建账号
```
# 2 Tron网络结构
## 2.1 节点类型
Tron主链网络中有三种类型的节点，分别是witness、fullnode和solidity node。
其中：witness负责生产块；fullnode 提供api，广播交易和块；solidity node 同步不可回退块，并提供查询api。
## 2.2 网络部署方式（只针对交易所）
部署一个fullnode，一个solidity node，solidity node连接本地的fullnode，fullnode连接mainnet
## 2.3 关于mainnet和testnet
目前只有mainnet，稍后会部署testnet。

# 3 节点运行
## 3.1 建议硬件配置
## 3.2 启动fullnode
下载最新release的代码后
```
./gradlew build
cd build/libs
java -jar java-tron.jar
```

## 3.3 启动solidity
下载最新release的代码后
 ```
./gradlew build
修改配置文件config.conf, 把trustNode的ip和端口设置为已经启动的fullnode的地址。
cd build/libs
java -jar SolidityNode.jar -c config.conf
```

## 3.4 启动witness
交易所不需要启动witness。(witness就是Super Representatives)
# 4 Tron API说明
    目前Tron仅支持gRPC接口，不支持http接口。项目grpc-gateway仅作为调试用，强烈不建议在此接口上进行功能开发。
## 4.1 api定义
    api的定义请参考：https://github.com/tronprotocol/protocol/blob/master/api/api.proto
## 4.2 api说明
以wallet前缀的api是fullnode提供；以walletSolidity为前缀的api是solidity提供；以walletExtension以前缀的api是solidity提供，且这些api比较耗时。
Fullnode提供操作区块链的api和查询数据的api，Solidity只提供查询数据的api。Fullnode和Solidity的区别是fullnode当前的数据因为分叉的原因有可能被回退，而solidity上的数据是固化块的数据，不可能被回退。
```
wallet/GetAccount
作用：返回一个账号的信息

wallet/CreateTransaction
作用： 创建一个转账的Transaction，如果转账的to地址不存在，则在区块链   上创建该账号

wallet/ BroadcastTransaction
作用： 广播交易，广播之前需要做签名

wallet/ UpdateAccount
作用： 更新账号名称，一个账号只能更新一次账号名称

wallet/ VoteWitnessAccount
作用：普通用户对witness进行投票

wallet/ CreateAssetIssue
作用： 发行Token，用户可以再Tron公链上发行Token，Token可以被相互转账，可以用Trx参与。用户在发行Token的时候，可以选择冻结部分Token。

wallet/ UpdateWitness
作用： 修改wieness的信息

wallet/ CreateAccount
作用： 创建账号，目前之后已经存在的账号，可以调用该api创建一个新账号，需要制定新账号的Address

wallet/ CreateWitness
作用： 普通用户申请成为超级代表，需要花费9999个trx

wallet/ TransferAsset
作用： Token转账

wallet/ ParticipateAssetIssue
作用： 参与Token发行，用户可以花费一定的Trx参与别人发行的Token

wallet/ FreezeBalance
作用： 冻结部分Trx，冻结Trx可以获得bandwidth points和Trow power，用户要发起交易需要消耗bandwidth points，要对witness投票，需要有Trow power

wallet/ UnfreezeBalance
作用： 解冻冻结的trx，trx被冻结后，至少需要3天才可以解冻，解冻trx后会失去部分bandwidth points和Trow power，以及由该Trow power产生的投票

wallet/ UnfreezeAsset
作用： 对Token进行解冻

wallet/ WithdrawBalance
作用： 超级代表以及备选超级代表可以通过该api把产块的奖励以及成为top127排名witness的奖励体现到账号余额。用户每隔24个小时可以提现一次

wallet/ UpdateAsset
作用： 修改发行Token的信息

wallet/ ListNodes
作用： 返回当前所有的节点

wallet/ GetAssetIssueByAccount
作用： 获取某个账号发行的Token

wallet/ GetAccountNet
作用： 获取账号的bandwidth points信息，包含免费的bandwidth points和通过冻结trx获取的bandwidth points。

wallet/ GetAssetIssueByName
作用： 通过Token名字，查询制定的Token

wallet/ GetNowBlock
作用： 返回当前最新块

wallet/ GetBlockByNum
作用： 通过块的高度查询块

wallet/ GetBlockById
作用： 通过块的ID查询块，块的ID是块头Raw data的Hash

wallet/ GetBlockByLimitNext
作用： 返回从下标从startNum（包含）到endNum（包含）之间的块，

wallet/ GetBlockByLatestNum
作用： 获取最新的N个块，N通过参数指定

wallet/ GetTransactionById
作用： 通过交易的ID获取交易，ID是交易Raw data 的hash

wallet/ ListWitnesses
作用： 获取当前所有的witness

wallet/ GetAssetIssueList
作用： 获取当前所有发行的Token

wallet/ TotalTransaction
作用： 获取当前区块链中所有的交易数量

wallet/ GetNextMaintenanceTime
作用： 获取下次维护期的时间，即下次重新根据投票计算witness的时间

WalletSolidity/ GetAccount
作用：

WalletSolidity/ ListWitnesses
作用：

WalletSolidity/ GetAssetIssueList
作用：

WalletSolidity/ GetNowBlock
作用：

WalletSolidity/ GetBlockByNum
作用：

WalletExtension/ GetTransactionsFromThis
作用： 获取某个账号的转出交易记录

WalletExtension/ GetTransactionsToThis
作用： 获取某个账号的转入交易记录
```
## 4.3 api代码生成
    api基于google的gRPC协议，具体请参考 https://grpc.io/docs/
## 4.4 api demo
具体请参考如下两个class：
```
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/WalletClient.java

https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/GrpcClient.java
```
# 5 相关费用
在带宽足够的情况下，免除手续费。交易如果扣费，会在交易结果中的fee字段中记录。如果交易不扣费，也就是扣除带宽
，对应fee字段为0。只有交易被写入区块链之后才会有手续费。fee字段请参考Transaction.Result.fee字段，对应的proto文件是： https://github.com/tronprotocol/protocol/blob/master/core/Tron.proto

请参考：https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%9C%BA%E5%88%B6%E8%AF%B4%E6%98%8E.md
## 5.1 bandwidth points定义
## 5.2 冻结/解冻机制
## 5.3 bandwidth point消耗规则
## 5.4 超级代表及备选超级代表奖励规则
# 6 用户地址生成过程
## 6.1 算法描述
首先产生密钥对，取公钥，仅包含x，y坐标的64字节的byte数组。对公钥做sha3-256的hash运算。取其最后20字节。测试网在前面填充A0，主网地址在前面补41，得到地址的原始格式。长度为21字节。做两次sha256计算，取其前4字节得到校验码。将校验码附加在地址的原始格式后面，做base58编码，得到base58check格式的地址。测试网地址编码后以27开头，长度为35字节。主网地址编码后以T开头，长度34字节。
`注意：sha3协议我们使用的是KECCAK-256。`
## 6.2 示例
Public Key: 040defc55df809cca94abce297d432863bd8c9049fb420b1106cf53bfb4b85e0184802c495337c7a407e2b68ebd2323df2a8198d860df103de6496bd139ed24094
sha3 = SHA3(Public Key[1, 65)):  673f5c16982796e7bff195245a523b449890854c8fc460ab602df9f31fe4293f
TestNet: Address = A0||sha3[12,32):  A0E11973395042BA3C0B52B4CDF4E15EA77818F275
sha256_0 = SHA256(Address):  CD5D4A7E8BE869C00E17F8F7712F41DBE2DDBD4D8EC36A7280CD578863717084
sha256_1 = SHA256(sha256_0):  10AE21E887E8FE30C591A22A5F8BB20EB32B2A739486DC5F3810E00BBDB58C5C
checkSum = sha256_1[0, 4):  10AE21E8
addchecksum = address || checkSum:  A0E11973395042BA3C0B52B4CDF4E15EA77818F27510AE21E8
base58Address = Base58(addchecksum):  27jbj4qgTM1hvReST6hEa8Ep8RDo2AM8TJo


## 6.3 Testnet地址，以A0为前缀

address = a0||sha3[12,32): a05a523b449890854c8fc460ab602df9f31fe4293f
sha256_0 = sha256(address): 5f19ee7795d5df3868e05723cd8f345324ef148e034fa3cc622753057d9a0d12
sha256_1 = sha256(sha256_0): 481c8383f47f2e940b926867ba9dd237e5c03ccfa942ab39f8ab69aebd5f9ce8
checkSum = sha256_1[0, 4): 481c8383
addchecksum = address || checkSum: a05a523b449890854c8fc460ab602df9f31fe4293f481c8383
base58Address = Base58(addchecksum): 27XK5sBhwa773Svn9j2Mud6rajxtauEN4tr

## 6.4 Mainnet地址，以41为前缀
address = 41||sha3[12,32): 415a523b449890854c8fc460ab602df9f31fe4293f
sha256_0 = sha256(address): 06672d677b33045c16d53dbfb1abda1902125cb3a7519dc2a6c202e3d38d3322
sha256_1 = sha256(sha256_0): 9b07d5619882ac91dbe59910499b6948eb3019fafc4f5d05d9ed589bb932a1b4
checkSum = sha256_1[0, 4): 9b07d561
addchecksum = address || checkSum: 415a523b449890854c8fc460ab602df9f31fe4293f9b07d561
base58Address = Base58(addchecksum): TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW

## 6.5 java代码demo
请参考：https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/ECKeyDemo.java
# 7 交易签名过程
请参考：
https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E4%BA%A4%E6%98%93%E7%AD%BE%E5%90%8D%E6%B5%81%E7%A8%8B.md

# 8 交易id计算过程
对交易的RawData取Hash。
```
Hash.sha256(transaction.getRawData().toByteArray())
```

# 9 block id计算过程
block id是块高度和块头raw_data的hash的混合，具体是计算出块头中raw_data的hash。用块的高度替换该hash中的前8个byte。具体代码如下：
```
private byte[] generateBlockId(long blockNum, byte[] blockHash) { 
 byte[] numBytes = Longs.toByteArray(blockNum); 
 byte[] hash = blockHash; 
 System.arraycopy(numBytes, 0, hash, 0, 8); 
 return hash;
 }

```
其中blockHash是块头row_data的hash，计算方式如下：
```
Sha256Hash.of(this.block.getBlockHeader().getRawData().toByteArray())
```
# 10 交易的构造、签名
构造交易有两种方式：
## 1 调用fullnode上的api
根据需要，本地构造相应的Contract，然后对应的api构造交易。具体的合约请参照 https://github.com/tronprotocol/protocol/blob/master/core/Contract.proto
## 2 本地构造
根据交易的定义，自己填充交易的各个字段，本地构造交易。需要注意是交易里面需要设置refference block信息和Expiration信息，所以在构造交易的时候需要连接mainnet。建议设置refference block为fullnode上面的最新块，设置Expiration为最新块的时间加N分钟。N的大小根据需要设定，后台的判断条件是(Expiration > 最新块时间 and Expiration < 最新块时时 + 24小时），如果条件成立则交易合法，否则交易为过期交易，不会被mainnet接收。 
## 3 签名
交易构造好以后，便可以对交易进行签名，签名算法是ECDSA，为了安全起见，建议交易所进行离线签名。

## 4 demo
本地构造交易、签名的demo请参考
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransacitonSignDemo.java

# 12 迁移计划
波场TRON官方Token – TRX的ERC20代币将迁移至波场TRON主网代币，时间为北京时间6月21日-25日。
如果投资者的TRX在交易所，无需其他任何操作。
如果投资者的TRX在钱包，需要在2018年6月24日前将TRX充值到交易所。 6月21 - 24日，交易所TRX的提现将被暂停，6月25日交易所将暂停TRX的充值和提现。从6月26日开始，TRX的充值和提现将恢复正常。在此期间，TRX的正常交易将不受影响。
如果投资者的TRX在钱包，没看见迁移公告，或者是在6月25日之后才看到迁移公告，到永久迁移交易所兑换主网代币。
# 11 相关文档
具体请参考：https://github.com/tronprotocol/Documentation#%E6%96%87%E6%A1%A3%E6%8C%87%E5%BC%95


