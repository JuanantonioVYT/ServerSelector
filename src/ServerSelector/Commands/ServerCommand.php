<?php

namespace ServerSelector\Commands;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\world\Position;
use Vecnavium\FormsUI\Form;
use Vecnavium\FormsUI\FormAPI;
use Vecnavium\FormsUI\SimpleForm;
use ServerSelector\ServerSelector;

class ServerCommand extends Command {

    private $plugin;

    public function __construct()
    {
        parent::__construct("serverselector", "Open Servers Menu", null, ["server"]);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            $this->plugin = ServerSelector::getInstance();
            $this->getServersMenu($player);
        }
    }

    public function getServersMenu(Player $player){
        $form = new SimpleForm(function (Player $player, int $data = null){
            if($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $player->transfer($this->plugin->getConfig()->get("server1"), $this->plugin->getConfig()->get("port1")); 
                break;
                case 2:
                    $player->transfer($this->plugin->getConfig()->get("server2"), $this->plugin->getConfig()->get("port2")); 
                break;
                case 3:
                    $player->transfer($this->plugin->getConfig()->get("server3"), $this->plugin->getConfig()->get("port3")); 
                break;
                case 4:
                    $player->transfer($this->plugin->getConfig()->get("server4"), $this->plugin->getConfig()->get("port4")); 
                break;
            }
        });
        $form->setTitle($this->plugin->getConfig()->get("title"));
        $form->addButton($this->plugin->getConfig()->get("Form1"));
        $form->addButton($this->plugin->getConfig()->get("Form2"));
        $form->addButton($this->plugin->getConfig()->get("Form3"));
        $form->addButton($this->plugin->getConfig()->get("Form4"));
        $form->addButton("§l§cCerrar");
        $form->sendToPlayer($player);
        return $form;
    }
}