# Tron Bug Bounty Program

On May 31, 2018, day of the mainnet launch, TRON Foundation launched Tron Bug Bounty Program with a highest reward of USD$10 million. It is aimed at discovering potential technical vulnerabilities in the mainnet with the help of TRON’s community members, especially those who specialize in global network security, to sustain TRON mainnet as the most secure public blockchain in the industry and to provide secure and stable infrastructure and services to DApps deployed on the mainnet. We take the security of TRON mainnet very seriously. If you have made an important discovery of potential bugs, please contact us and join the TRON Bug Bounty Program as soon as possible and we will surely offer generous rewards!

## Guidelines on Bug Bounty

+ Bug Bounty begins on May 31, 2018, after the mainnet launch and ends on June 24, 2018.
+ We will give our feedback on the bug reports and update developers on our progress.
+ On June 30, rewards will be announced on TRON’s official forum at tronsr.org. Rewards will be disbursed within 7 working days after the announcement.
+ Before the bug is successfully fixed, please do not disclose any detail on the bug to anyone other than TRON Foundation.
+ We welcome developers to join our official Slack community after making the bug report for follow-up communication on bug fix.
+ Please do not maliciously leak or tamper with account information.
+ Please do not perform any malicious attack which could damage the reliability or integrity of our service or data.

## Rewards

+ The highest single reward for this program is USD$10 million.
+ There are three security levels for the bugs: fatal bugs, advanced bugs and intermediate bugs.
+ For a report which contains several bugs, if they share an origin of the same underlying bug or are interrelated, we will regard and reward theses bugs as one single bug discovery.
+ If several members report on the same bug, reward will be awarded to the earliest submission verified by TRON Foundation.
+ All rights of interpretation of reward amount are reserved to TRON Foundation.

## Scope of bugs

You can look for potential bugs in the following two code repositories:
+ java-tron:   https://github.com/tronprotocol/java-tron 
+ wallet-cli:   https://github.com/tronprotocol/wallet-cli

Also, please note that we have limited the scope of eligible bugs, meaning that only bugs fulfilling the following requirements can earn rewards.

## Eligible bugs for Bug Bounty reward include:

+ Fatal bugs for USD$100,000 and up: bugs which can take control of java-tron nodes by remote execution of any code.
+ Fatal bugs for USD$50,000 and up: bugs which can lead to private key leakage.
+ Advanced bugs for USD$10,000 and up: bugs which can incur Denial of Service (DoS) in java-tron through P2P network.
+ Advanced bugs for USD$10,000 and up: bugs which can incur Denial of Service (DoS) in java-tron through RPC-API.
+ Intermediate bugs for USD$6,000 and up: bugs which can incur Denial of Service (DoS) in java-tron through TRON Protocol.
+ Intermediate bugs for USD$6,000 and up: bugs allowing unauthorized operations on user accounts.

## Out of Scope 

These following locations are considered out of scope for the bug bounty rewards. If you find issues with these projects, **PLEASE** file issues on the respective repositories if possible.

+ tronscan.org : https://github.com/tronscan/tronscan-frontend
+ tron.network
+ tronlab.com
+ any third party partners

## How to report bug

Please submit bug report to bug@tron.network with the subject line reading [Bounty-mainnet].

The email should include the following contents:
+ Source of the bug, e.g. tronprotocol/java-tron.
+ Your personal assessment of the severity of the bug as severe/moderate/minor.
+ A summary of the bug.
+ A detailed description of the bug.
+ Instructions to encounter the bug.
+ Other supplementary materials such as source code, screenshots or logs.
+ Impact analysis on the security risks an attacker can create with the bug.
+ You preferred means of contact.

## Legal statement:

All rights of interpretation of the Bug Bounty are reserved to TRON. TRON Foundations decides whether to reward a bug disclosure and how much will be rewarded. Any individual or team participant should not violate any laws and regulations during testing.
