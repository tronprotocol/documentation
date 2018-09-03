# TRON GRPC-Gateway-HTTP

需要部署grpc-gateway，详情请见：[grpc-gateway文档](https://github.com/tronprotocol/grpc-gateway/blob/master/README.md)

grpc-gateway会自动把proto中的bytes字段转换为base64编码。所以如果输入参数是bytes类型，需要首先转化为base64编码，再发送请求；如果输出参数是bytes类型，请用base64解码该参数，再做后续处理。 Tron提供了一个编解码的工具，下载地址是：https://github.com/tronprotocol/tron-demo/raw/master/TronConvertTool.zip

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
参数说明：transaction是一个具体的交易，privateKey是用户私钥，需要是base64格式。
警告：使用本接口请控制风险。保证环境的安全，不要调用他人提供的API，不要在公共网路上调用本接口。

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
警告：使用本接口请控制风险。保证环境的安全，不要调用他人提供的API，不要在公共网路上调用本接口。

TRX快捷转账：/wallet/easytransfer
demo：curl -X POST http://127.0.0.1:18890/wallet/easytransfer -d '{"passPhrase": "QeVS9kh1hcK1i8LJu0SSvB8XEyzQ","toAddress": "QYkTnLE4evhePSTiEqAIrJdJZ+Vh", "amount":10}'
参数说明：passPhrase是用户密码，toAddress是转账接收地址，amount是转账trx数量
警告：使用本接口请控制风险。保证环境的安全，不要调用他人提供的API，不要在公共网路上调用本接口。

生成地址和私钥：/wallet/generateaddress
             /walletsolidity/generateaddress
demo：curl -X POST -k http://127.0.0.1:18890/wallet/generateaddress
参数说明：无需参数
警告：使用本接口请控制风险。保证环境的安全，不要调用他人提供的API，不要在公共网路上调用本接口。

```
