## For the specific definition of API, please refer to the following link:  
https://github.com/tronprotocol/java-tron/blob/develop/src/main/protos/api/api.proto

## Frequently used APIs:
1. Get general info of the wallet (similar to bitcoin getinfo)  
GetAccount 
2. Get balance of an address (similar to bitcoin getbalance)  
GetAccount
3. Create a new address (similar to bitcoin getnewaddress)  
You can create an address at the local system.  
And you can create a new address on blockchain by calling rpc api createAccount, TransferAsset or CreateTransaction (TransferContract) to make a transfer from an existing account to the new address.
4. Retrieve the list of transaction history by address (similar to bitcoin listtransactions)  
GetTransactionsFromThis  
GetTransactionsToThis
5. check address is valid or not (regex or API command)  
+ Local check--- After decode58check at local, you can get a 21-byte byte array starting with 0x41.   
+ If you want to verify whether an address exists on the blockchain, you can call GetAccount.
