## Transaction Contract Types

As the basic transaction unit on the TRON network, contracts exist in different forms. This document elaborates on each contract and the parameters.

## Create account

`AccountCreateContract`contains 3 parameters：
`owner_address`：contract holder address, for example： *“0xu82h…7237”*.
`account_address`: the account address to be created
`type`：account type, for example：*0* the type of account represented is`Normal`

     message AccountCreateContract {
       bytes owner_address = 1;
       bytes account_address = 2;
       AccountType type = 3;
     }


## Transfer

or Translation `TransferContract`contains 3 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`to_address`： target account address.
`amount`：transfer amount; the unit is sun.

     message TransferContract {
       bytes owner_address = 1;
       bytes to_address = 2;
       int64 amount = 3;
     }


## Tokens issued by transfer

`TransferContract`contains 4 parameters：
`asset_name`：name of the token issued
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*.
`to_address`： target account address.
`amount`：amount of tokens transferred.

     message TransferAssetContract {
       bytes asset_name = 1;
       bytes owner_address = 2;
       bytes to_address = 3;
       int64 amount = 4;
     }


## Super node vote

`VoteWitnessContract`contains 3 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`vote_address`： the super node candidate's address.
`vote_count`：votes for the super node candidate.
`votes`：the list of super node candidates
`support`：support or not. It should constantly be "true". This parameter has not been used so far.

     message VoteWitnessContract {
       message Vote {
         bytes vote_address = 1;
         int64 vote_count = 2;
       }
       bytes owner_address = 1;
       repeated Vote votes = 2;
       bool support = 3;
     }


## Create super node candidate

`WitnessCreateContract`contains 2 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*.
`url`：the URL of the Super Representative(SR) candidate.

     message WitnessCreateContract {
       bytes owner_address = 1;
       bytes url = 2;
     }


## Issue tokens

`AssetIssueContract`contains 17 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`name`：Name of the tokens issued, for example：*“SiCongcontract”*。 `abbr`：.
`total_supply`：the amount of tokens issued, for example：*100000000*。
`frozen_supply`：the list of the amount and duration of frozen tokens
`trx_num`：the equivalent TRX amount, for example：*232241*。
`num`： the equivalent custom amount of assets.
`start_time`：starting time, for example：*20170312*。
`end_time`：finishing time, for example：*20170512*。
`order`：When the asset_name is the same, the value of the order increases.The inital value is 0.
`vote_score`：contract rating, for example：*12343*。
`description`：Token description, for example：*”trondada”*。
`url`：the URL link of the token.
`free_asset_net_limit`：free available bandwidth for transferring this specific asset of each account.
`public_free_asset_net_limit`：free available bandwidth for transferring this specific asset of all accounts.
`public_free_asset_net_usage`：free bandwidth used by all acounts for transferring this specific asset.
`public_latest_free_net_time`：the amount of time used on free bandwidth when the token was most recently transferred

     message AssetIssueContract {
       message FrozenSupply {
         int64 frozen_amount = 1;
         int64 frozen_days = 2;
       }
       bytes owner_address = 1;
       bytes name = 2;
       bytes abbr = 3;
       int64 total_supply = 4;
       repeated FrozenSupply frozen_supply = 5;
       int32 trx_num = 6;
       int32 num = 8;
       int64 start_time = 9;
       int64 end_time = 10;
       int64 order = 11; // the order of tokens of the same name
       int32 vote_score = 16;
       bytes description = 20;
       bytes url = 21;
       int64 free_asset_net_limit = 22;
       int64 public_free_asset_net_limit = 23;
       int64 public_free_asset_net_usage = 24;
       int64 public_latest_free_net_time = 25;
     }


## Super node candidate URL update

`WitnessUpdateContract`contains 2 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`update_url`： the updated URL of the super node candidate

     message WitnessUpdateContract {
       bytes owner_address = 1;
       bytes update_url = 12;
     }


## Purchase issued tokens

`ParticipateAssetIssueContract`contains 4 parameters:
`owner_address`：the contract holder's address, for example *“0xu82h…7237”*。
`to_address`：the address of the token issuer
`account_name`： name of the token issued, including name and order
`amount`：the amount of the TRX used to purchase issued tokens, the unit is sun.

     message ParticipateAssetIssueContract {
       bytes owner_address = 1;
       bytes to_address = 2;
       bytes asset_name = 3;
       int64 amount = 4;
     }


## Account update

`AccountUpdateContract`contains 2 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`account_name`： name of the account, for example： *"SiCongsaccount”*。

     // Update account name. Account name is not unique now.
     message AccountUpdateContract {
       bytes account_name = 1;
       bytes owner_address = 2;
     }


## Freeze assets

`FreezeBalanceContract`contains 4 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`frozen_balance`：the amount of frozen assets
`frozen_duration`：the frozen duration
`resource`： specify the type of resources to gain when TRX is frozen

     message FreezeBalanceContract {
       bytes owner_address = 1;
       int64 frozen_balance = 2;
       int64 frozen_duration = 3;
       ResourceCode resource = 10;
     }


## Release assets

`UnfreezeBalanceContract`contains 2 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`resource`： specify a type of resources to lose

     message UnfreezeBalanceContract {
       bytes owner_address = 1;
       ResourceCode resource = 10;
     }


## Claim rewards

`WithdrawBalanceContract`contains 1 parameter：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。

     message WithdrawBalanceContract {
       bytes owner_address = 1;
     }


## Release issued tokens

`UnfreezeAssetContract`contains 3 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。

     message UnfreezeAssetContract {
       bytes owner_address = 1;
     }


## Assets update

`UpdateAssetContract`contains 3 parameters：
`owner_address`：the contract holder's address, for example *“0xu82h…7237”*。
`description`：description of the token.
`url`：URL.
`new_limit`：.
`new_public_limit`： .

     message UpdateAssetContract {
       bytes owner_address = 1;
       bytes description = 2;
       bytes url = 3;
       int64 new_limit = 4;
       int64 new_public_limit = 5;
     }


## Create proposal

`ProposalCreateContract`contains 2 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`parameters`： proposeal.

     message ProposalCreateContract {
       bytes owner_address = 1;
       map<int64, int64> parameters = 2;
     }


## Proposal Approval

`ProposalApproveContract`contains 3 parameters：
`owner_address`：the contract holder's address, for example *“0xu82h…7237”*。
`proposal_id`：the ID of the proposal
`is_add_approval`：approve or not.

     message ProposalApproveContract {
       bytes owner_address = 1;
       int64 proposal_id = 2;
       bool is_add_approval = 3; // add or remove approval
     }


## Delete proposal

`ProposalDeleteContract`contains 2 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`proposal_id`：the ID of the proposal.

     message ProposalDeleteContract {
       bytes owner_address = 1;
       int64 proposal_id = 2;
     }


## Account setting

`SetAccountIdContract`contains 2 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`account_id`：Account ID.

     // Set account id if the account has no id. Account id is unique and case insensitive.
     message SetAccountIdContract {
       bytes account_id = 1;
       bytes owner_address = 2;
     }


## Create smart contract

`CreateSmartContract`contains 2 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`new_contract`： smart contract

     message CreateSmartContract {
       bytes owner_address = 1;
       SmartContract new_contract = 2;
     }


## Trigger smart contract

`TriggerSmartContract`contains 4 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`contract_address`： contract address
`call_value`：TRX value.
`data`：contract parameters.

     message TriggerSmartContract {
       bytes owner_address = 1;
       bytes contract_address = 2;
       int64 call_value = 3;
       bytes data = 4;
     }


## Update contract

`UpdateSettingContract`contains 3 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`contract_address`：contract address
`consume_user_resource_percent`：The percentage of the resources consumed by the account which will be updated.

     message UpdateSettingContract {
       bytes owner_address = 1;
       bytes contract_address = 2;
       int64 consume_user_resource_percent = 3;
     }


## Create exchange

`ExchangeCreateContract`contains 5 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`first_token_id`： the ID of the first type of token
`first_token_balance`： the balance of the first type of token
`second_token_id`：the ID of the second type of token
`second_token_balance`：the balance of the second type of token

     message ExchangeCreateContract {
       bytes owner_address = 1;
       bytes first_token_id = 2;
       int64 first_token_balance = 3;
       bytes second_token_id = 4;
       int64 second_token_balance = 5;
     }


## Finance an exchange

`ExchangeInjectContract`contains 4 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`exchange_id`： the ID of the trading pair.
`token_id`：the ID of the financing token.
`quant`：the amount of the financing tokens.

     message ExchangeInjectContract {
       bytes owner_address = 1;
       int64 exchange_id = 2;
       bytes token_id = 3;
       int64 quant = 4;
     }


## Withdraw capital from an exchange

`ExchangeWithdrawContract`contains 4 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`exchange_id`： the ID of the trading pair.
`token_id`：the ID of the withdrawing token.
`quant`：the amount of the withdrawing tokens.

     message ExchangeWithdrawContract {
       bytes owner_address = 1;
       int64 exchange_id = 2;
       bytes token_id = 3;
       int64 quant = 4;
     }


## Transactions at the exchanges

`ExchangeTransactionContract`contains 4 parameters：
`owner_address`：the contract holder's address, for example： *“0xu82h…7237”*。
`exchange_id`： the ID of the trading pair.
`token_id`：the ID of the token to be sold.
`quant`：the amount of the tokens to be sold.

     message ExchangeTransactionContract {
       bytes owner_address = 1;
       int64 exchange_id = 2;
       bytes token_id = 3;
       int64 quant = 4;
     }
