<?php

namespace ServerSelector;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as MG;

use ServerSelector\Commands\ServerCommand;

class ServerSelector extends PluginBase {

    private static $instance;
	
	public function onLoad() : void {
		self::$instance = $this;
	}

    public function onEnable() : void {
        $this->getLogger()->info(MG::GREEN . "ServerSelector enabled successfully, plugin made by JuanantonioVYT for MegaHost community");
        $this->getServer()->getCommandMap()->register("/serverselector", new ServerCommand($this));
        $this->saveResource("config.yml");

    }

    public function onDisable() : void {
        $this->getLogger()->info(MG::RED . "ServerSelector disabled success");

    }

    public static function getInstance() : ServerSelector {
		return self::$instance;
    }
}