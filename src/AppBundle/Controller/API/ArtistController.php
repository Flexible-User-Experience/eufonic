<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
//use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Exception\InvalidParameterException;

/**
 * Class ArtistController
 *
 * @category Controller
 * @package  AppBundle\Controller\API
 * @author   David Romaní <david@flux.cat>
 *
 * @Rest\NamePrefix("api_artist_")
 */
class ArtistController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Get artists list
     *
     * @Rest\View(serializerGroups={"list"})
     * @Rest\Get("/list")
     * @ApiDoc(
     *  section="Artist",
     *  resource=true,
     *  description="Get artists list",
     *  requirements={
     *      {"name"="_locale", "dataType"="string", "requirement"="ca|oc|es|en|fr", "description"="available locales"},
     *      {"name"="_format", "dataType"="string", "requirement"="json|xml", "description"="available formats"}
     *  },
     *  statusCodes={
     *         200="Returned when successful"
     *     }
     * )
     *
     * @return Response
     */
    public function cgetAction()
    {
        $entities = $this->getDoctrine()->getRepository('AppBundle:Artist')->findAll();

        return array('artists' => $entities);
    }
}
