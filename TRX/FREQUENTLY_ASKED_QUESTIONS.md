It is our main net API command documentation:

https://github.com/tronprotocol/java-tron/blob/develop/src/main/protos/api/api.proto

Minimum the API command that you need,:

1. get general info of the wallet (ex: bitcoin getinfo)
GetAccount 

2. get balance of an address (ex: bitcoin getbalance)
GetAccount

3. create an address to receive deposit (ex: bitcoin getnewaddress)
You can create an address at local system.
And you can call rpc api createAccount or TransferAsset or CreateTransaction (TransferContract) by another account will create account on blockchain.

4. retrieve list of transaction history of the wallet (ex: bitcoin listtransactions)
GetTransactionsFromThis、GetTransactionsToThis

5. a way to check address is valid or not (regex or API command)
   A  check in local--- After decode58check at local. You get a byte array, the length must 21 and the first byte is 0x41(mainnet) or 0xa0(testnet). 
   If you want to verify that the address exists on the block chain. You can call GetAccount.
