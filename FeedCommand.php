<?php

namespace VitalHCF\commands;

use VitalHCF\Loader;
use VitalHCf\player\Player;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\permission\DefaultPermissions;
use pocketmine\utils\{Config, TextFormat as TE};

use pocketmine\item\{Item, ItemIds};
use pocketmine\item\ItemFactory;

class FeedCommand extends VanillaCommand {

    /**
     * FeedCommand Constructor
     */
    public function __construct(){
        parent::__construct("feed", "Can fill your food bar to 100%", "feed");
        $this->setPermission("feed.command.use");
    }

    /**
	 * @param CommandSender $sender
	 * @param String $label
	 * @param Array $args
     * @return void
	 */
	public function execute(CommandSender $sender, String $label, Array $args) : void {
	    if(!$sender->hasPermission("feed.command.use")){
            $sender->sendMessage(TE::RED."You have not permissions to use this command");
	        return;
        }
        $sender->getHungerManager()->setFood(20);
        $sender->getHungerManager()->setSaturation(20);

        $sender->sendMessage(str_replace(["&"], ["§"], Loader::getConfiguration("messages")->get("player_fill_food_correctly")));
    }
}

?>
