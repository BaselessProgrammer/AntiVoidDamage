<?php

namespace KianRastegar\AntiVoidDamage;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\player\Player;

class Main extends PluginBase implements Listener
{

    private int $minY = 40;

    public function onEnable(): void
    {
        $this->getLogger()->info("AntiVoidDamage Enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable(): void
    {
        $this->getLogger()->info("AntiVoidDamage Disabled!");
    }

    public function onDamage(EntityDamageEvent $event): void
    {
        $entity = $event->getEntity();

        if (!$entity instanceof Player) return;

        if ($event->getCause() === EntityDamageEvent::CAUSE_VOID && $entity->getPosition()->getY() < $this->minY) {
            $event->cancel();
        }
    }
}