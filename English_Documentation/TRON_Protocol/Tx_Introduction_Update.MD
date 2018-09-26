# Transactions

### Basic Structure of Transactions

The TRON network accounts consist of three types: ordinary, token, and contract.

- Ordinary account: Users can perform various basic operations.
- Token account: Used by ordinary accounts to issue tokens. Token accounts are currently un-used.
- Contract account: Smart contract accounts. Contract accounts are established by ordinary accounts and can be triggered under certain circumstances.

Basic Structure of Accounts

     message Account {
       /* frozen balance */
       message Frozen {
         int64 frozen_balance = 1;  // The amount of frozen balance in Sun
         int64 expire_time = 2;     // Expire Time
       }
       bytes account_name = 1;      // Account Name
       AccountType type = 2;        // Account Type
       // the create address
       bytes address = 3;           // Account Address
       // the trx balance
       int64 balance = 4;           // Account TRX Balance
       // the votes
       repeated Vote votes = 5;     // Number of votes of all super node candidates
       // the other asset owned by this account
       map<string, int64> asset = 6;// Name of other asset+order and the mapping list of remaining balance
       // latest asset operation time

       // the frozen balance
       repeated Frozen frozen = 7;  // List of frozen TRX
       // bandwidth, get from frozen
       int64 net_usage = 8;         // Usage of bandwidth points that are acquired by freezing TRX

       // Time to Create the Account
       int64 create_time = 0x09;    //Account creation time
       // this last operation time, including transfer, voting and so on. //FIXME fix grammar
       int64 latest_opration_time = 10; // The last operation time of the account, including transfer, voting, etc.
       // witness block producing allowance
       int64 allowance = 0x0B; // allowance received
       // last withdraw time
       int64 latest_withdraw_time = 0x0C; // latest withdrawal time
       // not used so far
       bytes code = 13;
       bool is_witness = 14; // Is it a super node candidate
       bool is_committee = 15; // Is it a committee member
       // frozen asset(for asset issuer)
       repeated Frozen frozen_supply = 16; // Freeze the issued asset list
       // asset_issued_name
       bytes asset_issued_name = 17; // Name of the asset issued, one account can only issue one type of asset.
       map <string, int64> latest_asset_operation_time = 18;

       int64 free_net_usage = 19; // Free Bandwidth points usage
       map<string, int64> free_asset_net_usage = 20; // Free Bandwidth points usage for operating each issued asset
       int64 latest_consume_time = 21; / The last time to use frozen TRX to gain Bandwidth points
       int64 latest_consu Me_free_time = 22; // The last time to use free Bandwidth points
       bytes account_id = 23; // Account ID

       message AccountResource {
         // energy resource, get from frozen
         int64 energy_usage = 1; // Get Energy usage by freezing TRX
         // the frozen balance for energy
         Frozen frozen_balance_for_energy = 2; // The balance of TRX frozen for Energy
         int64 latest_consume_time_for_energy = 3; // The last time to get Energy by consuming frozen TRX

         // storage resource , get from market
         int64 storage_limit = 6; // Maximum limit of Energy consumption for storage
         int64 storage_usage = 7; // amount of Energy consumption for storage
         int64 latest_exchange_storage_time = 8;
       }
       AccountResource account_resource = 26; // account resources Profile information

       bytes codeHash = 30;
    }


Basic Structure of Transactions

     message Transaction {
       message Contract {
         enum ContractType {
           AccountCreateContract = 0;
           TransferContract = 1;
           TransferAssetContract = 2;
           VoteAssetContract = 3;
           VoteWitnessContract = 4;
           WitnessCreateContract = 5;
           AssetIssueContract = 6;
           WitnessUpdateContract = 8;
           ParticipateAssetIssueContract = 9;
           AccountUpdateContract = 10;
           FreezeBalanceContract = 11;
           UnfreezeBalanceContract = 12;
           WithdrawBalanceContract = 13;
           UnfreezeAssetContract = 14;
           UpdateAssetContract = 15;
           ProposalCreateContract = 16;
           ProposalApproveContract = 17;
           ProposalDeleteContract = 18;
           SetAccountIdContract = 19;
           CustomContract = 20;
           // BuyStorageContract = 21;
           // BuyStorageBytesContract = 22;
           // SellStorageContract = 23;
           CreateSmartContract = 30;
           TriggerSmartContract = 31;
           GetContract = 32;
           UpdateSettingContract = 33;
           ExchangeCreateContract = 41;
           ExchangeInjectContract = 42;
           ExchangeWithdrawContract = 43;
           ExchangeTransactionContract = 44;
         }
         ContractType type = 1;
         google.protobuf.Any parameter = 2;
         bytes provider = 3;
         bytes ContractName = 4;
       }

       message Result {
         enum code {
           SUCESS = 0;
           FAILED = 1;
         }
         enum contractResult {
           DEFAULT = 0;
           SUCCESS = 1;
           REVERT = 2;
           BAD_JUMP_DESTINATION = 3;
           OUT_OF_MEMORY = 4;
           PRECOMPILED_CONTRACT = 5;
           STACK_TOO_SMALL = 6;
           STACK_TOO_LARGE = 7;
           ILLEGAL_OPERATION = 8;
           STACK_OVERFLOW = 9;
           OUT_OF_ENERGY = 10;
           OUT_OF_TIME = 11;
           JVM_STACK_OVER_FLOW = 12;
           UNKNOWN = 13;
         }
         int64 fee = 1;
         code ret = 2;
         contractResult contractRet = 3;

         int64 withdraw_amount = 15;
         int64 unfreeze_amount = 16;
       }

       message raw {
         bytes ref_block_bytes = 1;
         int64 ref_block_num = 3;
         bytes ref_block_hash = 4;
         int64 expiration = 8;
         repeated authority auths = 9;
         // data not used
         bytes data = 10;
         //only support size = 1,  repeated list here for extension
         repeated Contract contract = 11;
         // scripts not used
         bytes scripts = 12;
         int64 timestamp = 14;
         int64 fee_limit = 18;
       }

       raw raw_data = 1;
       // only support size = 1,  repeated list here for muti-sig extension
       repeated bytes signature = 2;    // Signature list of transaction initiators; Currently only supports one of them
       repeated Result ret = 5;
     }


### Transaction Fee

Transactions in the TRON network are generally free, but due to the limitations of the system resources and to ensure a fair principle, there are certain restrictions on Bandwidth points, CPU, and storage resources in the network.

- Ordinary transactions only consume Bandwidth points. A certain amount of Bandwidth points can be gained by freezing TRX; there are also free Bandwidth points available in the account. When the Bandwidth points are insufficient, TRX will be burned.
- The operation of smart contracts not only consumes Bandwidth points, but also consumes Energy. As with Bandwidth points, you can get a certain amount of Energy by freezing TRX. When Energy is insufficient, TRX will be burned.
- All query transactions are completely free, without consuming Bandwidth points or Energy.

# Signature Process of Transactions

## I. Instructions

1. Take the trading rawdata and transform it into byte[] format
2. Perform sha256 algorithm to rawdata
3. The result of sha256 is signed by the private key of the transaction initiator (as of now, generally there is one contract and one private key).
4. Add the signature to the transaction.

## II. Signature Algorithm

1. ECDSA algorithm, SECP256K 2, Signature sample data

    priKey:::8e812436a0e3323166e1f0e8ba79e19e217b2c4a53c970d4cca0cfb1078979df 
    pubKey::04a5bb3b28466f578e6e93fbfd5f75cee1ae86033aa4bbea690e3312c087181eb366f9a1d1d6a437a9bf9fc65ec853b9fd60fa322be3997c47144eb20da658b3d1 
    hash:::159817a085f113d099d3d93c051410e9bfe043cc5c20e43aa9a083bf73660145 
    r:::38b7dac5ee932ac1bf2bc62c05b792cd93c3b4af61dc02dbb4b93dacb758123f 
    s:::08bf123eabe77480787d664ca280dc1f20d9205725320658c39c6c143fd5642d 
    v:::0


Note: the signature should be 65 bytes. 32 for r, 32 for s, and 1 for v.

3. When fullnode receives the transaction, it will perform verification. An address is generated by the calculation via hash and r, s, v, and is compared with the address in the contract — if the two addresses prove to be the same, the transaction will pass the verification.

## III. Sample Code

    public static Transaction sign(Transaction transaction, ECKey myKey) {   Transaction.Builder transactionBuilderSigned = transaction.toBuilder();    byte[] hash = sha256(transaction.getRawData().toByteArray());   List<Contract> listContract = transaction.getRawData().getContractList();   for (int i = 0; i < listContract.size(); i++) {     ECDSASignature signature = myKey.sign(hash);     ByteString bsSign = ByteString.copyFrom(signature.toByteArray());     transactionBuilderSigned.addSignature(         bsSign);//Each contract may be signed with a different private key in the future.  }
