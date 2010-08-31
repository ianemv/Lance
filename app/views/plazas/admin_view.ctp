<div class="plazas view">
<h2><?php  __('Plaza');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plaza['Plaza']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($plaza['School']['name'], array('controller' => 'schools', 'action' => 'view', $plaza['School']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plaza['Plaza']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Plaza', true)), array('action' => 'edit', $plaza['Plaza']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Plaza', true)), array('action' => 'delete', $plaza['Plaza']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $plaza['Plaza']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Plazas', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Plaza', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Schools', true)), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('School', true)), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Plaza Images', true)), array('controller' => 'plaza_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Plaza Image', true)), array('controller' => 'plaza_images', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Plaza Images', true));?></h3>
	<?php if (!empty($plaza['PlazaImage'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Plaza Id'); ?></th>
		<th><?php __('Image'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($plaza['PlazaImage'] as $plazaImage):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $plazaImage['id'];?></td>
			<td><?php echo $plazaImage['plaza_id'];?></td>
			<td><?php echo $plazaImage['image'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'plaza_images', 'action' => 'view', $plazaImage['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'plaza_images', 'action' => 'edit', $plazaImage['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'plaza_images', 'action' => 'delete', $plazaImage['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $plazaImage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Plaza Image', true)), array('controller' => 'plaza_images', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
