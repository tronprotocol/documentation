## CPU,Storage 消耗机制


### CPU消耗
顺序如下：

1. 按照合约中设置的比例消耗合约创建者冻结的CPU，若不足优先扣除合约创建者剩余所有CPU
2. 剩余消耗需调用者提供
3. 调用者消耗顺序（优先消耗调用者冻结获取的CPU，为保证合约可正常执行，不足部分通过销毁TRX相抵）
4. 若创建者无冻结CPU资源，则所有消耗需调用者提供

### Storage消耗
顺序如下：

1. 按照合约中设置的比例消耗合约创建者购买获得的Storage，若不足优先扣除合约创建者持有的所有Storage
2. 剩余消耗需调用者提供
3. 调用者消耗顺序（优先消耗调用者购买所得Storage，为保证合约可正常执行，不足部分通过会有系统自动购买）
4. 若创建者无冻结Storage资源，则所有消耗需调用者提供

### 相关接口

##### getTransactionInfoById
```
getTransactionInfoById needs 1 parameter, transaction id
```
相关字段

```
CpuFee: //本次合约消耗TRX数量(剩余CPU不足导致销毁的TRX)
2400
CpuUsage: //本次合约消耗的CPU数量(包括合约创建者和合约调用者消耗的CPU，不包含消耗CpuFee对应的)
120
NetFee: //本次合约因Bandwidth不足消耗的TRX
0
NetUsage: //本次合约消耗的Bandwidth(不包含NetFee对应的)
252
StorageFee: //本次合约因Storage不足临时购买消耗的TRX
0
StorageDelta: //本次合约消耗的Bandwidth(**包含**StorageFee对应的)
0
OriginCpuUsage: //本次合约有合约创建者提供的CPU
120
OriginStorageDelta: //本次合约有合约创建者提供的Storage
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

### 使用说明

部署合约和调用合约的过程中需传入参数 "fee_limit"



本次执行总共消耗

#### 注意事项：

通过销毁TRX获得CPU：1 CPU = 30 SUN

合约中调用其他合约使用gas()方法时，只能限制CPU使用量无法限制Storage，
考虑到调用者对消耗量的控制避免出现理解上的偏差，不建议使用gas()方法。

#### 相关名词：

合约创建者：即创建合约的账户

合约调用者：即调用合约的账户

CPU资源：执行合约过程中消耗时间所对应的资源类型

Storage资源：执行合约后磁盘消耗所对应的资源类型
