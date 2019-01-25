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
`TransferAssetContract`：包含通证名称、提供方地址、接收方地址、通证数量。  
4 返回值  
`TransactionExtention`：返回交易、交易ID、操作结果等。钱包对交易签名后再请求广播交易。  
5 功能说明  
转让通证。创建一个转让通证的交易。
注意，凡带xxx2的接口，与xxx接口功能相同，只是返回值增加更详细的提示。如果result的result值为false，则message为错误提示，transaction和txid字段忽略。constant_result只和职能合约调用有关，其他交易忽略。

## HTTP

`/wallet/transferasset`

Function：Transfer Token\
demo：\
`curl -X POST  http://127.0.0.1:8090/wallet/transferasset -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "asset_name": "6173736574497373756531353330383934333132313538", "amount": 100}'`

Parameters：\
`Owner_address` is the address of the withdrawal account, converted to a hex string；\
`To_address` is the recipient address，converted to a hex string；asset_name is the Token Name(NOT SYMBOL)，converted to a hex string；\
`Amount` is the amount of token to transfer

Return value：Token transfer Transaction raw data