# I.a	Signing Steps for GRPC
1.	Convert the transaction’s raw data to byte[].
2.	Hash the raw data using sha256.  This gives you the Transaction ID. 
3.	Sign the results of sha256 with the private key.
4.	Add the signed result to transaction.

# I.b	Signing Steps
1.  Use the transaction ID included in the return data of an http request.
3.	Sign the transaction ID with the private key.
4.	Add the signed result to transaction.


# II.	Signature algorithm
1.	ECDSA algorithm, SECP256K.

2.	Example of signature data
``` 
    priKey:::8e812436a0e3323166e1f0e8ba79e19e217b2c4a53c970d4cca0cfb1078979df
    pubKey::04a5bb3b28466f578e6e93fbfd5f75cee1ae86033aa4bbea690e3312c087181eb366f9a1d1d6a437a9bf9fc65ec853b9fd60fa322be3997c47144eb20da658b3d1
    hash:::159817a085f113d099d3d93c051410e9bfe043cc5c20e43aa9a083bf73660145
    r:::38b7dac5ee932ac1bf2bc62c05b792cd93c3b4af61dc02dbb4b93dacb758123f
    s:::08bf123eabe77480787d664ca280dc1f20d9205725320658c39c6c143fd5642d
    v:::0

   Note: the signed result should be 65 byte in size—r 32 bytes, s 32 bytes and v 1 byte.
```

3.	Signature verification

When a full node receives the transaction, it will verify the signature, comparing an address calculated with hash, r, s and v with the address of the contract. Signature is successfully verified if the two addresses match.

# III.	Example of code
```java
    public static Transaction sign(Transaction transaction, ECKey myKey) {
    
        Transaction.Builder transactionBuilderSigned = transaction.toBuilder();  
        byte[] hash = sha256(transaction.getRawData().toByteArray());  
        List<Contract> listContract = transaction.getRawData().getContractList();  
        
            for (int i = 0; i < listContract.size(); i++) {
            
                ECDSASignature signature = myKey.sign(hash);    
                ByteString bsSign = ByteString.copyFrom(signature.toByteArray());    
                //Each contract may be signed with a different private key in the future.
                transactionBuilderSigned.addSignature( bsSign );
                 
                }
```

