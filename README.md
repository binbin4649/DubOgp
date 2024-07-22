# DubOgp plugin for baserCMS

## Installation

You can install this plugin into your baserCMS application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/dub-ogp
```

1) プラグイン有効化
2) layout(default.phpなど)の、<head>内に以下を配置する。
```
<?php $this->BcBaser->showOgp() ?>
```
その他は、プラグイン管理 -> OGP設定、のヘルプ参照。
