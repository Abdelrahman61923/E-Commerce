<?php

namespace App\Enums;

enum ContactStatus: string
{
    use Renderable;
    case NEW = 'new';
    case READ = 'read';
    case REPLIED = 'replied';
}
