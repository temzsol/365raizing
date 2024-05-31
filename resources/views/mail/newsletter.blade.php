

<?php 

$content = $data['newsletter']->html_file;
$content = str_ireplace('{name}',$data['email'],$content);
?>

{!! $content !!}
