# PHP-FPM Metrics using unix domain socket

PHP-FPMとnginxの通信にUnix domain Socketを用いた場合の設定例です.  

> [!NOTE]  
> Linux系OSでUnix domain socketを使っていると`phpfpm_listen_queue` や `phpfpm_listen_queue_length` のメトリクスは取得できません（[Githubにある該当のissue](https://github.com/php/php-src/issues/9943)）.  
> 検証環境では, php:8.4-fpm-alpineを使っているため, 上記のメトリクスを取ることは出来ません.  
> ( 常に0の値が返るようになっています. )  

## 構成

構成は以下のようになっています:

- **nginx-app**: リバースプロキシとして動作し, php-fpm へのリクエストを中継します
- **nginx-metrics**: php-fpmのメトリクスを取得する際に使用します
- **php-fpm**: PHP アプリケーションの実行とメトリクスの出力を行います
- **VictoriaMetrics**: メトリクスを収集・保存するための時系列データベースです
- **Grafana**: メトリクスを可視化するためのダッシュボードを提供します
- **k6**: 負荷テストを実行し, php-fpm のメトリクスの挙動を確認するために使用します

各コンポーネントは, 以下のコマンドで起動できます:

```bash
make compose.up
```

## Grafanaからメトリクスを見る
各コンポーネントを起動した後, ブラウザから`localhost:3000`にアクセスし, `HOME > Dashboards > FPMの情報`を開くことでメトリクスを見ることが出来ます.

username/passwordは, `admin/admin`です.

## 負荷テスト
負荷テストは, 以下のコマンドで実行できます.  
```sh
make run.k6
```
設定値の変更は, `k6`ディレクトリ配下の`script.js`を編集することで可能です.  

負荷テストは, メトリクスの振る舞いを確認するのに役に立ちます.  

## comannd

- 各種サービスの起動

```sh
make compose.up
```

- 各種サービスの終了

```sh
make compose.down
```

- 負荷テスト（k6）を実行

```sh
make run.k6
```