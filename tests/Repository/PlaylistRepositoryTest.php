<?php
namespace App\Tests\Repository;
use App\Entity\Playlist;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of PlaylistRepositoryTest
 *
 * @author cohen
 */
class PlaylistRepositoryTest extends KernelTestCase{
    /**
     * 
     * @return PlaylistRepository
     */
    public function recupRepository(): PlaylistRepository {
        self::bootKernel();
        $repository = self::getContainer()->get(PlaylistRepository::class);
        return $repository;
    }
    
    /**
     * Teste le nombre de playlists
     */
    public function testNbPlaylists() {
        $repository = $this->recupRepository();
        $nbPlaylists = $repository->count([]);
        $this->assertEquals(26, $nbPlaylists);
    }
    
    /**
     * Créer une playlist 
     * @return Playlist
     */
    public function newPlaylist(): Playlist {
        $playlist = (new Playlist())
                ->setName("PlaylistTest");
        return $playlist;
    }
    
    /**
     * Teste l'ajout d'une playlist
     */
    public function testAddPlaylist() {
        $repository = $this->recupRepository();
        $playlist = $this->newPlaylist();
        $nbPlaylists = $repository->count([]);
        $repository->add($playlist, true);
        $this->assertEquals($nbPlaylists + 1, $repository->count([]), "erreur lors de l'ajout");
    }
    
    /**
     * Teste la suppression d'une playlist
     */
    public function testRemovePlaylist() {
        $repository = $this->recupRepository();
        $playlist = $this->newPlaylist();
        $repository->add($playlist, true);
        $nbPlaylists = $repository->count([]);
        $repository->remove($playlist, true);
        $this->assertEquals($nbPlaylists - 1, $repository->count([]), "erreur lors de la suppression");
    }
    
    /**
     * Teste le tri des playlists en fonction de leur nom
     */
    public function testFindAllOrderByName() {
        $repository = $this->recupRepository();
        $playlists = $repository->findAllOrderByName('ASC');
        $previousName = "";
        
        foreach ($playlists as $playlist) {
            if(strcasecmp($previousName, $playlist->getName()) > 0) {
                $this->fail('Les playlists ne sont pas triées par ordre croissant');
            }
            $previousName = $playlist->getName();
        }
        $this->assertTrue(true);
    }
    
    /**
     * Teste le tri des playlists en fonction de leur nombre de formations 
     */
    public function testFindAllOrderByNumberOfFormations() {
        $repository = $this->recupRepository();
        $playlists = $repository->findAllOrderByNumberOfFormations('ASC');
        
        $previousNum = -1;
        foreach ($playlists as $playlist) {
            $currentNum = count($playlist->getFormations());
            if ($previousNum > $currentNum) {
                $this->fail('Les playlists ne sont pas triées par le nombre de formations en ordre croissant');
            }
            $previousNum = $currentNum;
        }
        $this->assertTrue(true);
    }
}
