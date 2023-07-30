<?php

declare(strict_types=1);

namespace App\Feature;

enum Status
{
    case NotTested;
    case NotSupported;
    case Skipped;
    case Special;
    case Supported;
    case Failed;
}
