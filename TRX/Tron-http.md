#  TRON HTPP RPC interface

Available in the lastest build of java-tron master.

Please add to the configuration files for both nodes:

```
  http {
    fullNodePort = 8090
    solidityPort = 8091
  }
```

# solidityNode interface
```
/walletsolidity/getaccount
Function：Query information about an account
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getaccount -d '{"address": "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}'
Parameters：address should be converted to a hex string
Return value：Account Object

/walletsolidity/listwitnesses
Function：Query the list of super representatives
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/listwitnesses
Parameters：
Return value：List of all super delegates

/walletsolidity/getassetissuelist
Function：Query the list of Tokens
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getassetissuelist 
Parameters：
Return value：List of all Tokens

/walletsolidity/getpaginatedassetissuelist
Function：Query the list of Tokens with pagination
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getpaginatedassetissuelist -d '{"offset": 0, "limit":10}'
Parameters：Offset is the index of the starting Token, and limit is the number of Tokens expected to be returned.
Return value：List of Tokens

/walletsolidity/getnowblock
Function：Query the latest block
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/getnowblock
Parameters：
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

/walletsolidity/gettransactioninfobyid
Function：Query transaction fee based on id
demo: curl -X POST  http://127.0.0.1:8091/walletsolidity/gettransactioninfobyid -d '{"value" : "309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2"}'
Parameters：value is the transaction id，converted to a hex string
Return value：Transaction fee，block height and block creation time

/walletextension/gettransactionsfromthis
Function：Query the list of transactions sent by an address
demo: curl -X POST  http://127.0.0.1:8091/walletextension/gettransactionsfromthis -d '{"account" : {"address" : "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}, "offset": 0, "limit": 10}'
Parameters：Address is the account address, converted to a hex string; offset is the index of the starting transaction; limit is the number of transactions expected to be returned
Return value：Transactions list

/walletextension/gettransactionstothis
Function：Query the list of transactions received by an address
demo: curl -X POST  http://127.0.0.1:8091/walletextension/gettransactionstothis -d '{"account" : {"address" : "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}, "offset": 0, "limit": 10}'
Parameters：Address is the account address, converted to a hex string; offset is the index of the starting transaction; limit is the number of transactions expected to be returned
Return value：Transactions list

```

FullNode interface

```

wallet/createtransaction
Function：Creates a transaction of transfer. If the recipient address does not exist, a corresponding account will be created on the blockchain.
demo: curl -X POST  http://127.0.0.1:8090/wallet/createtransaction -d '{"to_address": "41e9d79cc47518930bc322d9bf7cddd260a0260a8d", "owner_address": "41D1E7A6BC354106CB410E65FF8B181C600FF14292", "amount": 1000 }}'
Parameters：To_address is the transfer transfer address, converted to  a hex string; owner_address is the transfer transfer address, converted to  a hex string; amount is the transfer amount
Return value：Transaction contract data

/wallet/gettransactionsign
Function：Sign the transaction, the api has the risk of leaking the private key, please make sure to call the api in a secure environment
demo: curl -X POST  http://127.0.0.1:8090/wallet/gettransactionsign -d '{
"transation" : {"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}}
"privateKey" : "your private key"}
}'
Parameters：Transaction is a contract created by http api, privateKey is the user private key
Return value：Signed Transaction contract data

wallet/broadcasttransaction
Function：Broadcast the signed transaction
demo：curl -X POST  http://127.0.0.1:8090/wallet/broadcasttransaction -d '{"signature":["97c825b41c77de2a8bd65b3df55cd4c0df59c307c0187e42321dcc1cc455ddba583dd9502e17cfec5945b34cad0511985a6165999092a6dec84c2bdd97e649fc01"],"txID":"454f156bf1256587ff6ccdbc56e64ad0c51e4f8efea5490dcbc720ee606bc7b8","raw_data":{"contract":[{"parameter":{"value":{"amount":1000,"owner_address":"41e552f6487585c2b58bc2c9bb4492bc1f17132cd0","to_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"267e","ref_block_hash":"9a447d222e8de9f2","expiration":1530893064000,"timestamp":1530893006233}}'
Parameters：Signed Transaction contract data
Return value：broadcast success or faiilure

wallet/updateaccount
Function：Modify account name
demo：curl -X POST  http://127.0.0.1:8090/wallet/updateaccount -d '{"account_name": "0x7570646174654e616d6531353330383933343635353139" ,"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292"}'
Parameters：account_name is the name of the account, converted into a hex string；owner_address is the account address of the name to be modified, converted to a hex string.
Return value：modification Transaction Object

wallet/votewitnessaccount
Function：Vote on the super representative
demo：curl -X POST  http://127.0.0.1:8090/wallet/votewitnessaccount -d '{
"owner_address":"41d1e7a6bc354106cb410e65ff8b181c600ff14292", 
"votes": [{"vote_address": "41e552f6487585c2b58bc2c9bb4492bc1f17132cd0", "vote_count": 5}]
}'
Parameters：Owner_address is the voter address, converted to a hex string; votes.vote_address is the address of the super delegate being voted, converted to a hex string; vote_count is the number of votes

wallet/createassetissue
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




wallet/createaddress
Function: Create address from a specified password string (NOT PRIVATE KEY)
Demo: curl -X POST http://127.0.0.1:8090/wallet/createaddress -d '{"value": "7465737470617373776f7264" }'
Parameters: value is the password, converted from ascii to hex
Return value：value is the corresponding address for the password, encoded in hex. Convert it to base58 to use as the address.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

wallet/easytransfer
Function: Easily transfer from an address using the password string. Only works with accounts created from createAddress
Demo: curl -X POST http://127.0.0.1:8090/wallet/easytransfer -d '{"passPhrase": "7465737470617373776f7264","toAddress": "41D1E7A6BC354106CB410E65FF8B181C600FF14292", "amount":10}'
Parameters: passPhrase is the password, converted from ascii to hex. toAddress is the recipient address, converted into a hex string; amount is the amount of TRX to transfer in SUN.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

wallet/generateaddress
Function: Generates a random private key and address pair
demo：curl -X POST -k http://127.0.0.1:8090/wallet/generateaddress
Parameters: no parameters.
Return value：value is the corresponding address for the password, encoded in hex. Convert it to base58 to use as the address.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.




```
