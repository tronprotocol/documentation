#  Tron内置http接口说明

# solidityNode接口说明
```
/walletsolidity/getaccount
作用：查询一个账号的信息
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getaccount -d '{"address": "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}'
参数说明：address 需要转为hexString
返回值：Account对象

/walletsolidity/listwitnesses
作用：查询超级代表列表
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/listwitnesses
参数说明：
返回值：所有超级代表列表

/walletsolidity/getassetissuelist
作用：查询所有Token列表
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuelist 
参数说明：
返回值：所有Token列表

/walletsolidity/getpaginatedassetissuelist
作用：分页查询Token列表
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getpaginatedassetissuelist -d '{"offset": 0, "limit":10}'
参数说明：offset是起始Token的index，limit是期望返回的Token数量
返回值：Token列表

/walletsolidity/getnowblock
作用：查询最新block
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getnowblock
参数说明：
返回值：solidityNode上的最新block

/walletsolidity/getblockbynum
作用：按照高度查询block
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getblockbynum -d '{"num" : 100}' 
参数说明：num是块的高度
返回值：指定高度的block

/walletsolidity/gettransactionbyid
作用：根据id查询交易
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactionbyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
参数说明：value是交易id，需要是hexString
返回值：指定ID的Transaction

/walletsolidity/gettransactioninfobyid
作用：根据id查询交易的fee，所在的block
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactioninfobyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
参数说明：value是交易id，需要是hexString
返回值：Transaction的交易fee，所在block的高度，创建时间

/walletextension/gettransactionsfromthis
作用：查询某个账号的出账交易记录
demo: curl -X POST  http://127.0.0.1:8091/walletextension/gettransactionsfromthis -d '{"account" : {"address" : "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}, "offset": 0, "limit": 10}'
参数说明：address是账号地址，需要是hexString格式；offset是起始交易的index；limit是期望返回的交易数量
返回值：Transaction列表

/walletextension/gettransactionstothis
作用：查询某个账号的入账交易记录
demo: curl -X POST  http://127.0.0.1:8091/walletextension/gettransactionstothis -d '{"account" : {"address" : "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}, "offset": 0, "limit": 10}'
参数说明：address是账号地址，需要是hexString格式；offset是起始交易的index；limit是期望返回的交易数量
返回值：Transaction列表

```

# FullNode接口说明

```
wallet/getaccount
作用：返回一个账号的信息
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccount -d '{"address": "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}'
参数说明：address 需要转为hexString
返回值：Account对象

wallet/createtransaction
作用： 创建一个转账的Transaction，如果转账的to地址不存在，则在区块链上创建该账号
demo: curl -X POST  http://127.0.0.1:8090/wallet/createtransaction -d '{"to_address": "41e9d79cc47518930bc322d9bf7cddd260a0260a8d", "owner_address": "41D1E7A6BC354106CB410E65FF8B181C600FF14292", "amount": 1000 }}'
参数说明：to_address是转账转入地址，需要转为hexString；owner_address是转账转出地址，需要转为hexString；amount是转账数量
返回值：转账合约

/wallet/gettransactionsign
作用：对交易签名，该api有泄漏private key的风险，请确保在安全的环境中调用该api
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactionsign -d '{
"transation" : {"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}}
"privateKey" : "your private key"}
}'
参数说明：transaction是通过http api创建的合约，privateKey是用户private key
返回值：签名之后的transaction

wallet/broadcasttransaction
作用：对签名后的transaction进行广播
demo：curl -X POST  http://127.0.0.1:8090/wallet/broadcasttransaction -d '{"signature":["97c825b41c77de2a8bd65b3df55cd4c0df59c307c0187e42321dcc1cc455ddba583dd9502e17cfec5945b34cad0511985a6165999092a6dec84c2bdd97e649fc01"],"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}}'
参数说明：签名之后的Transaction
返回值：广播是否成功

wallet/updateaccount
作用：修改账号名称
demo：curl -X POST  http://127.0.0.1:8090/wallet/updateaccount -d '{"account_name": "0x7570646174654e616d6531353330383933343635353139" ,"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"}'
参数说明：account_name是账号名称，需要是hexString格式；owner_address是要修改名称的账号地址，需要是hexString格式
返回值：修改名称的Transaction

wallet/votewitnessaccount
作用：对超级代表进行投票
demo：curl -X POST  http://127.0.0.1:8090/wallet/votewitnessaccount -d '{
"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", 
"votes": [{"vote_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "vote_count": 5}]
}'
参数说明：owner_address是投票人地址，需要是hexString格式；votes.vote_address是被投票的超级代表的地址，需要是hexString格式；vote_count是投票数量

wallet/createassetissue
作用：发行Token
demo：curl -X POST  http://127.0.0.1:8090/wallet/createassetissue -d '{
"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0",
"name":"0x6173736574497373756531353330383934333132313538",
"abbr": "0x6162627231353330383934333132313538",
"total_supply" :4321,
"trx_num":1,
"num":1,
"start_time" : 1530894315158,
"end_time":1533894312158,
"description":"007570646174654e616d6531353330363038383733343633",
"url":"007570646174654e616d6531353330363038383733343633",
"free_asset_net_limit":10000,
"public_free_asset_net_limit":10000,
"frozen_supply":{"frozen_amount":1, "frozen_days":2}
}'
参数说明：
owner_address发行人地址；name是token名称；abbr是token简称；total_supply是发行总量；trx_num和num是token和trx的兑换价值；start_time和end_time是token发行起止时间；description是token说明，需要是hexString格式；url是token发行方的官网，需要是hexString格式；free_asset_net_limit是Token的总的免费带宽；public_free_asset_net_limit是每个token拥护者能使用本token的免费带宽；frozen_supply是token发行者可以在发行的时候指定冻结的token
返回值：发行Token的Transaction

wallet/createaccount
作用：创建账号，一个已经激活的账号创建一个新账号，需要花费0.1trx
demo：curl -X POST  http://127.0.0.1:8090/wallet/createaccount -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "account_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0"}'
参数说明：owner_address是已经激活的账号，需要是hexString格式；account_address是新账号的地址，需要是hexString格式，这个地址需要事先创建好
返回值：创建账号的Transaction

wallet/createwitness
作用：申请成为超级代表
demo：curl -X POST  http://127.0.0.1:8090/wallet/createwitness -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "url": "007570646174654e616d6531353330363038383733343633"}'
参数说明：owner_address是申请成为超级代表的账号地址，需要是hexString格式；url是官网地址，需要是hexString格式
返回值：申请超级代表的Transaction

wallet/transferasset
作用：转账Token
demo：curl -X POST  http://127.0.0.1:8090/wallet/transferasset -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "asset_name": "0x6173736574497373756531353330383934333132313538", "amount": 100}'
参数说明：owner_address是token转出地址，需要是hexString格式；to_address是token转入地址，需要是hexString格式；asset_name是token名称，需要是hexString格式；amount是token转账数量
返回值：token转账的Transaction

wallet/easytransfer
作用：快捷转账，该api存在泄漏密码的风险，请确保在安全的环境中调用该api。调用该api前请先调用createAddress生成地址。
demo：curl -X POST http://127.0.0.1:8090/wallet/easytransfer -d '{
"passPhrase": "your password",
"toAddress": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", 
"amount":100
}'
参数说明：passPhrase是用户密码，需要是hexString格式；toAddress是转入地址，需要是hexString格式；amount是转账trx数量
返回值：对应的Transaction和广播是否成功的状态

wallet/createaddress
作用：通过密码创建地址，该api存在泄漏密码的风险，请确保在安全的环境中调用该api。
demo：curl -X POST http://127.0.0.1:8090/wallet/createaddress -d '{"value": "3230313271756265696a696e67"}'
参数说明：value是用户密码，需要是hexString格式
返回值：一个地址




```
