<?php
namespace App\Tests\Validations;
use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of FormationValidationsTest
 *
 * @author cohen
 */
class FormationValidationsTest extends KernelTestCase{
    public function getFormation(): Formation{
        return (new Formation())
                ->setTitle("FormationTest")
                ->setVideoId("29049780");
    }
    
    public function testValidDateFormation(){
        $formation = $this->getFormation()->setPublishedAt(new \DateTime("2022-04-29 17:00:12"));
        $this->assertErrors($formation, 0 );
    }
    
    public function testNonValidDateFormation(){
        $formation = $this->getFormation()-> setPublishedAt(new \DateTime("2024-11-20 17:00:12"));
        $this->assertErrors($formation, 1);
    }
    
    public function assertErrors(Formation $formation, int $nbErreursAttendues){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($formation);
        $this->assertCount($nbErreursAttendues, $error);
    }
}
