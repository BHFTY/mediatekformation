<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of FormationsControllerTest
 *
 * @author cohen
 */
class FormationsControllerTest extends WebTestCase{
   public function testSort() {
        $client = static::createClient();
        // Testez la méthode sort avec le champ 'title' et l'ordre 'ASC'
        $crawler = $client->request('GET', '/formations/tri/title/ASC');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri ascendant
        $this->assertSelectorTextContains('h5', 'Eclipse n°7 : Tests unitaires');
        // Testez la méthode sort avec le champ 'title' et l'ordre 'DESC'
        $crawler = $client->request('GET', '/formations/tri/title/DESC');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri descendant
        $this->assertSelectorTextContains('h5', 'test 2');
        // Testez la méthode sort avec le champ 'playlist' et l'ordre 'ASC'
        $crawler = $client->request('GET', '/formations/tri/playlist/ASC');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri ascendant
        $this->assertSelectorTextContains('h5', 'Eclipse n°8 : Déploiement');
        // Testez la méthode sort avec le champ 'playlist' et l'ordre 'DESC'
        $crawler = $client->request('GET', '/formations/tri/playlist/DESC');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri descendant
        $this->assertSelectorTextContains('h5', 'test 2');
        // Testez la méthode sort avec le champ 'publishedAt' et l'ordre 'ASC'
        $crawler = $client->request('GET', '/formations/tri/publishedAt/ASC');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri ascendant
        $this->assertSelectorTextContains('h5', 'Eclipse n°7 : Tests unitaire');
        // Testez la méthode sort avec le champ 'publishedAt' et l'ordre 'DESC'
        $crawler = $client->request('GET', '/formations/tri/publishedAt/DESC');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri descendant
        $this->assertSelectorTextContains('h5', 'test 1');
    }
    public function testFindAllContain() {
        $client = static::createClient();
        $crawler = $client->request('POST', '/formations/recherche/title', ['recherche' => 'Eclipse n°7 : Tests unitaires']);
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri ascendant
        $this->assertSelectorTextContains('h5', 'Eclipse n°7 : Tests unitaires');
        $this->assertCount(1, $crawler->filter('h5'));
        $crawler = $client->request('POST', '/formations/recherche/name/playlist', ['recherche' => 'Cours Curseurs']);
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri ascendant
        $this->assertSelectorTextContains('h5', 'test 1');
        $this->assertCount(1, $crawler->filter('h5'));
        $crawler = $client->request('POST', '/formations/recherche/id/categories', ['recherche' => '4']);
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri ascendant
        $this->assertSelectorTextContains('h5', 'test 1');
    }
    public function testShowOne() {
        $client = static::createClient();
        // Utilisez un id de formation valide
        $id = 1;
        // Accédez à la page de la formation
        $crawler = $client->request('GET', "/formations/formation/$id");
        // Vérifiez que vous êtes bien redirigé vers la bonne page
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre de la formation est correct
        $this->assertSelectorTextContains('h4.text-info', 'Eclipse n°8 : Déploiement');
    }
}
