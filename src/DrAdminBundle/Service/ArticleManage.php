<?php

namespace DrAdminBundle\Service;


class ArticleManage
{
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function unpublishArticles()
    {
        $articles = $this->em->getRepository('DrAdminBundle:Article')->findAll();

        foreach ($articles as $article){
            $article->setStatus(false);
            $this->em->flush();
        }
    }
}