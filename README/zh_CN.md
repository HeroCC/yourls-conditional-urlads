# Conditional URL Advertisements

- 适用于[YOURLS](http://yourls.org). 
- 当前页面语言为： :cn: [Chinese Simplified(中文简体)](./zh_CN.md)

## 插件描述
为你的短域名套一层其他带广告的短链接系统

支持如下的广告平台(以下是注册链接):
  * [AdFly](https://join-adf.ly/21969401), trigger: `a/`
  * [AdFoc.us](http://adfoc.us/?refid=788613), trigger `f/`
  * [ouo.io](http://ouo.io/ref/MpFHTzmv), trigger `o/`

到一个有触发器的短地址服务之前，会自动通过选定的服务转发该url（例如*sho.rt/a/test*）。如果它识别了一个触发器，但没有相关的服务，它将不会使链接广告化。

如果你有其他想要支持的服务，请为其发起issue

## 如何安装
1. 克隆到 `/user/plugins` 这个插件文件夹下
2. 在原地复制 `user-config.php.example` 并更名为 `user-config.php`
3. 编辑插件配置 (`user-config.php`) 
4. 在管理员操作中心的插件管理启用该插件
5. 测试短连接地址转换是否成功( sho.rt/a/test -> adfly -> sho.rt/test)
6. 有问题记得反馈即可

## 获取ID
以下方法 不同平台获取ID的方式

### AdFly
1. 先[进去](https://login.adf.ly/login)登录，完事后回来继续看教程
2. [点我访问](https://adf.ly/publisher/tools#tools-api)以获得UserID
3. 你的ID显示在`Your User ID:`或者是`你的用户ID：` *不是API key阿喂!!!*

### AdFocus
1. 先[进去](http://adfoc.us/)登录，完事后回来继续看教程
2. [点我访问](http://adfoc.us/tools/site-links)以获得ID
3. 你的ID在网页里面显示的模板链接 在`?id=`右边

### ouo.io
1. 先[进去](http://ouo.io/)登录，完事后回来继续看教程(提示capecha的 关掉Adblock这类插件)
2. [点我访问](https://ouo.io/manage/tools/full-page-script)以获得token
3. 你的ID应该在`ouo_token`这个选项

## 致谢
- 原作者：[@HeroCC](https://github.com/HeroCC)
- 后续更新 : [@JackBailey](https://github.com/JackBailey)
