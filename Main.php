<?php

namespace besher\KitUI;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\item\Item;

use pocketmine\event\Listener;

use pocketmine\utils\TextFormat;

class Main extends PluginBase{
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        
        switch($cmd->getName()){
            case "kit":
                if($sender instanceof Player){
                    $this->openMyForm($sender);
                }
            break;
        }
        
        return true;
}


public function openMyForm($player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FomrAPI");
    $form = $api->createSimpleFOrm(function (Player $player, int $data = null){
        $result = $data;
        if($result === null){
            return true;
        }
        switch($result){
            case 0:
                $item = Item::get(276, 0, 1);
                $item->setCustomName("Kit Sword");
                $player->getInventory()->addItem($item);
                
                $player->addTitle("You have redeemed", "Kit 1", 20, 20, 20);
            break;
        }
            case 1:
                $item = Item::get(277, 0, 1);
                $item->setCustomName("Kit something");
                $player->getInventory()->addItem($item);
                
                $player->addTitle("You have redeemed", "Kit 2", 20, 20, 20);
            break;
    });
    $form->setTitle("§4KITS");
    $form->setContent("Please select a kit");
    $form->addButton("Kit 1");
    $form->addButton("Kit 2");
    $form->sendToPlayer($player);
    return $form;
}





