<?php

declare(strict_types=1);

namespace matheuss\NexusMap;

use pocketmine\plugin\PluginBase;
use pocketmine\world\WorldCreationOptions;
use pocketmine\world\generator\GeneratorManager;
use pocketmine\Server;
use pocketmine\player\Player;
use matheuss\NexusMap\MapGenerator;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use jojoe77777\FormAPI\CustomForm;

class Main extends PluginBase {
    
    public function onLoad(): void {
        GeneratorManager::getInstance()->addGenerator(MapGenerator::class, 'edge', fn() => null, true);      
    }
    
    /**
     * @Param strig $name
     *
     * @return void
     */
    public function generateWorld(string $name): void {
        $generator = GeneratorManager::getInstance()->getGenerator('edge');
        $this->getServer()->getWorldManager()->generateWorld($name, WorldCreationOptions::create()->setGeneratorClass($generator->getGeneratorClass()), true);
    }
    
    /**
     * @Param CommandSender $sender
     * @Param Command       $cmd
     * @Param string        $label
     * @Param array         $args
     *
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
        if($cmd->getName() == 'generator') {
            if($sender instanceof Player) {
            	$this->sendMenu($sender);
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * @Param Player $player
     * 
     * @return void
     */
    public function sendMenu(Player $player) {
        $form = new CustomForm(function(Player $player, array $data) {
           if($data == null) {
               return true;
           }
            
           $this->generateWorld($data[0]);
           return false;
        });
        
        $form->addInput('Coloque o nome do mundo');
        $form->sendToPlayer($player);
    }
}
