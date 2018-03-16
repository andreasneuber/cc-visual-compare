# cc-visual-compare

### Purpose
Purpose of this test script is to catch easily dramatic apperance changes of a webpage. 
This might happen due to e.g. missing CSS links or cache problems. 


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
$ vendor/bin/codecept run -g make --debug
```
- This will execute test `tests/acceptance/make_screenshots_Cest`
- You should see screenshots of sites listed in url.txt in a subfolder folder of directory `shots/`
- Wait for some time (hours / days / weeks / months / years :-) )
- Repeat above steps, now you have 2 subdirs under `shots/`
- Run test file for comparing images
```
$ vendor/bin/codecept run -g compare --debug
```
- If any of the compared images has a similarity level of more than 0 => test fails
- You will see output on console mentioning file, and similarity level
- A TEST_RESULTS.html is created additionally, which also contains a link to website in question
