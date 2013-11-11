<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


/**
 * appdevUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRouteNames = array(
       '_wdt' => true,
       '_profiler_search' => true,
       '_profiler_purge' => true,
       '_profiler_import' => true,
       '_profiler_export' => true,
       '_profiler_search_results' => true,
       '_profiler' => true,
       '_configurator_home' => true,
       '_configurator_step' => true,
       '_configurator_final' => true,
       '_welcome' => true,
       'home' => true,
       'modeloBundle_homepage' => true,
       'admin_estado' => true,
       'admin_estado_show' => true,
       'admin_estado_new' => true,
       'admin_estado_create' => true,
       'admin_estado_edit' => true,
       'admin_estado_update' => true,
       'admin_estado_delete' => true,
       'admin_rol' => true,
       'admin_rol_show' => true,
       'admin_rol_new' => true,
       'admin_rol_create' => true,
       'admin_rol_edit' => true,
       'admin_rol_update' => true,
       'admin_rol_delete' => true,
       'admin_regla' => true,
       'admin_regla_show' => true,
       'admin_regla_new' => true,
       'admin_regla_create' => true,
       'admin_regla_edit' => true,
       'admin_regla_update' => true,
       'admin_regla_delete' => true,
       'admin_usuario' => true,
       'admin_usuario_show' => true,
       'admin_usuario_new' => true,
       'admin_usuario_create' => true,
       'admin_usuario_edit' => true,
       'admin_usuario_update' => true,
       'admin_usuario_delete' => true,
       'admin_entidad' => true,
       'admin_entidad_show' => true,
       'admin_entidad_new' => true,
       'admin_entidad_create' => true,
       'admin_entidad_edit' => true,
       'admin_entidad_update' => true,
       'admin_entidad_delete' => true,
       'usuarioBundle_homepage' => true,
       '_security_check' => true,
       '_security_logout' => true,
       'reporteria' => true,
       'reporteria_defensoras' => true,
       'reporteria_cihuatlan' => true,
       'reporteria_reportes' => true,
       'reporteria_general_ods' => true,
       'reporteria_general_xls' => true,
       'reporteria_general_xml' => true,
       'reporteria_historial_ods' => true,
       'reporteria_historial_xls' => true,
       'reporteria_historial_xml' => true,
       'reporteria_denuncias_ods' => true,
       'reporteria_denuncias_xls' => true,
       'reporteria_denuncias_xml' => true,
       'reporteria_localidades_ods' => true,
       'reporteria_localidades_xls' => true,
       'reporteria_localidades_xml' => true,
       'reporteria_genero_ods' => true,
       'reporteria_genero_xls' => true,
       'reporteria_genero_xml' => true,
       'reporteria_edades_ods' => true,
       'reporteria_edades_xls' => true,
       'reporteria_edades_xml' => true,
       'reporteria_encuestas_ods' => true,
       'reporteria_encuestas_xls' => true,
       'reporteria_encuestas_xml' => true,
       'reporteria_localidades_mapa' => true,
       'mensajeria' => true,
       'mensajeria_enviados' => true,
       'mensajeria_recibidos' => true,
       'mensajeria_encuestas' => true,
       'mensajeria_enviar' => true,
       'mensajeria_contestar' => true,
       'mensajeria_publicar' => true,
       'mensajeria_encuestar' => true,
       'mensajeria_consultar' => true,
       'mensajeria_encuestar_consulta' => true,
       '_webservice_call' => true,
       '_webservice_definition' => true,
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        if (!isset(self::$declaredRouteNames[$name])) {
            throw new RouteNotFoundException(sprintf('Route "%s" does not exist.', $name));
        }

        $escapedName = str_replace('.', '__', $name);

        list($variables, $defaults, $requirements, $tokens) = $this->{'get'.$escapedName.'RouteInfo'}();

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute);
    }

    private function get_wdtRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'token',  ),  1 =>   array (    0 => 'text',    1 => '/_wdt',  ),));
    }

    private function get_profiler_searchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_profiler/search',  ),));
    }

    private function get_profiler_purgeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_profiler/purge',  ),));
    }

    private function get_profiler_importRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_profiler/import',  ),));
    }

    private function get_profiler_exportRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '.txt',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/\\.]+?',    3 => 'token',  ),  2 =>   array (    0 => 'text',    1 => '/_profiler/export',  ),));
    }

    private function get_profiler_search_resultsRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/search/results',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'token',  ),  2 =>   array (    0 => 'text',    1 => '/_profiler',  ),));
    }

    private function get_profilerRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'token',  ),  1 =>   array (    0 => 'text',    1 => '/_profiler',  ),));
    }

    private function get_configurator_homeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_configurator/',  ),));
    }

    private function get_configurator_stepRouteInfo()
    {
        return array(array (  0 => 'index',), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'index',  ),  1 =>   array (    0 => 'text',    1 => '/_configurator/step',  ),));
    }

    private function get_configurator_finalRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_configurator/final',  ),));
    }

    private function get_welcomeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\usuarioBundle\\Controller\\DefaultController::publicoAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/home',  ),));
    }

    private function gethomeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\usuarioBundle\\Controller\\DefaultController::publicoAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/',  ),));
    }

    private function getmodeloBundle_homepageRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\DefaultController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin',  ),));
    }

    private function getadmin_estadoRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/estado/',  ),));
    }

    private function getadmin_estado_showRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/estado/show',  ),));
    }

    private function getadmin_estado_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/estado/new',  ),));
    }

    private function getadmin_estado_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/estado/create',  ),));
    }

    private function getadmin_estado_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/estado',  ),));
    }

    private function getadmin_estado_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/estado',  ),));
    }

    private function getadmin_estado_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEstadoController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/estado',  ),));
    }

    private function getadmin_rolRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/rol/',  ),));
    }

    private function getadmin_rol_showRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/rol/show',  ),));
    }

    private function getadmin_rol_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/rol/new',  ),));
    }

    private function getadmin_rol_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/rol/create',  ),));
    }

    private function getadmin_rol_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rol',  ),));
    }

    private function getadmin_rol_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rol',  ),));
    }

    private function getadmin_rol_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdRolController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rol',  ),));
    }

    private function getadmin_reglaRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/regla/',  ),));
    }

    private function getadmin_regla_showRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/regla/show',  ),));
    }

    private function getadmin_regla_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/regla/new',  ),));
    }

    private function getadmin_regla_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/regla/create',  ),));
    }

    private function getadmin_regla_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/regla',  ),));
    }

    private function getadmin_regla_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/regla',  ),));
    }

    private function getadmin_regla_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdReglaSmsController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/regla',  ),));
    }

    private function getadmin_usuarioRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/usuario/',  ),));
    }

    private function getadmin_usuario_showRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/usuario/show',  ),));
    }

    private function getadmin_usuario_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/usuario/new',  ),));
    }

    private function getadmin_usuario_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/usuario/create',  ),));
    }

    private function getadmin_usuario_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/usuario',  ),));
    }

    private function getadmin_usuario_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/usuario',  ),));
    }

    private function getadmin_usuario_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdUsuarioController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/usuario',  ),));
    }

    private function getadmin_entidadRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/entidad/',  ),));
    }

    private function getadmin_entidad_showRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/entidad/show',  ),));
    }

    private function getadmin_entidad_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/entidad/new',  ),));
    }

    private function getadmin_entidad_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/entidad/create',  ),));
    }

    private function getadmin_entidad_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/entidad',  ),));
    }

    private function getadmin_entidad_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/entidad',  ),));
    }

    private function getadmin_entidad_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\modeloBundle\\Controller\\ScdEntidadController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/entidad',  ),));
    }

    private function getusuarioBundle_homepageRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\usuarioBundle\\Controller\\DefaultController::loginAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/login',  ),));
    }

    private function get_security_checkRouteInfo()
    {
        return array(array (), array (), array (), array (  0 =>   array (    0 => 'text',    1 => '/login_check',  ),));
    }

    private function get_security_logoutRouteInfo()
    {
        return array(array (), array (), array (), array (  0 =>   array (    0 => 'text',    1 => '/logout',  ),));
    }

    private function getreporteriaRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria',  ),));
    }

    private function getreporteria_defensorasRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::defensoraAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/defensoras/cihuatlan',  ),));
    }

    private function getreporteria_cihuatlanRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::defensoraAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/defensoras/reporte',  ),));
    }

    private function getreporteria_reportesRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::reportesAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reportes',  ),));
    }

    private function getreporteria_general_odsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generalOdsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/generalods',  ),));
    }

    private function getreporteria_general_xlsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generalXlsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/generalxls',  ),));
    }

    private function getreporteria_general_xmlRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generalXmlAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/generalxml',  ),));
    }

    private function getreporteria_historial_odsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::historialOdsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/historialods',  ),));
    }

    private function getreporteria_historial_xlsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::historialXlsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/historialxls',  ),));
    }

    private function getreporteria_historial_xmlRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::historialXmlAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/historialxml',  ),));
    }

    private function getreporteria_denuncias_odsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::denunciasOdsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/denunciasods',  ),));
    }

    private function getreporteria_denuncias_xlsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::denunciasXlsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/denunciasxls',  ),));
    }

    private function getreporteria_denuncias_xmlRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::denunciasXmlAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/denunciasxml',  ),));
    }

    private function getreporteria_localidades_odsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::localidadesOdsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/localidadesods',  ),));
    }

    private function getreporteria_localidades_xlsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::localidadesXlsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/localidadesxls',  ),));
    }

    private function getreporteria_localidades_xmlRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::localidadesXmlAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/localidadesxml',  ),));
    }

    private function getreporteria_genero_odsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generoOdsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/generoods',  ),));
    }

    private function getreporteria_genero_xlsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generoXlsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/generoxls',  ),));
    }

    private function getreporteria_genero_xmlRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::generoXmlAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/generoxml',  ),));
    }

    private function getreporteria_edades_odsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::edadesOdsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/edadesods',  ),));
    }

    private function getreporteria_edades_xlsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::edadesXlsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/edadesxls',  ),));
    }

    private function getreporteria_edades_xmlRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::edadesXmlAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/edadesxml',  ),));
    }

    private function getreporteria_encuestas_odsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::encuestasOdsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/encuestasods',  ),));
    }

    private function getreporteria_encuestas_xlsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::encuestasXlsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/encuestasxls',  ),));
    }

    private function getreporteria_encuestas_xmlRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::encuestasXmlAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/encuestasxml',  ),));
    }

    private function getreporteria_localidades_mapaRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\reporteriaBundle\\Controller\\ReporteriaController::localidadesMapaAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/reporteria/localidadesmapa',  ),));
    }

    private function getmensajeriaRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/mensajeria',  ),));
    }

    private function getmensajeria_enviadosRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::listarEnviadosAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/mensajeria/enviados',  ),));
    }

    private function getmensajeria_recibidosRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::listarRecibidosAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/mensajeria/recibidos',  ),));
    }

    private function getmensajeria_encuestasRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::listarEncuestasAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/mensajeria/encuestas',  ),));
    }

    private function getmensajeria_enviarRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::enviarMensajeAction',), array (  '_method' => 'POST',), array (  0 =>   array (    0 => 'text',    1 => '/mensajeria/enviar',  ),));
    }

    private function getmensajeria_contestarRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::contestarMensajeAction',), array (  '_method' => 'POST',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  1 =>   array (    0 => 'text',    1 => '/mensajeria/contestar',  ),));
    }

    private function getmensajeria_publicarRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::publicarMensajeAction',), array (  '_method' => 'POST',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  1 =>   array (    0 => 'text',    1 => '/mensajeria/publicar',  ),));
    }

    private function getmensajeria_encuestarRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::enviarEncuestaAction',), array (  '_method' => 'POST',), array (  0 =>   array (    0 => 'text',    1 => '/mensajeria/encuestar',  ),));
    }

    private function getmensajeria_consultarRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::listarConsultasAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/mensajeria/consultar',  ),));
    }

    private function getmensajeria_encuestar_consultaRouteInfo()
    {
        return array(array (), array (  '_controller' => 'matilti\\mensajeriaBundle\\Controller\\MensajeriaController::consultarEncuestaAction',), array (  '_method' => 'POST',), array (  0 =>   array (    0 => 'text',    1 => '/mensajeria/consultarEncuesta',  ),));
    }

    private function get_webservice_callRouteInfo()
    {
        return array(array (  0 => 'webservice',), array (  '_controller' => 'BeSimple\\SoapBundle\\Controller\\SoapWebServiceController::CallAction',  '_format' => 'xml',), array (  '_method' => 'POST',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'webservice',  ),  1 =>   array (    0 => 'text',    1 => '/ws',  ),));
    }

    private function get_webservice_definitionRouteInfo()
    {
        return array(array (  0 => 'webservice',), array (  '_controller' => 'BeSimple\\SoapBundle\\Controller\\SoapWebServiceController::DefinitionAction',  '_format' => 'xml',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'webservice',  ),  1 =>   array (    0 => 'text',    1 => '/ws',  ),));
    }
}
