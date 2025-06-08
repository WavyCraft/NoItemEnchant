<?php

declare(strict_types=1);

namespace wavycraft\noitemenchant;

use pocketmine\plugin\PluginBase;

class NoItemEnchant extends PluginBase {

    public static array $blocked_items;

    protected function onEnable() : void{
        $this->saveDefaultConfig();

        self::$blocked_items = $this->getConfig()->get("blocked-items", []);

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
}