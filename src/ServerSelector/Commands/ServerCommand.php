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
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, "transferserver " . $this->plugin->getConfig()->get("server1")); 
                break;
                case 2:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, "transferserver " . $this->plugin->getConfig()->get("server2")); 
                break;
                case 3:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, "transferserver " . $this->plugin->getConfig()->get("server3")); 
                break;
                case 4:
                    $this->plugin->getServer()->getCommandMap()->dispatch($player, "transferserver " . $this->plugin->getConfig()->get("server4")); 
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