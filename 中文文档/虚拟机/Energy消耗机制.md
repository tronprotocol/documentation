
## ENERGY 消耗机制

### 名词解释

    合约创建者 : 即创建合约的账户

    合约调用者 : 即调用合约的账户

    Energy   : 智能合约运行时每一步指令都需要消耗一定的资源，资源的多少用energy的值来衡量。

    Freeze   : 冻结，即将持有的trx锁定，无法进行交易，作为抵押，并以此获得免费使用energy的权利。
               具体计算与全网所有账户冻结有关，可参考相关部分计算。

    Feelimit : 用户在调用或者创建智能合约时，指定的最高可接受的trx费用消耗，包含消耗冻结获得资源的trx
               和消耗用户本身持有的trx两部分，优先使用冻结资源。

    CallValue: 用户在智能合约调用或创建时给智能合约本身的账户转账的trx数量，在判断feelimit的时候会抛去这部分的值。

    consume_user_resource_percent: 
               对于一个智能合约来说，付费是由两大部分组成的。一部分是合约开发者付费，
               另一部分是由合约调用者支付。这个值是调用者付费的比例
               
    origin_energy_limit:
               开发者设置的在一次合约调用过程中自己消耗的energy的上限，必须大于0。
               对于之前老的合约，没有提供设置该值的参数，会存成0，但是会按照1000万energy上限计算，
               开发者可以通过updateEnergyLimit接口重新设置该值，设置新值时也必须大于0



### Energy消耗
顺序如下：

1. 按照合约中设置的比例消耗合约创建者冻结的Energy，若不足优先扣除合约创建者剩余所有Energy,剩余消耗需调用者提供
1. 调用者消耗顺序（优先消耗调用者冻结获取的Energy，为保证合约可正常执行，不足部分通过销毁TRX相抵）
1. 若创建者无冻结Energy资源，则所有消耗需调用者提供


### 相关接口

##### getTransactionInfoById 查询包含合约调用或合约创建结果的交易信息
```
getTransactionInfoById needs 1 parameter, transaction id
```
相关字段

```
energy_usage: //本次合约调用者消耗的Energy数量
0
energy_fee: //本次合约调用者消耗TRX数量（SUN）
120
origin_energy_usage: //本次合约创建者提供的Energy数量
0
energy_usage_total: //本次合约总共消耗的Energy数量（包含energy_usage，origin_energy_usage 和energy_fee对应的Energy数量）
252
net_usage: //本次合约消耗的Bandwidth(不包含NetFee对应的)
0
net_fee: //本次合约因Bandwidth不足消耗的TRX
0
```
##### FreezeBalance 冻结获得带宽或能量
```
freezeBalance frozen_balance frozen_duration [ResourceCode:0 BANDWIDTH,1 ENERGY]
```

### 使用说明

部署合约和调用合约的过程中需传入参数 "fee_limit"

本次执行总共消耗的Energy所对应的TRX数量

对应关系：

```
已冻结Energy部分：(冻结的balance数量/冻结获得总共的Energy)*消耗Energy数量
销毁TRX获得Energy部分：按照比例消耗的TRX数量
```

#### 注意事项：
详见 [异常处理](异常处理.md)

