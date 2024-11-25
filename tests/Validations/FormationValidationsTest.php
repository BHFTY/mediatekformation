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
    
    /**
     * 
     * @return Formation
     */
    public function getFormation(): Formation{
        return (new Formation())
                ->setTitle("FormationTest")
                ->setVideoId("29049780");
    }
    
    /**
     * Teste la validité d'une date correcte
     */
    public function testValidDateFormation(){
        $formation = $this->getFormation()->setPublishedAt(new \DateTime("2022-04-29 17:00:12"));
        $this->assertErrors($formation, 0 );
    }
    
    /**
     * Teste la validité d'une date incorrecte
     */
    public function testNonValidDateFormation(){
        $formation = $this->getFormation()-> setPublishedAt(new \DateTime("2024-11-20 17:00:12"));
        $this->assertErrors($formation, 1);
    }
    
    /**
     * 
     * @param Formation $formation
     * @param int $nbErreursAttendues
     */
    public function assertErrors(Formation $formation, int $nbErreursAttendues){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($formation);
        $this->assertCount($nbErreursAttendues, $error);
    }
}
