Note: Please read this instruction carefully before you use trc10 related functions. 

# 1.BackGround

TRC10 token is a system-level token type in TRON. Compare to TRC20 tokens, TRC10 facing a flexible issue to our user experience.  In Odyssey 3.2, developers and their smart contract caller will be able to interact with TRC10 token via smart contracts according to the contract logic, which give them more possibility of controls to implement their token in more business scenarios.

Unlike a TRC20 token, we keep the way to send TRC10 token consistent with the way transfer TRX in a contract, which means the usage of TRC10 is very similar to the way when use TRX. 

# 2. Transfer TRC10 token to a smart contract account

TRC10 token can be transferred to a smart contract via a contract call, which is involved in two GRPC apis, DeployContract and TriggerContract.

## 2.1 wallet-cli command and Examples

- DeployContract:

 ```deployContract <contractName> <abi> <bytecode> <constructor signature>   <constructor params> <isHex> <feeLimit> <consumer_percentage> <energyLimit> <callValue> <tokenValue> <tokenId>```
 
 e.g:  deploy a contract and transfer 9 tokens those ids are 1000001 from message sender account to the contract account
 
 ```deployContract testContract [{"constant":false,"inputs":[{"name":"value","type":"uint256"}],"name":"f1","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"i","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"}] 6080604052600160005534801561001557600080fd5b50d3801561002257600080fd5b50d2801561002f57600080fd5b5060ef8061003e6000396000f30060806040526004361060485763ffffffff7c010000000000000000000000000000000000000000000000000000000060003504166382e7eb3d8114604d578063e5aa3d5814607c575b600080fd5b348015605857600080fd5b50d38015606457600080fd5b50d28015607057600080fd5b50607a60043560b8565b005b348015608757600080fd5b50d38015609357600080fd5b50d28015609f57600080fd5b5060a660bd565b60408051918252519081900360200190f35b600055565b600054815600a165627a7a72305820cd4cf61efb71c4c984be5b1e4d84459871b6b10a93a80874a8a96fa3685cccb10029 # # false 1000000000 0 100000000 0 9 1000001```
 
- TriggerContract:

 ```triggercontract <contractAddress> <function signature> <function_parameters> <isHex>  <feeLimit> <callValue> <tokenValue> <tokenId>```
 
 e.g:  trigger set function in TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6 and transfer 10 tokens with tokenid 1000001 from msg sender account to contract account.
 
 ```triggercontract TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6 set(uint256, uint256) 1,1 false  1000000       0            10             1000001```
 
## 2.2 New parameters explanation
 
tokenValue: the token amount caller want to send into the contract account from caller’s account

tokenId: the target token identifier, which is a int64 type in ProtoBuf. In Wallet client, use # to represent no tokenId.

>Note: 

>EnergyLimit is a new feature in Odyssey_v3.2, which limit the energy cost when a caller spends developer’s energy. It means the contract owner can set a max energy cost value to avoid other user over use owner’s resource. 

>TokenId is also a new feature in Odyssey_v3.2. It can be found in a new map field called assetV2 in an account. Use GetAccount(Account) to get the tokenId and its value. TokenId is set by the system begin from number 1_000_001. When a new TRC10 token is created, the number add 1 and set the id for this token.


# 3. Interacting with TRC10 token in a smart contract.

## 3.1 TRC10 contract example

```
pragma solidity ^0.4.24;
contract transferTokenContract {
    constructor() payable public{}
    function() payable public{}
    function transferTokenTest(address toAddress, uint256 tokenValue, trcToken id) payable public    {
        require(id > 1000000);
        toAddress.transferToken(tokenValue, id);
    }
    function msgTokenValueAndTokenIdTest() public payable returns(trcToken, uint256){
        trcToken id = msg.tokenid;
        uint256 value = msg.tokenvalue;
        return (id, value);
    }
    function getTokenBalanceTest(address accountAddress) payable public returns (uint256){
        trcToken id = 1000001;
        require(id > 1000000);
        return accountAddress.tokenBalance(id);
    }
}
```

## 3.2 TRCToken type

- Odyssey_v3.2 defined a new type (trcToken) for TRC10 token, which represent the tokenId in a token transfer operation. 

- TRC10 token can be convert to uint256 type and vice versa.


## 3.3 address.transferToken(uint256 tokenValue, trcToken tokenId) native function

- Odyssey_v3.2 defined a new transferToken function for TRC10 token transferring in TRON solidity compiler and also supported in JAVA-TRON. 

- An address type variable can invoke this native function and which means current contract would like to  transfer specific amount of target token from the contract’s account to this address’s account. 

- TransferToken function share very similar mechanism as the transfer(uint256) function. Please be attention that only 2300 energy will be send to this function and also its related fallback function.

- **IMPORTANT**: tokenId valide value must > 1000000. The best-practice would be use a require function to guarantee its correctness.
             
- @deprecated **IMPORTANT**: tokenId = 0 (Only in this function) is preserved here, which is presented TRX. This is a experimental feature, we **DO NOT** recommend to use this logic to transfer TRX at least for now for your safety. Please use the widely used transfer() function to send TRX.

- In Odyssey_v3.5 tokenId is NOT allowed to be 0 in this function. So, the function is only related to trc10 token.

## 3.4 address.tokenBalance(trcToken) returns(uint256 tokenAmount)native function

- Odyssey_v3.2 defined a new tokenBalance function for TRC10 token balance querying.

- An address type variable can invoke this native function which returns the amount of target token owned by the account with the address.

- @deprecated **IMPORTANT**: Query tokenBalance(0) doesn't represent trx balance, instead it will return 0. 

- In Odyssey_v3.5 tokenId is NOT allowed to be 0 in tokenBalance(trcToken) function. 

## 3.5 msg.tokenvalue & msg.tokenid

- msg.tokenvalue, represent the tokenvalue in current msg call, default 0.

- msg.tokenid, represent the token id in current msg call, default 0.

- **IMPORTANT**: msg.tokenid = 0 is just a default value, means no token transferring.


# 4 solidity compiler

## 4.1 Github:
 https://github.com/tronprotocol/solidity/tree/Odyssey_v3.2

## 4.2 Important notes: 

The bytecode generated by new TRON/solidity Odyssey_v3.2 compiler will NOT work before ALLOW_TVM_TRANSFER_TRC10 proposal in JAVA-TRON Odyssey_v3.2 be approved. As a result, TRONSTUDIO and any other tools those depends on our TRON compiler should not import 3.2 compiler and expose to public until ALLOW_TVM_TRANSFER_TRC10 proposal be approved on our chain. 
