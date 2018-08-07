# Set up Your Own DApp Environment

Version 0.1

## Introduction

Currently, we can reduce the cost of development by setting up a smart contract environment on TRON's private chain, which does not consume the resource of public chains. TRON's virtual machine is highly compatible with that of Ethereum, and most smart contracts written in Solidity can also run on TRON network. TRON-based smart contracts provide high TPS and free access to most scenarios for its users- this is undoubtedly a significant step for the entire smart contract community. Up to this point, we've completed the underlying part of TRON virtual machine (TVM), and an ecosystem centered around TVM including various development tools is also underway. This article intends to introduce a basic method to deploy smart contracts and to interact with them.

## Prerequisites

### The Network for Running the Contract

Deploying and using contract will need to consume a certain amount of resource (memory, CPU, and storage etc.). Therefore, it is recommended that the developers tune and test their smart contracts on their private networks and confirm that the contract is available before deploying them on the TestNet or MainNet. Please see [Deployment of FullNode (PrivateNet: Just one witness node) on the one host.](https://github.com/tronprotocol/TronDeployment) for further details on building a private network.

The address of the private chain's block-creation node: TPL66VK2gCXNCD7EJg9pgJRfqcRazjhUZY

Witness Private Key: da146374a75310b9666e834ee4ad0866d6f4035967bfc76217c5a495fff9f0d0 

### Wallet Client

Wallet-cli is TRON Network's command-line wallet. Developers can use wallet-cli to post and deploy contracts on the MainNet as well as execute other operations.

## Development of Smart Contracts

At this point, we recommend [Remix](http://remix.ethereum.org/) as the coding language for compiling and testing during the early stages. After the contract is finished, developers can copy the contract to [SimpleWebCompiler](https://github.com/tronprotocol/tron-demo/tree/master/SmartContractTools/SimpleWebCompiler) for further development and then acquire ABI and ByteCode. We present a simple example of contract code of data access to illustrate the process of compiling, deployment, and debugging.

    pragma solidity ^0.4.0;
    contract DataStore {
    
        mapping(uint256 => uint256) data;
    
        function set(uint256 key, uint256 value) public {
            data[key] = value;
        }
    
        function get(uint256 key) view public returns (uint256 value) {
            value = data[key];
        }
    }
    

### 1. Initiate the Private Chain

Make sure that the private chain in the prerequisite has been successfully deployed by checking FullNode/logs/tron.log and see if log message "Produce block successfully" of persistent block generation appears.

### 2. Develop Smart Contracts

Copy the code mentioned above to Remix to compile and debug. Make sure that logic of the code is correct, and the code itself is bug-free.

### 3. Compile in SimpleWebCompiler to acquire ABI and ByteCode

The compiler of TRON is slightly different from that of Ethereum and is still integrating with Remix. Therefore, we are providing a temporary way of acquiring ABI and ByteCode instead of acquiring them directly from Remix. Copy the code above to SImpleWebCompiler and click the Compile button to attain ABI and ByteCode.

### 4. Deploy Smart Contract via Wallet-cli

Download Wallet-Cli and compile on it.

```shell
# Download source code
git clone https://github.com/tronprotocol/wallet-cli
cd  wallet-cli
# Compile
./gradlew build
cd  build/libs
```

> Note: Wallet-cli's default setting will connect to the full node of 127.0.0.1:50051. Developers can make the change in config.conf if they need to connect to a different node or interface.

Initiate Wallet-Cli

    java -jar wallet-cli.jar
    

After initiation, input the command interactively to the portal. Import the private key and inquire if the remaining balance is correct.

```Shell
importwallet
<Enter your custom wallet password twice>
<Enter prive key：da146374a75310b9666e834ee4ad0866d6f4035967bfc76217c5a495fff9f0d0>
login
<Enter your custom wallet password>
getbalance
```

Contract Deployment

```Shell
# Contract Deployment Command
deploycontract <contract_name> <ABI> <code><max_cpu_usage>  <max_net_usage>  <max_storage_useage> <value>

# Parameter Definition
ABI: ABI json data acquired from SimpleWebCompiler
code: binary code
max_cpu_usage: maximum amount of available cpu
max_net_usage: maximum amount of available network
max_storage_useage: maximum amount of available storage
value: use 32-bit hex to denote the transferred value when deploying the contract 

# Sample
deploycontract DataStore [{"constant":false,"inputs":[{"name":"key","type":"uint256"},{"name":"value","type":"uint256"}],"name":"set","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"key","type":"uint256"}],"name":"get","outputs":[{"name":"value","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"}] 608060405234801561001057600080fd5b5060de8061001f6000396000f30060806040526004361060485763ffffffff7c01000000000000000000000000000000000000000000000000000000006000350416631ab06ee58114604d5780639507d39a146067575b600080fd5b348015605857600080fd5b506065600435602435608e565b005b348015607257600080fd5b50607c60043560a0565b60408051918252519081900360200190f35b60009182526020829052604090912055565b600090815260208190526040902054905600a165627a7a72305820fdfe832221d60dd582b4526afa20518b98c2e1cb0054653053a844cf265b25040029 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000
```

A message of "Deploy the contract successfully" will be displayed upon the success of contract deployment

Acquiring addresses of the contracts

    Your smart contract address will be: <contract address>
    
    # In this example
    Your smart contract address will be: TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6
    

Call the contracts to store and query data

```Shell
# The command of calling the contract
triggercontract <contract address> <function signature> <Input Parameter> <Hex> <max_cpu_usage>  <max_net_usage>  <max_storage_useage> <value>

# Parameter Definition
Contract address: The address of the previously deployed contract with the format of base58, for example: TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6
Function signature: The signature of the desired function, for example, set (uint256, uint256) or fool(). Parameters need to be separated with ',' with no space 
Input parameter: For non-hex, use ',' to separate natural input, with no space; for hex, enter directly
Hex: Whether the input parameter is hex, false or true
max_net_usage: available amount of network resources
max_storage_usage: available amount of storage
value: Use 32-bit hex to denote the transferred value when deploying the contract

# Example
## Set the mapping 1->1
triggercontract TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6 set(uint256,uint256) 1,1 false 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000

## Extract the value with the mapping key of 1
triggercontract TTWq4vMEYB2yibAbPV7gQ4mrqTyX92fha6 get(uint256) 1 false 1000000 1000000 10000000 0000000000000000000000000000000000000000000000000000000000000000
```

If the called function is constant or VIEW, wallet-cli will return the results directly.