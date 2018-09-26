# TRON decentralized exchange

### 1. What is a trading pair (Exchange)

The TRON network natively supports decentralized exchanges. A decentralized exchange consists of multiple trading pairs. A trading pair (Exchange) is an Exchange Market between token and token, or between token and TRX. Any account can create a trading pair between any tokens, even if the same pair already exists in the TRON network. Trading and price fluctuations of the trading pairs follow the Bancor Protocol. The TRON network stipulates that the weights of the two tokens in all trading pairs are equal, so the ratio of their balance is the price between them. For example, let's say a trading pair contains two tokens, ABC and DEF. ABC has a balance of 10 million and DEF has a balance of 1 million. Since their weights are equal, 10 ABC = 1 DEF — that is, the price of ABC to DEF is 10ABC/DEF.

### 2. Create a trading pair

Any account can create a trading pair between any tokens. The fee for creating a trading pair is 1024 TRX, which will be burned by the TRON network.   
Creating a trading pair is equivalent to injecting the original capital for the trading pair, so the creator must have the original balance of the trading pair in his account. When the creation is successful, the balance of the two tokens is immediately deducted from the account.   
The contract for creating a trading pair is ExchangeCreateContract, which has 4 parameters:

- first_token_id, the id of the first token
- first_token_balance, the balance of the first token
- second_token_id, the id of the second token
- second_token_balance, balance of the second token

The token id is obtained by the name of the token. For details, see the documentation on token issuance. If the trading pair contains TRX, use "_" to indicate the id of TRX. Note that the unit of TRX is sun, which is 10-6 TRX.   
Example: `ExchangeCreate abc 10000000 _ 1000000000000 ` The transaction will create a trading pair between abc and TRX. The initial balance is 10000000 abc and 1000000000000 sun (1000000TRX) respectively. If the creator does not have enough abc and TRX, the trading pair creation will fail; otherwise, the appropriate amount of abc and TRX is deducted immediately from the account of the creator，which means that the trading pair is created successfully and you can start trading.

### 3. Trading

Any account can conduct trading in any trading pair. The trading volume and the trading price are in full compliance with the Bancor Protocol. That is to say, when an account is trading, the object of the trading is exchange. The trading is instant, without the need to make/take orders; as long as there are enough tokens, the trading will be successful.   
The trading contract is ExchangeTransactionContract, which has 3 parameters:

    - exchange_id, the id of the trading pair: the TRON network will give each trading pair a unique id based on the order of the time when the pair was created
    - token_id, the id of the token to be sold
    - quant, the amount of the token to be sold


Example:   
We are trading in the abc/TRX trading pair that we just created: assuming the id of the trading pair is 1, the abc balance in the current pair is 10000000, the TRX balance is 1000000, if you want to spend 100 TRX to buy abc, then   
`ExchangeTransaction 1 _ 100 `   
where "_" represents TRX, that is, 100 TRX are sold to the trading pair. If successful, the trading will add 100 TRX to the trading pair and calculate the reduced amount of abc based on the Bancor protocol. The number of abc and TRX in the account of the creator will increase and decrease accordingly.

### 4. Capital Injection (Inject)

When a trading pair has a small balance of one of the tokens, just a small trading volume will cause a significant price fluctuation, which interferes with normal trading. To avoid this, the creator of the trading pair may choose to inject capital to the trading pair. Only the creator of a trading pair can inject capital to the pair. There is no processing fee for capital injection.   
A designated token and a specific amount of injection are required in this process. The TRON network will automatically calculate the amount of the other token according to the ratio of the two tokens in the current trading pair, so as to ensure that the ratio of the two tokens and the price in the trading pair remain the same before and after the capital injection.   
Same as creating a trading pair, capital injection requires the creator to have enough balance for both tokens.   
The contract for capital injection is ExchangeInjectContract, which has three parameters:

    - exchange_id, the id of the trading pair
    - token_id, the id of the token to receive the capital injection
    - quant, the amount of the token to receive the capital injection


Example:   
We are injecting capital in the abc/TRX trading pair that we just created: assuming the id of the trading pair is 1 (the first trading pair in the TRON network), the abc balance in the current pair is 10000000, the TRX balance is 1000000, if you want to increase abc by 10%, then `ExchangeInject 1 abc 1000000`  
If successful, the trading will add 1000000 abc to the trading pair, as well as 100000 TRX. The amount of abc and TRX in the account of the trading pair creator will increase and decrease accordingly.

### 5. Withdrawal of capital (withdraw)

All assets in a trading pair belong to the creator. The creator can withdraw at any time to redeem the token in the trading pair back to his own account. Only the creator can withdraw from the trading pair. No processing fee is required for withdrawal.   
Like capital injection, the withdrawal requires a designated token and a specific amount of withdrawal. The TRON network will automatically calculate the amount of capital withdrawn from the other token according to the ratio of the two tokens in the current trading pair, thus ensuring that the ratio of the two tokens and the price in the trading pair remain the same before and after the withdrawal.   
[Risk Warning] The price will not change before and after the withdrawal, but the price fluctuation will be greater   
The contract for withdrawal is ExchangeWithdrawContract, which has 3 parameters:

    - exchange_id, the id of the trading pair
    - token_id, the id of the token to perform the withdrawal
    - quant, the amount of the token to perform the withdrawal


Example:   
We are withdrawing capital in the abc/TRX trading pair that we just created: assuming the id of the trading pair is 1, the abc balance in the current pair is 10000000, the TRX balance is 1000000, if you want to redeem 10% of the abc, then   
`ExchangeWithdraw 1 abc 1000000`  
If successful, the trading will reduce 1000000 abc, as well as 100000 TRX in the trading pair. The amount of abc and TRX in the account of the trading pair creator will increase accordingly.
