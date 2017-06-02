<?php

namespace DrAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CvController extends Controller
{
    public function indexAction()
    {
        $tools = $this->formatData($this->getData('Tool'));
        $infos = $this->getData('Info');

        return $this->render('DrAdminBundle:cv:index.html.twig', array(
            'skills'      => $this->getData('Skill'),
            'tools'       => $tools,
            'technologys' => $this->getData('Technology'),
            'infos'       => $infos[0],
        ));
    }

    /**
     * getData 
     * 
     * @param EntityName: 'Tool', 'Skill', 'Technology'
     * @access private
     * @return void
     */
    private function getData($entity)
    {
        return $this->getDoctrine()
                    ->getManager()
                    ->getRepository('DrAdminBundle:'.$entity)
                    ->findAll();
    }

    /**
     * formatData 
     * 
     * @param Data: Array of Object
     * @access private
     * @return void
     */
    private function formatData($params)
    {
        $format = '';

        for ($i = 0 ; $i < count($params) ; $i++)
        {
            $format .= $params[$i]->getName().', ';
        }

        //return $params;
        return substr($format,0 ,-2);
    }
}
