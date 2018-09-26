# Create an account

You can register a random offline key pair (including the address and private key), but this key pair will not be recorded by the TRON network. To make this key pair an account in the TRON network, you need to call one of the following three apis with an account already existing in the TRON network:

- Directly call the Create Account api
- Transfer TRX to the new address
- Transfer any kind of token to the new address

After the transaction is confirmed by the network, you can query the information of the account that matches the address in the TRON network. Creating an account burns 0.1 TRX from the creator, or consumes the bandwidth acquired by freezing. **【Note】** After Odyssey 3.0 goes online, with the confirmation of the committee, creating an account will burn 0.1 TRX from the creator without consuming bandwidth.
