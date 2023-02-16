<?php
    
namespace matheuss\NexusMap;

use pocketmine\world\generator\Generator;
use pocketmine\world\ChunkManager;
use pocketmine\world\format\Chunk;
use pocketmine\block\VanillaBlocks;    

class MapGenerator extends Generator {
    
    /**
     * @Param ChunkManager $world
     * @Param int          $chunkX
     * @Param int          $chunkZ
     *
     * @return void
     */
    public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void {
        $chunk = $world->getChunk($chunkX, $chunkZ);
        
        for($z = 0; $z < 16; ++$z) {
            for($x = 0; $x < 16; ++$x) {
                $chunk->setFullBlock($x, 0, $z, VanillaBlocks::BEDROCK()->getFullId());
                
                if(in_array($z * 16 + $x, $this->map)) {
                    $chunk->setFullBlock($x, 1, $z, VanillaBlocks::BEDROCK()->getFullId());
                } else {
                    $chunk->setFullBlock($x, 1, $z, VanillaBlocks::OBSIDIAN()->getFullId());
                }
            }
        }
        
        $world->setChunk($chunkX, $chunkZ, $chunk);
    }
    
    /**
     * @Param ChunkManager $world
     * @Param int          $chunkX
     * @Param int          $chunkZ
     *
     * @return void
     */
    public function populateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void {}
    
    
    /** generate by matheus s */
    public array $map = [
        0, 1, 2, 3, 4,  5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 31, 32, 34, 36, 37, 39, 40, 42, 43, 45, 47, 48, 51, 54, 57, 60, 63, 64, 66, 68, 70, 73, 75, 77, 79, 80, 82, 85, 87, 88, 90, 93, 95, 96, 99, 100, 107, 108, 111, 112, 114, 117, 119, 120, 122, 125, 127, 128, 130, 133, 135, 136, 138, 141, 143, 144, 147, 148, 155, 156, 159, 160, 162, 165, 167, 168, 170, 173, 175, 176, 178, 180, 182, 185, 187, 189, 191, 192, 195, 198, 201, 204, 207, 208, 210, 212, 213, 215, 216, 218, 219, 221, 223, 224, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255
    ];
}
