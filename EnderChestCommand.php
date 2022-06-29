<?php

namespace VitalHCF\commands;

use VitalCHF\Loader;
use VitalHCF\player\Player;
use libs\muqsit\invmenu\transaction\InvMenuTransactionResult;
use VitalHCF\API\InvMenu\type\EnderChestInventory;

use pocketmine\utils\TextFormat as TE;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\permission\DefaultPermissions;
use libs\muqsit\invmenu\InvMenu;
use pocketmine\network\mcpe\protocol\BlockActorDataPacket;
use pocketmine\network\mcpe\protocol\UpdateBlockPacket;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;

class EnderChestCommand extends VanillaCommand {
	public function __construct(){
		parent::__construct("enderchest", "Can open your EnderChest", "ec", ["ec", "enderchest"]);
	}
	public function execute(CommandSender $sender, String $label, Array $args) : void {
		$menu = InvMenu::create("invmenu:chest");
        $menu->getInventory()->setContents($sender->getEnderInventory()->getContents());
		$menu->setName("EnderChest");
        $menu->setInventoryCloseListener(function($player, $inventory) : void{
			$player->getEnderInventory()->setContents($inventory->getContents());
		});
		$menu->send($sender);
	}
}

?>
