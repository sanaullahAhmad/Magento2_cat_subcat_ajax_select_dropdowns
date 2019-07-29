<?php
namespace Pulsestorm\HelloWorldMVVM\Helper;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
	
	public function getCategoriesDropdown(){
		//$categories=Mage::getModel('catalog/category')->getCollection()->addAttributeToSelect('name')->addAttributeToSort('path', 'asc')->addFieldToFilter('is_active', array('eq'=>'1'));
		
		$first = array();
		$children = array();
		//
		$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();	 
		$categoryCollection = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
		$categories = $categoryCollection->create();
		$categories->addAttributeToSelect('*');
		 
		/*foreach ($categories as $category) {
		    //echo $category->getName() . '<br />';
		    $first[$category->getId()] = $category;
		    $children[$category->getId()] = $category;
		}*/
		//
		foreach ($categories->getItems() as $cat) {
			if ($cat->getLevel() == 2 &&  !in_array($cat->getId(), array(3,34,35,35,36,37,38,39,40,41,42,43,44,45,46))) {
				$first[$cat->getId()] = $cat;
			} else if ($cat->getParentId()) {
				$children[$cat->getParentId()][] = $cat->getData();
			}
		}
		/*Adding new query of selecting only top level categories here*/
		
		/*end*/
		return array('first' => $first, 'children' => $children);
	}
}