<?php

namespace App\Enums;

enum PanicButtonEnum : string
{
    case CALL = 'Call';
    case EMAIL = 'E-mail';
    case SMS = 'SMS';
}
