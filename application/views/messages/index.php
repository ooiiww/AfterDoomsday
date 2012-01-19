<h2>Messages</h2>
<ul>
<?php foreach ($messages as $message): ?>
<li>
	<h2><?php echo $message['sender_id'] ?> to <?php echo $message['receiver_id'] ?></h2>
	<h3>at <?php echo $message['alarm'] ?> as <?php echo $message['type'] ?></h3>
	<p><?php echo $message['content'] ?><p>
</li>
<?php endforeach ?>
</ul>
