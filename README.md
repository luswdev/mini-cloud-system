[![HitCount](http://hits.dwyl.io/omuskywalker/mini-cloud-system.svg)](http://hits.dwyl.io/omuskywalker/mini-cloud-system)
[![GitHub license](https://img.shields.io/github/license/omuskywalker/mini-cloud-system.svg?style=flat-square)](https://github.com/omuskywalker/mini-cloud-system/blob/master/LICENSE)
[![Download](https://img.shields.io/github/downloads/omuskywalker/mini-cloud-system/total.svg?style=flat-square)](https://github.com/omuskywalker/mini-cloud-system/releases/)
[![Size](https://img.shields.io/github/repo-size/omuskywalker/mini-cloud-system.svg?style=flat-square)]()
[![Release](https://img.shields.io/github/release/omuskywalker/mini-cloud-system.svg?style=flat-square)]()
[![top](https://img.shields.io/github/languages/top/omuskywalker/mini-cloud-system.svg?style=flat-square)]()
[![quality](https://img.shields.io/scrutinizer/quality/g/omuskywalker/mini-cloud-system/master.svg?style=flat-square)]()

# Mini Cloud System
This is a mini cloud system by php.

## Usage
1. Install apache, php, mysql (using ubuntu)
```shell
sudo apt install apache2 php mysql-server
```

2. Create a database (in mysql)
```sql
CREATE DATABASE database_name
```

3. Also need to create some table we need
```sql
USE database_name

CREATE TABLE users_list(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    account NOT NULL varchar(50),
    passwd NOT NULL varchar(50),
)

CREATE TABLE login_log(
    login_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    account varchar(50),
    login_time varchar(50),
    logout_time varchar(50),
    login_ip varchar(50),
)

CREATE TABLE login_log(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    trying_account NOT NULL varchar(50),
    trying_time NOT NULL varchar(50),
    trying_ip NOT NULL varchar(50),
)
```

3. Clone this repo into your *web_root* (apache default is `/var/www/htm/`)
```shell
git clone https://github.com/omuskywalker/mini-cloud-system.git path/to/your/web/root
```

4. Fill in config.json, where location in repo root.
5. Enjoy!

---
## Release Log
- 2019.05.10 First 