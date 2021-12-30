<?php

/*
 *   
 *   ███╗░░██╗░█████╗░░█████╗░██████╗░███╗░░░███╗░█████╗░██████╗░░██████╗░
 *   ████╗░██║██╔══██╗██╔══██╗██╔══██╗████╗░████║██╔══██╗██╔══██╗██╔════╝░
 *   ██╔██╗██║██║░░██║██║░░██║██████╦╝██╔████╔██║██║░░╚═╝██████╦╝██║░░██╗░
 *   ██║╚████║██║░░██║██║░░██║██╔══██╗██║╚██╔╝██║██║░░██╗██╔══██╗██║░░╚██╗
 *   ██║░╚███║╚█████╔╝╚█████╔╝██████╦╝██║░╚═╝░██║╚█████╔╝██████╦╝╚██████╔╝
 *   ╚═╝░░╚══╝░╚════╝░░╚════╝░╚═════╝░╚═╝░░░░░╚═╝░╚════╝░╚═════╝░░╚═════╝░
 *
 *               Copyright (C) 2021-2022 NoobMCBG
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *              (at your option) any later version.
 *
 */

declare(strict_types=1);

namespace NoobMCBG\RandomNumber\commands;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use NoobMCBG\RandomNumber\RandomNumber;
use NoobMCBG\RandomNumber\Forms;

class RandomNumberCommands extends Command {

    public function __construct(RandomNumber $plugin) {
        $this->plugin = $plugin;
        parent::__construct("randomnumber", "Generate a random number", \null, ["rb"]);
    }

    public function execute(CommandSender $sender, string $label, array $args){
    	if($this->plugin->getConfig()->get("mode") == "form"){
    		if(!$sender instanceof Player){
                Forms::RandomMenu($sender);
                return true;
    		}
    		$sender->sendMessage("Please use form mode in-game");
    	}else{
    		if(isset($args[0])){
    	        if(isset($args[1])){
    	        	if(!is_numeric($args[0])){
                        $sender->sendMessage("§cPlease enter the number");
                        return true;
                    }
                    if(!is_numeric($args[1])){
                        $sender->sendMessage("§cPlease enter the number");
                        return true;
                    }
    	    	    $min = (int)$args[0];
                    $max = (int)$args[1];
                    $sender->sendMessage(str_replace(["{line}", "{player}", "{number}"], ["\n", $sender->getName(), mt_rand($min, $max)], strval($this->plugin->getConfig()->get("msg-generate"))));
                }else{
                	$sender->sendMessage("§cUsage: §7/randomnumber <min> <max>");
                }
    	    }else{
    	    	$sender->sendMessage("§cUsage: §7/randomnumber <min> <max>");
    	    }
    	}
    }
}