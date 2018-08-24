
## ENERGY 消耗机制


### Energy消耗
顺序如下：

1. 按照合约中设置的比例消耗合约创建者冻结的Energy，若不足优先扣除合约创建者剩余所有Energy,剩余消耗需调用者提供
1. 调用者消耗顺序（优先消耗调用者冻结获取的Energy，为保证合约可正常执行，不足部分通过销毁TRX相抵）
1. 若创建者无冻结Energy资源，则所有消耗需调用者提供


### 相关接口

##### getTransactionInfoById
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
##### FreezeBalance
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

通过销毁TRX获得CPU：1 Energy = n SUN （系数n有委员会投票确定）

fee_limit或余额限制不足n时，不会销毁SUN来兑换Energy

执行合约过程中出现异常会消耗全部fee_limit对应的资源

##### 下列情况将会产生一个 assert 式异常：(消耗几乎所有energy)

  1.  如果你访问数组的索引太大或为负数（例如 x[i] 其中 i >= x.length 或 i < 0）。
  1.  如果你访问固定长度 bytesN 的索引太大或为负数。
  1.  如果你用零当除数做除法或模运算（例如 5 / 0 或 23 % 0 ）。
  1.  如果你移位负数位。
  1.  如果你将一个太大或负数值转换为一个枚举类型。
  1.  如果你调用内部函数类型的零初始化变量。
  1.  如果你调用 assert 的参数（表达式）最终结算为 false。


##### 下列情况将会产生一个 require 式异常：(消耗实际使用的energy)

  1.  调用 throw 。
  1.  如果你调用 require 的参数（表达式）最终结算为 false 。
  1.  如果你通过消息调用调用某个函数，但该函数没有正确结束（它耗尽了 Energy，没有匹配函数，或者本身抛出一个异常），上述函数不包括低级别的操作 call ， send ， delegatecall 或者 callcode 。低级操作不会抛出异常，而通过返回 false 来指示失败。
  1.  如果你使用 new 关键字创建合约，但合约没有正确创建（请参阅上条有关”未正确完成“的定义）。
  1.  如果你对不包含代码的合约执行外部函数调用。
  1.  如果你的合约通过一个没有 payable 修饰符的公有函数（包括构造函数和 fallback 函数）接收 TRX。
  1.  如果你的合约通过公有 getter 函数接收 TRX 。
  1.  如果 .transfer() 失败。
  1.  调用revert


在内部， Solidity 对一个 require 式的异常执行回退操作（指令 0xfd ）并执行一个无效操作（指令 0xfe ）来引发 assert 式异常。 在这两种情况下，都会导致 EVM 回退对状态所做的所有更改。回退的原因是不能继续安全地执行，因为没有实现预期的效果。 因为我们想保留交易的原子性，所以最安全的做法是回退所有更改并使整个交易（或至少是调用）不产生效果。 请注意， assert 式异常消耗了所有可用的调用 Energy 。


#### 相关名词：

合约创建者：即创建合约的账户

合约调用者：即调用合约的账户

Energy资源：执行合约过程中所消耗的资源类型
