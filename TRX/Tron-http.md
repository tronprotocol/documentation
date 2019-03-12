#  TRON HTTP Gateway interface

# Demo of the conversion between base58check and hexString
java:
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java#L92

php:
https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/index.php

Available in the latest release of java-tron. 

Configure the ports for the nodes by modifying these ports in both configuration files.

```

  node {
  ...
    http {
      fullNodePort = 8090
      solidityPort = 8091
    }
```

# SolidityNode Interface
The default http port on solidityNode is 8091.
```
/walletsolidity/getaccount
Function：Query information about an account
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getaccount -d '{"address": "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}'
Parameters：address should be converted to a hex string
Return value：Account Object

/walletsolidity/listwitnesses
Function：Query the list of super representatives
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/listwitnesses
Parameters：None
Return value：List of all super representatives

/walletsolidity/getassetissuelist
Function：Query the list of Tokens
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuelist 
Parameters：None
Return value：List of all Tokens

/walletsolidity/getpaginatedassetissuelist
Function：Query the list of Tokens with pagination
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getpaginatedassetissuelist -d '{"offset": 0, "limit":10}'
Parameters：Offset is the index of the starting Token, and limit is the number of Tokens expected to be returned.
Return value：List of Tokens

/walletsolidity/getassetissuebyname(will not be supported until Odyssey-v3.2)
Function：Query token by name.
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuebyname -d '{"value": "44756354616E"}'
Parameters：The name of the token, converted to a hex string
Return value：token.
Note: From Odyssey-v3.2, it is recommended to use getassetissuebyid or getassetissuelistbyname instead of this api, because it will support the same token name from 3.2, this api will return error msg if there are two or more assets with the same name.

/walletsolidity/getassetissuelistbyname(will not be supported until Odyssey-v3.2)
Function：Query token list by name.
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuelistbyname -d '{"value": "44756354616E"}'
Parameters：The name of the token, converted to a hex string
Return value：List of tokens.

/walletsolidity/getassetissuebyid(will not be supported until Odyssey-v3.2)
Function：Query token by id.
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuebyid -d '{"value": "1000001"}'
Parameters：The id of the token, it's a string
Return value：token.

/walletsolidity/getnowblock
Function：Query the latest block
demo: curl -X POST http://127.0.0.1:8091/walletsolidity/getnowblock
Parameters：None
Return value：Latest block on solidityNode

/walletsolidity/getblockbynum
Function：Query block by height
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getblockbynum -d '{"num" : 100}' 
Parameters：Num is the height of the block
Return value：specified Block object

/walletsolidity/gettransactionbyid
Function：Query transaction based on id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactionbyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameters：value is the transaction id，converted to a hex string
Return value：specified Transaction object

/walletsolidity/gettransactioncountbyblocknum(will not be supported until Odyssey-v3.2)
Function：Query transaction's count on a specified block by height
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactioncountbyblocknum -d '{"num" : 100}' 
Parameters：Num is the height of the block.
Return value：Transaction count.

/walletsolidity/gettransactioninfobyid
Function：Query transaction fee based on id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactioninfobyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameters：value is the transaction id，converted to a hex string
Return value：Transaction fee，block height and block creation time

/walletsolidity/getexchangebyid(will not be supported until Odyssey-v3.2)
Function：Query exchange based on id
demo：curl -X POST  http://127.0.0.1:8091/walletsolidity/getexchangebyid -d {"id":1}
Parameters: id is the exchange id, a long
Return value：exchange

/walletsolidity/listexchanges(will not be supported until Odyssey-v3.2)
Function：Query all exchanges
demo：curl -X POST  http://127.0.0.1:8091/walletsolidity/listexchanges
Parameters: None
Return value：List of all exchanges

/walletextension/gettransactionsfromthis(The new version will no longer be supported)
Function：Query the list of transactions sent by an address
demo: curl -X POST  http://127.0.0.1:8091/walletextension/gettransactionsfromthis -d '{"account" 
  : {"address" : "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}, "offset": 0, "limit": 10,"startTime": 1546099200000, "endTime": 1552028828000}'
Parameters：Address is the account address, converted to a hex string; offset is the index of the 
starting transaction,Can't be greater than 10000, otherwise an error; limit is the number of 
transactions expected to be returned;This value may be adjusted. If limit>50 or 
offset+limit>10000, adjust to limit<=50 and offset+limit<=10000, startTime: Start time; endTime: End time;
 get the transaction  from startTime to endTime] . If not set, the default  will gets the transaction in the last 7 days.
Return value：Transactions list sort by  creation time, total: the maximum number of transactions 
for paging from startTime to endTime, rangeTotal:the total transactions from startTime to endTime.
Remarks:This interface will no longer be available in the new version of the node. If you need 
this function, you can use the interface provided by the central node, 47.90.247
.237:8091/walletextension/gettransactionsfromthis,Reference getTransactionsFromThis

/walletextension/gettransactionstothis(The new version will no longer be supported)
Function：Query the list of transactions received by an address
demo: curl -X POST  http://127.0.0.1:8091/walletextension/gettransactionstothis -d '{"account" : 
 {"address" : "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}, "offset": 0, "limit": 10,"startTime": 1546099200000, "endTime": 1552028828000}'
Parameters：Address is the account address, converted to a hex string; offset is the index of the 
starting transaction,Can't be greater than 10000, otherwise an error; limit is the number of 
transactions expected to be returned;This value may be adjusted. If limit>50 or  
offset+limit>10000, adjust to limit<=50 and offset+limit<=10000, startTime: Start time; endTime: 
End time; get the transaction from startTime to endTime]. If not set, the default  will gets the 
transaction in the last 7 days.Return value：Transactions list sort by  creation time, total: the maximum number of transactions for paging from startTime to endTime, rangeTotal:the total transactions from startTime to endTime.
Return value：Transactions list sort by  creation time, total: the maximum number of transactions 
for paging from startTime to endTime, rangeTotal:the total transactions from startTime to endTime.
Remarks:This interface will no longer be available in the new version of the node. If you need 
this function, you can use the interface provided by the central node, 47.90.247
.237:8091/walletextension/gettransactionstothis,Reference gettransactionstothis

```

# FullNode Interface
The default http port on FullNode is 8090.

```

/wallet/createtransaction
Function：Creates a transaction of transfer. If the recipient address does not exist, a corresponding account will be created on the blockchain.
demo: curl -X POST  http://127.0.0.1:8090/wallet/createtransaction -d '{"to_address": "41e9d79cc47518930bc322d9bf7cddd260a0260a8d", "owner_address": "41D1E7A6BC354106CB410E65FF8B181C600FF14292", "amount": 1000 }'
Parameters：To_address is the transfer address, converted to a hex string; owner_address is the transfer transfer address, converted to  a hex string; amount is the transfer amount
Return value：Transaction contract data

/wallet/gettransactionsign
Function：Sign the transaction, the api has the risk of leaking the private key, please make sure to call the api in a secure environment
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactionsign -d '{
"transaction" : {"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}},"privateKey": "your private key"}
}'
Parameters：Transaction is a contract created by http api, privateKey is the user private key
Return value：Signed Transaction contract data

/wallet/broadcasttransaction
Function：Broadcast the signed transaction
demo：curl -X POST  http://127.0.0.1:8090/wallet/broadcasttransaction -d '{"signature":["97c825b41c77de2a8bd65b3df55cd4c0df59c307c0187e42321dcc1cc455ddba583dd9502e17cfec5945b34cad0511985a6165999092a6dec84c2bdd97e649fc01"],"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}}'
Parameters：Signed Transaction contract data
Return value：broadcast success or failure

/wallet/updateaccount
Function：Modify account name
demo：curl -X POST  http://127.0.0.1:8090/wallet/updateaccount -d '{"account_name": "0x7570646174654e616d6531353330383933343635353139" ,"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"}'
Parameters：account_name is the name of the account, converted into a hex string；owner_address is the account address of the name to be modified, converted to a hex string.
Return value：modified Transaction Object

/wallet/votewitnessaccount
Function：Vote on the super representative
demo：curl -X POST  http://127.0.0.1:8090/wallet/votewitnessaccount -d '{
"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", 
"votes": [{"vote_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "vote_count": 5}]
}'
Parameters：Owner_address is the voter address, converted to a hex string; votes.vote_address is the address of the super delegate being voted, converted to a hex string; vote_count is the number of votes

/wallet/createassetissue
Function：Issue Token
demo：curl -X POST  http://127.0.0.1:8090/wallet/createassetissue -d '{
"owner_address":"",
"name":"{{assetIssueName}}",
"abbr": "{{abbrName}}",
"total_supply" :4321,
"trx_num":1,
"num":1,
"start_time" :{{startTime}},
"end_time":{{endTime}},
"vote_score":2,
"description":"007570646174654e616d6531353330363038383733343633",
"url":"007570646174654e616d6531353330363038383733343633",
"free_asset_net_limit":10000,
"public_free_asset_net_limit":10000,
"frozen_supply":{"frozen_amount":1, "frozen_days":2}
}'


/wallet/createaccount
Function：Create an account. Uses an already activated account to create a new account
demo：curl -X POST  http://127.0.0.1:8090/wallet/createaccount -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "account_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0"}'
Parameters：Owner_address is an activated account，converted to a hex String; account_address is the address of the new account, converted to a hex string, this address needs to be calculated in advance
Return value：Create account Transaction raw data

/wallet/createwitness
Function：Apply to become a super representative
demo：curl -X POST  http://127.0.0.1:8090/wallet/createwitness -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "url": "007570646174654e616d6531353330363038383733343633"}'
Parameters：owner_address is the account address of the applicant，converted to a hex string；url is the official website address，converted to a hex string
Return value：Super Representative application Transaction raw data

/wallet/transferasset
Function：Transfer Token
demo：curl -X POST  http://127.0.0.1:8090/wallet/transferasset -d '{"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", "to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "asset_name": "6173736574497373756531353330383934333132313538", "amount": 100}'
Parameters：Owner_address is the address of the withdrawal account, converted to a hex string；To_address is the recipient address，converted to a hex string；asset_name is the Token Name(NOT SYMBOL)，converted to a hex string；Amount is the amount of token to transfer
Return value：Token transfer Transaction raw data

/wallet/easytransfer
Function: Easily transfer from an address using the password string. Only works with accounts created from createAddress
Demo: curl -X POST http://127.0.0.1:8090/wallet/easytransfer -d '{"passPhrase": "7465737470617373776f7264","toAddress": "41D1E7A6BC354106CB410E65FF8B181C600FF14292", "amount":10}'
Parameters: passPhrase is the password, converted from ascii to hex. toAddress is the recipient address, converted into a hex string; amount is the amount of TRX to transfer expressed in SUN.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

/wallet/easytransferbyprivate
Function：Easily transfer from an address using the private key. 
demo: curl -X POST  http://127.0.0.1:8090/wallet/easytransferbyprivate -d '{"privateKey": "D95611A9AF2A2A45359106222ED1AFED48853D9A44DEFF8DC7913F5CBA727366", "toAddress":"4112E621D5577311998708F4D7B9F71F86DAE138B5","amount":10000}'
Parameters：passPhrase is the private key in hex string format. toAddress is the recipient address, converted into a hex string; amount is the amount of TRX to transfer in SUN.
Return value： transaction, including execution results.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

/wallet/createaddress
Function: Create address from a specified password string (NOT PRIVATE KEY)
Demo: curl -X POST http://127.0.0.1:8090/wallet/createaddress -d '{"value": "7465737470617373776f7264" }'
Parameters: value is the password, converted from ascii to hex
Return value：value is the corresponding address for the password, encoded in hex. Convert it to base58 to use as the address.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

/wallet/generateaddress
Function: Generates a random private key and address pair
demo：curl -X POST -k http://127.0.0.1:8090/wallet/generateaddress
Parameters: no parameters.
Return value：value is the corresponding address for the password, encoded in hex. Convert it to base58 to use as the address.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

/wallet/participateassetissue
Function：Purchase a Token
demo：curl -X POST http://127.0.0.1:8090/wallet/participateassetissue -d '{
"to_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0",
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1", 
"amount":100, 
"asset_name":"3230313271756265696a696e67"
}'
Parameters：
to_address is the address of the Token issuer，converted to a hex string
owner_address is the address of the Token owner，converted to a hex string
amount is the number of tokens created
asset_name is the name of the token，converted to a hex string
Return value：Token creation Transaction raw data

/wallet/freezebalance
Function：Freezes an amount of TRX. Will give bandwidth OR Energy and TRON Power(voting rights) to the owner of the frozen tokens.
demo：curl -X POST http://127.0.0.1:8090/wallet/freezebalance -d '{
"owner_address":"41D1E7A6BC354106CB410E65FF8B181C600FF14294", 
"frozen_balance": 10000,
"frozen_duration": 3,
"resource":"ENERGY"
}'
Parameters：
owner_address is the address that is freezing trx account，converted to a hex string
frozen_balance is the number of frozen trx
frozen_duration is the duration in days to be frozen
resource is the type of resource you're freezing for. must be either "ENERGY" or "BANDWIDTH"
Return value：Freeze trx transaction raw data

/wallet/unfreezebalance
Function：Unfreeze TRX that has passed the minimum freeze duration. Unfreezing will remove bandwidth and TRON Power.
demo：curl -X POST http://127.0.0.1:8090/wallet/unfreezebalance -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
}'
Parameters：
owner_address address to unfreeze TRX for，converted to a hex string
Return value：Unfreeze TRX transaction raw data

/wallet/unfreezeasset
Function：Unfreeze a token that has passed the minimum freeze duration.
demo：curl -X POST http://127.0.0.1:8090/wallet/unfreezeasset -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
}'
Parameters：
owner_address address to unfreeze Tokens for，converted to a hex string
Return value：Unfreeze Token transaction raw data

/wallet/withdrawbalance
Function：Withdraw Super Representative rewards, useable every 24 hours.
demo：curl -X POST http://127.0.0.1:8090/wallet/withdrawbalance -d '{
"owner_address":"41e472f387585c2b58bc2c9bb4492bc1f17342cd1",
}'
Parameters：
owner_address is the address to withdraw from，converted to a hex string
Return value：Withdraw TRX transaction raw data

/wallet/updateasset
Function：Update a Token's information
demo：curl -X POST http://127.0.0.1:8090/wallet/updateasset -d '{"owner_address":"4116440834509C59DE4EE6BA4933678626F451BEFE", "url":"687474", "description":"57732e", "new_limit":1000000, "new_public_limit":1000}'
Parameters：
Owner_address is the address of the token issuer, converted to a hex string
Description is a description of the token, converted to a hex string
Url is the official website address of the token issuer, converted to a hex string
New_limit is the Token Creator's bandwidth avaible for use by holders of the token.
New_public_limit is the free bandwidth that each holder of the token can use for free. This will subtract from the Token Creator's available bandwidth.
Return value: Token update transaction raw data

/wallet/listnodes
Function：List the nodes which the api fullnode is connecting on the network
demo: curl -X POST  http://127.0.0.1:8090/wallet/listnodes
Parameters：None
Return value：List of nodes

/wallet/getassetissuebyaccount
Function：List the tokens issued by an account.
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuebyaccount -d '{"address": "41F9395ED64A6E1D4ED37CD17C75A1D247223CAF2D"}'
Parameters：Token issuer account address，converted to a hex string
Return value：The token issued by the account. An account can issue only one token.

/wallet/getaccountnet
Function：Query bandwidth information.
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccountnet -d '{"address": "4112E621D5577311998708F4D7B9F71F86DAE138B5"}'
Parameters：Account address，converted to a hex string
Return value：Bandwidth information for the account. If a field doesn't appear, then the corresponding value is 0. {"freeNetUsed": 557,"freeNetLimit": 5000,"NetUsed": 353,"NetLimit": 5239157853,"TotalNetLimit": 43200000000,"TotalNetWeight": 41228}

/wallet/getassetissuebyname
Function：Query token by name.
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuebyname -d '{"value": "44756354616E"}'
Parameters：The name of the token, converted to a hex string
Return value：token.
Note: From Odyssey-v3.2, it is recommended to use getassetissuebyid or getassetissuelistbyname instead of this api, because it will support the same token name from 3.2, this api will return error msg if there are two or more assets with the same name.

/wallet/getassetissuelistbyname(will not be supported until Odyssey-v3.2)
Function：Query token list by name.
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuelistbyname -d '{"value": "44756354616E"}'
Parameters：The name of the token, converted to a hex string
Return value：List of tokens.

/wallet/getassetissuebyid(will not be supported until Odyssey-v3.2)
Function：Query token by id.
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuebyid -d '{"value": "1000001"}'
Parameters：The id of the token, it's a string
Return value：token.

/wallet/getnowblock
Function：Query the latest block
demo: curl -X POST  http://127.0.0.1:8090/wallet/getnowblock
Parameters：None
Return value：Latest block on full node

/wallet/getblockbynum
Function：Query block by height
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbynum -d '{"num" : 100}' 
Parameters：Num is the height of the block
Return value：specified Block object

/wallet/getblockbyid
Function：Query block by ID
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbyid -d '{"value": "0000000000038809c59ee8409a3b6c051e369ef1096603c7ee723c16e2376c73"}'
Parameters：Block ID.
Return value：Block Object

/wallet/getblockbylimitnext
Function：Query a range of blocks by block height
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbylimitnext -d '{"startNum": 1, "endNum": 2}'
Parameters：
   startNum：Starting block height, including this block
   endNum：Ending block height, excluding that block
Return value：A list of Block Objects

/wallet/getblockbylatestnum
Function：Query the latest blocks
demo: curl -X POST  http://127.0.0.1:8090/wallet/getblockbylatestnum -d '{"num": 5}'
Parameters：The number of blocks to query
Return value：A list of Block Objects

/wallet/gettransactionbyid
Function：Query transaction by ID
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactionbyid -d '{"value": "d5ec749ecc2a615399d8a6c864ea4c74ff9f523c2be0e341ac9be5d47d7c2d62"}'
Parameters：Transaction ID.
Return value：Transaction information.

/wallet/gettransactioncountbyblocknum(will not be supported until Odyssey-v3.2)
Function：Query transaction's count on a specified block by height
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactioncountbyblocknum -d '{"num" : 100}' 
Parameters：Num is the height of the block.
Return value：Transaction count.

wallet/listwitnesses
Function：Query the list of Super Representatives
demo: curl -X POST  http://127.0.0.1:8090/wallet/listwitnesses
Parameters：None
Return value：List of all Super Representatives

/wallet/getassetissuelist
Function：Query the list of Tokens
demo: curl -X POST  http://127.0.0.1:8090/wallet/getassetissuelist
Parameters：None
Return value：List of all Tokens

/wallet/getpaginatedassetissuelist
Function：Query the list of Tokens with pagination
demo: curl -X POST  http://127.0.0.1:8090/wallet/getpaginatedassetissuelist -d '{"offset": 0, "limit": 10}'
Parameters：Offset is the index of the starting Token, and limit is the number of Tokens expected to be returned.
Return value：List of Tokens

/wallet/totaltransaction
Function：Count all transactions on the network
demo: curl -X POST  http://127.0.0.1:8090/wallet/totaltransaction
Parameters：None
Return value：Total number of transactions.

/wallet/getnextmaintenancetime
Function：Get the time of the next Super Representative vote
demo: curl -X POST  http://127.0.0.1:8090/wallet/getnextmaintenancetime
Parameters：None
Return value: number of milliseconds until the next voting time.

/wallet/validateaddress
Function：validate address
demo: curl -X POST  http://127.0.0.1:8090/wallet/validateaddress -d '{"address": "4189139CB1387AF85E3D24E212A008AC974967E561"}'
Parameters：The address, should be in base58checksum, hexString or base64 format.
Return value: True or false

wallet/deploycontract
Function：deploys a contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/deploycontract -d '{"abi":"[{\"constant\":false,\"inputs\":[{\"name\":\"key\",\"type\":\"uint256\"},{\"name\":\"value\",\"type\":\"uint256\"}],\"name\":\"set\",\"outputs\":[],\"payable\":false,\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"constant\":true,\"inputs\":[{\"name\":\"key\",\"type\":\"uint256\"}],\"name\":\"get\",\"outputs\":[{\"name\":\"value\",\"type\":\"uint256\"}],\"payable\":false,\"stateMutability\":\"view\",\"type\":\"function\"}]","bandwidth_limit":1000000,"bytecode":"608060405234801561001057600080fd5b5060de8061001f6000396000f30060806040526004361060485763ffffffff7c01000000000000000000000000000000000000000000000000000000006000350416631ab06ee58114604d5780639507d39a146067575b600080fd5b348015605857600080fd5b506065600435602435608e565b005b348015607257600080fd5b50607c60043560a0565b60408051918252519081900360200190f35b60009182526020829052604090912055565b600090815260208190526040902054905600a165627a7a72305820fdfe832221d60dd582b4526afa20518b98c2e1cb0054653053a844cf265b25040029","call_value":100,"contract_name":"SomeContract","fee_limit":1000000,"origin_energy_limit":10,"owner_address":"41D1E7A6BC354106CB410E65FF8B181C600FF14292"}'
Parameters：
  abi：abi
  bytecode:bytecode
  consume_user_resource_percent：The percentage of resources specified for users who use this contract, is an integer between [0, 100]. If it is 0, it means the user does not consume resources until the developer resources are exhausted.
  bandwidth_limit：Maximum bandwidth consumption, measured in bytes
  fee_limit：Maximum TRX consumption, measured in SUN（1TRX = 1,000,000SUN）
  call_value：Amount of TRX transferred with this transaction, measured in SUN（1TRX = 1,000,000SUN）
  owner_address：contract owner address, converted to a hex string
  name: The name of contract
  origin_energy_limit: The max energy which will be consumed by the owner in the process of excution or creation of the contract, is an integer which should be greater than 0.
Return Value：TransactionExtention, TransactionExtention contains unsigned Transaction

wallet/triggersmartcontract
Function：Calls a function on a contract
demo: curl -X POST  http://127.0.0.1:8090/wallet/triggersmartcontract -d '{"contract_address":"4189139CB1387AF85E3D24E212A008AC974967E561","function_selector":"set(uint256,uint256)","parameter":"00000000000000000000000000000000000000000000000000000000000000010000000000000000000000000000000000000000000000000000000000000002","fee_limit":1000000,"call_value":100,"owner_address":"41D1E7A6BC354106CB410E65FF8B181C600FF14292"}'
Parameters：
  contract_address: contract address, converted to a hex string
  function_selector: Function signature, no spaces
  parameter：Call the virtual machine format of the parameter [1, 2], use the js tool provided by remix, convert the parameter array [1, 2] called by the contract caller into the parameter format required by the virtual machine.
  fee_limit：Maximum TRX consumption, measured in SUN（1TRX = 1,000,000SUN）
  call_value：Amount of TRX transferred with this transaction, measured in SUN（1TRX = 1,000,000SUN）
  owner_address：address that is trigger the contract, converted to a hex string
Return Value：TransactionExtention, TransactionExtention contains unsigned Transaction



wallet/proposalcreate
作用：创建提案
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposalcreate -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9","parameters":[{"key": 0,"value": 100000},{"key": 1,"value": 2}] }
参数说明：
owner_address：创建人地址
parameters：提案参数
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

wallet/listproposalspaginated(Odyssey-v3.1.1暂不支持)
作用：分页查询提案列表
demo: curl -X POST  http://127.0.0.1:8091/wallet/listproposalspaginated -d '{"offset": 0, "limit":10}'
参数说明：offset是起始提案的index，limit是期望返回的提案数量
返回值：提案列表

wallet/proposalapprove
作用：提案批准
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposalapprove -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9", "proposal_id":1, "is_add_approval":true}
参数说明：
owner_address：批准人地址
proposal_id：提案id
is_add_approval：是否批准
返回值：批准提案的交易

wallet/proposaldelete
作用：删除提案
demo: curl -X POST  http://127.0.0.1:8090/wallet/proposaldelete -d {"owner_address" : "419844F7600E018FD0D710E2145351D607B3316CE9", "proposal_id":1}
参数说明：
owner_address：删除人的地址，只有提案所有人允许删除提案
proposal_id：提案id
返回值：删除提案的交易

wallet/getaccountresource
作用：查询账户的资源信息
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccountresource -d {"address" : "419844f7600e018fd0d710e2145351d607b3316ce9"}
参数说明：
address：查询账户的地址
返回值：账户的资源信息

wallet/exchangecreate
作用：创建交易对
demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangecreate -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", 、
"first_token_id":token_a, "first_token_balance":100, "second_token_id":token_b,"second_token_balance":200}
参数说明：
first_token_id  ：第1种token的id
first_token_balance：第1种token的balance
second_token_id ： 第2种token的id
second_token_balance：第2种token的balance
返回值：创建交易对的transaction。

wallet/exchangeinject
作用：给交易对注资，注资后可以防止交易对价格波动太大
demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangeinject -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100}
参数说明：
owner_address：交易对创建者的地址，hexString格式
exchange_id：交易对id
token_id： token的id，一般情况是token的name，需要是hexString格式
quant：注资token的数量
返回值：注资的transaction。

wallet/exchangewithdraw
作用：对交易对撤资，撤资后容易引起交易对价格波动太大。
demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangewithdraw -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100}
参数说明：
owner_address：是交易对创建者的地址，hexString格式
exchange_id：交易对id
token_id： token的id，一般情况是token的name，需要是hexString格式
quant：撤资token的数量
返回值：撤资的transaction

wallet/exchangetransaction
作用：参与交易对交易。
demo：curl -X POST  http://127.0.0.1:8090/wallet/exchangetransaction -d {"owner_address":"419844f7600e018fd0d710e2145351d607b3316ce9", "exchange_id":1, "token_id":"74726f6e6e616d65", "quant":100,"expected":10}
参数说明：
owner_address：是交易对创建者的地址，hexString格式
exchange_id：交易对id
token_id： 卖出的token的id，一般情况是token的name，需要是hexString格式
quant：卖出token的数量
expected：期望买入token的数量
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

wallet/listexchangespaginated(Odyssey-v3.1.1暂不支持)
作用：分页查询交易对列表
demo: curl -X POST  http://127.0.0.1:8090/wallet/listexchangespaginated -d '{"offset": 0, "limit":10}'
参数说明：offset是起始交易对的index，limit是期望返回的交易对数量
返回值：提案列表
 
wallet/updatesetting
作用：更新合约的consume_user_resource_percent
demo: curl -X POST  http://127.0.0.1:8090/wallet/updatesetting -d '{"owner_address": "419844f7600e018fd0d710e2145351d607b3316ce9", "contract_address": "41c6600433381c731f22fc2b9f864b14fe518b322f", "consume_user_resource_percent": 7}'
参数说明：
owner_address：是交易对创建者的地址，hexString格式
contract_address：要修改的合约的地址
consume_user_resource_percent：指定的使用该合约用户的资源占比
返回值：TransactionExtention, TransactionExtention中包含未签名的交易Transaction

wallet/updateenergylimit
作用：更新合约的origin_energy_limit
demo: curl -X POST  http://127.0.0.1:8090/wallet/updatesetting -d '{"owner_address": "419844f7600e018fd0d710e2145351d607b3316ce9", "contract_address": "41c6600433381c731f22fc2b9f864b14fe518b322f", "origin_energy_limit": 7}'
参数说明：
owner_address：是交易对创建者的地址，hexString格式
contract_address：要修改的合约的地址
origin_energy_limit：创建者设置的，在一次合约执行或创建过程中创建者自己消耗的最大的energy
返回值：TransactionExtention, TransactionExtention中包含未签名的交易Transaction

wallet/accountpermissionupdate
作用：更新用户权限（用于多重签名）
demo: curl -X POST  http://127.0.0.1:8090/wallet/accountpermissionupdate -d '{"owner_address":"41ffa9466d5bf6bb6b7e4ab6ef2b1cb9f1f41f9700","owner":{"type":0,"permission_name":"owner","threshold":2,"keys":[{"address":"41F08012B4881C320EB40B80F1228731898824E09D","weight":1},{"address":"41DF309FEF25B311E7895562BD9E11AAB2A58816D2","weight":1},{"address":"41BB7322198D273E39B940A5A4C955CB7199A0CDEE","weight":1}]},"actives":[{"type":2,"permission_name":"active0","threshold":3,"operations":"7fff1fc0037e0000000000000000000000000000000000000000000000000000","keys":[{"address":"41F08012B4881C320EB40B80F1228731898824E09D","weight":1},{"address":"41DF309FEF25B311E7895562BD9E11AAB2A58816D2","weight":1},{"address":"41BB7322198D273E39B940A5A4C955CB7199A0CDEE","weight":1}]}]}'
参数说明：
owner_address：待修改权限的账户的地址\
owner：修改后的 owner 权限\
witness：修改后的 witness 权限（如果是 witness ）\
actives：修改后的 actives 权限
permission.PermissionType: 权限类型，目前仅支持三种权限\
permission.id: 值由系统自动设置，Owner id=0, Witness id=1, Active id 从2开始递增分配。在执行合约时，
通过该id来指定使用哪个权限，如使用owner权限，即将id设置为0。\
permission.permission_name: 权限名称，由用户设定，长度限制为32字节\
permission.threshold: 阈值，只有当参与签名的权重之和超过域值才允许做相应的操作。要求小于Long类型的最大值\
permission.parent_id：目前只能为0 \
permission.operations：共32字节（256位），每位代表一个合约的权限，为1时表示拥有该合约的权限。
如`operations=0x0100...00(十六进制),即100...0(二进制)`时,查看proto中Transaction.ContractType定义，合约AccountCreateContract的id为0，
即表示该permission只拥有执行AccountCreateContract的权限，可以使用"active权限中operations的计算示例"计算获得。\
permission.keys：共同拥有该权限的地址及权重，最多允许5个key。
permission.key.address：拥有该权限的地址     
permission.key.weight：该地址对该权限拥有权重   

返回值：TransactionExtention, TransactionExtention中包含增加签名后的交易Transaction


wallet/addtransactionsign
作用：增加签名（用于多重签名）
demo: curl -X POST  http://127.0.0.1:8090/wallet/addtransactionsign -d '{"transaction": "TransferContract", "privateKey": "permissionkey1"}'
参数说明：
transaction：交易，TransferContract需要替换成实际交易信息
privateKey：私钥，permissionkey1需要替换成实际签名的私钥
返回值：TransactionExtention, TransactionExtention中包含增加签名后的交易Transaction

wallet/getapprovedlist
作用：查询已签名地址（用于多重签名）
demo: curl -X POST  http://127.0.0.1:8090/wallet/getapprovedlist -d '{"transaction"}'
参数说明：
transaction：交易，需要替换成实际交易信息 
返回值：TransactionApprovedList, TransactionApprovedList包含已签名的地址，交易

wallet/getsignweight
作用：查询交易签名权重（用于多重签名）
demo: curl -X POST  http://127.0.0.1:8090/wallet/getsignweight -d '{"transaction"}'
参数说明：
transaction：交易，需要替换成实际交易信息 
返回值：TransactionSignWeight, TransactionSignWeight包含结果result，表示交易的签名是否满足权限阈值。



```
