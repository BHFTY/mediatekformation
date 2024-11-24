<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of accueilControllertest
 *
 * @author cohen
 */
class accueilControllertest extends WebTestCase{
    /**
     * test l'accès à la page d'accueil
     */
    public function testAccesPage(){
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
