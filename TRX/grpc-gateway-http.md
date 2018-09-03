# TRON GRPC-Gateway-HTTP

You will need to deploy a [grpc-gateway](https://github.com/tronprotocol/grpc-gateway/blob/master/README.md)

The grpc-gateway will encode the bytes fields defined in proto into base64 format. For input parameters in bytes format, you should encode in into base64 format, and for output parameters in bytes format, you should decode it into base64 format for subsequent processing. We provide a encoding/decoding tool which you can download from https://github.com/tronprotocol/tron-demo/raw/master/TronConvertTool.zip.

```shell
wallet/getaccount
Function: returns account info
Parameters: convert to_address and owner_address to base64 format
Demo: curl -X POST  http://127.0.0.1:18890/wallet/getaccount -d '{"address": "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}'

Wallet/createtransaction
Function: create the transaction of a transfer. If the recipient address does not exist, then a corresponding account will be created on the blockchain.
Parameters: convert to_address and owner_address to base64 format
Demo: 
curl -X POST  http://127.0.0.1:18890/wallet/createtransaction -d '{"to_address": "QYgZmb8EtAG27PTQy5E3TXNTYCcy" ,"owner_address":"QfoWCvbA5qqphqTcvTU0D1+xZMHu", "amount": 1000 }'

Wallet/broadcasttransaction
Function: transaction broadcasting. Transaction needs to be signed before broadcasting.
Parameter: use the signed transaction as the input parameter.
Demo: 
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

Wallet/updateaccount
Function: updates account name. Only one update is allowed for each account.
Parameters: owner_address and account_name should be in base64 format; `ewbmV3X25hbWU=` is `new_name` in base64 format.
Demo: curl -X POST  http://127.0.0.1:18890/wallet/createtransaction -d '{"account_name": "newbmV3X25hbWU=" ,"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy"}'

Wallet/votewitnessaccount
Function: users can vote for witnesses.
Parameters: owner_address, voter’s address, should be in base64 format; votes, the votes list, should be a byte array; vote_address, address of the witness, should be in base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/votewitnessaccount -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "votes": [{"vote_address": "QfSI1WI/szR9S3ZL5f7Mewb18Rd7", "vote_count": 11}]}'

Wallet/createassetissue
Function: creates token; on Tron’s public blockchain, users can issue tokens which can be transferred reciprocally or participate in token offerings with their TRX. During token creation, an issuer can chose to freeze a certain amount of tokens.
Parameters: owner_address, issuer’s address, should be in base64 format; name, token name, should be in base64 format.
Demo: to issue a token named MyToken
curl -X POST http://127.0.0.1:18890/wallet/createassetissue -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "votes": [{"vote_address": "QfSI1WI/szR9S3ZL5f7Mewb18Rd7", "vote_count": 11}]}'

Wallet/updatewitness
Function: edit the url of the witness’ official website
Parameters: owner_address, creator’s address, should be in base64 format; update_url, updated url, should be in base64 format
Demo: curl -X POST http://127.0.0.1:18890/wallet/updatewitness -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "update_url": "d3d3Lm5ld3VybC5jb20="}'

Wallet/createaccount
Function: creates account. An existent account can call the api to create a new account at a ready address.
Parameters: owner_address, account creator’s address, should be in base64 format; account_address, the new address, should be in base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/createaccount -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "account_address": ""}'


Wallet/createwitness
Function: users can apply to become a Super Representative, which costs 9999 TRX.
Parameters: owner_address, address of the applicant, should be in base64 format; url, url of the applicant’s website, should be in base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/createwitness -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "url": "d3d3Lm5ld3VybC5jb20="}'

Wallet/transferasset
Function: token transfer.
Parameters: asset_name, name of the token, should be in base64 format; owner_address, address of the sender’s account, should be in base64 format; to_address, recipient’s address, should be in base64 format; amount, the amount of tokens, should include only numbers.
Demo: curl -X POST http://127.0.0.1:18890/wallet/transferasset -d '{"owner_address":"QYgZmb8EtAG27PTQy5E3TXNTYCcy", "to_address": "d3d3Lm5ld3VybC5jb20=", "asset_name": "TXlBc3NldA==", "amount": 1000}'

Wallet/participateassetissue
Function: to participate in token offerings, users can exchange for issued tokens with TRX.
Parameters: owner_address, issuer’s address, should be in base64 format; to_address, recipient’s address, should be in base64 format; asset_name, name of the token, should be in base64 format; amount, the amount of tokens, should include only numbers.
Demo: curl -X POST http://127.0.0.1:18890/wallet/participateassetissue -d '{"to_address": "QYgZmb8EtAG27PTQy5E3TXNTYCcy" ,"owner_address":"QfoWCvbA5qqphqTcvTU0D1+xZMHu", "amount":1000, "asset_name":"TXlBc3NldA=="}'

Wallet/freezebalance
Function: Freezes TRX for the account
Parameters: owner_address should be in base64 format; frozen_balance is the amount of frozen TRX in sun; frozen_duration is the frozen period.
Demo: curl -X POST http://127.0.0.1:18890/wallet/freezebalance -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69", "frozen_balance" : 100000, "frozen_duration" : 3}'

Wallet/unfreezeasset
Function:  Unfreezes TRX for the account
Parameters: owner_address should be in base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/unfreezeasset -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69"}'

Wallet/withdrawbalance
Function: Withdraws rewards for an SR
Parameters: owner_address should be converted to base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/withdrawbalance -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69"}'

Wallet/updateasset
Function: Updates a token asset
Parameters: owner_address should be in base64 format; description should be in base64 format and the original description is ‘just test’; url should be in base64 format and the original website is www.baidu.com.
Demo: curl -X POST http://127.0.0.1:18890/wallet/updateasset -d '{"owner_address" : "QVHyqChqzKYaik1etWXHerLDoP69", "description" : "anVzdCB0ZXN0", "url" : "d3d3LnRlc3R1cmwuY29t", "new_limit" : 1000, "new_public_limit" : 1000}'

Wallet/listnodes
Function: Lists all connected nodes
Parameters: none.
Demo: curl -X POST http://127.0.0.1:18890/wallet/listnodes

Wallet/getassetissuebyaccount
Function: Lists issued tokens by account:
Parameters: address should be converted to base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/getassetissuebyaccount -d {"address" : "QVHyqChqzKYaik1etWXHerLDoP69"}

Wallet/getaccountnet
Function: Query bandwidth for an account
Parameters: address should be converted to base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/getaccountnet -d {"address" : "QVHyqChqzKYaik1etWXHerLDoP69"}

Wallet/getassetissuebyname
Function: Query tokens by name
Parameters: value is the token name and the original text reads TWX.
Demo: curl -X POST http://127.0.0.1:18890/wallet/getassetissuebyname -d {"value" : "VFdY"}

Inquire the latest block: wallet/getnowblock
Function: Query the network for the latest block
Parameters: none.
Demo: curl -X POST http://127.0.0.1:18890/wallet/getnowblock

Wallet/getblockbynum
Function: Query a block by height
Parameters: num is the blockheight.
Demo: curl -X POST http://127.0.0.1:18890/wallet/getblockbynum -d {"num" : 1}

Wallet/getblockbyid
Function: Query block by ID
Parameters: value shows the block ID 0000000000079080a30e7326c924457cde710b001ecf1a0b66b67df497c60c39 in base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/getblockbyid -d {"value" : "AAAAAAAHkICjDnMmySRFfN5xCwAezxoLZrZ99JfGDDk="}

Wallet/getblockbylimitnext
Function: Query block by a range of blockheight
Parameters: startNum is the starting blockheight and the endNum is the end blockheight. The return with include the startNum block and the endNum block.
Demo: curl -X POST http://127.0.0.1:18890/wallet/getblockbylimitnext -d '{"startNum" : 10, "endNum" : 10}'

Wallet/getblockbylatestnum
Function: Query topN blocks by height
Parameter: num is the latest number of blocks.
Demo: curl -X POST http://127.0.0.1:18890/wallet/getblockbylatestnum -d '{"num" : 10}'

Wallet/gettransactionbyid
Function: Query transactions by transaction ID
Parameters: value is the transaction ID, which can be obtained through hashing the raw_data of the transaction; value should be in base64 format.
Demo: curl -X POST http://127.0.0.1:18890/wallet/gettransactionbyid -d '{"value" : "JTqX9taV7RNDyZbwGsN4BsMthBqoBaqnROvCQtHYOyg="}'

Inquire list of all Super Representatives: /wallet/listwitnesses
Demo: curl -X POST http://127.0.0.1:18890/wallet/listwitnesses
Parameters:

Inquire list of all issued tokens: /wallet/getassetissuelist
Demo: curl -X POST http://127.0.0.1:18890/wallet/getassetissuelist
Parameters:

Paginated inquiry of list of issued tokens: /wallet/getpaginatedassetissuelist
Demo: curl -X POST http://127.0.0.1:18890/wallet/getpaginatedassetissuelist -d '{"offset" : 0, "limit" : 10}'
Parameters: offset is the ID of the first token on each page, while limit is the maximum amount of returned tokens on each page.

Inquire total amount of transactions: /wallet/totaltransaction
Demo: curl -X POST http://127.0.0.1:18890/wallet/totaltransaction
Parameters:

Inquire the next maintenance time of a Super Representative: /wallet/getnextmaintenancetime
Demo: curl -X POST http://127.0.0.1:18890/wallet/getnextmaintenancetime
Parameters:

Signing: /wallet/gettransactionsign
Demo: curl -X POST http://127.0.0.1:18890/wallet/gettransactionsign -d '{
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
Parameters: transaction refers to a specific transaction and privateKey is the user’s private key in base64 format. 
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

Inquire account info: /walletsolidity/getaccount
Demo: curl -X POST http://127.0.0.1:18890/walletsolidity/getaccount -d '{"address" : "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}'
Parameters: address should be in base64 format.

Inquire list of all Super Representatives: /walletsolidity/listwitnesses
Demo: curl -X POST http://127.0.0.1:18890/walletsolidity/listwitnesses
Parameters:

Inquire list of all tokens: /walletsolidity/getassetissuelist
Demo: curl -X POST http://127.0.0.1:18890/walletsolidity/getassetissuelist
Parameters:

Paginated inquiry of list of all tokens: /walletsolidity/getpaginatedassetissuelist
Demo: curl -X POST http://127.0.0.1:18890/walletsolidity/getpaginatedassetissuelist -d '{"offset" : 0, "limit" : 10}'
Parameters: offset is the ID of the first token on each page, while limit is the maximum amount of tokens returned on each page.

Inquire current block: /walletsolidity/getnowblock
Demo: curl -X POST http://127.0.0.1:18890/walletsolidity/getnowblock
Parameters:

Inquire block by height: /walletsolidity/getblockbynum
Demo: curl -X POST http://127.0.0.1:18890/walletextension/gettransactionsfromthis -d '{"num" : 10000}'
Parameters: num is blockheight.

Inquire transactions taken by an account: /walletextension/gettransactionsfromthis
Demo: curl -X POST http://127.0.0.1:18890/walletextension/gettransactionsfromthis -d '{"account" : {"address" : "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}, "offset" : 0, "limit" : 5}'
Parameters: address is in base64 format; offset is the starting index; limit is the maximum amount of transactions to be returned.

Inquire transactions initiated by an account: /walletextension/gettransactionstothis
Demo: curl -X POST http://127.0.0.1:18890/walletextension/gettransactionstothis -d '{"account" : {"address" : "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}, "offset" : 0, "limit" : 5}'
Parameters: address is in base64 format; offset is the starting index; limit is the maximum amount of transactions to be returned.

Inquire transaction fee and it block location by transaction hash: /walletsolidity/gettransactioninfobyid
Demo: curl -X POST http://127.0.0.1:18890/walletsolidity/gettransactioninfobyid -d '{"value" : "4ebiUlBCZ5vI1JtBMFXjiH/HSaVeIaUO8PN9l5E1kXU="}'
Parameters: value is the transaction ID, hash of the raw_data of the transaction, and should be in base64 format.

Inquire transaction by transaction hash (and confirm the transaction through this API): /walletsolidity/gettransactionbyid
Demo: curl -X POST http://127.0.0.1:18890/walletsolidity/gettransactionbyid -d '{"value" : "9PeN9FHPDHr1qpILy3U+iMcLAKvwojUek9jYx1EESXA="}'
Parameters: value is the transaction ID, hash of the raw_data of the transaction, and should be in base64 format.

Create address: /wallet/createadresss
Demo: curl -X POST http://127.0.0.1:18890/wallet/createadresss -d '{"value": "QeVS9kh1hcK1i8LJu0SSvB8XEyzQ" }'
Parameters: value is the password; the address returned in base64 format needs to be converted into base58 for later use.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

TRX easy transfer: /wallet/easytransfer
Demo: curl -X POST http://127.0.0.1:18890/wallet/easytransfer -d '{"passPhrase": "QeVS9kh1hcK1i8LJu0SSvB8XEyzQ","toAddress": "QYkTnLE4evhePSTiEqAIrJdJZ+Vh", "amount":10}'
Parameters: passPhrase is the password; toAddress is the recipient address; amount is the amount of TRX to transfer.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

Generate private key and address: wallet/generateaddress
Wallet/solidity/generateaddress
demo：curl -X POST -k http://127.0.0.1:18890/wallet/generateaddress
Parameters: no parameters.
Warning: Please control risks when using this API. To ensure environmental security, please do not invoke APIs provided by other or invoke this very API on a public network.

```
