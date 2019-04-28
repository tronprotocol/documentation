#  TRON Built-in Http Introduction
# hexString and base58check transcode demo
java: 
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java#L92

php:
https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/index.php 

**Since v3.6, parameter 'visible' is added, when 'visible' is set true, no need to transcode the relevant address and string. This parameter is valid for all api, including solidityNode api and FullNode api.**   
When 'visible' is set true, the format of the input address must be base58, input string must text string, so does the format of the output. If 'visible' is set false or null, the api acts the same as previous version. If the format of the parameters do not match with the set of visible, it will throw out an error.   
Way to set the 'visible' parameter:
1. For the api need no parameter: By adding 'visible' parameter in the url, like 127.0.0.1:8090/wallet/listexchanges?visible=true      
2. For POST method api: By adding 'visible' parameter to the most out layer of the json, like curl -X POST http://127.0.0.1:8090/wallet/createtransaction 
{"owner_address_":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ",
"to_address_":"TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW","amount":1000000,"visible":true}   
3. For GET method api: By adding 'visible' parameter in the url, like way 1  

    
# SolidityNode Api Introduction

solidityNode api's default http port is 8091, when solidityNode is started, http service will be started too.
```
/walletsolidity/getaccount
Description: Query an account information
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getaccount -d '{"address": "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}'
Parameter address: Default hexString
Return: Account Object

/walletsolidity/listwitnesses
Description: Qyery the list of the witnesses
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/listwitnesses
Parameter: No Parameter
Return: The list of all the witnesses

/walletsolidity/getassetissuelist
Description: Query the list of all the tokens
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuelist 
Parameter: No Parameter
Return: The list of all the tokens

/walletsolidity/getpaginatedassetissuelist
Description: Query the list of all the tokens by pagination
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getpaginatedassetissuelist -d '{"offset": 0, "limit":10}'
Parameter offset: the index of the start token
Parameter limit: the amount of tokens per page
Return: The list of tokens by pagination

/walletsolidity/getassetissuebyname(Since Odyssey-v3.2)
Description: Query a token by token name
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuebyname -d '{"value": "44756354616E"}'
Parameter value: Token name, default hexString
Return: Token Object
Note: Since Odyssey-v3.2, getassetissuebyid or getassetissuelistbyname is recommended, as since v3.2, token name can be repeatable. If the token name you query is not unique, this api will throw out an error

/walletsolidity/getassetissuelistbyname(Since Odyssey-v3.2)
Description: Query the list of tokens by name
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuelistbyname -d '{"value": "44756354616E"}'
Parameter value: Token name, default hexString
Return: The list of tokens

/walletsolidity/getassetissuebyid(Since Odyssey-v3.2)
Description: Query a token by token id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuebyid -d '{"value": "1000001"}'
Parameter value: Token id
Return: Token object

/walletsolidity/getnowblock
Description: Query the latest block information   
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getnowblock
Parameter: No Parameter
Return: the latest block from solidityNode

/walletsolidity/getblockbynum
Description: Query a block information by block height
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getblockbynum -d '{"num" : 100}' 
Parameter num: Block height
Return: Block information

/walletsolidity/gettransactionbyid
Description: Query an transaction infromation by transaction id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactionbyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameter value: Transaction id
Return: Transaction information

/walletsolidity/gettransactioncountbyblocknum(Since Odyssey-v3.2)
Description: Query th the number of transactions in a specific block
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactioncountbyblocknum -d '{"num" : 100}' 
Parameter num: Block height
Return: The number of transactions.

/walletsolidity/gettransactioninfobyid
Description: Query the transaction fee, block height by transaction id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactioninfobyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameter value: Transaction id
Return: Transaction fee & block height

/walletsolidity/getdelegatedresource(Since Odyssey-v3.2)
Description: Query the energy delegation information
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getdelegatedresource -d '
{
"fromAddress": "419844f7600e018fd0d710e2145351d607b3316ce9",
"toAddress": "41c6600433381c731f22fc2b9f864b14fe518b322f"
}'
Parameter fromAddress: Energy from address, default hexString
Parameter toAddress: Energy to address, default hexString
Return: Energy delegation information

/walletsolidity/getdelegatedresourceaccountindex(Since Odyssey-v3.2)
Description: Query the energy delegation index by an account
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getdelegatedresourceaccountindex -d '
{
"value": "419844f7600e018fd0d710e2145351d607b3316ce9", 
}'
Parameter value: Address, default hexString
Return: Energy delegation index

/walletsolidity/getexchangebyid(Since Odyssey-v3.2)
Description: Query an exchange pair by exchange pair id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getexchangebyid -d {"id":1}
Parameter id: Exchange pair id
Return: Exchange pair object

/walletsolidity/listexchanges(Since Odyssey-v3.2)
Description: Query the list of all the exchange pairs
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/listexchanges
Parameter: No Parameter
Return: The list of all the exchange pairs

walletsolidity/getaccountbyid
Description: Query an account information by account id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getaccountbyid -d '{"account_id":"6161616162626262"}'
Parameter account_id: Account id, default hexString
Return: Account object

walletsolidity/getblockbyid
Description: Query a block information by block id 
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getblockbyid-d '{"value": 
"0000000000038809c59ee8409a3b6c051e369ef1096603c7ee723c16e2376c73"}'
Parameter value: Block id 
Return: Block object

walletsolidity/getblockbylimitnext
Description: Query a list of blocks by range
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getblockbylimitnext -d '{"startNum": 1, "endNum": 2}'
Parameter startNum: The start block height, itself included
Parameter endNum: The end block height, itself not included
Return: The list of the blocks

walletsolidity/getblockbylatestnum
Description: Query the several latest blocks
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getblockbylatestnum -d '{"num": 5}'
Parameter num: The number of the blocks expected to return
Return: The list of the blocks

/walletextension/gettransactionsfromthis（No longer supported in the latest version）
Description: Query the transactions initiated by an account
demo: curl -X POST  http://127.0.0.1:8091/walletextension/gettransactionsfromthis -d '{"account" 
: {"address" : "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}, "offset": 0, "limit": 10,"startTime": 1546099200000, "endTime": 1552028828000}'
Parameter address: Address, default hexString
Parameter offset: The start index of the transactions, must not greater then 10000
Parameter limit: The number of transactions expected to return, maximum 50, offset+limit must smaller than 10000
Parameter startTime: Query start time
Parameter endTime: Query end time, Default latest 7 days
Return: The list of transactions
Note: This api is no longer supported in the latest version, you can use the central node api: 47.90.247.237:8091/walletextension/gettransactionsfromthis 

/walletextension/gettransactionstothis（No longer supported in the latest version）
Description: Query the transactions received by an account
demo: curl -X POST  http://127.0.0.1:8091/walletextension/gettransactionstothis -d '{"account" : 
{"address" : "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}, "offset": 0, "limit": 10,"startTime": 1546099200000, "endTime": 1552028828000}'
Parameter address: Address, default hexString
Parameter offset: The start index of the transactions, must not greater then 10000
Parameter limit: The number of transactions expected to return, maximum 50, offset+limit must smaller than 10000
Parameter startTime: Query start time
Parameter endTime: Query end time, Default latest 7 days
Return: The list of transactions
Note: This api is no longer supported in the latest version, you can use the central node api: 47.90.247.237:8091/walletextension/gettransactionstothis

/wallet/getnodeinfo(Since Odyssey-v3.2)
Description: Query the current node infromation
demo: curl -X GET http://127.0.0.1:8091/wallet/getnodeinfo 
Parameter: No Parameter
Return: The node information

/walletsolidity/getdeferredtransactionbyid
Description: Query the deferred transaction infromation by transaction id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getdeferredtransactionbyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameter value: transaction id
Return: Deferred transaction object

/walletsolidity/getdeferredtransactioninfobyid
Description: Query the deferred transaction fee, block height by transaction id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getdeferredtransactioninfobyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameter value: transaction id
Return: Deferred transaction fee & block height
```

# FullNode Api Introduction
FullNode api's default http port is 8090, when FullNode is started, http service will be started too.

```

wallet/createtransaction
Description: Create a transfer transaction, if to address is not existed, then create the account on the blockchain
demo: curl -X POST  http://127.0.0.1:8090/wallet/createtransaction -d '{"to_address": "41e9d79cc47518930bc322d9bf7cddd260a0260a8d", "owner_address": "41D1E7A6BC354106CB410E65FF8B181C600FF14292", "amount": 1000 }'
Parameter to_address: To address, default hexString    
Parameter owner_address: Owner address, default hexString    
Parameter amount: Transfer amount   
Parameter permission_id: Optional, for multi-signature use      
Return: Transaction object

/wallet/gettransactionsign
Description: To sign a transaction
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactionsign -d '{
"transaction" : {"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}}, "privateKey": "your private key"
}'
Parameter transaction: Transaction object
Parameter privateKey: Private key
Return: Transaction after sign
Note: Using this api may leak out private key, please ensure using this api in a secure network

wallet/broadcasttransaction
Description: Broadcast transaction after sign
demo: curl -X POST  http://127.0.0.1:8090/wallet/broadcasttransaction -d '{"signature":["97c825b41c77de2a8bd65b3df55cd4c0df59c307c0187e42321dcc1cc455ddba583dd9502e17cfec5945b34cad0511985a6165999092a6dec84c2bdd97e649fc01"],"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}}'
Parameter: Transaction after sign
Return: The result of the broadcast

wallet/updateaccount
Description: Update the name of an account
demo: curl -X POST  http://127.0.0.1:8090/wallet/updateaccount -d '{"account_name": "0x7570646174654e616d6531353330383933343635353139" ,"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"}'
Parameter account_name: Account name, default hexString    
Parameter owner_address: Owner address, default hexString    
Parameter permission_id: Optional, for multi-signature use    
Return: Transaction object

wallet/votewitnessaccount
Description: Vote for witnesses
demo: curl -X POST  http://127.0.0.1:8090/wallet/votewitnessaccount -d '{
"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", 
"votes": [{"vote_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "vote_count": 5}]
}'
Parameter owner_address: Owner address, default hexString
Parameter votes: 'vote_address' stands for the address of the witness you want to vote, default hexString   
'vote_count' stands for the number of votes you want to vote  
Parameter permission_id: Optional, for multi-signature use     
Return: Transaction object     

wallet/createassetissue
Description: Issue a token
demo: curl -X POST  http://127.0.0.1:8090/wallet/createassetissue -d '{
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
Parameter owner_address: Owner address, default hexString  
Parameter name: Token name, default hexString    
Parameter abbr: Token name abbreviation, default hexString  
Parameter total_supply: Token total supply    
Parameter trx_num: Define the price by the ratio of trx_num/num,
Parameter num: Define the price by the ratio of trx_num/num   
Parameter start_time: ICO start time
Parameter end_time: ICO end time    
Parameter description: Token description, default hexString
Parameter url: Token official website url, default hexString   
Parameter free_asset_net_limit: Token free asset net limit   
Parameter public_free_asset_net_limit: Token public free asset net limit    
Parameter frozen_supply: Token frozen supply  
Parameter permission_id: Optional, for multi-signature use    
Return: Transaction object
Note: The unit of 'trx_num' is SUN

wallet/updatewitness
Description: Update the witness' website url
demo: curl -X POST  http://127.0.0.1:8090/wallet/updatewitness -d '{
"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", 
"update_url": "007570646174654e616d6531353330363038383733343633"
}'
Parameter owner_address: Owner address, default hexString    
Parameter update_url: Website url, default hexString     
Parameter permission_id: Optional, for multi-signature use       
Return: Transaction object

wallet/createaccount
Description: Create an account
demo: curl -X POST  http://127.0.0.1:8090/wallet/createaccount -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "account_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0"}'
Parameter owner_address: Owner address, default hexString  
Parameter account_address: New address, default hexString  
Parameter permission_id: Optional, for multi-signature use     
Return: Transaction object
Note: It costs 0.1 TRX

wallet/createwitness
Description: Apply to become a witness
demo: curl -X POST  http://127.0.0.1:8090/wallet/createwitness -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "url": "007570646174654e616d6531353330363038383733343633"}'
Parameter owner_address: Owner address, default hexString   
Parameter url: Website url, default hexString
Parameter permission_id: Optional, for multi-signature use       
Return: Transaction object

wallet/transferasset
Description: Transfer token
demo: curl -X POST  http://127.0.0.1:8090/wallet/transferasset -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "asset_name": "31303030303031", "amount": 100}'
Parameter owner_address: Owner address, default hexString    
Parameter to_address: To address, default hexString    
Parameter asset_name: Token id, default hexString   
Parameter amount: Token transfer amount    
Parameter permission_id: Optional, for multi-signature use         
Return: Transaction object
Note: The unit of 'amount' is the smallest unit of the token

wallet/easytransfer
Description: Easy transfer
demo: curl -X POST http://127.0.0.1:8090/wallet/easytransfer -d '{
"passPhrase": "your password",
"toAddress": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", 
"amount": 100
}'
Parameter passPhrase: Password, default hexString   
Parameter toAddress: To address, default hexString  
Parameter amount: Transfer TRX amount    
Return: Transaction object & the result of the broadcast
Note: Using this api may leak out private key, please ensure using this api in a secure network  

wallet/easytransferasset
Description: Easy token transfer
demo：curl -X POST http://127.0.0.1:8090/wallet/easytransferasset -d '{
"passPhrase": "your password",
"toAddress": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", 
"assetId": "1000001", 
"amount": 100
}'
Parameter passPhrase: Password, default hexString   
Parameter toAddress: To address, default hexString   
Parameter assetId: Token id   
Parameter amount: Transfer token amount    
Return: Transaction object & the result of the broadcast
Note: Using this api may leak out private key, please ensure using this api in a secure network;
The unit of 'amount' is the smallest unit of the token

wallet/createaddress
Description: Create an address with a password
demo: curl -X POST http://127.0.0.1:8090/wallet/createaddress -d '{"value": "3230313271756265696a696e67"}'
Parameter value: Password, default hexString    
Return: An address  
Note: Using this api may leak out private key, please ensure using this api in a secure network

wallet/participateassetissue
Description: Participate a token
demo: curl -X POST http://127.0.0.1:8090/wallet/participateassetissue -d '{
"to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0",
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1", 
"amount":100, 
"asset_name":"3230313271756265696a696e67"
}'
Parameter to_address: The issuer address of the token, default hexString    
Parameter owner_address: The participant address, default hexString 
Parameter amount: Participate token amount
Parameter asset_name: Token id, default hexString         
Parameter permission_id: Optional, for multi-signature use          
Return: Transaction object
Note: The unit of 'amount' is the smallest unit of the token

wallet/freezebalance
Description: Freeze TRX
demo: curl -X POST http://127.0.0.1:8090/wallet/freezebalance -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1", 
"frozen_balance": 10000,
"frozen_duration": 3,
"resource" : "BANDWIDTH",
"receiveraddress":"414332f387585c2b58bc2c9bb4492bc1f17342cd1"
}'
Parameter owner_address: Owner address, default hexString    
Parameter frozen_balance: TRX freeze amount
Parameter frozen_duration: TRX freeze duration, at least 3 days
Parameter resource: TRX freeze type, 'BANDWIDTH' or 'ENERGY'
Parameter receiverAddress: The address that will receive the resource, default hexString          
Parameter permission_id: Optional, for multi-signature use      
Return: Transaction object

wallet/unfreezebalance
Description: Unfreeze the frozen TRX that is due
demo: curl -X POST http://127.0.0.1:8090/wallet/unfreezebalance -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
"resource": "BANDWIDTH",
"receiveraddress":"414332f387585c2b58bc2c9bb4492bc1f17342cd1"
}'
Parameter owner_address: Owner address, default hexString    
Parameter resource: Frozen TRX unfreeze type 'BANDWIDTH' or 'ENERGY'
Parameter receiverAddress: The address that will lose the resource, default hexString     
Parameter permission_id: Optional, for multi-signature use     
Return: Transaction object

wallet/unfreezeasset
Description: Unfreeze the frozen token that is due
demo: curl -X POST http://127.0.0.1:8090/wallet/unfreezeasset -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
}'
Parameter owner_address: Owner address, default hexString    
Parameter permission_id: Optional, for multi-signature use      
Return: Transaction object

wallet/withdrawbalance
Description: Withdraw reward to account balance for witnesses
demo: curl -X POST http://127.0.0.1:8090/wallet/withdrawbalance -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
}'
Parameter owner_address: Owner address, default hexString    
Parameter permission_id: Optional, for multi-signature use        
Return: Transaction object
Note: It can only withdraw once for every 24 hours

wallet/updateasset
Description: Update token information
demo: curl -X POST http://127.0.0.1:8090/wallet/updateasset -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
"description": ""，
"url": "",
"new_limit" : 1000000,
"new_public_limit" : 100
}'
Parameter owner_address: The issuers address of the token, default hexString   
Parameter description: The description of token, default hexString   
Parameter url: The token's website url, default hexString    
Parameter new_limit: Each token holder's free bandwidth
Parameter new_public_limit: The total free bandwidth of the token
Parameter permission_id: Optional, for multi-signature use    
Return: Transaction object    

wallet/listnodes
Description: Query the list of nodes connected to the ip of the api
demo: curl -X POST  http://127.0.0.1:8090/wallet/listnodes
Parameter: No Parameter
Return: The list of nodes

wallet/getassetissuebyaccount
Description: Query the token issue information of an account
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuebyaccount -d '{"address": "41F9395ED64A6E1D4ED37CD17C75A1D247223CAF2D"}'
Parameter address: Token issuer's address, default hexString   
Return: Token object

wallet/getaccountnet
Description: Query the bandwidth information of an account
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccountnet -d '{"address": "4112E621D5577311998708F4D7B9F71F86DAE138B5"}'
Parameter address: Address, default hexString    
Return: Bandwidth information

wallet/getassetissuebyname
Description: Query a token by token name
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuebyname -d '{"value": "44756354616E"}'
Parameter value: Token name, default hexString
Return: Token Object
Note: Since Odyssey-v3.2, getassetissuebyid or getassetissuelistbyname is recommended, as since v3.2, token name can be repeatable. If the token name you query is not unique, this api will throw out an error

wallet/getassetissuelistbyname(Since Odyssey-v3.2)
Description: Query the list of tokens by name
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuelistbyname -d '{"value": "44756354616E"}'
Parameter value: Token name, default hexString
Return: The list of tokens

wallet/getassetissuebyid(Since Odyssey-v3.2)
Description: Query a token by token id
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuebyid -d '{"value": "1000001"}'
Parameter value: Token id
Return: Token object

wallet/getnowblock
Description: Query the latest block information   
demo: curl -X POST  http://127.0.0.1:8090/wallet/getnowblock
Parameter: No Parameter
Return: the latest block from solidityNode

wallet/getblockbynum
Description: Query a block information by block height
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbynum -d '{"num" : 1}' 
Parameter num: Block height
Return: Block information

wallet/getblockbyid
Description: Query a block information by block id 
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbyid-d '{"value": 
"0000000000038809c59ee8409a3b6c051e369ef1096603c7ee723c16e2376c73"}'
Parameter value: Block id 
Return: Block object

wallet/getblockbylimitnext
Description: Query a list of blocks by range
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbylimitnext -d '{"startNum": 1, "endNum": 2}'
Parameter startNum: The start block height, itself included
Parameter endNum: The end block height, itself not included
Return: The list of the blocks

wallet/getblockbylatestnum
Description: Query the several latest blocks
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbylatestnum -d '{"num": 5}'
Parameter num: The number of the blocks expected to return
Return: The list of the blocks

wallet/gettransactionbyid
Description: Query an transaction infromation by transaction id
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactionbyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameter value: Transaction id
Return: Transaction information

wallet/gettransactioninfobyid(Since Odyssey-v3.2)
Description: Query the transaction fee, block height by transaction id
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactioninfobyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameter value: Transaction id
Return: Transaction fee & block height

wallet/gettransactioncountbyblocknum(Since Odyssey-v3.2)
Description: Query th the number of transactions in a specific block
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactioncountbyblocknum -d '{"num" : 100}' 
Parameter num: Block height
Return: The number of transactions.

wallet/getaccount
Description: Query an account information
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccount -d '{"address": "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}'
Parameter address: Default hexString
Return: Account Object

wallet/listwitnesses
Description: Qyery the list of the witnesses
demo: curl -X POST  http://127.0.0.1:8090/wallet/listwitnesses
Parameter: No Parameter
Return: The list of all the witnesses

wallet/getassetissuelist
Description: Query the list of all the tokens
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuelist 
Parameter: No Parameter
Return: The list of all the tokens

wallet/getpaginatedassetissuelist
Description: Query the list of all the tokens by pagination
demo: curl -X POST  http://127.0.0.1:8090/wallet/getpaginatedassetissuelist -d '{"offset": 0, "limit":10}'
Parameter offset: The index of the start token
Parameter limit: The amount of tokens per page
Return: The list of tokens by pagination

wallet/getpaginatedproposallist(Since Odyssey-v3.5)
Description: Query the list of all the proposals by pagination
demo: curl -X POST  http://127.0.0.1:8090/wallet/getpaginatedproposallist -d '{"offset": 0, "limit": 10}'
Parameter offset: The index of the start proposal
Parameter limit: The amount of proposals per page
Return: The list of proposals by pagination


wallet/getpaginatedexchangelist(Odyssey-v3.2开始支持)
Description: Query the list of all the exchange pairs by pagination
demo: curl -X POST  http://127.0.0.1:8090/wallet/getpaginatedexchangelist -d '{"offset": 0, "limit":10}'
Parameter offset:  The index of the start exchange pair
Parameter limit: The amount of exchange pairs per page
Return: The list of exchange pairs by pagination

wallet/totaltransaction
Description: Query the total transactions number
demo: curl -X POST  http://127.0.0.1:8090/wallet/totaltransaction
Parameter: No parameter
Return: Total transaction number

wallet/getnextmaintenancetime
Description: Query the time interval till the next vote round
demo: curl -X POST  http://127.0.0.1:8090/wallet/getnextmaintenancetime
Parameter: No parameter
Return: The time interval till the next vote round(unit: ms)

wallet/easytransferbyprivate
Description: TRX Easy transfer
demo: curl -X POST  http://127.0.0.1:8090/wallet/easytransferbyprivate -d '{"privateKey": "D95611A9AF2A2A45359106222ED1AFED48853D9A44DEFF8DC7913F5CBA727366", "toAddress":"4112E621D5577311998708F4D7B9F71F86DAE138B5","amount":10000}'
Parameter privateKey: Private key, default hexString  
Parameter toAddress: To address, default hexString   
Parameter amount: TRX transfer amount
Return: Transaction object & the result of the broadcast
Note: Using this api may leak out private key, please ensure using this api in a secure network

wallet/easytransferassetbyprivate
Description: Token easy transfer
demo: curl -X POST  http://127.0.0.1:8090/wallet/easytransferassetbyprivate -d '{"privateKey": "D95611A9AF2A2A45359106222ED1AFED48853D9A44DEFF8DC7913F5CBA727366", "toAddress":"4112E621D5577311998708F4D7B9F71F86DAE138B5",
"assetId": "1000001",
"amount": 10000}'
Parameter privateKey: Private key, default hexString    
Parameter toAddress: To address, default hexString    
Parameter assetId: Token id
Parameter amount: Token transfer amount
Return: Transaction object & the result of the broadcast
Note: Using this api may leak out private key, please ensure using this api in a secure network;
The unit of 'amount' is the smallest unit of the token

wallet/generateaddress
Description: Generate address and private key
demo: curl -X POST  http://127.0.0.1:8090/wallet/generateaddress
Parameter: No parameter
Return: Address and private key
Note: Using this api may leak out private key, please ensure using this api in a secure network;

wallet/validateaddress
Description: Check the validity of the address
demo: curl -X POST  http://127.0.0.1:8090/wallet/validateaddress -d '{"address": "4189139CB1387AF85E3D24E212A008AC974967E561"}'
Parameter address: Address, can be base58checksum、hexString、base64
Return: The check result

wallet/deploycontract
Description: Deploy a smart contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/deploycontract -d '{"abi":"[{\"constant\":false,\"inputs\":[{\"name\":\"key\",\"type\":\"uint256\"},{\"name\":\"value\",\"type\":\"uint256\"}],\"name\":\"set\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[{\"name\":\"key\",\"type\":\"uint256\"}],\"name\":\"get\",\"outputs\":[{\"name\":\"value\",\"type\":\"uint256\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"}]","bytecode":"608060405234801561001057600080fd5b5060de8061001f6000396000f30060806040526004361060485763ffffffff7c01000000000000000000000000000000000000000000000000000000006000350416631ab06ee58114604d5780639507d39a146067575b600080fd5b348015605857600080fd5b506065600435602435608e565b005b348015607257600080fd5b50607c60043560a0565b60408051918252519081900360200190f35b60009182526020829052604090912055565b600090815260208190526040902054905600a165627a7a72305820fdfe832221d60dd582b4526afa20518b98c2e1cb0054653053a844cf265b25040029","parameter":"","call_value":100,"name":"SomeContract","consume_user_resource_percent":30,"fee_limit":10,"origin_energy_limit": 10,"owner_address":"41D1E7A6BC354106CB410E65FF8B181C600FF14292"}'
Parameter abi: Abi
Parameter bytecode: Bytecode, default hexString
Parameter parameter: The list of the parameters of the constructor, It should be converted hexString after encoded according to ABI encoder. If constructor has no parameter, this can be optional
Parameter consume_user_resource_percent: Consume user's resource percentage. It should be an integer between [0, 100]. if 0, means it does not consume user's resource until the developer's resource has been used up
Parameter fee_limit: The maximum TRX burns for resource consumption
Parameter call_value: The TRX transfer to the contract for each call
Parameter owner_address: Owner address of the contract, default hexString  
Parameter name: Contract name
Parameter origin_energy_limit: The maximum resource consumption of the creator in one execution or creation 
Parameter permission_id: Optional, for multi-signature use    
Return: Transaction object

wallet/triggersmartcontract
作用：调用合约
demo: curl -X POST  http://127.0.0.1:8090/wallet/triggercontract -d '{"contract_address":"4189139CB1387AF85E3D24E212A008AC974967E561","function_selector":"set(uint256,uint256)","parameter":"00000000000000000000000000000000000000000000000000000000000000010000000000000000000000000000000000000000000000000000000000000002","fee_limit":10,"call_value":100,"owner_address":"41D1E7A6BC354106CB410E65FF8B181C600FF14292"}'
参数说明：
contract_address，默认为hexString格式    
function_selector，函数签名，不能有空格
parameter：调用参数[1,2]的虚拟机格式，使用remix提供的js工具，将合约调用者调用的参数数组[1,2]转化为虚拟机所需要的参数格式
fee_limit：最大消耗的SUN（1TRX = 1,000,000SUN）
call_value：本次调用往合约转账的SUN（1TRX = 1,000,000SUN）
owner_address：发起triggercontract的账户地址，默认为hexString格式    
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：TransactionExtention, TransactionExtention中包含未签名的交易Transaction

wallet/getcontract
作用：获取合约
demo: curl -X POST  http://127.0.0.1:8090/wallet/getcontract -d '{"value":"4189139CB1387AF85E3D24E212A008AC974967E561"}'
参数说明：
value：合约地址，默认为hexString格式    
返回值：SmartContract，智能合约的内容 

wallet/proposalcreate
作用：创建提案
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposalcreate -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9","parameters":[{"key": 0,"value": 100000},{"key": 1,"value": 2}] }
参数说明：
owner_address：创建人地址
parameters：提案参数
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：创建提案的交易

wallet/getproposalbyid
作用：根据id查询提案
demo: curl -X POST  http://127.0.0.1:8090/wallet/getproposalbyid -d {"id":1}
参数说明：
id：提案id
返回值：提案详细信息

wallet/listproposals
作用：查询所有提案
demo: curl -X POST  http://127.0.0.1:8090/wallet/listproposals
参数说明：无
返回值：提案列表信息

wallet/proposalapprove
作用：提案批准
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposalapprove -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9", "proposal_id":1, "is_add_approval":true}
参数说明：
owner_address：批准人地址，默认为hexString格式    
proposal_id：提案id
is_add_approval：是否批准
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：批准提案的交易

wallet/proposaldelete
作用：删除提案
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposaldelete -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9", "proposal_id":1}
参数说明：
owner_address：删除人的地址，只有提案所有人允许删除提案，默认为hexString格式    
proposal_id：提案id
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：删除提案的交易

wallet/getaccountresource
作用：查询账户的资源信息
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccountresource -d {"address" : "419844f7600e018fd0d710e2145351d607b3316ce9"}
参数说明：
address：查询账户的地址，默认为hexString格式    
返回值：账户的资源信息

wallet/exchangecreate
作用：创建交易对
demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangecreate -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", 、
"first_token_id":token_a, "first_token_balance":100, "second_token_id":token_b,"second_token_balance":200}
参数说明：
first_token_id  ：第1种token的id，默认为hexString格式    
first_token_balance：第1种token的balance
second_token_id ： 第2种token的id，默认为hexString格式    
second_token_balance：第2种token的balance
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：创建交易对的transaction。

wallet/exchangeinject
作用：给交易对注资，注资后可以防止交易对价格波动太大
demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangeinject -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100}
参数说明：
owner_address：交易对创建者的地址，默认为hexString格式    
exchange_id：交易对id
token_id： token的id，一般情况是token的name，默认为hexString格式    
quant：注资token的数量
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：注资的transaction。

wallet/exchangewithdraw
作用：对交易对撤资，撤资后容易引起交易对价格波动太大。
demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangewithdraw -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100}
参数说明：
owner_address：是交易对创建者的地址，默认为hexString格式    
exchange_id：交易对id
token_id： token的id，一般情况是token的name，需要是hexString格式
quant：撤资token的数量
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：撤资的transaction

wallet/exchangetransaction
作用：参与交易对交易。
demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangetransaction -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100,"expected":10}
参数说明：
owner_address：是交易对创建者的地址，默认为hexString格式    
exchange_id：交易对id
token_id： 卖出的token的id，一般情况是token的name，默认为hexString格式    
quant：卖出token的数量
expected：期望买入token的数量
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：token交易的transaction

wallet/getexchangebyid
作用：根据id查询交易对
demo：curl -X POST  http://127.0.0.1:8090/wallet/getexchangebyid -d {"id":1}
参数说明：
id：交易对id 
返回值：交易对

wallet/listexchanges
作用：查询所有交易对
demo：curl -X POST  http://127.0.0.1:8090/wallet/listexchanges
参数说明：
返回值：所有交易对

wallet/getchainparameters
作用：查询所有交易对
demo：curl -X POST  http://127.0.0.1:8090/wallet/getchainparameters 
参数说明：
返回值：区块链委员会可以设置的所有参数

wallet/updatesetting
作用：更新合约的consume_user_resource_percent
demo: curl -X POST  http://127.0.0.1:8090/wallet/updatesetting -d '{"owner_address": "419844f7600e018fd0d710e2145351d607b3316ce9", "contract_address": "41c6600433381c731f22fc2b9f864b14fe518b322f", "consume_user_resource_percent": 7}'
参数说明：
owner_address：是交易对创建者的地址，默认为hexString格式    
contract_address：要修改的合约的地址，默认为hexString格式    
consume_user_resource_percent：指定的使用该合约用户的资源占比
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：TransactionExtention, TransactionExtention中包含未签名的交易Transaction

wallet/updateenergylimit
作用：更新合约的origin_energy_limit
demo: curl -X POST  http://127.0.0.1:8090/wallet/updatesetting -d '{"owner_address": "419844f7600e018fd0d710e2145351d607b3316ce9", "contract_address": "41c6600433381c731f22fc2b9f864b14fe518b322f", "origin_energy_limit": 7}'
参数说明：
owner_address：是交易对创建者的地址，默认为hexString格式    
contract_address：要修改的合约的地址，默认为hexString格式    
origin_energy_limit：创建者设置的，在一次合约执行或创建过程中创建者自己消耗的最大的energy
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：TransactionExtention, TransactionExtention中包含未签名的交易Transaction

wallet/getdelegatedresource(Odyssey-v3.2开始支持)
作用：查看一个账户代理给另外一个账户的资源情况
demo: curl -X POST  http://127.0.0.1:8090/wallet/getdelegatedresource -d '
{
"fromAddress": "419844f7600e018fd0d710e2145351d607b3316ce9", 
"toAddress": "41c6600433381c731f22fc2b9f864b14fe518b322f"
}'
参数说明：
fromAddress：是要查询的账户地址，默认为hexString格式    
toAddress：代理对象的账户地址，默认为hexString格式    
返回值：账户的资源代理的列表，列表的元素为DelegatedResource

wallet/getdelegatedresourceaccountindex(Odyssey-v3.2开始支持)
作用：查看一个账户给哪些账户代理了资源
demo: curl -X POST  http://127.0.0.1:8090/wallet/getdelegatedresourceaccountindex -d '
{
"value": "419844f7600e018fd0d710e2145351d607b3316ce9", 
}'
参数说明：
value：是要查询的账户地址，默认为hexString格式    
返回值：账户的资源代理概况，结构为DelegatedResourceAccountIndex

wallet/getnodeinfo(Odyssey-v3.2.2开始支持)
作用：查看节点的信息
demo: curl  http://127.0.0.1:8090/wallet/getnodeinfo
返回值：节点当前状态的相关信息(省略)

wallet/setaccountid
作用：设置一个账户的accountID
demo: curl -X POST  http://127.0.0.1:8090/wallet/setaccountid -d '{	
"owner_address":"41a7d8a35b260395c14aa456297662092ba3b76fc0","account_id":"6161616162626262"}'
参数说明：
owner_address：是交易对创建者的地址，默认为hexString格式        
account_id 需要转为hexString   
返回值:设置AccountID的transaction   

wallet/getaccountbyid
作用：通过accountId查询一个账号的信息
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccountbyid -d 
'{"account_id":"6161616162626262"}'
参数说明：account_id 默认为hexString格式    
返回值：Account对象

wallet/getdeferredtransactionbyid
作用：通过ID查询延迟交易
demo: curl -X POST  http://127.0.0.1:8090/wallet/getdeferredtransactionbyid -d '{"value": "d5ec749ecc2a615399d8a6c864ea4c74ff9f523c2be0e341ac9be5d47d7c2d62"}'
参数说明：交易ID。
返回值：交易信息。

wallet/canceldeferredtransactionbyid
作用：通过ID查询延迟交易
demo: curl -X POST  http://127.0.0.1:8090/wallet/canceldeferredtransactionbyid -d '{
"transactionId":"34e6b6497b71100756790a7f20cd729376768dd2bebb6a4a9c5e87b920d5de10",
"ownerAddress":"41a7d8a35b260395c14aa456297662092ba3b76fc0"}'
参数说明：
owner_address：取消交易账户的地址，同时也是发起交易的账户地址，默认为hexString格式      
transactionId:交易ID  
返回值：交易信息。

wallet/getdeferredtransactioninfobyid
作用：根据id查询延迟交易的fee，所在的block
demo: curl -X POST  http://127.0.0.1:8090/wallet/getdeferredtransactioninfobyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
参数说明：value是交易id
返回值：Transaction的交易fee，所在block的高度，创建时间

wallet/triggerconstantcontract
作用：调用常量合约，产生的交易不上链
demo: curl -X POST  http://127.0.0.1:8090/wallet/triggerconstantcontract -d '{"contract_address":"4189139CB1387AF85E3D24E212A008AC974967E561","function_selector":"set(uint256,uint256)","parameter":"00000000000000000000000000000000000000000000000000000000000000010000000000000000000000000000000000000000000000000000000000000002","fee_limit":10,"call_value":100,"owner_address":"41D1E7A6BC354106CB410E65FF8B181C600FF14292"}'
参数说明：
contract_address，默认为hexString格式    
function_selector，函数签名，不能有空格
parameter：调用参数[1,2]的虚拟机格式，使用remix提供的js工具，将合约调用者调用的参数数组[1,2]转化为虚拟机所需要的参数格式
fee_limit：最大消耗的SUN（1TRX = 1,000,000SUN）
call_value：本次调用往合约转账的SUN（1TRX = 1,000,000SUN）
owner_address：发起triggercontract的账户地址，默认为hexString格式    
可选参数Permission_id，多重签名时使用，设置交易多重签名时使用的permissionId    
返回值：TransactionExtention, TransactionExtention中包含未签名的交易Transaction

wallet/clearabi
作用：设置一个账户的accountID
demo: curl -X POST  http://127.0.0.1:8090/wallet/clearabi -d '{	
"owner_address":"41a7d8a35b260395c14aa456297662092ba3b76fc0",
"contract_address":"417bcb781f4743afaacf9f9528f3ea903b3782339f"}'
参数说明：
owner_address：创建合约的账户地址，默认为hexString格式    
contract_address：合约地址,默认为hexString   
返回值:设置AccountID的transaction

wallet/addtransactionsign
作用：设置一个账户的accountID
demo: curl -X POST  http://127.0.0.1:8090/wallet/addtransactionsign -d '{	
"owner_address":"41a7d8a35b260395c14aa456297662092ba3b76fc0",
"contract_address":"417bcb781f4743afaacf9f9528f3ea903b3782339f"}'
参数说明：
owner_address：创建合约的账户地址，默认为hexString格式    
contract_address：合约地址,默认为hexString   
返回值:设置AccountID的transaction

wallet/getsignweight
作用：查询多重签名的交易的相关信息
demo: curl -X POST  http://127.0.0.1:8090/wallet/getsignweight -d '{"visible":true,
"signature
":["36c9d227b9dd6b6f377d018bb2df784be884f28c743dc97edfdaa8bd64b2ffb058bca24a4eb8b4543a052a4f353fee8cb9e606ff739c74d22f9451c7a35c8f5200"],"txID":"4d928f7adfbad5c82f5b8518a6f7b7c5e459d06d1cb5306c61fad8a793587d2d","raw_data":{"contract":[{"parameter":{"value":{"amount":1000000,"owner_address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","to_address":"TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract","Permission_id":2}],"ref_block_bytes":"0380","ref_block_hash":"6cdc8193f096be0f","expiration":1556249055000,"timestamp":1556248995694},"raw_data_hex":"0a02038022086cdc8193f096be0f40989eb0bda52d5a69080112630a2d747970652e676f6f676c65617069732e636f6d2f70726f746f636f6c2e5472616e73666572436f6e747261637412320a1541a7d8a35b260395c14aa456297662092ba3b76fc01215415a523b449890854c8fc460ab602df9f31fe4293f18c0843d280270eeceacbda52d"}'    
参数说明：
参数整体是一个完整的交易
返回值:已签名权重是否达到阈值（即是否满足验签标准），签名地址列表，permission的详细信息，已签名的权重及交易信息。

wallet/getapprovedlist
作用：查询多重签名的交易的相关信息
demo: curl -X POST  http://127.0.0.1:8090/wallet/getapprovedlist -d '{"visible":true,
"signature
":["36c9d227b9dd6b6f377d018bb2df784be884f28c743dc97edfdaa8bd64b2ffb058bca24a4eb8b4543a052a4f353fee8cb9e606ff739c74d22f9451c7a35c8f5200"],"txID":"4d928f7adfbad5c82f5b8518a6f7b7c5e459d06d1cb5306c61fad8a793587d2d","raw_data":{"contract":[{"parameter":{"value":{"amount":1000000,"owner_address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","to_address":"TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract","Permission_id":2}],"ref_block_bytes":"0380","ref_block_hash":"6cdc8193f096be0f","expiration":1556249055000,"timestamp":1556248995694},"raw_data_hex":"0a02038022086cdc8193f096be0f40989eb0bda52d5a69080112630a2d747970652e676f6f676c65617069732e636f6d2f70726f746f636f6c2e5472616e73666572436f6e747261637412320a1541a7d8a35b260395c14aa456297662092ba3b76fc01215415a523b449890854c8fc460ab602df9f31fe4293f18c0843d280270eeceacbda52d"}'    
参数整体是一个完整的交易
返回值:已签名权重是否达到阈值（即是否满足验签标准），签名地址列表，交易信息。

wallet/accountpermissionupdate
作用：为账户创建多重签名
demo: curl -X POST  http://127.0.0.1:8090/wallet/accountpermissionupdate -d 
'{"owner_address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","owner":{"type":0,
"permission_name":"owner","threshold":1,"keys":[{"address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ",
"weight":1}]},"witness":{"type":1,"permission_name":"witness","threshold":1,
"keys":[{"address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","weight":1}]},"actives":[{"type":2,"permission_name":"active12323","threshold":2,"operations":"7fff1fc0033e0000000000000000000000000000000000000000000000000000","keys":[{"address":"TNhXo1GbRNCuorvYu5JFWN3m2NYr9QQpVR","weight":1},{"address":"TKwhcDup8L2PH5r6hxp5CQvQzZqJLmKvZP","weight":1}]}],"visible":true}'    
参数说明：
owner_address：创建合约的账户地址，默认为hexString格式    
owner：账户owner权限的分配信息    
witness：出块前线的分配信息，如果不是witness，不需要设置   
actives：其他功能权限的分配信息      
返回值:账户创建多重签名的transaction       

```
