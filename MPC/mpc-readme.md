# sapling-mpc

This code can be used to participate PC phase 2 and verify the result.

## Instructions

Contact **jiangyuanshu@tron.network** to schedule a time to participate and get an index num. You'll need the latest (stable) [Rust compiler](https://www.rust-lang.org/) to participate using this code. When it's your turn, you'll receive a `params` file from us.

1.Download and install IM tool [keybase](https://keybase.io/). if you don't have an account, create it first. you can use tool to send file back to tron foundation. The TronFoundation's keybase account is `tron_brown`.

2.If you are running on macOS, Linux, or another Unix-like OS, download Rustup and install Rust, run the following in your terminal, then follow the on-screen instructions.
                                                            
```
curl https://sh.rustup.rs -sSf | sh
```

If you are running on windows, refer to [rust](https://www.rust-lang.org/learn/get-started) homepage for installation.

3.Get the source code of project sapling-mpc:

```
git clone https://github.com/zcash-hackworks/sapling-mpc
```
if git not installed, please refer to [git](https://git-scm.com/downloads) first.

4.Place `params` file in the sapling-mpc directory and run:

```
cargo run --release --bin compute
```

The process could take one to four hours according to your hardware, occupies 1.5 ~ 2GB of memory, and then spits out a `new_params` file. The tool also prints a hash. This hash is what you and others can use to verify that your contribution actually ended up in the final parameters. 

5.You are encouraged to save this file `new_params` and upload it back to us with keybase. After we receive this `new_params` file, we will check its correctness and upload it to aliyun cloud if ok, so that next participant can use it. we will also publish the file link and hash on [github wiki]().

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
