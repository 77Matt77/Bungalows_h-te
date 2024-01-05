<?php
namespace App\Controller\Vers\Accueil;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'vers_accueil_index', methods: ['GET'])]
    public function index(): Response
    {
        $bungalows = [
            [
                'id' => 1,
                'title' => 'Bungalow<br>Moorea',
                'image' => 'bungalow1.jpg',
                'description' => "Idéal pour une escapade en famille ou entre amis, le bungalow Maurea offre un confort spacieux pour accueillir jusqu'à 4 personnes, que ce soient des adultes ou des enfants. Profitez d'un séjour relaxant dans ce havre de paix.",
                'bedrooms' => " 4<br>Chambre 1: lit double 160 x 200, armoire, coffre intégré dans l’armoire.<br>Chambre 2: lit super poser 90 x 190, avec armoire ",
                'equipments' => 'Entrée et séjour:<br>canapée en rotin, 2 x fauteuils en rotin, une porte donnant vue sur le lagon avec une petite échelle <br><br> Cuisine équipée et meublée:<br> Une table avec quatre chaises, plan de travail, un évier, une poubelle un réfrigérateur, une hotte aspirante, des plaques de cuisson, un four à micro-ondes, une cafetière, balai avec pelle, sceau avec serpillère, aspirateur<br><br> WC : 1 WC<br><br>Salle de bains : Une douche, lavabo, lave-linge, miroir. ',
                'price' => 85,
            ],
            [
                'id' => 2,
                'title' => 'Bungalow<br>Bora-Bora',
                'image'=> 'bungalow2.jpg',
                'description' => "Le romantisme s'épanouit dans notre bungalow Bora-Bora, conçu pour offrir une intimité parfaite aux couples. Avec des installations modernes et une atmosphère paisible, c'est l'endroit idéal pour la relaxation et le romantisme.",
                'bedrooms' => " 1<br>Chambre 1: lit king-size 180 x 200, armoire, coffre intégré dans l’armoire,",
                'equipments' => 'Entrée et séjour:<br>canapée en rotin, 2 x fauteuils en rotin, une porte donnant vue sur le lagon avec une petite échelle <br><br> Cuisine équipée et meublée:<br> Une table avec quatre chaises, plan de travail, un évier, une poubelle un réfrigérateur, une hotte aspirante, des plaques de cuisson, un four à micro-ondes, une cafetière, balai avec pelle, sceau avec serpillère, aspirateur<br><br> WC : 1 WC<br><br>Salle de bains : baignoire balnéo, lavabo, lave-linge, miroir.',
                'price' => 75,
            ],
            [
                'id' => 3,
                'title' => 'Bungalow<br>Mautipi',
                'image'=> 'bungalow3.jpg',
                'description' => "Avec suffisamment d'espace pour toute la famille ou un groupe d'amis, le bungalow Mautipi est l'option idéale pour accueillir jusqu'à 6 personnes. Profitez d'un séjour relaxant dans l'intimité et du confort en famille ou entre amis",
                'bedrooms' => "3<br>Chambre 1 : lit double 140 x 200, armoire, coffre intégré dans l’armoire,<br>Chambre 2 : 2 lits séparés 90 x 190, armoire <br>Chambre 3: 2 lits séparés 90 x 190, armoire ",
                'equipments' => 'Entrée et séjour :<br>canapée en rotin, 4 fauteuils en rotin, une porte donnant vue sur le lagon avec une petite échelle <br><br> Cuisine équipée et meublée:<br> Une table avec six chaises, plan de travail, un évier, une poubelle un réfrigérateur, une hotte aspirante, des plaques de cuisson, un four à micro-ondes, une cafetière, balai avec pelle, sceau avec serpillère, aspirateur<br><br> WC : 2 WC séparées ',
                'price' => 100,
            ],
            [
                'id' => 4,
                'title' => 'Bungalow<br>Rangiroa',
                'image'=>'bungalow4.jpg',
                'description' => "Le bungalow Rangiora combine élégance et fonctionnalité pour accueillir jusqu'à 4 personnes, offrant un espace chaleureux pour les familles ou les amis. Détendez-vous et profitez de votre séjour dans ce coin de paradis.", 
                'bedrooms' => "4<br>Chambre 1: lit double 160 x 200, armoire, coffre intégré dans l’armoire.<br>Chambre 2: lit super poser 90 x 190, avec armoire ",
                'equipments' => 'Entrée et séjour :<br>canapée en rotin, 2 x fauteuils en rotin, une porte donnant vue sur le lagon avec une petite échelle <br><br> Cuisine équipée et meublée:<br> Une table avec quatre chaises, plan de travail, un évier, une poubelle un réfrigérateur, une hotte aspirante, des plaques de cuisson, un four à micro-ondes, une cafetière, balai avec pelle, sceau avec serpillère, aspirateur<br><br> WC : 1 WC<br><br>Salle de bains : Une douche, lavabo, lave-linge, miroir.  ',
                'price' => 85,
            ],
            [
                'id' => 5,
                'title' => 'Bungalow<br>Fakarava',
                'image'=>'bungalow5.jpg',
                'description' => "Le bungalow Fakarava offre un espace généreux pour accueillir jusqu'à 6 personnes, idéal pour les groupes ou les familles. Plongez dans la tranquillité de l'île tout en profitant des installations modernes et du charme naturel.",
                'bedrooms' => "3<br>Chambre 1 : lit double 140 x 200, armoire, coffre intégré dans l’armoire,<br>Chambre 2 : 2 lits séparés 90 x 190, armoire <br>Chambre 3: 2 lits séparés 90 x 190, armoire ",
                'equipments' => 'Entrée et séjour :<br>canapée en rotin, 4 fauteuils en rotin, une porte donnant vue sur le lagon avec une petite échelle <br><br> Cuisine équipée et meublée:<br> Une table avec six chaises, plan de travail, un évier, une poubelle un réfrigérateur, une hotte aspirante, des plaques de cuisson, un four à micro-ondes, une cafetière, balai avec pelle, sceau avec serpillère, aspirateur<br><br> WC : 2 WC séparées ',
                'price' => 100,
            ],
            [
                'id' => 6,
                'title' => 'bungalow<br>Tahiti',
                'bungalow<br>Tahiti',
                'image'=>'bungalow6.jpg',
                'description' => "Découvrez le confort tropical du bungalow Tahiti, conçu pour accueillir jusqu'à 4 personnes. L'alliance parfaite entre élégance et convivialité, cet hébergement vous offre une expérience magnifique dans ce coin de paradis.",
                'bedrooms'=>" 4<br>Chambre 1: lit double 160 x 200, armoire, coffre intégré dans l’armoire.<br>Chambre 2: lit super poser 90 x 190, avec armoire ",
                'equipments' => 'Entrée et séjour :<br>canapée en rotin, 2 x fauteuils en rotin, une porte donnant vue sur le lagon avec une petite échelle <br><br> Cuisine équipée et meublée:<br> Une table avec quatre chaises, plan de travail, un évier, une poubelle un réfrigérateur, une hotte aspirante, des plaques de cuisson, un four à micro-ondes, une cafetière, balai avec pelle, sceau avec serpillère, aspirateur<br><br> WC : 1 WC<br><br>Salle de bains : Une douche, lavabo, lave-linge, miroir.  ',
                'price' => 85,
            ],

            
        ];

        return $this->render('vers/accueil/index.html.twig', [
            'bungalows' => $bungalows,
        ]);
    }
}
