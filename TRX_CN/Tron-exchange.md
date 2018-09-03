# Tron公链与交易所对接方案
交易所与tron公链对接，建议遵循如下方案：

# 1. 节点部署 

1.1 下载最新release代码 https://github.com/tronprotocol/java-tron/releases

1.2 部署fullnode和solidity node，solidity node连接本地的fullnode。请参考 https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-overview.md#3-%E8%8A%82%E7%82%B9%E8%BF%90%E8%A1%8C

# 2. 对接需求开发

2.1 根据交易所的具体业务需求，使用tron提供的api，连接本地的fullnode和solidity node实现对接过程。api说明请参考https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-overview.md#4-tron-api%E8%AF%B4%E6%98%8E

请注意：使用gRPC的的api，禁止使用grpc-gateway进行功能开发。grpc-gateway可以作为调试程序用，方便查看区块链数据。grpc-gateway部署方式请参照：https://github.com/tronprotocol/grpc-gateway/blob/master/README.md

# 3. 测试

建议6月18号之前完成与tron公链的对接测试，可以直接在mainnet上进行测试。

相关技术文档，可以参阅https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-overview.md


# 4. 一般部署

![一般部署](https://github.com/tronprotocol/Documentation/blob/feature/add_node_deployment_diagram/TRX_CN/figures/General_node_deployment_diagram.png)

# 5. 安全部署
需要提供生成公私钥地址、交易签名等方法时，建议采用安全部署方式。

![安全部署](https://github.com/tronprotocol/Documentation/blob/feature/add_node_deployment_diagram/TRX_CN/figures/Secure_node_deployment_diagram.png)


# 6. 充值流程

![充值流程](https://github.com/tronprotocol/Documentation/blob/feature/add_node_deployment_diagram/TRX_CN/figures/Recharge_process.png)


# 7. 提现流程

![提现流程](https://github.com/tronprotocol/Documentation/blob/feature/add_node_deployment_diagram/TRX_CN/figures/Withdrawal_process.png)

