# Conditional URL Advertisements [![Listed in Awesome YOURLS!](https://img.shields.io/badge/Awesome-YOURLS-C5A3BE)](https://github.com/YOURLS/awesome-yourls/)
- Requires [YOURLS](https://yourls.org) `1.91` and above.
- Select language: [:cn:](./zh_CN.md) / [:us:](./en_US.md)
- This Page's Language is：:us: [English(US)](./en_US.md)

---
## Description
This plugin allows you to redirect all shortlinks through a link monetizer. 

Currently, the following shorteners are supported:
- [AdFly](https://8mi.ink/a/ref-adfly), trigger: `a/`
- [AdFoc.us](https://8mi.ink/f/ref-adfoc), trigger `f/`
- [ouo.io](https://8mi.ink/o/ref-ouoio), trigger `o/`

Going to a shorturl with a trigger before it will automatically forward the url through the selected service (ex *sho.rt/a/test*). If it recognizes a trigger but there is no associated service it will not monetize the link.

If you have another sevice you want supported, make a ticket for it!

---
## Installation
1. Clone this repo to the `/user/plugins` plugins directory
2. Copy `user-config.php.example` and rename it to `user-config.php`
3. Edit the plugin's user config (inside `user-config.php`) to suit your needs
4. Go to the Plugins administration page and activate the plugin
5. Test your shortlinks with each activated service
6. If everything works, celebrate!
---
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
---
## To Do List
Status Tags:    :x: 未解决    :o: 解决   :question: 未知状态
| Status | Question |  Solved? |
|-|-|-|
| :o: | Detects and is compatible with the [Ban User-Agent](https://github.com/8Mi-Tech/yourls-ban-useragent) plugin | No need to detect, he was executed before me

---
## Acknowledgements
- Original : [@HeroCC](https://github.com/HeroCC)
- Patch Updater : [@JackBailey](https://github.com/JackBailey)
