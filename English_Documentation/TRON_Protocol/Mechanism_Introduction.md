## Account creation

You can generate an offline private key pair, including an address and a private key, which will not be recorded by TRON. To create an account with this private key pair, you will need to make a transfer of at least 1 TRX to this address with an existing account on TRON. Upon successful transfer, you will have created a new account at the corresponding address.

## Guidelines for Super Representative application

All willing users can apply to become Super Representatives. But to prevent malicious attacks, we have set up a threshold for admittance—to run for Super Representative, 100,000 TRX in the applicants’ account will be burnt. After successful application, users can run for Super Representatives.

## Freezing/unfreezing balance

### Why freeze our tokens?

The balance freeze mechanism is set up out of two considerations:
+ To prevent malicious spam transactions from clogging the internet and causing delayed transaction confirmation.
+ To prevent malicious voting.

### Freeze/unfreeze mechanism

Once balance is frozen, users will received a proportionate amount of Tron Power (TP) and Entropy. The Tron Power is your votes and Entropies used in transactions. Their usage and means of calculation will be introduced in following sections.

Frozen asset are held in your frozen account and cannot be used for trading.

More TPs and Entropies can be obtained by freezing more balance. Date to unfreeze balance will be renewed to 3 days after the latest freeze.

Fixed frozen duration is 3 days, after which you can unfreeze your balance any time you like manually. The unfrozen balance will be transferred back into your current account.

+ The freeze command is as follows: 

```
freezebalance password amount time
amount: the unit of frozen balance is drop. The minimum balance frozen is 1,000,000 drop, or 1 TRX.
time: frozen duration lasting from date of freeze and date to unfreeze is 3 days.
```

+ e.g.

    `freezebalance 123455 10_000_000 3`

+ Unfreeze command:

    `unfreezebalance password`

##Block-production reward for Super Representatives`

Each time a Super Representative finishes block production, reward will be sent to the subaccount in the superledger. Super Representatives can check but not directly make use of this asset. A withdrawal can be made once every 24 hours, transferring the reward from the subaccount to the Super Representative’s account.

## Super Representative Election

Every account in TRON’s network is entitled to vote for the Super Representatives they support. Voting requires TPs, which is determined by users’ current amount of frozen balance.

Calculation of TPs: 1 TP for 1 frozen TRX.

Once you unfreeze your balance, an equivalent amount of TPs is also lost, meaning that previous votes casted may no longer be valid. You can refreeze your balance to regain validity of votes.

Note: TRON network only keeps record of the latest votes, meaning that every new allocation of votes you make will replace all previous records.

+ e.g.

```
freezebalance 123455 10_000_000 3// 10 Tron Powers for 10 frozen TRX
votewitness123455 witness1 4 witness2 6//4 votes for witness1 and 6 votes for witness2
vote witness 123455 witness1 10// 10 votes for witness1
```
The final result of the above commands is 10 votes for witness1 and no vote for witness2.

## Entropy

Too many transactions will clog our network like Ethereum and slow transaction confirmation. To keep the network operating smoothly, TRON network only allows every account to initiate a transaction for free every once every 10 seconds. To engage in transactions more frequently requires entropy. Like Tron Power, Entropy can be obtained through freezing TRX.

Calculation of Entropy: amount of frozen balance*days*constant. Note that the unit of frozen balance is drop, and the current constant is 1.

e.g. Suppose 1 TRX (1,000,000 drop) is frozen for a fixed duration of 3 days, Entropy=1,000,000*3*1=3,000,000

Aside from inquiry, all transactions, ranging from transfer, asset migration, voting to balance freeze, occurring more frequently than once every 10 seconds consumes Entropy. Every contract consumes 100,000 Entropies. 

Note: When balance unfreezes, Entropy will not be cleared. New entropies will be accumulated when more TRX is frozen.

## Token issuance

In TRON’s network, every account is capable of issuing tokens. Users can lock their tokens in separately.

+ e.g. 

`assetissue 123456 abc 1000000 1 1 2018-5-31 2018-6-30 abcdef a.com 200000 180 300000 365`

Tokens named abc are issued with the above command, with a capitalization of 1 million. The exchange rate of abc to TRX is 1:1. Twenty million abc tokens will be locked for 280 days while another thirty million tokens will be locked for 365 days.
