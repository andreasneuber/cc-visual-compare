# cc-visual-compare

Please note: this readme is "WIP" work in progress, in a few days info (esp "Usage") will be updated/completed.

### How to start
```
$ cd ~
$ git clone https://github.com/andreasneuber/cc-visual-compare.git
$ cd cc-visual-compare
$ bash setup.sh
$ composer install
$ vendor/bin/codecept build
```

After setup.sh was completely executed replace the contents of files acceptance.suite.yml / CompareCept.php / CreateScreenshotsCept.php produced by Codeception with the ones in this repo.

### Usage
- Add all urls to file urls.txt, and then execute
```
$ vendor/bin/codecept build run --debug
```
- You should see screenshots of sites listed in url.txt in folder `shots/`