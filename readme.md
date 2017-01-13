## laravel-echo-server
>这是一个用来支持laravel的事件广播的socket服务器

## 安装
首先,你必须为你的php安装swoole扩展以及redis扩展,推荐使用php7

直接用composer安装
```
composer require zhaohehe/laravel-echo-server
```
然后在```app.php```中的providers数组中加入下面的一项
```
\EchoServer\BroadcastServerServiceProvider::class,
```
最后运行下面的命令,发布配置文件
```
php artisan vendor:publish
```

## 使用
开启socket服务器
```
php artisan echo start
```
你可以在echo.php文件中配置服务器监听的端口,默认是:3523

你需要在.env中设置BROADCAST_DRIVER=redis

前端代码:
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div id="msg"></div>

</body>
<script>

    var msg = document.getElementById('msg');

    var wsServer = 'ws://localhost:3523';

    var websocket = new WebSocket(wsServer);

    websocket.onopen = function (evt) {
        console.log(websocket.readyState);

        var message = '{"channel": "test-channel", "event": "TestBroadcastEvent"}';
        websocket.send(message);

        //监听消息
        websocket.onmessage = function (evt) {
            msg.innerHTML += evt.data +'<br>';
        };

    };

    // 关闭Socket....
    //websocket.close()

</script>
</html>
```

你的event必须实现ShouldBroadcast接口,那么,当你的事件被触发的时候,前端页面会获取到实时的message

## 最后

这是一个非常简陋的事件广播服务,只实现了最基本的功能,验证一下想法,我会去仔细研究下reids和laravel的广播以及swoole然后来完善它。
