# Common Integration Patterns

## Generating Addresses

If you need to generate addresses, either as exchange deposit addresses or some way to receive funds, 
you will need to generate an address to use.

#### - Manually Calculate Addresses (Safest)
Follow these steps to create a private key, then calculate out the resulting
- https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md#6-user-address-generation

#### - Use an RPC call 
- `/wallet/generateaddress` to create a `Private Key` and `TRON Address` pair

- `/wallet/createaddress` to pass a `Password String` to generate the matching `TRON Address`. These strings are hashed into private keys so treat them as such.

---

## Sending TRX from an address

TRX transfers require access to the private key or password for the account.

#### - Manually Create, Sign and Broadcast the transfer transaction

1. Use the `/wallet/createtransaction` RPC Call to create a transaction and get the transaction data.
2. Sign the transaction data using `/wallet/gettransactionsign` with a `Private Key`.
3. Or manually sign the transaction data (**Only works with gRPC**) following this [Guide](https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md#103-signature).
4. Broadcast the signed transaction and transaction data onto the network using `/wallet/broadcasttransaction`.

#### - Use an RPC call 
- `/wallet/easytransfer` with a `Password String` to transfer TRX to a destination address.

- `/wallet/easytransferbyprivate` with a `Private Key` to transfer TRX to a destination address.

---

## Reading Transaction from the network

Transactions are confirmed once they're available through the Solidity Node. The Full Node allows you to query 

#### - Use an RPC call for a transaction/transaction list directly
- `/walletsolidity/gettransactionbyid` to retrieve **Confirmed** transactions by ID.
- `/wallet/gettransactionbyid` to retrieve **ALL** transactions by ID, including **Unconfirmed** transactions.
- `/walletextension/gettransactionsfromthis` to retrieve transactions from an address.
- `/walletextension/gettransactionstothis` to retrieve transactions to an address.
- `/walletsolidity/gettransactioninfobyid` to retrieve metadata about a transaction, including fees, block number and block production time.

#### - Use an RPC call for the block
If the block has transactions, it will be listed in the trasactions array. You can parse this to find all the transactions included on that block.

- `/walletsolidity/getblockbynum` to retrieve block by block height/number from the Solidity Node. These blocks are guaranteed confirmed and irreversable. 
- `/wallet/getblockbynum` to retrieve a block by block height/number from the Full Node. These blocks are **NOT** confirmed. 
- `/wallet/getblockbyid` to retrieve by block hash.


---

## Calculating Bandwidth for an Account

Bandwidth is used for all transactions and cost around 200~ for a TRX transfer. Every active account with an age greater than 24 hours starts with 5000 free bandwidth. Used bandwidth replenishes over a 24 hour period. If there isn't enough bandwidth for a transaction, then a fee of 0.002TRX will be charged.

#### - Use an RPC call to query an account's available bandwidth.
- `/wallet/getaccountnet` will retrieve the bandwidth information for an account. If a key isn't present, then the value is 0.

```
{“freeNetUsed”: 557,“freeNetLimit”: 5000,“NetUsed”: 353,“NetLimit”: 5239157853,“TotalNetLimit”: 43200000000,“TotalNetWeight”: 41228}
```




---
