# Conditional URLAds [![Listed in Awesome YOURLS!](https://img.shields.io/badge/Awesome-YOURLS-C5A3BE)](https://github.com/YOURLS/awesome-yourls/)
- 需要安装 [YOURLS](https://yourls.org) 大于或等于`1.91`版本
- 选择语言切换页面: [:cn:](./zh_CN.md) / [:us:](./en_US.md)
- 当前页面语言为： :cn: [中文(简体)](./zh_CN.md)
---
## 插件描述
为你的短域名套一层其他带广告的短链接系统

支持如下的广告平台(以下是注册链接):
- [AdFly](https://8mi.ink/a/ref-adfly), 触发标识: `a/`
- [AdFoc.us](https://8mi.ink/f/ref-adfoc), 触发标识 `f/`
- [ouo.io](https://8mi.ink/o/ref-ouoio), 触发标识 `o/`
- [Linkvertise](https://8mi.ink/l/ref-linkvertise), 触发标识 `l/`

到一个有触发器的短地址服务之前，会自动通过选定的服务转发该url（例如*sho.rt/a/test*）。如果它识别了一个触发器，但没有相关的服务，它将不会使链接广告化。

如果你有其他想要支持的服务，请为其发起issue

---
## 如何安装
1. 克隆到 `/user/plugins` 这个插件文件夹下
2. 在原地复制 `user-config.php.example` 并更名为 `user-config.php`
3. 编辑插件配置 (`user-config.php`) 
4. 在管理员操作中心的插件管理启用该插件
5. 测试短连接地址转换是否成功( sho.rt/a/test -> adfly -> sho.rt/test)
6. 有问题记得反馈即可

### Linux用户可以看看这边 (假设你已经cd到自己的yourls站点文件夹)
```bash
cd user/plugins
git clone https://github.com/HeroCC/yourls-conditional-urlads
cd yourls-conditional-urlads
cp user-config.php.example user-config.php
vim user-config.php
```
---
## 获取ID
以下方法 不同平台获取ID的方式

### AdFly
~即将被废弃~
1. 先[进去](https://login.adf.ly/login)登录，完事后回来继续看教程
2. [点我访问](https://adf.ly/publisher/tools#tools-api)以获得UserID
3. 你的ID显示在`Your User ID:`或者是`你的用户ID：` *不是API key阿喂!!!*
4. 并将ID复制进`user-config.php`的`ADFLY_ID`选项 (替换掉`input_your_id_here`)

### AdFocus
1. 先[进去](http://adfoc.us/)登录，完事后回来继续看教程
2. [点我访问](http://adfoc.us/tools/site-links)以获得ID
3. 你的ID在网页里面显示的模板链接 在`?id=`右边
4. 并将ID复制进`user-config.php`的`ADFOCUS_ID`选项 (替换掉`input_your_id_here`)

### ouo.io
1. 先[进去](https://ouo.io/auth/signin)登录，完事后回来继续看教程(提示capecha的 关掉Adblock这类插件)
2. [点我访问](https://ouo.io/manage/tools/full-page-script)以获得token
3. 你的ID应该在`ouo_token`这个选项
4. 并将ID复制进`user-config.php`的`OUO_ID`选项 (替换掉`input_your_id_here`)

### Linkvertise
1. 先[登录](https://publisher.linkvertise.com/)
2. 在网站左侧点击`Full Script API`, 并在右侧选择`Activate Full Script API`
3. 再点击左侧的按钮`Full Script API`, 你应该会看到如下文本，并所需的文本是我马赛克的那串文本
4. 并将ID复制进`user-config.php`的`LINKVERTISE_ID`选项 (替换掉`input_your_id_here`)
```html
<script src="https://publisher.linkvertise.com/cdn/linkvertise.js"></script><script>linkvertise(******, {whitelist: [], blacklist: [""]});</script>
```

---
## 目标清单
状态标志    :x: 未解决    :o: 解决   :question: 未知状态
| 状态 | 问题 |  解决方案 |
|-|-|-|
| :o: | 检测并兼容 [Ban User-Agent](https://github.com/8Mi-Tech/yourls-ban-useragent) 插件 | 不用检测了，他直接抢在我前面执行，草了
| :x: | 配置文件从 `user-config.php` 迁移到 `/admin/plugins.php?page=conditional-urlads` | 

---
## 致谢
- 原作者：[@HeroCC](https://github.com/HeroCC)
- 后续更新 : [@JackBailey](https://github.com/JackBailey)
- Linkverse支持: [@8Mi_Yile](https://github.com/8MiYile) (创意来源于[FutureStunt/linkvertise](https://github.com/FutureStunt/linkvertise))
