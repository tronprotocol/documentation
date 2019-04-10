# Rocksdb和Leveldb的对比

## 1、数据库引擎参数调优。


| 对比项	| leveldb	| rocksdb |
| ------ | ------ | ------|
|阶段	|编译阶段，参数设定好之后不能修改|	运行阶段，参数可以随时修改
|参数数量	|较少|	更多
调优难度	|缺少日志，分析起来繁琐	|日志丰富，便于查找性能瓶颈


下面列举了java-tron中使用rocksdb引擎支持的数据库调优参数，针对不同的区块处理阶段进行优化。

<b>同步模式阶段</b>

| 机器配置 |	level_number | compactThreads	| level0FileNumCompactionTrigger | block size	| target File | level 1大小	| level multiplier | target File Multiplier |	说明	 |
| ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------| ------ |
|16核32G内存|	7 |	16|	4	|64k|	256MB|	256MB|	10|	1|	此时区块数据集中写入，调高compactThreads和level0FileNumCompactionTrigger的值有利于数据写入更快。|	
|8核16G内存 |	7	| 8	|4|	64k|	256MB|	256MB|	10|	1|	此时区块数据集中写入，调高compactThreads和level0FileNumCompactionTrigger的值有利于数据写入更快。|	


<b>广播模式阶段</b>

| 机器配置 |	level_number | compactThreads	| level0FileNumCompactionTrigger | block size	| target File | level 1大小	| level multiplier | target File Multiplier |	说明	 |
| ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------| ------ |
|16核32G内存|	7|	8|	2|	64k|	256MB|	256MB|	10|	1|	此时更多的是数据读取，调降compactThreads和level0FileNumCompactionTrigger的值有利于提高数据读取效率。|	
|8核16G内存|	7|	4|	2|	64k|	256MB|	256MB|	10|	1|	此时更多的是数据读取，调降compactThreads和level0FileNumCompactionTrigger的值有利于提高数据读取效率。|	


注：以上为我们给出的建议优化参数，可参考rocksdb运行时记录的日志对不同配置的机器进行相应的参数优化。

## 2、rocksdb数据库单个sst文件存储的数据更多，占用磁盘的总空间更少。

|数据库文件大小|	leveldb sst文件数量|	rocksdb sst文件数量|
|-----|-----|-----|
|8.8G|	3023个|	968个|

|同一区块高度数据库|leveldb|	rocksdb|
|-----|-----|-----|
|7930000区块|	142G	|126G|
## 3、对于数据备份的支持。

leveldb不支持运行时的数据备份。

rocksdb支持在运行时进行数据备份，备份的时间仅需要几秒钟。

|区块高度|	数据库大小|	备份时间
|-----|-----|-----|
|4900000|	27G	|1秒|
|7900000|	126G|	1.4秒|


rocksdb提供丰富了配置参数允许节点根据自身机器配置进行调优，节点数据库占用的磁盘空间相比于leveldb更少，在程序运行时备份上百G数据只需要几秒而且不需要节点停止运行。



