# Benchmark (Siege + Nginx + FastCGI)


Performance difference between php implementation and extension is very little.

Siege results:


PHP 5.5, profiling with library 
-------------------------------

```
siege -v -t30s -c50 http://test-pinba-package.192.168.56.101.xip.io/index.php
Transactions:		        2893 hits
Availability:		      100.00 %
Elapsed time:		       29.71 secs
Data transferred:	        3.05 MB
Response time:		        0.02 secs
Transaction rate:	       97.37 trans/sec
Throughput:		        0.10 MB/sec
Concurrency:		        2.15
Successful transactions:        2893
Failed transactions:	           0
Longest transaction:	        0.57
Shortest transaction:	        0.00
Pinba requests: 2896
```

PHP 5.5, profiling disabled
---------------------------

```
siege -v -t30s -c50 http://test-pinba-package.192.168.56.101.xip.io/no-pinba.php
Transactions:		        2850 hits
Availability:		      100.00 %
Elapsed time:		       29.32 secs
Data transferred:	        3.04 MB
Response time:		        0.02 secs
Transaction rate:	       97.20 trans/sec
Throughput:		        0.10 MB/sec
Concurrency:		        1.69
Successful transactions:        2850
Failed transactions:	           0
Longest transaction:	        0.16
Shortest transaction:	        0.00
Pinba requests: 0
```

PHP 5.5, profiling with extension
---------------------------------

```
siege -v -t30s -c50 http://test-pinba-package.192.168.56.101.xip.io/index.php
Transactions:		        2789 hits
Availability:		      100.00 %
Elapsed time:		       29.46 secs
Data transferred:	        3.25 MB
Response time:		        0.02 secs
Transaction rate:	       94.67 trans/sec
Throughput:		        0.11 MB/sec
Concurrency:		        1.82
Successful transactions:        2789
Failed transactions:	           0
Longest transaction:	        0.16
Shortest transaction:	        0.00
Pinba requests: 2790
```

HHVM 3.9, profiling with library
--------------------------------
```
siege -v -t30s -c50 http://hhvm-pinba-package.192.168.56.101.xip.io/index.php
Transactions:		        2742 hits
Availability:		      100.00 %
Elapsed time:		       29.13 secs
Data transferred:	        1.12 MB
Response time:		        0.02 secs
Transaction rate:	       94.13 trans/sec
Throughput:		        0.04 MB/sec
Concurrency:		        1.86
Successful transactions:        2742
Failed transactions:	           0
Longest transaction:	        0.44
Shortest transaction:	        0.00
Pinba requests: 2743
```

HHVM 3.9, profiling disabled
----------------------------
```
siege -v -t30s -c50 http://hhvm-pinba-package.192.168.56.101.xip.io/no-pinba.php
Transactions:		        2769 hits
Availability:		      100.00 %
Elapsed time:		       29.04 secs
Data transferred:	        1.14 MB
Response time:		        0.02 secs
Transaction rate:	       95.35 trans/sec
Throughput:		        0.04 MB/sec
Concurrency:		        1.78
Successful transactions:        2769
Failed transactions:	           0
Longest transaction:	        0.21
Shortest transaction:	        0.00
Pinba requests: 0
```
