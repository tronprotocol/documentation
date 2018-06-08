# TRON

## Architecture

![](https://raw.githubusercontent.com/ybhgenius/Documentation/master/images/Architecture.png)

TRON adopts a 3-layer architecture comprised of storage layer, core layer and application layer.

+ Storage Layer

    The tech team of TRON designed a unique distributed storage protocol consisting of block storage and state storage.  
    The notion of graph database was introduced into the design of the storage layer to better meet the need for diversified data storage in the real world.  

+ Core Layer

    Smart contract module, account management module and consensus module are three modules of the core layer. It’s TRON’s vision to base its functions on a stacked virtual machine and optimized instruction set.  
    In order to better serve the development of DApps, Java is designated as the language for smart contracts, which is to be further supplemented by other high-level programming languages.  
    In addition, innovations are made to TRON’s consensus on the basis of DPOS to fulfill its special needs.

+ Application Layer

    Developers can utilize interfaces for the realization of diverse DApps and customized wallets.  
    The protocol of TRON adheres in entirety to Google Protobuf, intrinsically supporting multi-language extension.

## Consensus

+ Improved Consensus Mechanism based on DPOS

    High energy consumption, low efficiency and low TPS are always an issue with POW consensus, which is completely opposite from TRON’s values and design. Under the guidance of our architectural philosophy, we have chosen to adopt the POS mechanism as the basis of TRON consensus. Having gained knowledge on constructive ideas in the blockchain community through research, we made improvements to the DPOS mechanism to meet up with our demands, thereby coming up with the TRON consensus.

+ Basic Rules of the Consensus Mechanism

    + Coin holders are to vote for nodes in accordance with their holding of coins with a ballot. And nodes are elected to become what are known as witnesses based on the result of the votes and certain other rules, which tries, to its utmost capacity, to strike a balance between speed of block production and the number of witnesses.
    + Meanwhile, compensation will be made to unelected nodes, voters for both elected nodes and unelected nodes, in order to encourage them to run for future elections.
    + Witnesses will produce valid blocks successively based on specific distribution rules and success to do so results in the highest reward. 
    + The vast majority of witnesses are chosen through votes and the rest are selected with an equal chance under a certain algorithm.

## Storage Structure

+ KhaosDB

    TRON has a KhaosDB in the full-node memory that can store all the new fork chains generated within a certain period of time and supports witnesses to switch their own active chain swiftly into a new main chain. 

+ Level DB

    Level DB will be initially adopted with the primary goal to meet the requirements of fast R/W and rapid development. After launching the main net, TRON will upgrade its database to an entirely customized one catered to its very own needs.

## Token Module

+ Configuration

    Users can customize their own token through TKC (token configuration) functions.
    Customizable parameters include, but are not exclusive to, token name, abbreviation, LOGO, total capitalization, exchange rate of TRX, starting date, expiring date, attenuation coefficient, controlled inflation model, inflation period, description, etc.
    Users can chose to stay with the default parameters of the system if it’s their option to not customize their own. 

+ Issue/Deployment

    Users can issue their tokens after setting up the parameters (manually customized or system default).
    System comes with operations and functions, and that allow issuers to deploy digital token, which has already been validated and customized. (Customized and validated tokens can proceed to function and operation setup for deployment.)
    Customized token is deployed once witnesses successfully validate, and can be freely circulated on TRON network. (Once validated by the witness, customized token is successfully deployed, which enters into online circulation.)

+ API

    API is mainly used for the development of client terminals. With API support, token issuance platform can be designed by developers themselves.

## Smart Contract/ Virtual Machine

The smart contract module of TRON allows users to customize contracts to their own needs.
TRON is home to its own virtual machine, on which Smart contract operates, allowing for developers to customize for diverse and complex functions.

## Third Party Applications

+ Token Deployment Platform 

    Third party developers are granted access to TRON’s network for the development of their own platforms. With the use of TRON’s token module, users of these platforms could also customize their own tokens.

+ Wallet

    With the wallet, users can view their holding of TRX as well as other assets, or initiate or take transactions.

+ Blockchain Explorer

    Blockchain explorer is used for the viewing of block records, list of nodes, node deploymeng and real-time operation of TRON.

## ERC20 Token Migration

Before the launch of TRON’s main net, the migration from ERC20 to TRX, the official token of TRON, will be initiated by TRON foundation. The migration exchange rate is 1:1. The specificities of migration entails further clarification, to which may involve revision might be made before official execution.
	
##Community Plan

The community is always an integral part of any blockchain project, so it is our hope to evoke the members’ passion for full participation in TRON’s construction. This is a belief that we have unwaveringly held since the very inception of our project.

There are numerous ways for TRON’s community members to be a part of the project, for instance, through participation in core programming tasks or third-party development through APIs to be opened up by TRON. Furthermore, a wide variety of competitions open to all users will be held for LOGO design, essay writing, poster design, competitive programming, etc. 

+ Providing Code Types

    + feat: A new feature
    + fix: A bug fix
    + docs: Files of revision
    + perf: A code change that improves performance
    + refactor: A code change that neither fixes a bug nor adds a feature
    + style: A change in text format (excessive blank space, format proofreading, missing punctuation marks, etc.)
    + test: Addition of missing tests or correction to existing tests

+ Reward Plan

    We would like to offer reward to all those who have contributed to the progression and development of TRON’s network and community. A special committee is set up by TRON to conduct close assessment on all participants’ contribution, based on the result of which TRX tokens, gifts, and other forms of reward are offered.

	
## Protocol

TRON adheres to the Google Protobuf protocol, which covers multiple aspects such as accounts, blocks and transfers. 

There are 3 types of accounts: basic account, asset release account, and contract account. Each of those three types has six properties: name, type, address, balance, voting and related asset.

A basic account can apply to be a witness, which possesses other attributes and parameters including voting statistics, public key, URL, history performance, etc.

A block typically consists of several transactions and a blockheader, which is comprised of basic block information like timestamp, root of Merkle tree, parent hash, signature, to name just a few.

There are eight categories of contract transaction: account creation contract, transfer contract, asset transfer contract, asset voting contract, witness voting contract, witness creation contract, asset issuance contract and deployment contract.

Each transaction contains several TXInputs, TXOutputs and other properties.

Signature is required for input, transaction and block header.
    
Inventory, protocol involved in transfers, is mainly used to inform recipient nodes of transmitted data.  

Please find in the appendix the detailed protocol. The specificities of the protocol is subject to change with program upgrading, so please always make reference to the latest version available.


