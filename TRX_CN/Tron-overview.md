# TRON公链概览
# 1 TRON总体介绍
## 1.1项目仓库
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
mainnet浏览器https://tronscan.org，testnet浏览器https://test.tronscan.org。请交易所在testnet上进行测试，testnet的配置请参照https://github.com/tronprotocol/Documentation/blob/master/%E4%B8%AD%E6%96%87%E6%96%87%E6%A1%A3/%E6%B3%A2%E5%9C%BA%E5%8D%8F%E8%AE%AE/%E6%B3%A2%E5%9C%BA%E6%B5%8B%E8%AF%95%E7%BD%91.md

# 3 节点运行
## 3.1 建议硬件配置
```
运行FullNode最低配置要求：
CPU：16核
RAM：16G
带宽：100M
DISK：10T
运行FullNode推荐配置要求：
CPU：64核及以上
RAM：64G及以上
带宽：500M及以上
DISK：20T及以上

运行SolidityNode最低配置要求：
CPU：16核
RAM：16G
带宽：100M
DISK：10T
运行SolidityNode推荐配置要求：
CPU：64核及以上
RAM：64G及以上
带宽：500M及以上
DISK：20T及以上

DISK视实际上线后交易量而定，可以预留的大一些

```

## 3.2 启动fullnode和soliditynode
具体请参考：https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Solidity_and_Full_Node_Deployment_CN.md

# 4 Tron API说明
    目前Tron仅支持gRPC接口，不支持http接口。项目grpc-gateway仅作为调试用，强烈不建议在此接口上进行功能开发。
## 4.1 api定义
    api的定义请参考：https://github.com/tronprotocol/protocol/blob/master/api/api.proto
## 4.2 api说明
### 4.2.1 grpc接口说明
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
### 4.2.2 http接口说明

如果需要使用http接口服务，需要部署grpc-gateway，详情请见：[grpc-gateway文档](https://github.com/tronprotocol/grpc-gateway/blob/master/README.md)

```shell
wallet/getaccount
作用：返回一个账号的信息
demo: curl -X POST  http://127.0.0.1:18890/wallet/getaccount -d '{"address": "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}'
参数说明：to_address, owner_address 需要转为base64


wallet/createtransaction
demo: curl -X POST  http://127.0.0.1:18890/wallet/createtransaction -d '{"to_address": "QYgZmb8EtAG27PTQy5E3TXNTYCcy" ,"owner_address":"QfoWCvbA5qqphqTcvTU0D1+xZMHu", "amount": 1000 }'
作用： 创建一个转账的Transaction，如果转账的to地址不存在，则在区块链上创建该账号
说明：to_address, owner_address 需要转为base64

wallet/broadcasttransaction
demo：
curl -X POST http://127.0.0.1:18890/wallet/broadcasttransaction -d '{
    "raw_data": {
        "ref_block_bytes": "dyA=",
        "ref_block_hash": "X70qJj+97nQ=",
        "expiration": "1529305956000",
        "contract": [
            {
                "type": "TransferContract",
                "parameter": {
                    "@type": "type.googleapis.com/protocol.TransferContract",
                    "owner_address": "QVHyqChqzKYaik1etWXHerLDoP69",
                    "to_address": "Qc0ipGHFhxlCL42QGmC+ems/HYip",
                    "amount": "987000000"
                }
            }
        ]
    },
    "signature": [
     "V+C1KAq2arK7hf7VG9+4CBq96BRYRm3r5ep7TL0P8d1PE4lRfAUvAbfRRCiGmiriKUaOivcno2XN0/udPVj47AE="
    ]
}'
作用： 广播交易，广播之前需要做签名
说明：将已经签名完成的交易作为传入参数

wallet/updateaccount
demo： curl -X POST  http://127.0.0.1:18890/wallet/createtransaction -d '{"account_name": "newbmV3X25hbWU=" ,"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy"}'
作用： 更新账号名称，一个账号只能更新一次账号名称
说明：owner_address，account_name为base64格式.  `ewbmV3X25hbWU=` 为 `new_name` 的 base64格式

wallet/votewitnessaccount
demo：curl -X POST http://127.0.0.1:18890/wallet/votewitnessaccount -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "votes": [{"vote_address": "QfSI1WI/szR9S3ZL5f7Mewb18Rd7", "vote_count": 11}]}'
作用：普通用户对witness进行投票
参数说明：
owner_address, 投票人的地址，格式base64;votes, 投票列表，为一个数组,vote_address, witness地址，格式base64

wallet/createassetissue
demo：发行一个名为MyToken的资产
curl -X POST http://127.0.0.1:18890/wallet/createassetissue -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "votes": [{"vote_address": "QfSI1WI/szR9S3ZL5f7Mewb18Rd7", "vote_count": 11}]}'
作用： 发行Token，用户可以再Tron公链上发行Token，Token可以被相互转账，可以用Trx参与。用户在发行Token的时候，可以选择冻结部分Token。
参数说明：
owner_address，创建人地址，格式base64;name，资产名称，格式base64


wallet/updatewitness
作用： 修改wieness的url
demo：
curl -X POST http://127.0.0.1:18890/wallet/updatewitness -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "update_url": "d3d3Lm5ld3VybC5jb20="}'
参数说明：
owner_address,创建人地址，格式base64;update_url,更新的url，格式base64


wallet/createaccount
作用： 创建账号，目前之后已经存在的账号，可以调用该api创建一个新账号，需要指定新账号的Address
demo：
curl -X POST http://127.0.0.1:18890/wallet/createaccount -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "account_address": ""}'
参数说明：owner_address,创建人的账号地址，base64；account_address,新账号地址，base64


/wallet/createwitness
作用： 普通用户申请成为超级代表，需要花费9999个trx
demo：
curl -X POST http://127.0.0.1:18890/wallet/createwitness -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "url": "d3d3Lm5ld3VybC5jb20="}'
参数说明：owner_address，创建这的账号地址，base64；url,创建的url，base64

wallet/transferasset
作用： Token转账
demo：
curl -X POST http://127.0.0.1:18890/wallet/transferasset -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "to_address": "d3d3Lm5ld3VybC5jb20=", "asset_name": "TXlBc3NldA==", "amount": 1000}'
参数说明：asset_name，资产名称，格式base64；owner_address，发送者账户地址，格式base64；to_address，接收账户地址，格式base64；amount，交易量，格式数字

wallet/participateassetissue
作用： 参与Token发行，用户可以花费一定的Trx参与别人发行的Token
demo:
curl -X POST http://127.0.0.1:18890/wallet/participateassetissue -d '{"to_address": "QYgZmb8EtAG27PTQy5E3TXNTYCcy" ,"owner_address":"QfoWCvbA5qqphqTcvTU0D1+xZMHu", "amount":1000, "asset_name":"TXlBc3NldA=="}'
参数说明: owner_address，创建者的账号地址，格式base64；to_address，目标地址，格式base64；asset_name，资产名称，格式base64；amount，交易量，格式数字

冻结trx：/wallet/freezebalance
demo：curl -X POST http://127.0.0.1:18890/wallet/freezebalance -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69", "frozen_balance" : 100000, "frozen_duration" : 3}'
参数说明：owner_address需要是base64格式，frozen_balance是drop形式的冻结trx金额，frozen_duration是冻结天数

解冻trx：/wallet/unfreezebalance
demo：curl -X POST http://127.0.0.1:18890/wallet/unfreezebalance -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69"}'
参数说明：owner_address需要是base64格式

解冻Token：/wallet/unfreezeasset
demo：curl -X POST http://127.0.0.1:18890/wallet/unfreezeasset -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69"}'
参数说明：owner_address需要是base64格式

提现奖励：wallet/withdrawbalance
demo：curl -X POST http://127.0.0.1:18890/wallet/withdrawbalance -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69"}'
参数说明：owner_address需要转成base64格式

更新通证：wallet/updateasset
demo：curl -X POST http://127.0.0.1:18890/wallet/updateasset -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69", "description" : "anVzdCB0ZXN0", "url" : "d3d3LnRlc3R1cmwuY29t", "new_limit" : 1000, "new_public_limit" : 1000}'
参数说明：owner_address需要转成base64格式，description是base64编码，原文是just test，url是base64编码，原文是www.baidu.com

查询所有节点：wallet/listnodes
demo：curl -X POST http://127.0.0.1:18890/wallet/listnodes
参数说明：无

查询账户发行的通证：wallet/getassetissuebyaccount
demo：curl -X POST http://127.0.0.1:18890/wallet/getassetissuebyaccount -d {"address" : "QVHyqChqzKYaik1etWXHerLDoP69"}
参数说明：address需要转成base64格式

查询带宽：wallet/getaccountnet
demo：curl -X POST http://127.0.0.1:18890/wallet/getaccountnet -d {"address" : "QVHyqChqzKYaik1etWXHerLDoP69"}
参数说明：address需要转成base64格式

通过名称查询通证：wallet/getassetissuebyname
demo：curl -X POST http://127.0.0.1:18890/wallet/getassetissuebyname -d {"value" : "VFdY"}
参数说明：value是通证名称，原文是TWX

查询最新区块：wallet/getnowblock
demo：curl -X POST http://127.0.0.1:18890/wallet/getnowblock
参数说明：无

通过高度查区块：wallet/getblockbynum
demo：curl -X POST http://127.0.0.1:18890/wallet/getblockbynum -d {"num" : 1}
参数说明：num是要查询的区块高度

通过ID查区块：wallet/getblockbyid
demo：curl -X POST http://127.0.0.1:18890/wallet/getblockbyid -d {"value" : "AAAAAAAHkICjDnMmySRFfN5xCwAezxoLZrZ99JfGDDk="}
参数说明：value是blockId的base64编码，原文是0000000000079080a30e7326c924457cde710b001ecf1a0b66b67df497c60c39

按照高度区间查询块：/wallet/getblockbylimitnext
demo：curl -X POST http://127.0.0.1:18890/wallet/getblockbylimitnext -d '{"startNum" : 10, "endNum" : 10}'
参数说明：startNum是起始块高度，endNum是结束块高度。返回结果中会同时包含startNum块和endNum块

按照高度查询TopN的块：/wallet/getblockbylatestnum
demo：curl -X POST http://127.0.0.1:18890/wallet/getblockbylatestnum -d '{"num" : 10}'
参数说明：num是最近块的个数

按照交易ID查询交易：/wallet/gettransactionbyid
demo：curl -X POST http://127.0.0.1:18890/wallet/gettransactionbyid -d '{"value" : "JTqX9taV7RNDyZbwGsN4BsMthBqoBaqnROvCQtHYOyg="}'
参数说明：value是交易的id，通过hash交易的raw_data得到，value需要是base64格式

查询超级代表列表：/wallet/listwitnesses
demo：curl -X POST http://127.0.0.1:18890/wallet/listwitnesses
参数说明：

查询所有发行Token列表：/wallet/getassetissuelist
demo：curl -X POST http://127.0.0.1:18890/wallet/getassetissuelist
参数说明

分页查询发行Token列表：/wallet/getpaginatedassetissuelist
demo：curl -X POST http://127.0.0.1:18890/wallet/getpaginatedassetissuelist -d '{"offset" : 0, "limit" : 10}'
参数说明：offset为分页起始token的id，limit为最多返回的token数量

查询所有交易数量：/wallet/totaltransaction
demo: curl -X POST http://127.0.0.1:18890/wallet/totaltransaction
参数说明：

查询超级代表下次轮值时间：/wallet/getnextmaintenancetime
demo：curl -X POST http://127.0.0.1:18890/wallet/getnextmaintenancetime
参数说明

签名：/wallet/gettransactionsign
demo：curl -X POST http://127.0.0.1:18890/wallet/gettransactionsign -d '{
"transaction" : {
    "raw_data": {
        "ref_block_bytes": "gfA=",
        "ref_block_hash": "5YSAo+xJYGU=",
        "expiration": "1529325009000",
        "contract": [
            {
                "type": "TransferContract",
                "parameter": {
                    "@type": "type.googleapis.com/protocol.TransferContract",
                    "owner_address": "QVHyqChqzKYaik1etWXHerLDoP69",
                    "to_address": "Qc0ipGHFhxlCL42QGmC+ems/HYip",
                    "amount": "987000000"
                }
            }
        ]
    }
},
"privateKey" : "j5vLuYaQ4w8yolHZWY+CGY1i+p7CYXovSUgzvyYPOPk="
}'
参数说明：transaction是一个具体的交易，privateKey是用户私钥，需要是base64格式。如要确定要调用该api，请一定把节点部署在内
网或者离线环境，做离线签名使用。

查询账号信息：/walletsolidity/getaccount
demo：curl -X POST http://127.0.0.1:18890/walletsolidity/getaccount -d '{"address" : "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}'
参数说明:address是base64格式

查询所有超级代表列表：/walletsolidity/listwitnesses
demo：curl -X POST http://127.0.0.1:18890/walletsolidity/listwitnesses
参数说明:

查询所有Token列表：/walletsolidity/getassetissuelist
demo：curl -X POST http://127.0.0.1:18890/walletsolidity/getassetissuelist
参数说明:

分页查询Token列表：/walletsolidity/getpaginatedassetissuelist
demo：curl -X POST http://127.0.0.1:18890/walletsolidity/getpaginatedassetissuelist -d '{"offset" : 0, "limit" : 10}'
参数说明: offset是分页起始ID，limit是返回token的最大个数

按照高度查询块：/walletsolidity/getnowblock
demo：curl -X POST http://127.0.0.1:18890/walletsolidity/getnowblock
参数说明:

按照高度查询块：/walletsolidity/getblockbynum
demo：curl -X POST http://127.0.0.1:18890/walletextension/gettransactionsfromthis -d '{"num" : 10000}'
参数说明：num是块高度

查询某个账号的出账交易：/walletextension/gettransactionsfromthis
demo：curl -X POST http://127.0.0.1:18890/walletextension/gettransactionsfromthis -d '{"account" : {"address" : "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}, "offset" : 0, "limit" : 5}'
参数说明：address是base64格式，offset是起始index，limit是返回的最大交易数量

查询某个账号的入账交易：/walletextension/gettransactionstothis
demo：curl -X POST http://127.0.0.1:18890/walletextension/gettransactionstothis -d '{"account" : {"address" : "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}, "offset" : 0, "limit" : 5}'
参数说明：address是base64格式，offset是起始index，limit是返回的最大交易数量

按照交易hash查询交易fee，交易所在块：/walletsolidity/gettransactioninfobyid
demo：curl -X POST http://127.0.0.1:18890/walletsolidity/gettransactioninfobyid -d '{"value" : "4ebiUlBCZ5vI1JtBMFXjiH/HSaVeIaUO8PN9l5E1kXU="}'
参数说明：value是交易的id，通过hash交易的raw_data得到，value需要是base64格式

按照交易hash查询交易(通过这个接口确认最终确认交易)：/walletsolidity/gettransactionbyid
demo：curl -X POST http://127.0.0.1:18890/walletsolidity/gettransactionbyid -d '{"value" : "9PeN9FHPDHr1qpILy3U+iMcLAKvwojUek9jYx1EESXA="}'
参数说明：value是交易的id，通过hash交易的raw_data得到，value需要是base64格式

创建地址：/wallet/createadresss
demo：curl -X POST http://127.0.0.1:18890/wallet/createadresss -d '{"value": "QeVS9kh1hcK1i8LJu0SSvB8XEyzQ" }'
参数说明：value是用户的密码，返回时base64格式的地址，需要转换成base58后才能使用

TRX快捷转账：/wallet/easytransfer
demo：curl -X POST http://127.0.0.1:18890/wallet/easytransfer -d '{"passPhrase": "QeVS9kh1hcK1i8LJu0SSvB8XEyzQ","toAddress": "QYkTnLE4evhePSTiEqAIrJdJZ+Vh", "amount":10}'
参数说明：passPhrase是用户密码，toAddress是转账接收地址，amount是转账trx数量

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

## 3 签名
交易构造好以后，便可以对交易进行签名，签名算法是ECDSA，为了安全起见，建议交易所进行离线签名。签名的说明请参考https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Procedures_of_transaction_signature_generation.md

## 4 demo
本地构造交易、签名的demo请参考
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java

# 11 迁移计划
波场TRON官方Token – TRX的ERC20代币将迁移至波场TRON主网代币，时间为北京时间6月21日-25日。
如果投资者的TRX在交易所，无需其他任何操作。
如果投资者的TRX在钱包，需要在2018年6月24日前将TRX充值到交易所。 6月21 - 24日，交易所TRX的提现将被暂停，6月25日交易所将暂停TRX的充值和提现。从6月26日开始，TRX的充值和提现将恢复正常。在此期间，TRX的正常交易将不受影响。
如果投资者的TRX在钱包，没看见迁移公告，或者是在6月25日之后才看到迁移公告，到永久迁移交易所兑换主网代币。
# 12 相关文档
具体请参考：https://github.com/tronprotocol/Documentation#%E6%96%87%E6%A1%A3%E6%8C%87%E5%BC%95



```

```
