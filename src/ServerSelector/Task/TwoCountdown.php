<?php

namespace ServerSelector\Scheduler;

use ServerSelector\ServerSelector;
use pocketmine\player\Player;

class TwoCountdown extends Task{

    private $plugin;
    public $timer = 5;

    public function __construct(ServerSelector $plugin, $player){
        $this->plugin = $plugin;
        $this->player = $player;

    }

    public function onRun() : void {
        $player = $this->plugin->getServer()->getPlayerExact($this->player);
        if($player instanceof Player){
            if($timer == 5){
                $player->sendMessage($this->plugin->getConfig()->get("Countdown1"));

            }
            if($timer == 4){
                $player->sendMessage($this->plugin->getConfig()->get("Countdown2"));
                
            }
            if($timer == 3){
                $player->sendMessage($this->plugin->getConfig()->get("Countdown3"));
                
            }
            if($timer == 2){
                $player->sendMessage($this->plugin->getConfig()->get("Countdown4"));
                
            }
            if($timer == 1){
                $player->sendMessage($this->plugin->getConfig()->get("Countdown5"));
                
            }
            if($timer == 0){
                $this->plugin->getScheduler()->cancelTask($this->getTaskId());
                $player->transfer($this->plugin->getConfig()->get("server2"));               
            }
        }
        $this->timer--;
    }
}