<?php
namespace App\Form;
use App\Entity\Categorie;
use App\Entity\Formation;
use App\Entity\Playlist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
    date_default_timezone_set('Europe/Paris');
/**
 * Description of FormationType
 *
 * @author Cohen
 */
class FormationType extends AbstractType{
    
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                
            ->add('title', null, [
                'label' => 'Titre',
                'required' => true
             ])
                
            
                
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => '5'],
                'required' => false
            ])
                
            ->add('videoId', null, [
                'label' => 'ID Vidéo',
                'required' => true
            ])
            
            ->add('publishedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => ['max' => date('Y-m-d\TH:i:s')],
                'data' => ($options['data'] && $options['data']->getId()) ? $options['data']->getPublishedAt() : new \DateTime('now'),
                'label' => 'Date',
                'required' => true
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false,
                'label' => 'Catégories'
            ])
                
            ->add('playlist', EntityType::class, [
                'class' => Playlist::class,
                'choice_label' => 'name',
                'label' => 'Playlist',
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}