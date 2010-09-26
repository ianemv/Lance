    <div id="message_hint">
        <?php if ($session->check('Message.flash')) {
            echo $session->flash();
        }
        if ($session->check('Message.auth')) {
            echo $session->flash('auth');
        }
        ?>
    </div>
 
