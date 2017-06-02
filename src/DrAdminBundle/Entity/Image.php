<?php

namespace DrAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="DrAdminBundle\Repository\ImageRepository")
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * articles 
     * 
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="images")
     * @ORM\JoinTable(name="article_image")
     */
    private $articles;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set articles
     *
     * @param \DrAdminBundle\Entity\Article $articles
     *
     * @return Image
     */
    public function setArticles(\DrAdminBundle\Entity\Article $articles = null)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * Get articles
     *
     * @return \DrAdminBundle\Entity\Article
     */
    public function getArticles()
    {
        return $this->articles;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add article
     *
     * @param \DrAdminBundle\Entity\Article $article
     *
     * @return Image
     */
    public function addArticle(\DrAdminBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \DrAdminBundle\Entity\Article $article
     */
    public function removeArticle(\DrAdminBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    public function __toString()
    {
        return $this->alt;
    }

}
