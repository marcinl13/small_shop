<?php

abstract class SmallShopIconSize
{
    public const ICON_16 = '16';
}

class SmallShopIcon
{
    public static function add($size = SmallShopIconSize::ICON_16):string
    {
        $icon = sprintf('add_%s.svg', self::getIconSize($size));

        return file_get_contents(SMALL_SHOP__PLUGIN_ICONS . $icon);;
    }

    public static function delete($size= SmallShopIconSize::ICON_16):string
    {
        $icon = sprintf('trash_%s.svg', self::getIconSize($size));

        return file_get_contents(SMALL_SHOP__PLUGIN_ICONS . $icon);
    }

    public static function edit($size= SmallShopIconSize::ICON_16):string
    {
        $icon = sprintf('edit_%s.svg', self::getIconSize($size));

        return file_get_contents(SMALL_SHOP__PLUGIN_ICONS . $icon);
    }

    public static function search($size= SmallShopIconSize::ICON_16):string
    {
        $icon = sprintf('search_%s.svg', self::getIconSize($size));

        return file_get_contents(SMALL_SHOP__PLUGIN_ICONS . $icon);
    }

    private static function getIconSize(string $size):string
    {
        switch ($size) {
            case SmallShopIconSize::ICON_16:
                return SmallShopIconSize::ICON_16; 
            default:
                return SmallShopIconSize::ICON_16; 
        }
    }
}