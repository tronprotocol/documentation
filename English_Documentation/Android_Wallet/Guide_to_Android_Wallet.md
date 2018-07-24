# Guide for Android

## Introduction

TRON Wallet is a multifunctional Android wallet for the TRON network. It gives you the possibility to interact quickly and easily with your account or to keep your TRX and other account data safe in a cold wallet setup. This app offers you one of the safest ways to protect your private data. The TRON Wallet, along with other TRON projects, is aimed to strengthen the community by establishing improved accessibility and communication for its users.

### Features
Create Wallet
+ encrypts private information with a password
+ creates a private/public key pair
+ creates a 24 words recovery phrase (human readable private key recovery phrase) (BIP39)

### Import Wallet
+ import with private key or 24 words recovery phrase
+ import public address only (watch only setup)

### Wallet Functionalities
+ individual connection (connect to any node, e.g. private net)
+ check balance (TRX, tokens)
+ toggle market price view
+ check frozen amount
+ send TRX and tokens
+ receive using QR code
+ freeze TRX to get votes and bandwidth
+ submit votes for representatives
+ offline signing mechanism with QR code scanning
+ participate in token distributions
+ manually set your node connection

### Block Explorer
+ see latest blocks
+ see latest transactions
+ see representative candidates
+ see connected nodes
+ see token distributions
+ see accounts
+ search filter

### Wallet Setups

Watch only setup
+ import only your public address
+ completely safe because no private information is accessible
+ you have a full overview of your account
+ creates unsigned transactions (used in combination with a cold wallet setup)

Hot Wallet Setup
+ owns public and private key
+ a full overview of account
+ full access (sending, freezing, voting, ...)

Cold Wallet Setup
+ minimalistic and safest wallet
+ owns public and private key
+ never connects to the internet (to be completely secure you should never connect your device to the internet)
+ signs transactions (from watch only setup)

## Check information on blocks and recent transactions  

![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/查看相关信息/区块和交易信息.png)

## Check SR candidate information  

![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/查看相关信息/查看SP候选信息.png)

## Check node information  

![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/查看相关信息/查看节点信息.png)

## Participate in token offerings
   + select the token you’d like to buy
   + select quantity of purchase  

![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/查看相关信息/查看token信息.png)  

![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/查看相关信息/选择购买数量.png)

## Check account information  

![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/查看相关信息/查看账户信息.png)

## Import wallet
+ import public address only (watch-only setup)
+ or import with private key or 24-word recovery phrase

![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/倒入钱包/导入钱包.png)

## Create account

1. Cellphone screen display.  
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/创建钱包账户/1.桌面显示.png)
2. Account creation page in app.  
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/创建钱包账户/2.点击app之后的界面.jpg)
3. Tap CREATE WALLET.  
   + Cold wallet creation: toggle COLD WALLET SETUP, tick I AM AWARE OF THE RISKS and set the name and password.
   + Hot wallet creation: don’t toggle COLD WALLET SETUP, tick I AM AWARE OF THE RISKS and set the name and password.
   ![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/创建钱包账户/3.设置用户名和密码.png)  
4. Tap GENERATE ADDRESS AND PRIVATE KEY and tap OK after reading the information page.  
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/创建钱包账户/4.png)  
![](https://raw.githubusercontent.com/ybhgenius/Documentation/master/images/Wallet_for_Android/创建钱包账户/6.png)
5. Make sure to save your private key and 24-word recovery phrase.  
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/创建钱包账户/7.钱包创建好之后的页面%20now%20we%20see%20here%20is%20a%20public%20address%20%2Cprivate%20key%20and%2024%20words%20recovery%20phrase.jpg)
6. Tap continue and enter wallet page.    
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/创建钱包账户/8.创建号钱包之后下滑页面找到continue按钮.jpg)

## Voting

Users can vote in hot wallet setup.

1. Enter wallet page.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/1.余额TP带宽显示界面.png)
2. Enter transfer page.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/2.点击右侧的转账界面.png)
3. Select freeze and enter freeze page.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/3.freeze页面.png)
4. Type in freeze amount.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/4.在freeze%20amount%20输入栏中键入希望冻结的TRX数量，然后点击freeze按钮，注，拥有多少冻结TRX就拥有多少投票权.jpg)
5. Enter your password，click send button and confirm the freeze.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/5.确认合约.png)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/6输入密码点击发送.png)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/7.发送成功.png)

6. Return to balance page and click the vote button on the left-hand side.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/9.点击投票按钮.png)
7. Enter SR candidate page.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/10.点击投票按钮之后进入超级代表候选人list页面，candidates一栏下显示的是所有待投票竞选的SR候选人.jpg)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/11.此为your%20votes页面下的显示情况，因为我们还没有对任何一个SR候选节点进行投票，所以列表中空空如也.png)
8. Select a SR candidate and enter the amount of votes.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/12.我们回到candidates一栏，任意选择一个SR候选人进行投票演示，以list中首个系节点为例，注，candidates%20list%20的排列是以票数多少为顺序.jpg)
9. Tap SUBMIT, enter the amount of votes and your password and submit votes.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/13.输入希望为此节点投出的票数.jpg)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/14.点击submit%20votes之后要求输入账户密码进行确认投票.jpg)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/16.png)
10. You can check your votes in the candidates tab and in the votes tab.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/17.为此候选人投过票后此候选人右侧显示你为其透过的票数.jpg)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/投票/18.这个时候我们可以看到在your%20votes一栏中与投票前不同的是出现了我们为其投过票的SR候选人信息.jpg)

## Initiate transfer

1. Enter account page.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/转出和转入/转入/1.显示余额界面.png)

2. Enter your address or scan QR-code to extract address. Enter the amount of TRX for transfer and tap SEND.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/转出和转入/转入/3.点击右侧转账按钮后出现的界面（默认停留在send也就是转出TRX时的操作页面）可以通过在to一栏输入转入地址也可以点击右侧的二维码小标志，打开二维码扫描页面.png)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/转出和转入/转入/4.点击receive后显示自己的钱包地址和二维码性质的地址，可供转出账户进行输入和scan，待转出账户操作完毕后，点击左上角返回箭头进行余额查看.jpg)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/转出和转入/转出/6.输入希望转入的额度点击send.png)
3. Enter account password and tap SEND, and you will see the message of SENT SUCCESSFULLY.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/转出和转入/转出/7.点击send之后需要输入账户密码进行确认.png)
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/转出和转入/转出/9.png)

## Check history.

1. Enter history page.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/历史记录/1.进入历史记录界面.png)

2. Check each transaction information.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/历史记录/2.查看单笔交易信息.png)

3. Check transaction information on Tronscan.
![](https://raw.githubusercontent.com/tronprotocol/Documentation/master/images/Wallet_for_Android/历史记录/3.tronscan上查看记录.png)
