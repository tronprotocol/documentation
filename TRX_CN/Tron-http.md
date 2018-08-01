#  TRON内置http接口说明

# SolidityNode接口说明

solidityNode默认的http端口是8091，启动solidityNode的时候会同时启动http服务。
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
FullNode默认的http端口是8090，启动FullNode的时候会同时启动http服务。

```

wallet/createtransaction
作用： 创建一个转账的Transaction，如果转账的to地址不存在，则在区块链上创建该账号
demo: curl -X POST  http://127.0.0.1:8090/wallet/createtransaction -d '{"to_address": "41e9d79cc47518930bc322d9bf7cddd260a0260a8d", "owner_address": "41D1E7A6BC354106CB410E65FF8B181C600FF14292", "amount": 1000 }'
参数说明：to_address是转账转入地址，需要转为hexString；owner_address是转账转出地址，需要转为hexString；amount是转账数量
返回值：转账合约

/wallet/gettransactionsign
作用：对交易签名，该api有泄漏private key的风险，请确保在安全的环境中调用该api
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactionsign -d '{
"transaction" : {"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}}
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

wallet/freezebalance
作用：冻结trx，获取带宽，获取投票权
demo：curl -X POST http://127.0.0.1:8090/wallet/freezebalance -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1", 
"frozen_balance": 10000,
"frozen_duration": 3
}'
参数说明：
owner_address是冻结trx账号的地址，需要是hexString格式
frozen_balance是冻结trx的数量
frozen_duration是冻结天数，最少是3天
返回值：冻结trx的transaction

wallet/unfreezebalance
作用：解冻已经结束冻结期的trx，会同时失去这部分trx带来的带宽和投票权
demo：curl -X POST http://127.0.0.1:8090/wallet/unfreezebalance -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
}'
参数说明：
owner_address是解冻trx账号的地址，需要是hexString格式
返回值：解冻trx的transaction

walle/unfreezeasset
作用：解冻已经结束冻结期的Token
demo：curl -X POST http://127.0.0.1:8090/wallet/unfreezeasset -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
}'
参数说明：
owner_address是解冻token账号的地址，需要是hexString格式
返回值：解冻token的transaction

wallet/withdrawbalance
作用：超级代表体现奖励到balance，每24个小时可以提现一次
demo：curl -X POST http://127.0.0.1:8090/wallet/withdrawbalance -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
}'
参数说明：
owner_address是提现账号的地址，需要是hexString格式
返回值：提现Trx的transaction

wallet/updateasset
作用：修改token信息
demo：curl -X POST http://127.0.0.1:8090/wallet/updateasset -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
"description": ""，
"url": "",
"new_limit" : 1000000,
"new_public_limit" : 100
}'
参数说明：
owner_address是token发行人的地址，需要是hexString格式
description是token的描述，需要是hexString格式
url是token发行人的官网地址，需要是hexString格式
new_limit是token每个持有人能够使用的免费带宽
new_public_limit是该token全部的免费带宽
返回值：修改Token信息的transaction


wallet/listnodes
作用：查询api所在机器连接的节点。
demo: curl -X POST  http://127.0.0.1:8090/wallet/listnodes
参数说明：无
返回值：节点列表。

wallet/getassetissuebyaccount
作用：查询账户发行的token。
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuebyaccount -d '{"address": "41F9395ED64A6E1D4ED37CD17C75A1D247223CAF2D"}'
参数说明：发行者账户地址，格式为hexString。
返回值：带宽信息。

wallet/getaccountnet
作用：查询带宽信息。
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccountnet -d '{"address": "4112E621D5577311998708F4D7B9F71F86DAE138B5"}'
参数说明：账户地址，格式为hexString。
返回值：带宽信息。

wallet/getassetissuebyname
作用：根据名称查询token。
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuebyname -d '{"value": "44756354616E"}'
参数说明：通证名称，格式为hexString。
返回值：token。

wallet/getnowblock
作用：查询最新块。
demo: curl -X POST  http://127.0.0.1:8090/wallet/getnowblock
参数说明：无
返回值：当前块。

wallet/getblockbynum
作用：通过高度查询块
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbynum -d '{"num": 1}'
参数说明：块高度。
返回值：块。

wallet/getblockbyid
作用：通过ID查询块
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbyid -d '{"value": "0000000000038809c59ee8409a3b6c051e369ef1096603c7ee723c16e2376c73"}'
参数说明：块ID。
返回值：块。

wallet/getblockbylimitnext
作用：按照范围查询块
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbylimitnext -d '{"startNum": 1, "endNum": 2}'
参数说明：
   startNum：起始块高度，包含此块
   endNum：截止块高度，不包含此此块
返回值：块的列表。

wallet/getblockbylatestnum
作用：查询最新的几个块
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbylatestnum -d '{"num": 5}'
参数说明：块的数量。
返回值：块的列表。

wallet/gettransactionbyid
作用：通过ID查询交易
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactionbyid -d '{"value": "d5ec749ecc2a615399d8a6c864ea4c74ff9f523c2be0e341ac9be5d47d7c2d62"}'
参数说明：交易ID。
返回值：交易信息。

wallet/listwitnesses
作用：查询所有witness列表
demo: curl -X POST  http://127.0.0.1:8090/wallet/listwitnesses
参数说明：无
返回值：witness列表。

wallet/getassetissuelist
作用：查询所有token列表
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuelist
参数说明：无
返回值：token列表。

wallet/getpaginatedassetissuelist
作用：分页查询token列表
demo: curl -X POST  http://127.0.0.1:8090/wallet/getpaginatedassetissuelist -d '{"offset": 0, "limit": 10}'
参数说明：offset是起始Token的index，limit是期望返回的Token数量
返回值：token列表。

wallet/totaltransaction
作用：统计所有交易总数
demo: curl -X POST  http://127.0.0.1:8090/wallet/totaltransaction
参数说明：无
返回值：交易总数。

wallet/getnextmaintenancetime
作用：获取下次统计投票的时间
demo: curl -X POST  http://127.0.0.1:8090/wallet/getnextmaintenancetime
参数说明：无
返回值：下次统计投票时间的毫秒数。

wallet/easytransferbyprivate
作用：快捷转账
demo: curl -X POST  http://127.0.0.1:8090/wallet/easytransferbyprivate -d '{"privateKey": "D95611A9AF2A2A45359106222ED1AFED48853D9A44DEFF8DC7913F5CBA727366", "toAddress":"4112E621D5577311998708F4D7B9F71F86DAE138B5","amount":10000}'
参数说明：
   privateKey：私钥，hexString格式
   toAddress：转入账户地址，hexString格式。
   amount：转账的drop数量。
返回值：交易，含执行结果。
警告：该api有泄漏private key的风险，请确保在安全的环境中调用该api。

wallet/generateaddress
作用：生成私钥和地址
demo: curl -X POST  http://127.0.0.1:8090/wallet/generateaddress
参数说明：无
返回值：地址和私钥
警告：该api有泄漏private key的风险，请确保在安全的环境中调用该api。

wallet/validateaddress
作用：检查地址是否正确
demo: curl -X POST  http://127.0.0.1:8090/wallet/validateaddress -d '{"address": "4189139CB1387AF85E3D24E212A008AC974967E561"}'
参数说明：地址，可以是base58checksum、hexString、base64格式
返回值：地址正确或者错误

wallet/deploycontract
作用：部署合约
demo: curl -X POST  http://127.0.0.1:8090/wallet/deploycontract -d '{"contract_name":"SomeContract","bandwidth_limit":1000000,"call_value":100,"cpu_limit":1000000,"drop_limit":10,"abi":"[{\"constant\":false,\"inputs\":[{\"name\":\"key\",\"type\":\"uint256\"},{\"name\":\"value\",\"type\":\"uint256\"}],\"name\":\"set\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[{\"name\":\"key\",\"type\":\"uint256\"}],\"name\":\"get\",\"outputs\":[{\"name\":\"value\",\"type\":\"uint256\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"}]","bytecode":"608060405234801561001057600080fd5b5060de8061001f6000396000f30060806040526004361060485763ffffffff7c01000000000000000000000000000000000000000000000000000000006000350416631ab06ee58114604d5780639507d39a146067575b600080fd5b348015605857600080fd5b506065600435602435608e565b005b348015607257600080fd5b50607c60043560a0565b60408051918252519081900360200190f35b60009182526020829052604090912055565b600090815260208190526040902054905600a165627a7a72305820fdfe832221d60dd582b4526afa20518b98c2e1cb0054653053a844cf265b25040029","storage_limit":1000000}'
参数说明：
address，hexString格式
abi：abi
bytecode:bytecode
bandwidth_limit：最大带宽消耗，字节数
cpu_limit：最大cpu消耗，微秒
storage_limit：最大存储消耗，字节数
drop_limit：最大消耗的Drop（1TRX=1000000drop）
call_value：本次调用往合约转账的Drop（1TRX=1000000drop）
返回值：合约部署的交易是否发送成功


wallet/triggercontract
作用：调用合约
demo: curl -X POST  http://127.0.0.1:8090/wallet/triggercontract -d '{"address":"4189139CB1387AF85E3D24E212A008AC974967E561","function_selector":"set(uint256,uint256)","parameter":[1,2],"bandwidth_limit":1000000,"cpu_limit":1000000,"storage_limit":1000000,"drop_limit":10,"call_value":100}'
参数说明：
address，hexString格式
function_selector，函数签名，不能有空格
parameter：调用参数，数组类型
bandwidth_limit：最大带宽消耗，字节数
cpu_limit：最大cpu消耗，微秒
storage_limit：最大存储消耗，字节数
drop_limit：最大消耗的Drop（1TRX=1000000drop）
call_value：本次调用往合约转账的Drop（1TRX=1000000drop）
返回值：合约调用的交易是否发送成功

```
