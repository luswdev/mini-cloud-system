# Mini Cloud System

This is a mini cloud system by php.

## Usage
1. Install apache, php, mysql (using ubuntu)
```bash
sudo apt install apache2 php mysql-server
```

2. Create a database (in mysql)
```sql
CREATE DATABASE database_name
```

3. Also need to create some table we need
```sql
using database_name

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


## feature
- upload
- delete
- download