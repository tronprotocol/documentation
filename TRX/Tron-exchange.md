# Transition plan for migrating exchanges to the TRON mainnet

# 1.	Node deployment

Deploy a full node and a linked solidity node by following this guide:
https://github.com/tronprotocol/Documentation/blob/master/TRX/Solidity_and_Full_Node_Deployment_EN.md.

# 2.	Demand-based development

Depending on the needs of your system, build a GRPC implementation to connect to the full node and solidity nodes.
A guide to Tron’s APIs can be found at https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md#4-tron-api.

A starter guide to GRPC is available here: https://grpc.io/

We also have a fork of https://github.com/tronprotocol/grpc-gateway which provides a HTTP interface to GRPC. We do not recommend using this for exchanges.

# 3.	Testing

We highly recommend that exchanges run a test to Tron’s mainnet as soon as possible.

For any other information, please refer to: https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md
