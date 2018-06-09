# Tron公链与交易所对接方案
交易所与tron公链对接，建议遵循如下方案：

1. 用tron最新release的代码部署节点fullnode和solidity node， solidity node连接本地的fullnode

2. fullnode提供区块链操作api和数据查询api，solidity node提供数据查询api。fullnode上的数据可能存在分叉，故数据可能会回退，solidity node上的数据是不可回退块，数据不会被回退。如果需要对数据进行最终的确认，请查询solidity node。

3. 根据交易所的具体业务需求，使用tron提供的api，连接本地的fullnode和solidity node实现对接过程。建议6月15号之前完成所有的功能开发。

4. 建议6月18号之前完成与tron公链的对接测试，可以直接在mainnet上进行测试。

5. 相关技术文档，可以参阅Tron-overview.md
