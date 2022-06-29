<?php

namespace VitalHCF\commands\moderation;

use VitalHCF\Loader;
use VitalHCF\player\Player;

use pocketmine\utils\TextFormat as TE;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\permission\Permisions;

class GodCommand extends VanillaCommand {
	
	/**
	 * GodCommand Constructor.
	 */
	public function __construct(){
		parent::__construct("god");
	}
	
	/**
	 * @param CommandSender $sender
	 * @param String $label
	 * @param Array $args
     * @return void
	 */
	public function execute(CommandSender $sender, String $label, Array $args) : void {
		if(!$sender->hasPermission(DefaultPermissions)){
			$sender->sendMessage(TE::RED."§l§7[§6!§7]§7 -§r§7 You have not permissions to use this command");
			return;
		}
		if($sender->isGodMode()){
			$sender->setGodMode(false);
			$sender->sendMessage(TE::RED."You just desactivated god mode!");
		}else{
			$sender->setGodMode(true);
			$sender->sendMessage(TE::GREEN."You just activated god mode!");
        }
	}
}

?>
