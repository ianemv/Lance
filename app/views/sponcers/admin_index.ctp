<?php
 
	echo $html->addCrumb(__('Sponcer', true));

	echo $sidebar->addTitle(sprintf(__('%s Menu', true), __('Sponcer', true)));
	echo $sidebar->addMenu('sponcers', array('title' => sprintf(__('Manage %s',true), __('Sponcers', true)), 'sort_order' => 10));
	echo $sidebar->addMenu('new_sponcer', array('title' => sprintf(__('New %s',true), __('Sponcers', true)), 'sort_order' => 10, 'url' => array('action' => 'add')), 'sponcers');
	?>




<div class="box">
	<div class="box-top rounded_by_jQuery_corners" style="-moz-border-radius-topleft: 5px; -moz-border-radius-topright: 5px;">
    	<h4 class="white"><?php __('Sponcers');?></h4>
	</div>
	<div style="-moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px;" class="box-container rounded_by_jQuery_corners">
		<table cellpadding="0" cellspacing="0" class="table-long">
			<thead>
				<tr>
					<th>&nbsp;</th>
            		<th><?php echo $this->Paginator->sort('id');?></th>
            		<th><?php echo $this->Paginator->sort('name');?></th>
            		<th><?php echo $this->Paginator->sort('link');?></th>
            		<th><?php echo $this->Paginator->sort('image');?></th>
            		<th><?php echo $this->Paginator->sort('created');?></th>
            		<th><?php echo $this->Paginator->sort('modified');?></th>
		            <th class="actions"><?php __('Actions', true);?></th>
	            </tr>
			</thead>
		    <tbody>
			<?php
			$i = 0;
			$count = 0;
			if (!empty($sponcers)):
			foreach ($sponcers as $sponcer):
				$class = null;
				$count = count($sponcer['Sponcer']);
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
	<tr<?php echo $class;?>>
		<td class="col-chk"><input type="checkbox" name="mass[]" value="<?php echo $sponcer['Sponcer']['id']; ?>" /></td>
		<td><?php echo $sponcer['Sponcer']['id']; ?>&nbsp;</td>
		<td><?php echo $sponcer['Sponcer']['name']; ?>&nbsp;</td>
		<td><?php echo $sponcer['Sponcer']['link']; ?>&nbsp;</td>
		<td><?php echo $sponcer['Sponcer']['image']; ?>&nbsp;</td>
		<td><?php echo $sponcer['Sponcer']['created']; ?>&nbsp;</td>
		<td><?php echo $sponcer['Sponcer']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $sponcer['Sponcer']['id']), array('title' => __('Edit', true), 'class' => 'table-edit-link')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $sponcer['Sponcer']['id']), array('title' => __('Delete', true), 'class' => 'table-delete-link'), sprintf(__('Are you sure you want to delete # %s?', true), $sponcer['Sponcer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php else: ?>
	<tr>
		<td colspan=''><?php echo sprintf(__('No %s Found', true), __('Sponcer', true)); ?></td>
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

