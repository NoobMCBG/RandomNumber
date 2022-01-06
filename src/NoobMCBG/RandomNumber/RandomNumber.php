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

namespace NoobMCBG\RandomNumber;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use NoobMCBG\RandomNumber\commands\RandomNumberCommands;

class RandomNumber extends PluginBase implements Listener {
    
    /* @var RandomNumber */
    public static $instance;

    public static function getInstance() : self {
        return self::$instance;
    }

    public function onEnable() : void {
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
	$this->saveDefaultConfig();
	$this->getServer()->getCommandMap()->register("RandomNumber", new RandomNumberCommands($this));
        self::$instance = $this;
    }
}
