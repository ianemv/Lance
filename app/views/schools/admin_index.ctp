<?php
 
	echo $html->addCrumb(__('School', true));

	echo $sidebar->addTitle(sprintf(__('%s Menu', true), __('School', true)));
	echo $sidebar->addMenu('schools', array('title' => sprintf(__('Manage %s',true), __('Schools', true)), 'sort_order' => 10));
	echo $sidebar->addMenu('new_school', array('title' => sprintf(__('New %s',true), __('Schools', true)), 'sort_order' => 10, 'url' => array('action' => 'add')), 'schools');
	echo $sidebar->addMenu('plazas', array('title' => sprintf(__('Manage %s', true), __('Plazas', true)), 'sort_order' => 20));
echo $sidebar->addMenu('list plazas', array('title' => sprintf(__('List %s', true), __('Plazas', true)), 'sort_order' => 20, 'url' => array('controller' => 'plazas', 'action' => 'index')), 'plazas');
echo $sidebar->addMenu('new plazas', array('title' => sprintf(__('New %s', true), __('Plaza', true)), 'sort_order' => 20, array('controller' => 'plazas', 'action' => 'add')), 'plazas');
?>




<div class="box">
	<div class="box-top rounded_by_jQuery_corners" style="-moz-border-radius-topleft: 5px; -moz-border-radius-topright: 5px;">
    	<h4 class="white"><?php __('Schools');?></h4>
	</div>
	<div style="-moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px;" class="box-container rounded_by_jQuery_corners">
		<table cellpadding="0" cellspacing="0" class="table-long">
			<thead>
				<tr>
					<th>&nbsp;</th>
            		<th><?php echo $this->Paginator->sort('id');?></th>
            		<th><?php echo $this->Paginator->sort('name');?></th>
            		<th><?php echo $this->Paginator->sort('description');?></th>
            		<th><?php echo $this->Paginator->sort('image');?></th>
            		<th><?php echo $this->Paginator->sort('lat');?></th>
            		<th><?php echo $this->Paginator->sort('long');?></th>
		            <th class="actions"><?php __('Actions', true);?></th>
	            </tr>
			</thead>
		    <tbody>
			<?php
			$i = 0;
			$count = 0;
			if (!empty($schools)):
			foreach ($schools as $school):
				$class = null;
				$count = count($school['School']);
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
	<tr<?php echo $class;?>>
		<td class="col-chk"><input type="checkbox" name="mass[]" value="<?php echo $school['School']['id']; ?>" /></td>
		<td><?php echo $school['School']['id']; ?>&nbsp;</td>
		<td><?php echo $school['School']['name']; ?>&nbsp;</td>
		<td><?php echo $school['School']['description']; ?>&nbsp;</td>
		<td><?php echo $school['School']['image']; ?>&nbsp;</td>
		<td><?php echo $school['School']['lat']; ?>&nbsp;</td>
		<td><?php echo $school['School']['long']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $school['School']['id']), array('title' => __('Edit', true), 'class' => 'table-edit-link')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $school['School']['id']), array('title' => __('Delete', true), 'class' => 'table-delete-link'), sprintf(__('Are you sure you want to delete # %s?', true), $school['School']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php else: ?>
	<tr>
		<td colspan=''><?php echo sprintf(__('No %s Found', true), __('School', true)); ?></td>
	</tr>
<?php endif; ?>
			</tbody>
			<tfoot>
				<td class="col-chk"><input type="checkbox" name="" /></td>
				<td colspan="8">
	
				</td>
				<tr>
					<td colspan="8">
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

