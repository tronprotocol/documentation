Transition plan for Tron public blockchain and exchanges
We propose the following plan for the transition between exchanges and Tron’s public blockchain.

1.	Node deployment
1.1	Download the latest code release at https://github.com/tronprotocol/java-tron/releases.
1.2	Deploy a full node and a solidity node which connects to the local full node. See also https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-overview.md#3-%E8%8A%82%E7%82%B9%E8%BF%90%E8%A1%8C.

2.	Demand-based development
2.1	Based on the exchange services, connect the solidity node to the local full node by invoking Tron’s APIs. A guide to Tron’s APIs can be found at https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-overview.md#4-tron-api%E8%AF%B4%E6%98%8E.
Please note that when using grpc APIs, do not use the grpc-gateway for function development. It is only intended for debugging and for checking blockchain data. For further information on the deployment of grpc-gateway, see also https://github.com/tronprotocol/grpc-gateway/blob/master/README.md.
3.	Testing
We suggest that exchanges run a test on the transition to Tron’s public blockchain on Tron’s mainnet by June 18.
For relevant technical files, please refer to https://github.com/tronprotocol/Documentation/blob/master/TRX_CN/Tron-overview.md.
