# # CPU, storage consumption mechanism

### CPU consumption sequence is as follows:

1. The CPU frozen by the contract creator will be consumed in the proportion set up in the contract. All of the remaining CPU of the contract creator will be deducted first if insufficiency occurs

2. The remaining consumption needs to be provided by the caller

3. Caller consumption order (To ensure the normal execution of the contract, CPU frozen by the caller will be consumed first; TRX burn will make up for the insufficient part)

4. If the creator has no frozen CPU resources, the caller is required to provide all consumption


 ### Storage consumption order is as follows:

 1. Storage purchased by the contract creator will be consumed in the proportion set up by the contract. All of the storage owned by the contract creator will be deducted first if insufficiency occurs
2. The remaining consumption needs to be provided by the caller
3. Caller consumption order (To ensure the normal execution of the contract, the system automatically purchase the insufficient part)
4. If the Contract Issuer does not provide the Storage resources, all the consumption needs to be provided by the caller.

### Related Interface

##### getTransactionInfoById
```
getTransactionInfoById needs 1 parameter, transaction id
```
Related field 
```
CpuFee: //TRX consumed by this contract (TRX burn caused by insufficient CPU remaining)
2400
CpuUsage: //CPU consumed by this contract (including CPU consumed by the contract creator and caller, excluding that consumed by CpuFee)
120
NetFee: //TRX consumed due to insufficient Bandwidth with this contract
0
NetUsage: //Bandwidth consumed by this contract (excluding that related to NetFee)
252
StorageFee: //TRX purchased last-minute due to insufficient Storage with this contract
0
StorageDelta: //Bandwidth consumed by this contract(**Including**that related to StorageFee)
0
OriginCpuUsage: //CPU provided by the contract creator with this contract 
120
OriginStorageDelta: //Storage provided by the contract creator with this contract 
0
```
##### FreezeBalance
```
freezeBalance frozen_balance frozen_duration [ResourceCode:0 BANDWIDTH,1 CPU]
```

##### buyStorage
```
buyStorage quantity 
```

##### buyStorageBytes
```
buyStorageBytes bytes 
```

##### buyStorageBytes
```
sellStorage quantity 
```

Instruction 

Pass the parameter “fee_limit” during the process of contract deployment and contract calling


Total consumption of this execution

Note:

CPU gained by burning TRX: 1 CPU = 30 SUN

合约中调用其他合约使用gas()方法时，只能限制CPU使用量无法限制Storage，
考虑到调用者对消耗量的控制避免出现理解上的偏差，不建议使用gas()方法。
In the contract, calling other contracts and using the gas() method can only limit the CPU usage, not Storage. Considering that callers may have different understanding of consumption control, it’s not suggested to use the gas() method.

Related terms:

Contract creator: account that creates the contract

Contract caller: account that calls the contract 

CPU resource: resource type corresponding to the consumption time of contract execution

Storage resource: resource type corresponding to disk consumption post contract execution 
