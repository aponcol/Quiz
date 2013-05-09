<?php

namespace VideoGameMusicQuiz\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VideoGameMusicQuizMainBundle:Default:index.html.twig', array('name' => $name));
    }
}
