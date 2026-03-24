<?php
// artisan-commands.php

echo "<pre>";
echo "Running Artisan Commands...\n";

// Run Artisan commands
echo shell_exec('php artisan config:clear');
echo shell_exec('php artisan cache:clear');
echo shell_exec('php artisan route:clear');
echo shell_exec('php artisan route:cache');

echo "\nAll commands executed successfully.";
?>
