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
    public function recupRepository(): PlaylistRepository {
        self::bootKernel();
        $repository = self::getContainer()->get(PlaylistRepository::class);
        return $repository;
    }
    public function testNbPlaylists() {
        $repository = $this->recupRepository();
        $nbPlaylists = $repository->count([]);
        $this->assertEquals(26, $nbPlaylists);
    }
    public function newPlaylist(): Playlist {
        $playlist = (new Playlist())
                ->setName("PlaylistTest");
        return $playlist;
    }
    public function testAddPlaylist() {
        $repository = $this->recupRepository();
        $playlist = $this->newPlaylist();
        $nbPlaylists = $repository->count([]);
        $repository->add($playlist, true);
        $this->assertEquals($nbPlaylists + 1, $repository->count([]), "erreur lors de l'ajout");
    }
    public function testRemovePlaylist() {
        $repository = $this->recupRepository();
        $playlist = $this->newPlaylist();
        $repository->add($playlist, true);
        $nbPlaylists = $repository->count([]);
        $repository->remove($playlist, true);
        $this->assertEquals($nbPlaylists - 1, $repository->count([]), "erreur lors de la suppression");
    }
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
