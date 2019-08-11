<?php


namespace AppBundle\Association\Form;

use Afup\Site\Utils\Pays;
use AppBundle\Offices\OfficesCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactDetailsType extends AbstractType
{
    public $countryService;

    public function __construct(Pays $countryService)
    {
        $this->countryService = $countryService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                ]
            ])
            ->add('address', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('zipcode', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('country', ChoiceType::class, [
                'choices' => $this->getCountyChoices(),
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(['max' => 20]),
                ],
            ])
            ->add('mobilephone', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(['max' => 20]),
                ],
            ])
            ->add('nearest_office', ChoiceType::class, [
                'choices' => $this->getOfficesList(),
            ])
            ->add('username', TextType::class, [
                'attr' => [
                    'maxlength' => 30
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 30]),
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'invalid_message' => 'The password fields must match',
            ])
            ->add('save', SubmitType::class, ['label' => 'Update'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }

    private function getOfficesList()
    {
        $officesCollection = new OfficesCollection();
        $offices = ['' => '-Aucune-'];
        foreach ($officesCollection->getOrderedLabelsByKey() as $id => $city) {
            $offices[$city] = $id;
        }
        return $offices;
    }

    private function getCountyChoices()
    {
        $choices = [];
        foreach ($this->countryService->obtenirPays() as $id => $country) {
            $choices[$country] = $id;
        }
        return $choices;
    }
}
