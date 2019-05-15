#  TRON Built-in Http Introduction
## HexString and Base58check Transcode Demo
JAVA:  
[https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java#L92](https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java#L92)   
PHP:  
[https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/index.php](https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/index.php)   

**Since v3.6, parameter 'visible' is added, when 'visible' is set true, no need to transcode the relevant address and string. This parameter is valid for all api, including solidityNode api and FullNode api.**    

When 'visible' is set true, the format of the input address must be base58, input string must text string, so does the format of the output. If 'visible' is set false or null, the api acts the same as previous version. If the format of the parameters do not match with the set of visible, it will throw out an error.   

Way to set the 'visible' parameter:    

1.&nbsp;For the api need no parameter: by adding 'visible' parameter in the url  

+ example:
```text
http://127.0.0.1:8090/wallet/listexchanges?visible=true     
```
2.&nbsp;For POST method api: By adding 'visible' parameter to the most out layer of the json  

+ example:
```text
curl -X POST http://127.0.0.1:8090/wallet/createtransaction 

{"owner_address_":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ", "to_address_":"TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW", "amount":1000000, "visible":true}  
```
3.&nbsp;For GET method api: By adding 'visible' parameter in the url, as way 1  

    
## SolidityNode Api Introduction

SolidityNode api's default http port is 8091, when solidityNode is started, http service will be started too.
```text
/walletsolidity/getaccount
Description: Query an account information
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getaccount -d '{"address": "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}'
Parameter address: Default hexString
Return: Account object

/walletsolidity/listwitnesses
Description: Qyery the list of the witnesses
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/listwitnesses
Parameter: No parameter
Return: The list of all the witnesses

/walletsolidity/getassetissuelist
Description: Query the list of all the tokens
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuelist 
Parameter: No parameter
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
Return: Token object
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
Parameter: No parameter
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
Parameter: No parameter
Return: The list of all the exchange pairs

/walletsolidity/getaccountbyid
Description: Query an account information by account id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getaccountbyid -d '{"account_id":"6161616162626262"}'
Parameter account_id: Account id, default hexString
Return: Account object

/walletsolidity/getblockbyid
Description: Query a block information by block id 
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getblockbyid-d '{"value": 
"0000000000038809c59ee8409a3b6c051e369ef1096603c7ee723c16e2376c73"}'
Parameter value: Block id 
Return: Block object

/walletsolidity/getblockbylimitnext
Description: Query a list of blocks by range
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getblockbylimitnext -d '{"startNum": 1, "endNum": 2}'
Parameter startNum: The start block height, itself included
Parameter endNum: The end block height, itself not included
Return: The list of the blocks

/walletsolidity/getblockbylatestnum
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
Parameter: No parameter
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

## FullNode Api Introduction
FullNode api's default http port is 8090, when FullNode is started, http service will be started too.

```text
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
Parameter: No parameter
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
Return: Token object
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
Parameter: No parameter
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
Return: Account object

wallet/listwitnesses
Description: Qyery the list of the witnesses
demo: curl -X POST  http://127.0.0.1:8090/wallet/listwitnesses
Parameter: No parameter
Return: The list of all the witnesses

wallet/getassetissuelist
Description: Query the list of all the tokens
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuelist 
Parameter: No parameter
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
Parameter call_token_value: The amount of  trc10 token transfer to the contract for each call (Optional)  
Parameter token_id: The id of trc10 token transfer to the contract (Optional)  
Parameter owner_address: Owner address of the contract, default hexString  
Parameter name: Contract name
Parameter origin_energy_limit: The maximum resource consumption of the creator in one execution or creation 
Parameter permission_id: Optional, for multi-signature use    
Return: Transaction object
Note: The unit of TRX in the parameters is SUN

wallet/triggersmartcontract
Description: Trigger smart contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/triggersmartcontract -d '{"contract_address":"4189139CB1387AF85E3D24E212A008AC974967E561","function_selector":"set(uint256,uint256)","parameter":"00000000000000000000000000000000000000000000000000000000000000010000000000000000000000000000000000000000000000000000000000000002","fee_limit":10,"call_value":100,"owner_address":"41D1E7A6BC354106CB410E65FF8B181C600FF14292"}'
Parameter contract_address: Contract address, default hexString    
Parameter function_selector: Function call, must not leave a blank space
Parameter parameter: The parameter passed to 'function_selector', the format must match with the VM's requirement. You can use a js tool provided by remix to convert a parameter like [1,2] to the format that VM requires
Parameter fee_limit: The maximum TRX burns for resource consumption
Parameter call_value: The TRX transfer to the contract for each call
Parameter call_token_value: The amount of  trc10 token transfer to the contract for each call   
Parameter token_id: The id of trc10 token transfer to the contract   
Parameter owner_address: Owner address that triggers the contract, default hexString   
Parameter permission_id: Optional, for multi-signature use     
Return: Transaction object
Note: The unit of TRX in the parameters is SUN

wallet/getcontract
Description: Query a contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/getcontract -d '{"value":"4189139CB1387AF85E3D24E212A008AC974967E561"}'
Parameter value: Contract address, default hexString   
Return: Smart contract object

wallet/proposalcreate
Description: Create a proposal
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposalcreate -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9","parameters":[{"key": 0,"value": 100000},{"key": 1,"value": 2}] }
Parameter owner_address: Creator address
Parameter parameters: Proposal parameters
Parameter permission_id: Optional, for multi-signature use      
Return: Transaction object

wallet/getproposalbyid
Description: Query a proposal by proposal id
demo: curl -X POST  http://127.0.0.1:8090/wallet/getproposalbyid -d {"id":1}
Parameter id: Proposal id
Return: The proposal information

wallet/listproposals
Description: Query all the proposals
demo: curl -X POST  http://127.0.0.1:8090/wallet/listproposals
Parameter: No parameter
Return: The list of all the proposals

wallet/proposalapprove
Description: To approve a proposal
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposalapprove -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9", "proposal_id":1, "is_add_approval":true}
Parameter owner_address: The address that makes the approve action, default hexString   
Parameter proposal_id: Proposal id
Parameter is_add_approval: Whether to approve
Parameter permission_id: Optional, for multi-signature use    
Return: Transaction object

wallet/proposaldelete
Description: To delete a proposal
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposaldelete -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9", "proposal_id":1}
Parameter owner_address: Owner address of the proposal, default hexString   
Parameter proposal_id: Proposal id
Parameter permission_id: Optional, for multi-signature use       
Return: Transaction object

wallet/getaccountresource
Description: Query the resource information of an account
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccountresource -d {"address" : "419844f7600e018fd0d710e2145351d607b3316ce9"}
Parameter address: Address, default hexString  
Return: The resource information

wallet/exchangecreate
Description: Create an exchange pair
demo: curl -X POST  http://127.0.0.1:8090/wallet/exchangecreate -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", 、
"first_token_id":token_a, "first_token_balance":100, "second_token_id":token_b,"second_token_balance":200}
Parameter first_token_id: The first token's id, default hexString    
Parameter first_token_balance: The first token's balance
Parameter second_token_id: The second token's id, default hexString    
Parameter second_token_balance: The second token's balance
Parameter permission_id: Optional, for multi-signature use      
Return: Transaction object
Note: The unit of 'first_token_balance' and 'second_token_balance' is the smallest unit of the token

wallet/exchangeinject
Description: Inject funds for exchange pair
demo: curl -X POST  http://127.0.0.1:8090/wallet/exchangeinject -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100}
Parameter owner_address: Owner address of the exchange pair, default hexString    
Parameter exchange_id: Exchange pair id
Parameter token_id: Token id, default hexString  
Parameter quant: Token inject amount
Parameter permission_id: Optional, for multi-signature use   
Return: Transaction object
Note: The unit of 'quant' is the smallest unit of the token

wallet/exchangewithdraw
Description: Withdraw from exchange pair
demo: curl -X POST  http://127.0.0.1:8090/wallet/exchangewithdraw -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100}
Parameter owner_address: Owner address of the exchange pair, default hexString    
Parameter exchange_id: Exchange pair id
Parameter token_id: Token id, default hexString
Parameter quant: Token withdraw amount
Parameter permission_id: Optional, for multi-signature use      
Return: Transaction object
Note: The unit of 'quant' is the smallest unit of the token

wallet/exchangetransaction
Description: Participate the transaction of exchange pair
demo: curl -X POST  http://127.0.0.1:8090/wallet/exchangetransaction -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100,"expected":10}
Parameter owner_address: Owner address of the exchange pair, default hexString       
Parameter exchange_id: Exchange pair id
Parameter token_id: Token id, default hexString    
Parameter quant: Sell token amount
Parameter expected: Expected token amount to get
Parameter permission_id: Optional, for multi-signature use       
Return: Transaction object
Note: The unit of 'quant' and 'expected' is the smallest unit of the token

wallet/getexchangebyid
Description: Query an exchange pair by exchange pair id
demo: curl -X POST  http://127.0.0.1:8090/wallet/getexchangebyid -d {"id":1}
Parameter id: Exchange pair id
return: Exchange pair information

wallet/listexchanges
Description: Query the list of all the exchange pairs
demo: curl -X POST  http://127.0.0.1:8090/wallet/listexchanges
Parameter: No parameter
Return: The list of all the exchange pairs

wallet/getchainparameters
Description: Query the parameters of the blockchain used for witnessses to create a proposal
demo: curl -X POST  http://127.0.0.1:8090/wallet/getchainparameters 
Parameter: No parameter
Return: The list of parameters of the blockchain

wallet/updatesetting
Description: Update the consume_user_resource_percent parameter of a smart contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/updatesetting -d '{"owner_address": "419844f7600e018fd0d710e2145351d607b3316ce9", "contract_address": "41c6600433381c731f22fc2b9f864b14fe518b322f", "consume_user_resource_percent": 7}'
Parameter owner_address: Owner address of the smart contract, default hexString   
Parameter contract_address: Smart contract address, default hexString   
Parameter consume_user_resource_percent: Consume user's resource percentage
Parameter permission_id: Optional, for multi-signature use    
Return: Transaction object

wallet/updateenergylimit
Description: Update the origin_energy_limit parameter of a smart contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/updatesetting -d '{"owner_address": "419844f7600e018fd0d710e2145351d607b3316ce9", "contract_address": "41c6600433381c731f22fc2b9f864b14fe518b322f", "origin_energy_limit": 7}'
Parameter owner_address: Owner address of the smart contract, default hexString    
Parameter contract_address: Smart contract address, default hexString    
Parameter origin_energy_limit: The maximum resource consumption of the creator in one execution or creation
Parameter permission_id: Optional, for multi-signature use    
Return: Transaction object

wallet/getdelegatedresource(Since Odyssey-v3.2)
Description: Query the energy delegation information
demo: curl -X POST  http://127.0.0.1:8090/wallet/getdelegatedresource -d '
{
"fromAddress": "419844f7600e018fd0d710e2145351d607b3316ce9",
"toAddress": "41c6600433381c731f22fc2b9f864b14fe518b322f"
}'
Parameter fromAddress: Energy from address, default hexString
Parameter toAddress: Energy to address, default hexString
Return: Energy delegation information

wallet/getdelegatedresourceaccountindex(Since Odyssey-v3.2)
Description: Query the energy delegation index by an account
demo: curl -X POST  http://127.0.0.1:8090/wallet/getdelegatedresourceaccountindex -d '
{
"value": "419844f7600e018fd0d710e2145351d607b3316ce9", 
}'
Parameter value: Address, default hexString
Return: Energy delegation index

wallet/getnodeinfo(Since Odyssey-v3.2)
Description: Query the current node infromation
demo: curl -X GET http://127.0.0.1:8090/wallet/getnodeinfo 
Parameter: No Parameter
Return: The node information

wallet/setaccountid
Description: To set an account id for an account
demo: curl -X POST  http://127.0.0.1:8090/wallet/setaccountid -d '{	
"owner_address":"41a7d8a35b260395c14aa456297662092ba3b76fc0","account_id":"6161616162626262"}'
Parameter owner_address: Owner address, default hexString       
Parameter account_id: Account id, default hexString   
Return: Transaction object  

wallet/getaccountbyid
Description: Query an account information by account id
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccountbyid -d '{"account_id":"6161616162626262"}'
Parameter account_id: Account id, default hexString
Return: Account object

wallet/getdeferredtransactionbyid
Description: Query the deferred transaction infromation by transaction id
demo: curl -X POST  http://127.0.0.1:8090/wallet/getdeferredtransactionbyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameter value: Transaction id
Return: Deferred transaction object

wallet/canceldeferredtransactionbyid
Description: Query a deferred transaction by transaction id
demo: curl -X POST  http://127.0.0.1:8090/wallet/canceldeferredtransactionbyid -d '{
"transactionId":"34e6b6497b71100756790a7f20cd729376768dd2bebb6a4a9c5e87b920d5de10",
"ownerAddress":"41a7d8a35b260395c14aa456297662092ba3b76fc0"}'
Parameter owner_address: Owner address of the transaction, default hexString     
Parameter transactionId: Transaction id  
Return: Transaction object

wallet/getdeferredtransactioninfobyid
Description: Query the deferred transaction fee, block height by transaction id
demo: curl -X POST  http://127.0.0.1:8090/wallet/getdeferredtransactioninfobyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameter value: Transaction id
Return: Deferred transaction fee & block height

wallet/triggerconstantcontract
Description: Trigger the constant of the smart contract, the transaction is off the blockchain
demo: curl -X POST  http://127.0.0.1:8090/wallet/triggerconstantcontract -d '{"contract_address":"4189139CB1387AF85E3D24E212A008AC974967E561","function_selector":"set(uint256,uint256)","parameter":"00000000000000000000000000000000000000000000000000000000000000010000000000000000000000000000000000000000000000000000000000000002","fee_limit":10,"call_value":100,"owner_address":"41D1E7A6BC354106CB410E65FF8B181C600FF14292"}'
Parameter contract_address: Smart contract address, defualt hexString   
Parameter function_selector:  Function call, must not leave a blank space
Parameter parameter: The parameter passed to 'function_selector', the format must match with the VM's requirement. You can use a hs tool provided by remix to convert a parameter like [1,2] to the format that VM requires
Parameter fee_limit: The maximum TRX burns for resource consumption
Parameter call_value: The TRX transfer to the contract for each call
Parameter owner_address: Owner address that triggers the contract, default hexString    
Parameter permission_id: Optional, for multi-signature use     
Return: Transaction object
Note: The unit of TRX in the parameters is SUN

wallet/clearabi
Description: To clear the abi of a smart contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/clearabi -d '{	
"owner_address":"41a7d8a35b260395c14aa456297662092ba3b76fc0",
"contract_address":"417bcb781f4743afaacf9f9528f3ea903b3782339f"}'
Parameter owner_address: Owner address of the smart contract   
Parameter contract_address: Smart contract address, default hexString      
Return: Transaction object

wallet/addtransactionsign
Description: To sign the transaction of trigger constant contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/addtransactionsign -d '{	
"owner_address":"41a7d8a35b260395c14aa456297662092ba3b76fc0",
"contract_address":"417bcb781f4743afaacf9f9528f3ea903b3782339f"}'
Parameter owner_address: Owner address of the smart contract     
Parameter contract_address: Smart contract address, default hexString  
Return: Transaction object after sign

wallet/getsignweight
Description: Query the current signatures total weight of a transaction after sign
demo: curl -X POST  http://127.0.0.1:8090/wallet/getsignweight -d '{"visible":true,
"signature
":["36c9d227b9dd6b6f377d018bb2df784be884f28c743dc97edfdaa8bd64b2ffb058bca24a4eb8b4543a052a4f353fee8cb9e606ff739c74d22f9451c7a35c8f5200"],"txID":"4d928f7adfbad5c82f5b8518a6f7b7c5e459d06d1cb5306c61fad8a793587d2d","raw_data":{"contract":[{"parameter":{"value":{"amount":1000000,"owner_address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","to_address":"TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract","Permission_id":2}],"ref_block_bytes":"0380","ref_block_hash":"6cdc8193f096be0f","expiration":1556249055000,"timestamp":1556248995694},"raw_data_hex":"0a02038022086cdc8193f096be0f40989eb0bda52d5a69080112630a2d747970652e676f6f676c65617069732e636f6d2f70726f746f636f6c2e5472616e73666572436f6e747261637412320a1541a7d8a35b260395c14aa456297662092ba3b76fc01215415a523b449890854c8fc460ab602df9f31fe4293f18c0843d280270eeceacbda52d"}'    
Parameter: Transaction object after sign
Return: The current signatures total weight

wallet/getapprovedlist
Description: Query the signatures list of a transaction after sign
demo: curl -X POST  http://127.0.0.1:8090/wallet/getapprovedlist -d '{"visible":true,
"signature
":["36c9d227b9dd6b6f377d018bb2df784be884f28c743dc97edfdaa8bd64b2ffb058bca24a4eb8b4543a052a4f353fee8cb9e606ff739c74d22f9451c7a35c8f5200"],"txID":"4d928f7adfbad5c82f5b8518a6f7b7c5e459d06d1cb5306c61fad8a793587d2d","raw_data":{"contract":[{"parameter":{"value":{"amount":1000000,"owner_address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","to_address":"TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract","Permission_id":2}],"ref_block_bytes":"0380","ref_block_hash":"6cdc8193f096be0f","expiration":1556249055000,"timestamp":1556248995694},"raw_data_hex":"0a02038022086cdc8193f096be0f40989eb0bda52d5a69080112630a2d747970652e676f6f676c65617069732e636f6d2f70726f746f636f6c2e5472616e73666572436f6e747261637412320a1541a7d8a35b260395c14aa456297662092ba3b76fc01215415a523b449890854c8fc460ab602df9f31fe4293f18c0843d280270eeceacbda52d"}'    
Parameter: Transaction object after sign
Return: The list of the signatures

wallet/accountpermissionupdate
Description: To set multi-signature for an account
demo: curl -X POST  http://127.0.0.1:8090/wallet/accountpermissionupdate -d 
'{"owner_address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","owner":{"type":0,
"permission_name":"owner","threshold":1,"keys":[{"address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ",
"weight":1}]},"witness":{"type":1,"permission_name":"witness","threshold":1,
"keys":[{"address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","weight":1}]},"actives":[{"type":2,"permission_name":"active12323","threshold":2,"operations":"7fff1fc0033e0000000000000000000000000000000000000000000000000000","keys":[{"address":"TNhXo1GbRNCuorvYu5JFWN3m2NYr9QQpVR","weight":1},{"address":"TKwhcDup8L2PH5r6hxp5CQvQzZqJLmKvZP","weight":1}]}],"visible":true}'    
Parameter owner_address: Owner address of the account, default hexString   
Parameter owner: Account owner permission     
Parameter witness: Account witness permission, only for witness  
Parameter actives: Operation permission     
Return: Transaction object      

```
