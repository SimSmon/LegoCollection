<?php

namespace App\Controller;

use App\Entity\Lego;
use App\Form\LegoType;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\LegoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/lego')]
class LegoController extends AbstractController
{

    /**
     * @var Security
     */
    private $security;
    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/', name: 'app_lego_index', methods: ['POST','GET'])]
    public function index(LegoRepository $legoRepository, PaginatorInterface $paginator, Request $request): Response
    {        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchData = new SearchData();

        $form = $this->createForm(SearchType::class, $searchData, ['dataseach' => $searchData->searchField]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $searchData->page = $request->query->getInt('page', 1);
            $legos = $legoRepository->findBySearch($searchData, $request->query->getInt('page', 1));

            return $this->render('lego/index.html.twig', [
                'form' => $form->createView(),
                'legos' => $paginator->paginate(
                    $legos,
                    $request->query->getInt('page', 1),
                    20
                ),
            ]);
        }

        return $this->render('lego/index.html.twig', [
            'form' => $form->createView(),
            'legos' => $paginator->paginate(
                $legoRepository->findAll(),
                $request->query->getInt('page', 1),
                20
            ),
        ]);
    }

    #[Route('/pocess', name: 'app_lego_pocess', methods: ['POST','GET'])]
    public function pocess(LegoRepository $legoRepository, PaginatorInterface $paginator, Request $request): Response
    {
        return $this->render('lego/pocess.html.twig', [
        ]);
    }

    #[Route('/new', name: 'app_lego_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LegoRepository $legoRepository): Response
    {
        $lego = new Lego();
        $form = $this->createForm(LegoType::class, $lego);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($form["test"]->getData() == true){
                $lego->addUser($this->security->getUser());
            }

            $legoRepository->save($lego, true);

            return $this->redirectToRoute('app_lego_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lego/new.html.twig', [
            'lego' => $lego,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lego_show', methods: ['GET'])]
    public function show(Lego $lego): Response
    {
        return $this->render('lego/show.html.twig', [
            'lego' => $lego,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lego_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lego $lego, LegoRepository $legoRepository): Response
    {
        $user = $this->security->getUser();

        $val = false;
        if(in_array($user, $lego->getUser()->toArray()))
        {
            $val = true;
        }
        
        
        $form = $this->createForm(LegoType::class, $lego, ['isChecked' => $val]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if($form["test"]->getData() == true){
                $lego->addUser($user);
            } else {
                $lego->removeUser($user);
            }

            $legoRepository->save($lego, true);

            return $this->redirectToRoute('app_lego_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lego/edit.html.twig', [
            'lego' => $lego,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lego_delete', methods: ['POST'])]
    public function delete(Request $request, Lego $lego, LegoRepository $legoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lego->getId(), $request->request->get('_token'))) {
            $legoRepository->remove($lego, true);
        }

        return $this->redirectToRoute('app_lego_index', [], Response::HTTP_SEE_OTHER);
    }
}
