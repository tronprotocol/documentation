# Freeze/release funds

## Why do we freeze funds?

There are two reasons for setting up a mechanism for freezing funds:

+ To prevent malicious spam transactions from blocking the network and slowing down transaction confirmation;
+ To prevent malicious votes.

## Freeze/release mechanism

When the funds are frozen, you will gain an equivalent amount of TRON power (TP), bandwidth points, and CPU resources.   
**Note that** you need to choose either to gain bandwidth points (the default choice) or CPU resources when the funds are frozen. TP can be used to vote; bandwidth points and CPU resources for transactions. The usages and calculating methods of the above three will be stated later.

The frozen funds will enter your frozen account and cannot be used for trading.

If you need more TP or bandwidth temporarily, you can top up frozen funds to get additional TP and bandwidth. As a result, you can only release the funds 3 days after the last freeze operation.

+ The freeze command is as follows:

    Freezebalance password amount time
    amount: frozen funds, unit: sun. The minimum amount is 1,000,000 sun, which is 1TRX
    time: frozen duration, the time between when the funds are frozen and when they are released is 3 days.


+ For example:

    `freezebalance password 10_000_000 3`

+ The release command is as follows:

    `unfreezebalance password`

# Vote

Every account in the TRON network enjoys the right to vote and you can vote for the Super Representatives (SRs) after your own heart. You need TP to vote and the amount of TP depends on your frozen funds.

TP calculating method: 1 unit of TP for every frozen TRX.

After the release, you don't have any frozen assets and lose all TP accordingly. As a result, all votes become invalid. To prevent this from happening, you can refreeze to vote.

Note that the TRON network only records your last vote, which means that every new vote will negate all previous votes.

+ For example:

    freezebalance password 10,000,000 3 // 10TRX frozen and 10 unit of TP gained
    votewitness password witness1 4 witness2 6 // 4 votes for witness 1 and 6 votes for witness 2 at the same time
    votewitness password witness1 3 witness2 7 // 3 votes for witness 1 and 7 votes for witness 2 at the same time


The final result of the comand is 3 votes for witness 1 and 7 votes for witness 2.
