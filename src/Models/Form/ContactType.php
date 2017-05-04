<?php
namespace Models\Form;

use Models\Entities\Contact;
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


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('Name', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                ),
				'attr' => array('class'=>'form-control', 'placeholder' => 'Name', 'id' => 'name'),
            ))
            ->add('EmailAddress', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Email(),
                ),
				'attr' => array('class'=>'form-control', 'placeholder' => 'Email Address', 'id' => 'email'),
            ))
            ->add('Message', TextareaType::class, array(
				'attr' => array('rows' => '5','class'=>'form-control', 'placeholder' => 'Message', 'id' => 'message',)
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults(array(
            'data_class' => Contact::class,
        ));
    }
	
	public function getName() {
		return 'standalone';
	}
}