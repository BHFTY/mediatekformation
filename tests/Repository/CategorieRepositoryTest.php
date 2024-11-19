<?php
namespace App\Tests\Repository;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of CategorieRepositoryTest
 *
 * @author cohen
 */
class CategorieRepositoryTest  extends KernelTestCase{
    public function recupRepository(): CategorieRepository {
        self::bootKernel();
        $repository = self::getContainer()->get(CategorieRepository::class);
        return $repository;
    }
    public function testNbCategories() {
        $repository = $this->recupRepository();
        $nbCategories = $repository->count([]);
        $this->assertEquals(10, $nbCategories);
    }
    public function newCategorie(): Categorie {
        $categorie = (new Categorie())
                ->setName("CategorieTest");
        return $categorie;
    }
    public function testAddCategorie() {
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $nbCategories = $repository->count([]);
        $repository->add($categorie, true);
        $this->assertEquals($nbCategories + 1, $repository->count([]), "erreur lors de l'ajout");
    }
    public function testRemoveCategorie() {
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $repository->add($categorie, true);
        $nbCategories = $repository->count([]);
        $repository->remove($categorie, true);
        $this->assertEquals($nbCategories - 1, $repository->count([]), "erreur lors de la suppression");
    }
    public function testFindAllForOnePlaylist() {
        $repository = $this->recupRepository();
        // Test avec une playlist spécifique
        $idPlaylist = 1;
        $categories = $repository->findAllForOnePlaylist($idPlaylist);
        foreach ($categories as $categorie) {
            $this->assertTrue(in_array($idPlaylist, $categorie->getFormations()->map(function ($formation) {
                                return $formation->getPlaylist()->getId();
                            })->toArray()));
        }
        // Test avec une playlist qui n'existe pas
        $idPlaylist = 9999;
        $categories = $repository->findAllForOnePlaylist($idPlaylist);
        $this->assertCount(0, $categories);
    }
}
