
**For the specific definition of API, please refer to the following link:**   
[https://github.com/tronprotocol/java-tron/blob/develop/src/main/protos/api/api.proto](https://github.com/tronprotocol/java-tron/blob/develop/src/main/protos/api/api.proto)


**1.&nbsp;Get account information**

Interface statement:  
rpc GetAccount (Account) returns (Account) {}   
Nodes:  
Fullnode and SolidityNode  

**2.&nbsp;TRX transfer**

Interface statement:  
rpc CreateTransaction (TransferContract) returns (Transaction) {}   
Nodes:  
Fullnode  

**3.&nbsp;Broadcast transaction**

Interface statement:  
rpc BroadcastTransaction (Transaction) returns (Return) {}   
Nodes:  
Fullnode  
Description:    
Transfer, vote, issuance of token, or participation in token offering. Sending signed transaction information to node, and broadcasting it to the entire network after witness verification.

**4.&nbsp;Create an account**

Interface statement:  
rpc CreateAccount (AccountCreateContract) returns (Transaction) {}  
Nodes:  
FullNode  

**5.&nbsp;Account name update**
Interface statement:  
rpc UpdateAccount (AccountUpdateContract) returns (Transaction) {}  
Nodes:    
Fullnode   

**6.&nbsp;Vote for super representative candidates**
Interface statement:  
rpc VoteWitnessAccount (VoteWitnessContract) returns (Transaction) {}    
Nodes:  
FullNode    

**7.&nbsp;Issue a token**
Interface statement:  
rpc CreateAssetIssue (AssetIssueContract) returns (Transaction) {}      
Nodes:  
FullNode    

**8.&nbsp;Query of list of super representative candidates**  
Interface statement:  
rpc ListWitnesses (EmptyMessage) returns (WitnessList) {}     
Nodes:  
FullNode and SolidityNode    

**9.&nbsp;Application for super representative**
Interface statement:  
rpc CreateWitness (WitnessCreateContract) returns (Transaction) {}  
Nodes:  
FullNode  
Description:  
To apply to become TRON’s Super Representative candidate.  

**10.&nbsp;Information update of Super Representative candidates**
Interface statement:  
rpc UpdateWitness (WitnessUpdateContract) returns (Transaction) {}      
Nodes:  
FullNode  
Description:  
Update the website url of the SR.  

**11.&nbsp;Token transfer**
Interface statement :  
rpc TransferAsset (TransferAssetContract) returns (Transaction){}     
Node:  
FullNode    

**12.&nbsp;Participate a token**
Interface statement:    
rpc ParticipateAssetIssue (ParticipateAssetIssueContract) returns (Transaction) {}      
Nodes:  
FullNode  

**13.&nbsp;Query the list of nodes connected to the ip of the api**
Interface statement:    
rpc ListNodes (EmptyMessage) returns (NodeList) {}  
Nodes:   
FullNode and SolidityNode   

**14.&nbsp;Query the list of all issued tokens**
Interface statement:    
rpc GetAssetIssueList (EmptyMessage) returns (AssetIssueList) {}    
Node:  
FullNode and SolidityNode    

**15.&nbsp;Query the token issued by a given account**
Interface statement:    
rpc GetAssetIssueByAccount (Account) returns (AssetIssueList) {}   
Nodes:  
FullNode and SolidityNode    

**16.&nbsp;Query the token information by token name**
Interface statement:    
rpc GetAssetIssueByName (BytesMessage) returns (AssetIssueContract) {}    
Nodes:    
FullNode and Soliditynode    

**17.&nbsp;Query the list of tokens by timestamp**
Interface statement:  
rpc GetAssetIssueListByTimestamp (NumberMessage) returns (AssetIssueList){}     
Nodes:  
SolidityNode    

**18.&nbsp;Get current block information**
Interface statement:  
rpc GetNowBlock (EmptyMessage) returns (Block) {}      
Nodes:  
FullNode and SolidityNode    

**19.&nbsp;Get a block by block height**
Interface statement:  
rpc GetBlockByNum (NumberMessage) returns (Block) {}    
Nodes:  
FullNode and SolidityNode  

**20.&nbsp;Get the total number of transactions**
Interface statement:    
rpc TotalTransaction (EmptyMessage) returns (NumberMessage) {}    
Nodes:    
FullNode and SolidityNode      

**21.&nbsp;Query the transaction by transaction id**
Interface statement:  
rpc getTransactionById (BytesMessage) returns (Transaction) {}      
Nodes:    
SolidityNode     

**22.&nbsp;Query the transaction by timestamp**
Interface statement:  
rpc getTransactionsByTimestamp (TimeMessage) returns (TransactionList) {}    
Nodes:    
SolidityNode   

**23.&nbsp;Query the transactions initiated by an account**
Interface statement:    
rpc getTransactionsFromThis (Account) returns (TransactionList) {}   
Node:    
SolidityNode      

**24.&nbsp;Query the transactions received by an account**
Interface statement:  
rpc getTransactionsToThis (Account) returns (NumberMessage) {}     
Nodes:  
SolidityNode      

**25.&nbsp;Freeze TRX**
Interface statement:  
rpc FreezeBalance (FreezeBalanceContract) returns (Transaction) {}     
Nodes:    
FullNode      

**26.&nbsp;Unfreeze TRX**
Interface statement:    
rpc UnfreezeBalance (UnfreezeBalanceContract) returns (Transaction) {}    
Nodes:    
FullNode   

**27.&nbsp;Block producing reward redemption**
Interface statement:  
rpc WithdrawBalance (WithdrawBalanceContract) returns (Transaction) {}   
Nodes:  
FullNode  

**28.&nbsp;Unfreeze token balance**
Interface statement:    
rpc UnfreezeAsset (UnfreezeAssetContract) returns (Transaction) {}      
Nodes:    
FullNode    

**29.&nbsp;Query the next maintenance time**
Interface statement:      
rpc GetNextMaintenanceTime (EmptyMessage) returns (NumberMessage) {}      
Nodes:    
FullNode    

**30.&nbsp;Query the transaction fee & block information**  
Interface statement:    
rpc GetTransactionInfoById (BytesMessage) returns (TransactionInfo) {}     
Nodes:    
SolidityNode    

**31.&nbsp;Query block information by block id**  
Interface statement:      
rpc GetBlockById (BytesMessage) returns (Block) {}      
Nodes:    
FullNode    

**32.&nbsp;Update token information**  
Interface statement:      
rpc UpdateAsset (UpdateAssetContract) returns (Transaction) {}     
Nodes:    
Fullnode      
Description:     
Token update can only be initiated by the token issuer to update token description, url, maximum bandwidth consumption by each account and total bandwidth consumption.    

**33.&nbsp;Query the list of all the tokens by pagination**
Interface statement:    
rpc GetPaginatedAssetIssueList (PaginatedMessage) returns (AssetIssueList) {}    
Nodes:      
FullNode and SolidityNode    

**34.&nbsp;To sign a transaction**  
Interface statement:      
rpc GetTransactionSign (TransactionSign) returns (Transaction) {}    
Nodes:      
FullNode    

**35.&nbsp;Address and private key creation**
35.1 Interface statement:      
rpc CreateAdresss (BytesMessage) returns (BytesMessage) {};
35.2 Node  
Fullnode.  
35.3 Parameters  
BytesMessage: Passphrase  
35.4 Returns  
BytesMessage: address.

**36.&nbsp;TRX easy transfer**
Interface statement:      
rpc EasyTransfer (EasyTransferMessage) returns (EasyTransferResponse) {}    
Nodes:      
FullNode  

**37.&nbsp;Deploy a smart contract**  
Interface statement:     
rpc DeployContract (CreateSmartContract) returns (TransactionExtention) {}  
Nodes:   
FullNode and SolidityNode  

**38.&nbsp;Trigger a smart contract**
Interface statement:    
rpc TriggerContract (TriggerSmartContract) returns (TransactionExtention) {}    
Nodes:    
FullNode   

