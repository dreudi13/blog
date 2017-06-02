<?php

namespace DrAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class ExperienceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $d = getDate();
        $date = date('d-m-Y h:i', $d[0]);

        $builder->add('company')
                ->add('job')
                ->add('detail')
                ->add('startedAt', DateType::class, array(
                    'input'     => 'datetime',
                    'widget'    => 'single_text',
                    'attr'      => array(
                        'class' => 'time-picker',
                        'value' => $date,
                    ),
                ))
                ->add('finishedAt', DateType::class, array(
                    'input'     => 'datetime',
                    'widget'    => 'single_text',
                    'attr'      => array(
                        'class' => 'time-picker',
                        'value' => $date,
                    ),
                ))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DrAdminBundle\Entity\Experience'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dradminbundle_experience';
    }
}
