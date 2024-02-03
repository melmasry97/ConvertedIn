<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Admin()
 * @method static static User()
 */
final class UserType extends Enum
{
    const User = 0;
    const Admin = 1;
}
