<?php

function site()
{
    $site = \statamic\facades\Site::current();
    return $site;
}