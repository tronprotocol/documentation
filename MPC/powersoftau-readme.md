# Powers of Tau

This is a [multi-party computation](https://en.wikipedia.org/wiki/Secure_multi-party_computation) (MPC) ceremony which constructs partial zk-SNARK parameters for _all_ circuits up to a depth of 2<sup>21</sup>. It works by taking a step that is performed by all zk-SNARK MPCs and performing it in just one single ceremony. This makes individual zk-SNARK MPCs much cheaper and allows them to scale to practically unbounded numbers of participants.

This protocol is described in a [forthcoming paper](https://eprint.iacr.org/2017/1050). It produces parameters for an adaptation of [Jens Groth's 2016 pairing-based proving system](https://eprint.iacr.org/2016/260) using the [BLS12-381](https://github.com/ebfull/pairing/tree/master/src/bls12_381) elliptic curve construction. The security proof relies on a randomness beacon being applied at the end of the ceremony.

This is MPC phase 1. In [MPC phase 2](mpc-readme.md) we will generate the left parameters.
## Instructions
Contact **jiangyuanshu@tron.network** to schedule a time to participate. You'll need the latest (stable) [Rust compiler](https://www.rust-lang.org/) to participate using this code. If you've been asked to participate and it's your turn, you were sent a `challenge` file.

1.Download and install IM tool [keybase](https://keybase.io/). if you don't have an account, create it first. you can use tool to send file back to tron foundation. The TronFoundation's keybase account is `tron_brown`.
If you have questions about this ceremony, contact with us via keybase directly.

2.if you are running on macOS, Linux, or another Unix-like OS(windows are not tested), download Rustup and install Rust, run the following in your terminal, then follow the on-screen instructions.
                                                            
```
curl https://sh.rustup.rs -sSf | sh
```

3.Get the source code of project sapling-mpc:

```
git clone https://github.com/ebfull/powersoftau
```

4.Put file `challenge` in the powersoftau directory and use your [Rust toolchain](https://www.rust-lang.org/en-US/) to execute the computation:

```
cargo run --release --bin compute
```
You may be asked to input some random text in this process, and it could take an hour or so. Memory usage is about 2.5 ~ 3 GB. When it's finished, it will place a `response` file in the current directory. That's what you send back with keybase. It will also print a hash of the `response` file it produced. You need to write this hash down (or post it publicly) so that you and others can confirm that your contribution exists in the final transcript of the ceremony.

5.You are expected to send `response` file back to us via keybase. We will verify this file and generate the `new_challenge` file that can be used by next participant，and then will upload this file to aliyun cloud and publish response_hash on [github wiki]().

## Recommendations

Participants of the ceremony sample some randomness, perform a computation, and then destroy the randomness. **Only one participant needs to do this successfully to ensure the final parameters are secure.** In order to see that this randomness is truly destroyed, participants may take various kinds of precautions:

* putting the machine in a Faraday cage
* destroying the machine afterwards
* running the software on secure hardware
* not connecting the hardware to any networks
* using multiple machines and randomly picking the result of one of them to use
* using different code than what we have provided
* using a secure operating system
* using an operating system that nobody would expect you to use (Rust can compile to Mac OS X and Windows)
* using an unusual Rust toolchain or [alternate rust compiler](https://github.com/thepowersgang/mrustc)
* lots of other ideas we can't think of

It is totally up to the participants. In general, participants should beware of side-channel attacks and assume that remnants of the randomness will be in RAM after the computation has finished.

## License

Licensed under either of

 * Apache License, Version 2.0, ([LICENSE-APACHE](LICENSE-APACHE) or http://www.apache.org/licenses/LICENSE-2.0)
 * MIT license ([LICENSE-MIT](LICENSE-MIT) or http://opensource.org/licenses/MIT)

at your option.

### Contribution

Unless you explicitly state otherwise, any contribution intentionally
submitted for inclusion in the work by you, as defined in the Apache-2.0
license, shall be dual licensed as above, without any additional terms or
conditions.
