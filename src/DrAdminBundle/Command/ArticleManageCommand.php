<?php

namespace DrAdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ArticleManageCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('articles:unpublish')
            ->setDescription('Dépublie tous les articles');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Dépublication de tous les articles',
            '==================================',
            '',
        ]);
        $articleManage = $this->getContainer()->get('article_manage');
        $articleManage->unpublishArticles();
        $output->writeln('Tous les articles ont été dépublié');
    }
}