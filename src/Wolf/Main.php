<?php

namespace Wolf;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\{command\ConsoleCommandSender, Server, Player, utils\TextFormat};
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getLogger()->Info("§aEconomyAPIUI has been enabled!\n\n\n\n\§l§b§onSubcribe channel Wolfkid!!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "ecoui":
			$this->mainForm($player);
        }
        return true;
    }
	
	public function mainForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createSimpleForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				if(isset($data[0])){
					switch($data[0]){
						case 0:
						$this->paymoneyForm($player);
						break;
						case 1:
						$this->givemoneyForm($player);
						break;
						case 2:
						$this->getServer()->getCommandMap()->dispatch($player, "topmoney");
						break;
						case 3:
						$this->setmoneyForm($player);
						break;
						case 4:
						$this->seemoneyForm($player);
						break;
						case 5:
						$this->getServer()->getCommandMap()->dispatch($player, "mymoney");
					}
				}
			});
			$form->setTitle("§l§eMoney §bMenu");
			$form->setContent("§o§aPlease Choose One Command!");
			$form->addButton("§l§6Pay Money To Another Player");
			$form->addButton("§l§6Give Money To Another Player");
			$form->addButton("§l§6Top Money Of Server");
			$form->addButton("§l§6Change Money Of Another Player");
			$form->addButton("§l§6See Money Of Another Player");
			$form->addButton("§l§6Your Money");
			$form->sendToPlayer($player);
		}
	}
	
	public function paymoneyForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->playerName = $data[0];
					$this->moneyPay = $data[1];
					$this->getServer()->getCommandMap()->dispatch($player, "pay " . $this->playerName . $this->moneyPay);
				}
			});
			$form->setTitle("§l§bPay §eMoney §b To Another Player");
			$form->addInput("§oType Player Name And Money To Pay");
			$form->sendToPlayer($player);
		}
	}
	
	public function givemoneyForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->playerNamee = $data[0];
					$this->moneyGive = $data[1];
					$this->getServer()->getCommandMap()->dispatch($player, "givemoney " . $this->playerNamee . $this->moneyGive);
				}
			});
			$form->setTitle("§l§bGive §eMoney §b To Another Player");
			$form->addInput("§oType Player Name And Money To Give");
			$form->sendToPlayer($player);
		}
	}
	public function setmoneyForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->playerNamea = $data[0];
					$this->moneyChange = $data[1];
					$this->getServer()->getCommandMap()->dispatch($player, "setmoney " . $this->playerNamea . $this->moneyChange);
				}
			});
			$form->setTitle("§l§bChange §eMoney §b Of Another Player");
			$form->addInput("§oType Player Name And Money To Change");
			$form->sendToPlayer($player);
		}
	}
	
	public function seemoneyForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->playerNamer = $data[0];
					$this->getServer()->getCommandMap()->dispatch($player, "seemoney " . $this->playerNamer);
				}
			});
			$form->setTitle("§l§bSee §eMoney §bOf Another Player");
			$form->addInput("§oType Player Name ");
			$form->sendToPlayer($player);
		}
	}
}