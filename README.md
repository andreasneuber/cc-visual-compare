# cc-visual-compare

### How to start
- cd ~
- git clone https://github.com/andreasneuber/cc-visual-compare.git
- cd cc-visual-compare
- bash setup.sh

After setup.sh was completely executed replace the contents of files acceptance.suite.yml / CompareCept.php / CreateScreenshotsCept.php produced by Codeception with the ones in this repo.

### Usage
- Add all urls to file urls.txt
- Create a folder with screenshots with:
```
codecept run acceptance CreateScreenshotsCept --debug
```
- Wait some days / weeks / months
- Create second folder with screenshots with:
```
codecept run acceptance CreateScreenshotsCept --debug
```
- Compare these two folders with:
```
# adjust lines 6+7 to fit your two folder names
codecept run acceptance CompareCept --debug 
```
- Open all images in directory ./difference in "Pinta" graphics program
- If a webpage has changed you will see those difference in red on the .png file


