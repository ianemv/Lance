<nav id="main-nav">   
<?php
	$menu->addMenuArray(Configure::read('Menu'));  
	drawMenuLevel($menu->getMenuArray());
?>
</nav>
<?php function drawMenuLevel($_menu, $_level = 0) {?> 
	<?php if ($_level==2): ?>
		<div class="menu"> 
	<?php endif ?>
	<ul<?php if (!$_level): ?> class="container_12"<?php else: ?> <?php endif; ?>>
		<?php foreach ($_menu as $_item): ?>
			<li class="<?php echo (!empty($_item['class']))?$_item['class']:"" ?> <?php echo (!empty($_item['active']))?' current':'' ?> <?php echo !empty($_item['children'])?' parent':'' ?><?php echo (!empty($_level) && !empty($_item['last']))?' last':'' ?> level<?php echo $_level ?> <?php echo (!empty($_item['children']) && $_level == 1)?' with-menu':''?> <?php echo !empty($_item['title'])?strtolower($_item['title']):''?>"><a  href="<?php echo $_item['url'] ?>" <?php if(!empty($_item['title'])): ?>title="<?php echo $_item['title'] ?>"<?php endif ?> <?php if(!empty($_item['click'])): ?>onclick="<?php echo $_item['click']; ?>"<?php endif ?> class="<?php echo ($_level===0 && !empty($_item['active']))?'active':'' ?> <?php echo !empty($_item['children'])?' top-level':'' ?>"><?php echo $_item['label'] ?><?php if(!empty($_item['children'])): ?><?php endif ?></a>
			<?php if(!empty($_item['children'])): ?> 
                <?php drawMenuLevel($_item['children'], $_level+1); ?>
            <?php endif; ?>
        	</li>
        <?php endforeach; ?>
	</ul>
	<?php if ($_level ==2): ?>
		</div>
	<?php endif ?>
<?php } ?>    
<!-- end of #menu -->