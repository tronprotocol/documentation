## Account creation

You can generate an offline keypair, which includes an address and a private key, that will not be recorded by TRON. In order to create a wallet using this private key, you will need to make a transfer of at least 1 TRX to the new address from an existing TRON's wallet. If the transfer is successful, you will have created a new wallet with the corresponding address.

## Guidelines for Super Representative application

All willing users can apply to become Super Representatives, but to prevent malicious attacks, we have set up a threshold for admittance—to run for Super Representative, 100,000 TRX in the applicants’ account will be burnt. After successful application, users can run for Super Representatives.

## Freezing/unfreezing balance

### Why tokens are frozen?

The balance freezing mechanism is set up out of two considerations:
+ To prevent malicious spam transactions from clogging the network and causing delayed transaction confirmation.
+ To prevent malicious voting.

### Freeze/unfreeze mechanism

Once the balance is frozen, the user will receive a proportionate amount of Justin (J) and Sun. Justin (J) represents voting power whereas Sun is used to pay for transactions. Their usage and means of calculation will be introduced in following sections.

Frozen assets are held in your frozen account and cannot be used for trading.

More Js and Entropies can be obtained by freezing more balance. The balance can be unfrozen after 3 days from the latest freezing.

Fixed frozen duration is 3 days, after which you can unfreeze your balance any time you like manually. The unfrozen balance will be transferred back into your current account.

+ The freezing command is as follows: 

```
freezebalance password amount time
amount: the unit of frozen balance is drop. The minimum balance frozen is 1,000,000 drop, or 1 TRX.
time: frozen duration lasting from date of freeze and date to unfreeze is 3 days.
```

+ e.g.

    `freezebalance 123455 10_000_000 3`

+ Unfreezing command:

    `unfreezebalance password`

##Block-production reward for Super Representatives`

Each time a Super Representative finishes block production, reward will be sent to the subaccount in the superledger. Super Representatives can check but not directly make use of this asset. A withdrawal can be made once every 24 hours, transferring the reward from the subaccount to the Super Representative’s account.

## Super Representative Election

Every account in TRON’s network is entitled to vote for the Super Representatives they support. Voting requires Js, which is determined by users’ current amount of frozen balance.

Calculation of Js: 1 J for 1 frozen TRX.

Once you unfreeze your balance, an equivalent amount of Js is also lost, meaning that previous votes casted may no longer be valid. You can refreeze your balance to regain validity of votes.

Note: TRON network only keeps record of the latest votes, meaning that every new allocation of votes you make will replace all previous records.

+ e.g.

```
freezebalance 123455 10_000_000 3// 10 Justins for 10 frozen TRX
votewitness123455 witness1 4 witness2 6//4 votes for witness1 and 6 votes for witness2
vote witness 123455 witness1 10// 10 votes for witness1
```
The final result of the above commands is 10 votes for witness1 and no vote for witness2.

## Sun

Having too many transactions will clog our network like Ethereum and may incur delays on transaction confirmation. To keep the network operating smoothly, TRON network only allows every account to initiate a transaction for free every once every 10 seconds. To engage in transactions more frequently requires sun. Like Justin, Sun can be obtained through freezing TRX.

Calculation of Sun: amount of frozen balance * days * constant. Note that the unit of frozen balance is drop, and the current constant is 1.

e.g. Suppose 1 TRX (1,000,000 drop) is frozen for a fixed duration of 3 days, Sun=1,000,000 * 3 * 1=3,000,000

Aside from inquiry, all transactions, ranging from transfer, asset migration, voting to balance freeze, occurring more frequently than once every 10 seconds consumes Sun. Every contract consumes 100,000 Entropies. 

Note: When balance unfreezes, Sun will not be cleared. New entropies will be accumulated when more TRX is frozen.

## Token issuance

In TRON’s network, every account is capable of issuing tokens. Users can lock their tokens in separately.

+ e.g. 

`assetissue 123456 abc 1000000 1 1 2018-5-31 2018-6-30 abcdef a.com 200000 180 300000 365`

Tokens named abc are issued with the above command, with a capitalization of 1 million. The exchange rate of abc to TRX is 1:1. 200 thousand abc tokens will be locked for 180 days while another 300 thousand tokens will be locked for 365 days.
