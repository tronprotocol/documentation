## Account creation

You can generate an offline keypair, which includes an address and a private key, that will not be recorded by TRON. In order to create a wallet using this private key, you will need to make a transfer (either in TRX or any other token) to the new address from an existing TRON's wallet. If the transfer is successful, you will have created a new wallet with the corresponding address.

## Guidelines for Super Representative application

All willing users can apply to become Super Representatives, but to prevent malicious attacks, we have set up a threshold for admittance—to run for Super Representative, 9999 TRX in the applicants’ account will be burnt. After successful application, users can run for Super Representatives.

## Freezing/unfreezing balance

### Why tokens are frozen?

The balance freezing mechanism is set up out of two considerations:
+ To prevent malicious spam transactions from clogging the network and causing delayed transaction confirmation.
+ To prevent malicious voting.

### Freeze/unfreeze mechanism

Once the balance is frozen, the user will receive a proportionate amount of TRON Power(TP) and bandwidth. TRON Power(TP) represents voting power whereas bandwidth is used to pay for transactions. Their usage and means of calculation will be introduced in following sections.

Frozen assets are held in your frozen account and cannot be used for trading.

The fixed frozen duration is 3 days, after which you can unfreeze your balance any time you like manually. Balance unfrozen will be transferred back into your current account.

More TP and bandwidth can be obtained by freezing more balance. The balance can be unfrozen after 3 days from the latest freezing.

The fixed frozen duration is 3 days, after which you can unfreeze your balance any time you like manually. Balance unfrozen will be transferred back into your current account.

+ The freezing command is as follows: 

```
freezebalance password amount time
amount: the unit of frozen balance is sun. The minimum balance frozen is 1,000,000 sun, or 1 TRX.
time: frozen duration lasting from date of freeze and date to unfreeze is 3 days.
```

+ e.g.

    `freezebalance password 10_000_000 3`

+ Unfreezing command:

    `unfreezebalance password`

##Block-production reward for Super Representatives`

Each time a Super Representative finishes block production, reward will be sent to the subaccount in the superledger. Super Representatives can check but not directly make use of this asset. A withdrawal can be made once every 24 hours, transferring the reward from the subaccount to the Super Representative’s account.

## Super Representative Election

Every account in TRON’s network is entitled to vote for the Super Representatives they support. Voting requires TP, which is determined by users’ current amount of frozen balance.

Calculation of TP: 1 TP for 1 frozen TRX.

Once you unfreeze your balance, an equivalent amount of TP is also lost, meaning that previous votes casted may no longer be valid. You can refreeze your balance to regain validity of votes.

Note: TRON network only keeps record of the latest votes, meaning that every new allocation of votes you make will replace all previous records.

+ e.g.

```
freezebalance password 10_000_000 3    // 10 bandwidths for 10 frozen TRX
votewitness password witness1 4 witness2 6    //4 votes for witness1 and 6 votes for witness2
vote witness password witness1 3 witness2 7    // 3 votes for witness1 and 7 votes for witness2
```
The final result of the above commands is 3 votes for witness1 and 7 votes for witness2.

## Bandwidth Points

Having too many transactions will clog our network like Ethereum and may incur delays on transaction confirmation. To keep the network operating smoothly, TRON network only allows every account to initiate a limited number of transactions for free every once every 10 seconds. To engage in transactions more frequently requires bandwidth. Like TRON Power(TP), bandwidth can be obtained through freezing TRX.

1. Definition of bandwidth points  
Transactions are transmitted and stored in the network in byte arrays. Bandwidth points consumed in a transaction equals the size of its byte array.  
If the length of a byte array is 100 then the transaction consumes 100 bandwidth points.
2. Calculation of bandwidth points  
Bandwidth points are the number of usable bytes for an account per day.  
Within a given period of time, the entire network could only handle a fixed amount of bandwidth. To TRON’ network, the daily capacity is approximately 54G.  
The ratio of bandwidth points in an account to the bandwidth capacity of TRON’s network equals the ratio of frozen balance in an account to frozen balance on the entire network.  
e.g If frozen asset on the entire network totals 1,000,000 TRX and one given account froze 1,000 TRX, or 0.1% of total TRX frozen, then the account has 0.1%*54GB=54MB bandwidth points for its transactions.  
Note: Since the amount of frozen asset on the entire network and for a certain account are subject to change, bandwidth points held by an account isn’t always fixed.
3. Complimentary bandwidth points  
There are 1K bandwidth points for free per account per day. When an account hasn’t frozen any balance, or when its bandwidth points have run out, complimentary bandwidth points can be used.  
Each transaction in Tron’ network is about 200 bytes, so each account enjoys about 5 transactions for free each day.  
Note: total complimentary bandwidth takes up 1/4 of total bandwidth on the network, amounting to 13.5 GB. When total complimentary bandwidth used exceeds that threshold (meaning too many accounts have used complimentary bandwidth points), even if there are sufficient complimentary bandwidth points in an account, they cannot be used for transaction.
4. Token transfer  
For transactions of token transfer, bandwidth points will first be charged from the token issuer.  
When issuing tokens, the issuer can configure a limit to maximum bandwidth consumption, namely the maximal bandwidth points which can be charged from him/her for a token holder’s token transfers within 24 hours and the maximal total of bandwidth points.  
These two parameters can be configured through updateAsset interface.
5. Consumption of bandwidth points  
Aside from inquiries, any other type of transaction consumes bandwidth points. The bandwidth consumption procedure is as follows:
    + If the transaction isn’t a token transfer, skip to step 2. If the transaction is a token transfer, TRON will try to charge bandwidth points from the token issuer. If the issuer does not have sufficient bandwidth points or the charge is beyond the issuer’s maximal threshold, go to step 2.
    + Bandwidth points will be charged from the initiator. If insufficient, go to step 3.
    + Complimentary bandwidth points will be charged from the initiator. If again insufficient, transaction fails.  
    Note: When balance unfreezes, bandwidth points will be cleared since there is no more frozen TRX.
6. Account creation  
Account creation costs transaction initiator 10,000 bandwidth points.  
Users can create new accounts for token transfer.

## Token issuance

In TRON’s network, every account is capable of issuing tokens. Users can lock their tokens in separately.

To issue token, issuer needs to set up token name, total capitalization, exchange rate to TRX, circulation duration, description, website, maximal bandwidth consumption per account, total bandwidth consumption and token freeze.

+ e.g. 

`assetissue password abc 1000000 1 1 2018-5-31 2018-6-30 abcdef a.com 1000 1000000 200000 180 300000 365 `  

Tokens named abc are issued with the above command, with a capitalization totaling 1 million. The exchange rate of abc to TRX is 1:1. The duration of circulation is May 31-June 30, 2018. It is described as abcdef. The provided website is a.com.

A maximum of 1000 bandwidth points can be charged from the issuer’s account per account per day. A maximum of 1,000,000 bandwidth points can be charged from the issuer’s account for all token holders’ transactions each day. in total capitalization, 200,000 tokens are locked for 180 days and 300,000 are locked for 365 days.

