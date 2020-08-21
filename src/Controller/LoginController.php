<?php

namespace App\Controller;

use App\Entity\Client;
//use App\Model\Request\LoginRequestModel;
use App\Model\Response\ApiResponseModel;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController extends AbstractBaseController
{
    /** @var EntityManagerInterface */
    public $em;

    /**
     * LoginController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /*
     * @param LoginRequestModel $loginRequestModel
     * @param ConstraintViolationListInterface $validationErrors
     * @ParamConverter("loginRequestModel", converter="fos_rest.request_body")
     * @return Response

    public function loginAction(
        LoginRequestModel $loginRequestModel,
        ConstraintViolationListInterface $validationErrors
    ) {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        return $this->apiResponse(new ApiResponseModel(
            true,
            [
                'token' => $loginRequestModel
            ]
        ));
    }*/


    public function register(UserPasswordEncoderInterface $encoder)
    {
        $users = [
            'adidas', 'nike', 'columbia'
        ];
        foreach ($users as $value){
            $user = new Client();
            $plainPassword = $value;
            $encoded = $encoder->encodePassword($user, $plainPassword);
            echo $encoded."\n";

            /*
            $user->setUsername($value);
            $user->setName($value);
            $user->setPassword($encoded);
            $this->em->persist($user);
            $this->em->flush();*/
        }
    }
}