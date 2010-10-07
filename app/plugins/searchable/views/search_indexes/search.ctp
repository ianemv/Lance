
<?php if (!empty($results)): ?>    
  <ul>
    <?php foreach ($results as $result) : ?>                              
    <li id="<?php echo $result['SearchIndex']['id']; ?>" url="<?php echo $html->url(json_decode($result['SearchIndex']['url'], true)); ?>">  
		<?php $data = json_decode($result['SearchIndex']['data'], true); ?>   
		<?php if (is_file(IMAGES . 'plazas' . DS . 'thumbs' . DS . $data['School.key']."_main.jpg")): ?>  
			<?php echo $html->image('plazas' . DS . 'thumbs' . DS . $data['School.key']."_main.jpg", array('alt' => $data['School.name'], 'rel' => Inflector::camelize( $data['School.name'].$result['SearchIndex']['foreign_key']))); ?>       
		<?php else: ?>  
			<?php echo $html->image('plazas' . DS . 'thumbs' . DS . 'no-image.png', array('alt' => $data['School.name'], 'rel' => Inflector::camelize( $data['School.name'].$result['SearchIndex']['foreign_key']))); ?>       
		<?php endif; ?>  
		<h3><?php echo $result['SearchIndex']['name']; ?></h3>
		<p><?php echo $result['SearchIndex']['summary']; ?></p>   
		<div class="clear"></div>
    </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p><?php echo __('Nothing Found', true); ?></p>
<?php endif; ?>

