# Conditional URL Advertisements

适用于[YOURLS](http://yourls.org). 

## 插件描述
为你的短域名套一层其他带广告的短链接系统

支持如下的广告平台(以下是注册链接):
  * [AdFly](https://join-adf.ly/21969401), trigger: `a/`
  * [AdFoc.us](http://adfoc.us/?refid=788613), trigger `f/`
  * [ouo.io](http://ouo.io/ref/MpFHTzmv), trigger `o/`

Going to a shorturl with a trigger before it will automatically forward the url through the selected service (ex *sho.rt/a/test*). If it recognizes a trigger but there is no associated service it will not monetize the link.

If you have another sevice you want supported, make a ticket for it!

## Installation
1. 克隆到 `/user/plugins` 这个插件文件夹下
2. 在原地复制 `user-config.php.example` 并更名为 `user-config.php`
3. 编辑插件配置 (`user-config.php`) 
4. 在管理员操作中心的插件管理启用该插件
5. 测试短连接地址转换是否成功( short.link/a/test -> adfly -> short.link/test)
6. 有问题记得反馈即可

## 获取ID
以下方法 不同平台获取ID的方式

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

## 致谢
- 原作者：@HeroCC
- 后续更新 : @JackBailey
