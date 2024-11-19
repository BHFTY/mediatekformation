<?php
namespace App\Tests;

use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

/**
 * Description of FormationTest
 *
 * @author cohen
 */
class FormationTest  extends TestCase{
   public function testGetPublishedAtString(){
        $formation = new Formation();
        $formation->setPublishedAt(new \DateTime("2024-01-04 17:00:12"));
        $this->assertEquals("04/01/2024", $formation->getPublishedAtString());
    }
}
