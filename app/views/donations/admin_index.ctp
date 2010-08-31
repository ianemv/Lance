<div class="donations index">
	<h2><?php __('Donations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('rut');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('twitter');?></th>
			<th><?php echo $this->Paginator->sort('message');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($donations as $donation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $donation['Donation']['id']; ?>&nbsp;</td>
		<td><?php echo $donation['Donation']['first_name']; ?>&nbsp;</td>
		<td><?php echo $donation['Donation']['last_name']; ?>&nbsp;</td>
		<td><?php echo $donation['Donation']['rut']; ?>&nbsp;</td>
		<td><?php echo $donation['Donation']['email']; ?>&nbsp;</td>
		<td><?php echo $donation['Donation']['twitter']; ?>&nbsp;</td>
		<td><?php echo $donation['Donation']['message']; ?>&nbsp;</td>
		<td><?php echo $donation['Donation']['created']; ?>&nbsp;</td>
		<td><?php echo $donation['Donation']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $donation['Donation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $donation['Donation']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $donation['Donation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $donation['Donation']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Donation', true), array('action' => 'add')); ?></li>
	</ul>
</div>