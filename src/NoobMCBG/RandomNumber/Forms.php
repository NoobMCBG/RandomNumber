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

use pocketmine\player\Player;
use NoobMCBG\RandomNumber\RandomNumber;
use NoobMCBG\RandomNumber\libs\jojoe77777\FormAPI\CustomForm;

class Forms {

    public static function RandomMenu($player){
        $form = new CustomForm(function(Player $player, $data){
            if($data[1] == null or $data[2] == null){
                $player->sendMessage("You are not allowed to leave this blank");
                return true;
            }
            if(!is_numeric($data[1])){
                $player->sendMessage("Please enter the number in the input min");
                return true;
            }
            if(!is_numeric($data[2])){
                $player->sendMessage("Please enter the number in the input max");
                return true;
            }
            if($data[2] > $data[1]){
                $min = (int)$data[1];
                $max = (int)$data[2];
                $player->sendMessage(str_replace(["{line}", "{player}", "{number}"], ["\n", $player->getName(), mt_rand($min, $max)], strval(RandomNumber::getInstance()->getConfig()->get("msg-generate"))));
            }else{
                $player->sendMessage("§cThe max number cannot be less than $data[1]");
            }
        });
        $form->setTitle("RandomNumber");
        $form->addLabel("Input The Number:");
        $form->addInput("Min Number:", "1");
        $form->addInput("Max Number:", "100");
        $form->sendToPlayer($player);
    }
}
