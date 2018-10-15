# TRON公链概览
# 1 TRON总体介绍
# 1.1项目仓库
仓库地址：https://github.com/tronprotocol
其中 java-tron是主网代码，protocol是api和数据结构定义。wallet-cli是官方命令行钱包。
## 1.2 浏览器
https://tronscan.org
作者是Rovak，github账号
https://github.com/Rovak
## 1.3 TRON共识算法
Tpos, 一种改进的Dpos算法。
## 1.4 TRON出块速度
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
# 2 TRON网络结构
## 2.1 节点类型
TRON主链网络中有三种类型的节点，分别是witness、fullnode和solidity node。
其中：witness负责生产块；fullnode 提供api，广播交易和块；solidity node 同步不可回退块，并提供查询api。
## 2.2 网络部署方式（只针对交易所）
部署一个fullnode，一个solidity node，solidity node连接本地的fullnode，fullnode连接mainnet
## 2.3 关于mainnet和testnet
mainnet浏览器https://tronscan.org
testnet浏览器https://test.tronscan.org
请交易所在testnet上进行测试。
testnet的配置请参照https://github.com/tronprotocol/TronDeployment/blob/master/test_net_config.conf
mainnet的配置请参考https://github.com/tronprotocol/TronDeployment/blob/master/main_net_config.conf

# 3 节点运行
## 3.1 建议硬件配置
```
运行FullNode最低配置要求：
CPU：16核
RAM：32G
带宽：100M
DISK：1T
运行FullNode推荐配置要求：
CPU：64核及以上
RAM：64G及以上
带宽：500M及以上
DISK：20T及以上

运行SolidityNode最低配置要求：
CPU：16核
RAM：32G
带宽：100M
DISK：1T
运行SolidityNode推荐配置要求：
CPU：64核及以上
RAM：64G及以上
带宽：500M及以上
DISK：20T及以上

DISK视实际上线后交易量而定，可以预留的大一些

```

## 3.2 启动fullnode和soliditynode
具体请参考：https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Solidity_and_Full_Node_Deployment_CN.md
同时我们也提供了一键部署的脚本，可以通过该脚本一键部署fullnode和soliditynode，具体请参考https://github.com/tronprotocol/TronDeployment/blob/master/README_CN.md

# 4 Tron API说明
    目前Tron推荐使用gRPC接口，同时也支持http接口。
## 4.1 api定义
    api的定义请参考：
https://github.com/tronprotocol/protocol/blob/master/api/api.proto
## 4.2 api说明
### 4.2.1 grpc接口说明
以wallet前缀的api是fullnode提供；以walletSolidity为前缀的api是solidity提供；以walletExtension以前缀的api是solidity提供，且这些api比较耗时。
Fullnode提供操作区块链的api和查询数据的api，Solidity只提供查询数据的api。Fullnode和Solidity的区别是fullnode当前的数据因为分叉的原因有可能被回退，而solidity上的数据是固化块的数据，不可能被回退。
具体请参考：
https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E9%92%B1%E5%8C%85RPC-API.md


### 4.2.2 http接口说明

http 接口我们用两种实现方案

a. fullNode和solidityNode内置的http实现，文档请参考
https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-http.md

b. 基于grpc-gateway实现，文档请参考
https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/grpc-gateway-http.md

我们推荐交易所使用方案a，我们在上面做了很多的优化，比方案b使用起来更加方便。

内置http会自动把proto中的bytes字段转换为hexString编码。所以如果输入参数是bytes类型，需要首先转化为hexString编码，再发送请求；如果输出参数是bytes类型，请用hexString解码该参数，再做后续处理。

grpc-gateway会自动把proto中的bytes字段转换为base64编码。所以如果输入参数是bytes类型，需要首先转化为base64编码，再发送请求；如果输出参数是bytes类型，请用base64解码该参数，再做后续处理。

Tron提供了一个编解码的工具，下载地址是：https://github.com/tronprotocol/tron-demo/raw/master/TronConvertTool.zip

## 4.3 api代码生成
    api基于google的gRPC协议，具体请参考 https://grpc.io/docs/
## 4.4 api demo
具体请参考如下class：

https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/GrpcClient.java
# 5 相关费用
在带宽足够的情况下，免除手续费。交易如果扣费，会在交易结果中的fee字段中记录。如果交易不扣费，也就是扣除带宽
，对应fee字段为0。只有交易被写入区块链之后才会有手续费。fee字段请参考Transaction.Result.fee字段，对应的proto文件是： https://github.com/tronprotocol/protocol/blob/master/core/Tron.proto

请参考：https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E8%B4%B9%E7%94%A8%E6%A8%A1%E5%9E%8B.md

# 6 用户地址生成过程
## 6.1 算法描述

+ 首先产生密钥对，取公钥，仅包含x，y坐标的64字节的byte数组。
+ 对公钥做sha3-256的hash运算。取其最后20字节。测试网在前面填充A0。
+ 主网地址在前面补41，得到地址的原始格式。长度为21字节。
+ 做两次sha256计算，取其前4字节得到校验码。
+ 将校验码附加在地址的原始格式后面，做base58编码，得到base58check格式的地址。测试网地址编码后以27开头，长度为35字节。
+ 主网地址编码后以T开头，长度34字节。

`注意：sha3协议我们使用的是KECCAK-256。`

## 6.2 Mainnet地址，以41为前缀
    address = 41||sha3[12,32): 415a523b449890854c8fc460ab602df9f31fe4293f
    sha256_0 = sha256(address): 06672d677b33045c16d53dbfb1abda1902125cb3a7519dc2a6c202e3d38d3322
    sha256_1 = sha256(sha256_0): 9b07d5619882ac91dbe59910499b6948eb3019fafc4f5d05d9ed589bb932a1b4
    checkSum = sha256_1[0, 4): 9b07d561
    addchecksum = address || checkSum: 415a523b449890854c8fc460ab602df9f31fe4293f9b07d561
    base58Address = Base58(addchecksum): TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW

## 6.3 java代码demo
请参考：https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/ECKeyDemo.java
# 7 交易签名过程
请参考：
https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E4%BA%A4%E6%98%93%E7%AD%BE%E5%90%8D%E6%B5%81%E7%A8%8B.md

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
refference block 的设置方法：设置RefBlockHash为最新块的hash的第8到16(不包含)之间的字节，设置BlockBytes为最新块高度的第6到8（不包含）之间的字节，代码如下：
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

## 10.3 签名
交易构造好以后，便可以对交易进行签名，签名算法是ECDSA，为了安全起见，建议交易所进行离线签名。签名的说明请参考https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Procedures_of_transaction_signature_generation.md

## 10.4 demo
本地构造交易、签名的demo请参考
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java

# 11 demo
当前有nodejs的demo，具体请参考https://github.com/tronprotocol/tron-demo/tree/master/demo/nodejs

# 12 迁移计划
波场TRON官方Token – TRX的ERC20代币将迁移至波场TRON主网代币，时间为北京时间6月21日-25日。
如果投资者的TRX在交易所，无需其他任何操作。
如果投资者的TRX在钱包，需要在2018年6月24日前将TRX充值到交易所。 6月21 - 24日，交易所TRX的提现将被暂停，6月25日交易所将暂停TRX的充值和提现。从6月26日开始，TRX的充值和提现将恢复正常。在此期间，TRX的正常交易将不受影响。
如果投资者的TRX在钱包，没看见迁移公告，或者是在6月25日之后才看到迁移公告，到永久迁移交易所兑换主网代币。
# 13 相关文档
具体请参考：https://github.com/tronprotocol/Documentation#%E6%96%87%E6%A1%A3%E6%8C%87%E5%BC%95



```

```
