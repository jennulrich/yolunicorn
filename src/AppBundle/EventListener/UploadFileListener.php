<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 27/02/2018
 * Time: 16:24
 */
namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Film;
use AppBundle\Service\FileUpload;

class UploadFileListener
{
    private $uploader;

    public function __construct(FileUpload $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Film) {
            return;
        }

        // Pour upload image
        $fileImage = $entity->getImage();

        // only upload new files
        if (!$fileImage instanceof UploadedFile) {
            return;
        }

        $fileNameImage = $this->uploader->upload($fileImage);
        $entity->setImage($fileNameImage);

        // Pour upload video
        $fileVideo = $entity->getVideo();

        // only upload new files
        if (!$fileVideo instanceof UploadedFile) {
            return;
        }

        $fileNameVideo = $this->uploader->upload($fileVideo);
        $entity->setVideo($fileNameVideo);



    }
}