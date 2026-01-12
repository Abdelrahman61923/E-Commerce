<?php

namespace App\Enums;

enum ContactStatus: string
{
    case NEW = 'new';
    case READ = 'read';
    case REPLIED = 'replied';
}
