<?php
require 'vendor/autoload.php';

use Acme\Models\Customer;
use RedBean_Facade as R;
R::setup('sqlite:db.txt'); // Local SQLite File

// create Jack
$jack = new Customer();
$jack->name = "Jack";
$jack->hasPail = true;
$jack->crownStatus = 'broken';
$id = $jack->save();

// create Jill
$jill = new Customer();
$jill->name = "Jill";
$jill->isTumbling = true;
$id = $jill->save();

// thanks to our BaseModel class, each instance already has an ID assigned
echo sprintf("\$jack->id: %d\n", $jack->id);
echo sprintf("\$jack->name: %s\n", $jack->name);
echo sprintf("\$jack %s tubmling\n", ($jack->isTumbling) ? 'is' : 'is not');
echo "\n";
echo sprintf("\$jill->id: %d\n", $jill->id);
echo sprintf("\$jill->name: %s\n", $jill->name);
echo sprintf("\$jill %s tubmling\n", ($jill->isTumbling) ? 'is' : 'is not');
echo "\n";

// let's load another instance of Jill
$jillTwo = new Customer($jill->id);

if (!$jillTwo->id) {
    echo "Failed to load \$jillTwo\n";
} else {
    echo sprintf("\$jillTwo->id: %d\n", $jillTwo->id);
    echo sprintf("\$jillTwo->name: %s\n", $jillTwo->name);
    echo sprintf("\$jillTwo %s tubmling\n", ($jillTwo->isTumbling) ? 'is' : 'is not');
}
echo "\n";
