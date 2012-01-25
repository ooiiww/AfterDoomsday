<html>
<head>
<Meta http-equiv="Content-Type" Content="text/html; Charset=utf-8">
<title>SB，你好！</title>
</head>
<body>
<?php foreach($friends as $k=>$v):?>
<p><?php echo $v["name"];?></p>
<img src=<?php echo $v["tinyurl"];?> />
<?php endforeach;?>
</body>
</html>