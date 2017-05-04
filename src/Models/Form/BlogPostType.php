<?php
namespace Models\Form;

use Models\Entities\BlogPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;;
use Symfony\Component\Form\Extension\Core\Type\Text;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;


class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('Title', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                ),
				'attr' => array('class'=>'form-control', 'placeholder' => 'Title', 'id' => 'title'),
            ))
           ->add('Chapo', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                ),
				'attr' => array('rows' => '5','class'=>'form-control', 'placeholder' => 'Chapo', 'id' => 'chapo'),
            ))
            ->add('TextPost', TextareaType::class, array(
				'attr' => array('rows' => '25','class'=>'form-control', 'placeholder' => 'Text', 'id' => 'textPost',)
            ))
			->add('Author', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                ),
				'attr' => array('class'=>'form-control', 'placeholder' => 'Author', 'id' => 'author'),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults(array(
            'data_class' => BlogPost::class,
        ));
    }
	
	public function getName() {
		return 'standalone';
	}
}