<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of PlaylistsControllerTest
 *
 * @author cohen
 */
class PlaylistsControllerTest extends WebTestCase{
    public function testSort() {
        $client = static::createClient();
        // Test de tri par nom
        $crawler = $client->request('GET', '/playlists/tri/name/asc');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le nom attendu est bien celui de la première playlist après le tri ascendant
        $this->assertSelectorTextContains('h5', 'Bases de la programmation (C#)');
        $crawler = $client->request('GET', '/playlists/tri/name/desc');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le nom attendu est bien celui de la première playlist après le tri descendant
        $this->assertSelectorTextContains('h5', 'Visual Studio 2019 et C#');
        // Test de tri par nombre de formations
        $crawler = $client->request('GET', '/playlists/tri/numberOfFormations/asc');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le nombre attendu de formations est bien celui de la première playlist après le tri ascendant
        $this->assertSelectorTextContains('h5', 'Visual Studio 2019 et C#');
        $crawler = $client->request('GET', '/playlists/tri/numberOfFormations/desc');
        $this->assertResponseIsSuccessful();
        // Vérifiez que le nombre attendu de formations est bien celui de la première playlist après le tri descendant
        $this->assertSelectorTextContains('h5', 'Eclipse et Java');
    }
    
    public function testFindAllContain(){
        $client = static::createClient();
        $crawler = $client->request('POST', '/playlists/recherche/name', ['recherche' => 'Cours Triggers']);
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri ascendant
        $this->assertSelectorTextContains('h5', 'Cours Triggers');
        $this->assertCount(1, $crawler->filter('h5'));
        
        $crawler = $client->request('POST', '/playlists/recherche/id/categories', ['recherche' => '1']);
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre attendu est bien celui de la première formation après le tri ascendant
        $this->assertSelectorTextContains('h5', 'Eclipse et Java');
        $this->assertCount(1, $crawler->filter('h5'));
    }
    
    public function testShowOne() {
        $client = static::createClient();
        // Utilisez un id de playlist valide
        $id = 1;
        // Accédez à la page de la formation
        $crawler = $client->request('GET', "/playlists/playlist/$id");
        // Vérifiez que vous êtes bien redirigé vers la bonne page
        $this->assertResponseIsSuccessful();
        // Vérifiez que le titre de la formation est correct
        $this->assertSelectorTextContains('h4.text-info', 'Eclipse et Java');
    }
}
