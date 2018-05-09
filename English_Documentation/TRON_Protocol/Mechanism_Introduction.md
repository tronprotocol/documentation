## How to create account

Accounts cannot be created directly. New accounts can only be created by making transfers to inexistent accounts, with a minimum transfer of 1 TRX.

## How to create witness 

It takes **100,000** TRX to become establish a witness account. These TRX will be burnt immediately.

## How to freeze/unfreeze balance

Once balance is frozen, users will receive a proportionate amount of shares and bandwidth. The shares are your votes and bandwidth is used for transactions. Their usage and means of calculation will be introduced in following sections.

Frozen assets will transfer from account Balance to Frozen, which will be reversed once balance unfreezes. Frozen assets cannot be used for transactions.

When in need of more shares or bandwidth, users can freeze more balance to obtain more shares and bandwidth. Date to unfreeze balance will be renewed to 3 days after the latest freeze.

Assets can be unfrozen after the date to unfreeze.

+ The freeze command is as follows:
 
```
freezebalance password amount time
Amount: freeze balance in drops, with a minimum of 1_000_000drops, equivalent to 1 TRX.
Time: frozen time, the interval between freezing asset and unfreezing is at least 3 days. 
```

+ Exapmle:

    `freezebalance 123455 10,000,000 3`

    Unfreeze command is as follows:

    `unfreezebalance password`

## How to withdraw block producing reward

Upon complete block production, reward will be sent to allowance in user’s account. Withdrawal can be made once every 24 hours, transferring reward from allowance to balance. Asset in allowance cannot be locked or traded.

## How to vote

Voting requires shares, which can be obtained through balance freezing.

Calculation of shares: 1 share for 1 frozen TRX.   

Once unfrozen, previous votes casted will be invalid, which can be prevented by refreezing balance.

**Note:** TRON network only keeps record of the latest votes, meaning that every new vote you make will replace all previous records.

+ Example:

```
freezebalance 123455 10_000_000 3 // 冻结了10TRX，获取了10单位股权 votewitness 123455 witness1 4 witness2 6 // 同时给witness1投了4票，给witness2投了6票 votewitness 123455 witness1 10 // 给witness1投了10票
e.g. freezebalance 123455 10_000_000 3// 10 shares for 10 frozen TRX
votewitness123455 witness1 4 witness2 6//4 votes for witness1 and 6 votes for witness2
vote witness 123455 witness1 10// 10 votes for witness1

The final result of the above commands is 10 votes for witness1 and no vote for witness2.
```

## How to calculate bandwidth

Calculation of bandwidth: frozen asset * days * constant. 

Suppose 1 TRX is frozen (1,000,000 DROP) for a duration of 3 days, then bandwidth=1,000,000*3*1=3,000,000. 

All contracts consume bandwidth, including transfer, migration of asset, voting, freezing balance, etc. Inquiries do not consume bandwidth while for every contract about 100,000 bandwidths is consumed.

If a new operation exceeds a given amount of time (**10s**) from the last contract, if does not consume any bandwidth.  

Bandwith is not removed for balance freezing. New bandwidths will be accumulated upon acts of balance freezing.