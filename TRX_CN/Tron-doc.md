# TRON公链文档

# 1 项目仓库
仓库地址：https://github.com/tronprotocol
其中 java-tron是主网代码，protocol是api和数据结构定义。wallet-cli是官方命令行钱包。
配置文件：
testnet的配置请参照https://github.com/tronprotocol/TronDeployment/blob/master/test_net_config.conf
mainnet的配置请参考https://github.com/tronprotocol/TronDeployment/blob/master/main_net_config.conf

# 2 Tron共识算法（刘声）
## 2.1 Tpos介绍
## 2.2 超级代表介绍
## 2.3 如何成为超级代表
## 2.4 出块奖励
## 2.5 如何确认交易

# 3 账号模型（安文）
## 3.1 账号模型介绍
## 3.2 创建账号的方式
## 3.3 生成秘钥对算法
## 3.4 地址格式
## 3.5 签名说明

# 4 Tron节点类型（思聪）
## 4.1 SR
### 4.1.1 SR介绍
### 4.1.2 SR部署方式
### 4.1.3 建议硬件配置

## 4.2 full node
### 4.2.1 full node介绍
### 4.2.2 full node部署方式
### 4.2.3 建议硬件配置

## 4.3 solidity node
### 4.3.1 solidity node介绍
### 4.3.2 solidity node部署方式
### 4.3.3 建议硬件配置

## 4.4 Tron网络结构（以图形加文字说明）

## 4.5 一键部署full node和solidity node

# 5 智能合约（振远）
## 5.1 Tron智能合约介绍
## 5.2 Tron智能合约特性（地址等）
## 5.3 Energy介绍
### 5.3.1 Energy的获取
### 5.3.2 Energy的消耗
## 5.4 智能开发工具介绍
## 5.5 智能合约的开发，编译，部署方法

# 6 内置合约以及API说明（任成常）
## 6.1 内置合约说明
## 6.2 gRPC 接口说明
## 6.3 http 接口说明

# 7 Tron交易费用（刘绍华）
## 7.1 带宽介绍
## 7.2 用户如何获取带宽
## 7.3 交易费用说明
### 7.3.1 费用总体说明
### 7.3.2 创建账号手续费
### 7.3.3 Token转账费用
## 7.4 手续费明细（以表格形式提供，包括创建token，申请witness，创建交易对，创建账号等）

# 8 Tron Token说明
## 8.1 如何发行token
## 8.2 如何参与token

# 9 去中心化交易对说明（刘声）
## 9.1 协议说明
## 9.2 创建交易对(文字说明含义后，再链接到相应的api说明)
## 9.3 注资(文字说明含义后，再链接到相应的api说明)
## 9.4 撤资(文字说明含义后，再链接到相应的api说明)
## 9.5 交易(文字说明含义后，再链接到相应的api说明)

# 10 钱包介绍（任成常）
## 10.1 wallet-cli功能介绍
## 10.2 计算交易ID
## 10.3 计算blockID
## 10.4 如何本地构造交易
## 10.5 相关demo
