# Overview of Tron

# Overall Tron

## 1.1 Project repositories
Address of project repositories: https://github.com/tronprotocol. Java-tron repository contains code of the mainnet. The protocol repository contains documents on API and data structure. Wallet-cli repository contains documents on the official command-line wallet.

## 1.2 Block explorer
The address of the block explorer is: https://tronscan.org. Its creator is Rovak, whose GitHub page can be found at: https://github.com/Rovak.

## 1.3 Tron consensus algorithm
Tron adopts TPoS, an improved DPoS algorithm.

## 1.4 Block Producing Speed of Tron
For current version Odyssey-v2.0.1, 3 sec per block.

## 1.5 Transaction model
The adopted transaction model is the account model instead of the UTXO model. The smallest unit of TRX is sun, 1 TRX=1,000,000 sun. Currently, only one-to-one transaction services are available, meaning that one-to-many or many-to-one transactions are not supported.

## 1.6 Account model
One account has only one corresponding address, which is needed for transfers. The multi-signature mechanism is not yet implemented on the current version of network. There are three ways to create an account on the main blockchain.
```
a.  Create account with an existing account.
b.  Send TRX to a new address to create account.
c.  Send tokens to a new address to create account.
```
# 2. Tron’s network structure

## 2.1 Node types
There are three types of nodes on Tron’s network, namely witness, full node and solidity node. A witness is responsible for block production; a full node provides APIs, and broadcasts transactions and blocks; a solidity node synchronizes irrevocable blocks and provides inquiry APIs.

## 2.2 Network deployment (of exchanges)
Exchanges need to deploy a full node and a solidity node. The solidity node connects to the local full node which connects to the mainnet.

## 2.3 Mainnet and testnet
the explorer of mainnet is https://tronscan.org and testnet is https://test.tronscan.org.
exchanges should test their code in testnet. About how to config testnet, please refer https://github.com/tronprotocol/TronDeployment/blob/master/test_net_config.conf. About how to config mainnet, please refer https://github.com/tronprotocol/TronDeployment/blob/master/main_net_config.conf.

# 3. Operation of node

## 3.1 Recommended hardware specifications
```
Minimum specifications for full node deployment
CPU：16-core
RAM：16G
Bandwidth：100M
DISK：10T
Recommended specifications for full node deployment
CPU：64-core or more 
RAM：64G or more 
Bandwidth：500M and more
DISK：20T or more

Minimum specifications for solidity node deployment
CPU：16-core
RAM：16G
Bandwidth：100M
DISK：10T
Recommended specifications for solidity node deployment
CPU：64-core or more
RAM：64G or more
Bandwidth：500M and more
DISK：20T or more

DISK capacity depends on the actual transaction volume after deployment, but it’s always better to leave some excess capacity.
```

## 3.2 Start the full node and solidity node
Please follow the guide here to configure and deploy both nodes: https://github.com/tronprotocol/Documentation/blob/master/TRX/Solidity_and_Full_Node_Deployment_EN.md

# 4. Tron API
Currently Tron only supports gRPC interfaces and not http interfaces. The grpc-gateway is for the use of debugging only and we strongly suggest that developers do not use it for development.

## 4.1 Definition of API
For the definition of API, see also: https://github.com/tronprotocol/protocol/blob/master/api/api.proto

## 4.2 Explanation of APIs
APIs under wallet service are provided by the full node. APIs under walletSolidity and walletExtension services are provided by the solidity node. APIs under the walletExtension service, whose processing time is long, are provided by the solidity node. The full node provides APIs for operations on the blockchain and for data inquiry, while the solidity node only provides APIs for the latter. The difference between these two nodes is that data of the full node could be revoked due to forking, whereas the solidified data of the solidity one is irrevocable.
```
wallet/GetAccount
Function:Returns account information.

wallet/CreateTransaction
Function: Creates a transaction of transfer. If the recipient address does not exist, a corresponding account will be created on the blockchain.

wallet/ BroadcastTransaction
Function: Broadcasts transaction. Transaction has to be signed before being broadcasted.

wallet/ UpdateAccount
Function: Updates account name. Account name can only be updated once for each account.

wallet/ VoteWitnessAccount
Function:Users can vote for witnesses.

wallet/ CreateAssetIssue
Function: Creates token. Users can issue their own token on Tron’s public blockchain, which can be used for reciprocal transfers and be bought with TRX. Users can chose to freeze a certain portion of the token supply during token issuance.

wallet/ UpdateWitness
Function: Updates witness information.

wallet/ CreateAccount
Function: Created account. Existent accounts can revoke this API to create a new account with an address.

wallet/ CreateWitness
Function: Users can apply to become Super Representatives, which costs 9,999 TRX.

wallet/ TransferAsset
Function: Token transfer.

wallet/ ParticipateAssetIssue
Function: Token participation. Users can participate in token offerings with their TRX.

wallet/ FreezeBalance
Function: Freeze TRX. Freezing TRX gives users bandwidth points and Tron Power, which are used for transactions and voting for witnesses respectively.

wallet/ UnfreezeBalance
Function: Unfreezes TRX. Frozen TRX can only be unfrozen 3 days afterwards. Unfreezing TRX also takes away corresponding bandwidth points, Tron power and the votes.

wallet/ UnfreezeAsset
Function: Unfreezes tokens.

wallet/ WithdrawBalance
Function: SRs and SR candidates can withdraw block reward and witness reward for the top 127 candidates to their account balance. One withdrawal can be made by each account every 24 hours.

wallet/ UpdateAsset
Function: Updates information of an issued token.

wallet/ ListNodes
Function: Returns a list of all nodes.

wallet/ GetAssetIssueByAccount
Function: Get information on a token by account.

wallet/ GetAccountNet
Function: Get bandwidth information on an account, including complimentary bandwidth points and bandwidth points obtained from balance freeze.

wallet/ GetAssetIssueByName
Function: Inquire token by token name.

wallet/ GetNowBlock
Function: Returns the latest block.

wallet/ GetBlockByNum
Function: Inquire block by block height.

wallet/ GetBlockById
Function: Inquire block by block ID. The ID of a block is the hash of the blockheader’s Raw data. 

wallet/ GetBlockByLimitNext index
Function: Returns blocks indexed between the startNum and the endNum (including both ends).

wallet/ GetBlockByLatestNum
Function: Get the latest N blocks. N is defined in the parameter.

wallet/ GetTransactionById
Function: Get transaction by ID, which is the hash of the Raw data of the transaction.

wallet/ ListWitnesses
Function: Get a list of all witnesses.

wallet/ GetAssetIssueList
Function: Get a list of all issued tokens.

wallet/ TotalTransaction
Function: Get the total amount of transactions on the blockchain.

wallet/ GetNextMaintenanceTime
Function: Get the next maintenance time, namely the next update of witness votes count.

WalletSolidity/ GetAccount
Function:

WalletSolidity/ ListWitnesses
Function:

WalletSolidity/ GetAssetIssueList
Function:

WalletSolidity/ GetNowBlock
Function:

WalletSolidity/ GetBlockByNum
Function:

WalletExtension/ GetTransactionsFromThis
Function: Get the record of all outbound transactions from a certain account.

WalletExtension/ GetTransactionsToThis
Function: Get the record of all incoming transactions of a certain account.
```

### 4.2.2 HTTP Interface
If you require an http interface, you will need to deploy a [grpc-gateway](https://github.com/tronprotocol/grpc-gateway/blob/master/README.md)

grpc-gateway will encode the bytes fields defined in proto into base64 format. So about a input parameter in bytes format, you should encode in into base64 format, and about a output parameter in bytes format, you should decode it with base64 for subsequent processing. We provide a encoding/decoding tool, so you can download it from https://github.com/tronprotocol/TronTools/blob/master/TronConvertTool.zip.

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
Parameters: transaction refers to a specific transaction and privateKey is the user’s private key in base64 format. If one needs to invoke this API, please make sure deploy the node(s) in a LAN or an offline environment for offline signatures.

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

TRX easy transfer: /wallet/easytransfer
Demo: curl -X POST http://127.0.0.1:18890/wallet/easytransfer -d '{"passPhrase": "QeVS9kh1hcK1i8LJu0SSvB8XEyzQ","toAddress": "QYkTnLE4evhePSTiEqAIrJdJZ+Vh", "amount":10}'
Parameters: passPhrase is the password; toAddress is the recipient address; amount is the amount of TRX to transfer.

Walletextension/gettransactionsfromthis
Function: Query an account's account transaction
Parameter description: address is base64 format, offset is the start index, limit is the maximum number of transactions returned
Demo:curl -X POST http://127.0.0.1:18890/walletextension/gettransactionsfromthis -d '{"account" : {"address" : "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}, "offset" : 0, "limit" : 5}'

Walletextension/gettransactionstothis
Function: Inquire account transactions
Parameter description: address is base64 format, offset is the start index, limit is the maximum number of transactions returned
Demo:curl -X POST http://127.0.0.1:18890/walletextension/gettransactionstothis -d '{"account" : {"address" : "QYgZmb8EtAG27PTQy5E3TXNTYCcy"}, "offset" : 0, "limit" : 5}'

Walletsolidity/gettransactioninfobyid
Function: In accordance with the transaction hash query transaction fee, the transaction block
Parameter description: value is the id of the transaction, which is obtained from the raw_data of the hash transaction. The value needs to be in base64 format.
Demo:curl -X POST http://127.0.0.1:18890/walletsolidity/gettransactioninfobyid -d '{"value" : "4ebiUlBCZ5vI1JtBMFXjiH/HSaVeIaUO8PN9l5E1kXU="}'

Wallet/createadresss
Function: creates the address for a password
Parameter Description: value is the user's password, returns base64 format address which needs to be converted to base58 before using.
Demo:curl -X POST http://127.0.0.1:18890/wallet/createadresss -d '{"value": "QeVS9kh1hcK1i8LJu0SSvB8XEyzQ" }'

Wallet/easytransfer
Function: An easy way to quickly transfer TRX. Wraps the create transaction, sign and broadcast
Parameter Description: passPhrase is the user password, toAddress is the address of the transfer recipient, amount is the number of transfer trx
Demo:curl -X POST http://127.0.0.1:18890/wallet/easytransfer -d '{"passPhrase": "QeVS9kh1hcK1i8LJu0SSvB8XEyzQ","toAddress": "QYkTnLE4evhePSTiEqAIrJdJZ+Vh", "amount":10}'
```

## 4.3 API code generation
APIs are based on the gRPC protocol, see https://grpc.io/docs/ for more information.

## 4.4 API demo
Please refer to the following two classes for a GRPC example in Java.
```
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/WalletClient.java

https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/walletserver/GrpcClient.java
```
# 5. Relevant expenses:
When there are sufficient bandwidth points, no TRX is charged. If a transaction fee is charged, it will be recorded in the fee field in the transaction results. If no transaction fee is charged, meaning that corresponding bandwidth points have been deducted, the fee field will read “0”. There will only be a service charge after a transaction has been written into the blockchain. For more information on the fee field, please see also Transaction.Result.fee, with the corresponding proto file at https://github.com/tronprotocol/protocol/blob/master/core/Tron.proto.

See also: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Mechanism_Introduction.md
## 5.1 Definition of bandwidth points
## 5.2 Freeze/unfreeze mechanism
## 5.3 Bandwidth consumption rules
## 5.4 Reward mechanism for Super Representative and Super Representative candidates

# 6. User address generation
## 6.1 Algorithm description
1. First generate a key pair and extract the public key (a 64-byte byte array representing its x,y coordinates). 
2. Hash the public key using sha3-256 function and extract the last 20 bytes of the result. 
3. Add `41` to the beginning of the byte array. Length of the initial address should be 21 bytes. 
4. Hash the address twice using sha256 function and take the first 4 bytes as verification code. 
5. Add the verification code to the end of the initial address and get an address in base58check format through base58 encoding. 
6. An encoded mainnet address begins with T and is 34 bytes in length.
```
Please note that the sha3 protocol we adopt is KECCAK-256.
```

## 6.2 Mainnet addresses begin with 41
```
    address = 41||sha3[12,32): 415a523b449890854c8fc460ab602df9f31fe4293f 
    sha256_0 = sha256(address): 06672d677b33045c16d53dbfb1abda1902125cb3a7519dc2a6c202e3d38d3322 
    sha256_1 = sha256(sha256_0): 9b07d5619882ac91dbe59910499b6948eb3019fafc4f5d05d9ed589bb932a1b4 
    checkSum = sha256_1[0, 4): 9b07d561 
    addchecksum = address || checkSum: 415a523b449890854c8fc460ab602df9f31fe4293f9b07d561 
    base58Address = Base58(addchecksum): TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW
```

## 6.3 Java code demo
See: https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/ECKeyDemo.java

# 7. Transaction signing
See: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Procedures_of_transaction_signature_generation.md

# 8. Calculation of transaction ID
Hash the Raw data of the transaction.
```
Hash.sha256(transaction.getRawData().toByteArray())
```

# 9. Calculation of block ID
Block ID is a combination of block height and the hash of the blockheader’s raw data. To get block ID, first hash the raw data of the blockheader and replace the first 8 bytes of the hash with the blockheight, as the following:
```
private byte[] generateBlockId(long blockNum, byte[] blockHash) { 
 byte[] numBytes = Longs.toByteArray(blockNum); 
 byte[] hash = blockHash; 
 System.arraycopy(numBytes, 0, hash, 0, 8); 
 return hash;
 }
```
BlockHash is the hash of the raw data of the blockheader, which can be calculated as the following:
```
Sha256Hash.of(this.block.getBlockHeader().getRawData().toByteArray())
```
# 10. Construction and signature of transaction
There are two ways to construct a transaction:
## 10.1 Invoke APIs on the full node
Based on your own needs, construct a corresponding local Contract and construct transactions with corresponding APIs. For the contract, please refer to https://github.com/tronprotocol/protocol/blob/master/core/Contract.proto.

## 10.2 Local construction
Based on the definition of a transaction, you will need to fill in all fields of a transaction to construct a transaction at your local. Please note that you will need to configure the details of reference block and expiration, so you will need to connect to the mainnet during transaction construction. We advise that you set the latest block on the full node as your reference block and production time of the latest block+N minutes as your expiration time. N could be any number you find fit. The backstage condition is (Expiration > production time of the latest block and Expiration < production time of the latest block + 24 hours). If the condition is fulfilled, then the transaction is legit, and if not, the transaction is expired and will not be received by the mainnet.
method of setting refference block: set RefBlockHash as subarray of newest block's hash from 8 to 16, set BlockBytes as subarray of newest block's height from 6 to 8. The code is as follows:  
```
 public static Transaction setReference(Transaction transaction, Block newestBlock) {
    long blockHeight = newestBlock.getBlockHeader().getRawData().getNumber();
    byte[] blockHash = getBlockHash(newestBlock).getBytes();
    byte[] refBlockNum = ByteArray.fromLong(blockHeight);
    Transaction.raw rawData = transaction.getRawData().toBuilder()
        .setRefBlockHash(ByteString.copyFrom(ByteArray.subArray(blockHash, 8, 16)))
        .setRefBlockBytes(ByteString.copyFrom(ByteArray.subArray(refBlockNum, 6, 8)))
        .build();
    return transaction.toBuilder().setRawData(rawData).build();
  }
```
method of setting Expiration and transaction timestamp
```
  public static Transaction createTransaction(byte[] from, byte[] to, long amount) {
    Transaction.Builder transactionBuilder = Transaction.newBuilder();
    Block newestBlock = WalletClient.getBlock(-1);

    Transaction.Contract.Builder contractBuilder = Transaction.Contract.newBuilder();
    Contract.TransferContract.Builder transferContractBuilder = Contract.TransferContract
        .newBuilder();
    transferContractBuilder.setAmount(amount);
    ByteString bsTo = ByteString.copyFrom(to);
    ByteString bsOwner = ByteString.copyFrom(from);
    transferContractBuilder.setToAddress(bsTo);
    transferContractBuilder.setOwnerAddress(bsOwner);
    try {
      Any any = Any.pack(transferContractBuilder.build());
      contractBuilder.setParameter(any);
    } catch (Exception e) {
      return null;
    }
    contractBuilder.setType(Transaction.Contract.ContractType.TransferContract);
    transactionBuilder.getRawDataBuilder().addContract(contractBuilder)
        .setTimestamp(System.currentTimeMillis())//timestamp should be in millisecond format
        .setExpiration(newestBlock.getBlockHeader().getRawData().getTimestamp() + 10 * 60 * 60 * 1000);//exchange can set Expiration by needs
    Transaction transaction = transactionBuilder.build();
    Transaction refTransaction = setReference(transaction, newestBlock);
    return refTransaction;
  }
```
## 10.3 Signature
After a transaction is constructed, it can be signed using the ECDSA algorithm. For security reasons, we suggest all exchanges to adopt offline signatures. The signing process is described here: https://github.com/tronprotocol/Documentation/blob/master/English_Documentation/TRON_Protocol/Procedures_of_transaction_signature_generation.md

## 10.4 Demo
The demo for local transaction construction and signing can be found at:
https://github.com/tronprotocol/wallet-cli/blob/master/src/main/java/org/tron/demo/TransactionSignDemo.java.

# 11. Migration plan
Token migration from ERC20 TRX to Mainnet TRX will occur between June 21st – June 25th (GMT+8). If your TRX is held on an exchange, no action is required. If your TRX is held in a wallet, you must deposit your TRX to an exchange before June 24, 2018 to avoid any losses. From June 21st– 25th, TRX withdrawals on exchanges will be suspended. On June 25th, both TRX deposits and withdraws on exchanges will be suspended. Deposits and withdraws will resume on June 26th. During this period, TRX trading will not be affected. If your TRX is held in a wallet and you were not aware of the migration notice, or saw the migration notice after June 25th, please visit our permanent token-exchange counter to exchange your tokens for mainnet TRX.

# 12. Relevant files
See also: https://github.com/tronprotocol/Documentation#documentation-guide

