<?php
namespace App\Controller\admin;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Description of AdminCategoriesController
 *
 * @author cohen
 */
class AdminCategoriesController extends AbstractController {
  /**
     * 
     * @var CategorieRepository
     */
    private $categorieRepository;
    /**
     * 
     * @param CategorieRepository $repository
     */
    public function __construct(CategorieRepository $repository) {
        $this->categorieRepository = $repository;
    }
    
    /**
     * @Route("/admin/categories", name="admin.categories")
     * @return Response
     */
    #[Route('/admin/categories', name: 'admin.categories')]
    public function index(): Response{
        $categories = $this->categorieRepository->findAll();
        return $this->render("admin/admin.categories.html.twig", [
            'categories' => $categories
        ]);
    }
    
    /**
     * @Route("/admin/categorie/suppr/{id}", name="admin.categorie.suppr")
     * @param int $id
     * @return Response
     */
    #[Route('/admin/categorie/suppr/{id}', name: 'admin.categorie.suppr')]
    public function suppr(int $id): Response {
        $categorie = $this->categorieRepository->find($id);
        // Vérifiez si la playlist contient des formations
        if (count($categorie->getFormations()) > 0) {
            // Si la playlist contient au moins une formation, affichez un message d'erreur
            $this->addFlash('error', 'La suppression n\'est pas possible car la catégorie est associée à une ou plusieurs formations.');
        } else {
            // Si la playlist est vide, elle peut être supprimée
            $this->categorieRepository->remove($categorie, true);
            $this->addFlash('success', 'La catégorie a été supprimée avec succès.');
        }
        return $this->redirectToRoute('admin.categories');
    }
    
   /**
    * @Route("/admin/categorie/ajout", name="admin.categorie.ajout")
    * @param Request $request
    * @return Response
    */
    #[Route('/admin/categorie/ajout', name: 'admin.categorie.ajout')]
   public function ajout(Request $request): Response{
       $nomCategorie = $request->get("name");
       if(empty($nomCategorie)) {
           $this->addFlash('error', 'Le nom de la catégorie est requis.');
           return $this->redirectToRoute('admin.categories');
       }
       // Vérifiez si une catégorie avec le même nom existe déjà
       $categorieExistante = $this->categorieRepository->findOneBy(['name' => $nomCategorie]);
       if($categorieExistante) {
           $this->addFlash('error', 'Une catégorie avec ce nom existe déjà.');
           return $this->redirectToRoute('admin.categories');
       }
       $categorie = new Categorie();
       $categorie->setName($nomCategorie);
       $this->categorieRepository->add($categorie, true);
       $this->addFlash('success', 'La catégorie a été ajoutée avec succès.');
       return $this->redirectToRoute('admin.categories');       
   }
}
