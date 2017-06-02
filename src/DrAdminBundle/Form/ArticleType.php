<?php

namespace DrAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $d = getDate();
        $now = time();
        $date = date('d-m-Y h:i', $d[0]);

        $builder
            ->add('publishState', EntityType::class , array(
                'class'        => 'DrAdminBundle:PublishState',
                'choice_label' => 'name',
            ))
            ->add('title')
            ->add('subtitle')
            ->add('content', TextareaType::class , array(
                'attr' => array(
                    'class'      => 'tinymce',
                    'data-theme' => 'bbcode'),
            ))
            ->add('categories', EntityType::class, array(
                'class'        => 'DrAdminBundle:Category',
                'choice_label' => 'name',
                'multiple'     => true,
            ))
            ->add('images', EntityType::class, array(
                'class'        => 'DrAdminBundle:Image',
                'choice_label' => 'alt',
                'multiple'     => true,
            ))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DrAdminBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dradminbundle_article';
    }
}

/*
            add('createdAt', DateTimeType::class, array(
                'widget'    => 'single_text',
                'attr'      => array(
                    'class' => 'time-picker',
                    'value' => $date,
                )
            ))->
            add('updatedAt', DateTimeType::class, array(
                'widget'    => 'single_text',
                'attr'      => array(
                    'class' => 'time-picker',
                    'value' => date('d-m-Y H:i', $now)
                )
            ))->
 */
