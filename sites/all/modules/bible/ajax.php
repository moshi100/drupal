<?php

require 'control/controller.php';

$control = new controller();

echo $control->getVersesListByBook($_GET['book']);
