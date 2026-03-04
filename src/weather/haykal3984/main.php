<?php

namespace weather\haykal3984;

use pocketmine\plugin\PluginBase;
use pocketmine\events\Listener;
use pocketmine\player\Player;
use pocketmine\Server;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use weather\haykal3984\libs\jojoe77777\FormAPI\SimpleForm;
class main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("plugin di buat oleh Haykal3984");
    }
    public function onDisable(): void {
        $this->getLogger()->info("Jangan Lupa Subscribe Haykal3984");
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {

        if($command->getName() == "weatherui"){
            if($sender instanceof Player){
                $this->newSimpleForm($sender);
            } else {
                $sender->sendMessage("Run Command In-game Only");
            }
        }

        return true;
    }

    public function newSimpleForm($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }

            switch($data){   
                case 0:
                    $this->getServer()->dispatchCommand($player, "weather clear");
                break;     
                
                case 1:
                    $this->getServer()->dispatchCommand($player, "weather rain");
                break;
                    
                case 2:
                    $this->getServer()->dispatchCommand($player, "weather thunder");
                break;
            }

        });
        $form->setTitle("Hadiah");
        $form->setContent("Select A WeatherUI\n§6Creator §eFiture §r: §6Haykal3984");
        $form->addButton("§r[ §6Weather §aClear §r]\n§rKlick Untuk Merubah Cuaca", 0, "textures/ui/weather_clear");
        $form->addButton("§r[ §6Weather §eRain §r]\n§rKlick Untuk Merubah Cuaca", 0, "textures/ui/weather_rain");
        $form->addButton("§r[ §6Weather §cThunder §r]\n§rKlick Untuk Merubah Cuaca", 0, "textures/ui/weather_thunderstorm");
        $form->addButton("§cLeave The Form\n§rKlick Untuk Keluar", 0, "");
        $form->sendToPlayer($player);
        return $form;
    }

}
