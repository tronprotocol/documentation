# Common Integration Patterns

## Generating Addresses

If you need to generate addresses, either as exchange deposit addresses or some way to receive funds, 
you will need to generate an address to use.

#### - Manually Calculate Addresses (Safest)
Follow these steps to create a private key, then calculate out the resulting
- https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md#6-user-address-generation

#### - Use an RPC call 
`/wallet/generateaddress`
Creates a `Private Key` and `TRON Address` pair

`/wallet/createaddress`
Pass a `Password String` to generate the matching `TRON Address`. These strings are hashed into private keys so treat them as such.

---

## Sending TRX from an address

TRX transfers require access to the private key or password for the account.

#### - Manually Create, Sign and Broadcast the transfer transaction

1. Use the `wallet/createtransaction` RPC Call to create a transaction and get the transaction data.
2A. Sign the transaction data using `wallet/gettransactionsign` with a `Private Key`.
2B. Or manually sign the transaction data following this [Guide](https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md#103-signature).
3. Broadcast the signed transaction and transaction data onto the network using `wallet/broadcasttransaction`.

#### - Use an RPC call 
`/wallet/easytransfer` with a `Password String` to transfer TRX to a destination address.

`/wallet/easytransferbyprivate` with a `Private Key` to transfer TRX to a destination address.

---

## Interacting with Transactions

Transactions are only confirmed once they're available on the Solidity Node. Th

#### - Use an RPC call 
`/walletsolidity/gettransactionbyid` to retrieve transactions by ID.

`/walletsolidity/gettransactionsfromthis` to retrieve transactions from an address.

`/walletsolidity/gettransactionstothis` to retrieve transactions to an address.




---

