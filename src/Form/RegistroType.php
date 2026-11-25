<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'constraints' => [new NotBlank(message: 'El nombre es obligatorio.')],
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos',
                'constraints' => [new NotBlank(message: 'Los apellidos son obligatorios.')],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(message: 'El email es obligatorio.'),
                    new Email(message: 'El email no tiene un formato válido.'),
                ],
            ])
            ->add('username', TextType::class, [
                'label' => 'Usuario',
                'constraints' => [new NotBlank(message: 'El usuario es obligatorio.')],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Contraseña'],
                'second_options' => ['label' => 'Repite la contraseña'],
                'invalid_message' => 'Las contraseñas no coinciden.',
                'constraints' => [new NotBlank(message: 'La contraseña es obligatoria.')],
            ])
            ->add('condiciones', CheckboxType::class, [
                'label' => 'Acepto las condiciones',
                'constraints' => [new IsTrue(message: 'Debes aceptar las condiciones para registrarte.')],
            ])
            ->add('registrar', SubmitType::class, ['label' => 'Registrarse'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
