# yii-apache-logs-parser
Apache's access log parser. Based on Yii 1.x

## installation
### 1. Clone this repository
### 1.2 Go to repository folder
### 1.3 run "composer install"
### 2. Create MySQL database configuration file "code/protected/config/db.php" e.g.:
```
        return array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:dbname=parser;host=127.0.0.1',
            'username' => 'parser',
            'password' => '11111111'
        );
```
### 3. Edit configuration for Apache Logs Parser component in file "code/protected/config/console.php" in section "components", e.g.:
#### If your system user(who run console command) can read Apache's configuration files
```
        'ApacheAccessLog'=>[
            'class'=>'application\components\ApacheAccessLog\Parser',
            'apacheConfigFile'=>'/etc/apache2/httpd.conf', // main Apache configuration
            'enabledVHostsPath'=>'/private/etc/apache2/extra/httpd-vhosts.conf' // File or directory with Apache VHosts configuration
        ]
```
#### If your system user(who run console command) can't read Apache's configuration files
```
        'ApacheAccessLog'=>[
            'class'=>'application\components\ApacheAccessLog\Parser',
            'logFiles'=>[
              ...,
              [
                'path'=>'/var/log/apache2/access.log', //path to log file
                'format'=>"%v:%p %h %l %u %t \"%r\" %>s %O \"%{Referer}i\" \"%{User-Agent}i\"" // format of log file
              ]
              ...,
            ]
        ]
```
### 4. Run migrations
#### cd code
#### php protected/yiic migrate
#### php protected/yiic migrate --migrationPath=user.migrations 
at this stage you can specify the username and password of the first user
### 5. Configure your favorite web-server to serve this web application
## Usage (Console)
To to start parse logs run next command from "code" folder : 
```
php protected/yiic parser
```
You can add this command to your crontab
## Usage (Web application)
### After login you can:
1. List all records and filter records by comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done. To combine operators use delimiter {AND}
2. View datail info about each record
3. Delete record from database
4. Get results with JSON by adding nex GET params:
```
json=true
login={your login}
password={your password}
```
5. To filter results in JSON-queryes you can set GET params:
```
Log[field_name]=value
```
E.g.:
```
Log[status_last]=>404{AND}<409
```

