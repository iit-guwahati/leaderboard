# leaderboard

```
# Ex for codechef
./leaderboard crawl http://www.codechef.com/users/[username]
```

### Scrapper Implementation

Checkout `src/Scrappers/CodeChefScrapper.php`  
Define you scrapper in `src/scrappers.php`. (Ex. www.codechef.com)

> PS: Ignore `vendor` and `src/Commands` directories for now.

### How to Install PHP using XAMPP on linux

```
wget https://downloadsapachefriends.global.ssl.fastly.net/xampp-files/5.6.12/xampp-linux-x64-5.6.12-0-installer.run?from_af=true
chmod 755 xampp-linux-*-installer.run
sudo ./xampp-linux-*-installer.run
```

> edit .bashrc file
```
export PATH=/opt/lampp/bin:$PATH
```

### Get composer
> run this in the leaderboard directory
```
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```