$command = escapeshellcmd('dir');
$command = escapeshellcmd('python ../resources/views/sayHello.py kalid');
exec($command, $output);


echo '<pre>';
print_r($output[1][4]);
echo '</pre>';