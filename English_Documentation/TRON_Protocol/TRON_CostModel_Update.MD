# TRON cost model

There are 3 types of resources in the TRON network: bandwidth, CPU, and storage. Thanks to TRON's unique memory model, the storage is almost infinite. But too many unnecessary transactions consumes a lot of bandwidth and CPU resources, causing system congestion and affecting normal transactions confirmation. In order to maintain the relative fairness of the transactions, Bandwidth Points and Energy are introduced. Bandwidth consumes Bandwidth Points and CPU consumes Energy.   
**Note**

- Normal transactions only consume Bandwidth Points;
- Smart contracts consume Bandwidth Points as well as Energy.

## 1. Bandwidth Points

Transactions are transmitted and stored in the network as byte arrays. The Bandwidth Points consumed by a transaction = Bandwidth Points * Bandwidth Points rate. The current rate = 1.

If the byte array length of a transaction is 200, then the transaction needs to consume 200 Bandwidth Points.

**Note** since the total frozen funds in the network and the frozen funds of accounts may change at any time, the Bandwidth Points owned by accounts are not fixed.

### Sources of Bandwidth Points

Bandwidth Points can be gained in two ways:

- One way is by freezing the TRX. The quota = the TRX frozen for gaining Bandwidth Points / the total TRX frozen in the network for gaining Bandwidth Points * 43_200_000_000, which is the equally-divided fixed Bandwidth Points quota for all users based on the frozen TRX.

- The other way is the fixed 5,000 free TRX quota for each account.

### Bandwith Points consumption

Except enquiry, any other transactions consume Bandwidth Points.

There is another exception. If the target account did not exist in a transfer, normal or token issuance, a new account will be created and the transfer can be done. In this case, only Bandwidth Points consumed by account creation will be deducted. Transfer will not take up extra Bandwidth Points.

### Bandwidth Points Calculating methods

Bandwidth Points are the total number of bytes an account can use in a day. The bandwidth that the entire network can process during a certain period of time is fixed.

If a transaction requires a new account, the Bandwidth Points are consumed as follows:

    1. Try to consume the Bandwidth Points that the transaction initiator has frozen to gain. If the initiator does not have enough Bandwidth Points, then go to the next step.

    2. Try to consume the TRX of the transaction initiator, which means burning 0.1TRX.


If the transaction is a token issuance transfer, the Bandwidth Points are consumed as follows:

    1. First, verify whether the total free Bandwidth Points of the issued token asset are sufficient; Next, verify whether the remaining free Bandwidth Points of the transfer initiator are sufficient; Third, whether the remaining Bandwidth Points the token issuers have frozen to gain are sufficient.
    If any of these three requirements is met, then the Bandwidth Points will be deducted from the token issuer. If not, then go to the next step.

    2. Try to consume the Bandwidth Points obtained by the transaction initiator through frozen assets. If the points are not enough, then go to the next step.

    3. Try to consume the free Bandwidth Points of the transaction initiator. If they are not enough, then go to the next step.

    4. Try to consume the TRX of the transaction initiator, the number of bytes in the transaction * 10 sun.


If it is a normal transaction, Bandwidth Points are consumed as follows:

    1. Try to consume the Bandwidth Points that the transaction initiator gained through frozen assets. If the Points are not enough, then go to the next step.

    2. Try to consume the free Bandwidth Points of the transaction initiator. If they are not enough, then go to the next step.

    3. Try to consume the TRX of the transaction initiator, the number of bytes in the transaction * 10 sun.


## 2. Energy

The creation and operation of a smart contract consume CPU resources. It takes time for smart contracts to operate in virtual machines (VMs), and the time consumed in the system is calculated in microseconds. CPU resources are consumed in energy, which means 1Energy == 1 microsecond. If a contract takes 100 microseconds to execute in a VM, it needs to consume 100 Energy. The total CPU resources provided by the TRON network are 50_000_000_000 Energy within 24 hours.

### Gaining Energy

Energy can only be obtained by freezing the TRX. Energy obtained = the TRX frozen for gaining Energy / the total TRX frozen for gaining Energy in the entire network * 50_000_000_000, which is the equally-divided fixed Energy for all users based on the frozen TRX.

For example, suppose the total amount of TRX frozen for gaining Energy is 1000_000_000 TRX in the current network, and one account freezes 1000 TRX, which is one millionth of the total and equals 32400 microseconds. If executing a contract takes 324 microseconds, then the user can trigger the contract 100 times.

**Note**

- Since the total frozen funds in the network and the frozen funds of accounts may change at any time, the CPU resources owned by accounts are not fixed.
- One cannot get both Bandwidth Points and Energy when freezing funds. If you freeze TRX to get bandwidth, then your Energy will not change.

### Energy consumption

The creation and execution of smart contracts consume Energy, and other normal transactions do not consume Energy.

### Energy calculating methods

Energy is consumed as follows:

    1. Try to consume the Energy that the transaction initiator gained through frozen assets. If it is not enough, then deduct and return the rest. If it is not enough, then deduct whatever it has and go to the next step.

    2. Try to consume the TRX of the transaction initiator, the number of TRX =  Energy needed * 100 sun.
