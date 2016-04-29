<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class EventAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class EventAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Event';
    protected $baseRoutePattern = 'events/event';
    protected $datagridValues = array(
        '_sort_by'    => 'date',
        '_sort_order' => 'desc',
    );

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('batch');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', $this->getFormMdSuccessBoxArray(8))
            ->add(
                'date',
                'sonata_type_date_picker',
                array(
                    'label'  => 'Data',
                    'format' => 'HH:MM d/M/y',
                )
            )
//            ->add(
//                'description',
//                'ckeditor',
//                array(
//                    'label' => 'Descripció',
//                    'config_name' => 'my_config',
//                    'required'    => true,
//                )
//            )
//            ->add(
//                'imageFile',
//                'file',
//                array(
//                    'label'    => 'Imatge',
//                    'help'     => $this->getImageHelperFormMapperWithThumbnail(),
//                    'required' => false,
//                )
//            )
            ->add(
                'place',
                null,
                array(
                    'label' => 'Lloc',
                )
            )
            ->add(
                'artist',
                null,
                array(
                    'label' => 'Artista',
                )
            )
            ->add(
                'category',
                null,
                array(
                    'label' => 'Categoria',
                )
            )
            ->end()
            ->with('Controls', $this->getFormMdSuccessBoxArray(4))
            ->add(
                'longitude',
                null,
                array(
                    'label' => 'Longitud',
                )
            )
            ->add(
                'latitude',
                null,
                array(
                    'label' => 'Latitud',
                )
            )
            ->add(
                'enabled',
                'checkbox',
                array(
                    'label'    => 'Actiu',
                    'required' => false,
                )
            )
            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'date',
                'doctrine_orm_date',
                array(
                    'label'      => 'Data',
                    'field_type' => 'sonata_type_date_picker',
                    'format'     => 'd-m-Y',
                )
            )
            ->add(
                'place',
                null,
                array(
                    'label' => 'Lloc',
                )
            )
            ->add(
                'artist',
                null,
                array(
                    'label' => 'Artista',
                )
            )
            ->add(
                'category',
                null,
                array(
                    'label' => 'Categoria',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'Actiu',
                    'editable' => true,
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
//            ->add(
//                'image',
//                null,
//                array(
//                    'label'    => 'Imatge',
//                    'template' => '::Admin/Cells/list__cell_image_field.html.twig'
//                )
//            )
            ->add(
                'date',
                'date',
                array(
                    'label'    => 'Data',
                    'format'   => 'h:i d/M',
                    'editable' => true,
                )
            )
            ->add(
                'place',
                null,
                array(
                    'label' => 'Lloc',
                    'editable' => true,
                )
            )
            ->add(
                'artist',
                null,
                array(
                    'label' => 'Artista',
                )
            )
            ->add(
                'category',
                null,
                array(
                    'label' => 'Categoria',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'Actiu',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'label'   => 'Accions',
                    'actions' => array(
                        'edit'   => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    )
                )
            );
    }
}
