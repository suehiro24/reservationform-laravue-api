# 予約フォーム

## 実行方法

**git clone**
```
git clone https://github.com/HayataSato/reservationform-laravue.git
```

**composer install**
```
cd reservationform-laravue

docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php80-composer:latest \
  composer install --ignore-platform-reqs

```

**コンテナの起動**
```
# sailコマンドのエイリアス設定
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
# コンテナのバックグラウンドで起動させる
sail up -d
```
* ~/.bashrc に`alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`を追記すること推奨
    * ターミナル再起動後からは、sailコマンドが直で使える

**npm install**
```
sail npm install
```

**build**
```
sail npm run dev
```
* 開発時は`sail npm run watch-poll`で随時ビルドさせることを推奨

**url**

main :
http://localhost:80/

phpmyadmin :
http://localhost:8080/
