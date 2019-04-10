# ROCKSDB VS LEVELDB

## 1、Tuning the Database。


| Comparison item	| leveldb	| rocksdb |
| ------ | ------ | ------|
|stage	|Compilation phase，can not be modified|	Runtime phase，can be modified
|number of parameter	|few|	more
|Tuning difficulty	|difficulty to tune because of lacking log	|easy to tune based on rich log

Some tuning parameters of rocksdb supported in java-tron are listed as follows, it is helpful to different stage using different parameters.  

<b>block sync stage</b>

| Machine configuration|	level_number | compactThreads	| level0FileNumCompactionTrigger | block size	| target File | level 1 size	| level multiplier | target File Multiplier |	description	 |
| ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------| ------ |
|16 cores，32G RAM|	7 |	16|	4	|64k|	256MB|	256MB|	10|	1|	It is recommanded to turn up the parameter "compactThreads" and "level0FileNumCompactionTrigger" for more fast speed of writing data to database|	
|8 cores，16G RAM |	7	| 8	|4|	64k|	256MB|	256MB|	10|	1|	It is recommanded to turn up the parameter "compactThreads" and "level0FileNumCompactionTrigger" for more fast speed of writing data to database|


<b>block advertise stage</b>

| Machine configuration |	level_number | compactThreads	| level0FileNumCompactionTrigger | block size	| target File | level 1 size	| level multiplier | target File Multiplier |	description	 |
| ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------ | ------| ------ |
|16 cores，32G RAM|	7|	8|	2|	64k|	256MB|	256MB|	10|	1|	It is recommanded to turn down the parameter "compactThreads" and "level0FileNumCompactionTrigger" for more fast speed of reading data to database|	
|8 cores，16G RAM|	7|	4|	2|	64k|	256MB|	256MB|	10|	1|	It is recommanded to turn down the parameter "compactThreads" and "level0FileNumCompactionTrigger" for more fast speed of reading data to database|	


note：these are just parameters we suggested on some specific machine，you should tune the parameters according to the logs of database running。

## 2、a ".sst" file in rocksdb can stores more data than the leveldb, so it may ocuppy less storage space。

|database size | sst files amount of leveldb|	sst files amount of rocksdb|
|-----|-----|-----|
|8.8GB|	3023|	968|

|the same block height|leveldb|	rocksdb|
|-----|-----|-----|
|block height:7930000|	142GB	|126GB|

## 3、Supporting for database backup。

leveldb can not support for database backup when the application is running。

rocksdb can support for database backup when the application is running and it just need a few seconds.

|block height|	database size|	backup used time 
|-----|-----|-----|
|block height: 4900000|	27GB	|1 second|
|block height: 7900000|	126GB|	1.4 second|


Rocksdb provides a rich set of configuration parameters to allow nodes to tune according to their own machine configuration. The database occupies less disk space than leveldb. It only takes a few seconds to back up hundreds of GB data when the program is running and does not require the node to stop running.


