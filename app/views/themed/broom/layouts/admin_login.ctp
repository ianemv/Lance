<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->charset(); ?>
        
        <title>
            <?php echo $title_for_layout; ?>
            <?php __('Admin', true); ?>
        </title>
        <?php 
            echo $html->meta('icon');
            echo $html->css('admin/reset');
            echo $html->css('admin/main');
            echo $html->css('admin/tabber');
            echo $html->css('admin/datePicker');
        ?>

        <!--[if lt IE 7]>
            <?php echo $html->css('admin/admin-ie'); ?>
        <![endif]-->
        <?php 
            echo $javascript->link('jquery/jquery');
            #echo $javascript->link('jquery/ui');
            #echo $javascript->link('admin');
            echo $scripts_for_layout;
        ?>
        <script type="text/javascript">
        $(function () {
            var tabContainers = $('div#forms > div.innerContent'); // change div#forms to your new div id (example:div#pages) if you want to use tabs on another page or div.
            tabContainers.hide().filter(':first').show();
            
            $('ul.switcherTabs a').click(function () {
                tabContainers.hide();
                tabContainers.filter(this.hash).show();
                $('ul.switcherTabs li').removeClass('selected');
                $(this).parent().addClass('selected');
                return false;
            }).filter(':first').click();
        });
        </script>
    </head>
    <body id="b_main">
        <div id="header">
            <div id="logo">
                <h1><span><?php echo $html->link($html->image('admin/logo.png'), array('controller' => 'dashboards', 'action' => 'index', 'admin' => 'admin'), null, null, false); ?></span></h1>
                <ul id="welcome">
                    <li id="esp"><?php echo $html->link(__('Spanish', true), array('controller' => ''), null, null, false); ?></li>
                    <li id="eng"><?php echo $html->link(__('English', true), array('controller' => ''), null, null, false); ?></li>
                    <li><?php echo $html->link(__('Settings', true), array('controller' => 'settings', 'action' => 'index'), null, null, false); ?></li>
                    <li><?php echo $html->link(__('Lights Out', true), array('controller' => 'users', 'action' => 'logout'), null, null, false); ?></li>
                    <li><?php echo sprintf(__('Welcome %s', true), $html->tag('strong', 'Administrator')); ?></li>
                    <li id="last"><?php echo sprintf(__('Last Login: %s', true), $time->niceshort()) ?></li>
                </ul>
            </div>
        </div> 
        <div id="wrapper">
            
            
            <div id="content">
                <div class="container1">
                <?php 
                    if ($session->check('Message.flash')) {
                        $session->flash();
                    }

                    if ($session->check('Message.auth')) {
                        $session->flash('auth');
                    }
                ?> 
                </div>
                <?php echo $content_for_layout; ?>
            </div>

            <?php echo $this->element('admin/footer_menu'); ?>

        </div>
    </body>
</html>

