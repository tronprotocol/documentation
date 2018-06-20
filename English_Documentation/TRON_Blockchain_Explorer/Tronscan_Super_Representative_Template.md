## Intro

Tronscan provides a way for Super Representatives to publish their information right where the voters are, on Tronscan!

Super Representatives can use this template to build a static page which will be shown on Tronscan. The link will be placed in the voting overview page right next to the name of SR.

The Super Representatives can manage their own content by editing files in the Github repository.

## How to use

__This guide assumes that you already have an account with Super Representative (candidate) status.__

### Step 1: Copy/Fork the template on Github

* Go to https://github.com/tronscan/tronsr-template
* Fork the repository  
![](https://raw.githubusercontent.com/tronscan/docs/master/images/fork-repo.png)

After forking the repository you will be navigated to your own `tronsr-template` version of the repository where you can make changes.

## Step 2: Fill in the template

The template can now be modified by editing files on Github.

* Click the file you want to edit  
![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-open-file.png)
* Open edit mode
![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-edit-file.png)
* Add some information to the file
![](https://raw.githubusercontent.com/tronscan/docs/master/images/edit-team-intro.png)

Files are written in markdown format. An excellent intro can be found at https://guides.github.com/features/mastering-markdown/

* Update the logo.png and banner.png  
![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-upload-files.png)  
Then click on "choose your files" and make sure the logo or banner you want to upload is named `logo.png` or `banner.jpg` to overwrite the placeholder images.

After you filled in the template it can now be published on https://tronscan.org

## Step 3: Publish to Tronscan

* Navigate to https://tronscan.org
* Login to your account. In this example it shows using the private key, but you may use any login method.  
![](https://raw.githubusercontent.com/tronscan/docs/master/images/login-with-private-key.png)
* Open account and make sure the "Representative" label is visible  
![](https://raw.githubusercontent.com/tronscan/docs/master/images/open-account.png)
* Scroll to the bottom and click "Set Github Link"
![](https://raw.githubusercontent.com/tronscan/docs/master/images/set-github-link.png)
* Enter your Github username and then press "Link Github"  
![](https://raw.githubusercontent.com/tronscan/docs/master/images/input-username.png)
* View your new Page!  
![](https://raw.githubusercontent.com/tronscan/docs/master/images/view-page.png)

## Example

The example shows which files are presented where. Whenever the files on Github are modified the page will instantly be updated

![](https://raw.githubusercontent.com/tronscan/docs/master/images/example-page.png)

## FAQ

* __I've modified a file but the changes aren't visible on tronscan.org?__  
  Contents from the repository are served using the Github CDN which uses aggressive caching, therefore, it may take a few minutes before the changes are reflected on tronscan.org.
* __Why are HTML elements visible on Github but not on tronscan.org?__  
  Tronscan.org will sanitize all HTML tags for security reasons, only standard markdown tags are allowed.