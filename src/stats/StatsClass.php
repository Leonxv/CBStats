<?php

namespace stats;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\Server;

class StatsClass extends PluginBase implement Listener
{
	public const prefix = "§l§6Stats§r §a";
	
	public function onEnable() 
	{
		$this->getLogger()->info(self::prefix. "On");
	} 
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool
	{
		$data = new Config($this->getDataFolder() . $sender->getName() . ".yml", Config::YAML);
		if($command->getName() === "stats"){
			$sender->sendMessage("§b=== §6§lStats Menu§r§b ===\n§6Joined §e| $data->get("join")\n§6Leave§e | $data->get("quit")\n§6Break §e| $data->get("break")\n§6Place §e| $data->get("place")");
			returns true;
		} 
	} 
	
	public function onJoin(PlayerJoinEvent $event) 
	{
		$player = $event->getPlayer();
		$name = $player->getName();
		$data = new Config($this->getDataFolder() . $player->getName() . ".yml", Config::YAML);
         if(!$data->exists("join")){
         	$data->set("join", 0);
             $data->set("quit", 0);
             $data->set("place",0);
             $data->set("break",0);
             $data->save();
             $old_data = $data->get("join")+1;
             $data->set("join", $old_data);
             $data->save();
	} 
	
	public function onQuit(PlayerQuitEvent $event) 
	{
		$player = $event->getPlayer();
		$name = $player->getName();
		$data = new Config($this->getDataFolder() . $player->getName() . ".yml", Config::YAML);
	    $old_data = $data->get("quit")+1;
        $data->set("quit", $old_data);
        $data->save();
	} 
	
	public function onBreak(BlockBreakEvent $event)
	{
		$player = $event->getPlayer();
		$name = $player->getName();
		$data = new Config($this->getDataFolder() . $player->getName() . ".yml", Config::YAML);
	    $old_data = $data->get("break")+1;
        $data->set("break", $old_data);
        $data->save();
	} 
	
	public function onPlace(BlockPlaceEvent $event) 
	{
		$player = $event->getPlayer();
		$name = $player->getName();
		$data = new Config($this->getDataFolder() . $player->getName() . ".yml", Config::YAML);
	    $old_data = $data->get("place")+1;
        $data->set("place", $old_data);
        $data->save();
	} 
} 
