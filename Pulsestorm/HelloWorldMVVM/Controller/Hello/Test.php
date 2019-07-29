<?php
namespace Pulsestorm\HelloWorldMVVM\Controller\Hello;

class Test extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$cate=array();
		//$cate = array(array('entity_id'=>1, 'name'=>'subcate_1'), array('entity_id'=>2, 'name'=>'subcate_2'));
		//echo json_encode($cate);
		//
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
	    $categories = $objectManager->create('Magento\Catalog\Model\Category')->load($_POST['catId']);

	    if($categories->hasChildren()){
	        $subcategories = explode(',', $categories->getChildren());
	        foreach ($subcategories as $category) {
	            $subcategory = $objectManager->create('Magento\Catalog\Model\Category')->load($category);
	            $cate[] = array('entity_id'=>$subcategory->getId(), 'name'=>$subcategory->getName(), 'url'=>$subcategory->getUrl() );
	        }
	    }
		echo json_encode(array('parent_url'=>$categories->getUrl(), 'cate'=>$cate));
		exit;

	}
}