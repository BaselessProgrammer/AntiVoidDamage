<?php

namespace KianRastegar\AntiVoidDamage;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\entity\EntityDamageEvent;

class Main extends PluginBase implements Listener
{
    private int $minY;

    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->minY = $this->getConfig()->get("minY", 40);

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

        if ($event->getCause() === EntityDamageEvent::CAUSE_VOID && $entity->getPosition()->getY() < $this->minY) {
            $event->cancel();
        }
    }
}