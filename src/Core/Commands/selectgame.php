<?php
/**
 * Created by PhpStorm.
 * User: InkoHX
 * Date: 2018/07/21
 * Time: 10:43
 */

namespace Core\Commands;

use Core\Main;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class selectgame extends PluginCommand
{
    protected $plugin;
    public function __construct(Main $plugin)
    {
        parent::__construct("selectgame", $plugin);
        $this->setPermission("vector.network.player");
        $this->setDescription("遊びたいゲームを選択できます。");
        $this->plugin = $plugin;
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->plugin->isEnabled()) {
            return false;
        }
        if (!$this->testPermission($sender)) {
            return false;
        }
        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED."このコマンドはプレイヤーのみが実行できます。");
            return true;
        }
		$gamesmenu = [
			"type" => "form",
			"title" => "ゲーム選択",
			"content" => "遊びたいゲームを選択して下さい",
			"buttons" => [
				[
					"text" => "§eロビー"
				],
				[
					"text" => "§6FFA§cPvP"
				],
				[
					"text" => "§bSpeed§aCore§cPvP"
				],
				[
					"text" => "§dAthletic"
				],
				[
					"text" => "§aSurvival"
				]
			]
		];
        $modal = new ModalFormRequestPacket();
        $modal->formId = 45786154;
        $modal->formData = json_encode($gamesmenu);
        $sender->sendDataPacket($modal);
        return true;
    }
}
