<?php

declare(strict_types=1);

namespace wavycraft\noitemenchant;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemEnchantEvent;

use pocketmine\item\StringToItemParser;

class EventListener implements Listener {

    public function onEnchant(PlayerItemEnchantEvent $event) : void{
        $item = $event->getInputItem();

        foreach (NoItemEnchant::$blocked_items as $blockedItem) {
            $parsedItem = StringToItemParser::getInstance()->parse($blockedItem);
            if ($parsedItem !== null && $parsedItem->getTypeId() === $item->getTypeId()) {
                $event->cancel();
                $event->getPlayer()->sendMessage("§eYou cannot enchant this item: §c" . $parsedItem->getVanillaName());
                return;
            }
        }
    }
}
