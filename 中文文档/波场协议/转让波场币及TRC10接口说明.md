转让波场币及TRC10接口说明
===

# 转让波场币
## RPC
 
1	接口声明  
`rpc CreateTransaction2 (TransferContract) returns (TransactionExtention)　{}; `

2	提供节点  
fullnode。  
3	参数说明  
`TransferContract`：包含提供方地址、接收方地址、金额，其中金额的单位为sun。  
4	返回值  
`TransactionExtention`：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
5	功能说明  
转账。创建一个转账的交易。\
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## HTTP

`/wallet/createtransaction\`

Function：Creates a transaction of transfer. If the recipient address does not exist, a corresponding account will be created on the blockchain.\
demo: \
`curl -X POST  http://127.0.0.1:8090/wallet/createtransaction -d '{"to_address": "41e9d79cc47518930bc322d9bf7cddd260a0260a8d", "owner_address": "41D1E7A6BC354106CB410E65FF8B181C600FF14292", "amount": 1000 }'`

Parameters：\
`To_address` is the transfer address, converted to a hex string;\
`owner_address` is the transfer transfer address, converted to  a hex string\
`amount` is the transfer amount\
 
Return value：Transaction contract data


# 转让TRC10

## RPC
1 接口声明  
`rpc TransferAsset2 (TransferAssetContract) returns (TransactionExtention){};`  
2 提供节点  
fullnode。  
3 参数说明  
`TransferAssetContract`：包含TRC10名称、提供方地址、接收方地址、TRC10数量。  
4 返回值  
`TransactionExtention`：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
5 功能说明  
转让TRC10。创建一个转让TRC10的交易。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## HTTP

`/wallet/transferasset`

Function：Transfer Token\
demo：\
`curl -X POST  http://127.0.0.1:8090/wallet/transferasset -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "asset_name": "6173736574497373756531353330383934333132313538", "amount": 100}'`

Parameters：\
`Owner_address` is the address of the withdrawal account, converted to a hex string；\
`To_address` is the recipient address，converted to a hex string；\
`asset_name` ,this field is token name before the proposal ALLOW_SAME_TOKEN_NAME is active, otherwise it is token id and token is should be in string format.\
`Amount` is the amount of token to transfer

Return value：Token transfer Transaction raw data

# 参与TRC10
 
## RPC
1 接口声明  
rpc ParticipateAssetIssue (ParticipateAssetIssueContract) returns (Transaction){};  
2 提供节点  
fullnode。  
3 参数说明  
ParticipateAssetIssueContract：包含参与方地址、发行方地址、通证名称、参与金额，其中金额的单位为sun。  
4 返回值  
Transaction：返回包含参与通证发行的交易，钱包签名后再请求广播交易。  
5 功能说明  
参与通证发行。

## HTTP

`/wallet/participateassetissue`

Function：Purchase a Token\
demo：\
`curl -X POST http://127.0.0.1:8090/wallet/participateassetissue -d '{
"to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0",
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1", 
"amount":100, 
"asset_name":"3230313271756265696a696e67"
}'`

Parameters：\
`to_address` is the address of the Token issuer，converted to a hex string\
`owner_address` is the address of the Token owner，converted to a hex string\
`amount` is the number of tokens created\
`asset_name` ,this field is token name before the proposal ALLOW_SAME_TOKEN_NAME is active, otherwise it is token id and token is should be in string format.\

Return value：Token creation Transaction raw data


#  创建交易对

## RPC

1 接口声明  
rpc ExchangeCreate (ExchangeCreateContract) returns (TransactionExtention) {};  
2 提供节点  
fullnode。  
3 参数说明   
first_token_id，第1种token的id
first_token_balance，第1种token的balance
second_token_id，第2种token的id
second_token_balance，第2种token的balance  
4 返回值                                          
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
5 功能说明  
创建交易对

## HTTP

`wallet/exchangecreate\`
作用：创建交易对\
`demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangecreate -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", 、
"first_token_id":token_a, "first_token_balance":100, "second_token_id":token_b,"second_token_balance":200}`\
参数说明：\
`first_token_id`  ：第1种token的id\
`first_token_balance`：第1种token的balance\
`second_token_id` ： 第2种token的id\
`second_token_balance`：第2种token的balance\
返回值：创建交易对的transaction。

#  交易所注资

## RPC

1 接口声明  
rpc ExchangeInject (ExchangeInjectContract) returns (TransactionExtention) {};  
2 提供节点  
fullnode。  
3 参数说明   
exchange_id：交易对id
token_id：注资的token的id
quant：注资数量
4 返回值                                          
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
5 功能说明 
对交易对进行注资

## HTTP

`wallet/exchangeinject`\
作用：给交易对注资，注资后可以防止交易对价格波动太大\
`demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangeinject -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100}`\

参数说明：\
`owner_address`：交易对创建者的地址，hexString格式\
`exchange_id`：交易对id\
`token_id`： token的id，一般情况是token的name，需要是hexString格式\
`quant`：注资token的数量\
返回值：注资的transaction。

#  交易所撤资

## RPC

1 接口声明  
rpc ExchangeWithdraw (ExchangeWithdrawContract) returns (TransactionExtention) {};  
2 提供节点  
fullnode。  
3 参数说明   
exchange_id：交易对id
token_id：撤资的token的id
quant：撤资数量
4 返回值                                          
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
5 功能说明 
对交易对进行撤资

## HTTP

`wallet/exchangewithdraw`\
作用：对交易对撤资，撤资后容易引起交易对价格波动太大。\
`demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangewithdraw -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100}`\
参数说明：\
`owner_address`：是交易对创建者的地址，hexString格式\
`exchange_id`：交易对id\
`token_id`： token的id，一般情况是token的name，需要是hexString格式\
`quant`：撤资token的数量\
返回值：撤资的transaction

#  交易所交易

## RPC

1 接口声明  
rpc ExchangeTransaction (ExchangeTransactionContract) returns (TransactionExtention) {};  
2 提供节点  
fullnode。  
3 参数说明    
exchange_id：交易对id
token_id：撤资的token的id
quant：撤资数量
expected：期望得到的另一个token的最小金额
4 返回值                                          
TransactionExtention：返回签名后的交易、交易ID、操作结果等。
5 功能说明 
交易

## HTTP

`wallet/exchangetransaction\`
作用：参与交易对交易。\
`demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangetransaction -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100,"expected":10}`\
参数说明：\
`owner_address`：是交易对创建者的地址，hexString格式\
`exchange_id`：交易对id\
`token_id`： 卖出的token的id，一般情况是token的name，需要是hexString格式\
`quant`：卖出token的数量\
`expected`：期望买入token的数量\
返回值：token交易的transaction

#  查询所有交易对

## RPC

1 接口声明  
rpc ListExchanges (EmptyMessage) returns (ExchangeList) {};  
2 提供节点  
fullnode。  
3 参数说明    
无
4 返回值                                          
ExchangeList：所有交易对。
5 功能说明 

## HTTP

`wallet/listexchanges`\
作用：查询所有交易对\
`demo：curl -X POST  http://127.0.0.1:8090/wallet/listexchanges`\
参数说明：\
返回值：所有交易对

#  查询指定交易对

## RPC

1 接口声明  
rpc GetExchangeById (BytesMessage) returns (Exchange) {};  
2 提供节点  
fullnode。  
3 参数说明 
value：交易对id
4 返回值                                          
Exchange：交易对。
5 功能说明 

## HTTP

`wallet/getexchangebyid`\
作用：根据id查询交易对\
`demo：curl -X POST  http://127.0.0.1:8090/wallet/getexchangebyid -d {"id":1}`\
参数说明：\
`id`：交易对id\
返回值：交易对 


# 特别说明

在"ALLOW_SAME_TOKEN_NAME"提议通过后，账户及接口发生一些变化，这里特别说明。

## account账户变化

     message Account {
       ...
       // the other asset owned by this account
       map<string, int64> asset = 6;
     
       // the other asset owned by this account，key is assetId
       map<string, int64> assetV2 = 56;
     }

在提议生效前，账户拥有的TRC10的数量在asset属性中描述，并以TRC10的name为key。
在提议生效后，在account中增加assetV2，并以id为key。原asset中的asset自动映射到assetV2
中，并自动生成id。可以使用原getAssetByName接口，查询到TRC10，并记录下id。

## GetAssetIssueByName 接口变化
在提议生效前，通过该接口查询TRC10，输入参数为TRC10的name，在提议生效后建议采用 GetAssetIssueById 来查询。

`
 rpc GetAssetIssueByName (BytesMessage) returns (AssetIssueContract) {
  }
  ` 
  
 

## GetAssetIssueById 接口变化

在提议生效后，采用GetAssetIssueById来查询TRC10详细信息，输入参数为TRC10的id。

`
 rpc GetAssetIssueById (BytesMessage) returns (AssetIssueContract) {
  }
`