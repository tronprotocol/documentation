# TRON Mainnet - Exchange Integration Guide

Connecting to the TRON network is extremely easy and only requires running 1-2 nodes on a machine. Once you've connected to the network, you have multiple ways of interacting with the nodes based on your system's requirements. When you're fully integrated, please reach out to the TRON team so that we can help you verify your setup.

- [Full TRON Documentation](https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md)

# 1.  Deploy TRON Nodes

You'll need to deploy nodes that connect to the network and offer both the ability to read the blockchain state and also to broadcast transactions onto the network.

TRON's network uses a FullNode to read and broadcast to the network. The FullNode stores the entire blockchain state, including unconfirmed blocks and potential forks. 

Deploying a linked SolidityNode allows you to interact with blocks that are guaranteed confirmed and irreversible.

Follow this (Guide)[https://github.com/tronprotocol/Documentation/blob/master/TRX/Solidity_and_Full_Node_Deployment_EN.md] to deploy a FullNode and a linked SolidityNode on the same machine.
- .

# 2.  Integrate with the TRON Nodes

The TRON Nodes each run both GRPC Service and HTTP Gateway on the ports specified in the configuration files. You can use either method to communicate with the nodes. 
- [API documentation](https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md#4-tron-api.)

## GRPC 

[GRPC](https://grpc.io/) uses Protobuf and the [TRON protocol](https://github.com/tronprotocol/protocol).

## HTTP Gateway

The nodes also offer an alternate RESTful HTTP Gateway.
Read the [HTTP Documentation](https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-http.md) for examples.

# 3.  Testing

Once you've fully integrated with the network, please reach out to our team to obtain some TRON Mainnet TRX tokens to test your integration.

[Full TRON Documentation](https://github.com/tronprotocol/Documentation/blob/master/TRX/Tron-overview.md)
