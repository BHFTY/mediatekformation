<?php

namespace App\Tests\Repository;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of UserRepositoryTest
 *
 * @author cohen
 */
class UserRepositoryTest extends KernelTestCase{
    /**
     * 
     * @return UserRepository
     */
   public function recupRepository(): UserRepository {
        self::bootKernel();
        $repository = self::getContainer()->get(UserRepository::class);
        return $repository;
    }
    
    /**
     * Teste le nombre d'utilisateur
     */
    public function testNbUsers() {
        $repository = $this->recupRepository();
        $nbUsers = $repository->count([]);
        $this->assertEquals(1, $nbUsers);
    }
    
    /**
     * Créer un utilisateur
     * @return User
     */
    public function newUser(): User {
        $user = (new User())
                ->setEmail("emailtest@dom.com")
                ->setPassword("testmdp");
        return $user;
    }
    
    /**
     * Teste l'ajout d'un utilisateur 
     */
    public function testAddUser() {
        $repository = $this->recupRepository();
        $user = $this->newUser();
        $nbUsers = $repository->count([]);
        $repository->add($user, true);
        $this->assertEquals($nbUsers + 1, $repository->count([]), "erreur lors de l'ajout");
    }
    
    /**
     * Teste la suppression d'un utilisateur 
     */
    public function testRemoveUser() {
        $repository = $this->recupRepository();
        $user = $this->newUser();
        $repository->add($user, true);
        $nbUsers = $repository->count([]);
        $repository->remove($user, true);
        $this->assertEquals($nbUsers - 1, $repository->count([]), "erreur lors de la suppression");
    }
    
    /**
     * Teste la modification du mot de passe
     */
    public function testUpgradePassword()
    {
        $repository = $this->recupRepository();
        // Créez un nouvel utilisateur
        $user = new User();
        $user->setEmail("emailtest@dom.com");
        $user->setPassword('old_password');
        // Ajoutez l'utilisateur à la base de données
        $repository->add($user, true);
        // Mettez à jour le mot de passe de l'utilisateur
        $newPassword = 'new_password';
        $repository->upgradePassword($user, $newPassword);
        // Vérifiez que le mot de passe de l'utilisateur a été mis à jour
        $this->assertEquals('new_password', $user->getPassword());
    }
}
