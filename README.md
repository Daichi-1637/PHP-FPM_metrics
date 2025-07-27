# PHP-FPM metrics

PHP-FPMのメトリクスを, [FPMの情報ページ](https://www.php.net/manual/ja/fpm.status.php)からOpenMetrics形式で取得した際に使用した検証環境です.  

`tcp_socket` ディレクトリには, PHP-FPMとnginxの通信にTCP Socketを用いた環境の設定例が,  
`unix_domain_socket` ディレクトリには, PHP-FPMとnginxの通信にUnix domain Socketを用いた環境の設定例が用意されています.  

それぞれの環境の使い方は, 各ディレクトリ配下の`README.md`をご参照ください.  

## FPMの情報ページからOpenMetrics形式で取得できるメトリクス

```bash
$ curl --request GET --url http://localhost:8080/metrics

# HELP phpfpm_up Could pool www using a dynamic PM on PHP-FPM be reached?
# TYPE phpfpm_up gauge
phpfpm_up 1
# HELP phpfpm_start_since The number of seconds since FPM has started.
# TYPE phpfpm_start_since counter
phpfpm_start_since 66
# HELP phpfpm_accepted_connections The number of requests accepted by the pool.
# TYPE phpfpm_accepted_connections counter
phpfpm_accepted_connections 0
# HELP phpfpm_listen_queue The number of requests in the queue of pending connections.
# TYPE phpfpm_listen_queue gauge
phpfpm_listen_queue 0
# HELP phpfpm_max_listen_queue The maximum number of requests in the queue of pending connections since FPM has started.
# TYPE phpfpm_max_listen_queue counter
phpfpm_max_listen_queue 0
# TYPE phpfpm_listen_queue_length gauge
# HELP phpfpm_listen_queue_length The size of the socket queue of pending connections.
phpfpm_listen_queue_length 511
# HELP phpfpm_idle_processes The number of idle processes.
# TYPE phpfpm_idle_processes gauge
phpfpm_idle_processes 1
# HELP phpfpm_active_processes The number of active processes.
# TYPE phpfpm_active_processes gauge
phpfpm_active_processes 0
# HELP phpfpm_total_processes The number of idle + active processes.
# TYPE phpfpm_total_processes gauge
phpfpm_total_processes 1
# HELP phpfpm_max_active_processes The maximum number of active processes since FPM has started.
# TYPE phpfpm_max_active_processes counter
phpfpm_max_active_processes 0
# HELP phpfpm_max_children_reached The number of times, the process limit has been reached, when pm tries to start more children (works only for pm 'dynamic' and 'ondemand').
# TYPE phpfpm_max_children_reached counter
phpfpm_max_children_reached 0
# HELP phpfpm_slow_requests The number of requests that exceeded your 'request_slowlog_timeout' value.
# TYPE phpfpm_slow_requests counter
phpfpm_slow_requests 0
# HELP phpfpm_memory_peak The memory usage peak since FPM has started.
# TYPE phpfpm_memory_peak gauge
phpfpm_memory_peak 0
# EOF
```

> [!NOTE]  
> 情報ページは基本的に[クエリパラメータ `full` を使うことで, プロセスごとの詳細な情報を出力できます](https://www.php.net/manual/ja/fpm.status.php#fpm.status.parameters)が, OpenMetrics 形式で出力している場合は, php 8.4.7 の段階では `full` パラメータを指定しても追加の情報を取得することはできません（[php-src の該当コード](https://github.com/php/php-src/blob/1e94f3423b54827590054742b937e7025cf41930/sapi/fpm/fpm/fpm_status.c#L444-L449)）.