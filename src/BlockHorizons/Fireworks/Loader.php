<?php

declare(strict_types = 1);

namespace BlockHorizons\Fireworks;

use BlockHorizons\Fireworks\entity\FireworksRocket;
use BlockHorizons\Fireworks\item\Fireworks;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\item\VanillaItems;
use pocketmine\item\StringToItemParser;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;
use pocketmine\network\mcpe\convert\TypeConverter;

class Loader extends PluginBase
{

	public function onEnable(): void
	{
		VanillaItems::register(new Fireworks(new ItemIdentifier(ItemTypeIds::FIREWORKS, 0), "Fireworks"), true);
		EntityFactory::getInstance()->register(FireworksRocket::class, static function (World $world, CompoundTag $nbt, TypeConverter $typeConverter): FireworksRocket {
			return new FireworksRocket(EntityDataHelper::parseLocation($nbt, $world), StringToItemParser::getInstance()->parse(ItemTypeIds::FIREWORKS));
		}, ["FireworksRocket", EntityIds::FIREWORKS_ROCKET], EntityLegacyIds::FIREWORKS_ROCKET);
	}
}
