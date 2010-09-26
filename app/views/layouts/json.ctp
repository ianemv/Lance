<?php
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');
header('Content-Type: text/x-JSON');
header('X-JSON: '. $content_for_layout);
?>
<?php echo $content_for_layout; ?>
