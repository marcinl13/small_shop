<?php

namespace Icon;

abstract class IconSize
{
    public const ICON_16 = '16';
    public const ICON_24 = '24';
}

class Icon
{
    public static function add($size = IconSize::ICON_16):string
    {
        $icon = sprintf('add_%s.svg', self::getIconSize($size));

        return file_get_contents(SMALL_SHOP__PLUGIN_ICONS . $icon);;
    }

    public static function delete($size= IconSize::ICON_16):string
    {
        $icon = sprintf('trash_%s.svg', self::getIconSize($size));

        return file_get_contents(SMALL_SHOP__PLUGIN_ICONS . $icon);
    }

    public static function edit($size= IconSize::ICON_16):string
    {
        $icon = sprintf('edit_%s.svg', self::getIconSize($size));

        return file_get_contents(SMALL_SHOP__PLUGIN_ICONS . $icon);
    }

    public static function search($size= IconSize::ICON_16):string
    {
        $icon = sprintf('search_%s.svg', self::getIconSize($size));

        return file_get_contents(SMALL_SHOP__PLUGIN_ICONS . $icon);
    }

    private static function getIconSize(string $size):string
    {
        switch ($size) {
            case IconSize::ICON_16:
                return IconSize::ICON_16;
            case IconSize::ICON_24:
                return IconSize::ICON_24;
            default:
                return IconSize::ICON_16; 
        }
    }
}