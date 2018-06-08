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

## 4. Query of account list  

4.1	Interface statement  
rpc ListAccounts (EmptyMessage) returns (AccountList);  
4.2	Node  
Fullnode and soliditynode.  
4.3	Parameters  
EmptyMessage: null.  
4.4	Returns  
AccountList: Account list.  
4.5	Function  
Query of all account information currently stored in the blockchain.

## 5. Creating account (deleted, no longer available)  

5.1	Interface statement  
rpc CreateAccount (AccountCreateContract) returns (Transaction){};  
5.2	Node  
Fullnode.  
5.3	Parameters  
AccountCreateContract: account type, account name and account address.  
5.4	Returns  
Transaction: returns transaction of account creation. Request broadcasting after acquisition of wallet signature.  
5.5	Function  
Account creation. Creating an account (or opting otherwise) when registering a wallet.

## 6. Account update (to be realized)

6.1	Interface statement  
rpc UpdateAccount (AccountUpdateContract) returns (Transaction){};  
6.2	Node  
Fullnode.  
6.3	Parameters  
AccountUpdateContract: account name and address.  
6.4	Returns  
Transaction: Returns transaction of account creation.   
6.5	Function  
Account name update.

## 7. Vote

7.1	Interface statement  
rpc VoteWitnessAccount (VoteWitnessContract) returns (Transaction){};  
7.2	Node  
Fullnode.  
7.3	Parameters  
VoteWitnessContract: voter address and list of votes; candidate address and number of votes received.  
7.4	Returns  
Transaction: returns transaction of votes  
7.5	Function  
Vote. Coin holders can only vote for Super Representative candidates, with no more votes than the amount of locked balance (see also 26. Balance freeze).

## 8. 1	TRON wallet RPC-API for token issuance

8.1	Interface statement  
rpc CreateAssetIssue (AssetIssueContract) returns (Transaction) {};  
8.2	Node  
Fullnode.  
8.3	Parameters  
AssetIssueContract: issuer address, token name, total capitalization, exchange rate to TRX, starting date, expiry date, attenuation coefficient, votes, detailed description, url, etc.  
8.4	Returns
Transaction: returns transaction of token issuance. Request for transaction broadcasting after acquiring wallet signature.  
8.5	Function  
Token issuance. All users can issue tokens at the cost of 1024 TRX. Following successful issuance, users can exchange for the token with TRX before the designated expiry date.

## 9. Query of list of Super Representative candidates  

9.1	Interface statement  
rpc ListWitnesses (EmptyMessage) returns (WitnessList) {};  
9.2	Nodes  
Fullnode and soliditynode.  
9.3	parameters  
EmptyMessage: null.  
9.4	Returns  
WitnessList: list of witnesses and detailed information of the candidates.  
9.5	Function  
Query of all candidates prior to voting. 

## 10. Application for Super Representative (to be realized)

10.1 Interface statement  
rpc CreateWitness (WitnessCreateContract) returns (Transaction) {};  
10.2 Node
Fullnode.  
10.3 Parameters  
WitnessCreateContract: account address and Url.  
10.4 Returns  
Transaction: Returns   
10.5 function  
All users with an account created on the blockchain can apply to become TRON’s Super Representative candidate.

## 11. Information update of Super Representative candidate (to be realized)

11.1 Interface statement  
rpc UpdateWitness (WitnessUpdateContract) returns (Transaction) {};  
11.2 Node  
Fullnode.  
11.3 Parameters  
WitnessUpdateContract: an account address and Url.  
11.4 Returns  
Transaction: returns transaction of SR application. Request broadcasting after acquiring wallet signature.  
11.5 Function  
Updating the url of SRs.

## 12. Token transfer

12.1 Interface statement  
rpc TransferAsset (TransferAssetContract) returns (Transaction){};  
12.2 Node  
Fullnode.  
12.3 Parameters  
TransferAssetContract: token name, sender’s address, recipient address, and the amount of tokens.  
12.4 Returns  
Transaction: returns transaction of token transfer. Request to broadcast after acquiring wallet signature.  
12.5 Function  
Token transfer. Create a transaction of token transfer.

## 13. Participation in token offering

13.1 Interface statement  
rpc ParticipateAssetIssue (ParticipateAssetIssueContract) returns (Transaction){};  
13.2 Node  
Fullnode.  
13.3 Parameters  
ParticipateAssetIssueContract: participant address, issuer address, token name, and amount of token (in sun).  
13.4 Returns  
Transaction: returns transaction of participation in token offering.  
13.5 Function  
Participation in token offering.

## 14. Query of nodes

14.1 Interface statement  
rpc ListNodes (EmptyMessage) returns (NodeList) {};  
14.2 Nodes  
Fullnode and soliditynode.  
14.3 Parameters  
EmptyMessage: null.  
14.4 Returns  
NodeList: returns a list of nodes, including their IPs and ports.  
14.5 Function  
Listing the IPs and ports of current nodes.

# 15. Query of tokens

15.1 Interface statement  
rpc GetAssetIssueList (EmptyMessage) returns (AssetIssueList) {};  
15.2 Node  
Fullnode and soliditynode.  
15.3 Parameters  
EmptyMessage: null.  
15.4 Returns  
AssetIssueList: AssetIssueContract list and information on issued tokens.  
15.5 Function  
List of all issued tokens. Display of all issued tokens for user’s reference.

## 16. Query of tokens issued by a given account

16.1 Interface statement  
rpc GetAssetIssueByAccount (Account) returns (AssetIssueList) {};  
16.2 Nodes  
Fullnode and soliditynode.  
16.3 Parameters  
Account: address.  
16.4 Returns  
AssetIssueList: AssetIssueContract list.  
16.5 Function  
Query of all tokens issued by a given account.

## 17. Query of token information with token name

17.1 Interface statement  
rpc GetAssetIssueByName (BytesMessage) returns (AssetIssueContract) {};  
17.2 Nodes  
Fullnode and soliditynode.  
17.3 Parameters  
BytesMessage: token name.  
17.4 Returns  
AssetIssueContract: information on the token.  
17.5 Function  
Query of token information with the name. The exclusiveness of token name is ensured on TRON’s network.

## 18. Query of current tokens by timestamp

18.1 Interface statement  
rpc GetAssetIssueListByTimestamp (NumberMessage) returns (AssetIssueList){};  
18.2 Node  
Soliditynode.  
18.3 Parameters  
NumberMessage: current timestamp (the number of milliseconds since 1970)  
18.4 Returns  
AssetIssueList: AssetIssueContract list and detailed information   
18.5 Function  
List of issued tokens by timestamp. Display of current nodes for users’ reference.

## 19. Get current block

19.1 Interface statement  
rpc GetNowBlock (EmptyMessage) returns (Block) {};  
19.2 Nodes  
Fullnode and soliditynode.  
19.3 Parameters  
EmptyMessage: null.  
19.4 Returns  
Block: information on current block.  
19.5 Function  
Access the latest block.


## 20. Get block by block height

20.1 Interface statement  
rpc GetBlockByNum (NumberMessage) returns (Block) {};  
20.2 nodes  
Fullnode and soliditynode.  
20.3 parameters  
NumberMessage: block height.  
20.4 Returns  
Block: block information.  
20.5 function  
Accessing the block at designated height, otherwise returning to the genesis block.

## 21. Get total number of transactions

21.1 Interface statement  
rpc TotalTransaction (EmptyMessage) returns (NumberMessage) {};  
21.2 nodes  
Fullnode and soliditynode.  
21.3 Parameters  
EmptyMessage: null.  
21.4 Returns  
NumberMessage: Total number of transactions.  
21.5 Function  
Accessing the total number of transactions.

## 22. Query of transaction by ID 

22.1 Interface statement  
rpc getTransactionById (BytesMessage) returns (Transaction) {};  
22.2 Node  
Soliditynode.  
22.3 Parameters  
BytesMessage: transaction ID or Hash.  
22.4 Returns  
Transaction:  Queried transaction.  
22.5 Function  
Query of transaction details by ID which is the Hash of transaction. 

## 23. Query of transaction by timestamp 

23.1 Interface statement  
rpc getTransactionsByTimestamp (TimeMessage) returns (TransactionList) {};  
23.2 Node  
Soliditynode.  
23.3 Parameters  
TimeMessage: starting time and ending time.  
23.4 Returns  
TransactionList: transaction list.  
23.5 Function  
Query of transactions by starting and ending time.

## 24. Query of transaction initiations by address (to be realized)

24.1 Interface statement  
rpc getTransactionsFromThis (Account) returns (TransactionList) {};  
24.2 Node  
Soliditynode.  
24.3 Parameters  
Account: initiator account (address).  
24.4 Returns  
TransactionList: transaction list.  
24.5 Function  
Query of transaction initiations by account address.

## 25. Query of transaction receptions by address (to be realized)

25.1 Interface statement  
rpc getTransactionsToThis (Account) returns (NumberMessage) {};  
25.2 Node  
Soliditynode.  
25.3 Parameters  
Account: Recipient account (address).  
25.4 Returns  
TransactionList: transaction list.  
25.5 Function  
Query of all transactions accepted by one given account.

## 26. Freeze Balance  
26.1 Interface statement  
rpc FreezeBalance (FreezeBalanceContract) returns (Transaction) {};  
26.2 Node  
Full Node.  
26.3 Parameters  
FreezeBalanceContract: address, balance to freeze and frozen duration. Currently balance can only be frozen for 3 days.  
26.4 Returns  
Transaction: Return includes a transaction of balance. Request transaction broadcasting after signed by wallet.  
26.5 Function

Two things can be gained through freezing balance:

a.	Bandwidth Points  points. Each update of blockchain transaction consumes bandwidth  points (if more than 10s from the previous transaction, the current transaction does not consume any points). Bandwidth Points  points obtained=suns*frozen duration. Each transaction (all operations altering blockchain accounts) consumes 100,000 bandwidth  points.  
b.	Votes. The amount of votes gained equals to the amount of frozen TRX.

## 27. Unfreeze Balance
27.1 Interface statement  
rpc UnfreezeBalance (UnfreezeBalanceContract) returns (Transaction) {};  
27.2 Node  
Full Node.  
27.3 Parameters  
UnfreezeBalanceContract: address.  
27.4 Returns  
Transaction: returns transaction. Request transaction broadcasting after signed by wallet.  
27.5 Function  
Balance can be unfrozen only 3 days after the latest freeze. Voting records will be cleared upon unfrozen balance, while bandwidth  points won’t be. Frozen balance will not be automatically unfrozen after 3 days’ duration. 

## 28. Block-production reward redemption  
28.1 Interface statement  
rpc WithdrawBalance (WithdrawBalanceContract) returns (Transaction) {};  
28.2 Node  
Full Node.  
28.3 Parameters  
WithdrawBalanceContract: address.  
28.4 Returns  
Transaction: returns transaction. Request transaction broadcasting after signed by wallet.  
28.5 Function  
This interface is only accessible to Super Representatives. Super Representative can obtain reward after successful account keeping. Instead of saved to account balance, rewards will be held independently in account allowance, with 1 permitted withdrawal to account balance every 24 hours.
