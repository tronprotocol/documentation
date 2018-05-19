# Transition Manual for Exchanges and TRX

## It is suggested that exchanges deploy a Full Node and a Solidity Node in Tron blockchain for improved security. 

### The Full Node will:
- synchronize all data in the blockchain
- allow transaction broadcasting to be conducted

### The Solidity Node will
- only synchronize data from irreversible blocks already confirmed
- allow users to check their account balance

1，The prerequisite of Full Node and Solidity Node deployment:  

+ Installation of JDK 1.8 (JDK 1.9 not supported for the moment).

+ For Linux Ubuntu systems, please make sure to install Oracle JDK 8 instead of OPEN JDK 8.

2，The deployment of Full Node is as follows:

   +     git clone https://github.com/tronprotocol/java-tron.git  
       
   +     cd java-tron
      
   +     ./gradlew clean shadowJar
     
   +     ./gradlew run  
   
With these, the Full Node is set up and ready for the synchronization of blockchain data, which is complete upon the alert of “Sync Block Completed!!!”.

3，The deployment of Solidity Node is as follows:  
   
   +     git clone https://github.com/tronprotocol/java-tron.git  
   
   +     cd java-tron  
   
   +     ./gradlew clean shadowJar  
   
   +     ./gradlew run -PmainClass=org.tron.program.SolidityNode

With these, the Full Node is set up and ready for the synchronization of blockchain data, which is complete upon the alert of “Sync with trust node Completed!!!”.

4，Connecting grpc-gateway to SolidityNode (optional step)

+ Install go1.10.1

+     go get -u github.com/tronprotocol/grpc-gateway

+     cd $GOPATH/src/github.com/tronprotocol/grpc-gateway

+     go run tron_http/main.go

GRPC interface is available on Solidity Node, providing Http interface for gRPC interface through grpc-gateway. Please note that this is an optional step providing Http interface for gRPC interface for the convenience of users.

5，Account generation

+ Random generation of 32 byte secret key d:

      d = ab586052ebbea85f3342dd213abbe197ab3fd70c5edf0b2ceab52bd4143e1a52

+ Calculating public key with private key: ecc SECP256K1N curve，P = d*G public key P 

      P = 5ed0ec89eaec33d359b0632624b299d1174ee2aec5a625a3ce9145dd2ba4e48e049327d454fbf7ec700a9464f87dc4b73a592e27fd0d6d1fe7faf302e9f63306

+ Calculating address with public key：sha3-256(P) 

      Hash = c7bcfe2713a76a15afa7ed84f25675b364b0e45e2668c1cdd59370136ad8ec2f

+ Reserve the last 20 bytes of Hash

      End20Bytes = f25675b364b0e45e2668c1cdd59370136ad8ec2f

+ Add a0(testNet) or b0(mainNet) before End20Bytes 

      address = a0f25675b364b0e45e2668c1cdd59370136ad8ec2f

+ Convert address to base58check format：(bip-13)

      hash0 = sha256(address);
      //hash0=cd398dae4f5294804c83093ee043c13fa3037603a4e7d76ed895bb3aa316e93
      hash1 = sha256(hash0);
      //hash1=7e5ff07e733c2bb52e56cef8cfb5af6f61e50d515eb3a57e38b5889a1f653ac8

+ checkSum = the first 4 bytes of hash0

      //checkSum = 7e5ff07e
      addressCheckSum = address || checksum
      //addressCheckSum = //a0f25675b364b0e45e2668c1cdd59370136ad8ec2f7e5ff07e
      addressbase58 = base58Encode(addressCheckSum)
      //addressbase58=
      //27mAse8NBVPM4M7Mpp5sxZcLcYkpSqrcoHX

Please note: All addresses of transactions and block storage should be in byte[] as it has 14 bytes less than the base58check format (21 vs 35). Besides the initial address and the witness address in the configuration file, which adopt the base58check format, all other addresses in blockchain nodes should maintain their original format. Where it involves input and output for the wallet, format conversion has to be made, but what is presented to users should be in base58check format. Addresses should be validated before being converted to base58check format.

6，Connecting with Solidity Node or grpc-gateway to check your balance

With the address generated in step 5, connect with Solidity Node to view balance through gRPC interface GetAccount. Or you can access http://localhost:8080/Wallet/GetAccount interface for your balance through grpc-gateway.
