
	<?php
	if($session->check('Message.flash')){     
		echo $session->flash();
	}
	?> 
	<div class="block-border">
	    <div class="block-content">
	        <h1>
				Block title
				<?php echo $html->link(sprintf($html->image('admin/icons/fugue/plus-circle-blue.png', array('height' => 16, 'width' => 16))." ".__('Add %s', true), __('User', true)), array('controller' => 'users', 'action' => 'add'), array('escape' => false))?>
			</h1>
			<div class="block-controls">
				<ul class="controls-buttons">
					<li><?php echo $this->Paginator->first($html->image('admin/icons/fugue/control-double-180.png', array('height' => 16, 'width' => 16)).__('First', true), array('escape' => false))?></li>
					<li><?php echo $this->Paginator->prev($html->image('admin/icons/fugue/control-180.png', array('height' => 16, 'width' => 16)).__('Previous', true), array('escape' => false))?></li>
					<li><?php echo $this->Paginator->numbers(array('modulus' => 5,'separator' => '</li><li>')); ?></li>   
					<li><?php echo $this->Paginator->next($html->image('admin/icons/fugue/control.png', array('height' => 16, 'width' => 16)).__('Next', true), array('escape' => false))?></li>
					<li><?php echo $this->Paginator->last($html->image('admin/icons/fugue/control-double.png', array('height' => 16, 'width' => 16)).__('Last', true), array('escape' => false))?></li>
					<li class="sep"></li>
					<li><a href="#"><img src="images/icons/fugue/arrow-circle.png" width="16" height="16"></a></li>
				</ul>  
			</div>
			
	        
			<div class="no-margin">
				<!-- Add the class 'table' -->
				<table class="table" cellspacing="0" width="100%">
		        	<thead> 
						<tr>
							<th class="blank-cell"><span class="loading"></span></th> 
						
		            		<th scope="col">
								<span class="column-sort">
									<?php echo $this->Paginator->sort('', 'username', array('title' => __('Sort Up', true), 'direction' => 'asc', 'class' => 'sort-up')); ?>
									<?php echo $this->Paginator->sort('', 'username', array('title' => __('Sort Down', true), 'direction' => 'desc', 'class' => 'sort-down')); ?>
								</span>
								<?php echo __('User Name', true); ?>
							</th>
		            		<th scope="col"><?php #echo $this->Paginator->sort('first_name');?></th>
		            		<th scope="col">
						   		<span class="column-sort">
									<?php echo $this->Paginator->sort('', 'email', array('title' => __('Sort Up', true), 'direction' => 'asc', 'class' => 'sort-up')); ?>
									<?php echo $this->Paginator->sort('', 'email', array('title' => __('Sort Down', true), 'direction' => 'desc', 'class' => 'sort-down')); ?>
								</span>
								<?php echo __('Email', true); ?>
							</th>
							<th scope="col">
						   		<span class="column-sort">
									<?php echo $this->Paginator->sort('', 'active', array('title' => __('Sort Up', true), 'direction' => 'asc', 'class' => 'sort-up')); ?>
									<?php echo $this->Paginator->sort('', 'active', array('title' => __('Sort Down', true), 'direction' => 'desc', 'class' => 'sort-down')); ?>
								</span>
								<?php echo __('Active', true); ?>
							</th>
							<th scope="col">
						   		<span class="column-sort">
									<?php echo $this->Paginator->sort('', 'group_id', array('title' => __('Sort Up', true), 'direction' => 'asc', 'class' => 'sort-up')); ?>
									<?php echo $this->Paginator->sort('', 'group_id', array('title' => __('Sort Down', true), 'direction' => 'desc', 'class' => 'sort-down')); ?>
								</span>
								<?php echo __('Group', true); ?>
							</th>
				            <th scope="col" class="table-actions"><?php __('Actions', true);?></th>
			            </tr>
					</thead> 
					<tbody>
						<?php 
						if (!empty($users)):
						$i = 0;
						$count = 0;
						foreach ($users as $user):
							$class = null;
							$count = count($user['User']);
							if ($i++ % 2 == 0) {
								$class = ' class="altrow"';
							}
						?>
						<tr>
							<th scope="row" class="table-check-cell"><input type="checkbox" name="selected[]" id="table-selected-1" value="1"></th>
							<td><?php echo $user['User']['username']; ?>&nbsp;</td>
							<td><?php #echo $user['User']['first_name']; ?>&nbsp;</td>
							<td><?php echo $user['User']['email']; ?>&nbsp;</td>
							<td><?php echo ($user['User']['active'])?__('Active', true):__('Inactive', true); ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
							</td>
							<td class="table-actions">
								<?php echo $this->Html->link($html->image('admin/icons/fugue/pencil.png', array('height' => 16, 'width' => 16)), array('action' => 'edit', $user['User']['id']), array('title' => __('Edit', true), 'class' => 'with-tip', 'escape' => false)); ?>
								<?php echo $this->Html->link($html->image('admin/icons/fugue/cross-circle.png', array('height' => 16, 'width' => 16)), array('action' => 'delete', $user['User']['id']), array('title' => __('Delete', true), 'class' => 'with-tip', 'escape' => false),  sprintf(__('Are you sure you want to delete %s?', true), $user['User']['username'])); ?>  
							</td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan=''><?php echo sprintf(__('No %s Found', true), __('User', true)); ?></td>
							</tr>
						<?php endif; ?>
				   	</tbody>
		      	</table>
			</div>
			<ul class="message no-margin">
				<li><?php echo $this->Paginator->counter(array('format' => __('Results %current% of %count% records found.', true))); ?></li>
		   	</ul>
	
	    </div>
	</div>


 