<?php

include "vendor/autoload.php";


use FlixTech\SchemaRegistryApi\Registry\Cache\AvroObjectCacheAdapter;
use FlixTech\SchemaRegistryApi\Registry\CachedRegistry;
use FlixTech\SchemaRegistryApi\Registry\PromisingRegistry;
use FlixTech\AvroSerializer\Objects\RecordSerializer;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

$schemaRegistryClient = new CachedRegistry(
    new PromisingRegistry(
        new Client([
        	'base_uri' => 'http://stage-kafka1.nike.sk:8081',
			'timeout' => 10.0,
			'cookie' => true,        	
			'verify' => false, 
			'proxy' => ''
        ])
    ),
    new AvroObjectCacheAdapter()
);



/** @var \FlixTech\SchemaRegistryApi\Registry $schemaRegistry */
$recordSerializer = new RecordSerializer(
    $schemaRegistryClient,
    [
        // If you want to auto-register missing schemas set this to true
        RecordSerializer::OPTION_REGISTER_MISSING_SCHEMAS => false,
        // If you want to auto-register missing subjects set this to true
        RecordSerializer::OPTION_REGISTER_MISSING_SUBJECTS => false,
    ]
);


/** @var \FlixTech\AvroSerializer\Objects\RecordSerializer $recordSerializer */
$subject = 'sk.nike.tpd.avro.v1.BetTranslation';
$avroSchema = AvroSchema::parse('{"type":"record","name":"BetTranslation","namespace":"sk.nike.tpd.avro.v1","doc":"Vid: http://gitlab.nike.sk/team-s/docs/wikis/domain/platforma/entity","fields":[{"name":"sequence","type":"int"},{"name":"sportId","type":"long"},{"name":"countryId","type":"long"},{"name":"tournamentId","type":"long"},{"name":"matchId","type":"long"},{"name":"marketId","type":"long"},{"name":"betId","type":"long"},{"name":"primary","type":"boolean"},{"name":"infoNo","type":"int"},{"name":"game","type":{"type":"enum","name":"GameType","symbols":["Prematch","Live","VirtualOnline","VirtualOffline"]}},{"name":"matchDate","type":{"type":"int","logicalType":"date"}},{"name":"betHeader","type":{"type":"record","name":"LocalizedText","fields":[{"name":"sk","type":"string","default":""},{"name":"en","type":"string","default":""},{"name":"hu","type":"string","default":""}]}},{"name":"betHeaderDetail","type":"LocalizedText"},{"name":"betNote","type":["null","LocalizedText"]},{"name":"betName","type":["null","LocalizedText"]},{"name":"selections","type":{"type":"array","items":{"type":"record","name":"BetTranslationSelection","fields":[{"name":"code","type":"int"},{"name":"name","type":"LocalizedText"}]}}},{"name":"order","type":"int"},{"name":"participants","type":{"type":"array","items":"LocalizedText"}},{"name":"matchHeaderTexts","type":{"type":"array","items":"LocalizedText"}},{"name":"modified","type":{"type":"long","logicalType":"timestamp-millis"},"default":0}]}
');
$record = [
				'sequence' => 234754964,
				'sportId' => 1,
				'countryId' => 61,
				'tournamentId' => 5824,
				'matchId' => 33801497,
				'marketId' => 526,
				'betId' => 1554523496,
				'primary' => true,
				'infoNo' => 534054,
				'game' => 'Live',
				'matchDate' => 18544,
				'betHeader' => [
					'sk' => 'Zápas - Výsledok',
					'en' => 'Match - Result',
					'hu' => 'A mérkőzés végeredménye',
				],
				'betHeaderDetail' => [
					'sk' => 'Zápas - Výsledok',
					'en' => 'Match - Result',
					'hu' => 'A mérkőzés végeredménye',
				],
				'betNote' => NULL,
				'betName' => NULL,
				'selections' => [
					0 => [
						'code' => 49,
						'name' => [
							'sk' => 'Xinjiang TL',
							'en' => 'X. T. Leopard',
							'hu' => 'Xinjiang TL',
						],
					],
					1 => [
						'code' => 88,
						'name' => [
							'sk' => 'remíza',
							'en' => 'draw',
							'hu' => 'Döntetlen',
						],
					],
					2 => [
						'code' => 50,
						'name' => [
							'sk' => 'Sichuan Jiuniu',
							'en' => 'Sichuan Jiuniu',
							'hu' => 'Sichuan Jiuniu',
						],
					],
				],
				'order' => 0,
				'participants' => [
					0 => [
						'sk' => 'Xinjiang TL',
						'en' => 'X. T. Leopard',
						'hu' => 'Xinjiang TL',
					],
					1 => [
						'sk' => 'Sichuan Jiuniu',
						'en' => 'Sichuan Jiuniu',
						'hu' => 'Sichuan Jiuniu',
					],
				],
				'matchHeaderTexts' => [
					0 => [
						'sk' => 'Xinjiang TL',
						'en' => 'X. T. Leopard',
						'hu' => 'Xinjiang TL',
					],
					1 => [
						'sk' => 'Sichuan Jiuniu',
						'en' => 'Sichuan Jiuniu',
						'hu' => 'Sichuan Jiuniu',
					],
				],
				'modified' => 0,
			];

$encodedBinaryAvro = $recordSerializer->encodeRecord($subject, $avroSchema, $record);
// Send this over the wire...

var_dump($encodedBinaryAvro);
