# TRON Virtual Machine (TVM)

TRON Virtual Machine (TVM), is a lightweight, Turing complete virtual machine developed for Tron’s ecosystem, aimed at providing millions of global developers with custom-built blockchain system which is efficient, convenient, stable, secure and scalable.

TVM can connect seamlessly with existing development ecosystem and supports DPOS. TVM is able to be compatible with EVM environment in the beginning, so that instead of learning a new programming language, developers can develop, debug and compile smart contracts in a Remix environment with Solidity and other languages. Once you’ve built and uploaded your smart contract to TRON’s mainnet, it will be executed on the TVM of the SR node to be isolated from external connections.

Furthermore, TVM employs the concept of Bandwidth. Different from the gas mechanism on Ethereum’s  EVM,  operations of transaction or smart contracts on TVM are free, with no tokens consumed. Technically, executable computation capacity on TVM is not restricted by total holding of tokens.

## Features of TVM
1. Lightweight
TVM adopts a lightweight architecture with the aim of reducing resource consumption to guarantee system performance.
2. Stability and security
With a meticulous design paradigm and fine-grained underlying operation code, TVM can guarantee the preciseness of every step of a computation, diminishing ambiguity to the largest extent. Out of security reasons, transfers and smart contract running cost only bandwidth points, not TRX, which exempts TRON from being attacked similarly to Ethereum for its mode of gas consumption. Stability of bandwidth consumption is achieved while the cost of each computational step is fixed.
3. Compatibility
Currently, TVM is compatible with EVM and will be with more mainstream VMs in the future. Thereby, all smart contracts on EVM are executable on TVM. By connecting seamlessly to existing development ecosystem, higher efficiency can be achieved by developers. Needless to learn a new programming language, they can use mainstream programming languages for smart contract such as Solidity to develop, debug and compile smart contracts in the Remix environment, which greatly reduces development costs.
4. Developer-friendly
Thanks to TVM’s bandwidth setup, developments costs are reduced and developers can focus on the logic of their contract code. TVM also offers all-in-one interfaces for contract deployment, triggering and viewing, for the convenience of developers.  
The following interfaces are available in Tron Wallet-CLI:
+ deploycontract(password, contractAddress, ABI, code, data, value)
+ triggercontract(password, contractAddress, selector, data, value)
+ getcontract(contractAddress)
Developers can call these interfaces to deploy, trigger or check smart contracts.

## How TVM works
	
![Flowchart of Tron Virtual Machine](https://raw.githubusercontent.com/ybhgenius/Documentation/master/images/Virtual_Machine/虚拟机.png)

The above flowchart shows how TVM works:  
Compilation of Tron smart contract→execution and computing engines of VM→Interoperation service layer for external interfaces

Put simply, the flow is as follows:
+ Currently, TVM is compatible mainly with Solidity. The compiler translates Solidity smart contract into bytecode readable and executable on TVM.
+ A virtual machine processes data through opcode, which is equivalent to operating a logic of a stack-based finite sate machine.
+ TVM accesses blockchain data and invoke External Data Interface through the Interoperation layer.

## Future development of TVM
1. More developer-friendly debugging tools  
Tron will be committed to the development of optimized debugging tools and the establishment of standardized symbol and data format, for improved developer efficiency.
2. Fulfillment of diversified processing demands  
Different from gas consumption mechanism for every transaction on EVM, there is no charge on TVM. Each operation only occupies bandwidth, which will be released within a certain amount of time after completion of transaction. It takes developers very little to develop smart contracts with more complex logic. It is our belief that besides being used for digital asset transactions, smart contracts could also be suitably applied to areas such as game development, financial risk modeling and scientific computing. The design of TVM inherently supports multi-scenario tasks, and further optimizations of processing speed, response time, and floating point compatibility. 
3. Improvement of Just-In-Time (JIT) compilation speed and integration of WebAssembly

Improving JIT compilation speed is conducive to faster interpretation and optimized compilation of local code.  
Meanwhile, Tron is planning to further optimize its TVM based on WebAssembly (WASM). WebAssembly, spearheaded by Apple, Google, Microsoft and Mozzila, is designed to break bottlenecks of current Web browsers and can be generated through compiling C/C++ and other programming languages.  
Integrating WASM, TVM will be able to provide high performance and high throughput for blockchain to cope with complex scenarios.
