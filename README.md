# Simple PHP Programs

Implementation of simple PHP programs.

### Programs

- [Web Scraper](#web-scraper)
- [Email Subscription Manager](#email-subscription-manager)

### Installation

- `sudo apt install php-mbstring`
- `git clone git@github.com/asgaines/simple_programs.git`
- `cd simple_php_programs/`

## Web Scraper

Scrapes links from web page and provides list of link name/url in format: `Name [/url]`. Uses [simple HTML dom](http://simplehtmldom.sourceforge.net/)

### Example Usage

- `cd scrape/`
- `php get_links.php http://sitetoscrape.com > links.txt`


## Email Subscription Manager

Prepares list of email addresses for subscription service by removing addresses requesting removal from list and those which have previously bounced. Rather memory intensive in favor of processing intensive.

### Example Usage

- `cd subs/`
- `php get_emails.php`
- `php get_emails.php | emailMuppets -f "dude@zingstudios.com" -s "New Feature" -b "Brew coffee from this app"`
