<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	
	public $pageDescription;
	public $pageKeywords;
	
	/**
	 * @var string the default layout for the controller view. Defaults to 'application.views.layouts.column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	//public $layout='application.views.layouts.column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * Creates pagination by given total item count and page size. Returns pagination object which can be
	 * used with the CLinkPager.
	 * @param integer $itemCount total item count.
	 * @param integer $pageSize page size.
	 * @return CPagination pagination object.
	 */
	public function paginate($itemCount, $pageSize)
	{
		$pagination=new CPagination($itemCount);
		$pagination->setPageSize($pageSize);
		return $pagination;
	}
}