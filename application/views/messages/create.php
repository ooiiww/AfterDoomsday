<h2>Create a message</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('messages/create'); ?>
<fieldset>

<div class="clearfix">
	<label for="sender_id">Sender</label>
	<div class="input">
		<span class="uneditable-input">山山</span>
	</div>
</div>

<div class="clearfix">
	<label for="receiver_id">Receiver</label>
	<div class="input">
		<select name="receiver">
			<option value="1">张三</option>
			<option value="2">李四</option>
			<option value="3">王五</option>
			<option value="4">陈乐</option>
		</select>
	</div>
</div>

<div class="clearfix">
	<label for="type">Type</label>
	<div class="input">
		<select name="type">
			<option value="1">状态</option>
			<option value="2">私信</option>
			<option value="3">悄悄话</option>
			<option value="4">公开留言</option>
		</select>
	</div>
</div>

<div class="clearfix">
	<label for="alarm">Alarm</label>
	<div class="input">
		<span class="uneditable-input">2012-12-22</span>
	</div>
</div>

<div class="clearfix">
	<label for="content">Content</label>
	<div class="input">
		<textarea type="text" name="content" rows="3"></textarea>
	</div>
</div>

<div class="actions">
	<input type="submit" name="submit" value="Leave message" class="btn primary"/>
	<button type="reset" class="btn">Cancel</button>
</div>

</fieldset>
</form>
