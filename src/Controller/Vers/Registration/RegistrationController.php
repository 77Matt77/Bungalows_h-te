<?php
namespace App\Controller\Vers\Registration;



use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'vers_registration_register', methods: ['GET', 'POST'])]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            
            $passwordHashed = $userPasswordHasher->hashPassword($user, $form->get('password')->getData());
            $user->setPassword($passwordHashed);

            $entityManager->persist($user);
            $entityManager->flush();             

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('vers_registration_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('eden@emma-polynesia.com', 'Eden Emma'))
                    ->to($user->getEmail())
                    ->subject('Confirmation de votre email')
                    ->htmlTemplate('emails/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
               
            return $this->redirectToRoute('vers_registration_waiting_for_email_confirmation');
           
        }

        return $this->render('vers/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/register/waiting-for-email-confirmation', name: 'vers_registration_waiting_for_email_confirmation', methods: ['GET'])]
    public function waitingForEmailConfirmation(): Response
    {
        return $this->render("vers/registration/waiting_for_email_confirmation.html.twig");
        
    }

    #[Route('/verify/email', name: 'vers_registration_verify_email', methods: ['GET'])]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->query->get('id');
        
        if (null === $id) 
        {
            return $this->redirectToRoute('vers_registration_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) 
        {
            return $this->redirectToRoute('vers_registration_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try 
        {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) 
        {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('vers_registration_register');
        }
         // je suis la
        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Votre email a bien été vérifié, Vous pouvez vous connecter maintenant.');

        return $this->redirectToRoute('vers_accueil_index');
    }
    // #[Route('/register/waiting-for-email-confirmation', name: 'chemin_registration_waiting_for_email_confirmation', methods: ['GET'])]
    // public function waitingForEmailConfirmation(): Response 
    // {
    //     return $this->render('pages/chemin/registration/waiting_for_email_confirmation.html.twig');
    // }
}
