# TRON Wallet RPC-API

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
+ Local check--- After decode58check at local, you can get a 21-byte byte array starting with 0x41 (mainnet) or 0xa0 (testnet).   
+ If you want to verify whether an address exists on the blockchain, you can call GetAccount.

## 1. Getting account information

1.1	Interface statement  
rpc GetAccount (Account) returns (Account) {};  
1.2	Nodes  
Fullnode and soliditynode.  
1.3	Parameters  
Account: type in the address.  
1.4	Returns  
Account: returns all account information.  
1.5	Functions  
Query of balance list. Display of all asset information in account return.

## 2. TRX transfer

2.1	Interface statement  
rpc CreateTransaction (TransferContract) returns (Transaction)　{};  
2.2	Node  
Fullnode.  
2.3	Parameters  
TransferContract: addresses of the sender and the recipient, and amount of transfer (in sun).  
2.4	Returns  
Transaction: returns transaction of transfer contract; request transaction after acquisition of wallet signature.  
2.5	Function  
Transfer. Creation of a transaction of transfer.

## 3. Transaction broadcasting

3.1	Interface statement  
rpc BroadcastTransaction (Transaction) returns (Return) {};  
3.2	Node  
Fullnode.  
3.3	Parameters  
Transaction: transaction signed by wallet. In TRON network, operations entailing change of blockchain status are sealed in the transaction.  
3.4	Returns  
Return: success or failure. Transaction will be initiated and returned with feedback before broadcasting takes place. Note: return of success doesn’t necessarily mean completion of transaction.  
3.5	Function  
Transfer, vote, issuance of token, or participation in token offering. Sending signed transaction information to node, and broadcasting it to the entire network after witness verification.

## 4. Creating account

4.1 Interface statement
rpc CreateAccount (AccountCreateContract) returns (Transaction){};
4.2 Node
Fullnode.  
4.3 Parameters
AccountCreateContract: account type and account address.  
4.4 Returns
Transaction: returns transaction of account creation. Request broadcasting after obtaining wallet signature.  
4.5 Function
Account creation. Creating an account (or opting otherwise) when registering a wallet.

## 5. Account update
5.1 Interface statement
rpc UpdateAccount (AccountUpdateContract) returns (Transaction){};
5.2 Node
Fullnode.  
5.3 Parameters
AccountUpdateContract: account name and address.  
5.4 Returns
Transaction: Returns transaction of account update. Request broadcasting after the transaction is signed by wallet.
5.5 Function
Account name update.

# 6. Vote
6.1 Interface statement
rpc VoteWitnessAccount (VoteWitnessContract) returns (Transaction){};  
6.2 Node
Fullnode.  
6.3 Parameters
VoteWitnessContract: voter address and list of candidates which includes candidate address and number of votes received.  
6.4 Returns
Transaction: returns transaction of votes. Request broadcasting after the transaction is signed by wallet.  
6.5 Function
Vote. Coin holders can only vote for Super Representative candidates, with no more votes than the amount of frozen balance (see also 25. Balance freeze).

## 7. Token issuance
7.1 Interface statement
rpc CreateAssetIssue (AssetIssueContract) returns (Transaction) {};  
7.2 Node
Fullnode.  
7.3 Parameters
AssetIssueContract: issuer address, token name, total capitalization, exchange rate to TRX, starting date, expiry date, attenuation coefficient, votes, detailed description, url, maximum bandwidth consumption, total bandwidth consumption and frozen token.  
7.4 Returns
Transaction: returns transaction of token issuance. Request for transaction broadcasting after the transaction is signed by wallet. 
7.5 Function
Token issuance. All users can issue tokens at the cost of 1024 TRX. Following a successful issuance, users can exchange for tokens with TRX before the designated expiry date.  
Sample:  
`assetissue password abc 1000000 1 1 2018-5-31 2018-6-30 abcdef a.com 1000 1000000 200000 180 300000 365`  
With the above command the token named abc is issued with a total capitalization of 1 million tokens at an exchange rate of 1:1 to trx. Its offering is from May 31-June 30, 2018. It is described as abcdef and can be found at a.com.  
A maximum of 1000 bandwidth points can be charged from the issuer’s account per account per day. The maximum bandwidth points to be charged from the issuer per day is 1000,000. 200,000 tokens will be locked for 180 days while another 300,000 tokens will be locked for 365 days.

## 8. Query of list of Super Representative candidates  
8.1 Interface statement
rpc ListWitnesses (EmptyMessage) returns (WitnessList) {};  
8.2 Nodes
Fullnode and soliditynode.
8.3 Parameters
EmptyMessage: null.  
8.4 Returns
WitnessList: list of witnesses including detailed information of the candidates.  
8.5 Function
Query of all candidates prior to voting returning detailed information on each candidate for users’ reference.

## 9. Application for Super Representative
9.1 Interface statement
rpc CreateWitness (WitnessCreateContract) returns (Transaction) {}; 
9.2 Node
Fullnode.  
9.3 Parameters
WitnessCreateContract: account address and Url.  
9.4 Returns
Transaction: Returns a transaction of candidate application. Request broadcasting after the transaction is signed by wallet.  
9.5 Function
All users with an account created on the blockchain can apply to become TRON’s Super Representative candidate.

## 10. Information update of Super Representative candidates
10.1 Interface statement
rpc UpdateWitness (WitnessUpdateContract) returns (Transaction) {};  
10.2 Node
Fullnode.
10.3 Parameters
WitnessUpdateContract: an account address and Url. 
10.4 Returns
Transaction: returns transaction of SR application. Request broadcasting after the transaction is signed by wallet. 
10.5 Function
Updating the url of SRs.

## 11. Token transfer
11.1 Interface statement rpc TransferAsset (TransferAssetContract) returns (Transaction){};  
11.2 Node
Fullnode. 
11.3 Parameters
TransferAssetContract: token name, sender address, recipient address, and the amount of tokens.  
11.4 Returns
Transaction: returns transaction of token transfer. Request broadcasting after the transaction is signed by wallet.  
11.5 Function
Token transfer. Creates a transaction of token transfer.

## 12. Participation in token offering
12.1 Interface statement
rpc ParticipateAssetIssue (ParticipateAssetIssueContract) returns (Transaction){}; 
12.2 Node
Fullnode. 
12.3 Parameters
ParticipateAssetIssueContract: participant address, issuer address, token name, and amount of token (in sun).  
12.4 Returns
Transaction: returns transaction of participation in token offering. Request broadcasting after the transaction is signed by wallet.  
12.5 Function
Participation in token offering.

## 13. Query of all nodes
13.1 Interface statement
rpc ListNodes (EmptyMessage) returns (NodeList) {};  
13.2 Nodes
Fullnode and soliditynode.
13.3 Parameters
EmptyMessage: null.  
13.4 Returns
NodeList: returns a list of nodes, including their IPs and ports.  
13.5 Function
Listing the IPs and ports of current nodes.

## 14. Query list of all tokens
14.1 Interface statement
rpc GetAssetIssueList (EmptyMessage) returns (AssetIssueList) {};  
14.2 Node
Fullnode and soliditynode.  
14.3 Parameters
EmptyMessage: null.  
14.4 Returns
AssetIssueList: AssetIssueContract list containing information on all issued tokens.  
14.5 Function
Query list of all issued tokens. Display of all issued tokens for user’s reference.

## 15. Query of tokens issued by a given account
15.1 Interface statement
rpc GetAssetIssueByAccount (Account) returns (AssetIssueList) {};  
15.2 Nodes
Fullnode and soliditynode.
15.3 Parameters
Account: address.  
15.4 Returns
AssetIssueList: AssetIssueContract list containing information on all issued tokens.  
15.5 Function
Query of all tokens issued by a given account.

## 16. Query of token information by token name
16.1 Interface statement
rpc GetAssetIssueByName (BytesMessage) returns (AssetIssueContract) {};  
16.2 Nodes
Fullnode and soliditynode.
16.3 Parameters
BytesMessage: token name.  
16.4 Returns
AssetIssueContract: information on the token.  
16.5 Function
Query of token information with the name. The exclusiveness of token name is ensured on TRON’s network.

## 17. Query of current tokens by timestamp
17.1 Interface statement
rpc GetAssetIssueListByTimestamp (NumberMessage) returns (AssetIssueList){};  
17.2 Node
Soliditynode.  
17.3 Parameters
NumberMessage: current timestamp (the number of milliseconds since 1970).  
17.4 Returns
AssetIssueList: AssetIssueContract list including detailed information of the tokens.
17.5 Function
Query list of issued tokens by timestamList of issued tokens by timestamp. Display of current nodes for users’ reference.

## 18. Get current block
18.1 Interface statement
rpc GetNowBlock (EmptyMessage) returns (Block) {};  
18.2 Nodes
Fullnode and soliditynode.
18.3 Parameters
EmptyMessage: null.  
18.4 Returns
Block: information on current block. 
18.5 Function
Inquire the latest block.

## 19. Get block by block height
19.1 Interface statement
rpc GetBlockByNum (NumberMessage) returns (Block) {};  
19.2 Nodes
Fullnode and soliditynode.  
19.3 Parameters
NumberMessage: block height.  
19.4 Returns
Block: block information.  
19.5 Function
Accessing the block at designated height, otherwise returning to the genesis block.

## 20. Get total number of transactions
20.1 Interface statement
rpc TotalTransaction (EmptyMessage) returns (NumberMessage) {};  
20.2 Nodes
Fullnode and soliditynode.  
20.3 Parameters
EmptyMessage: null.  
20.4 Returns
NumberMessage: Total number of transactions.  
20.5 Function
Inquiring the total number of transactions.

## 21. Query of transaction by ID
21.1 Interface statement
rpc getTransactionById (BytesMessage) returns (Transaction) {};  
21.2 Node
Soliditynode.  
21.3 Parameters
BytesMessage: transaction ID or Hash.  
21.4 Returns
Transaction: Queried transaction.  
21.5 Function
Query of transaction details by ID which is the Hash of transaction.

## 22. Query of transaction by timestamp
22.1 Interface statement
rpc getTransactionsByTimestamp (TimeMessage) returns (TransactionList) {};  
22.2 Node
Soliditynode.  
22.3 Parameters
TimeMessage: starting time and ending time.  
22.4 Returns
TransactionList: transaction list.  
22.5 Function
Query of transactions by starting and ending time.

## 23. Query of transaction initiations by address
23.1 Interface statement
rpc getTransactionsFromThis (Account) returns (TransactionList) {};  
23.2 Node
Soliditynode.  
23.3 Parameters
Account: initiator‘s account (address).  
23.4 Returns
TransactionList: transaction list.  
23.5 Function
Query of transaction initiations by account address.

## 24. Query of transaction receptions by address
24.1 Interface statement
rpc getTransactionsToThis (Account) returns (NumberMessage) {};  
24.2 Node
Soliditynode.  
24.3 Parameters
Account: Recipient account (address).  
24.4 Returns
TransactionList: transaction list.  
24.5 Function
Query of all transactions accepted by one given account.

## 25. Freeze Balance
25.1 Interface statement
rpc FreezeBalance (FreezeBalanceContract) returns (Transaction) {};  
25.2 Node
Full Node.  
25.3 Parameters
FreezeBalanceContract: address, amount of trx to freeze and frozen duration. Currently balance can only be frozen for 3 days.  
25.4 Returns
Transaction: Return includes a transaction of balance. Request transaction broadcasting after signed by wallet.  
25.5 Function  
Two things can be gained through freezing balance:
a. Bandwidth Points.  
b. Tron Power.

## 26. Unfreeze Balance
26.1 Interface statement
rpc UnfreezeBalance (UnfreezeBalanceContract) returns (Transaction) {};  
26.2 Node
Full Node.  
26.3 Parameters
UnfreezeBalanceContract: address.  
26.4 Returns
Transaction: returns unfreeze TRX transaction. Request transaction broadcasting after signed by wallet.  
26.5 Function
Balance can be unfrozen only 3 days after the latest freeze. Voting records will be cleared upon unfrozen balance, while bandwidth points won’t be. Frozen balance will not be automatically unfrozen after 3 days’ duration.

## 27. Block-production reward redemption
27.1 Interface statement
rpc WithdrawBalance (WithdrawBalanceContract) returns (Transaction) {};  
27.2 Node
Full Node.  
27.3 Parameters
WithdrawBalanceContract: address.  
27.4 Returns
Transaction: returns withdraw TRX transaction. Request transaction broadcasting after signed by wallet.  
27.5 Function
This interface is only accessible to Super Representatives. Super Representative can obtain reward after successful account keeping. Instead of saved to account balance, rewards will be held independently in account allowance, with 1 permitted withdrawal to account balance every 24 hours.

## 28. Unfreeze balance
28.1 Interface statement  
rpc UnfreezeAsset (UnfreezeAssetContract) returns (Transaction) {};  
28.2 Node  
Fullnode.  
28.3 Parameters  
UnfreezeAssetContract: address.  
28.4 Returns  
Transaction: returns unfreeze token transaction; request broadcasting after the transaction is signed by wallet.  
28.5 Function  
Token issuers can unfreeze locked supply during issuance.

## 29. Query of the next maintenance time
29.1 Interface statement  
rpc GetNextMaintenanceTime (EmptyMessage) returns (NumberMessage) {};  
29.2 Node  
Fullnode.  
29.3 Parameters  
EmptyMessage: no parameter needed.  
29.4 Returns  
NumberMessage: the next maintenance time.  
29.5 Function  
Get the next maintenance time.

## 30. Query of transaction information  
30.1 Interface statement  
rpc GetTransactionInfoById (BytesMessage) returns (TransactionInfo) {};  
30.2 Node  
Soliditynode.  
30.3 Parameters  
BytesMessage: transaction ID  
30.4 Returns  
TransactionInfo: transaction information.  
30.5 Function  
Query of transaction fee, block location and the timestamp of the block.

## 31. Query block by ID  
31.1 Interface statement  
rpc GetBlockById (BytesMessage) returns (Block) {};  
31.2 Node  
Fullnode.  
31.3 Parameter  
BytesMessage: block ID.  
31.4 Returns  
Block: the block.  
31.5 Function  
Query of block by block ID.

## 32. Token update  
32.1 Interface statement  
rpc UpdateAsset (UpdateAssetContract) returns (Transaction) {};  
32.2 Node  
Fullnode.  
32.3 Parameters  
UpdateAssetContract: issuer address, token description, token url, maximum bandwidth consumption by each account and total bandwidth consumption.  
32.4 Returns  
Transaction: returns transaction; request broadcasting after the transaction is signed by wallet.  
32.5 Function  
Token update can only be initiated by the token issuer to update token description, url, maximum bandwidth consumption by each account and total bandwidth consumption.

## 33. Paginated query of token list
33.1 Interface statement  
rpc GetPaginatedAssetIssueList (PaginatedMessage) returns (AssetIssueList) {};
33.2 Nodes  
Fullnode and soliditynode.  
33.3 Parameters  
PaginatedMessage: starting index (0) and the number of tokens displayed on each page. 
33.4 Returns  
AssetIssueList: a paginated list of AssetIssueContract containing detailed information of tokens.  
33.5 Function  
Paginated list of tokens displaying tokens information for users’ reference.

## 34. Transaction signing  
34.1 Interface statement  
rpc GetTransactionSign (TransactionSign) returns (Transaction) {};  
34.2 Node  
Fullnode.  
34.3 Parameters  
TransactionSign: Transaction to be signed and the private key to sign with.  
34.4 Returns  
Transaction: transaction to be signed.

## 35. Address and private key creation
35.1 Interface statement  
rpc CreateAdresss (BytesMessage) returns (BytesMessage) {};  
35.2 Node  
Fullnode.  
35.3 Parameters  
BytesMessage: Passphrase  
35.4 Returns  
BytesMessage: address.

## 36. TRX easy transfer
36.1 Interface statement  
rpc EasyTransfer (EasyTransferMessage) returns (EasyTransferResponse) {};  
36.2 Node  
Fullnode.  
36.3 Parameters  
EasyTransferMessage: password for transfer, toAddress and the amount of tokens to transfer.  
36.4 Returns  
EasyTransferResponse: the transaction of a transfer and the result of broadcasting.

## 37. Generate address and private key  
37.1 Interface statement  
rpc DeployContract (CreateSmartContract) returns (TransactionExtention) {};\
37.2 Nodes  
FullNode and SolidityNode.  
37.3 Parameters  
EmptyMessage: null.  
37.4 Returns  
AddressPrKeyPairMessage: generate address and private key.  
37.5 Function  
Address and private key generation. Please invoke this API only on a trusted offline node to prevent private key leakage.

//todo:translate https://github.com/tronprotocol/Documentation/edit/master/中文文档/波场协议/波场钱包RPC-API.md

## 80. Deploy a smart contract 
80.1 Interface statement  
rpc DeployContract (CreateSmartContract) returns (TransactionExtention) {};\
80.2 Nodes  
FullNode.  
80.3 Parameters  
CreateSmartContract: message type for creating a new smart contract, including owner_address(transaction sender address), new_contract(a SmartContract Object), call_token_value(trc10), token_id(trc10) \
>new_contract: origin_address(contract deployer address), contract_address, abi, bytecode, call_value(trx), consume_user_resource_percent(user energy consume percentage), name(contract name), origin_energy_limit(the energy limit developer willing to afford for a trigger operation).

80.4 Returns  
TransactionExtention: a message type contains transaction, transaction_id, constant_result and on-block result.

## 81. Trigger a smart contract
81.1 Interface statement  
rpc TriggerContract (TriggerSmartContract) returns (TransactionExtention) {};\
81.2 Nodes  
FullNode.  
81.3 Parameters  
TriggerSmartContract: message type for triggering an existing contract, including owner_address(transaction sender address), contract_address, call_value(trx), data(triggered function signature and parameter), call_token_value(trc10), token_id(trc10)\
81.4 Returns  
TransactionExtention: a message type contains transaction, transaction_id, constant_result and on-block result.
