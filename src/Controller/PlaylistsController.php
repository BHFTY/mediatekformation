<?php
namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaylistsController extends AbstractController
{
    private $playlistRepository;
    private $formationRepository;
    private $categorieRepository;

    private const TEMPLATE_PLAYLISTS = "pages/playlists.html.twig";
    private const TEMPLATE_PLAYLIST = "pages/playlist.html.twig";

    public function __construct(
        PlaylistRepository $playlistRepository,
        CategorieRepository $categorieRepository,
        FormationRepository $formationRepository
    ) {
        $this->playlistRepository = $playlistRepository;
        $this->categorieRepository = $categorieRepository;
        $this->formationRepository = $formationRepository;
    }

    #[Route('/playlists', name: 'playlists')]
    public function index(): Response
    {
        // Récupérer toutes les playlists
        $playlists = $this->playlistRepository->findAllOrderByName('ASC');
        $categories = $this->categorieRepository->findAll();

        // Ajouter le nombre de formations pour chaque playlist
        foreach ($playlists as $playlist) {
            $playlist->formationCount = $this->formationRepository->countByPlaylist($playlist->getId());
        }
        
        return $this->render(self::TEMPLATE_PLAYLISTS, [
            'playlists' => $playlists,
            'categories' => $categories
        ]);
    }

    #[Route('/playlists/tri/{champ}/{ordre}', name: 'playlists.sort')]
    public function sort($champ, $ordre): Response
    {
        if ($champ === "name") {
            $playlists = $this->playlistRepository->findAllOrderByName($ordre);
        } else {
            $playlists = $this->playlistRepository->findAllOrderByName('ASC');
        }
        
        // Ajouter le nombre de formations pour chaque playlist
        foreach ($playlists as $playlist) {
            $playlist->formationCount = $this->formationRepository->countByPlaylist($playlist->getId());
        }

        $categories = $this->categorieRepository->findAll();
        return $this->render(self::TEMPLATE_PLAYLISTS, [
            'playlists' => $playlists,
            'categories' => $categories
        ]);
    }

    #[Route('/playlists/recherche/{champ}/{table}', name: 'playlists.findallcontain')]
    public function findAllContain($champ, Request $request, $table = ""): Response
    {
        $valeur = $request->get("recherche");
        $playlists = $this->playlistRepository->findByContainValue($champ, $valeur, $table);

        // Ajouter le nombre de formations pour chaque playlist
        foreach ($playlists as $playlist) {
            $playlist->formationCount = $this->formationRepository->countByPlaylist($playlist->getId());
        }

        $categories = $this->categorieRepository->findAll();
        return $this->render(self::TEMPLATE_PLAYLISTS, [
            'playlists' => $playlists,
            'categories' => $categories,
            'valeur' => $valeur,
            'table' => $table
        ]);
    }

    #[Route('/playlists/playlist/{id}', name: 'playlists.showone')]
    public function showOne($id): Response
    {
        $playlist = $this->playlistRepository->find($id);
        $playlistCategories = $this->categorieRepository->findAllForOnePlaylist($id);
        $playlistFormations = $this->formationRepository->findAllForOnePlaylist($id);
        
        // Compter le nombre de formations pour la playlist
        $formationCount = $this->formationRepository->countByPlaylist($id);

        return $this->render(self::TEMPLATE_PLAYLIST, [
            'playlist' => $playlist,
            'playlistcategories' => $playlistCategories,
            'playlistformations' => $playlistFormations,
            'formationCount' => $formationCount // Passer le nombre de formations à la vue
        ]);
    }
}
