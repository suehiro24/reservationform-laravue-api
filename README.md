# 予約フォーム

## 実行方法

**git clone**
```
git clone https://github.com/HayataSato/reservationform-laravue.git
```

**composer install**
```
cd reservationform-laravue

sudo chown -R $USER $HOME/.composer

docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php80-composer:latest \
  composer install --ignore-platform-reqs

```

**コンテナの起動**
```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

sail up -d
```

**npm install**
```
sail npm install
```

**url**

main :
http://localhost:80/

phpmyadmin :
http://localhost:8080/
