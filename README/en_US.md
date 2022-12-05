# Conditional URL Advertisements

Plugin for [YOURLS](http://yourls.org). 

## Description
This plugin allows you to redirect all shortlinks through a link monetizer. 

Currently, the following shorteners are supported:
  * [AdFly](https://join-adf.ly/21969401), trigger: `a/`
  * [AdFoc.us](https://adfoc.us/?refid=788613), trigger `f/`
  * [ouo.io](https://ouo.io/ref/MpFHTzmv), trigger `o/`

Going to a shorturl with a trigger before it will automatically forward the url through the selected service (ex *sho.rt/a/test*). If it recognizes a trigger but there is no associated service it will not monetize the link.

If you have another sevice you want supported, make a ticket for it!

## Installation
1. Clone this repo to the `/user/plugins` plugins directory
2. Copy `user-config.php.example` and rename it to `user-config.php`
3. Edit the plugin's user config (inside `user-config.php`) to suit your needs
4. Go to the Plugins administration page and activate the plugin
5. Test your shortlinks with each activated service
6. If everything works, celebrate!

## Getting your IDs
To properly setup this plugin, you need to manually change the IDs from the defaults to your's. These instructions should show you how to do this for each service:

### AdFly
1. Ensure you have a valid account and are logged in
2. Navigate to [this url](https://adf.ly/publisher/tools#tools-api)
3. Your ID is the number after 'Your User ID:' *not API key*

### AdFocus
1. Ensure you have a valid account and are logged in
2. Navigate to [this url](http://adfoc.us/tools/site-links)
3. Your ID is the number after '?id='

### ouo.io
1. Ensure you have a valid account and are logged in
2. Navigate to [this url](https://ouo.io/manage/tools/full-page-script)
3. Your ID is the bit inside the quotes for `ouo_token`

## Acknowledgements
- Original Author：@HeroCC
- Patch Submitted by : @JackBailey
