<?php

chdir("../shared/public");

foreach (glob("classes/*.php") as $filename) {
//    echo $filename;
    include_once $filename;
}