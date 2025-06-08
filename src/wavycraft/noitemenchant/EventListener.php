<?php

declare(strict_types=1);

namespace wavycraft\noitemenchant;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemEnchantEvent;

use pocketmine\item\StringToItemParser;

class EventListener implements Listener {

    public function cancelEnchant(PlayerItemEnchantEvent $event) : void{
        $item = $event->getItem();

        foreach (NoItemEnchant::$blocked_items as $blocked_item) {
            $parsed_item = StringToItemParser::getInstance()->parse($blocked_item);
            if ($parsed_item !== null && $parsed_item->getTypeId() === $item->getTypeId()) {
                $event->cancel();
                $event->getPlayer()->sendMessage("§eYou cannot enchant this item: §c" . $parsed_item->getVanillaName());
                break;
            }
        }
    }
}
