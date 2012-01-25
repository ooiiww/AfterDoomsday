<h2>Messages</h2>
<table>
<thead>
<tr>
<th>#</th>
<th>From</th>
<th>To</th>
<th>Date</th>
<th>Type</th>
</tr>
</thead>
<tbody>
<?php foreach ($messages as $message): ?>
<tr>
	<td><?php echo $message['id'] ?></td>
	<td><?php echo $message['sender_id'] ?></td>
	<td><?php echo $message['receiver_id'] ?></td>
	<td><?php echo $message['alarm'] ?></td>
	<td><?php echo $message['type'] ?></td>
</tr>
<?php endforeach ?>
</tbody>
</table>
