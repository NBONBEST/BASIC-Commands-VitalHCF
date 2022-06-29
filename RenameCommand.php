<?php

namespace VitalHCF\commands;

use VitalHCF\Loader;
use VitalHcF\player\Player;

use pocketmine\item\Tool;
use pocketmine\utils\TextFormat as TE;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\permission\DefaultPermissions;

class RenameCommand extends VanillaCommand {

    /**
     * RenameCommand Constructor.
     */
    public function __construct(){
        parent::__construct("rename", "Can rename the item you have in your hand", "rename");
		$this->setPermission("rename.command.use");
    }

    /**
	 * @param CommandSender $sender
	 * @param String $label
	 * @param Array $args
	 * @return void
	 */
	public function execute(CommandSender $sender, String $label, Array $args) : void {
		if(!$sender->hasPermission("rename.command.use")){
            $sender->sendMessage(TE::RED."You have not permissions to use this command");
            return;
        }
		if(empty($args)){
			$sender->sendMessage(TE::RED."Argument #1 is not valid for command syntax");
			return;
		}
		$item = $sender->getInventory()->getItemInHand();
		if($item->isNull()){
			return;
		}
		if($args[0] === "lore" && $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){
			$argument = implode(" ", $args);
            $exploded = explode(" ", $argument);
			unset($exploded[0]);
			
			$name = implode(" ", $exploded);
			$item->setLore([str_replace(["&", "_n"], ["§", "\n"], $name)]);
			$sender->getInventory()->setItemInHand($item);
			return;
		}
		if(!$item instanceof Tool && !$sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)){
			$sender->sendMessage(str_replace(["&"], ["§"], Loader::getConfiguration("messages")->get("player_not_rename_other_item")));
			return;
		}
		$item->clearCustomName();
		$item->setCustomName(str_replace("&", "§", implode(" ", $args)));
		$sender->getInventory()->setItemInHand($item);
		$sender->sendMessage(str_replace(["&", "{itemName}"], ["§", implode(" ", $args)], Loader::getConfiguration("messages")->get("player_rename_correctly")));
	}
}

?>
