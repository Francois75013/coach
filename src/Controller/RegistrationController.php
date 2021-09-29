<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\Mailer\Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationController extends AbstractController
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('pseudo')

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => true,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe obligatoire !',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au minimum {{ limit }} charactères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            
        ;
    }

 

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer): Response
    {


        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
             // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            //Pour générer le token d'activation de compte 
            $user->setActivationToken(md5(uniqid()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('index'); 
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
        // On crée le message
        $message = (new \Swift_Message ('Nouveau compte'))
        // On attribue l'expéditeur
        ->setFrom('clubatheon@gmail.com')
        // On attribue le destinataire
        ->setTo($user->getEmail())
        // On crée le texte daans la vue
        ->setBody(
            $this->renderView(
                'emails/activation.html.twig', ['token' => $user->getActivationToken()]
            ),
            'text/html'
        )
        ;
        $mailer->send($message);
    }

    #[Route('/activation/{token}', name: 'activation')]
    public function activation($token, UserRepository $user)
    {
         // On recherche si un utilisateur avec ce token existe en bdd
    $user = $user->findOneBy(['activation_token' => $token]);

    // Si aucun utilisateur n'est associé à ce token
    if(!$user){
        // On renvoie une erreur 404

        throw $this->createNotFoundException('Ce compte utilisateur n\'existe pas');
    }

    // On supprime le token
    $user->setActivationToken(null);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($user);
    $entityManager->flush();

     // On génère un message
     $this->addFlash('message', 'Votre compte à été activé avec succès');

     // Retour à l'accueil
     return $this->redirectToRoute('/');
    }

    
}
