# TRON Token

### Token Issuance

In the TRON network, each account can issue tokens with 1024 TRX in an easy and convenient way. Upon the issuance, multiple tokens can be locked. Token issuance will require a designated token name, total supply of the tokens, exchange rate, issuance period, description, URL, max bandwidth consumed per account, total bandwidth consumed and the amount of frozen tokens.

+ For example:

`assetissue password abc 1000000 1 1 2018-5-31 2018-6-30 abcdef a.com 1000 1000000 200000 180 300000 365`

The above command issued a token named abc with a total supply of 1 million; the exchange rate of abc to TRX is 1:1; the issuance period is 2018-5-31 to 2018-6-30; the token is described as abcdef; its URL is a.com. Each account's daily token transfer consumes up to 1000 bandwidth points of their own, up to 1000000 bandwidth points for the entire network. 200000 tokens of the total supply will be locked for 180 days and 300000 of the total will be locked for 365 days.

### Note: duplicate names of tokens

Duplicate names of tokens are allowed. Tokens with duplicate names will be differentiated by the order field. The token created first will have an order of 0, the one created second will have an order of 1, and so on.

+ Example: (part of the field omitted)

    Asset {   
    name = aaa;   
    order = 0; owner_address = address1; }

    Asset2 {   
    name = aaa;   
    order = 1; owner_address = address2; }

    Account {   
    asset[ { asset_name = aaa;   
    amount = 100; }, { asset_name = aaa_1;   
    amount = 100; } }

There are two assets in the network with the name aaa: the first one has an order of 0, and the second one has an order of 1.

If an account has both tokens, names of the tokens will be aaa and aaa_1 respectively.

During token participation (using the ParticipateAssetIssue api), if the participating token is the second token, the input parameter needs to be aaa_1. Similarly, during token transfer (using TransferAsset api), if the participating token is the second token, the input parameter also needs to be aaa_1. During token querying (using GetAssetIssueByName api), if the participating token is the second token, the input parameter also needs to be aaa_1.

If there is no asset with the same name in the network, the impacts of the order do not need to be taken into consideration.
