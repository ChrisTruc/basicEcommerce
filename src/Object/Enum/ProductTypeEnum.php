<?php
namespace App\Object\Enum;

class ProductTypeEnum
{
    private const NB_TYPE_PRODUCT = 3;

    public const NOURRITURE = 'nourriture';
    public const BOISSON = 'boisson';
    public const OTHER = 'autre';

    public static function getValueEnumOfInt($key) {
        switch ($key) {
            case 1:
                return self::NOURRITURE;
                break;
            case 2:
                return self::BOISSON;
                break;
            default:
                return self::OTHER;
                break;
        }
    }

    public static function countTypeProduct() {
        return self::NB_TYPE_PRODUCT;
    }

}

?>