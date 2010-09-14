<?php
 
	echo $html->addCrumb(__('Plaza', true));

	echo $sidebar->addTitle(sprintf(__('%s Menu', true), __('Plaza', true)));
	echo $sidebar->addMenu('plazas', array('title' => sprintf(__('Manage %s',true), __('Plazas', true)), 'sort_order' => 10));
	echo $sidebar->addMenu('new_plaza', array('title' => sprintf(__('New %s',true), __('Plazas', true)), 'sort_order' => 10, 'url' => array('action' => 'add')), 'plazas');
	echo $sidebar->addMenu('schools', array('title' => sprintf(__('Manage %s', true), __('Schools', true)), 'sort_order' => 20));
echo $sidebar->addMenu('list schools', array('title' => sprintf(__('List %s', true), __('Schools', true)), 'sort_order' => 20, 'url' => array('controller' => 'schools', 'action' => 'index')), 'schools');
echo $sidebar->addMenu('new schools', array('title' => sprintf(__('New %s', true), __('School', true)), 'sort_order' => 20, array('controller' => 'schools', 'action' => 'add')), 'schools');
echo $sidebar->addMenu('plaza images', array('title' => sprintf(__('Manage %s', true), __('Plaza Images', true)), 'sort_order' => 30));
echo $sidebar->addMenu('list plaza images', array('title' => sprintf(__('List %s', true), __('Plaza Images', true)), 'sort_order' => 30, 'url' => array('controller' => 'plaza_images', 'action' => 'index')), 'plaza images');
echo $sidebar->addMenu('new plaza images', array('title' => sprintf(__('New %s', true), __('PlazaImage', true)), 'sort_order' => 30, array('controller' => 'plaza_images', 'action' => 'add')), 'plaza images');
?>




<div class="box">
	<div class="box-top rounded_by_jQuery_corners" style="-moz-border-radius-topleft: 5px; -moz-border-radius-topright: 5px;">
    	<h4 class="white"><?php __('Plazas');?></h4>
	</div>
	<div style="-moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px;" class="box-container rounded_by_jQuery_corners">
		<table cellpadding="0" cellspacing="0" class="table-long">
			<thead>
				<tr>
					<th>&nbsp;</th>
            		<th><?php echo $this->Paginator->sort('id');?></th>
            		<th><?php echo $this->Paginator->sort('school_id');?></th>
            		<th><?php echo $this->Paginator->sort('description');?></th>
		            <th class="actions"><?php __('Actions', true);?></th>
	            </tr>
			</thead>
		    <tbody>
			<?php
			$i = 0;
			$count = 0;
			if (!empty($plazas)):
			foreach ($plazas as $plaza):
				$class = null;
				$count = count($plaza['Plaza']);
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
	<tr<?php echo $class;?>>
		<td class="col-chk"><input type="checkbox" name="mass[]" value="<?php echo $plaza['Plaza']['id']; ?>" /></td>
		<td><?php echo $plaza['Plaza']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($plaza['School']['name'], array('controller' => 'schools', 'action' => 'view', $plaza['School']['id'])); ?>
		</td>
		<td><?php echo $plaza['Plaza']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $plaza['Plaza']['id']), array('title' => __('Edit', true), 'class' => 'table-edit-link')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $plaza['Plaza']['id']), array('title' => __('Delete', true), 'class' => 'table-delete-link'), sprintf(__('Are you sure you want to delete # %s?', true), $plaza['Plaza']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php else: ?>
	<tr>
		<td colspan=''><?php echo sprintf(__('No %s Found', true), __('Plaza', true)); ?></td>
	</tr>
<?php endif; ?>
			</tbody>
			<tfoot>
				<td class="col-chk"><input type="checkbox" name="" /></td>
				<td colspan="5">
	
				</td>
				<tr>
					<td colspan="5">
                        <div class="pagination">
                            	<?php echo $this->Paginator->first('<'.__('First', true), array()); ?>
                            	<?php echo $this->Paginator->prev('<<'.__('Previous', true), array(), null, array('class' => 'disabled')); ?>
                            	<?php echo $this->Paginator->numbers(array('class' => 'number', 'separator' => '')); ?>
                            	<?php echo $this->Paginator->next(__('Next', true).'>>', array(), null, array('class' => 'disabled')); ?>
                            	<?php echo $this->Paginator->last(__('Last', true).'>', array()); ?>
                        </div>
                        <div class="clear"></div>
                    </td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

