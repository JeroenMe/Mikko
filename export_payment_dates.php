<?php
include __DIR__.'/bootstrap.php';

(new PaymentApp(new DateTime()))->run();
echo "payment dates exported to output folder!";