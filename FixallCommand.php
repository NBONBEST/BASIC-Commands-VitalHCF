<?php

namespace VitalHCF\commands;

use VitalHCF\Loader;
use VitalHCF\player\Player;

use pocketmine\item\{Item, Armor, Tool};

use pocketmine\utils\TextFormat as TE;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\permission\DefaultPermissions;

class FixallCommand extends VanillaCommand {
	
	/**
	 * FixCommand Constructor.
	 */
	public function __construct(){
		parent::__construct("fixall", "FixAll For everyone!", "fixall");
	}
	
	/**
	 * @param CommandSender $sender
	 * @param String $label
	 * @param Array $args
     * @return void
	 */
	public function execute(CommandSender $sender, String $label, Array $args) : void {
        if(!$sender instanceof Player){
            $sender->sendMessage('vaya?');
        }
		if($sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){
            $players = "";
			foreach($sender->getServer()->getOnlinePlayers() as $player) {
                    $players = $player->getName().$players.", ";
             			foreach($player->getInventory()->getContents() as $slot => $item){
							if($item instanceof Tool||$item instanceof Armor){
								if($item->getDamage() > 0){
									$player->getInventory()->setItem($slot, $item->setDamage(0));
								}
							}
						}
						foreach($player->getArmorInventory()->getContents() as $slot => $item){
							if($item instanceof Tool||$item instanceof Armor){
								if($item->getDamage() > 0){
									$player->getArmorInventory()->setItem($slot, $item->setDamage(0));
							}
						}
					}
         		
    		}
			$sender->sendMessage("Has reparado los items a estos jugadores: ", $players);
        }
	}
}

?>
